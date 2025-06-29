@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-4">
            Box Score: {{ $game->awayTeam->name }} @ {{ $game->homeTeam->name }}
        </h1>

        <p class="mb-2">Date: {{ \Carbon\Carbon::parse($game->date)->format('F j, Y') }}</p>

        <p>
            Final Score:
            <strong>{{ $game->awayTeam->name }} {{ $game->runs0 }} - {{ $game->runs1 }} {{ $game->homeTeam->name }}</strong>
        </p>

        {{-- Add inning breakdown, line score, stats, etc. here --}}
    </div>
@endsection
