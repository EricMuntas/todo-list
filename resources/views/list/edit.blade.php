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
                placeholder="Title..."
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
                placeholder="Description..."
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">{{old('description', $list->description)}}</textarea>
            @error('description')
                <p class="text-red-500 text-sm mt-1">{{$message}}</p>
            @enderror
        </div>
        <div class="flex gap-6">
            <div>
                <label for="category">Category:</label>
                <select name="category" id="">
                    <option value="home"  {{ old('category', $list->category) == 'home' ? 'selected' : '' }}>Home</option>
                    <option value="work"  {{ old('category', $list->category) == 'work' ? 'selected' : '' }}>Work</option>
                    <option value="social"  {{ old('category', $list->category) == 'social' ? 'selected' : '' }}>Social</option>
                    <option value="others"  {{ old('category', $list->category) == 'others' ? 'selected' : '' }}>Others</option>
                </select>
            </div>
            <div>
                <label for="priority">Priority:</label>
                <select name="priority" id="">
                    <option value="normal" {{ old('priority', $list->priority) == 'normal' ? 'selected' : '' }}>Normal</option>
                    <option value="important" {{ old('priority', $list->priority) == 'important' ? 'selected' : '' }}>Important</option>
                </select>
            </div>
        </div>
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700">Due to:</label>
            <input 
                type="date" 
                name="due_to" 
                id="due_to" 
                value="{{ old('due_to', $list->due_to) }}" 
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
            >
            @error('due_to')
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
