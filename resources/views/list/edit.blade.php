@extends('layouts.template')
@section('title', 'Editing "'. $list->title.'"')

@section('content')
<div class="max-w-4xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-3xl font-bold text-gray-700 text-center">Editing List</h1>

    <form action="{{route('list.update', $list)}}" method="POST" class="space-y-6 mt-6">
        @csrf
        @method('PUT')

        {{-- Campo de título --}}
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700">Title:</label>
            <input 
                type="text" 
                name="title" 
                id="title" 
                value="{{old('title', $list->title)}}" 
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            @error('title')
                <p class="text-red-500 text-sm mt-1">{{$message}}</p>
            @enderror
        </div>

        {{-- Campo de descripción --}}
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Description:</label>
            <textarea 
                name="description" 
                id="description" 
                cols="30" 
                rows="5" 
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">{{old('description', $list->description)}}</textarea>
            @error('description')
                <p class="text-red-500 text-sm mt-1">{{$message}}</p>
            @enderror
        </div>
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700">Due to:</label>
            <input 
                type="date" 
                name="dueTo" 
                id="dueTo" 
                value="{{ old('dueTo') }}" 
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
            >
            @error('dueTo')
                <p class="text-red-500 text-sm mt-1">{{$message}}</p>
            @enderror
        </div>
        {{-- Botón de actualizar --}}
        <div class="text-center flex justify-between">
            <a href="{{route('list.index')}}">
                <button 
                type="button" 
                class="bg-red-500 text-white py-2 px-4 rounded-md shadow-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                  </svg>
                  
                Cancel
            </button>
            </a>
            <button 
                type="submit" 
                class="bg-blue-500 text-white py-2 px-4 rounded-md shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                  </svg>
                  
                Update
            </button>
           
        </div>
    </form>
</div>
@endsection
