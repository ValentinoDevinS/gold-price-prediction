<div class="{{ $style()->wrapper() }}">

    <div class="{{ $style()->content() }}">

        <h1 class="{{ $style()->title() }}">

            {{ $title }}

        </h1>

        @if($description)

            <p class="{{ $style()->description() }}">

                {{ $description }}

            </p>

        @endif

    </div>

    @isset($actions)

        <div class="{{ $style()->actions() }}">

            {{ $actions }}

        </div>

    @endisset

</div>