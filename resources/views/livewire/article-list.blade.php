<div class="max-w-7xl mx-auto space-y-4">
    <!-- Cards -->
    @foreach($articles as $article)
        <div class="bg-white rounded-lg shadow-md p-4 border border-gray-200
                    dark:bg-gray-700 dark:border-gray-700 dark:text-gray-200">
            <div class="relative mb-4">
                <h3 class="text-xl font-bold text-gray-800 dark:text-gray-100">
                    {!! $article->title !!}
                </h3>

                <div class="absolute right-0 top-0 text-sm">

                    {{-- Favorite icons--}}
                    <i class="{{ $favorites[$article->id] ? 'fas' : 'far' }} fa-star text-yellow-400 cursor-pointer"
                        wire:click="updateFavorite({{$article->id}})"
                        wire:key="fav-{{ $article->id }}"
                    ></i>

                    <i class="pl-3 far fa-pen-to-square text-blue-500 dark:text-blue-400"
                        href="{{ route('article-show-update-form', [$article->id]) }}"
                        wire:navigate
                    ></i>
                </div>

                <div class="absolute mt-1 mb-4 text-xs text-yellow-600 dark:text-yellow-400">
                    Category: {{ $article->category->title }}
                </div>
                <div class="absolute right-0 mt-1 mb-4 text-xs text-yellow-600 dark:text-yellow-400">
                    Last Updated: {{ $article->updated_at }}
                </div>
            </div>
            <div class="mt-7 p-3 bg-blue-200 rounded text-gray-900 whitespace-pre-line
                        dark:bg-gray-600 dark:text-gray-100">
                {!! $this->highlightMatch($article->body) !!}
            </div>
        </div>
        <div class="h-1"></div>
    @endforeach
</div>
