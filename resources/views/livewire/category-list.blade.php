<!-- Sidebar -->
<div class="bg-gray-50 border border-gray-300 rounded-lg p-4 max-h-80 flex flex-col overflow-hidden
            dark:bg-gray-700 dark:border-gray-900">
    <div class="flex items-center flex-shrink-0">
        <h2 class="font-semibold text-md text-gray-800 dark:text-gray-200">Categories</h2>
        <i
            class="fa-solid fa-plus ml-auto cursor-pointer text-gray-800 dark:text-gray-200"
            href="{{route('category-show-create-form')}}"
            wire:navigate
        ></i>
    </div>

    <ul class="mt-2 overflow-y-auto flex-grow space-y-2 text-gray-700  dark:text-gray-300">
        @foreach($categoryList as $category)
            <li
                class="text-xs hover:text-blue-600 hover:text-lg transition rounded cursor-pointer dark:hover:text-cyan-700"
                wire:key="{{ $category->id }}"
                wire:click="$dispatch('article-list:articles-by-category', { id: {{ $category->id }} })"
            >
                {{ $category->title }}
            </li>
        @endforeach
    </ul>
</div>
