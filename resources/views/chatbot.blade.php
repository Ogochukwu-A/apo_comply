<x-app-layout>
    <!-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> -->



    <div class="py-12 mx-3">

        {{-- <div class="flex flex-col w-full p-6"> --}}
            <h3 class="my-3 p-3 text-3xl">Our AI Chat Bot</h3>

            @if(session('result'))
                <div class="m-6 p-3 text-2xl rounded-lg bg-teal-800 text-white h-auto ">
                    <h3 class="text-center p-6 text-start">
                        {!! session('result') !!} 
                    </h3>
                </div>
            @endif


            <div class="grid lg:grid-cols-2 md:grid-cols-2 ">

                <!-- First Div -->
                <x-chatai-form></x-chatai-form>
            
                <div class="w-full">
                    <!-- Second Div -->
                    <div class="bg-teal-800 text-white rounded-lg text-center w-auto">
                        <h3 class="text-center p-6"> AI Chat History </h3>
                    </div>

                    <div class="ml-8">
                        <div class="bg-white max-w-xl mx-auto border border-gray-200">
                            <ul class="shadow-box">
                                @if (count($chat_history) > 0)
                                    @foreach ($chat_history as $key => $value)
                                        <li class="relative border-b border-gray-200 my-4" x-data="{selected:null}">
                                            <button type="button" class="w-full bg-teal-600 hover:bg-teal-800 text-white w-full px-8 py-6 text-left" @click="selected !== 1 ? selected = 1 : selected = null">
                                                <div class="flex items-center justify-between">
                                                        <span> {{ucwords($value->search_term)}} </span>
                                                        <span class="ico-plus"></span>
                                                    </div>
                                                </button>
                            
                                                <div class="relative overflow-hidden transition-all max-h-0 duration-700" style="" x-ref="container1" x-bind:style="selected == 1 ? 'max-height: ' + $refs.container1.scrollHeight + 'px' : ''">
                                                    <div class="p-6">
                                                        <p>{!!$value->content!!}</p>
                                                    </div>
                                                </div>
                                            </li>
                                    @endforeach
                                @else
                                    <div class="bg-slate-400 my-4 text-white rounded-lg text-center w-full">
                                        <h3 class="text-center text-white p-6 justify-center"> Sorry you don't have any chat history.
                                        </h3>
                                    </div>
                                @endif
                            </ul>
                        </div>
                    </div>
                    {{ $chat_history->links() }}
                </div>
            </div>
        </div>

    </div>




</x-app-layout>
