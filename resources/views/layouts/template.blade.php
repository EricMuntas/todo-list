<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    {{-- @vite('resources/css/app.css')
    @vite('resources/js/app.js') --}}
    @vite(['resources/js/app.js', 'resources/css/app.css'])

</head>

<body class="h-screen">

    @include('layouts.partials.header')
    @include('layouts.partials.deletemodal')

    <div class="flex flex-row h-screen w-screen">
        @include('layouts.partials.leftsection')
        @yield('content')
        @include('layouts.partials.rightsection')
    </div>
</body>
<script>
    function openLeftMenu() {
        const LEFT_MENU = document.getElementById('left-menu');
        const MAIN = document.getElementById('main');
        const SEARCH_BAR = document.getElementById('search-bar');
        // w-full md:w-4/6
        if (LEFT_MENU.classList.contains('hidden')) {
            LEFT_MENU.classList.remove('hidden');
            LEFT_MENU.classList.add('block');
            MAIN.classList.remove('w-full')
            MAIN.classList.add('w-2/4')
            SEARCH_BAR.classList.add('hidden')
        } else {
            LEFT_MENU.classList.remove('block');
            LEFT_MENU.classList.add('hidden');
            MAIN.classList.add('w-full')
            MAIN.classList.remove('w-2/4')
        }

    }
    /*

    */
    function openRightMenu() {

        const RIGHT_MENU = document.getElementById('right-menu');
        const MAIN = document.getElementById('main');
        const SEARCH_BAR = document.getElementById('search-bar');
        // w-full md:w-4/6
        if (RIGHT_MENU.classList.contains('hidden')) {
            RIGHT_MENU.classList.remove('hidden');
            RIGHT_MENU.classList.add('block');
            MAIN.classList.remove('w-full')
            MAIN.classList.add('w-2/4')
            SEARCH_BAR.classList.add('hidden')


        } else {
            RIGHT_MENU.classList.remove('block');
            RIGHT_MENU.classList.add('hidden');
            MAIN.classList.add('w-full')
            MAIN.classList.remove('w-2/4')

        }

    }

    function openSearchBar() {

        const LEFT_MENU = document.getElementById('left-menu');
        const RIGHT_MENU = document.getElementById('right-menu');
        const SEARCH_BAR = document.getElementById('search-bar');
        const MAIN = document.getElementById('main');

        if (SEARCH_BAR.classList.contains('hidden')) {
            RIGHT_MENU.classList.add('hidden');
            LEFT_MENU.classList.add('hidden');
            SEARCH_BAR.classList.remove('hidden');
            SEARCH_BAR.classList.add('flex')
            MAIN.classList.remove('w-2/4')

        } else {


            SEARCH_BAR.classList.add('hidden');
            SEARCH_BAR.classList.remove('flex');

        }

    }

    function dropdownCategories(element) {

        // const CATEGRIES_BUTTON_SVG = document.getElementById('categories_svg');
        const CATEGRIES_BUTTON_SVG = element.firstElementChild;
        const CATEGORY_BUTTON = element.parentElement;

        const CATEGORIES_DROPDOWN = element.parentElement.nextElementSibling;
        console.log(CATEGORIES_DROPDOWN);
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

        const FATHER_ELEMENT = list.parentElement;
        console.log(list);


        if (dropdown.classList.contains('hidden')) {
            dropdown.classList.remove('hidden');
            // list.classList.remove('rounded-full');
            // list.classList.add('rounded-t-2xl');
            // FATHER_ELEMENT.classList.remove('rounded-full');
            // FATHER_ELEMENT.classList.add('rounded-2xl');

            list.classList.remove('border-b-blue-500');

            list.classList.add('border-b-gray-200');
            dropdown.style.maxHeight = dropdown.scrollHeight + "px"; // Ajusta l'alçada
        } else {
            dropdown.style.maxHeight = "0"; // Amaga amb transició
            setTimeout(() => {
                dropdown.classList.add('hidden');
                // list.classList.add('rounded-full');
                // list.classList.remove('rounded-t-2xl');
                // FATHER_ELEMENT.classList.add('rounded-full');
                // FATHER_ELEMENT.classList.remove('rounded-2xl');

                list.classList.remove('border-b-gray-200');
                list.classList.add('border-b-blue-500');

            }, 100); // Espera fins que l'animació acabi
        }
    }

    function setCategoryAndSubmit(category) {
        document.getElementById('categoryInput').value = category;
        document.getElementById('filter_by_category').submit();

    }
</script>

</html>
