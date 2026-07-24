<x-ui.modal :title="$title">

    <div class="{{ $style()->icon($variant) }}">

        @if($variant === \App\Enums\Ui\ConfirmationVariant::Danger)

            !

        @else

            ?

        @endif

    </div>

    <p class="{{ $style()->message() }}">

        {{ $message }}

    </p>

    <x-slot:footer>

        <x-ui.button
            variant="secondary"
        >
            Cancel
        </x-ui.button>

        <x-ui.button
            variant="{{ $variant === \App\Enums\Ui\ConfirmationVariant::Danger ? 'danger' : 'primary' }}"
        >
            Confirm
        </x-ui.button>

    </x-slot:footer>

</x-ui.modal>