<div class="p-3 justify-items-center justify-end w-full">

    @if (count($chat_history) > 0)
        @foreach ($chat_history as $key => $value)
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

                </div>

                <div class="flex flex-row">
                    <p class="p-2 m-1 text-xs">
                        {{ $value->formatted_start_date . ' to ' . $value->formatted_end_date }}
                    </p>
                </div>
            </div>
        @endforeach
    @else
        <div class="bg-slate-400 my-4 text-white rounded-lg text-center w-full">
            <h3 class="text-center text-white p-6 justify-center"> Sorry you dont have any chat history.
            </h3>
        </div>
    @endif

    {{ $chat_history->links() }}
</div>
