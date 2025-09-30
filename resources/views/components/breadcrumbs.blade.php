<div class="flex items-center gap-2">
    @php
        $nav = config('navigation', []);
        $current = optional(request()->route())->getName();
        $crumbs = [];

        if ($current) {
            foreach ($nav as $item) {
                $type = $item['type'] ?? 'link';
                if ($type === 'group') {
                    $children = $item['children'] ?? [];
                    foreach ($children as $child) {
                        if (($child['route'] ?? null) === $current) {
                            // Determine a route for the parent group: prefer its own route, else first child route
                            $parentRoute = $item['route'] ?? optional(collect($children)->firstWhere(fn ($c) => !empty($c['route'])))['route'] ?? null;
                            $crumbs[] = [ 'name' => $item['name'] ?? '', 'route' => $parentRoute ];
                            $crumbs[] = [ 'name' => $child['name'] ?? '', 'route' => $child['route'] ?? null ];
                            break 2;
                        }
                    }
                } else {
                    if (($item['route'] ?? null) === $current) {
                        $crumbs[] = [ 'name' => $item['name'] ?? '', 'route' => $item['route'] ?? null ];
                        break;
                    }
                }
            }
        }
    @endphp

    @if (!empty($crumbs))
        @foreach ($crumbs as $index => $crumb)
            @php($isLast = $index === count($crumbs) - 1)
            @if ($index > 0)
                <span class="text-gray-300">/</span>
            @endif

            @if ($isLast || empty($crumb['route']))
                <span class="text-gray-600">{{ $crumb['name'] }}</span>
            @else
                <a href="{{ route($crumb['route']) }}" class="text-indigo-600 hover:text-indigo-700">
                    {{ $crumb['name'] }}
                </a>
            @endif
        @endforeach
    @endif
</div> 