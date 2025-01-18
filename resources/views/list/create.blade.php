@extends('layouts.template')
@section('title', 'Create')

@section('content')
    {{-- VALIDAR SI ES EN BLANC --}}
    <div class="max-w-4xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6 text-center text-gray-700">Create TO-DO List</h2>

        <form action="{{ route('list.store') }}" method="POST" class="space-y-6">
            @csrf

            {{-- Campo de título --}}
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Title:</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Campo de descripción --}}
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description:</label>
                <textarea name="description" id="description" cols="30" rows="5"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            {{-- Priority, Category --}}
            <div class="flex gap-6">
                <div>
                    <label for="category">Category:</label>
                    <select name="category" id="">
                        <option value="home">Home</option>
                        <option value="work">Work</option>
                        <option value="social">Social</option>
                        <option value="others">Others</option>
                    </select>
                </div>
                <div>
                    <label for="priority">Priority:</label>
                    <select name="priority" id="">
                        <option value="normal">Normal</option>
                        <option value="important">Important</option>
                    </select>
                </div>
            </div>
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Date:</label>
                <input type="date" name="dueTo" id="dueTo" value="{{ old('dueTo') }}"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                @error('dueTo')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Botón de enviar --}}
            <div class="text-center flex justify-between">
                <a href="{{ route('list.index') }}">
                    <button type="button"
                        class="bg-red-500 text-white py-2 px-4 rounded-md shadow-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>

                        Cancel
                    </button>
                </a>
                <button type="submit"
                    class="bg-blue-500 text-white py-2 px-4 rounded-md shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    Create
                </button>

            </div>
        </form>
    </div>

@endsection
