@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto px-4 py-6">
        {{-- Header with logos, team names, and scores --}}
        <div class="flex items-center justify-between mb-6 bg-[{{ $league->background_color_id }}] text-[{{ $league->text_color_id }}] ">
            <div class="flex items-center space-x-2">
                    <img src="/storage/images/team_logos/{{ $game->awayTeam->small_logo }}" alt="{{ $game->awayTeam->name }}" class="h-10 w-10 object-contain">
                <span class="font-bold text-lg">{{ $game->awayTeam->name }}</span>
                <span class="font-bold text-2xl">{{ $game->runs0 ?? 0 }}</span>
            </div>
            <h1 class="text-2xl font-bold mb-4">
                <a href="{{ route('home') }}">{{ $league->name }}</a>
            </h1>
            <div class="flex items-center space-x-2">
                <span class="font-bold text-2xl">{{ $game->runs1 ?? 0 }}</span>
                <span class="font-bold text-lg">{{ $game->homeTeam->name }}</span>
                <img src="/storage/images/team_logos/{{ $game->homeTeam->small_logo }}" alt="{{ $game->homeTeam->name }}" class="h-10 w-10 object-contain">
            </div>
        </div>

        <p class="mb-2">Date: {{ \Carbon\Carbon::parse($game->date)->format('F j, Y') }}</p>

        {{-- Line Score --}}
        <div class="overflow-x-auto mb-6">
            <table class="min-w-full border text-center">
                <thead>
                    <tr>
                        <th class="border px-2 py-1"></th>
                        @php
                            $innings = $game->scores->max('inning');
                        @endphp
                        @for ($i = 1; $i <= $innings; $i++)
                            <th class="border px-2 py-1">{{ $i }}</th>
                        @endfor
                        <th class="border px-2 py-1">R</th>
                        <th class="border px-2 py-1">H</th>
                        <th class="border px-2 py-1">E</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Away team: team == 0 --}}
                    <tr>
                        <td class="border px-2 py-1 font-bold text-left">{{ $game->awayTeam->name }}</td>
                        @for ($i = 1; $i <= $innings; $i++)
                            <td class="border px-2 py-1">
                                {{ optional($game->scores->where('team', 0)->where('inning', $i)->first())->score ?? '' }}
                            </td>
                        @endfor
                        <td class="border px-2 py-1 font-bold">
                            {{ $game->runs0 ?? 0 }}
                        </td>
                        <td class="border px-2 py-1">
                            {{ $game->hits0 ?? 0 }}
                        </td>
                        <td class="border px-2 py-1">
                            {{ $game->errors0 ?? 0 }}
                        </td>
                    </tr>
                    {{-- Home team: team == 1 --}}
                    <tr>
                        <td class="border px-2 py-1 font-bold text-left">{{ $game->homeTeam->name }}</td>
                        @for ($i = 1; $i <= $innings; $i++)
                            <td class="border px-2 py-1">
                                {{ optional($game->scores->where('team', 1)->where('inning', $i)->first())->score ?? '' }}
                            </td>
                        @endfor
                        <td class="border px-2 py-1 font-bold">
                            {{ $game->runs1 ?? 0 }}
                        </td>
                        <td class="border px-2 py-1">
                            {{ $game->hits1 ?? 0 }}
                        </td>
                        <td class="border px-2 py-1">
                            {{ $game->errors1 ?? 0 }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- Batting Stats --}}
        <div class="mb-6">
            <h2 class="font-semibold mb-2">{{ $game->awayTeam->name }} Batting</h2>
            <table class="min-w-full border text-center text-xs mb-4">
                <thead>
                    <tr>
                        <th class="border px-2 py-1">Player</th>
                        <th class="border px-2 py-1">AB</th>
                        <th class="border px-2 py-1">R</th>
                        <th class="border px-2 py-1">H</th>
                        <th class="border px-2 py-1">RBI</th>
                        <th class="border px-2 py-1">BB</th>
                        <th class="border px-2 py-1">K</th>
                        <th class="border px-2 py-1">AVG</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $away_batting = $game->batting->where('team_id', $game->awayTeam->team_id)->keyBy('player_id');
                        $away_spots = \App\Models\PlayersAtBatBattingStat::where('game_id', $game->game_id)
                            ->where('team_id', $game->awayTeam->team_id)
                            ->select('player_id', 'spot', 'inning')
                            ->orderBy('spot')
                            ->orderBy('inning')
                            ->get()
                            ->groupBy('spot');
                    @endphp
                    @foreach ($away_spots as $spot => $spotPlayers)
                        @php
                            $uniqueSpotPlayers = $spotPlayers->sortBy('inning')->unique('player_id')->values();
                        @endphp
                        @foreach ($uniqueSpotPlayers as $idx => $spotPlayer)
                            @php
                                $batter = $away_batting[$spotPlayer->player_id] ?? null;
                            @endphp
                            @if ($batter)
                                <tr>
                                    <td class="border px-2 py-1 text-left hover:text-blue-500">
                                        @if ($idx == 0)
                                            <span class="font-semibold">({{ $spotPlayer->spot }})</span>
                                        @else
                                            <span class="font-semibold">(-)</span>
                                        @endif
                                            <a href="{{ route('players.show', $batter->player_id) }}">
                                        {{ $batter->position_name }} - {{ $batter->player->name ?? 'Player #' . $batter->player_id }}
                                            </a>
                                        @if ($idx > 0)
                                            <span class="text-xs text-gray-500">(sub)</span>
                                        @endif
                                    </td>
                                    <td class="border px-2 py-1">{{ $batter->ab }}</td>
                                    <td class="border px-2 py-1">{{ $batter->r }}</td>
                                    <td class="border px-2 py-1">{{ $batter->h }}</td>
                                    <td class="border px-2 py-1">{{ $batter->rbi }}</td>
                                    <td class="border px-2 py-1">{{ $batter->bb }}</td>
                                    <td class="border px-2 py-1">{{ $batter->k }}</td>
                                    <td class="border px-2 py-1">{{ ltrim(number_format($batter->post_game_average, 3), 0) }}</td>
                                </tr>
                            @endif
                        @endforeach
                    @endforeach
                </tbody>
            </table>
            {{-- HR/RBI/SB/CS summary for away team --}}
            @php
                $away_batters_stats = $game->batting->where('team_id', $game->awayTeam->team_id);
                $away_hr = $away_batters_stats->filter(fn($b) => $b->hr > 0);
                $away_rbi = $away_batters_stats->filter(fn($b) => $b->rbi > 0);
                $away_sb = $away_batters_stats->filter(fn($b) => $b->sb > 0);
                $away_cs = $away_batters_stats->filter(fn($b) => $b->cs > 0);
            @endphp
            <div class="mb-4 text-xs">
                @if($away_hr->count())
                    <div><span class="font-semibold">HR:</span>
                        @foreach($away_hr as $b)
                            {{ $b->player->name ?? 'Player #'.$b->player_id }}{{ $b->hr > 1 ? ' ('.$b->hr.')' : '' }}@if(!$loop->last), @endif
                        @endforeach
                    </div>
                @endif
                @if($away_rbi->count())
                    <div><span class="font-semibold">RBI:</span>
                        @foreach($away_rbi as $b)
                            {{ $b->player->name ?? 'Player #'.$b->player_id }}{{ $b->rbi > 1 ? ' ('.$b->rbi.')' : '' }}@if(!$loop->last), @endif
                        @endforeach
                    </div>
                @endif
                @if($away_sb->count())
                    <div><span class="font-semibold">SB:</span>
                        @foreach($away_sb as $b)
                            {{ $b->player->name ?? 'Player #'.$b->player_id }}{{ $b->sb > 1 ? ' ('.$b->sb.')' : '' }}@if(!$loop->last), @endif
                        @endforeach
                    </div>
                @endif
                @if($away_cs->count())
                    <div><span class="font-semibold">CS:</span>
                        @foreach($away_cs as $b)
                            {{ $b->player->name ?? 'Player #'.$b->player_id }}{{ $b->cs > 1 ? ' ('.$b->cs.')' : '' }}@if(!$loop->last), @endif
                        @endforeach
                    </div>
                @endif
            </div>

            <h2 class="font-semibold mb-2">{{ $game->homeTeam->name }} Batting</h2>
            <table class="min-w-full border text-center text-xs">
                <thead>
                    <tr>
                        <th class="border px-2 py-1">Player</th>
                        <th class="border px-2 py-1">AB</th>
                        <th class="border px-2 py-1">R</th>
                        <th class="border px-2 py-1">H</th>
                        <th class="border px-2 py-1">RBI</th>
                        <th class="border px-2 py-1">BB</th>
                        <th class="border px-2 py-1">K</th>
                        <th class="border px-2 py-1">AVG</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $home_batting = $game->batting->where('team_id', $game->homeTeam->team_id)->keyBy('player_id');
                        $home_spots = \App\Models\PlayersAtBatBattingStat::where('game_id', $game->game_id)
                            ->where('team_id', $game->homeTeam->team_id)
                            ->select('player_id', 'spot', 'inning')
                            ->orderBy('spot')
                            ->orderBy('inning')
                            ->get()
                            ->groupBy('spot');
                    @endphp
                    @foreach ($home_spots as $spot => $spotPlayers)
                        @php
                            $uniqueSpotPlayers = $spotPlayers->sortBy('inning')->unique('player_id')->values();
                        @endphp
                        @foreach ($uniqueSpotPlayers as $idx => $spotPlayer)
                            @php
                                $batter = $home_batting[$spotPlayer->player_id] ?? null;
                            @endphp
                            @if ($batter)
                                <tr>
                                    <td class="border px-2 py-1 text-left hover:text-blue-500">
                                        @if ($idx == 0)
                                            <span class="font-semibold">({{ $spotPlayer->spot }})</span>
                                        @else
                                            <span class="font-semibold">(-)</span>
                                        @endif
                                            <a href="{{ route('players.show', $batter->player_id) }}">
                                        {{ $batter->position_name }} - {{ $batter->player->name ?? 'Player #' . $batter->player_id }}
                                            </a>
                                        @if ($idx > 0)
                                            <span class="text-xs text-gray-500">(sub)</span>
                                        @endif
                                    </td>
                                    <td class="border px-2 py-1">{{ $batter->ab }}</td>
                                    <td class="border px-2 py-1">{{ $batter->r }}</td>
                                    <td class="border px-2 py-1">{{ $batter->h }}</td>
                                    <td class="border px-2 py-1">{{ $batter->rbi }}</td>
                                    <td class="border px-2 py-1">{{ $batter->bb }}</td>
                                    <td class="border px-2 py-1">{{ $batter->k }}</td>
                                    <td class="border px-2 py-1">{{ ltrim(number_format($batter->post_game_average, 3), 0) }}</td>
                                </tr>
                            @endif
                        @endforeach
                    @endforeach
                </tbody>
            </table>
            {{-- HR/RBI/SB/CS summary for home team --}}
            @php
                $home_batters_stats = $game->batting->where('team_id', $game->homeTeam->team_id);
                $home_hr = $home_batters_stats->filter(fn($b) => $b->hr > 0);
                $home_rbi = $home_batters_stats->filter(fn($b) => $b->rbi > 0);
                $home_sb = $home_batters_stats->filter(fn($b) => $b->sb > 0);
                $home_cs = $home_batters_stats->filter(fn($b) => $b->cs > 0);
            @endphp
            <div class="mb-4 text-xs">
                @if($home_hr->count())
                    <div><span class="font-semibold">HR:</span>
                        @foreach($home_hr as $b)
                            {{ $b->player->name ?? 'Player #'.$b->player_id }}{{ $b->hr > 1 ? ' ('.$b->hr.')' : '' }}@if(!$loop->last), @endif
                        @endforeach
                    </div>
                @endif
                @if($home_rbi->count())
                    <div><span class="font-semibold">RBI:</span>
                        @foreach($home_rbi as $b)
                            {{ $b->player->name ?? 'Player #'.$b->player_id }}{{ $b->rbi > 1 ? ' ('.$b->rbi.')' : '' }}@if(!$loop->last), @endif
                        @endforeach
                    </div>
                @endif
                @if($home_sb->count())
                    <div><span class="font-semibold">SB:</span>
                        @foreach($home_sb as $b)
                            {{ $b->player->name ?? 'Player #'.$b->player_id }}{{ $b->sb > 1 ? ' ('.$b->sb.')' : '' }}@if(!$loop->last), @endif
                        @endforeach
                    </div>
                @endif
                @if($home_cs->count())
                    <div><span class="font-semibold">CS:</span>
                        @foreach($home_cs as $b)
                            {{ $b->player->name ?? 'Player #'.$b->player_id }}{{ $b->cs > 1 ? ' ('.$b->cs.')' : '' }}@if(!$loop->last), @endif
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        {{-- Pitching Stats --}}
        <div class="mb-6">
            <h2 class="font-semibold mb-2">{{ $game->awayTeam->name }} Pitching</h2>
            <table class="min-w-full border text-center text-xs mb-4">
                <thead>
                    <tr>
                        <th class="border px-2 py-1">Pitcher</th>
                        <th class="border px-2 py-1">IP</th>
                        <th class="border px-2 py-1">H</th>
                        <th class="border px-2 py-1">R</th>
                        <th class="border px-2 py-1">ER</th>
                        <th class="border px-2 py-1">BB</th>
                        <th class="border px-2 py-1">K</th>
                        <th class="border px-2 py-1">ERA</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        // Find pitching order for away team (pitchers who pitched against home team)
                        $away_pitching_order = \App\Models\PlayersAtBatBattingStat::where('game_id', $game->game_id)
                            ->where('team_id', $game->homeTeam->team_id)
                            ->whereNotNull('opponent_player_id')
                            ->orderBy('inning')
                            ->orderBy('spot')
                            ->pluck('opponent_player_id')
                            ->unique()
                            ->values();

                        $away_pitchers = $game->pitching->where('team_id', $game->awayTeam->team_id)
                            ->keyBy('player_id');
                    @endphp
                    @foreach ($away_pitching_order as $pitcher_id)
                        @php $pitcher = $away_pitchers[$pitcher_id] ?? null; @endphp
                        @if ($pitcher)
                        <tr>
                            <td class="border px-2 py-1 text-left hover:text-blue-500">
                                <a href="{{ route('players.show', $pitcher->player_id) }}">
                                {{ $pitcher->player->name ?? 'Player #' . $pitcher->player_id }}
                                </a>
                                @if ($pitcher->w == 1)
                                    <span class="text-xs text-green-700 font-semibold">(W)</span>
                                @endif
                                @if ($pitcher->l == 1)
                                    <span class="text-xs text-red-700 font-semibold">(L)</span>
                                @endif
                                @if ($pitcher->s == 1)
                                    <span class="text-xs text-blue-700 font-semibold">(S)</span>
                                @endif
                                @if ($pitcher->hld == 1)
                                    <span class="text-xs text-blue-700 font-semibold">(H)</span>
                                @endif
                                @if ($pitcher->bs == 1)
                                    <span class="text-xs text-blue-700 font-semibold">(BS)</span>
                                @endif
                            </td>
                            <td class="border px-2 py-1">
                                @php
                                    $ip = intval($pitcher->outs / 3) . '.' . ($pitcher->outs % 3);
                                @endphp
                                {{ $ip }}
                            </td>
                            <td class="border px-2 py-1">{{ $pitcher->ha }}</td>
                            <td class="border px-2 py-1">{{ $pitcher->r }}</td>
                            <td class="border px-2 py-1">{{ $pitcher->er }}</td>
                            <td class="border px-2 py-1">{{ $pitcher->bb }}</td>
                            <td class="border px-2 py-1">{{ $pitcher->k }}</td>
                            <td class="border px-2 py-1">{{ $pitcher->post_game_era }}</td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
            {{-- Pitching summary for away team --}}
            @php
                $away_pitchers_stats = $game->pitching->where('team_id', $game->awayTeam->team_id);
                $away_pi = $away_pitchers_stats->filter(fn($p) => $p->pi > 0);
                $away_bf = $away_pitchers_stats->filter(fn($p) => $p->bf > 0);
                $away_wp = $away_pitchers_stats->filter(fn($p) => $p->wp > 0);
                $away_hp = $away_pitchers_stats->filter(fn($p) => $p->hp > 0);
            @endphp
            <div class="mb-4 text-xs">
                @if($away_pi->count())
                    <div><span class="font-semibold">Pitches Thrown (PI):</span>
                        @foreach($away_pi as $p)
                            {{ $p->player->name ?? 'Player #'.$p->player_id }}{{ $p->pi > 1 ? ' ('.$p->pi.')' : '' }}@if(!$loop->last), @endif
                        @endforeach
                    </div>
                @endif
                @if($away_bf->count())
                    <div><span class="font-semibold">Batters Faced (BF):</span>
                        @foreach($away_bf as $p)
                            {{ $p->player->name ?? 'Player #'.$p->player_id }}{{ $p->bf > 1 ? ' ('.$p->bf.')' : '' }}@if(!$loop->last), @endif
                        @endforeach
                    </div>
                @endif
                @if($away_wp->count())
                    <div><span class="font-semibold">Wild Pitches (WP):</span>
                        @foreach($away_wp as $p)
                            {{ $p->player->name ?? 'Player #'.$p->player_id }}{{ $p->wp > 1 ? ' ('.$p->wp.')' : '' }}@if(!$loop->last), @endif
                        @endforeach
                    </div>
                @endif
                @if($away_hp->count())
                    <div><span class="font-semibold">Hit Batters (HP):</span>
                        @foreach($away_hp as $p)
                            {{ $p->player->name ?? 'Player #'.$p->player_id }}{{ $p->hp > 1 ? ' ('.$p->hp.')' : '' }}@if(!$loop->last), @endif
                        @endforeach
                    </div>
                @endif
            </div>

            <h2 class="font-semibold mb-2">{{ $game->homeTeam->name }} Pitching</h2>
            <table class="min-w-full border text-center text-xs">
                <thead>
                    <tr>
                        <th class="border px-2 py-1">Pitcher</th>
                        <th class="border px-2 py-1">IP</th>
                        <th class="border px-2 py-1">H</th>
                        <th class="border px-2 py-1">R</th>
                        <th class="border px-2 py-1">ER</th>
                        <th class="border px-2 py-1">BB</th>
                        <th class="border px-2 py-1">K</th>
                        <th class="border px-2 py-1">ERA</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        // Find pitching order for home team (pitchers who pitched against away team)
                        $home_pitching_order = \App\Models\PlayersAtBatBattingStat::where('game_id', $game->game_id)
                            ->where('team_id', $game->awayTeam->team_id)
                            ->whereNotNull('opponent_player_id')
                            ->orderBy('inning')
                            ->orderBy('spot')
                            ->pluck('opponent_player_id')
                            ->unique()
                            ->values();

                        $home_pitchers = $game->pitching->where('team_id', $game->homeTeam->team_id)
                            ->keyBy('player_id');
                    @endphp
                    @foreach ($home_pitching_order as $pitcher_id)
                        @php $pitcher = $home_pitchers[$pitcher_id] ?? null; @endphp
                        @if ($pitcher)
                        <tr>
                            <td class="border px-2 py-1 text-left hover:text-blue-500">
                                <a href="{{ route('players.show', $pitcher->player_id) }}">
                                {{ $pitcher->player->name ?? 'Player #' . $pitcher->player_id }}
                                </a>
                                @if ($pitcher->w == 1)
                                    <span class="text-xs text-green-700 font-semibold">(W)</span>
                                @endif
                                @if ($pitcher->l == 1)
                                    <span class="text-xs text-red-700 font-semibold">(L)</span>
                                @endif
                                @if ($pitcher->s == 1)
                                    <span class="text-xs text-blue-700 font-semibold">(S)</span>
                                @endif
                                @if ($pitcher->hld == 1)
                                    <span class="text-xs text-blue-700 font-semibold">(H)</span>
                                @endif
                                @if ($pitcher->bs == 1)
                                    <span class="text-xs text-blue-700 font-semibold">(BS)</span>
                                @endif
                            </td>
                            <td class="border px-2 py-1">
                                @php
                                    $ip = intval($pitcher->outs / 3) . '.' . ($pitcher->outs % 3);
                                @endphp
                                {{ $ip }}
                            </td>
                            <td class="border px-2 py-1">{{ $pitcher->ha }}</td>
                            <td class="border px-2 py-1">{{ $pitcher->r }}</td>
                            <td class="border px-2 py-1">{{ $pitcher->er }}</td>
                            <td class="border px-2 py-1">{{ $pitcher->bb }}</td>
                            <td class="border px-2 py-1">{{ $pitcher->k }}</td>
                            <td class="border px-2 py-1">{{ $pitcher->post_game_era }}</td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
            {{-- Pitching summary for home team --}}
            @php
                $home_pitchers_stats = $game->pitching->where('team_id', $game->homeTeam->team_id);
                $home_pi = $home_pitchers_stats->filter(fn($p) => $p->pi > 0);
                $home_bf = $home_pitchers_stats->filter(fn($p) => $p->bf > 0);
                $home_wp = $home_pitchers_stats->filter(fn($p) => $p->wp > 0);
                $home_hp = $home_pitchers_stats->filter(fn($p) => $p->hp > 0);
            @endphp
            <div class="mb-4 text-xs">
                @if($home_pi->count())
                    <div><span class="font-semibold">Pitches Thrown (PI):</span>
                        @foreach($home_pi as $p)
                            {{ $p->player->name ?? 'Player #'.$p->player_id }}{{ $p->pi > 1 ? ' ('.$p->pi.')' : '' }}@if(!$loop->last), @endif
                        @endforeach
                    </div>
                @endif
                @if($home_bf->count())
                    <div><span class="font-semibold">Batters Faced (BF):</span>
                        @foreach($home_bf as $p)
                            {{ $p->player->name ?? 'Player #'.$p->player_id }}{{ $p->bf > 1 ? ' ('.$p->bf.')' : '' }}@if(!$loop->last), @endif
                        @endforeach
                    </div>
                @endif
                @if($home_wp->count())
                    <div><span class="font-semibold">Wild Pitches (WP):</span>
                        @foreach($home_wp as $p)
                            {{ $p->player->name ?? 'Player #'.$p->player_id }}{{ $p->wp > 1 ? ' ('.$p->wp.')' : '' }}@if(!$loop->last), @endif
                        @endforeach
                    </div>
                @endif
                @if($home_hp->count())
                    <div><span class="font-semibold">Hit Batters (HP):</span>
                        @foreach($home_hp as $p)
                            {{ $p->player->name ?? 'Player #'.$p->player_id }}{{ $p->hp > 1 ? ' ('.$p->hp.')' : '' }}@if(!$loop->last), @endif
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
