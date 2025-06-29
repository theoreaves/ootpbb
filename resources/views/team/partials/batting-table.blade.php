<h2 class="text-2xl font-bold mb-4">Batting Stats (vs All)</h2>
<div class="overflow-x-auto mb-8">
    <table class="min-w-full border">
        <thead class="bg-gray-200 text-sm text-left">
        <tr>
            <th class="px-2 py-1">Player</th>
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
        @foreach($battingStats as $stat)
            @php
                $avg = $stat->ab > 0 ? number_format($stat->h / $stat->ab, 3) : '.000';
                $obp_denom = $stat->ab + $stat->bb + $stat->hbp + $stat->sf;
                $obp = $obp_denom > 0 ? number_format(($stat->h + $stat->bb + $stat->hbp) / $obp_denom, 3) : '.000';
                $singles = $stat->h - $stat->d - $stat->t - $stat->hr;
                $total_bases = ($singles) + (2 * $stat->d) + (3 * $stat->t) + (4 * $stat->hr);
                $slg = $stat->ab > 0 ? number_format($total_bases / $stat->ab, 3) : '.000';
                $ops = number_format((float)$obp + (float)$slg, 3);
            @endphp
            <tr class="border-t">
                <td class="px-2 py-1 hover:text-blue-500"><a href="{{ route('players.show', $stat->player_id) }}">{{ $stat->player->name ?? 'Unknown' }}</a></td>
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
            $totalAb = $battingStats->sum('ab');
            $totalR = $battingStats->sum('r');
            $totalH = $battingStats->sum('h');
            $total2B = $battingStats->sum('d');
            $total3B = $battingStats->sum('t');
            $totalHR = $battingStats->sum('hr');
            $totalBB = $battingStats->sum('bb');
            $totalK = $battingStats->sum('k');
            $totalSB = $battingStats->sum('sb');
            $totalCS = $battingStats->sum('cs');
            $totalHP = $battingStats->sum('hp');
            $totalHBP = $battingStats->sum('hbp');
            $totalSF = $battingStats->sum('sf');
            $totalWAR = $battingStats->sum('war');

            $avg = $totalAb > 0 ? number_format($totalH / $totalAb, 3) : '.000';
            $obpDenom = $totalAb + $totalBB + $totalHBP + $totalSF;
            $obp = $obpDenom > 0 ? number_format(($totalH + $totalBB + $totalHBP) / $obpDenom, 3) : '.000';

            $singles = $totalH - $total2B - $total3B - $totalHR;
            $totalBases = $singles + 2 * $total2B + 3 * $total3B + 4 * $totalHR;
            $slg = $totalAb > 0 ? number_format($totalBases / $totalAb, 3) : '.000';
            $ops = number_format((float)$obp + (float)$slg, 3);
        @endphp

        <tr class="border-t bg-gray-100 font-semibold">
            <td class="px-2 py-1">Team Total</td>
            <td class="px-2 py-1"></td>
            <td class="px-2 py-1">{{ $totalAb }}</td>
            <td class="px-2 py-1">{{ $totalR }}</td>
            <td class="px-2 py-1">{{ $totalH }}</td>
            <td class="px-2 py-1">{{ $total2B }}</td>
            <td class="px-2 py-1">{{ $total3B }}</td>
            <td class="px-2 py-1">{{ $totalHR }}</td>
            <td class="px-2 py-1"></td>
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
</div>
