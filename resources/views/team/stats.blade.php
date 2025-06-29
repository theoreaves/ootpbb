@extends('layouts.app')

@section('content')
    <x-team-header :team="$team" />

    <div class="max-w-6xl mx-auto px-4 py-6">

        {{-- Dropdown Filters --}}
        <div class="mb-6">
            <form method="GET" action="{{ route('teams.stats', $team->team_id) }}" class="flex gap-4 items-center flex-wrap">
                <div>
                    <label for="year" class="font-semibold">Year:</label>
                    <select name="year" id="year" onchange="this.form.submit()" class="ml-2 px-2 py-1 border rounded">
                        @foreach($availableYears as $y)
                            <option value="{{ $y }}" {{ $y == $year ? 'selected' : '' }}>{{ $y }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="split" class="font-semibold">Split:</label>
                    <select name="split" id="split" onchange="this.form.submit()" class="ml-2 px-2 py-1 border rounded">
                        <option value="1" {{ $split == 1 ? 'selected' : '' }}>All</option>
                        <option value="2" {{ $split == 2 ? 'selected' : '' }}>vs Left</option>
                        <option value="3" {{ $split == 3 ? 'selected' : '' }}>vs Right</option>
                    </select>
                </div>
            </form>
        </div>

        {{-- Include your expanded tables here (same as before, with @foreach and totals logic) --}}
        @include('team.partials.batting-table', ['battingStats' => $battingStats])
        @include('team.partials.pitching-table', ['pitchingStats' => $pitchingStats])
        @include('team.partials.fielding-table', ['fieldingStats' => $fieldingStats])
    </div>
@endsection
