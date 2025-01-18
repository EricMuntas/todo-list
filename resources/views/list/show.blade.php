@extends('layouts.template')
@section('title','List: "'. $list->title.'"')
@section('content')
    <div class="max-w-4xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md space-y-4">
        <h1 class="text-3xl font-bold text-gray-700 text-center">Showing List Details</h1>

        <div class="space-y-2">
            <p class="text-lg font-medium text-gray-600">Title: <span
                    class="font-semibold text-gray-800">{{ $list->title }}</span></p>
            <p class="text-lg font-medium text-gray-600">Description: <span
                    class="font-semibold text-gray-800 break-words break-all">{{ $list->description }}</span></p>
            <p class="text-lg font-medium text-gray-600">Status: <span
                    class="font-semibold text-gray-800">{{ $list->checked ? 'Done' : 'To Do' }}</span></p>


            <div class="flex items-center justify-center gap-10">
                <p class="text-lg font-medium text-gray-600">Created at: <span class="font-semibold text-gray-800">{{ $list->created_at->format('d/m/Y \-\ H:i') }}</span></p>

                <p class="text-lg font-medium text-gray-600">Modified at: <span class="font-semibold text-gray-800">{{ $list->updated_at->format('d/m/Y \-\ H:i') }}</span></p>
            </div>

            <div class="flex flex-row-reverse p-2 italic text-gray-500 gap-4">
                <span>Status: <span>{{ $list->checked ? 'Done' : 'To Do' }}</span></span>
                <span class="">Added at {{ $list->created_at->format('d/m/Y \-\ H:i') }}</span>
            </div>


        </div>


















        <div class="flex justify-between items-center mt-6 gap-4">
            <a href="{{ route('list.index') }}" class="text-blue-500 hover:underline font-medium flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                  </svg>       
                Go back...
            </a>

            <div class="flex gap-4">
                <a href="{{ route('list.edit', $list) }}">
                    <button
                        class="bg-blue-500 text-white py-2 px-4 rounded-md shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                        </svg>
                        Edit
                    </button>
                </a>

                <button onclick="showDialog('{{ addslashes($list->title) }}', '{{ route('list.destroy', $list) }}')"
                    class="bg-red-500 text-white py-2 px-4 rounded-md shadow-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                    </svg>
                    Delete
                </button>
            </div>
        </div>
    </div>



@endsection
