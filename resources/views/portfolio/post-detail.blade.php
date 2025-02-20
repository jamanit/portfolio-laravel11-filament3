@extends('layouts.portfolio.app')

@section('title')
    {{ __('Post Detail') }}
@endsection

@section('breadcrumb')
    <li class="hover:text-cyan-400"><a href="{{ route('post', ['username' => $user->username]) }}" target="_self">Posts</a></li>
    <li class="text-cyan-400">Detail</li>
@endsection

@section('content')
    <div class="mx-auto max-w-screen-lg px-3 py-6">
        <div class="mx-auto mt-5 max-w-prose">
            <div class="aspect-w-3 aspect-h-2">
                @if ($post->image)
                    <a href="{{ Storage::url($post->image) }}" data-fancybox="gallery" data-caption="{{ $post->title }}" target="_blank">
                        <img class="h-full w-full rounded-lg object-cover object-center" src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}" loading="lazy" />
                    </a>
                @else
                    <a href="{{ asset('/') }}astro-boilerplate/assets/images/image-post2.jpeg" data-fancybox="gallery" data-caption="{{ $post->title }}" target="_blank">
                        <img class="h-full w-full rounded-lg object-cover object-center" src="{{ asset('/') }}astro-boilerplate/assets/images/image-post2.jpeg" alt="{{ $post->title }}" loading="lazy" />
                    </a>
                @endif
            </div>
            <h1 class="mt-2 text-2xl font-bold">{{ $post->title }}</h1>
            <div class="mt-2 text-sm text-gray-400">{{ $post->created_at }} <span class="ml-4">{{ $post->total_view }} views</span></div>
            <div class="mt-2 flex flex-wrap gap-2">
                @if ($post->category->name)
                    <div class="rounded-md px-2 py-1 text-xs font-semibold bg-fuchsia-400 text-fuchsia-900 text-nowrap">{{ $post->category->name }}</div>
                @endif
                <div class="rounded-md px-2 py-1 text-xs font-semibold bg-sky-400 text-sky-900 text-nowrap">{{ $post->status }}</div>
            </div>
            <div class="mt-8 prose prose-invert prose-img:rounded-lg">
                {!! str($post->description)->sanitizeHtml() !!}
            </div>
            <div class="mt-6 flex flex-wrap gap-2">
                @php
                    $colors = ['bg-fuchsia-400 text-fuchsia-900', 'bg-lime-400 text-lime-900', 'bg-sky-400 text-sky-900', 'bg-rose-400 text-rose-900', 'bg-yellow-400 text-yellow-900', 'bg-purple-400 text-purple-900', 'bg-green-400 text-green-900', 'bg-blue-400 text-blue-900'];
                @endphp

                @if (!empty($post->labels))
                    @foreach (explode(', ', $post->labels) as $label)
                        @php
                            $randomColor = $colors[array_rand($colors)];
                        @endphp
                        <div class="rounded-md px-2 py-1 text-xs font-semibold {{ $randomColor }}">
                            {{ $label }}
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection

@section('styles')
@endsection

@section('scripts')
@endsection
