@extends('layouts.app')

@section('content')
<x-team-header :team="$team" />

<div class="container">
    <h1>{{ $team->name }} Schedule</h1>
    <div class="mb-3">
        <a href="{{ route('teams.show', $team->team_id) }}" class="btn btn-secondary">Back to Team</a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered calendar-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Opponent</th>
                    <th>Home/Away</th>
                    <th>Result</th>
                </tr>
            </thead>
            <tbody>
                @foreach($games as $game)
                    <tr>
                        <td>{{ $game->date->format('Y-m-d') }}</td>
                        <td>
                            @if($game->home_team == $team->team_id)
                                {{ $game->awayTeam->name }}
                            @else
                                {{ $game->homeTeam->name }}
                            @endif
                        </td>
                        <td>
                            {{ $game->home_team == $team->team_id ? 'Home' : 'Away' }}
                        </td>
                        <td>
                            @if($game->scores->count())
                                {{ $game->scores->first()->home_score }} - {{ $game->scores->first()->away_score }}
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
