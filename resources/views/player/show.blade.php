@extends('layouts.app')

@section('content')

@if($team)
    <x-team-header :team="$team" />
@endif

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




    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-2">{{ $player->first_name }} {{ $player->last_name }}</h1>
        @if($team)
            <h3 class="text-xl text-gray-700 mb-6">
                Team:
                <a href="{{ route('teams.show', $team->team_id) }}" class="text-blue-600 hover:underline">
                    {{ $team->name }} {{ $team->nickname }}
                </a>
            </h3>
        @else
            <h3 class="text-xl text-gray-700 mb-6">Team: Unassigned</h3>
        @endif
        <h2>
            <img src="/storage/images/profile_pictures/player_{{ $player->player_id }}.png" alt="">
        </h2>

        <h2 class="text-2xl font-semibold mt-8 mb-2">Batting Stats</h2>
        @if($batting)
            <table class="min-w-full bg-white border border-gray-200 rounded mb-6 text-right">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="py-2 px-4 border-b">Games</th>
                        <th class="py-2 px-4 border-b">At Bats</th>
                        <th class="py-2 px-4 border-b">Runs</th>
                        <th class="py-2 px-4 border-b">Hits</th>
                        <th class="py-2 px-4 border-b">Home Runs</th>
                        <th class="py-2 px-4 border-b">RBIs</th>
                        <th class="py-2 px-4 border-b">Average</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $batting->g ?? '-' }}</td>
                        <td class="py-2 px-4 border-b">{{ $batting->ab ?? '-' }}</td>
                        <td class="py-2 px-4 border-b">{{ $batting->r ?? '-' }}</td>
                        <td class="py-2 px-4 border-b">{{ $batting->h ?? '-' }}</td>
                        <td class="py-2 px-4 border-b">{{ $batting->hr ?? '-' }}</td>
                        <td class="py-2 px-4 border-b">{{ $batting->rbi ?? '-' }}</td>
                        <td class="py-2 px-4 border-b">
                            @if($batting->ab)
                                {{ ltrim(number_format($batting->h / $batting->ab, 3), '0') }}
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        @else
            <p class="text-gray-500 mb-6">No batting stats available.</p>
        @endif

        <h2 class="text-2xl font-semibold mt-8 mb-2">Pitching Stats</h2>
        @if($pitching)
            <table class="min-w-full bg-white border border-gray-200 rounded mb-6 text-right">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="py-2 px-4 border-b">Games</th>
                        <th class="py-2 px-4 border-b">Wins</th>
                        <th class="py-2 px-4 border-b">Losses</th>
                        <th class="py-2 px-4 border-b">ERA</th>
                        <th class="py-2 px-4 border-b">Innings Pitched</th>
                        <th class="py-2 px-4 border-b">Strikeouts</th>
                        <th class="py-2 px-4 border-b">Walks</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $pitching->g ?? '-' }}</td>
                        <td class="py-2 px-4 border-b">{{ $pitching->w ?? '-' }}</td>
                        <td class="py-2 px-4 border-b">{{ $pitching->l ?? '-' }}</td>
                        <td class="py-2 px-4 border-b">
                            @if($pitching->ip)
                                {{ number_format(($pitching->er * 9) / $pitching->ip, 2) }}
                            @else
                                -
                            @endif
                        </td>
                        <td class="py-2 px-4 border-b">{{ $pitching->ip ?? '-' }}</td>
                        <td class="py-2 px-4 border-b">{{ $pitching->k ?? '-' }}</td>
                        <td class="py-2 px-4 border-b">{{ $pitching->bb ?? '-' }}</td>
                    </tr>
                </tbody>
            </table>
        @else
            <p class="text-gray-500 mb-6">No pitching stats available.</p>
        @endif

        <h2 class="text-2xl font-semibold mt-8 mb-2">Fielding Stats</h2>
        @if($fielding)
            <table class="min-w-full bg-white border border-gray-200 rounded mb-6 text-right">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="py-2 px-4 border-b">Games</th>
                        <th class="py-2 px-4 border-b">Putouts</th>
                        <th class="py-2 px-4 border-b">Assists</th>
                        <th class="py-2 px-4 border-b">Errors</th>
                        <th class="py-2 px-4 border-b">Fielding %</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $fielding->g ?? '-' }}</td>
                        <td class="py-2 px-4 border-b">{{ $fielding->po ?? '-' }}</td>
                        <td class="py-2 px-4 border-b">{{ $fielding->a ?? '-' }}</td>
                        <td class="py-2 px-4 border-b">{{ $fielding->er ?? '-' }}</td>
                        <td class="py-2 px-4 border-b">
                            @if($fielding->tc)
                                {{ ltrim(number_format($fielding->po / $fielding->tc, 3), '0') }}
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        @else
            <p class="text-gray-500 mb-6">No fielding stats available.</p>
        @endif
    </div>
@endsection
