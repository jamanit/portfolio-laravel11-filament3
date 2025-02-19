@extends('layouts.portfolio.app')

@section('title')
    {{ __('Project Detail') }}
@endsection

@section('breadcrumb')
    <li class="hover:text-cyan-400"><a href="{{ route('project', ['username' => $user->username]) }}" target="_self">Projects</a></li>
    <li class="text-cyan-400">Detail</li>
@endsection

@section('content')
    <div class="mx-auto max-w-screen-lg px-3 py-6">
        <div class="mx-auto mt-5 max-w-prose">
            <div class="aspect-w-3 aspect-h-2">
                @if ($project->image)
                    <a href="{{ Storage::url($project->image) }}" data-fancybox="gallery" data-caption="{{ $project->title }}" target="_blank">
                        <img class="h-full w-full rounded-lg object-cover object-center" src="{{ Storage::url($project->image) }}" alt="{{ $project->title }}" loading="lazy" />
                    </a>
                @else
                    <a href="{{ asset('/') }}astro-boilerplate/assets/images/image-post.jpeg" data-fancybox="gallery" data-caption="{{ $project->title }}" target="_blank">
                        <img class="h-full w-full rounded-lg object-cover object-center" src="{{ asset('/') }}astro-boilerplate/assets/images/image-post.jpeg" alt="{{ $project->title }}" loading="lazy" />
                    </a>
                @endif
            </div>
            <h1 class="mt-2 text-2xl font-bold">{{ $project->title }}</h1>
            <div class="mt-2 text-sm text-gray-400">{{ $project->created_at }}</div>
            <div class="mt-2 flex flex-wrap gap-2">
                @if ($project->category->name)
                    <div class="rounded-md px-2 py-1 text-xs font-semibold bg-fuchsia-400 text-fuchsia-900 text-nowrap">{{ $project->category->name }}</div>
                @endif
                <div class="rounded-md px-2 py-1 text-xs font-semibold bg-sky-400 text-sky-900 text-nowrap">{{ $project->status }}</div>
            </div>
            <div class="mt-8 prose prose-invert prose-img:rounded-lg">
                {!! $project->description !!}
            </div>
            <div class="mt-6 flex flex-wrap gap-2">
                <div class="rounded-md px-2 py-1 text-xs font-semibold bg-fuchsia-400 text-fuchsia-900">Astro.js</div>
                <div class="rounded-md px-2 py-1 text-xs font-semibold bg-lime-400 text-lime-900">Web design</div>
                <div class="rounded-md px-2 py-1 text-xs font-semibold bg-sky-400 text-sky-900">Tailwind.css</div>
                <div class="rounded-md px-2 py-1 text-xs font-semibold bg-rose-400 text-rose-900">TypeScript</div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
@endsection

@section('scripts')
@endsection
