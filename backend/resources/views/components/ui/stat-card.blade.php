<div {{ $attributes->merge([
    'class' => $style()->wrapper(),
]) }}>

    <h3 class="{{ $style()->title() }}">

        {{ $title }}

    </h3>

    <div class="{{ $style()->value() }}">

        {{ $value }}

    </div>

    @isset($footer)

        <div class="{{ $style()->footer() }}">

            {{ $footer }}

        </div>

    @endisset

</div>