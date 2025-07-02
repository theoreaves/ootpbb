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

<div class="w-3/4 mt-20 mx-auto my-8 bg-gray-50 rounded-lg p-8 shadow md:grid md:grid-cols-3">

    <div>
        {{-- Last 3 Games --}}
    <h2 class="mb-2 text-xl font-semibold text-gray-600">Last 3 Games</h2>
    @if($lastGames->isEmpty())
        <p class="text-gray-500 mb-4">No previous games found.</p>
    @else
        <ul class="mb-4 ">
            @foreach($lastGames as $game)
                @php
                    $isHome = $game->home_team == $team->team_id;
                    $opponentTeam = $isHome ? $game->awayTeam : $game->homeTeam;
                    $opponent = $opponentTeam->name ?? 'Unknown';
                    $teamScore = $isHome ? ($game->runs0 ?? 0) : ($game->runs1 ?? 0);
                    $oppScore = $isHome ? ($game->runs1 ?? 0) : ($game->runs0 ?? 0);
                    $result = $teamScore > $oppScore ? 'W' : 'L';
                    $sep = $isHome ? 'vs' : '@';
                @endphp
                <li class="py-2 flex items-center">
                    <a href="{{ route('games.boxscore', ['game' => $game->game_id]) }}" class="hover:text-blue-500 flex items-center">
                        <span class="font-semibold mr-2">{{ \Carbon\Carbon::parse($game->date)->format('M d, Y') }}</span>
                        &mdash;
                        <span class="mx-2">{{ $sep }}</span>
                        <img src="/storage/images/team_logos/{{ $opponentTeam->small_logo }}" alt="{{ $opponent }}" class="w-6 h-6 object-contain inline-block mr-1" />
                        <span>{{ $opponent }}</span>
                        <span class="ml-2 text-gray-700">
                            {{ $result }} {{ $teamScore }}-{{ $oppScore }}
                        </span>
                    </a>
                </li>
            @endforeach
        </ul>
    @endif

    {{-- Next 3 Games --}}
    <h2 class="mb-2 text-xl font-semibold text-gray-600">Next 3 Games</h2>
    @if($nextGames->isEmpty())
        <p class="text-gray-500 mb-4">No upcoming games found.</p>
    @else
        <ul class="mb-4 ">
            @foreach($nextGames as $game)
                @php
                    $isHome = $game->home_team == $team->team_id;
                    $opponentTeam = $isHome ? $game->awayTeam : $game->homeTeam;
                    $opponent = $opponentTeam->name ?? 'Unknown';
                    $sep = $isHome ? 'vs' : '@';
                @endphp
                <li class="py-2 flex items-center">
                    <span class="font-semibold mr-2">{{ \Carbon\Carbon::parse($game->date)->format('M d, Y') }}</span>
                    &mdash;
                    <span class="mx-2">{{ $sep }}</span>
                    <img src="/storage/images/team_logos/{{ $opponentTeam->small_logo }}" alt="{{ $opponent }}" class="w-6 h-6 object-contain inline-block mr-1" />
                    <span>{{ $opponent }}</span>
                </li>
            @endforeach
        </ul>
    @endif
    </div>

    {{-- Subleague Standings --}}
    <div>
    @if(isset($subleague) && isset($standings) && $standings->count())
        <h2 class="mb-4 text-xl font-semibold text-gray-600">
            {{ $subleague->name ?? 'Subleague' }} Standings
        </h2>
        <table class="min-w-[350px] w-full border border-zinc-200 rounded-lg overflow-hidden shadow mb-8 bg-white">
            <thead>
                <tr class="bg-zinc-50 text-zinc-600">
                    <th class="py-2 px-3 font-medium text-xs">Pos</th>
                    <th class="py-2 px-3 font-medium text-xs text-left">Team</th>
                    <th class="py-2 px-3 font-medium text-xs">W</th>
                    <th class="py-2 px-3 font-medium text-xs">L</th>
                    <th class="py-2 px-3 font-medium text-xs">PCT</th>
                    <th class="py-2 px-3 font-medium text-xs">GB</th>
                </tr>
            </thead>
            <tbody>
                @foreach($standings as $record)
                    <tr class="even:bg-zinc-100 hover:bg-zinc-200 transition-colors {{ $record->team->team_id == $team->team_id ? 'font-bold bg-blue-50' : '' }}">
                        <td class="py-2 px-3 text-center">{{ $record->pos }}</td>
                        <td class="py-2 px-3 text-left font-medium">
                            <a href="{{ route('teams.show', ['team' => $record->team->team_id]) }}" class="hover:text-blue-500">
                                {{ $record->team->name ?? 'Unknown' }}
                            </a>
                        </td>
                        <td class="py-2 px-3 text-center">{{ $record->w }}</td>
                        <td class="py-2 px-3 text-center">{{ $record->l }}</td>
                        <td class="py-2 px-3 text-center">{{ number_format($record->pct, 3) }}</td>
                        <td class="py-2 px-3 text-center">{{ $record->gb == 0 ? '-' : $record->gb }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    </div>

    <div>
    @if($teamStats)
        <h2 class="text-xl font-bold text-center">Team Stats</h2>
        <table class="mt-2 mb-4 w-full">
            <tbody>
            <tr><td class="px-3 py-1 text-right font-bold">Runs Scored</td><td>{{ $teamStats['runs'] }} ({{ $teamStats['rankings']['runs'] }}{{ ordinal($teamStats['rankings']['runs']) }})</td></tr>
            <tr><td class="px-3 py-1 text-right font-bold">Batting AVG</td><td>{{ ltrim(number_format($teamStats['avg'], 3),'0') }} ({{ $teamStats['rankings']['avg'] }}{{ ordinal($teamStats['rankings']['avg']) }})</td></tr>
            <tr><td class="px-3 py-1 text-right font-bold">OBP</td><td>{{ ltrim(number_format($teamStats['obp'], 3), '0') }} ({{ $teamStats['rankings']['obp'] }}{{ ordinal($teamStats['rankings']['obp']) }})</td></tr>
            <tr><td class="px-3 py-1 text-right font-bold">OPS</td><td>{{ ltrim(number_format($teamStats['ops'], 3), '0') }} ({{ $teamStats['rankings']['ops'] }}{{ ordinal($teamStats['rankings']['ops']) }})</td></tr>
            <tr><td class="px-3 py-1 text-right font-bold">WAR</td><td>{{ ltrim(number_format($teamStats['war'], 1), '0') }} ({{ $teamStats['rankings']['war'] }}{{ ordinal($teamStats['rankings']['war']) }})</td></tr>
            <tr><td class="px-3 py-1 text-right font-bold">Home Runs</td><td>{{ $teamStats['hr'] }} ({{ $teamStats['rankings']['hr'] }}{{ ordinal($teamStats['rankings']['hr']) }})</td></tr>
            <tr><td class="px-3 py-1 text-right font-bold">ERA</td><td>{{ number_format($teamStats['era'], 2) }} ({{ $teamStats['rankings']['era'] }}{{ ordinal($teamStats['rankings']['era']) }})</td></tr>
            </tbody>
        </table>
    @endif
    </div>

    <div class="">
        <h2 class="text-xl font-bold text-center">{{ $team->park->name }}</h2>
        <div>
            <img src="/storage/stadiums/{{ strtolower(str_replace(' ', '_', $team->park->name)) }}.png" alt="">
        </div>
    </div>

        <div class="ml-10">
            <h3 class="text-lg font-bold mb-2">TEAM BATTING LEADERS</h3>
            <div class="mb-3">
                <div class="font-semibold">BATTING AVG</div>
                @foreach($battingLeadersByAvg as $leader)
                    <div class="flex items-center space-x-4 mb-2">
                        <a href="{{ route('players.show', $leader->player_id) }}">
                            <img src="/storage/images/person_pictures/player_{{ $leader->player->player_id }}.png" alt="{{ $leader->player->full_name }}" class="w-8 rounded">
                        </a>
                        <div>
                            <div class="font-semibold hover:text-blue-500">
                                <a href="{{ route('players.show', $leader->player_id) }}">
                                    {{ $leader->player->name }}
                                </a>
                            </div>
                            <div class="text-sm text-gray-600">
                                AVG:{{ ltrim(number_format($leader->h / $leader->ab, 3), '0') }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mb-3">
                <div class="font-semibold">HOME RUNS</div>
                @foreach($battingLeadersByHr as $leader)
                    <div class="flex items-center space-x-4 mb-2">
                        <a href="{{ route('players.show', $leader->player_id) }}">
                            <img src="/storage/images/person_pictures/player_{{ $leader->player->player_id }}.png" alt="{{ $leader->player->full_name }}" class="w-8 rounded">
                        </a>
                        <div>
                            <div class="font-semibold hover:text-blue-500">
                                <a href="{{ route('players.show', $leader->player_id) }}">
                                    {{ $leader->player->name }}
                                </a>
                            </div>
                            <div class="text-sm text-gray-600">
                                Home Runs: {{ $leader->hr }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mb-3">
                <div class="font-semibold">RUNS BATTED IN</div>
                @foreach($battingLeadersByRbi as $leader)
                    <div class="flex items-center space-x-4 mb-2">
                        <a href="{{ route('players.show', $leader->player_id) }}">
                            <img src="/storage/images/person_pictures/player_{{ $leader->player->player_id }}.png" alt="{{ $leader->player->full_name }}" class="w-8 rounded">
                        </a>
                        <div>
                            <div class="font-semibold hover:text-blue-500">
                                <a href="{{ route('players.show', $leader->player_id) }}">
                                    {{ $leader->player->name }}
                                </a>
                            </div>
                            <div class="text-sm text-gray-600">
                                RBI: {{ $leader->rbi }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mb-3">
                <div class="font-semibold">STOLEN BASES</div>
                @foreach($battingLeadersBySb as $leader)
                    <div class="flex items-center space-x-4 mb-2">
                        <a href="{{ route('players.show', $leader->player_id) }}">
                            <img src="/storage/images/person_pictures/player_{{ $leader->player->player_id }}.png" alt="{{ $leader->player->full_name }}" class="w-8 rounded">
                        </a>
                        <div>
                            <div class="font-semibold hover:text-blue-500">
                                <a href="{{ route('players.show', $leader->player_id) }}">
                                    {{ $leader->player->name }}
                                </a>
                            </div>
                            <div class="text-sm text-gray-600">
                                RBI: {{ $leader->sb }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="ml-10">
            <h3 class="text-lg font-bold mb-2">TEAM PITCHING LEADERS</h3>
            <div class="mb-3">
                <div class="font-semibold">EARNED RUN AVERAGE</div>
                @foreach($pitchingLeadersByEra as $leader)
                    <div class="flex items-center space-x-4 mb-2">
                        <a href="{{ route('players.show', $leader->player_id) }}">
                            <img src="/storage/images/person_pictures/player_{{ $leader->player->player_id }}.png" alt="{{ $leader->player->full_name }}" class="w-8 rounded">
                        </a>
                    <div>
                        <div class="font-semibold hover:text-blue-500">
                            <a href="{{ route('players.show', $leader->player_id) }}">
                                {{ $leader->player->name }}
                            </a>
                        </div>
                        <div class="text-sm text-gray-600">
                            ERA: {{ number_format(($leader->er * 9) / $leader->ip, 2) }}
                        </div>
                    </div>
                    </div>
                @endforeach
            </div>
            <div class="mb-3">
                <div class="font-semibold">WINS</div>
                @foreach($pitchingLeadersByWins as $leader)
                    <div class="flex items-center space-x-4 mb-2">
                        <a href="{{ route('players.show', $leader->player_id) }}">
                            <img src="/storage/images/person_pictures/player_{{ $leader->player->player_id }}.png" alt="{{ $leader->player->full_name }}" class="w-8 rounded">
                        </a>
                        <div>
                            <div class="font-semibold hover:text-blue-500">
                                <a href="{{ route('players.show', $leader->player_id) }}">
                                    {{ $leader->player->name }}
                                </a>
                            </div>
                            <div class="text-sm text-gray-600">
                                Wins: {{ $leader->w }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mb-3">
                <div class="font-semibold">STRIKEOUTS</div>
                @foreach($pitchingLeadersByStrikeouts as $leader)
                    <div class="flex items-center space-x-4 mb-2">
                        <a href="{{ route('players.show', $leader->player_id) }}">
                            <img src="/storage/images/person_pictures/player_{{ $leader->player->player_id }}.png" alt="{{ $leader->player->full_name }}" class="w-8 rounded">
                        </a>
                        <div>
                            <div class="font-semibold hover:text-blue-500">
                                <a href="{{ route('players.show', $leader->player_id) }}">
                                    {{ $leader->player->name }}
                                </a>
                            </div>
                            <div class="text-sm text-gray-600">
                                Wins: {{ $leader->k }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mb-3">
                <div class="font-semibold">INNINGS PITCHED</div>
                @foreach($pitchingLeadersByIp as $leader)
                    <div class="flex items-center space-x-4 mb-2">
                        <a href="{{ route('players.show', $leader->player_id) }}">
                            <img src="/storage/images/person_pictures/player_{{ $leader->player->player_id }}.png" alt="{{ $leader->player->full_name }}" class="w-8 rounded">
                        </a>
                        <div>
                            <div class="font-semibold hover:text-blue-500">
                                <a href="{{ route('players.show', $leader->player_id) }}">
                                    {{ $leader->player->name }}
                                </a>
                            </div>
                            <div class="text-sm text-gray-600">
                                Wins: {{ $leader->ip }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>


</div>
@endsection
