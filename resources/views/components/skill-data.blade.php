@if ($skills->isNotEmpty())
    @foreach ($skills as $skill)
        <div class="flex flex-row gap-x-4 rounded-md bg-slate-800 p-4">
            <div class="shrink-0">
                <img class="md:h-22 md:w-22 h-16 w-16 hover:translate-y-1" src="{{ asset('/') }}images/icon/skill.png" alt="{{ $skill->skill_name }}" loading="lazy" />
            </div>
            <div class="w-full">
                <div class="flex items-baseline justify-between">
                    <div class="text-xl font-semibold">{{ $skill->skill_name }}</div>
                    <div class="rounded-md px-2 py-1 text-xs font-semibold bg-fuchsia-400 text-fuchsia-900 text-nowrap">{{ $skill->skill_level }}</div>
                </div>
                @if ($skill->caption)
                    <p class="mt-3 text-gray-400">{!! $skill->caption !!}</p>
                @endif
            </div>
        </div>
    @endforeach
@else
    <p class="text-white">There is no data yet.</p>
@endif
