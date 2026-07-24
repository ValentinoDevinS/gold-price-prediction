<x-ui.grid cols="4">

    <x-ui.stat-card
        title="Total Snapshots"
        :value="$features->total()"
        description="Generated feature snapshots."
    />

    <x-ui.stat-card
        title="Latest Snapshot"
        :value="optional($features->first()?->snapshot_date)->format('Y-m-d') ?? '-'"
        description="Most recent snapshot date."
    />

    <x-ui.stat-card
        title="Feature Version"
        :value="$features->first()?->feature_version ?? '-'"
        description="Current feature engineering version."
    />

    <x-ui.stat-card
        title="Average Sentiment"
        :value="number_format($features->avg('average_sentiment') ?? 0, 4)"
        description="Average sentiment score on this page."
    />

</x-ui.grid>