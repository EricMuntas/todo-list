<aside class="hidden md:block scroll-custom overflow-y-auto" id="right-menu">
    <div class="flex justify-center mt-2 md:mt-0">
        <span class="date-today text-blue-500">{{ Carbon\Carbon::now()->format('l, F d, Y') }}</span>
    </div>
    @php
        if (isset($totalAmountOfLists) && isset($totalAmountOfListsDone)) {
            $totalCount = $totalAmountOfLists; // Calcula el total de tareas.
            $checkedCount = $totalAmountOfListsDone; // Calcula las completadas.
            $percentageDone = $totalCount > 0 ? round(($checkedCount / $totalCount) * 100) : 0; // Evita divisiones por cero.
        }
    @endphp
    <div class="progress-bar">
        <div style="width: {{ Auth::check() ? $percentageDone . '%' : '0%' }};"></div>
    </div>
    <div class="flex flex-col items-center justify-center">
        <div class="profile-info flex justify-center text-center  !text-gray-500">
            <p>Progress made: <span
                    class="{{ isset($percentageDone) == 100 ? 'text-blue-500' : '' }}">{{ Auth::check() ? $percentageDone : '0' }}%</span>
            </p>
        </div>
    </div>
    {{-- Info --}}
    <div class=" flex justify-center items-center w-full my-2">
        <div class="card-divisor"></div>
    </div>
    <div class="grid grid-cols-2 place-items-center text-left gap-4 mx-12">

        <div class="profile-info">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="svg-icon">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 0 1 0 3.75H5.625a1.875 1.875 0 0 1 0-3.75Z" />
            </svg>
        </div>
        <div class="profile-info flex flex-col justify-center items-center">
            <p class="text-xs italic !text-gray-500 text-center">Total</p>
            <p class="text-center">To-Do: <span
                    class="{{ Auth::check() && $totalAmountOfLists > 0 ? 'text-blue-500' : 'text-black' }}">{{ Auth::check() ? $totalAmountOfLists : '0' }}</span>
            </p>
        </div>
        <div class="profile-info">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="svg-icon">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M8.242 5.992h12m-12 6.003H20.24m-12 5.999h12M4.117 7.495v-3.75H2.99m1.125 3.75H2.99m1.125 0H5.24m-1.92 2.577a1.125 1.125 0 1 1 1.591 1.59l-1.83 1.83h2.16M2.99 15.745h1.125a1.125 1.125 0 0 1 0 2.25H3.74m0-.002h.375a1.125 1.125 0 0 1 0 2.25H2.99" />
            </svg>
        </div>
        <div class="profile-info">
            <p class="text-center">To-Do: <span
                    class="{{ Auth::check() && $totalAmountOfListsToDo === 0 && $totalAmountOfLists > 0 ? 'text-blue-500' : 'text-black' }}">{{ Auth::check() ? $totalAmountOfListsToDo : '0' }}</span>
            </p>
        </div>
        <div class="profile-info "><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor" class="svg-icon">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
        </div>
        <div class="profile-info">
            <p class="text-center ">Done: <span
                    class="{{ Auth::check() && $totalAmountOfListsDone > 0 ? 'text-blue-500' : 'text-black' }}">{{ Auth::check() ? $totalAmountOfListsDone : '0' }}</span>
            </p>
        </div>
    </div>
</aside>
