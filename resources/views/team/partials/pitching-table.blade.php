
<h2 class="text-2xl font-bold mb-4">Pitching Stats (vs All)</h2>
<div class="overflow-x-auto mb-8">
    <table class="min-w-full border">
        <thead class="bg-gray-200 text-sm text-left">
        <tr>
            <th class="px-2 py-1">Player</th>
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
        @foreach($pitchingStats as $stat)
            @php
                $ip = $stat->ip ?? 0;
                $era = $ip > 0 ? number_format(($stat->er * 9) / $ip, 2) : '0.00';
                $whip = $ip > 0 ? number_format(($stat->bb + $stat->h) / $ip, 2) : '0.00';
            @endphp
            <tr class="border-t">
                <td class="px-2 py-1 hover:text-blue-500"><a href="{{ route('players.show', $stat->player_id) }}">{{ $stat->player->name ?? 'Unknown' }}</a></td>
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
            $ip = $pitchingStats->sum('ip') ?? 0;
            $er = $pitchingStats->sum('er');
            $bb = $pitchingStats->sum('bb');
            $h = $pitchingStats->sum('h');
            $k = $pitchingStats->sum('k');
            $g = $pitchingStats->sum('g');
            $gs = $pitchingStats->sum('gs');
            $w = $pitchingStats->sum('w');
            $l = $pitchingStats->sum('l');
            $s = $pitchingStats->sum('s');
            $hra = $pitchingStats->sum('hra');
            $hp = $pitchingStats->sum('hp');
            $war = $pitchingStats->sum('war');
            $era = $ip > 0 ? number_format(($er * 9) / $ip, 2) : '0.00';
            $whip = $ip > 0 ? number_format(($bb + $h) / $ip, 2) : '0.00';
        @endphp
        <tr class="border-t bg-gray-100 font-semibold">
            <td class="px-2 py-1">Team Total</td>
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
</div>

