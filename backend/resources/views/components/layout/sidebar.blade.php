<aside class="{{ $style()->wrapper() }}">

    <div class="{{ $style()->header() }}">

        {{ $header ?? config('app.name') }}

    </div>

    <div class="{{ $style()->content() }}">

        @foreach($groups() as $group)

            <x-layout.navigation-group
                :group="$group"
            />

        @endforeach

    </div>

    @isset($footer)

        <div class="{{ $style()->footer() }}">

            {{ $footer }}

        </div>

    @endisset

</aside>