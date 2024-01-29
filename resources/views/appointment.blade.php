<x-app-layout>
    <!-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> -->

    <div class="py-12">

        <div class="grid ">
            <p class="m-4 text-3xl ">Book appointment here</p>

            {{-- patient_name,patient_email,patient_subject, patient_appointment_time, patient_appointment_date, patient_description--}}
            <form method="POST" action="/save-appointment" class="m-6 -my-3">
                @csrf
                @method('POST')
                <div class="grid grid-flow-row grid-cols-2 gap-4">
                    <!-- Patient Name -->
                    <div class="flex flex-row flex-wrap justify-start">
                        <x-input-label for="patient_name" class="w-full text-teal-800 py-3 text-start"
                            :value="__('Patient Name:')" />
                        <x-text-input id="patient_name" class="block mt-1 w-full text-teal-800" type="text"
                            name="patient_name" :value="old('patient_name')" required autofocus autocomplete="patient_name"
                            placeholder="Enter Patient Name" />

                    </div>
                    <x-input-error :messages="$errors->get('patient_name')" class="mt-2 text-end" />

                    <!-- Patient Email -->
                    <div class="flex flex-row flex-wrap justify-start">
                        <x-input-label for="patient_email" class="w-full text-teal-800 py-3 text-start"
                            :value="__('Patient Email:')" />
                        <x-text-input id="patient_email" class="block mt-1 w-full text-teal-800" type="email"
                            name="patient_email" :value="old('patient_email')" required autofocus autocomplete="patient_email"
                            placeholder="Enter Patient Email" />

                    </div>
                    <x-input-error :messages="$errors->get('patient_email')" class="mt-2 text-end" />

                </div>

                <div class="grid grid-flow-row grid-cols-2 gap-4">

                    <!-- Patient Subject -->
                    <div class="flex flex-row flex-wrap justify-start">
                        <x-input-label for="patient_subject" class="w-full text-teal-800 py-3 text-start"
                            :value="__('Subject:')" />
                        <x-text-input id="patient_subject" class="block mt-1 w-full text-teal-800" type="text"
                            name="patient_subject" :value="old('patient_subject')" required autofocus autocomplete="patient_subject"
                            placeholder="Enter Subject" />

                    </div>
                    <x-input-error :messages="$errors->get('patient_subject')" class="mt-2 text-end" />

                    <!-- Patient appointment  Time -->
                    <div class="flex flex-row flex-wrap justify-start">
                        <x-input-label for="patient_appointment_time" class="w-full text-teal-800 py-3 text-start"
                            :value="__('Appointment Time:')" />
                        <x-text-input id="patient_appointment_time" class="block mt-1 w-full text-teal-800"
                            type="time" name="patient_appointment_time" :value="old('patient_appointment_time')" required autofocus
                            autocomplete="patient_appointment_time" placeholder="Enter Subject" />

                    </div>
                    <x-input-error :messages="$errors->get('patient_appointment_time')" class="mt-2 text-end" />
                </div>

                <div class="grid grid-flow-row grid-cols-2 gap-4">
                    <!-- Patient appointment  Date -->
                    <div class="flex flex-row flex-wrap justify-start">
                        <x-input-label for="patient_appointment_date" class="w-full text-teal-800 py-3 text-start"
                            :value="__('Appointment Date:')" />
                        <x-text-input id="patient_appointment_date" class="block mt-1 w-full text-teal-800"
                            type="date" name="patient_appointment_date" :value="old('patient_appointment_date')" required autofocus
                            autocomplete="patient_appointment_date" placeholder="Enter Subject" />

                    </div>
                    <x-input-error :messages="$errors->get('patient_appointment_date')" class="mt-2 text-end" />

                    <!-- Patient description -->
                    <div class="flex flex-row flex-wrap justify-start">
                        <x-input-label for="patient_description" class="w-full text-teal-800 py-3 text-start"
                            :value="__('Describe your Ailment:')" />
                        <x-text-area id="patient_description" class="block mt-1 w-full text-teal-800" type="date"
                        name="patient_description" :value="old('patient_description')" required autofocus
                        autocomplete="patient_description" placeholder="Describe your Ailment"></x-text-area>

                    </div>
                    <x-input-error :messages="$errors->get('patient_description')" class="mt-2 text-end" />

                </div>
                <x-primary-button class="mt-4">
                    {{ __('Book Appointment') }}
                </x-primary-button>
            </form>

        </div>

    </div>




</x-app-layout>
