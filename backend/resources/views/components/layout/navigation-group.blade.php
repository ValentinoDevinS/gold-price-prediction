<div class="{{ $style()->wrapper() }}">

    <div class="{{ $style()->title() }}">

        {{ $group->title }}

    </div>

    <div class="{{ $style()->items() }}">

        @foreach($group->items as $item)

            <x-layout.navigation-item
                :item="$item"
            />

        @endforeach

    </div>

</div>