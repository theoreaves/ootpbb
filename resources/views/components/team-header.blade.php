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
            <div>
                <a href="{{ route('home') }}">League Home</a> |
                <a href="{{ route('teams.show', ['team' => $team->team_id]) }}">{{ $team->nickname }} Home</a> |
                <a href="{{ route('teams.roster', ['team' => $team->team_id]) }}">Roster</a> |
                <a href="{{ route('teams.stats', ['team' => $team->team_id]) }}">Stats</a> |
                <a href="{{ route('teams.schedule', $team->team_id) }}">Schedule</a> |
                <a href="{{ route('teams.stadium', $team->team_id) }}">{{ $team->park->name }}</a>
            </div>
        </div>
        <div></div>
    </div>
</div>

