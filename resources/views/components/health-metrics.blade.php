    <div class="p-3 w-full">
        <div class="bg-teal-800 text-white rounded-lg text-center w-full mb-3">
            <h3 class="text-center p-6"> Health Metrics </h3>
        </div>

    @if (count($healthmetrics) > 0)
        @foreach ($healthmetrics as $key => $value)
        {{-- sugar_level, pulse_rate, blood_pressure_top_value, blood_pressure_bottom_value --}}
            <div class="bg-slate-800 my-4 text-white rounded-lg text-start w-full p-3">


                <span class="p-2 ring-1 flex justify-center ring-white rounded-2xl h-10 text-center"> {{ date('l jS F Y g:ia', strtotime($value->created_at)) }}</span>

                <div class="flex flex-row justify-center h-100 mt-3">
                    <span
                        class="p-2 ring-1 ring-white rounded-2xl m-2 h-10">Sugar level - {{ ucwords($value->sugar_level) }}</span>

                    
                    <span
                        class="p-2 ring-1 ring-white rounded-2xl m-2 h-10">Pulse Rate - {{ ucwords($value->pulse_rate) }}</span>

    
                        <span
                        class="p-2 ring-1 ring-white rounded-2xl m-2 h-10">Blood Pressure - {{ $value->blood_pressure_top_value . '/'.  $value->blood_pressure_bottom_value }}</span>
                </div>
                <hr class="m-3"/>
        @endforeach
    @else
        <div class="bg-slate-400 my-4 text-white rounded-lg text-center w-full">
            <h3 class="text-center text-white p-6 justify-center"> Sorry you dont have any health metrics.
            </h3>
        </div>
    @endif

    {{ $healthmetrics->links() }}
</div>
