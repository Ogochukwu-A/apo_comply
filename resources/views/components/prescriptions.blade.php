<div class="p-3 justify-items-center">
    <div class="bg-teal-800 text-white rounded-lg text-center w-full">
        <h3 class="text-center p-6"> Current Medication </h3>
    </div>

    @if (count($prescriptions) > 0)
        @foreach ($prescriptions as $key => $value)
            <div class="bg-slate-800 my-4 p-1 text-white rounded-lg text-start w-full">
                <div class="flex flex-row h-100">
                    <h3 class="text-start text-white p-2 justify-center m-1">
                        {{ ucwords($value->medication_name) }}</h3>

                    <span
                        class="p-2 ring-1 ring-white rounded-2xl m-2 h-10">{{ ucwords($value->medication_mode) }}</span>

                    <p class="p-2 ring-1 ring-white rounded-2xl m-2 ">
                        {{ implode(' ', explode('_', ucwords($value->medication_frequency))) }}</p>

                        @if ($value->daily_time)  
                            <p class="p-2 ring-1 ring-white rounded-2xl m-2 ">
                            {{ $value->daily_time ? implode(' ', explode('_', ucwords($value->daily_time))) : ""}}</p>
                        @endif
    
                    <div class="ml-auto">
                        {{-- <button class="bg-sky-500 hover:bg-sky-800 text-white p-3 rounded-lg " x-data="{{ $value->code }}"
                            x-on:click.prevent="$dispatch('open-modal', 'confirm-prescription-update{{ $value->code }}')"
                            title="Edit {{ ucwords($value->medication_name) }}">
                            <img src="{{ asset('./icons/edit_square.svg') }}" />
                        </button> --}}

                        {{-- <x-modal name="confirm-prescription-update{{ $value->code }}" :show="$errors->prescriptionUpdate->isNotEmpty()" focusable>
                           
                            <form method="post" action="{{ route('healthinfo.update_prescription') }}" class="p-6">
                                @csrf
                                @method('put')

                                <h2 class="text-lg font-medium text-gray-900">
                                    {{ __('Are you sure you want to update your prescription ' . ucwords($value->medication_name) . '?') }}
                                </h2>

                                <div class="mt-6">
                                    <input id="code" name="code" type="hidden"
                                        class="mt-1 block w-3/4 text-teal-800" value="{{ $value->code }}" />

                                    <x-input-error :messages="$errors->prescriptionUpdate->get('code')" class="mt-2" />
                                </div>

                                <!-- Medication Name -->
                                <div class="flex flex-row justify-start">
                                    <x-input-label for="medication_name" class="w-full text-teal-800 py-3 text-start"
                                        :value="__('Medication Name:')" />
                                    <x-text-input id="medication_name" class="block mt-1 w-full text-teal-800"
                                        type="text" name="medication_name" required autofocus
                                        autocomplete="medication_name" placeholder="Enter Medication Name" />
                                </div>

                                <x-input-error :messages="$errors->prescriptionUpdate->get('medication_name')" class="mt-2 text-end" />
                                {{-- medication_name, medication_mode, start_date, end_date, medication_frequency 

                                
                                <div class="flex flex-row justify-start my-3">
                                    <x-input-label for="medication_mode" class="w-full text-teal-800 py-3 text-start"
                                        :value="__('Mode of Medication:')" />
                                    <select name="medication_mode" class="block mt-1 w-100 rounded-lg text-teal-800"
                                        required>
                                        <option value="" default name="medication_mode[]">-- Select a Mode of
                                            Medication
                                            --
                                        </option>
                                        <option value="oral" name="medication_mode[]"> Oral
                                            medication (Pills, syrups
                                            etc) </option>
                                        <option value="inhaler"
                                            name="medication_mode[]"> Inhaler</option>
                                        <option value="injection"
                                            
                                            name="medication_mode[]"> Injection</option>
                                        <option value="iv"
                                           
                                            name="medication_mode[]"> IV</option>
                                    </select>

                                </div>
                                <x-input-error :messages="$errors->get('medication_mode')" class="mt-2 text-end" />

                                {{-- Start Date  
                                <div class="flex flex-row justify-start my-3">
                                    <x-input-label for="start_date" class="w-full text-teal-800 py-3 text-start"
                                        :value="__('Start Date:')" />
                                    <x-text-input id="start_date" class="block mt-1 w-full text-teal-800" type="date"
                                        name="start_date" required autofocus autocomplete="start_date" />
                                </div>
                                <x-input-error :messages="$errors->prescriptionUpdate->get('start_date')" class="mt-2 text-end" />
                                {{-- end date  

                                <div class="flex flex-row justify-start my-3">
                                    <x-input-label for="end_date" class="w-full text-teal-800 py-3 text-start"
                                        :value="__('End Date:')" />
                                    <x-text-input id="end_date" class="block mt-1 w-full text-teal-800" type="date"
                                        name="end_date" required autofocus autocomplete="end_date" />
                                </div>

                                <x-input-error :messages="$errors->prescriptionUpdate->get('end_date')" class="mt-2 text-end" />

                                <div class="flex flex-row justify-start my-3">
                                    <x-input-label for="medication_frequency" class="w-full text-teal-800 text-start"
                                        :value="__('Frequency of Medication:')" />
                                    <select name="medication_frequency"
                                        class="block mt-1 w-100 rounded-lg text-teal-800" required>
                                        <option value="" default name="medication_frequency[]">-- Select a
                                            Frequency of
                                            Medication --
                                        </option>
                                        <option value="once_daily" name="medication_frequency[]"> Once daily
                                        </option>
                                        <option value="twice_daily" name="medication_frequency[]"> Twice Daily
                                        </option>
                                        <option value="three_times_daily" name="medication_frequency[]"> Three times
                                            Daily
                                        </option>
                                        <option value="once_eight_hours" name="medication_frequency[]"> Once in 8 hrs
                                        </option>
                                    </select>
                                </div>
                                <x-input-error :messages="$errors->prescriptionUpdate->get('medication_mode')" class="mt-2 text-end" />


                                <div class="mt-6 flex justify-end">
                                    <x-secondary-button x-on:click="$dispatch('close')">
                                        {{ __('Cancel') }}
                                    </x-secondary-button>

                                    <x-primary-button class="ms-3">
                                        {{ __('Update Prescription') }}
                                    </x-danger-button>
                                </div>
                            </form>
                        </x-modal> --}}

                        <button x-data="{{ $value->code }}"
                            x-on:click.prevent="$dispatch('open-modal', 'confirm-prescription-deletion{{ $value->code }}')"
                            class="bg-red-500 hover:bg-red-800 text-white p-3 rounded-lg "
                            title="Delete {{ ucwords($value->medication_name) }}">
                            <img src="{{ asset('./icons/delete.svg') }}" />
                        </button>

                        <x-modal name="confirm-prescription-deletion{{ $value->code }}" :show="$errors->prescriptionDeletion->isNotEmpty()" focusable>
                            <form method="post" action="{{ route('healthinfo.delete_prescription') }}" class="p-6">
                                @csrf
                                @method('delete')

                                <h2 class="text-lg font-medium text-gray-900">
                                    {{ __('Are you sure you want to delete your prescription ' . ucwords($value->medication_name) . '?') }}
                                </h2>

                                <div class="mt-6">
                                    <input id="code" name="code" type="hidden"
                                        class="mt-1 block w-3/4 text-teal-800" value="{{ $value->code }}" />
                                    <x-input-error :messages="$errors->prescriptionDeletion->get('code')" class="mt-2" />
                                </div>

                                <div class="mt-6 flex justify-end">
                                    <x-secondary-button x-on:click="$dispatch('close')">
                                        {{ __('Cancel') }}
                                    </x-secondary-button>

                                    <x-danger-button class="ms-3">
                                        {{ __('Delete Prescription') }}
                                    </x-danger-button>
                                </div>
                            </form>
                        </x-modal>
                    </div>

                </div>

                <div class="flex flex-row">
                    <p class="p-2 m-1 text-xs">
                        {{ $value->formatted_start_date . ' to ' . $value->formatted_end_date }}
                        {{-- {{ \Illuminate\Support\Carbon::parse($value->start_date)->format('jS F Y') . ' to ' . \Illuminate\Support\Carbon::parse($value->end_date)->format('jS F Y') }} --}}
                    </p>
                </div>
            </div>
        @endforeach
    @else
        <div class="bg-slate-400 my-4 text-white rounded-lg text-center w-full">
            <h3 class="text-center text-white p-6 justify-center"> Sorry you dont have any prescriptions.
            </h3>
        </div>
    @endif

    {{ $prescriptions->links() }}
</div>
