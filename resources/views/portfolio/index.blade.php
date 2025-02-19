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
                    @if ($user->email)
                        <a href="mailto:{{ $user->email }}" target="_blank"><img class="h-12 w-12 hover:translate-y-1" src="{{ asset('/') }}astro-boilerplate/assets/images/email-icon.png" alt="Email icon" loading="lazy" /></a>
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
                <div class="text-sm"><a href="{{ route('post', ['username' => $user->username]) }}">View all Posts →</a></div>
            </div>
        </div>
        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
            <x-post-data :posts="$posts" :user="$user" />
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
                <div>
                    <span class="bg-gradient-to-br from-sky-500 to-cyan-400 bg-clip-text text-transparent">Contact Me</span>
                </div>
            </div>
        </div>
        <div class="flex flex-col gap-6">
            <form id="message-form" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                <div class="grid md:grid-cols-2 grid-cols-1 gap-6">
                    <div class="mb-3">
                        <label for="name" class="form-label block text-sm font-medium text-white">Name</label>
                        <input type="text" name="name" id="name" placeholder="Enter Name" class="mt-1 p-3 block w-full rounded-md border-gray-300 shadow-sm focus:border-sky-500 focus:ring-sky-500 sm:text-sm text-gray-900" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label block text-sm font-medium text-white">Email</label>
                        <input type="email" name="email" id="email" placeholder="Enter Email" class="mt-1 p-3 block w-full rounded-md border-gray-300 shadow-sm focus:border-sky-500 focus:ring-sky-500 sm:text-sm text-gray-900" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label block text-sm font-medium text-white">Message</label>
                    <textarea name="message" id="message" rows="4" placeholder="Enter Message" class="mt-1 p-3 block w-full rounded-md border-gray-300 shadow-sm focus:border-sky-500 focus:ring-sky-500 sm:text-sm text-gray-900" required></textarea>
                </div>
                <div>
                    <button type="submit" id="sendMessageButton" class="mt-1 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-sky-500 hover:bg-sky-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
                        Send Message
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('styles')
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#message-form').on('submit', function(e) {
                e.preventDefault();

                let sendMessageButton = $('#sendMessageButton');
                let formData = $(this).serialize();

                sendMessageButton.attr('disabled', true).text('Sending...');

                $.ajax({
                    type: 'POST',
                    url: '{{ route('message_store') }}',
                    data: formData,
                    success: function(response) {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            showCloseButton: true,
                            timer: 3000,
                            timerProgressBar: true,
                        });

                        $('#message-form')[0].reset();

                        sendMessageButton.attr('disabled', false).text('Send Message');
                    },
                    error: function(xhr) {
                        let errorMessage = 'Something went wrong! Please try again later.';
                        if (xhr.status === 422) {
                            errorMessage = 'Validation failed. Please check your inputs.';
                        }

                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'error',
                            title: errorMessage,
                            showConfirmButton: false,
                            showCloseButton: true,
                            timer: 3000,
                            timerProgressBar: true,
                        });

                        sendMessageButton.attr('disabled', false).text('Send Message');
                    }
                });
            });
        });
    </script>
@endsection
