
@props([
    'leadingAddOn' => false
])

<div class="max-w-lg flex rounded-md shadow-sm">

    @if($leadingAddOn)

        <span class="inline-flex items-center p-2 rounded-l-md border border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">

            {{ $leadingAddOn }}

        </span>

    @endif

    <input

        {{ $attributes }}

        class="{{ $leadingAddOn ? 'rounded-none rounded-r-md' : 'rounded'}} p-2 flex-1 form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"

    />

</div>
