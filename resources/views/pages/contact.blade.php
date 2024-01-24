<x-landing-layout>

    <x-shortbanner title="Contact">

    </x-shortbanner>

    <div class="grid grid-flow-row lg:grid-cols-2 sm:grid-cols-1 md:grid-cols-1">
        <div class="h-200 w-full flex justify-center flex-row">
            <img src="{{asset('../../../../../images/customer-support-removebg-preview.png" /> 
        </div>
        <div class="bg-grey-300 h-full w-full flex justify-center flex-col">

        <h3 class="text-3xl text-center text-blue-800 mt-12"> Send Us a Message</h3>
            <x-contact.form-component></x-contact.form-component>
        </div>
    </div>

</x-landing-layout>