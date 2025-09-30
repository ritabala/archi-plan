<div
    x-data="{ open: $wire.entangle('isOpen'), expanded: $wire.entangle('expandedGroups') }"
    class="relative"
>
    <!-- Mobile toggle button -->
    <div class="md:hidden p-2">
        <button
            type="button"
            @click="open = !open; $wire.toggleSidebar()"
            class="inline-flex items-center justify-center rounded-md bg-gray-100 px-3 py-2 text-gray-700 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>

    <!-- Overlay for mobile -->
    <div
        x-cloak
        x-show="open"
        class="fixed inset-0 z-30 bg-black/40 md:hidden"
        @click="open = false; $wire.closeSidebar()"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
    ></div>

    <!-- Sidebar -->
    <aside
        x-cloak
        class="fixed z-40 inset-y-0 left-0 w-72 transform bg-white border-r border-gray-200 md:translate-x-0 md:static md:inset-auto md:w-64"
        :class="{ '-translate-x-full': !open, 'translate-x-0': open }"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="-translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full"
    >
        <div class="h-full flex flex-col">
            <!-- Header -->
            <div class="flex items-center justify-between px-4 py-4 border-b border-gray-200">
                <span class="text-lg font-semibold">Navigation</span>
                <button
                    type="button"
                    class="md:hidden rounded-md p-2 text-gray-500 hover:bg-gray-100"
                    @click="open = false; $wire.closeSidebar()"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Menu -->
            <nav class="flex-1 overflow-y-auto px-2 py-3">
                <ul class="space-y-1">
                    @foreach ($menu as $item)
                        @if ($item['type'] === 'link')
                            @php
                                $active = request()->routeIs($item['route']);
                            @endphp
                            <li>
                                <a
                                    href="{{ route($item['route']) }}"
                                    class="group flex items-center gap-3 rounded-md px-3 py-2 text-sm font-medium {{ $active ? 'bg-indigo-50 text-indigo-700' : 'text-gray-700 hover:bg-gray-50 hover:text-gray-900' }}"
                                >
                                    @if (!empty($item['icon']))
                                        <span class="text-base">{{ $item['icon'] }}</span>
                                    @endif
                                    <span>{{ $item['name'] }}</span>
                                </a>
                            </li>
                        @elseif ($item['type'] === 'group')
                            @php
                                $groupKey = $item['key'];
                                // Active if any child route matches
                                $childActive = collect($item['children'])->contains(function ($child) {
                                    return request()->routeIs($child['route']);
                                });
                            @endphp
                            <li x-data>
                                <button
                                    type="button"
                                    class="w-full flex items-center justify-between gap-3 rounded-md px-3 py-2 text-sm font-medium {{ $childActive ? 'bg-indigo-50 text-indigo-700' : 'text-gray-700 hover:bg-gray-50 hover:text-gray-900' }}"
                                    @click="$wire.toggleGroup('{{ $groupKey }}')"
                                >
                                    <span class="flex items-center gap-3">
                                        @if (!empty($item['icon']))
                                            <span class="text-base">{{ $item['icon'] }}</span>
                                        @endif
                                        <span>{{ $item['name'] }}</span>
                                    </span>
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-4 w-4 transform transition-transform duration-200"
                                        :class="expanded['{{ $groupKey }}'] ? 'rotate-90' : ''"
                                        viewBox="0 0 20 20"
                                        fill="currentColor"
                                    >
                                        <path fill-rule="evenodd" d="M6 6L14 10L6 14V6Z" clip-rule="evenodd" />
                                    </svg>
                                </button>

                                <div
                                    x-cloak
                                    x-show="expanded['{{ $groupKey }}']"
                                    x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 -translate-y-1"
                                    x-transition:enter-end="opacity-100 translate-y-0"
                                    x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100 translate-y-0"
                                    x-transition:leave-end="opacity-0 -translate-y-1"
                                    class="mt-1 pl-6"
                                >
                                    <ul class="space-y-1">
                                        @foreach ($item['children'] as $child)
                                            @php
                                                $active = request()->routeIs($child['route']);
                                            @endphp
                                            <li>
                                                <a
                                                    href="{{ route($child['route']) }}"
                                                    class="group flex items-center gap-3 rounded-md px-3 py-2 text-sm font-medium {{ $active ? 'bg-indigo-50 text-indigo-700' : 'text-gray-700 hover:bg-gray-50 hover:text-gray-900' }}"
                                                >
                                                    @if (!empty($child['icon']))
                                                        <span class="text-base">{{ $child['icon'] }}</span>
                                                    @endif
                                                    <span>{{ $child['name'] }}</span>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </nav>
        </div>
    </aside>
</div> 