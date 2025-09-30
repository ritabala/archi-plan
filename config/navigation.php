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
                'route' => 'portfolio.index',
            ],
            [
                'type' => 'link',
                'name' => 'Add New',
                'icon' => null,
                'route' => 'portfolio.create',
            ],
        ],
    ],
    [
        'type' => 'link',
        'name' => 'Proposals',
        'icon' => '📑',
        'route' => 'proposal.index',
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
                'route' => 'portfolio.index',
            ],
        ],
    ],
]; 