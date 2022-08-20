<!-- Sidebar Menu -->

@php

$links = [
    [
        'route' => route('createSales'),
        'name' => 'POS',
        'icon' => 'fas fa-edit',
        'children' => [],
    ],
    [
        'route' => null,
        'name' => 'Authentication',
        'icon' => 'fas fa-user',
        'children' => [
            [
                'route' => route('user'),
                'name' => 'Manage User',
                'icon' => 'far fa-circle',
                'children' => [],
            ],
            [
                'route' => null,
                'name' => 'Roll Configuration',
                'icon' => 'far fa-circle',
                'children' => [
                    [
                        'route' => null,
                        'name' => 'Create Role',
                        'icon' => 'far fa-circle',
                    ],
                    [
                        'route' => null,
                        'name' => 'Create Permission',
                        'icon' => 'far fa-circle',
                    ],
                ],
            ],
        ],
    ],
    [
        'route' => null,
        'name' => 'Supplier',
        'icon' => 'fas fa-copy',
        'children' => [
            [
                'route' => route('manageSupplier'),
                'name' => 'Manage Supplier',
                'icon' => 'far fa-circle',
                'children' => [],
            ],
            [
                'route' => route('supplierLedger'),
                'name' => 'Supplier Ledger',
                'icon' => 'far fa-circle',
                'children' => [],
            ],
        ],
    ],
    [
        'route' => null,
        'name' => 'Medicine',
        'icon' => 'fas fa-medkit',
        'children' => [
            [
                'route' => route('generics'),
                'name' => 'Generics',
                'icon' => 'far fa-circle',
                'children' => [],
            ],
            [
                'route' => route('strength'),
                'name' => 'Strength',
                'icon' => 'far fa-circle',
                'children' => [],
            ],
            [
                'route' => route('medicineType'),
                'name' => 'Medicine Type',
                'icon' => 'far fa-circle',
                'children' => [],
            ],
            [
                'route' => route('shelf'),
                'name' => 'Shelf',
                'icon' => 'far fa-circle',
                'children' => [],
            ],
            [
                'route' => route('manageMedicine'),
                'name' => 'Medicine',
                'icon' => 'far fa-circle',
                'children' => [],
            ],
        ],
    ],
    [
        'route' => null,
        'name' => 'Purchase',
        'icon' => 'fas fa-shopping-cart',
        'children' => [],
        'children' => [
            [
                'route' => route('createPurchase'),
                'name' => 'Create Purchase',
                'icon' => 'far fa-circle',
                'children' => [],
            ],
            [
                'route' => route('purchaseHistory'),
                'name' => 'Purchase History',
                'icon' => 'far fa-circle',
                'children' => [],
            ],
        ],
    ],
    [
        'route' => null,
        'name' => 'Sales',
        'icon' => 'fas fa-edit',
        'children' => [
            [
                'route' => route('createSales'),
                'name' => 'Create Sales',
                'icon' => 'far fa-circle',
                'children' => [],
            ],
            [
                'route' => route('salesHistory'),
                'name' => 'Sales History',
                'icon' => 'far fa-circle',
                'children' => [],
            ],
        ],
    ],
    [
        'route' => null,
        'name' => 'Customer',
        'icon' => 'fas fa-users',
        'children' => [
            [
                'route' => route('customerIndex'),
                'name' => 'Manage Customer',
                'icon' => 'far fa-circle',
                'children' => [],
            ],
            [
                'route' => route('customerLedger'),
                'name' => 'Customer Ledger',
                'icon' => 'far fa-circle',
                'children' => [],
            ],
        ],
    ],
    [
        'route' => null,
        'name' => 'Accounts',
        'icon' => 'fas fa-copy',
        'children' => [
            [
                'route' => route('openingBalance'),
                'name' => 'Opening',
                'icon' => 'far fa-circle',
                'children' => [],
            ],
            [
                'route' => route('otherIncome'),
                'name' => 'Other Income',
                'icon' => 'far fa-circle',
                'children' => [],
            ],
            [
                'route' => route('otherExpense'),
                'name' => 'Other Expense',
                'icon' => 'far fa-circle',
                'children' => [],
            ],
        ],
    ],
    [
        'route' => null,
        'name' => 'Return',
        'icon' => 'fas fa-adjust',
        'children' => [
            [
                'route' => route('purchaseReturn'),
                'name' => 'Purchase Return',
                'icon' => 'far fa-circle',
                'children' => [],
            ],
            [
                'route' => route('salesReturn'),
                'name' => 'Sales Return',
                'icon' => 'far fa-circle',
                'children' => [],
            ],
        ],
    ],
    [
        'route' => null,
        'name' => 'Employee',
        'icon' => 'fas fa-user',
        'children' => [
            [
                'route' => route('manageEmployee'),
                'name' => 'Manage Employee',
                'icon' => 'far fa-circle',
                'children' => [],
            ],
        ],
    ],

    [
        'route' => null,
        'name' => 'Doctor',
        'icon' => 'fas fa-user-md',
        'children' => [
            [
                'route' => route('doctors'),
                'name' => 'Manage Doctors',
                'icon' => 'fa fa-circle',
                'children' => [],
            ],
        ],
    ],
    [
        'route' => route('company'),
        'name' => 'Template',
        'icon' => 'fas fa-wrench',
        'children' => [],
    ],
];

