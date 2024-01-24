<div class="p-3 w-full">
    <div class="bg-teal-800 text-white rounded-lg text-center w-100 p-6">
        @if ($prescriptions)

        @else

        @endif
        <form method="POST" action="{{ route('healthinfo.add_prescription') }}" class="w-full">
            @csrf

            <!-- Medication Name -->
            <div class="flex flex-row justify-start">
                <x-input-label for="medication_name" class="w-full text-white py-3 text-start"
                    :value="__('Medication Name:')" />
                <x-text-input id="medication_name" class="block mt-1 w-full text-teal-800" type="text"
                    name="medication_name" :value="{{ $prescription->medication_name }}" required autofocus
                    autocomplete="medication_name" placeholder="Enter Medication Name" />
            </div>

            <x-input-error :messages="$errors->get('medication_name')" class="mt-2 text-end" />
            {{-- medication_name, medication_mode, start_date, end_date, medication_frequency --}}

            {{-- mode of medication --}}
            <div class="flex flex-row justify-start my-3">
                <x-input-label for="medication_mode" class="w-full text-white py-3 text-start"
                    :value="__('Mode of Medication:')" />
                <select name="medication_mode" class="block mt-1 w-100 rounded-lg text-teal-800" required>
                    <option value="" default name="medication_mode[]">-- Select a Mode of Medication
                        --
                    </option>
                    <option value="oral" name="medication_mode[]" @if($prescription->medication_mode  == 'oral') {{ 'Selected' }}@endif> Oral medication (Pills, syrups
                        etc) </option>
                    <option value="inhaler" @if($prescription->medication_mode  == 'inhaler') {{ 'Selected' }}@endif name="medication_mode[]"> Inhaler</option>
                    <option value="injection" @if($prescription->medication_mode  == 'injection') {{ 'Selected' }}@endif name="medication_mode[]"> Injection</option>
                    <option value="iv"  @if($prescription->medication_mode  == 'iv') {{ 'Selected' }}@endif name="medication_mode[]"> IV</option>
                </select>
                
            </div>
            <x-input-error :messages="$errors->get('medication_mode')" class="mt-2 text-end" />

            {{-- Start Date  --}}
            <div class="flex flex-row justify-start my-3">
                <x-input-label for="start_date" class="w-full text-white py-3 text-start"
                    :value="__('Start Date:')" />
                <x-text-input id="start_date" class="block mt-1 w-full text-teal-800" type="date"
                    name="start_date" :value="{{$prescription->start_date}}" required autofocus autocomplete="start_date" />
            </div>
            <x-input-error :messages="$errors->get('start_date')" class="mt-2 text-end" />
            {{-- end date  --}}

            <div class="flex flex-row justify-start my-3">
                <x-input-label for="end_date" class="w-full text-white py-3 text-start" :value="__('End Date:')" />
                <x-text-input id="end_date" class="block mt-1 w-full text-teal-800" type="date"
                    name="end_date" :value="{{$prescription->end_date}}" required autofocus autocomplete="end_date" />
               
            </div>
            <x-input-error :messages="$errors->get('end_date')" class="mt-2 text-end" />

            <div class="flex flex-row justify-start my-3">
                <x-input-label for="medication_frequency" class="w-full text-white text-start"
                    :value="__('Frequency of Medication:')" />
                <select name="medication_frequency" class="block mt-1 w-100 rounded-lg text-teal-800"
                    required>
                    <option value="" default name="medication_frequency[]">-- Select a Frequency of
                        Medication --
                    </option>
                    <option value="once_daily" name="medication_frequency[]" @if($prescription->medication_mode  == 'once_daily') {{ 'Selected' }}@endif> Once daily </option>
                    <option value="twice_daily" name="medication_frequency[]" @if($prescription->medication_mode  == 'twice_daily') {{ 'Selected' }}@endif> Twice Daily </option>
                    <option value="three_times_daily" name="medication_frequency[]" @if($prescription->medication_mode  == 'three_times_daily') {{ 'Selected' }}@endif> Three times Daily
                    </option>
                    <option value="once_eight_hours" name="medication_frequency[]" @if($prescription->medication_mode  == 'once_eight_hours') {{ 'Selected' }}@endif> Once in 8 hrs </option>
                </select>
            </div>
            <x-input-error :messages="$errors->get('medication_name')" class="mt-2 text-end" />

            <x-primary-button class="mt-4">
                {{ __('Add Medication') }}
            </x-primary-button>
        </form>
    </div>
</div>