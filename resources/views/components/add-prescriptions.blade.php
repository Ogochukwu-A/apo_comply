<div class="p-3 w-full">
    <div class="bg-teal-800 text-white rounded-lg text-center w-full mb-3">
        <h3 class="text-center p-6"> Add Medication </h3>
    </div>
    <div class="bg-teal-800 text-white rounded-lg text-center w-100 p-6">
        <form method="POST" action="/health-info/add-prescription" class="w-full">
            @csrf

            <!-- Medication Name -->
            <div class="flex flex-row justify-start">
                <x-input-label for="medication_name" class="w-full text-white py-3 text-start" :value="__('Medication Name:')" />
                <x-text-input id="medication_name" class="block mt-1 w-full text-teal-800" type="text"
                    name="medication_name" :value="old('medication_name')" required autofocus autocomplete="medication_name"
                    placeholder="Enter Medication Name" />

            </div>

            <x-input-error :messages="$errors->get('medication_name')" class="mt-2 text-end" />
            {{-- medication_name, medication_mode, start_date, end_date, medication_frequency --}}

            {{-- mode of medication --}}
            <div class="flex flex-row justify-start my-3">
                <x-input-label for="medication_mode" class="w-full text-white py-3 text-start" :value="__('Mode of Medication:')" />
                <select name="medication_mode" class="block mt-1 w-100 rounded-lg text-teal-800" required>
                    <option value="" default name="medication_mode[]">-- Select a Mode of Medication
                        --
                    </option>
                    <option value="oral" name="medication_mode[]"> Oral medication (Pills, syrups
                        etc) </option>
                    <option value="inhaler" name="medication_mode[]"> Inhaler</option>
                    <option value="injection" name="medication_mode[]"> Injection</option>
                    <option value="iv" name="medication_mode[]"> IV</option>
                </select>

            </div>
            <x-input-error :messages="$errors->get('medication_name')" class="mt-2 text-end" />

            {{-- Start Date  --}}
            <div class="flex flex-row justify-start my-3">
                <x-input-label for="start_date" class="w-full text-white py-3 text-start" :value="__('Start Date:')" />
                <x-text-input id="start_date" class="block mt-1 w-full text-teal-800" type="date" name="start_date"
                    :value="old('start_date')" required autofocus autocomplete="start_date" />

            </div>
            <x-input-error :messages="$errors->get('start_date')" class="mt-2 text-end" />
            {{-- end date  --}}
            <div class="flex flex-row justify-start my-3">
                <x-input-label for="end_date" class="w-full text-white py-3 text-start" :value="__('End Date:')" />
                <x-text-input id="end_date" class="block mt-1 w-full text-teal-800" type="date" name="end_date"
                    :value="old('end_date')" required autofocus autocomplete="end_date" />

            </div>
            <x-input-error :messages="$errors->get('end_date')" class="mt-2 text-end" />

            <div class="flex flex-row justify-start my-3">
                <x-input-label for="daily_time" class="w-full text-white py-3 text-start" :value="__('Daily Time:')" />
                <x-text-input id="daily_time" class="block mt-1 w-full text-teal-800" type="time" name="daily_time"
                    :value="old('daily_time')" required autofocus autocomplete="daily_time" />

            </div>
            <x-input-error :messages="$errors->get('daily_time')" class="mt-2 text-end" />
            <div class="flex flex-row justify-start my-3">
                <x-input-label for="medication_frequency" class="w-full text-white text-start" :value="__('Frequency of Medication:')" />
                <select name="medication_frequency" class="block mt-1 w-100 rounded-lg text-teal-800" required>
                    <option value="" default name="medication_frequency[]">-- Select a Frequency of
                        Medication --
                    </option>
                    <option value="once_daily" name="medication_frequency[]"> Once daily </option>
                    <option value="twice_daily" name="medication_frequency[]"> Twice Daily </option>
                    <option value="three_times_daily" name="medication_frequency[]"> Three times Daily
                    </option>
                    <option value="once_eight_hours" name="medication_frequency[]"> Once in 8 hrs </option>
                </select>

            </div>
            <x-input-error :messages="$errors->get('medication_frequency')" class="mt-2 text-end" />

            <x-primary-button class="mt-4">
                {{ __('Add Medication') }}
            </x-primary-button>
        </form>
    </div>
</div>
