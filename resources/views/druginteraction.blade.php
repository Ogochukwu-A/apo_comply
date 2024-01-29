<x-app-layout>
    <!-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> -->

    <style type="text/css">
        .click_feature {
            cursor:pointer;
            margin:10px;
            padding:20px;
            border: 1px solid #ffffff;
            border-radius: 15px;
        }

        .click_feature:hover{
            cursor:pointer;
            margin:10px;
            padding:20px;
            background: #000000;
            border: 1px solid #ffffff;
            border-radius: 15px;
            color: #ffffff;
        }
    </style>

    <div class="py-12 min-w-full">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __('Drug Interaction Block') }}
                </div>
            </div>

            @if (session('message'))
                <div class="bg-teal-800 text-white text-lg m-3 rounded-lg">
                    <p class="p-3">

                        {!! session('message')!!}

                    </p>
                </div>
            @endif
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4 my-4 w-full">
                <div class="w-full">
                    <!-- Your content for the first column (full width) -->
                    @if (count($drugInteraction))

                        @foreach ($drugInteraction as $value)
                            <div class="bg-slate-800 my-4 p-1 text-white rounded-lg text-start w-full">
                                <div class="flex flex-row h-100">
                                    <h3 class="text-start text-white p-2 justify-center m-1">
                                        {{ ucwords($value->name) }}
                                    </h3>

                                    <div class="ml-auto">
                                        <button x-data="{{ $value->name }}"
                                            x-on:click.prevent="$dispatch('open-modal', 'confirm-drug-deletion{{ $value->name }}')"
                                            class="bg-red-500 hover:bg-red-800 text-white p-3 rounded-lg "
                                            title="Delete {{ ucwords($value->medication_name) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="#ffffff" height="24" viewBox="0 -960 960 960" width="24"><path d="M312-172q-25 0-42.5-17.5T252-232v-488h-40v-28h148v-28h240v28h148v28h-40v488q0 26-17 43t-43 17H312Zm368-548H280v488q0 14 9 23t23 9h336q12 0 22-10t10-22v-488ZM402-280h28v-360h-28v360Zm128 0h28v-360h-28v360ZM280-720v520-520Z"/></svg>
                                        </button>

                                        <x-modal name="confirm-drug-deletion{{ $value->name }}" :show="$errors->drugDeletion->isNotEmpty()"
                                            focusable>
                                            <form method="post" action="{{ route('drugs.delete') }}" class="p-6">
                                                @csrf
                                                @method('delete')

                                                <h2 class="text-lg font-medium text-gray-900">
                                                    {{ __('Are you sure you want to delete this drug - ' . ucwords($value->name) . ' ?') }}
                                                </h2>

                                                <div class="mt-6">
                                                    <input id="name" name="name" type="hidden"
                                                        class="mt-1 block w-3/4 text-teal-800"
                                                        value="{{ $value->name }}" />
                                                    <x-input-error :messages="$errors->prescriptionDeletion->get('name')" class="mt-2" />
                                                </div>

                                                <div class="mt-6 flex justify-end">
                                                    <x-secondary-button x-on:click="$dispatch('close')">
                                                        {{ __('Cancel') }}
                                                    </x-secondary-button>

                                                    <x-danger-button class="ms-3">
                                                        {{ __('Delete Drug') }}
                                                    </x-danger-button>
                                                </div>
                                            </form>
                                        </x-modal>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p> Sorry you don't have any drugs available</p>
                    @endif
                </div>
                <div class="w-full bg-teal-800 p-4 rounded-lg">
                    <!-- Drug Search Form -->
                    <form method="POST" action="/drugs/add">
                        @csrf
                        <div class="w-full">
                            <input type="text" name="search_input" id="searchInput" class="rounded-lg"
                                placeholder="Search for drugs..." />
                            <button type="submit" id="addItemButton"
                                class="rounded-lg bg-white p-3 hover:bg-black hover:ring-2 hover-ring-white  hover:text-white text-teal-800">Add
                                Item</button>
                        </div>
                    </form>

                    <!-- Display Search Results -->
                    <ul id="searchResults"></ul>
                </div>
            </div>
        </div>
    </div>

    <!-- resources/views/drug-interaction.blade.php -->
    @section('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const addItemButton = document.getElementById('addItemButton');
                const leftList = document.getElementById('leftList');
                const searchInput = document.getElementById('searchInput');
                const searchResults = document.getElementById('searchResults');

                addItemButton.addEventListener('click', function() {
                    const selectedDrug = searchInput.value.trim();

                    if (selectedDrug !== '') {
                        // Create a new list item for the left list
                        const listItem = document.createElement('li');
                        listItem.textContent = selectedDrug;
                        listItem.classList.add('text-white');

                        // Append the new item to the left list
                        leftList.appendChild(listItem);

                        // TODO: Add logic to save the selected drug to the database
                        saveToDatabase(selectedDrug);

                        // i need to check the item with the other items 

                        // Clear the search input
                        searchInput.value = '';
                        // Clear the search results
                        searchResults.innerHTML = '';
                    }
                });

                searchInput.addEventListener('input', function() {
                    const query = this.value.trim();

                    if (query.length >= 3) {
                        // Make Ajax request to fetch drug results
                        fetch(`/drugs/search?q=${query}`)
                            .then(response => response.json())
                            .then(data => {
                                // Update search results
                                searchResults.innerHTML = '';

                                data.forEach(drug => {
                                    const listItem = document.createElement('li');
                                    listItem.textContent = drug
                                    .name; // Use drug name as selected drug
                                    listItem.classList.add('text-white', 'click_feature');
                                    listItem.addEventListener('click', function() {
                                        searchInput.value = drug
                                        .name; // Set search input value on click
                                        searchResults.innerHTML =
                                        ''; // Clear search results
                                    });
                                    searchResults.appendChild(listItem);
                                });
                            });
                    } else {
                        searchResults.innerHTML = '';
                    }
                });

                function saveToDatabase(drug) {
                    // TODO: Add logic to save the drug to the database
                    // You can use AJAX or any other method to send the data to your server

                    // Make an AJAX request to your ChatGPT endpoint
                    fetch('/add-drug-interaction', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                // Add any other headers as needed
                            },
                            body: JSON.stringify({
                                drug: drug,
                                otherDrugs: Array.from(leftList.children).map(item => item.textContent
                                .trim()),
                            }),
                        })
                        .then(response => response.json())
                        .then(interactionData => {
                            // TODO: Handle the drug interaction data (e.g., display it to the user)
                            console.log('Drug Interaction Data:', interactionData);
                        })
                        .catch(error => {
                            console.error('Error fetching drug interaction data:', error);
                        });
                }
            });
        </script>
    @endsection
</x-app-layout>
