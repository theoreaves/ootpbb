<h2 class="text-2xl font-bold mb-4">Fielding Stats (vs All)</h2>
<div class="overflow-x-auto mb-8">
    <table class="min-w-full border">
        <thead class="bg-gray-200 text-sm text-left">
        <tr>
            <th class="px-2 py-1">Player</th>
            <th class="px-2 py-1">G</th>
            <th class="px-2 py-1">PO</th>
            <th class="px-2 py-1">A</th>
            <th class="px-2 py-1">E</th>
            <th class="px-2 py-1">FPCT</th>
        </tr>
        </thead>
        <tbody class="text-sm">
        @foreach($fieldingStats as $stat)
            @php
                $fpct = ($stat->po + $stat->a + $stat->e) > 0
                    ? number_format(($stat->po + $stat->a) / ($stat->po + $stat->a + $stat->e), 3)
                    : '1.000';
            @endphp
            <tr class="border-t">
                <td class="px-2 py-1 hover:text-blue-500"><a href="{{ route('players.show', $stat->player_id) }}">{{ $stat->player->name ?? 'Unknown' }}</a></td>
                <td class="px-2 py-1">{{ $stat->g }}</td>
                <td class="px-2 py-1">{{ $stat->po }}</td>
                <td class="px-2 py-1">{{ $stat->a }}</td>
                <td class="px-2 py-1">{{ $stat->e }}</td>
                <td class="px-2 py-1">{{ ltrim($fpct, '0') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
