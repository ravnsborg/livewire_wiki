<div class="max-w-5xl mx-auto mt-10 p-6 bg-white rounded-xl shadow-md">
    @if (session()->has('success'))
        <div class="mb-4 p-3 text-green-700 bg-green-100 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="save" class="space-y-5">
        <div>
            <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
            <select wire:model.fill="category_id" id="category_id" class="mt-1 block w-full text-gray-700 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @foreach($categoryList as $category)
                    <option value="{{$category->id}}">{{$category->title}}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="title" class="block text-sm font-medium text-gray-700">Article title</label>
            <input wire:model.defer="title" id="title" type="text" class="mt-1 block w-full text-gray-700 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="body" class="block text-sm font-medium text-gray-700">Article body</label>
            <textarea
                wire:model.defer="body"
                id="body"
                rows="15"
                class="mt-1 block w-full text-gray-700 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
            ></textarea>
            @error('body') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="flex justify-between">
            <div class="ml-auto">
                <button type="button"
                        href="{{route("home")}}"
                        wire:navigate
                        class="px-8 py-2 bg-yellow-700 text-white rounded-md hover:bg-yellow-900 mr-5"
                >
                    Cancel
                </button>

                <button type="submit"
                        class="px-8 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 "
                >
                    Save Article
                </button>
            </div>
        </div>


    </form>
</div>
