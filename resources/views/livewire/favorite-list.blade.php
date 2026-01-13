<!-- Favorites -->
<div class="bg-gray-50 border border-gray-300 rounded-lg p-4 max-h-80 flex flex-col overflow-hidden
            dark:bg-gray-700 dark:border-gray-900">
    <div class="flex items-center flex-shrink-0">
        <h2 class="font-semibold text-lg text-gray-800 dark:text-gray-200">Favorites.</h2>
    </div>

    <ul class="mt-2 overflow-y-auto flex-grow space-y-2 text-gray-700 dark:text-gray-300">
        @foreach($favoriteArticleList as $article)
            <li
                class="text-xs hover:text-blue-600 hover:text-lg transition rounded cursor-pointer dark:hover:text-cyan-700"
                wire:key="{{ $article->id }}"
                wire:click="$dispatch('article-list:favorite-article', { id: {{ $article->id }} })"
            >
                {{ $article->title }}
            </li>
        @endforeach
    </ul>
</div>
