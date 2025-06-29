@extends('layouts.app')

@section('content')


    <div class="relative mb-4">
        <!-- Floating Image -->
        <div class="absolute left-0 top-0 z-10">
            <img src="/storage/images/team_logos/{{ $team->logo_file_name }}" alt="">
        </div>

        <!-- Main Content Box -->
        <div class="bg-[{{ $team->background_color_id }}] text-[{{ $team->text_color_id }}] flex flex-1 items-center justify-between pl-36 ">
            <div></div>
            <div>
                <div class="text-4xl font-bold mb-2 text-center">{{ $team->name }} {{ $team->nickname }}</div>
                <div><a href="{{ route('home') }}">League Home</a> | Roster | Stats | Schedule</div>
            </div>
            <div></div>
        </div>
    </div>


<div class="max-w-xl mx-auto my-8 bg-gray-50 rounded-lg p-8 shadow">
    <h2 class="mt-8 mb-4 text-xl font-semibold text-gray-600">Roster</h2>
    @php
        $positions = [
            1 => 'Pitcher',
            2 => 'Catcher',
            3 => 'First Base',
            4 => 'Second Base',
            5 => 'Third Base',
            6 => 'Shortstop',
            7 => 'Left Field',
            8 => 'Centerfield',
            9 => 'Right Field',
        ];
    @endphp

    @if(collect($grouped)->flatten()->isEmpty())
        <p class="text-gray-500">No players found for this team.</p>
    @else
        @foreach($grouped as $group => $players)
            @if($players->isNotEmpty())
                <h3 class="mt-6 mb-2 text-lg font-bold text-gray-700">{{ $group }}</h3>
                <ul class="divide-y divide-gray-200">
                    @foreach($players as $player)
                        <li class="py-2">
                            <span class="font-semibold">
                                {{ $positions[$player->position] ?? $player->position }}
                            </span> &mdash;
                            <a href="{{ route('players.show', ['player' => $player->player_id]) }}" class="text-blue-600 hover:underline">
                                {{ $player->first_name }} {{ $player->last_name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        @endforeach
    @endif

    <a class="inline-block mt-8 text-blue-600 hover:underline font-medium" href="{{ route('home') }}">Back to Home</a>
</div>
@endsection
