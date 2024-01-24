<x-app-layout>
    <!-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> -->

    <div class="py-12">

    <span class="m-6  p-6 my-3 text-white  rounded-lg bg-blue-500 ">
        Notice: An Email / SMS will be sent to remind you about your medication
      </span>

    </div>
    
    <div class="py-12">

        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                
                <div class="p-6 my-6 text-gray-900">
                    {{ __("Doctor's Appointments") }}

                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="py-12">

        <div class="grid lg:grid-cols-2 md:grid-cols-2 ">
            <!-- First Div -->
            <x-prescriptions :prescriptions="$prescriptions"></x-prescriptions>

            <!-- Second Div -->
            <x-add-prescriptions></x-add-prescriptions>
        </div>

    </div>


    

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
    
            var calendar = new FullCalendar.Calendar(calendarEl, {
                events: [
                    @foreach($appointments as $appointment)
                    {
                        title: '{{ $appointment->patient_subject }}',
                        start: '{{ $appointment->patient_appointment_date }}',
                        // Add other event properties as needed
                    },
                    @endforeach
                ]
            });
    
            calendar.render();
        });
    </script>

   

</x-app-layout>
