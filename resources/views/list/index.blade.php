@extends('layouts.template')
@section('title', 'Your List')

@section('content')

    <style>
    </style>

    {{-- @foreach ($list as $item)
           <li><a href="{{route('list.show', $item)}}">{{$item->username}}, {{$item->title}}</a></li>
        @endforeach --}}

    <div class="flex ">
        <div class="laterals border-r-2 border border-gray-200 flex">
            <div class="mt-6 w-full">
                <form action="{{ route('list.filter') }}" method="GET" id="filter_by_category">
                    @csrf

                    <input type="hidden" name="category" id="categoryInput" value="">

                    <div class="categories {{ isset($category) && $category == 'priority' ? 'current_category' : '' }}">
                        <button type="button" class="flex items-center gap-4" onclick="setCategoryAndSubmit('priority')">
                            @if (isset($category) &&  $category == 'priority')
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="size-6">
                                    <path fill-rule="evenodd"
                                        d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                                        clip-rule="evenodd" />
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                                </svg>
                            @endif



                            <span>Important</span>

                        </button>

                    </div>


                    <div class="categories category_btn_activated">
                        <button onclick="dropdownCategories(this)" type="button" class="flex items-center gap-4 ">
                            <svg id="categories_svg" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                            </svg>
                            Categories
                        </button>
                    </div>
                    {{-- Div to show or hide categories --}}
                    <div class="">
                        <div class="categories {{ isset($category) && $category == 'home' ? 'current_category' : '' }}">
                            <button type="button" class="flex items-center gap-4" onclick="setCategoryAndSubmit('home')">
                                @if (isset($category) && $category == 'home')
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="size-6">
                                        <path
                                            d="M11.47 3.841a.75.75 0 0 1 1.06 0l8.69 8.69a.75.75 0 1 0 1.06-1.061l-8.689-8.69a2.25 2.25 0 0 0-3.182 0l-8.69 8.69a.75.75 0 1 0 1.061 1.06l8.69-8.689Z" />
                                        <path
                                            d="m12 5.432 8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 0 1-.75-.75v-4.5a.75.75 0 0 0-.75-.75h-3a.75.75 0 0 0-.75.75V21a.75.75 0 0 1-.75.75H5.625a1.875 1.875 0 0 1-1.875-1.875v-6.198a2.29 2.29 0 0 0 .091-.086L12 5.432Z" />
                                    </svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                    </svg>
                                @endif

                                <span>Home</span>
                                <span class="category_count">{{  Auth::check() ? $fullList->where('username', Auth::user()->username)->where('category', 'home')->count() : '0'}}</span>
                            </button>

                        </div>
                        <div class="categories {{ isset($category) && $category == 'work' ? 'current_category' : '' }}">
                            <button type="button" class="flex items-center gap-4" onclick="setCategoryAndSubmit('work')">
                                @if (isset($category) && $category == 'work')
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="size-6">
                                        <path fill-rule="evenodd"
                                            d="M7.5 5.25a3 3 0 0 1 3-3h3a3 3 0 0 1 3 3v.205c.933.085 1.857.197 2.774.334 1.454.218 2.476 1.483 2.476 2.917v3.033c0 1.211-.734 2.352-1.936 2.752A24.726 24.726 0 0 1 12 15.75c-2.73 0-5.357-.442-7.814-1.259-1.202-.4-1.936-1.541-1.936-2.752V8.706c0-1.434 1.022-2.7 2.476-2.917A48.814 48.814 0 0 1 7.5 5.455V5.25Zm7.5 0v.09a49.488 49.488 0 0 0-6 0v-.09a1.5 1.5 0 0 1 1.5-1.5h3a1.5 1.5 0 0 1 1.5 1.5Zm-3 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z"
                                            clip-rule="evenodd" />
                                        <path
                                            d="M3 18.4v-2.796a4.3 4.3 0 0 0 .713.31A26.226 26.226 0 0 0 12 17.25c2.892 0 5.68-.468 8.287-1.335.252-.084.49-.189.713-.311V18.4c0 1.452-1.047 2.728-2.523 2.923-2.12.282-4.282.427-6.477.427a49.19 49.19 0 0 1-6.477-.427C4.047 21.128 3 19.852 3 18.4Z" />
                                    </svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z" />
                                    </svg>
                                @endif

                                Work
                                <span class="category_count">{{  Auth::check() ? $fullList->where('username', Auth::user()->username)->where('category', 'work')->count() : '0'}}</span>
                            </button>

                        </div>

                        <div
                            class="categories {{ isset($category) && $category == 'social' && $category ? 'current_category' : '' }}">

                            <button type="button" class="flex items-center gap-4" onclick="setCategoryAndSubmit('social')">
                                @if (isset($category) && $category == 'social')
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="size-6">
                                        <path fill-rule="evenodd"
                                            d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                    </svg>
                                @endif

                                Social
                                <span class="category_count">{{  Auth::check() ? $fullList->where('username', Auth::user()->username)->where('category', 'social')->count() : '0' }}</span>
                            </button>
                        </div>

                        <div
                            class="categories {{ isset($category) && $category == 'others' && $category ? 'current_category' : '' }}">
                            <button type="button" class="flex items-center gap-4"
                                onclick="setCategoryAndSubmit('others')">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                                </svg>

                                Others
                                <span class="category_count">{{ Auth::check() ? $fullList->where('username', Auth::user()->username)->where('category', 'others')->count() : '0'}}</span>

                            </button>

                        </div>
                </form>
            </div>

        </div>





    </div>
    <div class="container mx-auto mt-4 ">

        <div class="grid gap-y-2 ">

            @guest
                <a href="{{ route('show.login') }}">
                    <div
                        class="bg-gray-200 border-2 border-gray-300 rounded-2xl  w-2/3 p-3 mx-auto transition ease-in-out hover:-translate-y-1 hover:scale-110  duration-300 cursor-pointer  active:scale-105 select-none">
                        <p class="italic">Login to create a list</p>
                    </div>
                </a>
            @endguest
            @auth

                {{-- <div
                        id="redirect-div"
                        class="bg-gray-200 border-2 border-gray-300 rounded-2xl  w-2/3 p-3 mx-auto transition ease-in-out hover:-translate-y-1 hover:scale-110  duration-300 cursor-pointer  active:scale-105 select-none" >
                        <a href="{{ route('list.create') }} " class="block w-full h-full">Add to the list</a>

                    </div> --}}


                <div
                    class="bg-blue-50 border-2 border-gray-300 rounded-full w-2/3 p-3 mx-auto transition ease-in-out hover:-translate-y-1 hover:scale-110  duration-300 cursor-pointer  active:scale-105 select-none flex justify-between flex-wrap sm:justify-center md:justify-between lg:justify-between mt-4 ">

                    <form action="{{ route('list.filter') }}" class="m-0 p-0 flex items-center gap-4 flex-wrap"
                        method="GET">
                        @csrf
                        <a href="{{ route('list.create') }}" class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </a>
                        <input type="text" name="searchThis" id="" class="w-72 bg-blue-50 outline-none"
                            placeholder="Search..." autocomplete="off">
                        <button type="submit" class="flex hover:bg-gray-300 rounded-full p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                        </button>
                        <div class="flex gap-1">
                            <input type="checkbox" name="sortByDone" id="" class="w-4"><span>Done</span>
                        </div>
                        <div class="flex gap-1">
                            <input type="checkbox" name="sortByOldest" id="" class="w-4"><span>Oldest</span>
                        </div>

                    </form>

                    {{-- 
                     <button class="bg-blue-500 text-white  rounded-md shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Delete checked</button>
                    
                      <p>Filter</p>
                        <p>Input de busxcar</p>
                     <p>Done</p>
                     <p>Date</p>
                     <p>Boton para checkearlo todo y borrar</p>

                    
                    --}}

                </div>
                <?php $counter = ($list->currentPage() - 1) * $list->perPage() + 1; ?>
                @if ($list->count() === 0)
                    <div id="redirect-div"
                        class="bg-gray-200 border-2 border-gray-300 rounded-2xl  w-2/3 p-3 mx-auto transition ease-in-out hover:-translate-y-1 hover:scale-110  duration-300 cursor-pointer  active:scale-105 select-none">
                        <a href="{{ route('list.create') }} " class="block w-full h-full">No lista</a>

                    </div>
                @endif
                @foreach ($list as $item)
                    <?php $item->description = nl2br($item->description); ?>
                    {{-- transition ease-in-out hover:-translate-y-1 hover:scale-105 duration-300 cursor-pointer active:scale-105 --}}




                    <div
                        class="flex flex-col transition ease-in-out hover:-translate-y-1 hover:scale-105 duration-300 active:scale-105">
                        <div
                            class="flex gap-x-2 {{ $item->checked ? 'bg-blue-50' : 'bg-white' }} border-2 border-gray-300 rounded-2xl w-2/3 h-14 p-3 mx-auto  select-none items-center ">
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
                            <p class="sm:text-xs md:text-sm lg:text-base truncate"><span
                                    class=" {{ $item->checked ? '' : 'font-bold' }}">
                                    {{ $counter }}. {{ $item->title }}

                                </span></p>
                            <div class="ml-auto flex gap-x-2 items-center">
                                @if ($item->due_to)
                                    <span class="italic font-bold">DUE TO: <span
                                            class="{{ $item->due_to > now() ? 'text-red-500' : 'text-green-500' }}">
                                            {{ \Carbon\Carbon::parse($item->due_to)->format('d/m/Y') }}</span></span>
                                @endif
                                @if ($item->priority === 'important')
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="size-6  text-yellow-400">
                                        <path fill-rule="evenodd"
                                            d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                @endif
                                <button onclick="showInfo(this)" class="hover:bg-gray-200 rounded-full p-2">
                                    {{-- <img src="{{ asset('img/show.png') }}" alt="" class="w-7 sm:w-3 md:w-5 lg:w-7"
                                        draggable="false"> --}}
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>

                                </button>
                                <a href="{{ route('list.show', $item) }}" class="hover:bg-gray-200 rounded-full p-2">
                                    {{-- <img src="{{ asset('img/pencil.png') }}" alt="" class="w-7 sm:w-3 md:w-5 lg:w-7"
                                        draggable="false"> --}}
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                    </svg>

                                </a>
                                <button
                                    onclick="showDialog('{{ addslashes($item->title) }}', '{{ route('list.destroy', $item) }}')"
                                    class="hover:bg-gray-200 rounded-full p-2">
                                    {{-- <img src="{{ asset('img/trash-bin.png') }}" alt="" class="w-7 sm:w-3 md:w-5 lg:w-7"
                                        draggable="false"> --}}
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>

                                </button>
                            </div>
                        </div>
                        <div
                            class="hidden gap-x-2 p-3 bg-white border-2 border-gray-300 rounded-b-2xl border-t-0 w-2/3 overflow-hidden max-h-0 transition-all duration-100 mx-auto ">
                            <span class="italic text-gray-500 text-sm">Description:</span>
                            <p class="break-words break-all">{!! $item->description !!}</p>
                            <div class="flex flex-row-reverse p-2 italic text-gray-500 text-sm gap-4">
                                <span>Status: <span>{{ $item->checked ? 'Done' : 'To Do' }}</span></span>
                                <span class="">Added at {{ $item->created_at->format('d/m/Y \-\ H:i') }}</span>
                            </div>

                        </div>
                    </div>
                    <?php $counter++; ?>
                @endforeach
                @if ($list->lastPage() > 1)
                    <div id=""
                        class="bg-gray-200 border-2 border-gray-300 rounded-2xl  w-2/3 p-3 mx-auto transition ease-in-out hover:-translate-y-1 hover:scale-110  duration-300 cursor-pointer  active:scale-105 select-none flex justify-between items-center">

                        {{-- Botó per anar a la pàgina anterior --}}
                        @if ($list->onFirstPage())
                            <button
                                class="bg-gray-300 text-gray-500 cursor-not-allowed px-4 py-2 rounded flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 16.811c0 .864-.933 1.406-1.683.977l-7.108-4.061a1.125 1.125 0 0 1 0-1.954l7.108-4.061A1.125 1.125 0 0 1 21 8.689v8.122ZM11.25 16.811c0 .864-.933 1.406-1.683.977l-7.108-4.061a1.125 1.125 0 0 1 0-1.954l7.108-4.061a1.125 1.125 0 0 1 1.683.977v8.122Z" />
                                </svg>
                                Previous
                            </button>
                        @else
                            <a href="{{ $list->previousPageUrl() }}"
                                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 16.811c0 .864-.933 1.406-1.683.977l-7.108-4.061a1.125 1.125 0 0 1 0-1.954l7.108-4.061A1.125 1.125 0 0 1 21 8.689v8.122ZM11.25 16.811c0 .864-.933 1.406-1.683.977l-7.108-4.061a1.125 1.125 0 0 1 0-1.954l7.108-4.061a1.125 1.125 0 0 1 1.683.977v8.122Z" />
                                </svg>
                                Previous
                            </a>
                        @endif

                        {{-- Informació de la pàgina actual --}}
                        <span class="text-gray-700">
                            Page
                            <span class="font-semibold">{{ $list->currentPage() }}</span>
                            of
                            <span class="font-semibold">{{ $list->lastPage() }}</span>
                        </span>

                        {{-- Botó per anar a la pàgina següent --}}
                        @if ($list->hasMorePages())
                            <a href="{{ $list->nextPageUrl() }}"
                                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition flex items-center gap-2">
                                Next
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 8.689c0-.864.933-1.406 1.683-.977l7.108 4.061a1.125 1.125 0 0 1 0 1.954l-7.108 4.061A1.125 1.125 0 0 1 3 16.811V8.69ZM12.75 8.689c0-.864.933-1.406 1.683-.977l7.108 4.061a1.125 1.125 0 0 1 0 1.954l-7.108 4.061a1.125 1.125 0 0 1-1.683-.977V8.69Z" />
                                </svg>
                            </a>
                        @else
                            <button
                                class="bg-gray-300 text-gray-500 cursor-not-allowed px-4 py-2 rounded flex items-center gap-2">
                                Next
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 8.689c0-.864.933-1.406 1.683-.977l7.108 4.061a1.125 1.125 0 0 1 0 1.954l-7.108 4.061A1.125 1.125 0 0 1 3 16.811V8.69ZM12.75 8.689c0-.864.933-1.406 1.683-.977l7.108 4.061a1.125 1.125 0 0 1 0 1.954l-7.108 4.061a1.125 1.125 0 0 1-1.683-.977V8.69Z" />
                                </svg>
                            </button>
                        @endif


                    </div>
                @endif
            @endauth
        </div>
    </div>
    <div class="laterals border-l-2 border border-gray-200"></div>
    </div>
