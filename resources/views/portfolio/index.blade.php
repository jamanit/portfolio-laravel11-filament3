@extends('layouts.portfolio.app')

@section('title')
    {{ __('Main') }}
@endsection

@section('content')
    <div class="mx-auto max-w-screen-lg px-3 py-6">
        <div class="flex flex-col items-center md:flex-row md:justify-between md:gap-x-24 gap-y-4">
            <div>
                <h1 class="text-3xl font-bold">Hi there, I&#x27;m <span class="bg-gradient-to-br from-sky-500 to-cyan-400 bg-clip-text text-transparent">{{ $user->name }}</span> 👋</h1>
                @if ($user->bio)
                    <p class="mt-6 text-xl leading-9">{!! $user->bio !!}</p>
                @endif
                <div class="mt-3 flex gap-1">
                    @if ($user->phone_number)
                        <a href="tel:{{ $user->phone_number }}" target="_blank"><img class="h-12 w-12 hover:translate-y-1" src="{{ asset('/') }}astro-boilerplate/assets/images/phone-icon.png" alt="Phone icon" loading="lazy" /></a>
                    @endif
                    @if ($user->whatsapp_number)
                        <a href="https://wa.me/{{ $user->whatsapp_number }}" target="_blank"><img class="h-12 w-12 hover:translate-y-1" src="{{ asset('/') }}astro-boilerplate/assets/images/whatsapp-icon.png" alt="WhatsApp icon" loading="lazy" /></a>
                    @endif
                    @if ($user->linkedin_url)
                        <a href="{{ $user->linkedin_url }}" target="_blank"><img class="h-12 w-12 hover:translate-y-1" src="{{ asset('/') }}astro-boilerplate/assets/images/linkedin-icon.png" alt="Linkedin icon" loading="lazy" /></a>
                    @endif
                    @if ($user->github_url)
                        <a href="{{ $user->github_url }}" target="_blank"><img class="h-12 w-12 hover:translate-y-1" src="{{ asset('/') }}astro-boilerplate/assets/images/github-icon.png" alt="GitHub icon" loading="lazy" /></a>
                    @endif
                    @if ($user->instagram_url)
                        <a href="{{ $user->instagram_url }}" target="_blank"><img class="h-12 w-12 hover:translate-y-1" src="{{ asset('/') }}astro-boilerplate/assets/images/instagram-icon.png" alt="Instagram icon" loading="lazy" /></a>
                    @endif
                    @if ($user->facebook_url)
                        <a href="{{ $user->facebook_url }}" target="_blank"><img class="h-12 w-12 hover:translate-y-1" src="{{ asset('/') }}astro-boilerplate/assets/images/facebook-icon.png" alt="Facebook icon" loading="lazy" /></a>
                    @endif
                    @if ($user->x_url)
                        <a href="{{ $user->x_url }}" target="_blank"><img class="h-12 w-12 hover:translate-y-1" src="{{ asset('/') }}astro-boilerplate/assets/images/twitter-icon.png" alt="Twitter icon" loading="lazy" /></a>
                    @endif
                    @if ($user->youtube_url)
                        <a href="{{ $user->youtube_url }}" target="_blank"><img class="h-12 w-12 hover:translate-y-1" src="{{ asset('/') }}astro-boilerplate/assets/images/youtube-icon.png" alt="Youtube icon" loading="lazy" /></a>
                    @endif
                </div>
            </div>
            <div class="shrink-0"><img class="h-80 w-64" src="{{ asset('/') }}astro-boilerplate/assets/images/avatar.svg" alt="Avatar image" loading="lazy" />
            </div>
        </div>
    </div>

    <div class="mx-auto max-w-screen-lg px-3 py-6">
        <div class="mb-6 text-2xl font-bold">
            <div class="flex items-baseline justify-between">
                <div><span class="bg-gradient-to-br from-sky-500 to-cyan-400 bg-clip-text text-transparent">Skills</span></div>
                <div class="text-sm"><a href="{{ route('skill', ['username' => $user->username]) }}">View all Skills →</a></div>
            </div>
        </div>
        <div class="flex flex-col gap-6">
            <div class="grid md:grid-cols-2 grid-cols-1 gap-6">
                <x-skill-data :skills="$skills" />
            </div>
        </div>
    </div>

    <div class="mx-auto max-w-screen-lg px-3 py-6">
        <div class="mb-6 text-2xl font-bold">
            <div class="flex items-baseline justify-between">
                <div><span class="bg-gradient-to-br from-sky-500 to-cyan-400 bg-clip-text text-transparent">Experiences</span></div>
                <div class="text-sm"><a href="{{ route('experience', ['username' => $user->username]) }}">View all Experiences →</a></div>
            </div>
        </div>
        <div class="flex flex-col gap-6">
            <x-experience-data :experiences="$experiences" />
        </div>
    </div>

    <div class="mx-auto max-w-screen-lg px-3 py-6">
        <div class="mb-6 text-2xl font-bold">
            <div class="flex items-baseline justify-between">
                <div>Recent <span class="bg-gradient-to-br from-sky-500 to-cyan-400 bg-clip-text text-transparent">Projects</span>
                </div>
                <div class="text-sm"><a href="{{ route('project', ['username' => $user->username]) }}">View all Projects →</a></div>
            </div>
        </div>
        <div class="flex flex-col gap-6">
            <x-project-data :projects="$projects" :user="$user" />
        </div>
    </div>

    <div class="mx-auto max-w-screen-lg px-3 py-6">
        <div class="mb-6 text-2xl font-bold">
            <div class="flex items-baseline justify-between">
                <div>Recent <span class="bg-gradient-to-br from-sky-500 to-cyan-400 bg-clip-text text-transparent">Posts</span></div>
                <div class="text-sm"><a href="/posts/">View all Posts →</a></div>
            </div>
        </div>
        <div class="grid grid-cols-1 gap-6 md:grid-cols-3"><a class="hover:translate-y-1" href="/posts/sixth-post/">
                <div class="overflow-hidden rounded-md bg-slate-800">
                    <div class="aspect-w-3 aspect-h-2"><img class="h-full w-full object-cover object-center" src="{{ asset('/') }}astro-boilerplate/assets/images/image-post.jpeg" alt="Image post" loading="lazy" /></div>
                    <div class="px-3 pt-4 pb-6 text-center">
                        <h2 class="text-xl font-semibold">Typography example</h2>
                        <div class="mt-1 text-xs text-gray-400">Feb 6, 2020</div>
                        <div class="mt-2 text-sm">Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur vero esse non
                            molestias eos excepturi.</div>
                    </div>
                </div>
            </a><a class="hover:translate-y-1" href="/posts/fifth-post/">
                <div class="overflow-hidden rounded-md bg-slate-800">
                    <div class="aspect-w-3 aspect-h-2"><img class="h-full w-full object-cover object-center" src="{{ asset('/') }}astro-boilerplate/assets/images/image-post2.jpeg" alt="Image post 2" loading="lazy" /></div>
                    <div class="px-3 pt-4 pb-6 text-center">
                        <h2 class="text-xl font-semibold">5th Lorem ipsum dolor sit</h2>
                        <div class="mt-1 text-xs text-gray-400">Feb 5, 2020</div>
                        <div class="mt-2 text-sm">Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur vero esse non
                            molestias eos excepturi.</div>
                    </div>
                </div>
            </a><a class="hover:translate-y-1" href="/posts/forth-post/">
                <div class="overflow-hidden rounded-md bg-slate-800">
                    <div class="aspect-w-3 aspect-h-2"><img class="h-full w-full object-cover object-center" src="{{ asset('/') }}astro-boilerplate/assets/images/image-post3.jpeg" alt="Image post 3" loading="lazy" /></div>
                    <div class="px-3 pt-4 pb-6 text-center">
                        <h2 class="text-xl font-semibold">4th Lorem ipsum dolor sit</h2>
                        <div class="mt-1 text-xs text-gray-400">Feb 4, 2020</div>
                        <div class="mt-2 text-sm">Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur vero esse non
                            molestias eos excepturi.</div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="mx-auto max-w-screen-lg px-3 py-6">
        <div class="mb-6 text-2xl font-bold"><span class="bg-gradient-to-br from-sky-500 to-cyan-400 bg-clip-text text-transparent">Educations</span></div>
        <div class="flex flex-col gap-6">
            <div class="grid md:grid-cols-2 grid-cols-1 gap-6">
                @if ($educations->isNotEmpty())
                    @foreach ($educations as $education)
                        <div class="flex flex-col gap-x-8 rounded-md bg-slate-800 p-4 md:flex-row">
                            <div class="shrink-0">
                                <img class="md:h-22 md:w-22 h-16 w-16 hover:translate-y-1" src="{{ asset('/') }}images/icon/education.png" alt="{{ $education->degree . ' - ' . $education->school_name }}" loading="lazy" />
                            </div>
                            <div>
                                <div class="text-xl font-semibold">{{ $education->degree }}</div>
                                <div class="text-xl font-semibold">{{ $education->school_name }}</div>
                                <div class="mt-3 flex flex-wrap gap-2">
                                    <div class="rounded-md px-2 py-1 text-xs font-semibold bg-fuchsia-400 text-fuchsia-900">{{ $education->start_year }}</div>
                                    <p>to</p>
                                    <div class="rounded-md px-2 py-1 text-xs font-semibold bg-green-400 text-green-900">{{ $education->end_year ? $education->end_year : 'Present' }}</div>
                                </div>
                                @if ($education->description)
                                    <p class="mt-3 text-gray-400">{!! $education->description !!}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-white">There is no data yet.</p>
                @endif
            </div>
        </div>
    </div>

    <div class="mx-auto max-w-screen-lg px-3 py-6">
        <div class="mb-6 text-2xl font-bold">
            <div class="flex items-baseline justify-between">
                <div><span class="bg-gradient-to-br from-sky-500 to-cyan-400 bg-clip-text text-transparent">Testimonials</span></div>
                <div class="text-sm"><a href="{{ route('testimonial', ['username' => $user->username]) }}">View all Testimonials →</a></div>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-6 md:grid-cols-3">
            <x-testimonial-data :testimonials="$testimonials" />
        </div>
    </div>

    <div class="mx-auto max-w-screen-lg px-3 py-6">
        <div class="mb-6 text-2xl font-bold">
            <div class="flex items-baseline justify-between">
                <div><span class="bg-gradient-to-br from-sky-500 to-cyan-400 bg-clip-text text-transparent">Contact Me</span></div>
            </div>
        </div>
        <div class="flex flex-col gap-6">
            <div class="grid md:grid-cols-2 grid-cols-1 gap-6">
                {{--  --}}
            </div>
        </div>
    </div>
@endsection

@section('styles')
@endsection

@section('scripts')
@endsection
