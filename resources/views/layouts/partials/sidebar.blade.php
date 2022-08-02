<!-- Sidebar Menu -->

@php

$links = [
    [
        'route' => route('createSales'),
        'name' => 'POS',
        'icon' => 'fas fa-edit',
        'role' => [1,2,3],
        'children' => [],
    ],
    [
        'route' => null,
        'name' => 'Authentication',
        'icon' => 'fas fa-user',
        'role' => [1,2,3],
        'children' => [
            [
                'route' => route('user'),
                'name' => 'Manage User',
                'icon' => 'far fa-circle',
                'role' => [1,2,3],
            ],
            [
                'route' =>  null,
                'name' => 'Roll Configuration',
                'icon' => 'far fa-circle',
                'role' => [1,2,3],
            ],
        ],
    ],
    [
        'route' => null,
        'name' => 'Supplier',
        'icon' => 'fas fa-copy',
        'role' => [1,2,3],
        'children' => [
            [
                'route' => route('manageSupplier'),
                'name' => 'Manage Supplier',
                'icon' => 'far fa-circle',
                'role' => [1,2,3],
            ],
            [
                'route' => route('supplierLedger'),
                'name' => 'Supplier Ledger',
                'icon' => 'far fa-circle',
                'role' => [1,2,3],
            ],
        ],
    ],
    [
        'route' => null,
        'name' => 'Medicine',
        'icon' => 'fas fa-medkit',
        'role' => [1,2,3],
        'children' => [
            [
                'route' => route('generics'),
                'name' => 'Generics',
                'icon' => 'far fa-circle',
                'role' => [1,2,3],
            ],
            [
                'route' => route('strength'),
                'name' => 'Strength',
                'icon' => 'far fa-circle',
                'role' => [1,2,3],
            ],
            [
                'route' => route('medicineType'),
                'name' => 'Medicine Type',
                'icon' => 'far fa-circle',
                'role' => [1,2,3],
            ],
            [
                'route' => route('shelf'),
                'name' => 'Shelf',
                'icon' => 'far fa-circle',
                'role' => [1,2,3],
            ],
            [
                'route' => route('manageMedicine'),
                'name' => 'Medicine',
                'icon' => 'far fa-circle',
                'role' => [1,2,3],
            ],
        ],
    ],
    [
        'route' => null,
        'name' => 'Purchase',
        'icon' => 'fas fa-shopping-cart',
        'role' => [1,2,3],
        'children' => [
            [
                'route' => route('createPurchase'),
                'name' => 'Create Purchase',
                'icon' => 'far fa-circle',
                'role' => [1,2,3],
            ],
            [
                'route' => route('purchaseHistory'),
                'name' => 'Purchase History',
                'icon' => 'far fa-circle',
                'role' => [1,2,3],
            ],
        ],
    ],
    [
        'route' => null,
        'name' => 'Sales',
        'icon' => 'fas fa-edit',
        'role' => [1,2,3],
        'children' => [
            [
                'route' => route('createSales'),
                'name' => 'Create Sales',
                'icon' => 'far fa-circle',
                'role' => [1,2,3],
            ],
            [
                'route' => route('salesHistory'),
                'name' => 'Sales History',
                'icon' => 'far fa-circle',
                'role' => [1,2,3],
            ],
        ],
    ],
    [
        'route' => null,
        'name' => 'Customer',
        'icon' => 'fas fa-users',
        'role' => [1,2,3],
        'children' => [
            [
                'route' => route('customerIndex'),
                'name' => 'Manage Customer',
                'icon' => 'far fa-circle',
                'role' => [1,2,3],
            ],
            [
                'route' => route('customerLedger'),
                'name' => 'Customer Ledger',
                'icon' => 'far fa-circle',
                'role' => [1,2,3],
            ],
        ],
    ],
    [
        'route' => null,
        'name' => 'Accounts',
        'icon' => 'fas fa-copy',
        'role' => [1,2,3],
        'children' => [
            [
                'route' => route('openingBalance'),
                'name' => 'Opening',
                'icon' => 'far fa-circle',
                'role' => [1,2,3],
            ],
            [
                'route' => route('otherIncome'),
                'name' => 'Other Income',
                'icon' => 'far fa-circle',
                'role' => [1,2,3],
            ],
            [
                'route' => route('otherExpense'),
                'name' => 'Other Expense',
                'icon' => 'far fa-circle',
                'role' => [1,2,3],
            ],
        ],
    ],
    [
        'route' => null,
        'name' => 'Return',
        'icon' => 'fas fa-adjust',
        'role' => [1,2,3],
        'children' => [
            [
                'route' => route('purchaseReturn'),
                'name' => 'Purchase Return',
                'icon' => 'far fa-circle',
                'role' => [1,2,3],
            ],
            [
                'route' => route('salesReturn'),
                'name' => 'Sales Return',
                'icon' => 'far fa-circle',
                'role' => [1,2,3],
            ],
        ],
    ],
    [
        'route' => null,
        'name' => 'Employee',
        'icon' => 'fas fa-user',
        'role' => [1,2,3],
        'children' => [
            [
                'route' => route('manageEmployee'),
                'name' => 'Manage Employee',
                'icon' => 'far fa-circle',
                'role' => [1,2,3],
            ],
        ],
    ],

    [
        'route' => null,
        'name' => 'Doctor',
        'icon' => 'fas fa-user-md',
        'role' => [1,2,3],
        'children' => [
            [
                'route' => route('doctors'),
                'name' => 'Manage Doctors',
                'icon' => 'fa fa-circle',
                'role' => [1,2,3],
            ],
        ],
    ],
    [
        'route' => route('company'),
        'name' => 'Template',
        'icon' => 'fas fa-wrench',
        'role' => [1,2,3],
        'children' => [],
    ],

];

@endphp
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        @foreach ($links as $link)
            @if(in_array(Auth::user()->role_id, $link['role']))
            <li class="nav-item {{ in_array(url()->current(), Arr::pluck($link['children'], 'route')) ? 'menu-open' : '' }}">
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
                        @if(in_array(Auth::user()->role_id, $childLink['role']))
                            <li class="nav-item">
                                <a href="{{ $childLink['route'] }}"
                                    class="nav-link  {{ $childLink['route'] == url()->current() ? 'active' : '' }}">
                                    <i class="{{ $childLink['icon'] }} nav-icon"></i>
                                    <p>{{ $childLink['name'] }}</p>
                                </a>
                            </li>
                            @endif
                        @endforeach
                    </ul>
                @endif
            </li>
            @endif
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
                    <a href="pages/tables/simple.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Medicine Stock</p>
                    </a>
                </li>

                @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                <li class="nav-item">
                    <a href="pages/tables/simple.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Short Stock</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/tables/simple.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Out of Stock</p>
                    </a>
                </li>
                @endif
                <li class="nav-item">
                    <a href="pages/tables/simple.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Expired Medicine</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/tables/simple.html" class="nav-link">
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
                        <p>Simple Tables</p>
                    </a>
                </li>
            </ul>
        </li>

    </ul>
</nav>
<!-- /.sidebar-menu -->
