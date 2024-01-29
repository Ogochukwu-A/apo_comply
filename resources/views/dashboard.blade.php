<x-app-layout>
    <!-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> -->

    <div class="py-12 ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            {{-- <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div> --}}

            <div class="grid lg:grid-cols-4  sm:grid-cols-1 w-full gap-6 justify-center align-middle mx-auto">
                <a href="/health-info"> 
                    <div class="bg-teal-800 text-white w-full flex flex-row justify-center p-6 rounded-lg hover:bg-white hover:text-teal-800 hover:ring-2 hover:ring-teal-800 duration-300">
                    
                    <p>My Health Info</p>
                </div>
                </a>
                <a href="/reminder"> 
                <div class="bg-teal-800 text-white w-full flex flex-row justify-center p-6 rounded-lg hover:bg-white hover:text-teal-800 hover:ring-2 hover:ring-teal-800 duration-300">
                    <img />
                    <p>Reminder</p>
                </div>
                </a>
                <a href="/drug-interaction">
                <div class="bg-teal-800 text-white w-full flex flex-row justify-center p-6 rounded-lg hover:bg-white hover:text-teal-800 hover:ring-2 hover:ring-teal-800 duration-300">
                    <img />
                    <p>Drug Interaction</p>
                </div>
                </a>
                <a href="/chatbot">
                    <div class="bg-teal-800 text-white w-full flex flex-row justify-center p-6 rounded-lg hover:bg-white hover:text-teal-800 hover:ring-2 hover:ring-teal-800 duration-300">
                        <img />
                        <p>AI Chatbot</p>
                    </div>
                </a>
                <a href="/appointment">
                    <div class="bg-teal-800 text-white w-full flex flex-row justify-center p-6 rounded-lg hover:bg-white hover:text-teal-800 hover:ring-2 hover:ring-teal-800 duration-300">
                        <img />
                        <p>Appointment</p>
                    </div>
                </a>
                <a href="/contact"> 
                <div class="bg-teal-800 text-white w-full flex flex-row justify-center p-6 rounded-lg hover:bg-white hover:text-teal-800 hover:ring-2 hover:ring-teal-800 duration-300">
                    <img />
                    <p>Contact</p>
                </div>
                </a>
            </div>
        </div>
    </div>

   

</x-app-layout>
