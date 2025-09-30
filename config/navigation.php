<?php

return [
    [
        'type' => 'link',
        'name' => 'Dashboard',
        'icon' => '📂',
        'route' => 'dashboard',
    ],
    [
        'type' => 'group',
        'key' => 'portfolios',
        'name' => 'Portfolios',
        'icon' => '🖼️',
        'children' => [
            [
                'type' => 'link',
                'name' => 'All Portfolios',
                'icon' => null,
                'route' => 'portfolios.index',
            ],
            [
                'type' => 'link',
                'name' => 'Add New',
                'icon' => null,
                'route' => 'portfolios.create',
            ],
        ],
    ],
    [
        'type' => 'link',
        'name' => 'Proposals',
        'icon' => '📑',
        'route' => 'proposals.index',
    ],
    [
        'type' => 'group',
        'key' => 'settings',
        'name' => 'Settings',
        'icon' => '🖼️',
        'children' => [
            [
                'type' => 'link',
                'name' => 'Portfolio Categories',
                'icon' => null,
                'route' => 'portfolios.index',
            ],
        ],
    ],
]; 