@endsection

<script>
    function dropdownCategories(element) {

        const CATEGRIES_BUTTON_SVG = document.getElementById('categories_svg');
        const CATEGORY_BUTTON = element.parentElement;
        console.log(CATEGORY_BUTTON);
        const CATEGORIES_DROPDOWN = element.parentElement.nextElementSibling;

        if (CATEGORIES_DROPDOWN.classList.contains('hidden')) {
            CATEGORIES_DROPDOWN.classList.remove('hidden');
            CATEGORY_BUTTON.classList.add('category_btn_activated');
            CATEGRIES_BUTTON_SVG.innerHTML = `
<svg id="categories_svg" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
            `
        } else {
            CATEGORIES_DROPDOWN.classList.add('hidden');
            CATEGORY_BUTTON.classList.remove('category_btn_activated');
            CATEGRIES_BUTTON_SVG.innerHTML = `
           <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
</svg>

            `
        }

    }

    function showInfo(element) {
        const dropdown = element.parentElement.parentElement.nextElementSibling;

        const list = element.parentElement.parentElement;

        console.log(list);


        if (dropdown.classList.contains('hidden')) {
            dropdown.classList.remove('hidden');
            list.classList.remove('rounded-2xl');
            list.classList.add('rounded-t-2xl');
            dropdown.style.maxHeight = dropdown.scrollHeight + "px"; // Ajusta l'alçada
        } else {
            dropdown.style.maxHeight = "0"; // Amaga amb transició
            setTimeout(() => {
                dropdown.classList.add('hidden');
                list.classList.add('rounded-2xl');
                list.classList.remove('rounded-t-2xl');
            }, 100); // Espera fins que l'animació acabi
        }
    }

    function setCategoryAndSubmit(category) {
        document.getElementById('categoryInput').value = category;
        document.getElementById('filter_by_category').submit();

    }
</script>
