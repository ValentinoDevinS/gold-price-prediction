<x-ui.card>

    @if($cleanArticles->isNotEmpty())

        <div class="overflow-x-auto">

            <table class="min-w-full divide-y divide-gray-200">

                <thead class="bg-gray-50">

                    <tr>

                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider">
                            Article
                        </th>

                        <th class="px-4 py-3 text-center text-xs font-semibold uppercase tracking-wider">
                            Cleaner Version
                        </th>

                        <th class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-wider">
                            Original Words
                        </th>

                        <th class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-wider">
                            Clean Words
                        </th>

                        <th class="px-4 py-3 text-center text-xs font-semibold uppercase tracking-wider">
                            Cleaned At
                        </th>

                        <th class="px-4 py-3 text-center text-xs font-semibold uppercase tracking-wider">
                            Actions
                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-gray-100 bg-white">

                    @foreach($cleanArticles as $cleanArticle)

                        <tr class="hover:bg-gray-50 transition">

                            <td class="px-4 py-4">

                                <div class="font-medium text-gray-900">

                                    {{ Str::limit($cleanArticle->fullArticle?->article?->title, 80) }}

                                </div>

                                <div class="text-sm text-gray-500">

                                    {{ $cleanArticle->fullArticle?->article?->source }}

                                </div>

                            </td>

                            <td class="px-4 py-4 text-center">

                                <x-ui.badge variant="blue">

                                    {{ $cleanArticle->cleaner_version }}

                                </x-ui.badge>

                            </td>

                            <td class="px-4 py-4 text-right">

                                {{ number_format($cleanArticle->original_word_count) }}

                            </td>

                            <td class="px-4 py-4 text-right font-semibold">

                                {{ number_format($cleanArticle->clean_word_count) }}

                            </td>

                            <td class="px-4 py-4 text-center">

                                {{ $cleanArticle->cleaned_at?->format('Y-m-d H:i') }}

                            </td>

                            <td class="px-4 py-4 text-center">

                                <a
                                    href="{{ route('clean-articles.show', $cleanArticle->uuid) }}"
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

            {{ $cleanArticles->withQueryString()->links() }}

        </div>

    @else

        <x-ui.empty-state
            title="No Clean Articles Found"
            description="No cleaned articles match the selected criteria."
        />

    @endif

</x-ui.card>