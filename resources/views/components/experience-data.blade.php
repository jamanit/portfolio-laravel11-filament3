@if ($experiences->isNotEmpty())
    @foreach ($experiences as $experience)
        <div class="flex flex-row items gap-x-4 rounded-md bg-slate-800 p-4">
            <div class="shrink-0">
                <img class="md:h-36 md:w-36 h-16 w-16 hover:translate-y-1" src="{{ asset('/') }}images/icon/experience.png" alt="{{ $experience->job_title . ' - ' . $experience->company_name }}" loading="lazy" />
            </div>
            <div>
                <div class="text-xl font-semibold">{{ $experience->job_title }}</div>
                <div class="text-xl font-semibold">{{ $experience->company_name }}</div>
                <div class="mt-3 flex flex-wrap gap-2">
                    <div class="rounded-md px-2 py-1 text-xs font-semibold bg-fuchsia-400 text-fuchsia-900">{{ $experience->start_year }}</div>
                    <p>to</p>
                    <div class="rounded-md px-2 py-1 text-xs font-semibold bg-green-400 text-green-900">{{ $experience->end_year ? $experience->end_year : 'Present' }}</div>
                </div>
                @if ($experience->job_description)
                    <div class="mt-3 text-gray-400">{!! str($experience->job_description)->sanitizeHtml() !!}</div>
                @endif
            </div>
        </div>
    @endforeach
@else
    <p class="text-white">There is no data yet.</p>
@endif
