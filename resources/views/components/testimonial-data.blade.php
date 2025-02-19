@if ($testimonials->isNotEmpty())
    @foreach ($testimonials as $testimonial)
        <div class="hover:translate-y-1">
            <div class="overflow-hidden rounded-md bg-slate-800">
                <div class="aspect-w-3 aspect-h-2">
                    @if ($testimonial->client_image)
                        <img class="h-full w-full object-cover object-center" src="{{ Storage::url($testimonial->image) }}" alt="{{ $testimonial->client_name }}" loading="lazy" />
                    @else
                        <img class="h-full w-full object-cover object-center" src="{{ asset('/') }}astro-boilerplate/assets/images/image-post.jpeg" alt="{{ $testimonial->client_name }}" loading="lazy" />
                    @endif
                </div>
                <div class="px-3 pt-4 pb-6">
                    <h2 class="text-xl font-semibold">{{ $testimonial->client_name }}</h2>
                    <div class="mt-2 text-sm">{!! $testimonial->testimonial_text !!}</div>
                </div>
            </div>
        </div>
    @endforeach
@else
    <p class="text-white">There is no data yet.</p>
@endif
