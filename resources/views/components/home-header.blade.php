@props(['league'])
<div class="relative mb-4">
    <!-- Floating Image -->
    <div class="absolute left-0 top-0 z-10">
        <img src="{{ asset('storage/images/league_logos/' . $league->logo_file_name) }}" alt="Logo" class="w-32 h-32">
    </div>

    <!-- Main Content Box -->
    <div class="bg-[{{ $league->background_color_id }}] text-[{{ $league->text_color_id }}] flex flex-1 items-center justify-between pl-36 ">
        <div></div>
        <div>
            <div class="text-4xl font-bold mb-2 text-center">{{ $league->name }}</div>
            <div>
                <a href="{{ route('home') }}">Home</a> |
                <a href="{{ route('home.standings') }}">Standings</a> |
                <a href="{{ route('home.teams') }}">Teams</a>
            </div>
        </div>
        <div></div>
    </div>
</div>
