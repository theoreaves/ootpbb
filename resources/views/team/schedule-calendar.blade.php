@extends('layouts.app')

@section('content')
    <x-team-header :team="$team" />

    <div class="max-w-6xl mx-auto px-4">
        @php
            use Carbon\Carbon;

            $prevMonth = $month->copy()->subMonth()->format('Y-m');
            $nextMonth = $month->copy()->addMonth()->format('Y-m');
        @endphp

        <div class="flex justify-between items-center mb-6">
            <a href="{{ route('teams.schedule', ['team' => $team->team_id, 'month' => $prevMonth]) }}"
               class="bg-gray-200 hover:bg-gray-300 text-sm px-3 py-1 rounded">
                &laquo; {{ Carbon::parse($prevMonth)->format('F Y') }}
            </a>

            <h1 class="text-3xl font-bold text-center">{{ $team->name }} - {{ $month->format('F Y') }}</h1>

            <a href="{{ route('teams.schedule', ['team' => $team->team_id, 'month' => $nextMonth]) }}"
               class="bg-gray-200 hover:bg-gray-300 text-sm px-3 py-1 rounded">
                {{ Carbon::parse($nextMonth)->format('F Y') }} &raquo;
            </a>
        </div>

        <div class="grid grid-cols-7 text-center font-semibold text-gray-700 mb-2">
            <div>Sun</div>
            <div>Mon</div>
            <div>Tue</div>
            <div>Wed</div>
            <div>Thu</div>
            <div>Fri</div>
            <div>Sat</div>
        </div>

        @php
            $start = $month->copy()->startOfMonth()->startOfWeek();
            $end = $month->copy()->endOfMonth()->endOfWeek();
            $date = $start->copy();
        @endphp

        <div class="grid grid-cols-7 gap-1 text-sm">
            @while ($date <= $end)
                @php
                    $isCurrentMonth = $date->month === $month->month;
                    $isToday = $date->isToday();
                    $gamesToday = $gamesByDate[$date->toDateString()] ?? collect();
                @endphp

                <div class="border p-1 h-32 overflow-auto relative
                {{ $isCurrentMonth ? 'bg-white' : 'bg-gray-100 text-gray-400' }}
                {{ $isToday ? 'border-blue-500 bg-blue-50' : '' }}">

                    <div class="absolute top-1 right-2 text-xs font-bold">{{ $date->day }}</div>

                    <div class="mt-4 space-y-1">
                        @foreach($gamesToday as $game)
                            @php
                                $isHome = $game->home_team == $team->team_id;
                                $opponentTeam = $isHome ? $game->awayTeam : $game->homeTeam;
                                $opponent = $opponentTeam->name ?? 'Unknown';
                                $label = $isHome ? 'vs' : '@';

                                $isUnplayed = ($game->runs0 == 0 && $game->runs1 == 0);

                                $score = $isUnplayed ? 'TBD' : "{$game->runs0}-{$game->runs1}";

                                $result = null;
                                if (!$isUnplayed) {
                                    $teamScore = $isHome ? $game->runs0 : $game->runs1;
                                    $opponentScore = $isHome ? $game->runs1 : $game->runs0;
                                    $result = $teamScore > $opponentScore ? 'Win' : 'Loss';
                                }

                                $bg = $isUnplayed
                                    ? ($isHome ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800')
                                    : '';
                            @endphp

                            <div class="flex items-center gap-2 px-1 py-0.5 rounded {{ $bg }}">
                                <img src="/storage/images/team_logos/{{ $opponentTeam->logo_file_name }}"
                                     alt="{{ $opponent }}"
                                     class="w-5 h-5 object-contain" />

                                <div>
                                    <div class="leading-tight">{{ $label }} {{ $opponent }}</div>
                                    <div class="text-xs font-medium">
                                        {{ $score }}
                                        @if($result)
                                            <span class="ml-1 {{ $result === 'Win' ? 'text-green-600 font-semibold' : 'text-red-600 font-semibold' }}">
                        ({{ $result }})
                    </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach



                    </div>
                </div>

                @php $date->addDay(); @endphp
            @endwhile
        </div>
        <div class="mt-6 text-sm text-gray-700">
            <h2 class="text-lg font-bold mb-2">Key</h2>
            <div class="flex gap-4 flex-wrap">
                <div class="flex items-center gap-2">
                    <div class="w-4 h-4 bg-green-100 border border-green-400 rounded-sm"></div>
                    <span>Home Game</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-4 h-4 bg-yellow-100 border border-yellow-400 rounded-sm"></div>
                    <span>Away Game</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-4 h-4 bg-blue-50 border border-blue-500 rounded-sm"></div>
                    <span>Today</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-4 h-4 bg-gray-100 border border-gray-300 rounded-sm"></div>
                    <span>Outside Selected Month</span>
                </div>
            </div>
        </div>

        <div class="mt-6 text-center">
            <a href="{{ route('teams.show', $team->team_id) }}"
               class="inline-block bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-700">
                Back to Team
            </a>
        </div>
    </div>
@endsection
