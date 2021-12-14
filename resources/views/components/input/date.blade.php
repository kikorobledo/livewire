<div
    class="flex rounded-md shadow-sm max-w-lg"
    x-data = "{ value : @entangle( $attributes->wire('model') ) }"
    x-init="new Pikaday({ field: $refs.input, format:'MM/DD/YYYY' });"
    x-on:change="value = $event.target.value"
>

    <span class="inline-flex items-center p-2 rounded-l-md border border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">

        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>

    </span>

    <input

        {{ $attributes->whereDoesntStartWith('wire:model') }}
        x-ref="input"
        x-bind:value = "value"
        class="rounded-none rounded-r-md p-2 flex-1 form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"

    />

</div>


@push('styles')

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">

@endpush

@push('scripts')

<script src="https://unpkg.com/moment"></script>
<script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>

@endpush
