@extends('layouts.dashboard')

@section('PAGE_TITLE', 'ASGARD :: PROFILE')
@section('CONTENT_TITLE', 'Profile')

@section('content')
    <div class="row">

        @include('dashboard.partials.profile.characters')

        <div class="col-3">
            @include('dashboard.partials.profile.select-main-chracter')
            @include('dashboard.partials.profile.discord-account')
            @include('dashboard.partials.profile.reddit-account')
        </div>

        <div class="col-4">
            @include('dashboard.partials.profile.select-user-roles')

        </div>

    </div>

    <div class="row">
        @include('dashboard.partials.profile.info-box')
    </div>
@endsection

