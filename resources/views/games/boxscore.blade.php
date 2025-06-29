@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-4">
            Box Score: {{ $game->awayTeam->name }} @ {{ $game->homeTeam->name }}
        </h1>
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
                                    <td class="border px-2 py-1 text-left">
                                        @if ($idx == 0)
                                            <span class="font-semibold">({{ $spotPlayer->spot }})</span>
                                        @else
                                            <span class="font-semibold">(-)</span>
                                        @endif
                                        {{ $batter->position_name }} - {{ $batter->player->name ?? 'Player #' . $batter->player_id }}
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
                                </tr>
                            @endif
                        @endforeach
                    @endforeach
                </tbody>
            </table>

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
                                    <td class="border px-2 py-1 text-left">
                                        @if ($idx == 0)
                                            <span class="font-semibold">({{ $spotPlayer->spot }})</span>
                                        @else
                                            <span class="font-semibold">(-)</span>
                                        @endif
                                        {{ $batter->position_name }} - {{ $batter->player->name ?? 'Player #' . $batter->player_id }}
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
                                </tr>
                            @endif
                        @endforeach
                    @endforeach
                </tbody>
            </table>
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
                            <td class="border px-2 py-1 text-left">
                                {{ $pitcher->player->name ?? 'Player #' . $pitcher->player_id }}
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
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>

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
                            <td class="border px-2 py-1 text-left">
                                {{ $pitcher->player->name ?? 'Player #' . $pitcher->player_id }}
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
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
