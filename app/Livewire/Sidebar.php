<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class Sidebar extends Component
{
    /**
     * Whether the sidebar is open (primarily for mobile viewports).
     */
    public bool $isOpen = false;

    /**
     * Track expanded state of collapsible groups by key.
     * Example: [ 'portfolios' => true ]
     */
    public array $expandedGroups = [];

    public function mount(): void
    {
        // Initialize default expansion states. Persisted across requests via Livewire component state
        if (! array_key_exists('portfolios', $this->expandedGroups)) {
            $this->expandedGroups['portfolios'] = false;
        }
    }

    public function toggleSidebar(): void
    {
        $this->isOpen = ! $this->isOpen;
    }

    public function openSidebar(): void
    {
        $this->isOpen = true;
    }

    public function closeSidebar(): void
    {
        $this->isOpen = false;
    }

    public function toggleGroup(string $groupKey): void
    {
        $current = $this->expandedGroups[$groupKey] ?? false;
        $this->expandedGroups[$groupKey] = ! $current;
    }

    /**
     * Reusable sidebar menu definition.
     *
     * Each item can be either a link or a group with children.
     * Keys:
     * - type: 'link' | 'group'
     * - key: string (for groups)
     * - name: string
     * - icon: string (emoji or icon class)
     * - route: string (for links)
     * - children: array (for groups)
     */
    public function menu(): array
    {
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
            // [
            //     'type' => 'link',
            //     'name' => 'Clients',
            //     'icon' => '👥',
            //     'route' => 'clients.index',
            // ],
            [
                'type' => 'link',
                'name' => 'Proposals',
                'icon' => '📑',
                'route' => 'proposals.index',
            ],
            // [
            //     'type' => 'link',
            //     'name' => 'Invoices',
            //     'icon' => '💰',
            //     'route' => 'invoices.index',
            // ],
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
    }

    public function render(): View
    {
        return view('livewire.sidebar', [
            'menu' => $this->menu(),
        ]);
    }
} 