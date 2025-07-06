@extends('layouts.app')

@section('content')

@if($team)
    <x-team-header :team="$team" />
@endif




    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-2">{{ $player->first_name }} {{ $player->last_name }} {{ $player->nick_name ? '(' . $player->nick_name . ')' : '' }}
            #{{ $player->uniform_number }}
        </h1>
        @if($team)
            <h3 class="text-xl text-gray-700 ">
                Team:
                <a href="{{ route('teams.show', $team->team_id) }}" class="text-blue-600 hover:underline">
                    {{ $team->name }} {{ $team->nickname }}
                </a>
            </h3>
        @else
            <h3 class="text-xl text-gray-700 ">Team: Unassigned</h3>
        @endif

        <div class="md:flex md:flex1 justify-between w-full">
        <div>
        <h3 class="text-xl text-gray-700 ">
            Position: {{ $player->position ? $player->position_name : 'Unassigned' }}
        </h3>
        <h3 class="text-xl text-gray-700 ">
            Date Of Birth: {{ $player->date_of_birth?->format('F jS, Y') }} ({{ $player->age }} years old)
        </h3>
        <h3 class="text-xl text-gray-700 ">
            From: {{ $player->cityOfBirth?->name ?? 'Unknown' }}, {{ $player->cityOfBirth?->state->name ?? 'Unknown' }}
        </h3>
        <h3 class="text-xl text-gray-700 ">
            Height/Weight: {{ $player->height_ft_inches ?? 'Unknown' }}   {{ $player->weight ?? 'Unknown' }} lbs
        </h3>
        <h3 class="text-xl text-gray-700 ">
            Bats/Throws: {{ $player->bats_text ?? 'Unknown' }}/{{ $player->throws_text ?? 'Unknown' }}
        </h3>
        </div>
            <div class="mb-4">
                <a href="#career-batting" class="hover:text-blue-500 mr-4 font-bold">Career Batting</a>
                <a href="#career-pitching" class="hover:text-blue-500 mr-4 font-bold">Career Pitching</a>
                <a href="#career-fielding" class="hover:text-blue-500 mr-4 font-bold">Career Fielding</a>
                <a href="#awards" class="hover:text-blue-500 font-bold">Awards</a>
            </div>

            <div class="bg-cover bg-center flex items-end border border-2  " style="background-image: url('/storage/stadiums/{{ strtolower(str_replace(' ', '_', $team->park->name)) }}.png' );">
                <img src="/storage/images/person_pictures/player_{{ $player->player_id }}.png" alt="" class="max-h-full">
            </div>
        </div>

        <h2 class="text-2xl font-semibold mt-8 mb-2">Current Batting Stats</h2>
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

        <h2 class="text-2xl font-semibold mt-8 mb-2">Current Pitching Stats</h2>
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

        <h2 class="text-2xl font-semibold mt-8 mb-2">Current Fielding Stats</h2>
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

        <h2 id="career-batting" class="text-2xl font-semibold mt-8 mb-2">Career Batting Stats</h2>
        <table class="min-w-full border">
            <thead class="bg-gray-200 text-sm text-left">
            <tr>
                <th class="px-2 py-1">Year</th>
                <th class="px-2 py-1">League</th>
                <th class="px-2 py-1">Team</th>
                <th class="px-2 py-1">G</th>
                <th class="px-2 py-1">AB</th>
                <th class="px-2 py-1">R</th>
                <th class="px-2 py-1">H</th>
                <th class="px-2 py-1">2B</th>
                <th class="px-2 py-1">3B</th>
                <th class="px-2 py-1">HR</th>
                <th class="px-2 py-1">RBI</th>
                <th class="px-2 py-1">BB</th>
                <th class="px-2 py-1">SO</th>
                <th class="px-2 py-1">SB</th>
                <th class="px-2 py-1">CS</th>
                <th class="px-2 py-1">HP</th>
                <th class="px-2 py-1">AVG</th>
                <th class="px-2 py-1">OBP</th>
                <th class="px-2 py-1">SLG</th>
                <th class="px-2 py-1">OPS</th>
                <th class="px-2 py-1">WAR</th>
            </tr>
            </thead>
            <tbody class="text-sm">
            @foreach($careerBatting as $stat)
                @php
                    $avg = $stat->ab > 0 ? number_format($stat->h / $stat->ab, 3) : '.000';
                    $obp_denom = $stat->ab + $stat->bb + $stat->hbp + $stat->sf;
                    $obp = $obp_denom > 0 ? number_format(($stat->h + $stat->bb + $stat->hbp) / $obp_denom, 3) : '.000';
                    $singles = $stat->h - $stat->d - $stat->t - $stat->hr;
                    $total_bases = ($singles) + (2 * $stat->d) + (3 * $stat->t) + (4 * $stat->hr);
                    $slg = $stat->ab > 0 ? number_format($total_bases / $stat->ab, 3) : '.000';
                    $ops = number_format((float)$obp + (float)$slg, 3);
                @endphp
                <tr class="border-t {{ $stat->league_id != config('app.league_id') ? 'italic text-gray-400' : '' }}">
                    <td class="px-2 py-1">{{ $stat->year }}</td>
                    <td class="px-2 py-1">{{ $stat->league->abbr ?? '' }}</td>
                    <td class="px-2 py-1">{{ $stat->team->name ?? 'Unknown' }}</td>
                    <td class="px-2 py-1">{{ $stat->g }}</td>
                    <td class="px-2 py-1">{{ $stat->ab }}</td>
                    <td class="px-2 py-1">{{ $stat->r }}</td>
                    <td class="px-2 py-1">{{ $stat->h }}</td>
                    <td class="px-2 py-1">{{ $stat->d }}</td>
                    <td class="px-2 py-1">{{ $stat->t }}</td>
                    <td class="px-2 py-1">{{ $stat->hr }}</td>
                    <td class="px-2 py-1">{{ $stat->rbi }}</td>
                    <td class="px-2 py-1">{{ $stat->bb }}</td>
                    <td class="px-2 py-1">{{ $stat->k }}</td>
                    <td class="px-2 py-1">{{ $stat->sb }}</td>
                    <td class="px-2 py-1">{{ $stat->cs }}</td>
                    <td class="px-2 py-1">{{ $stat->hp }}</td>
                    <td class="px-2 py-1">{{ ltrim($avg, '0') }}</td>
                    <td class="px-2 py-1">{{ ltrim($obp, '0') }}</td>
                    <td class="px-2 py-1">{{ ltrim($slg, '0') }}</td>
                    <td class="px-2 py-1">{{ ltrim($ops, '0') }}</td>
                    <td class="px-2 py-1">{{ number_format($stat->war, 1) }}</td>
                </tr>
            @endforeach

            @php
                // Calculate career totals
    $totalLeagueCareer = $careerBatting->where('league_id', config('app.league_id'));

    $totalG = $totalLeagueCareer->sum('g');
    $totalAb = $totalLeagueCareer->sum('ab');
    $totalR = $totalLeagueCareer->sum('r');
    $totalH = $totalLeagueCareer->sum('h');
    $total2B = $totalLeagueCareer->sum('d');
    $total3B = $totalLeagueCareer->sum('t');
    $totalHR = $totalLeagueCareer->sum('hr');
    $totalRBI = $totalLeagueCareer->sum('rbi');
    $totalBB = $totalLeagueCareer->sum('bb');
    $totalK = $totalLeagueCareer->sum('k');
    $totalSB = $totalLeagueCareer->sum('sb');
    $totalCS = $totalLeagueCareer->sum('cs');
    $totalHP = $totalLeagueCareer->sum('hp');
    $totalHBP = $totalLeagueCareer->sum('hbp');
    $totalSF = $totalLeagueCareer->sum('sf');
    $totalWAR = $totalLeagueCareer->sum('war');

    $avg = $totalAb > 0 ? number_format($totalH / $totalAb, 3) : '.000';
    $obpDenom = $totalAb + $totalBB + $totalHBP + $totalSF;
    $obp = $obpDenom > 0 ? number_format(($totalH + $totalBB + $totalHBP) / $obpDenom, 3) : '.000';

    $singles = $totalH - $total2B - $total3B - $totalHR;
    $totalBases = $singles + 2 * $total2B + 3 * $total3B + 4 * $totalHR;
    $slg = $totalAb > 0 ? number_format($totalBases / $totalAb, 3) : '.000';
    $ops = number_format((float)$obp + (float)$slg, 3);


            @endphp

            <tr class="border-t bg-gray-100 font-semibold">
                <td class="px-2 py-1">Career {{ \App\Models\League::where('league_id', config('app.league_id'))->first()->abbr }} Totals</td>
                <td class="px-2 py-1"></td>
                <td class="px-2 py-1"></td>
                <td class="px-2 py-1">{{ $totalG }}</td>
                <td class="px-2 py-1">{{ $totalAb }}</td>
                <td class="px-2 py-1">{{ $totalR }}</td>
                <td class="px-2 py-1">{{ $totalH }}</td>
                <td class="px-2 py-1">{{ $total2B }}</td>
                <td class="px-2 py-1">{{ $total3B }}</td>
                <td class="px-2 py-1">{{ $totalHR }}</td>
                <td class="px-2 py-1">{{ $totalRBI }}</td>
                <td class="px-2 py-1">{{ $totalBB }}</td>
                <td class="px-2 py-1">{{ $totalK }}</td>
                <td class="px-2 py-1">{{ $totalSB }}</td>
                <td class="px-2 py-1">{{ $totalCS }}</td>
                <td class="px-2 py-1">{{ $totalHP }}</td>
                <td class="px-2 py-1">{{ ltrim($avg, '0') }}</td>
                <td class="px-2 py-1">{{ ltrim($obp, '0') }}</td>
                <td class="px-2 py-1">{{ ltrim($slg, '0') }}</td>
                <td class="px-2 py-1">{{ ltrim($ops, '0') }}</td>
                <td class="px-2 py-1">{{ number_format($totalWAR, 1) }}</td>
            </tr>
            </tbody>
        </table>


        <h2 id="career-pitching" class="text-2xl font-semibold mt-8 mb-2">Career Pitching Stats</h2>
        <table class="min-w-full border">
            <thead class="bg-gray-200 text-sm text-left">
            <tr>
                <th class="px-2 py-1">Year</th>
                <th class="px-2 py-1">League</th>
                <th class="px-2 py-1">Team</th>
                <th class="px-2 py-1">G</th>
                <th class="px-2 py-1">GS</th>
                <th class="px-2 py-1">W</th>
                <th class="px-2 py-1">L</th>
                <th class="px-2 py-1">S</th>
                <th class="px-2 py-1">IP</th>
                <th class="px-2 py-1">K</th>
                <th class="px-2 py-1">BB</th>
                <th class="px-2 py-1">ER</th>
                <th class="px-2 py-1">HRA</th>
                <th class="px-2 py-1">HP</th>
                <th class="px-2 py-1">ERA</th>
                <th class="px-2 py-1">WHIP</th>
                <th class="px-2 py-1">WAR</th>
            </tr>
            </thead>
            <tbody class="text-sm">
            @foreach($careerPitching as $stat)
                @php
                    $ip = $stat->ip ?? 0;
                    $era = $ip > 0 ? number_format(($stat->er * 9) / $ip, 2) : '0.00';
                    $whip = $ip > 0 ? number_format(($stat->bb + $stat->h) / $ip, 2) : '0.00';
                @endphp
                <tr class="border-t {{ $stat->league_id != config('app.league_id') ? 'italic text-gray-400' : '' }}">
                    <td class="px-2 py-1">{{ $stat->year }}</td>
                    <td class="px-2 py-1">{{ $stat->league->abbr ?? '' }}</td>
                    <td class="px-2 py-1">{{ $stat->team->name ?? 'Unknown' }}</td>
                    <td class="px-2 py-1">{{ $stat->g }}</td>
                    <td class="px-2 py-1">{{ $stat->gs }}</td>
                    <td class="px-2 py-1">{{ $stat->w }}</td>
                    <td class="px-2 py-1">{{ $stat->l }}</td>
                    <td class="px-2 py-1">{{ $stat->s }}</td>
                    <td class="px-2 py-1">{{ number_format($ip, 1) }}</td>
                    <td class="px-2 py-1">{{ $stat->k }}</td>
                    <td class="px-2 py-1">{{ $stat->bb }}</td>
                    <td class="px-2 py-1">{{ $stat->er }}</td>
                    <td class="px-2 py-1">{{ $stat->hra }}</td>
                    <td class="px-2 py-1">{{ $stat->hp }}</td>
                    <td class="px-2 py-1">{{ $era }}</td>
                    <td class="px-2 py-1">{{ $whip }}</td>
                    <td class="px-2 py-1">{{ number_format($stat->war, 1) }}</td>
                </tr>
            @endforeach

            @php
                $totalLeagueCareer = $careerPitching->where('league_id', config('app.league_id'));

                            $ip = $totalLeagueCareer->sum('ip') ?? 0;
                            $er = $totalLeagueCareer->sum('er');
                            $bb = $totalLeagueCareer->sum('bb');
                            $h = $totalLeagueCareer->sum('h');
                            $k = $totalLeagueCareer->sum('k');
                            $g = $totalLeagueCareer->sum('g');
                            $gs = $totalLeagueCareer->sum('gs');
                            $w = $totalLeagueCareer->sum('w');
                            $l = $totalLeagueCareer->sum('l');
                            $s = $totalLeagueCareer->sum('s');
                            $hra = $totalLeagueCareer->sum('hra');
                            $hp = $totalLeagueCareer->sum('hp');
                            $war = $totalLeagueCareer->sum('war');
                            $era = $ip > 0 ? number_format(($er * 9) / $ip, 2) : '0.00';
                            $whip = $ip > 0 ? number_format(($bb + $h) / $ip, 2) : '0.00';
            @endphp
            <tr class="border-t bg-gray-100 font-semibold">
                <td class="px-2 py-1">Career {{ \App\Models\League::where('league_id', config('app.league_id'))->first()->abbr }} Totals</td>
                <td class="px-2 py-1"></td>
                <td class="px-2 py-1"></td>
                <td class="px-2 py-1">{{ $g }}</td>
                <td class="px-2 py-1">{{ $gs }}</td>
                <td class="px-2 py-1">{{ $w }}</td>
                <td class="px-2 py-1">{{ $l }}</td>
                <td class="px-2 py-1">{{ $s }}</td>
                <td class="px-2 py-1">{{ number_format($ip, 1) }}</td>
                <td class="px-2 py-1">{{ $k }}</td>
                <td class="px-2 py-1">{{ $bb }}</td>
                <td class="px-2 py-1">{{ $er }}</td>
                <td class="px-2 py-1">{{ $hra }}</td>
                <td class="px-2 py-1">{{ $hp }}</td>
                <td class="px-2 py-1">{{ $era }}</td>
                <td class="px-2 py-1">{{ $whip }}</td>
                <td class="px-2 py-1">{{ number_format($war, 1) }}</td>
            </tr>
            </tbody>
        </table>
        <h2 id="career-fielding" class="text-2xl font-semibold mt-8 mb-2">Career Fielding Stats</h2>
        <table class="min-w-full border">
            <thead class="bg-gray-200 text-sm text-left">
            <tr>
                <th class="px-2 py-1">Year</th>
                <th class="px-2 py-1">League</th>
                <th class="px-2 py-1">Team</th>
                <th class="px-2 py-1">Position</th>
                <th class="px-2 py-1">G</th>
                <th class="px-2 py-1">PO</th>
                <th class="px-2 py-1">A</th>
                <th class="px-2 py-1">E</th>
                <th class="px-2 py-1">FPCT</th>
            </tr>
            </thead>
            <tbody class="text-sm">
            @foreach($careerFielding as $stat)
                @php
                    $fpct = ($stat->po + $stat->a + $stat->e) > 0
                        ? number_format(($stat->po + $stat->a) / ($stat->po + $stat->a + $stat->e), 3)
                        : '1.000';
                @endphp
                <tr class="border-t {{ $stat->league_id != config('app.league_id') ? 'italic text-gray-400' : '' }}">
                    <td class="px-2 py-1">{{ $stat->year }}</td>
                    <td class="px-2 py-1">{{ $stat->league->abbr ?? '' }}</td>
                    <td class="px-2 py-1">{{ $stat->team->name ?? 'Unknown' }}</td>
                    <td class="px-2 py-1">{{ $stat->position_name }}</td>
                    <td class="px-2 py-1">{{ $stat->g }}</td>
                    <td class="px-2 py-1">{{ $stat->po }}</td>
                    <td class="px-2 py-1">{{ $stat->a }}</td>
                    <td class="px-2 py-1">{{ $stat->e }}</td>
                    <td class="px-2 py-1">{{ ltrim($fpct, '0') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <h2 id="awards" class="text-2xl font-semibold mt-8 mb-2">Awards</h2>
        @if($awards->count())
            @php
                $season = '0000';
            @endphp
            <div class="mb-4">
                <ul class="list-disc list-inside text-gray-700">
                    @foreach($awards as $award)
                        @if ($season != $award->year)
                            @php
                                $season = $award->year;
                            @endphp
                            <li class="font-bold mt-2">{{ $season }}</li>
                        @endif
                        <li>
{{--                            {{ $award->award_id }}:--}}
{{--                            @if(!empty($award->year)) {{ $award->year }} @endif--}}
                            @if($award->finish != 1)
                                Finished {{ $award->finish . ordinal_suffix($award->finish) }}
                            @endif

                            {{ $award->awardname }}
                            @if(!empty($award->team)) ({{ $award->team->name }}) @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

    </div>
@php
    function ordinal_suffix($number) {
        if (!in_array(($number % 100), [11,12,13])){
            switch ($number % 10) {
                case 1:  return 'st';
                case 2:  return 'nd';
                case 3:  return 'rd';
            }
        }
        return 'th';
    }
@endphp
@endsection
