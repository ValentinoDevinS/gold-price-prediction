<x-ui.card>

    @if($fullArticles->isNotEmpty())

        <div class="overflow-x-auto">

            <table class="min-w-full divide-y divide-gray-200">

                <thead class="bg-gray-50">

                    <tr>

                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider">
                            Article
                        </th>

                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider">
                            Author
                        </th>

                        <th class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-wider">
                            Words
                        </th>

                        <th class="px-4 py-3 text-center text-xs font-semibold uppercase tracking-wider">
                            Status
                        </th>

                        <th class="px-4 py-3 text-center text-xs font-semibold uppercase tracking-wider">
                            Downloaded
                        </th>

                        <th class="px-4 py-3 text-center text-xs font-semibold uppercase tracking-wider">
                            Actions
                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-gray-100 bg-white">

                    @foreach($fullArticles as $fullArticle)

                        <tr class="hover:bg-gray-50 transition">

                            <td class="px-4 py-4">

                                <div class="font-medium text-gray-900">

                                    {{ Str::limit($fullArticle->article?->title, 80) }}

                                </div>

                                <div class="text-sm text-gray-500">

                                    {{ $fullArticle->article?->source }}

                                </div>

                            </td>

                            <td class="px-4 py-4">

                                {{ $fullArticle->author ?: '-' }}

                            </td>

                            <td class="px-4 py-4 text-right">

                                {{ number_format($fullArticle->word_count) }}

                            </td>

                            <td class="px-4 py-4 text-center">

                                <x-ui.status-badge
                                    :status="$fullArticle->download_status"
                                />

                            </td>

                            <td class="px-4 py-4 text-center">

                                {{ $fullArticle->downloaded_at?->format('Y-m-d H:i') }}

                            </td>

                            <td class="px-4 py-4 text-center">

                                <a
                                    href="{{ route('full-articles.show', $fullArticle->uuid) }}"
                                    class="btn btn-sm btn-primary"
                                >
                                    View
                                </a>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

        <div class="mt-6">

            {{ $fullArticles->withQueryString()->links() }}

        </div>

    @else

        <x-ui.empty-state
            title="No Full Articles Found"
            description="No downloaded articles match the selected filters."
        />

    @endif

</x-ui.card>