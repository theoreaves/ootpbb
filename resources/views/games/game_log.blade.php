@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto px-4 py-6">




        {{-- Header with logos, team names, and scores --}}
        <div class="flex items-center justify-between mb-6 bg-[{{ $league->background_color_id }}] text-[{{ $league->text_color_id }}] p-5 ">
            <div class="flex items-center space-x-2">
                <img src="/storage/images/team_logos/{{ $game->awayTeam->small_logo }}" alt="{{ $game->awayTeam->name }}" class="h-10 w-10 object-contain">
                <span class="font-bold text-lg hover:text-blue-500"><a href="{{ route('teams.show', $game->awayTeam->team_id) }}">{{ $game->awayTeam->name }}</a></span>
                <span class="font-bold text-2xl">{{ $game->runs0 ?? 0 }}</span>
            </div>
            <h1 class="text-2xl font-bold mb-4">
                <a href="{{ route('home') }}">{{ $league->name }}</a>
            </h1>
            <div class="flex items-center space-x-2">
                <span class="font-bold text-2xl">{{ $game->runs1 ?? 0 }}</span>
                <span class="font-bold text-lg hover:text-blue-500"><a href="{{ route('teams.show', $game->homeTeam->team_id) }}">{{ $game->homeTeam->name }}</a></span>
                <img src="/storage/images/team_logos/{{ $game->homeTeam->small_logo }}" alt="{{ $game->homeTeam->name }}" class="h-10 w-10 object-contain">
            </div>
        </div>



        {{-- Game Log --}}
        <div class="flex flex-1 justify-between">
            <div class="mb-2 font-bold">
                @php
                    $rawTime = str_pad($game->time, 4, '0', STR_PAD_LEFT);
                    $dt = \DateTime::createFromFormat('Hi', $rawTime);
                    $showTime = $dt ? $dt->format('g:ia') : $game->time;
                @endphp
                {{ \Carbon\Carbon::parse($game->date)->format('F j, Y') }}, {{ $showTime }}
            </div>






            <div class="mb-2 font-bold">
                <a class="underline hover:text-blue-500" href="{{ route('games.boxscore', $game->game_id) }}">Box Score</a> | GAME LOG
            </div>
            <div class="mb-2 font-bold">
            </div>
        </div>
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

        <table>
        @foreach($gameLog as $log)
            <tr class="{{ $log->type==3 ? 'border-x ' : 'border' }}">
                @if($log->type == 1)
                    <td class="bg-gray-500 text-gray-100 font-bold text-xl">{!! $log->text_converted !!}</td>
                @elseif($log->type == 2)
                    <td class="text-gray-700 bg-gray-300 font-semibold">{!! $log->text_converted !!}</td>
                @elseif($log->type == 3)
                    <td class="text-gray-700 font-semibold">{!! $log->text_converted !!}</td>
                @elseif($log->type == 4)
                    <td class="text-gray-700 bg-black text-white font-bold">{!! $log->text_converted !!}</td>
                @endif
            </tr>
        @endforeach
        </table>


    </div>
@endsection
