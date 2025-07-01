@extends('layouts.app')
@php
    function ordinal($number)
    {
        $ends = ['th','st','nd','rd','th','th','th','th','th','th'];
        if ((($number % 100) >= 11) && (($number % 100) <= 13)) {
            return 'th';
        }

        return $ends[$number % 10];
    }
@endphp

@section('content')
    <x-team-header :team="$team" />

    <div class="w-3/4 mt-20 mx-auto my-8 bg-gray-50 rounded-lg p-8 shadow ">
        <h2 class="text-xl font-bold text-center">{{ $team->park->name }}</h2>
        <div>
            <img src="/storage/stadiums/{{ strtolower(str_replace(' ', '_', $team->park->name)) }}.png" alt="">
        </div>
    </div>
@endsection
