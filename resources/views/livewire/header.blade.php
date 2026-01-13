<!-- Header - Full Width -->
<header class="dark-primary w-full light-primary p-4 shadow-lg ">
{{--<header class="w-full bg-teal-600 text-white p-4 shadow-lg dark:bg-gray-900 dark:text-gray-100">--}}
    <div class="flex items-center justify-between px-5 ">
        <!-- Logo/Title -->
        <h1 class="text-2xl font-bold">{{$this->selectedEntity->title}} Wiki</h1>

        <!-- Center: Search -->
        <livewire:search />

        <!-- Add new category -->
        <div class="flex-1 max-w-2xl mx-8 flex items-center gap-3">
            <button
                class="px-4 py-2 bg-blue-500 hover:bg-blue-400 rounded-lg transition whitespace-nowrap dark-btn"
                href="{{ route("article-show-create-form") }}"
                wire:navigate
            >
                <i class="fa-solid fa-plus"></i> Create New Article
            </button>
        </div>

        <!-- Right Side - Dropdowns -->
        <div class="flex items-center gap-4">

            <!-- Links Dropdown -->
            <div class="relative">
                <button id="dropdown1Btn" class="px-4 py-2 bg-blue-500 hover:bg-blue-400 rounded-lg transition flex items-center gap-2 dark-btn">
                    Links
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div id="dropdown1" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 z-10 dark:bg-gray-700 dark:text-gray-200">
                    @foreach($links as $link)
                        <a
                            href="{{ $link->url }}"
                            target="_blank"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700"
                        >
                            {{ $link->title }}
                        </a>
                    @endforeach

                    <div class="border-t my-1 border-gray-300 dark:border-gray-600"></div>

                    <a href="{{ route('link-show-form') }}"
                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700"
                    >
                        Manage Links
                    </a>
                </div>
            </div>

            <!-- Entities Dropdown -->
            <div class="relative">
                <button id="dropdown2Btn" class="px-4 py-2 bg-blue-500 hover:bg-blue-400 rounded-lg transition flex items-center gap-2 dark-btn">
                    Entities
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div id="dropdown2" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 z-10 dark:bg-gray-700 dark:text-gray-200">
                    @foreach($entities as $entity)
                    <span
                        type="button"
                        wire:key="entity-{{ $entity->id }}"
                        wire:click="refreshEntity({{ $entity->id }})"
                        @click="open = false"
                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700"
                    >
                        {{ $entity->title }}
                        @if ($entity->id === $this->selectedEntity->id)
                            <i class="fa-solid fa-check ml-2 text-xs"></i>
                        @endif
                    </span>
                    @endforeach
                </div>
            </div>

            <!-- Account Dropdown -->
            <div class="relative">
                <button id="accountBtn" class="w-10 h-10 rounded-full border-2 border-white hover:border-blue-300 transition dark:border-gray-300 dark:hover:border-blue-500">
                    {{ Auth::user()->name[0] }}
                </button>

                <div id="accountDropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 z-10 dark:bg-gray-700 dark:text-gray-200">
                    <!-- New Entity  -->
                    <button class="block px-4 py-2 text-gray-800 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700"
                            href="{{ route("entity-show-create-form") }}"
                            wire:navigate
                    >
                        <i class="fa-solid fa-plus"></i> New Entity
                    </button>

                    <!-- Dark Mode Selector  -->
                    <button id="darkModeToggle" class="w-full text-left px-4 py-2 text-gray-800 hover:bg-gray-100 flex items-center justify-between dark:text-gray-300 dark:hover:bg-gray-700">
                        <span>Dark Mode</span>
                        <span id="darkModeStatus" class="text-sm text-gray-500 dark:text-gray-400">Off</span>
                    </button>

                    <hr class="my-2 border-gray-300 dark:border-gray-600">

                    <!-- Logout -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="block px-4 py-2 text-gray-800 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700"
                        >
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
