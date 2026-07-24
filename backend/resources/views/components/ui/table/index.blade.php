<div class="{{ $style()->wrapper() }}">

    @include('components.ui.table.toolbar')

    <table class="{{ $style()->table() }}">

        @include('components.ui.table.header')

        @include('components.ui.table.body')

    </table>

    @include('components.ui.table.pagination')

</div>