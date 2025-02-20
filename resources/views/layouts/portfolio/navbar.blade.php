<div class="mx-auto max-w-screen-lg px-3 py-6">
    <div class="flex flex-col gap-y-3 gap-x-3 sm:flex-row sm:items-center sm:justify-between">
        <a href="{{ env('APP_OWNER_URL') }}" target="_blank">
            <div class="flex items-center bg-gradient-to-br from-sky-500 to-cyan-400 bg-clip-text text-xl font-bold text-transparent">
                <svg class="mr-1 h-10 w-10 stroke-cyan-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M0 0h24v24H0z" stroke="none"></path>
                    <path d="M3 7h5l2 2h11a1 1 0 0 1 1 1v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V8a1 1 0 0 1 1-1z"></path>
                    <path d="M13 7H8V5a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2z"></path>
                </svg>
                {{ config('app.name') }}
            </div>
        </a>
        <nav>
            <ul class="flex flex-wrap gap-x-3 font-medium text-gray-200">
                <li class="{{ request()->is($user->username) ? 'text-cyan-400' : 'hover:text-cyan-400' }}"><a href="{{ route('portfolio', ['username' => $user->username]) }}" target="_self">Main</a></li>
                @yield('breadcrumb')
            </ul>
        </nav>
    </div>
</div>
