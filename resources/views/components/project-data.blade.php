@if ($projects->isNotEmpty())
    @foreach ($projects as $project)
        <div class="flex flex-row gap-x-8 rounded-md bg-slate-800 p-4">
            <div class="shrink-0">
                @if ($project->image)
                    <img class="md:h-36 md:w-36 h-16 w-16 hover:translate-y-1 rounded-lg" src="{{ Storage::url($project->image) }}" alt="{{ $project->title }}" loading="lazy" />
                @else
                    <img class="md:h-36 md:w-36 h-16 w-16 hover:translate-y-1 rounded-lg" src="{{ asset('/') }}images/icon/project.png" alt="{{ $project->title }}" loading="lazy" />
                @endif
            </div>
            <div class="w-full">
                <div class="flex flex-col md:flex-row gap-y-3 md:items-baseline md:justify-between">
                    <a class="hover:text-cyan-400" href="{{ route('project_detail', ['username' => $user->username, 'id' => $project->id]) }}">
                        <div class="text-xl font-semibold">{{ $project->title }}</div>
                    </a>
                    <div class="flex flex-wrap gap-2">
                        @if ($project->category->name)
                            <div class="rounded-md px-2 py-1 text-xs font-semibold bg-fuchsia-400 text-fuchsia-900 text-nowrap">{{ $project->category->name }}</div>
                        @endif
                        <div class="rounded-md px-2 py-1 text-xs font-semibold bg-sky-400 text-sky-900 text-nowrap">{{ $project->status }}</div>
                    </div>
                </div>
                <p class="mt-1 text-xs text-gray-400">{{ $project->created_at }}</p>
                <div class="mt-3">
                    <div class="text-gray-400" style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                        {!! str($project->description)->sanitizeHtml() !!}
                    </div>
                </div>
                <div class="mt-3 flex flex-wrap gap-2">
                    @php
                        $colors = ['bg-fuchsia-400 text-fuchsia-900', 'bg-lime-400 text-lime-900', 'bg-sky-400 text-sky-900', 'bg-rose-400 text-rose-900', 'bg-yellow-400 text-yellow-900', 'bg-purple-400 text-purple-900', 'bg-green-400 text-green-900', 'bg-blue-400 text-blue-900'];
                    @endphp

                    @if (!empty($project->labels))
                        @foreach (explode(', ', $project->labels) as $label)
                            @php
                                $randomColor = $colors[array_rand($colors)];
                            @endphp
                            <div class="rounded-md px-2 py-1 text-xs font-semibold {{ $randomColor }}">
                                {{ $label }}
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="mt-3">
                    <a href="{{ route('project_detail', ['username' => $user->username, 'id' => $project->id]) }}"
                        class="relative inline-block tracking-wide align-middle text-base text-center border-none after:content-[''] after:absolute after:h-px after:w-0 hover:after:w-full after:end-0 hover:after:end-auto after:bottom-0 after:start-0 after:transition-all after:duration-500 text-cyan-400 hover:text-cyan-400 after:bg-cyan-400 duration-500 ease-in-out">
                        See details
                    </a>
                </div>
            </div>
        </div>
    @endforeach
@else
    <p class="text-white">There is no data yet.</p>
@endif
