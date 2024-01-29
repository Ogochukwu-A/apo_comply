<div class="p-3 w-full">
    <div class="bg-teal-800 text-white rounded-lg text-center w-full mb-3">
        <h3 class="text-center p-6"> Add Health Metrics </h3>
    </div>
    <div class="bg-teal-800 text-white rounded-lg text-center w-100 p-6">
        <form method="POST" action="/health-info/add-health-metrics" class="w-full">
            @csrf
            {{-- sugar_level, pulse_rate, blood_pressure_top_value, blood_pressure_bottom_value --}}

            <!-- sugar level -->
            <div class="flex flex-row justify-start">
                <x-input-label for="sugar_level" class="w-full text-white py-3 text-start" :value="__('Sugar Level:')" />
                <x-text-input id="sugar_level" class="block mt-1 w-full text-teal-800" type="text"
                    name="sugar_level" :value="old('sugar_level')" required autofocus autocomplete="sugar_level"
                    placeholder="Enter Sugar Level" />
            </div>

            <x-input-error :messages="$errors->get('sugar_level')" class="mt-2 text-end" />
            {{-- sugar_level, pulse_rate, blood_pressure_top_value, blood_pressure_bottom_value --}}

            <!-- pulse_rate -->
            <div class="flex flex-row justify-start">
                <x-input-label for="pulse_rate" class="w-full text-white py-3 text-start" :value="__('Pulse Rate:')" />
                <x-text-input id="pulse_rate" class="block mt-1 w-full text-teal-800" type="text"
                    name="pulse_rate" :value="old('pulse_rate')" required autofocus autocomplete="pulse_rate"
                    placeholder="Enter Pulse Rate" />
            </div>

            <x-input-error :messages="$errors->get('pulse_rate')" class="mt-2 text-end" />
            {{-- sugar_level, pulse_rate, blood_pressure_top_value, blood_pressure_bottom_value --}}

            <!-- blood_pressure_top_value -->
            <div class="flex flex-row justify-start">
                <x-input-label for="blood_pressure_top_value" class="w-full text-white py-3 text-start" :value="__('Blood Pressure Top Value:')" />
                <x-text-input id="blood_pressure_top_value" class="block mt-1 w-full text-teal-800" type="text"
                    name="blood_pressure_top_value" :value="old('blood_pressure_top_value')" required autofocus autocomplete="blood_pressure_top_value"
                    placeholder="Enter Blood Pressure Top Value" />
            </div>

            <x-input-error :messages="$errors->get('blood_pressure_top_value')" class="mt-2 text-end" />
            {{-- sugar_level, pulse_rate, blood_pressure_top_value, blood_pressure_bottom_value --}}

            <!-- blood_pressure_bottom_value -->
            <div class="flex flex-row justify-start">
                <x-input-label for="blood_pressure_bottom_value" class="w-full text-white py-3 text-start" :value="__('Blood Pressure Bottom Value:')" />
                <x-text-input id="blood_pressure_bottom_value" class="block mt-1 w-full text-teal-800" type="text"
                    name="blood_pressure_bottom_value" :value="old('blood_pressure_bottom_value')" required autofocus autocomplete="blood_pressure_bottom_value"
                    placeholder="Enter Blood Pressure Bottom Value" />
            </div>

            <x-input-error :messages="$errors->get('blood_pressure_bottom_value')" class="mt-2 text-end" />
            {{-- sugar_level, pulse_rate, blood_pressure_top_value, blood_pressure_bottom_value --}}

            <x-primary-button class="mt-4">
                {{ __('Add Health Metrics') }}
            </x-primary-button>
        </form>
    </div>
</div>
