@extends('layouts.portfolio.app')

@section('title')
    {{ __('Posts') }}
@endsection

@section('breadcrumb')
    <li class="text-cyan-400">Posts</li>
@endsection

@section('content')
    <div class="mx-auto max-w-screen-lg px-3 py-6">
        <div class="mb-6 text-2xl font-bold">
            <div class="flex items-baseline justify-between">
                <div><span class="bg-gradient-to-br from-sky-500 to-cyan-400 bg-clip-text text-transparent">Posts</span></div>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-6 md:grid-cols-3">
            <x-post-data :posts="$posts" :user="$user" />
        </div>
        <div class="mt-6">
            {{ $posts->links('vendor.pagination.tailwind-custom') }}
        </div>
    </div>
@endsection

@section('styles')
@endsection

@section('scripts')
@endsection