@endphp
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        @foreach ($links as $link)
            <li
                class="nav-item {{ in_array(url()->current(), Arr::pluck($link['children'], 'route')) ? 'menu-open' : '' }}">
                <a href="{{ $link['route'] ? $link['route'] : 'javascript:void(0)' }}"
                    class="nav-link {{ in_array(url()->current(), array_merge(Arr::pluck($link['children'], 'route'), [$link['route']])) ? 'active' : '' }}">
                    <i class="nav-icon {{ $link['icon'] }}"></i>
                    <p> {{ $link['name'] }}</p>
                    @if (sizeof($link['children']) > 0)
                        <i class="fas fa-angle-left right"></i>
                    @endif
                </a>
                @if (sizeof($link['children']) > 0)
                    <ul class="nav nav-treeview">
                        @foreach ($link['children'] as $childLink)
                            <li class="nav-item">
                                <a href="{{ $childLink['route'] }}"
                                    class="nav-link  {{ $childLink['route'] == url()->current() ? 'active' : '' }}">
                                    <i class="{{ $childLink['icon'] }} nav-icon"></i>
                                    <p>{{ $childLink['name'] }}</p>
                                    @if (sizeof($childLink['children']) > 0)
                                        <i class="fas fa-angle-left right"></i>
                                    @endif
                                </a>
                                @if (sizeof($childLink['children']) > 0)
                                    <ul class="nav nav-treeview">
                                        @foreach ($childLink['children'] as $child2Link)
                                            <li class="nav-item">
                                                <a href="{{ $child2Link['route'] }}"
                                                    class="nav-link  {{ $child2Link['route'] == url()->current() ? 'active' : '' }}">
                                                    <i class="{{ $child2Link['icon'] }} nav-icon"></i>
                                                    <p>{{ $child2Link['name'] }}</p>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach

        <li class="nav-item">
            <a href="javascript:void(0)" class="nav-link">
                <i class="nav-icon fas fa-table"></i>
                <p>
                    Inventory
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('medicineStock') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Medicine Stock</p>
                    </a>
                </li>

                @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                    <li class="nav-item">
                        <a href="{{ route('shortStock') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Short Stock</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('outStock') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Out of Stock</p>
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <a href="{{ route('expiredMedicine') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Expired Medicine</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('soonExpiredMedicine') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Soon Expired Medicine</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="javascript:void(0)" class="nav-link">
                <i class="nav-icon fas fa-table"></i>
                <p>
                    Report
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="pages/tables/simple.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Sales Report</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/tables/simple.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Purchase Report</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('otherReport') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Other Report</p>
                    </a>
                </li>
            </ul>
        </li>

    </ul>
</nav>
<!-- /.sidebar-menu -->
