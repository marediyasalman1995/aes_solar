<?php

/**
 * @var array permissions
 * first-level key is group name of permission, while array that this key contains are the set of permissions under
 * that group.
 */
return [
    'users' => [
        [
            'name' => 'users.index',
            'label' => 'Can Access List of Users',
        ],
        [
            'name' => 'users.create',
            'label' => 'Can Create Users',
        ],
        [
            'name' => 'users.edit',
            'label' => 'Can Edit Users',
        ],
        [
            'name' => 'users.view',
            'label' => 'Can View Users',
        ],
        [
            'name' => 'users.delete',
            'label' => 'Can Delete Users',
        ]
    ],

    'tokens' => [
        [
            'name' => 'userTokens.index',
            'label' => 'Can Access List of User Tokens',
        ],
        [
            'name' => 'userTokens.generate',
            'label' => 'Can generate user token',
        ],
        [
            'name' => 'userTokens.delete',
            'label' => 'Can delete the generated user token',
        ],
    ],

    'customers' => [
        [
            'name' => 'customers.index',
            'label' => 'Can Access List of Customers',
        ],
        [
            'name' => 'customers.create',
            'label' => 'Can Create Customers',
        ],
        [
            'name' => 'customers.edit',
            'label' => 'Can Edit Customers',
        ],
        [
            'name' => 'customers.view',
            'label' => 'Can View Customers',
        ],
        [
            'name' => 'customers.delete',
            'label' => 'Can Delete Customers',
        ]
    ],

    'customer_sites' => [
        [
            'name' => 'customer-sites.index',
            'label' => 'Can Access List of Customer Sites',
        ],
        [
            'name' => 'customer-sites.create',
            'label' => 'Can Create Customer Sites',
        ],
        [
            'name' => 'customer-sites.edit',
            'label' => 'Can Edit Customer Sites',
        ],
        [
            'name' => 'customer-sites.view',
            'label' => 'Can View Customer Sites',
        ],
        [
            'name' => 'customer-sites.delete',
            'label' => 'Can Delete Customer Sites',
        ]
    ],

    'referral_point_settings' => [
        [
            'name' => 'referral-point-settings.index',
            'label' => 'Can Access List of Referral Rules',
        ],
        [
            'name' => 'referral-point-settings.create',
            'label' => 'Can Create Referral Rules',
        ],
        [
            'name' => 'referral-point-settings.edit',
            'label' => 'Can Edit Referral Rules',
        ],
        [
            'name' => 'referral-point-settings.view',
            'label' => 'Can View Referral Rules',
        ],
        [
            'name' => 'referral-point-settings.delete',
            'label' => 'Can Delete Referral Rules',
        ]
    ],

    'document_types' => [
        [
            'name' => 'document-types.index',
            'label' => 'Can Access List of Document Types',
        ],
        [
            'name' => 'document-types.create',
            'label' => 'Can Create Document Types',
        ],
        [
            'name' => 'document-types.edit',
            'label' => 'Can Edit Document Types',
        ],
        [
            'name' => 'document-types.view',
            'label' => 'Can View Document Types',
        ],
        [
            'name' => 'document-types.delete',
            'label' => 'Can Delete Document Types',
        ]
    ],

    'referrals' => [
        [
            'name' => 'referrals.index',
            'label' => 'Can Access List of Referrals',
        ],
        [
            'name' => 'referrals.create',
            'label' => 'Can Create Referrals',
        ],
        [
            'name' => 'referrals.edit',
            'label' => 'Can Edit Referrals',
        ],
        [
            'name' => 'referrals.view',
            'label' => 'Can View Referrals',
        ],
        [
            'name' => 'referrals.delete',
            'label' => 'Can Delete Referrals',
        ]
    ],

    'wallet_transactions' => [
        [
            'name' => 'wallet-transactions.index',
            'label' => 'Can Access List of Wallet Transactions',
        ],
        [
            'name' => 'wallet-transactions.create',
            'label' => 'Can Create Wallet Transactions',
        ],
        [
            'name' => 'wallet-transactions.edit',
            'label' => 'Can Edit Wallet Transactions',
        ],
        [
            'name' => 'wallet-transactions.view',
            'label' => 'Can View Wallet Transactions',
        ],
        [
            'name' => 'wallet-transactions.delete',
            'label' => 'Can Delete Wallet Transactions',
        ]
    ],

    'customer_documents' => [
        [
            'name' => 'customer-documents.index',
            'label' => 'Can Access List of Customer Documents',
        ],
        [
            'name' => 'customer-documents.create',
            'label' => 'Can Upload Customer Documents',
        ],
        [
            'name' => 'customer-documents.edit',
            'label' => 'Can Edit Customer Documents',
        ],
        [
            'name' => 'customer-documents.view',
            'label' => 'Can View Customer Documents',
        ],
        [
            'name' => 'customer-documents.delete',
            'label' => 'Can Delete Customer Documents',
        ]
    ],

    'service_requests' => [
        [
            'name' => 'service-requests.index',
            'label' => 'Can Access List of Service Requests',
        ],
        [
            'name' => 'service-requests.create',
            'label' => 'Can Create Service Requests',
        ],
        [
            'name' => 'service-requests.edit',
            'label' => 'Can Edit Service Requests',
        ],
        [
            'name' => 'service-requests.view',
            'label' => 'Can View Service Requests',
        ],
        [
            'name' => 'service-requests.delete',
            'label' => 'Can Delete Service Requests',
        ]
    ],

    'inquiries' => [
        [
            'name' => 'inquiries.index',
            'label' => 'Can Access List of Inquiries',
        ],
        [
            'name' => 'inquiries.create',
            'label' => 'Can Create Inquiries',
        ],
        [
            'name' => 'inquiries.edit',
            'label' => 'Can Edit Inquiries',
        ],
        [
            'name' => 'inquiries.view',
            'label' => 'Can View Inquiries',
        ],
        [
            'name' => 'inquiries.delete',
            'label' => 'Can Delete Inquiries',
        ]
    ],

    'faqs' => [
        [
            'name' => 'faqs.index',
            'label' => 'Can Access List of Faqs',
        ],
        [
            'name' => 'faqs.create',
            'label' => 'Can Create Faqs',
        ],
        [
            'name' => 'faqs.edit',
            'label' => 'Can Edit Faqs',
        ],
        [
            'name' => 'faqs.view',
            'label' => 'Can View Faqs',
        ],
        [
            'name' => 'faqs.delete',
            'label' => 'Can Delete Faqs',
        ]
    ],

    'newsletters' => [
        [
            'name' => 'newsletters.index',
            'label' => 'Can Access List of Newsletters',
        ],
        [
            'name' => 'newsletters.create',
            'label' => 'Can Create Newsletters',
        ],
        [
            'name' => 'newsletters.edit',
            'label' => 'Can Edit Newsletters',
        ],
        [
            'name' => 'newsletters.view',
            'label' => 'Can View Newsletters',
        ],
        [
            'name' => 'newsletters.delete',
            'label' => 'Can Delete Newsletters',
        ]
    ],

    'contentManagements' => [
        [
            'name' => 'contentManagements.index',
            'label' => 'Can Access List of CMS Content',
        ],
        [
            'name' => 'contentManagements.create',
            'label' => 'Can Create CMS Content',
        ],
        [
            'name' => 'contentManagements.edit',
            'label' => 'Can Edit CMS Content',
        ],
        [
            'name' => 'contentManagements.view',
            'label' => 'Can View CMS Content',
        ],
        [
            'name' => 'contentManagements.delete',
            'label' => 'Can Delete CMS Content',
        ]
    ],

    'websites' => [
        [
            'name' => 'websites.index',
            'label' => 'Can Access List of Website Sections/Products',
        ],
        [
            'name' => 'websites.create',
            'label' => 'Can Create Website Sections/Products',
        ],
        [
            'name' => 'websites.edit',
            'label' => 'Can Edit Website Sections/Products',
        ],
        [
            'name' => 'websites.view',
            'label' => 'Can View Website Sections/Products',
        ],
        [
            'name' => 'websites.delete',
            'label' => 'Can Delete Website Sections/Products',
        ]
    ],

    'roles' => [
        [
            'name' => 'roles.index',
            'label' => 'Can Access List of Roles',
        ],
        [
            'name' => 'roles.create',
            'label' => 'Can Create Roles',
        ],
        [
            'name' => 'roles.edit',
            'label' => 'Can Edit Roles',
        ],
        [
            'name' => 'roles.view',
            'label' => 'Can View Roles',
        ],
        [
            'name' => 'roles.delete',
            'label' => 'Can Delete Roles',
        ],
        [
            'name' => 'roles.permissions.manage',
            'label' => 'Can Manage Role Permissions',
        ]
    ],
];
