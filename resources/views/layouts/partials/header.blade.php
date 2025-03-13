<header class="navbar">
    <nav>
        {{-- class="{{request()->routeIs('home') ? 'active' : ''}} --}}
        <div class="flex items-center">
            @if (Route::currentRouteName() == 'list.index')
                <div class="open-menus-btn">
                    <button class="open-menus-icon"
                        id="open-left-menu" onclick="openLeftMenu()">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="svg-icon">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 5.25h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5" />
                        </svg>
                    </button>
                </div>
                {{-- <div class="open-menus-btn">
                    <button class="flex items-center justify-center rounded-full size-10 hover:bg-blue-200"
                        id="open-right-menu" onclick="openRightMenu()">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="svg-icon">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 5.25h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5" />
                        </svg>
                    </button>
                </div> --}}
                <div class="open-menus-btn">
                    <button class="open-menus-icon"
                        id="open-right-menu" onclick="openSearchBar()">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="svg-icon">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </button>
                </div>
            @endif

            <div class="navbar-element">
                <a href="{{ route('list.index') }}"
                    class="navbar-items {{ request()->routeIs('list.index', 'list.filter') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="svg-icon ml-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                    </svg>
                    My List</a>
            </div>
            @guest
                <div class="navbar-element">
                    <a href="{{ route('show.login') }}"
                        class="navbar-items {{ request()->routeIs('show.login') ? 'active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="svg-icon ml-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H2.25" />
                        </svg>

                        Login</a>
                </div>
                <div class="navbar-element">
                    <a href="{{ route('show.register') }}"
                        class="navbar-items {{ request()->routeIs('show.register') ? 'active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="svg-icon ml-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                        </svg>

                        Register</a>
                </div>
            @endguest
            @auth
                <div class="navbar-element">
                    <a href="{{ route('list.create') }}"
                        class="navbar-items {{ request()->routeIs('list.create') ? 'active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="svg-icon ml-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>

                        New TO-DO</a>
                </div>
                {{ Auth::user()->name }}
                <div class="navbar-element">
                    <a href="{{ route('auth.logout') }}" class="navbar-items">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="svg-icon ml-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                        </svg>

                        Logout</a>
                </div>
            @endauth
            <div
                class="bg-white border-2 border-blue-500 ml-auto mr-2 rounded-full px-2 select-none flex-wrap justify-center md:justify-between lg:justify-between sm:text-xs md:text-sm lg:text-base search-bar-container">

                {{-- SEARCH BAR --}}
                <form action="{{ route('list.filter') }}" class="m-0 p-0 flex items-center gap-4 flex-wrap"
                    method="GET">
                    <a href="{{ route('list.create') }}" class="flex items-center create-list-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="svg-icon">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </a>
                    <input type="text" name="searchThis" id="" class="w-24 lg:w-56 focus:ring-0"
                        placeholder="Search..." autocomplete="off">
                    <button type="submit" class="search-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="svg-icon">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </button>
                    <div class="flex gap-1.5">
                        <input class="search-bar-checkbox" type="checkbox" name="sortByDone" id=""><span>Done</span>
                    </div>
                    <div class="flex gap-1.5">
                        <input type="checkbox" name="sortByOldest" id="" class="search-bar-checkbox"><span>Oldest</span>
                    </div>

                </form>
            </div>
            @auth
                @if (Route::currentRouteName() == 'list.index')
                <div class="open-menus-btn">
                    <button class="open-menus-icon"
                        id="open-right-menu" onclick="openRightMenu()">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="svg-icon">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 5.25h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5" />
                        </svg>
                    </button>
                </div>
                @endif
            @endauth
        </div>
    </nav>
</header>
