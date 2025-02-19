@extends('layouts.portfolio.app')

@section('title')
    {{ __('Skills') }}
@endsection

@section('breadcrumb')
    <li class="text-cyan-400">Skills</li>
@endsection

@section('content')
    <div class="mx-auto max-w-screen-lg px-3 py-6">
        <div class="mb-6 text-2xl font-bold">
            <div class="flex items-baseline justify-between">
                <div><span class="bg-gradient-to-br from-sky-500 to-cyan-400 bg-clip-text text-transparent">Skills</span></div>
            </div>
        </div>
        <div class="flex flex-col gap-6">
            <div class="grid md:grid-cols-2 grid-cols-1 gap-6">
                <x-skill-data :skills="$skills" />
            </div>
            <div class="mt-6">
                {{ $skills->links('vendor.pagination.tailwind-custom') }}
            </div>
        </div>
    </div>
@endsection

@section('styles')
@endsection

@section('scripts')
@endsection
