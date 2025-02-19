@extends('layouts.portfolio.app')

@section('title')
    {{ __('Projects') }}
@endsection

@section('breadcrumb')
    <li class="text-cyan-400">Projects</li>
@endsection

@section('content')
    <div class="mx-auto max-w-screen-lg px-3 py-6">
        <div class="mb-6 text-2xl font-bold">
            <div class="flex items-baseline justify-between">
                <div><span class="bg-gradient-to-br from-sky-500 to-cyan-400 bg-clip-text text-transparent">Projects</span>
                </div>
            </div>
        </div>
        <div class="flex flex-col gap-6">
            <x-project-data :projects="$projects" :user="$user" />
        </div>
        <div class="mt-6">
            {{ $projects->links('vendor.pagination.tailwind-custom') }}
        </div>
    </div>
@endsection

@section('styles')
@endsection

@section('scripts')
@endsection
