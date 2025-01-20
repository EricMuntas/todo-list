@extends('layouts.template')
@section('title','List: "'. $list->title.'"')
@section('content')
    <div class="max-w-4xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md space-y-4">
        <div class="flex items-center justify-between">
            <h1 class="text-3xl font-bold text-gray-700 text-center">Showing List Details</h1>
    
            @if ($list->priority === 'important')
            <p class="text-yellow-400 flex">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8">
                    <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" />
                </svg>
            </p>
            @endif
        </div>
        <div class="space-y-2">
            <p class="showing_details">Title: <span
                    class="">{{ $list->title }}</span></p>
            <p class="showing_details">Description: <span
                    class="break-words break-all">{{ $list->description }}</span></p>
            <p class="showing_details">Status: <span
                    class="">{{ $list->checked ? 'Done' : 'To Do' }}</span></p>
                    <p class="showing_details">Category: <span
                        class="">{{ ucfirst($list->category) }}</span></p>


                        <div class="flex items-center justify-center gap-10">
                            <p class="showing_details">Due to: <span class="">{{ \Carbon\Carbon::parse($list->due_to)->format('d/m/Y') }}</span></p>
        
                        </div>

            <div class="flex items-center justify-center gap-10">
                <p class="showing_details">Created at: <span class="">{{ $list->created_at->format('d/m/Y \-\ H:i') }}</span></p>

                <p class="showing_details">Modified at: <span class="">{{ $list->updated_at->format('d/m/Y \-\ H:i') }}</span></p>
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
