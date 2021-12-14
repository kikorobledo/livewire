<div
    class="max-w-lg rounded-md shadow-sm"
    wire:ignore
    {{ $attributes->whereDoesntStartWith('wire:model') }}
    x-data = "{
        value : @entangle($attributes->wire('model')),
        isFocused(){
            return document.activeElement !== this.$refs.trix;
        },
        setValue(){
            this.$refs.trix.editor.loadHTML(this.value);
            this.$refs.trix.editor.setSelectedRange(
                (this.$refs.trix.editor.getDocument().toString().lenght) - 1
            );
        }
    }"
    x-init="setValue(); $watch('value', () => isFocused() && setValue())"
    x-on:trix-change="value = $event.target.value"
>

    <input type="hidden" id="x">

    <trix-editor x-ref="trix" input="x" class=" p-2 rounded form-textarea block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5 bg-white"></trix-editor>

</div>

@push('styles')
<link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@1.2.3/dist/trix.css">
@endpush

@push('scripts')
<script src="https://unpkg.com/trix@1.2.3/dist/trix.js"></script>
@endpush
