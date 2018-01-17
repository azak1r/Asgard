<?php

namespace Asgard\Models;

use Illuminate\Database\Eloquent\Model;

class DiscordUser extends Model
{

    protected $fillable = ['id'];

    public function user() {
        $this->belongsTo(User::class);
    }
}
