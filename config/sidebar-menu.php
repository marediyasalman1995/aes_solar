<?php

return [
    [
        'name' => 'Dashboard',
        'icon' => '<i class="bx bx-home side-menu__icon"></i>',
        'isHeader' => false,
        'route' => 'dashboard',
        'children' => [],
    ],

    [
        'name' => 'Customers',
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="side-menu__icon"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>',
        'isHeader' => false,
        'route' => 'admin.customers.index',
        'children' => [],
    ],

    [
        'name' => 'Customer Plants/Sites',
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="side-menu__icon"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 13a8 8 0 0 1 7 7a6 6 0 0 0 3 -5a9 9 0 0 0 6 -8a3 3 0 0 0 -3 -3a9 9 0 0 0 -8 6a6 6 0 0 0 -5 3" /><path d="M7 14a6 6 0 0 0 -3 6a6 6 0 0 0 6 -3" /><circle cx="15" cy="9" r="1" /></svg>',
        'isHeader' => false,
        'route' => 'admin.customer-sites.index',
        'children' => [],
    ],

    [
        'name' => 'Referrals & Rewards',
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="side-menu__icon"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2" /><path d="M12 3v3m0 12v3" /></svg>',
        'isHeader' => false,
        'route' => '#',
        'children' => [
            [
                'name' => 'Referrals',
                'icon' => '',
                'isHeader' => false,
                'route' => 'admin.referrals.index',
                'children' => [],
            ],
            [
                'name' => 'Wallet Transactions',
                'icon' => '',
                'isHeader' => false,
                'route' => 'admin.wallet-transactions.index',
                'children' => [],
            ],
        ],
    ],

    [
        'name' => 'Service Requests',
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="side-menu__icon"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 10h3v-3l-3.5 -3.5a6 6 0 0 1 8 8l6 6a2 2 0 0 1 -3 3l-6 -6a6 6 0 0 1 -8 -8l3.5 3.5z" /></svg>',
        'isHeader' => false,
        'route' => 'admin.service-requests.index',
        'children' => [],
    ],

    [
        'name' => 'Warranties & Docs',
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="side-menu__icon"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><path d="M9 9l1 0" /><path d="M9 13l6 0" /><path d="M9 17l6 0" /></svg>',
        'isHeader' => false,
        'route' => 'admin.customer-documents.index',
        'children' => [],
    ],

    [
        'name' => 'Website Content',
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-article side-menu__icon"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 4m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" /><path d="M7 8h10" /><path d="M7 12h10" /><path d="M7 16h10" /></svg>',
        'isHeader' => false,
        'route' => '#',
        'children' => [
            [
                'name' => 'CMS Pages',
                'icon' => '',
                'isHeader' => false,
                'route' => 'admin.contentManagements.index',
                'children' => [],
            ],
            [
                'name' => 'Website Sections',
                'icon' => '',
                'isHeader' => false,
                'route' => 'admin.websites.index',
                'children' => [],
            ],
            [
                'name' => 'Faqs',
                'icon' => '',
                'isHeader' => false,
                'route' => 'admin.faqs.index',
                'children' => [],
            ],
        ],
    ],

    [
        'name' => 'Inquiries & Leads',
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-list side-menu__icon"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l11 0" /><path d="M9 12l11 0" /><path d="M9 18l11 0" /><path d="M5 6l0 .01" /><path d="M5 12l0 .01" /><path d="M5 18l0 .01" /></svg>',
        'isHeader' => false,
        'route' => 'admin.inquiries.index',
        'children' => [],
    ],

    [
        'name' => 'Admin Users',
        'icon' => '<i class="ti ti-user-circle fs-18 me-2 side-menu__icon "></i>',
        'isHeader' => false,
        'route' => 'admin.users.index',
        'children' => [],
    ],
];
