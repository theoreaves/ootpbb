@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-zinc-50 py-8">
    <div class="w-full max-w-md bg-white rounded-xl shadow-lg p-8">
        <div class="flex flex-col items-center mb-6">
            <svg class="w-12 h-12 text-blue-500 mb-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5-5m0 0l5 5m-5-5v12"/>
            </svg>
            <h2 class="text-2xl font-semibold text-zinc-800 text-center">Upload SQL ZIP File</h2>
            <p class="text-zinc-500 text-sm mt-1 text-center">Select a ZIP file containing your SQL files to process.</p>
        </div>
        <form action="{{ route('upload-zip-import') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div>
                <label for="sql_zip" class="block text-zinc-700 font-medium mb-2">ZIP File</label>
                <input type="file" id="sql_zip" name="sql_zip" accept=".zip" required
                    class="block w-full text-sm text-zinc-700 file:mr-4 file:py-2 file:px-4
                    file:rounded-lg file:border-0
                    file:text-sm file:font-semibold
                    file:bg-blue-50 file:text-blue-700
                    hover:file:bg-blue-100 transition"/>
            </div>
            <button type="submit"
                class="w-full flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 rounded-lg shadow transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5-5m0 0l5 5m-5-5v12"/>
                </svg>
                Upload and Process
            </button>
        </form>
    </div>
</div>
@endsection
