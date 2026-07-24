<div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">

    @foreach ($statistics as $statistic)

        <x-ui.stat-card
            :title="$statistic['title']"
            :value="$statistic['value']"
            :description="$statistic['description']"
        />

    @endforeach

</div>