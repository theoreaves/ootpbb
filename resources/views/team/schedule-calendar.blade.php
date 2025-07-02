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
                    // Find first unplayed game (runs0 == 0 && runs1 == 0)
                    $firstUnplayed = $gamesToday->first(fn($g) => $g->runs0 == 0 && $g->runs1 == 0);
                    $anyPlayed = $gamesToday->contains(fn($g) => $g->played == 1);

                    $boxBg = '';
                    if ($firstUnplayed) {
                        $isHome = $firstUnplayed->home_team == $team->team_id;
                        $boxBg = $isHome ? 'bg-[' . $team->background_color_id .'] text-[' . $team->text_color_id .'] border-[' .  $team->text_color_id . '] ' : 'bg-gray-100';
                    } elseif ($anyPlayed) {
                        $boxBg = 'bg-white';
                    } else {
                        $boxBg = $isCurrentMonth ? 'bg-white' : 'bg-gray-400 text-gray-300';
                    }
                @endphp

                <div class="border p-1 h-32 overflow-auto relative {{ $boxBg }} {{ $isToday ? 'border-blue-500 bg-blue-50' : '' }} hover:bg-blue-100">
                    <div class="absolute top-1 right-2 text-xs font-bold">{{ $date->day }}</div>

                    <div class="mt-4 space-y-1">
                        @foreach($gamesToday as $game)
                            @php
                                $isHome = $game->home_team == $team->team_id;
                                $opponentTeam = $isHome ? $game->awayTeam : $game->homeTeam;
                                $opponent = $opponentTeam->name ?? 'Unknown';
                                $label = $isHome ? 'vs' : '@';

                                $isUnplayed = ($game->runs0 == 0 && $game->runs1 == 0);

                                // Format time as 7:49PM if unplayed
                                if ($isUnplayed) {
                                    $rawTime = str_pad($game->time, 4, '0', STR_PAD_LEFT);
                                    $dt = \DateTime::createFromFormat('Hi', $rawTime);
                                    $score = $dt ? $dt->format('g:ia') : $game->time;
                                } else {
                                    $score = "{$game->runs0}-{$game->runs1}";
                                }

                                $result = null;
                                if (!$isUnplayed) {
                                    $teamScore = $isHome ? $game->runs0 : $game->runs1;
                                    $opponentScore = $isHome ? $game->runs1 : $game->runs0;
                                    $result = $teamScore > $opponentScore ? 'Loss' : 'Win';
                                }

                                $bg = '';
                                if ($isUnplayed) {
                                    $bg = $isHome ? 'bg-[' . $team->background_color_id .'] text-[' . $team->text_color_id .'] ' : 'bg-gray-100';
                                } elseif ($game->played == 1) {
                                    $bg = 'bg-white';
                                }
                            @endphp
                            <a href="{{ route('games.boxscore', ['game' => $game->game_id]) }}">

                                <div class="flex items-center gap-2 px-1 py-0.5 rounded ">
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
                                <img src="/storage/images/team_logos/{{ $opponentTeam->small_logo }}"
                                     alt="{{ $opponent }}"
                                     class="w-10 object-contain" />
                            </a>

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
                    <div class="w-4 h-4 bg-[{{ $team->background_color_id }}] border border-[{{ $team->text_color_id }}] rounded-sm"></div>
                    <span>Home Game</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-4 h-4 bg-gray-100 border border-gray-400 rounded-sm"></div>
                    <span>Away Game</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-4 h-4 bg-white border border-gray-900 rounded-sm"></div>
                    <span>Played</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-4 h-4 bg-gray-400 border border-gray-900 rounded-sm"></div>
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
