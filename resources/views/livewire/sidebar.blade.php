<div x-data="{ open: $wire.entangle('isOpen'), expanded: $wire.entangle('expandedGroups') }" x-on:open-sidebar.window="open = true; $wire.openSidebar()" x-on:close-sidebar.window="open = false; $wire.closeSidebar()">
    <aside
        class="fixed inset-y-0 start-0 z-40 w-64 shrink-0 transform bg-white border-e border-gray-200 transition-transform duration-200 ease-in-out md:translate-x-0"
        :class="{ '-translate-x-full': !open, 'translate-x-0': open }"
    >
        <!-- Sidebar header with logo and close button (mobile) -->
        <div class="flex items-center justify-between h-16 px-4 border-b border-gray-200">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                <x-application-mark class="block h-8 w-auto" />
                <span class="font-semibold text-gray-900">{{ config('app.name') }}</span>
            </a>
            <button type="button" class="md:hidden p-2 rounded-md text-gray-500 hover:bg-gray-100" @click="open = false; $wire.closeSidebar()">
                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Menu -->
        <nav class="h-[calc(100vh-4rem)] overflow-y-auto px-3 py-4">
            <ul class="space-y-1">
                @foreach ($menu as $item)
                    @if ($item['type'] === 'link')
                        <li>
                            <a
                                href="{{ route($item['route']) }}"
                                @class([
                                    'group flex items-center gap-3 rounded-md px-3 py-2 text-sm font-medium',
                                    'text-gray-700 hover:bg-gray-100 hover:text-gray-900' => ! (request()->routeIs($item['route']) || request()->routeIs($item['route'] . '.*')),
                                    'bg-gray-100 text-gray-900' => request()->routeIs($item['route']) || request()->routeIs($item['route'] . '.*')
                                ])
                            >
                                <span class="size-5 grid place-items-center">
                                    @if($item['icon'])
                                        <span>{{ $item['icon'] }}</span>
                                    @else
                                        <svg class="size-5 text-gray-400 group-hover:text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M10 3a1 1 0 00-.894.553l-7 14A1 1 0 003 19h14a1 1 0 00.894-1.447l-7-14A1 1 0 0010 3z" />
                                        </svg>
                                    @endif
                                </span>
                                <span class="truncate">{{ $item['name'] }}</span>
                            </a>
                        </li>
                    @elseif ($item['type'] === 'group')
                        @php 
                            $groupKey = $item['key']; 
                            $isGroupActive = collect($item['children'] ?? [])->contains(function ($child) {
                                return request()->routeIs($child['route']) || request()->routeIs($child['route'] . '.*');
                            });
                        @endphp
                        <li x-data="{ expandedLocal: @js($isGroupActive) }" x-init="
                                expanded['{{ $groupKey }}'] = expandedLocal;
                                $watch('expandedLocal', v => expanded['{{ $groupKey }}'] = v)
                            ">
                            <button
                                type="button"
                                class="w-full flex items-center justify-between rounded-md px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 hover:text-gray-900"
                                @click="$wire.toggleGroup('{{ $groupKey }}'); expandedLocal = !expandedLocal"
                            >
                                <span class="flex items-center gap-3">
                                    <span class="size-5 grid place-items-center">{{ $item['icon'] }}</span>
                                    <span>{{ $item['name'] }}</span>
                                </span>
                                <svg class="size-4 text-gray-500 transition-transform duration-200" :class="{ 'rotate-180': expandedLocal }" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </button>
                            <div x-show="expandedLocal" x-collapse.duration.0ms x-cloak class="ms-9 mt-1 space-y-1">
                                @foreach ($item['children'] as $child)
                                    <a
                                        href="{{ route($child['route']) }}"
                                        @class([
                                            'block rounded-md px-3 py-2 text-sm',
                                            'text-gray-600 hover:bg-gray-100 hover:text-gray-900' => ! (request()->routeIs($child['route']) || request()->routeIs($child['route'] . '.*')),
                                            'bg-gray-100 text-gray-900' => request()->routeIs($child['route']) || request()->routeIs($child['route'] . '.*')
                                        ])
                                    >
                                        {{ $child['name'] }}
                                    </a>
                                @endforeach
                            </div>
                        </li>
                    @endif
                @endforeach
            </ul>
        </nav>
    </aside>

    <!-- Off-canvas overlay for mobile -->
    <div
        class="fixed inset-0 z-30 bg-black/30 md:hidden"
        x-show="open"
        x-transition.opacity
        @click="open = false; $wire.closeSidebar()"
    ></div>
</div> 