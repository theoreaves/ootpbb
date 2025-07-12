@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-zinc-50 py-8">
    <div class="w-full max-w-xl bg-white rounded-xl shadow-lg p-8">
        <div class="flex flex-col items-center mb-6">
            <svg class="w-12 h-12 text-green-500 mb-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
            </svg>
            <h2 class="text-2xl font-semibold text-zinc-800 text-center">Upload Complete</h2>
            @if(isset($message))
                <p class="text-zinc-600 text-center mt-2">{{ $message }}</p>
            @endif
        </div>
        @if(isset($import_output))
            <div class="bg-zinc-100 rounded-lg p-4 mt-4 overflow-auto max-h-96">
                <h3 class="text-lg font-medium text-zinc-700 mb-2">Import Output</h3>
                <pre class="text-sm text-zinc-700 whitespace-pre-wrap">{{ $import_output }}</pre>
            </div>
        @endif
        <div class="mt-8 flex justify-center">
            <a href="{{ route('home') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg shadow transition">
                Site Home
            </a>
        </div>
    </div>
</div>
@endsection

