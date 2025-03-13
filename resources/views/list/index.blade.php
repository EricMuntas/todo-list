@extends('layouts.template')
@section('title', 'Your List')
@section('content')
    <main class="scroll-custom w-full md:w-4/6" id="main">
        {{-- pt-6 == distancia --}}
        {{--  bg-white w-full h-full pt-6 rounded-2xl --}}
        <div class="content-frame">
     
            @auth
                {{-- <div class="block md:hidden">small</div>
                <div class="hidden md:block lg:hidden">medium</div>
                <div class="hidden lg:block">large</div> --}}
                <div class="hidden md:hidden  search-bar-index" id="search-bar">
                    {{-- SEARCH BAR --}}
                    <form action="{{ route('list.filter') }}" class="m-0 p-0 flex items-center gap-4 flex-wrap" method="GET">
                        <a href="{{ route('list.create') }}" class="ml-4 create-list-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="svg-icon">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </a>
                        <input type="text" name="searchThis" id="" class="w-56 focus:ring-0" placeholder="Search..."
                            autocomplete="off">
                        <button type="submit" class="search-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="svg-icon">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                        </button>
                        <div class="flex flex-row gap-2">
                        <div class="flex gap-1.5">
                            <input type="checkbox" name="sortByDone" id="" class="search-bar-checkbox"><span>Done</span>
                        </div>
                        <div class="flex gap-1.5">
                            <input type="checkbox" name="sortByOldest" id="" class="search-bar-checkbox"><span>Oldest</span>
                        </div>
                    </div>
                    </form>
                </div>
                {{-- CHANGE PAGE --}}
                <div id="" class="flex justify-end mr-2 mb-2 gap-4 items-center">
                    {{-- Botó per anar a la pàgina anterior --}}
                    @if ($list->total() != 0)
                        <div class="text-sm select-none text-gray-500">{{ $list->firstItem() }}-{{ $list->lastItem() }} of
                            {{ $list->total() }}</div>
                    @endif
                    @if ($list->onFirstPage())
                        <button class="change-page-btn change-page-btn-unabled">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="svg-icon">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                            </svg>


                        </button>
                    @else
                        <a href="{{ $list->previousPageUrl() }}" class="change-page-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="svg-icon">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                            </svg>
                        </a>
                    @endif

                    {{-- Botó per anar a la pàgina següent --}}
                    @if ($list->hasMorePages())
                        <a href="{{ $list->nextPageUrl() }}" class=" change-page-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="svg-icon">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                            </svg>
                        </a>
                    @else
                        <button class="change-page-btn change-page-btn-unabled">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="svg-icon">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                            </svg>

                        </button>
                    @endif
                </div>

                <?php $counter = ($list->currentPage() - 1) * $list->perPage() + 1; ?>
                @if ($list->count() === 0)
                    {{-- <div id="redirect-div"
                        class="bg-gray-200 border-2 border-gray-300 rounded-2xl  w-2/3 p-3 mx-auto transition ease-in-out hover:-translate-y-1 hover:scale-110  duration-300 cursor-pointer  active:scale-105 select-none">
                        <a href="{{ route('list.create') }} " class="block w-full h-full">No lista</a>

                    </div> --}}
                    <div class="empty-tab-message">
                        <p class="text-xl text-center font-semibold">
                            <span>{{ isset($category) ? 'Your ' . ucfirst($category) . ' tab is empty.' : "You don't have any TO-DO yet." }}</span>
                        </p>

                        <p>You don’t have any pending tasks in your list right now. Start by adding your first tasks to stay
                            organized and on track with your projects.</p>
                        <p>Click <a href="{{ route('list.create') }}" class="!text-blue-500 underline">here</a> to create a new
                            task.</p>
                        <p>Remember, you can add, edit, or delete tasks anytime from your task list.</p>

                    </div>
                @endif
                {{-- STARTCARD --}}
                @foreach ($list as $item)
                    <?php $item->description = nl2br($item->description); ?>

                    {{-- transition ease-in-out hover:-translate-y-1 hover:scale-105 duration-300 cursor-pointer active:scale-105 --}}
                    {{-- bg-gradient-to-r from-purple-500 via-red-500 to-yellow-500 --}}

                    {{-- bg-gradient-to-r from-purple-500 via-red-500 to-yellow-500 p-[px] --}}
                    <div
                        class="flex gap-x-2 w-full h-14 p-3 mx-auto select-none items-center {{ $item->checked ? 'bg-blue-50  text-blue-500' : 'bg-white' }} border-b-2 {{ $loop->first ? 'border-t-2 border-t-blue-500' : '' }} border-b-blue-500">
                        {{-- m-0 p-0 --}}
                        <form action="{{ route('list.updateChecked', $item) }}" method="POST"
                            class="flex items-center m-0 p-0">
                            @csrf
                            @method('PUT')

                            <!-- Hidden input per enviar 0 si el checkbox no està marcat -->
                            <input type="hidden" name="checked" value="0">

                            <!-- Checkbox -->
                            <input type="checkbox" name="checked" value="1"
                                class="h-6 w-6 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-0 checked:bg-blue-600 checked:border-blue-600 transition cursor-pointer"
                                {{ $item->checked ? 'checked' : '' }} onchange="this.form.submit()">
                        </form>
                        <p class="text-sm md:text-base truncate"><span
                                class=" {{ $item->checked ? '' : 'font-bold' }}">
                                {{ $counter }}. {{ $item->title }}

                            </span><span class="text-gray-500"> - {{ Str::words($item->description, 7, '...') }}</span> </p>
                        <div class="ml-auto flex gap-x-2 items-center">
                            @if ($item->due_to)
                                <span class="italic font-bold">DUE TO: <span
                                        class="{{ $item->due_to > now() ? 'text-red-500' : 'text-green-500' }}">
                                        {{ \Carbon\Carbon::parse($item->due_to)->format('d/m/Y') }}</span></span>
                            @endif
                            @if ($item->priority === 'important')
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="svg-icon  text-yellow-400">
                                    <path fill-rule="evenodd"
                                        d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                                        clip-rule="evenodd" />
                                </svg>
                            @endif
                            <button onclick="showInfo(this)" class="todo-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>

                            </button>
                            <a href="{{ route('list.edit', $item) }}" class="todo-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                </svg>

                            </a>
                            <button
                                onclick="showDialog('{{ addslashes($item->title) }}', '{{ route('list.destroy', $item) }}')"
                                class="todo-btn">
                                {{-- trash --}}
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>

                            </button>
                        </div>
                    </div>
                    {{-- todo-tag --}}
                    <div
                        class="hidden gap-x-2 p-3 bg-white  w-full overflow-hidden max-h-0 transition-all duration-100 mx-auto shadow-md border-b-2 border-blue-500 ">
                        <span class="italic text-gray-500 text-sm">Description:</span>
                        <p class="break-words break-all">{!! $item->description !!}</p>
                        <div class="flex flex-row-reverse p-2 italic text-gray-500 text-sm gap-4">
                            <span>Status: <span>{{ $item->checked ? 'Done' : 'To Do' }}</span></span>
                            <span class="">Added at {{ $item->created_at->format('d/m/Y \-\ H:i') }}</span>
                        </div>

                    </div>

                    <?php $counter++; ?>
                @endforeach
                {{-- ENDCARD --}}
            @endauth
        </div>
    </main>

@endsection





<style>
    .height {
        height: calc(100vh - 4rem);
    }
</style>
