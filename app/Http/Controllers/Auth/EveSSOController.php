<?php

namespace Asgard\Http\Controllers\Auth;

use Asgard\Jobs\Update\InitialCharacterSetup;
use Asgard\Models\Character;
use Asgard\Models\Token;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Asgard\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use nullx27\Socialite\EveOnline\Traits\EveAuth;

class EveSSOController extends Controller
{
    use EveAuth;

    public function login(Request $request)
    {
        $scopes = explode(',', config('services.eveonline.scopes'));

        return Socialite::driver('eveonline')
            ->stateless()
            ->scopes($scopes)
            ->redirect();
    }

    public function handle_callback(Request $request)
    {
        try {
            $this->user = Socialite::driver('eveonline')->stateless()->user();
            $character_data = $this->get_character();

            $character = Character::firstOrNew(['id' => $this->user->id]);

            $character->refresh_token = $this->user->refreshToken;
            $character->name = $this->user->name;
            $character->owner_hash = $this->user->owner_hash;
            $character->corporation_id = $character_data->corporation_id;

            Auth::user()->characters()->save($character);

            $this->dispatch(new InitialCharacterSetup($character))->onQueue('high');

        } // ignore model not found exceptions
        catch (ModelNotFoundException $e) {}
        catch (Exception $exception) {
            dd($exception);
        } finally {
            // always redirect
            return redirect()->route('characters.index', Auth::user()->id);
        }

    }

}
