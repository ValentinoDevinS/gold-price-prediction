<x-ui.card>

    <form
        method="GET"
        action="{{ route('articles.index') }}"
        class="grid gap-4 lg:grid-cols-4"
    >

        <x-ui.input
            name="search"
            label="Search"
            :value="request('search')"
            placeholder="Title, source or keyword"
        />

        <x-ui.input
            name="status"
            label="Status"
            :value="request('status')"
        />

        <x-ui.input
            name="source"
            label="Source"
            :value="request('source')"
        />

        <x-ui.input
            name="country"
            label="Country"
            :value="request('country')"
        />

        <x-ui.input
            name="language"
            label="Language"
            :value="request('language')"
        />

        <x-ui.input
            name="scraper"
            label="Scraper"
            :value="request('scraper')"
        />

        <x-ui.input
            name="per_page"
            label="Per Page"
            :value="request('per_page',20)"
        />

        <div class="flex items-end gap-2">

            <x-ui.button type="submit">

                Search

            </x-ui.button>

            <x-ui.button
                tag="a"
                :href="route('articles.index')"
                variant="secondary"
            >

                Reset

            </x-ui.button>

        </div>

    </form>

</x-ui.card>