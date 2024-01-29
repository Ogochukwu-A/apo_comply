<div class="p-2 justify-items-center">
    <form action="/get-bot-response" method="POST">
        @csrf 
        <div class="flex flex-row justify-start m-4 ms-3">
            <x-text-input id="chat_input" class="block mt-1 w-full text-teal-800"
                type="text" name="chat_input" required autofocus
                autocomplete="chat_input" placeholder="Enter your Question" />
        </div>
        <x-primary-button class="ms-3">
            {{ __('Send message') }}
        </x-danger-button>
    </form>
</div>