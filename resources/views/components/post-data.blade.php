@if ($posts->isNotEmpty())
    @foreach ($posts as $post)
        <a class="hover:translate-y-1" href="{{ route('post_detail', ['username' => $user->username, 'id' => $post->id]) }}">
            <div class="overflow-hidden rounded-md bg-slate-800">
                <div class="aspect-w-3 aspect-h-2">
                    @if ($post->image)
                        <img class="h-full w-full object-cover object-center" src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}" loading="lazy" />
                    @else
                        <img class="h-full w-full object-cover object-center" src="{{ asset('/') }}astro-boilerplate/assets/images/image-post2.jpeg" alt="{{ $post->title }}" loading="lazy" />
                    @endif
                </div>
                <div class="px-3 pt-4 pb-6">
                    <h2 class="text-xl font-semibold">{{ $post->title }}</h2>
                    <div class="mt-3 flex flex-wrap">
                        @if ($post->category->name)
                            <div class="rounded-md px-2 py-1 text-xs font-semibold bg-fuchsia-400 text-fuchsia-900 text-nowrap">{{ $post->category->name }}</div>
                        @endif
                    </div>
                    <div class="mt-1 text-xs text-gray-400">{{ $post->created_at }}</div>
                    <div class="mt-3 text-sm" style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">{!! $post->description !!}</div>
                </div>
            </div>
        </a>
    @endforeach
@else
    <p class="text-white">There is no data yet.</p>
@endif
