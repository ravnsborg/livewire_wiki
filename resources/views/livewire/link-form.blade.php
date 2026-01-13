<div class="max-w-6xl mx-auto p-6">
    <div class="bg-white rounded-lg shadow-md">
        <!-- Header -->
        <div class="flex justify-between items-center p-6 border-b">
            <h1 class="text-2xl font-bold text-gray-800">URL Manager</h1>
            <button wire:click="create" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition">
                Add New URL
            </button>
        </div>

        <!-- Flash Message -->
        @if (session()->has('message'))
            <div class="m-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                {{ session('message') }}
            </div>
        @endif

        <!-- Form -->
        @if ($showForm)
            <div class="p-6 border-b bg-gray-50">
                <h2 class="text-lg font-semibold mb-4">{{ $editingId ? 'Edit URL' : 'Add New URL' }}</h2>
                <form wire:submit.prevent="save" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">URL</label>
                        <input type="url" wire:model="url" class="text-black w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="https://example.com">
                        @error('url') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                        <input type="text" wire:model="title" class="text-black w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Enter title">
                        @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex gap-2">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition">
                            {{ $editingId ? 'Update' : 'Save' }}
                        </button>
                        <button type="button" wire:click="cancel" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg transition">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        @endif

        <!-- URL List -->
        <div class="p-6">
            @if ($urls->count())
                <div class="space-y-4">
                    @foreach ($urls as $item)
                        <div class="border border-gray-200 rounded-lg p-2 hover:bg-gray-50 transition">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <h3 class="font-semibold text-lg text-gray-800">{{ $item->title }}</h3>
                                    <a href="{{ $item->url }}" target="_blank" class="text-blue-500 hover:underline text-sm break-all">
                                        {{ $item->url }}
                                    </a>
                                </div>
                                <div class="flex gap-2 ml-4">
                                    <button wire:click="edit({{ $item->id }})" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm transition">
                                        Edit
                                    </button>
                                    <button wire:click="delete({{ $item->id }})" wire:confirm="Are you sure you want to delete this URL?" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm transition">
                                        Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $urls->links() }}
                </div>
            @else
                <div class="text-center py-12 text-gray-500">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                    </svg>
                    <p class="mt-4 text-lg">No URLs yet</p>
                    <p class="text-sm">Click "Add New URL" to get started</p>
                </div>
            @endif
        </div>
    </div>
</div>
