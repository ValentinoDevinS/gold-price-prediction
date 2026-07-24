@if($rows->hasPages())

    <div class="flex items-center justify-between p-4 border-t border-border">

        <div class="text-sm text-secondary">

            Showing

            <strong>{{ $rows->firstItem() }}</strong>

            to

            <strong>{{ $rows->lastItem() }}</strong>

            of

            <strong>{{ $rows->total() }}</strong>

            results

        </div>

        <div>

            {{ $rows->links() }}

        </div>

    </div>

@endif