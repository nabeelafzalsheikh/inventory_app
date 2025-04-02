<!-- sidebar.php -->
<?php 
$current_page = $_SERVER['REQUEST_URI'];

?>

<!-- Sidebar -->
<div class="sidebar">
    <div class="company">
        <i class="fas fa-warehouse"></i> My Inventory
    </div>

    <a href="{{ route('admin.dashboard') }}" class="{{ request()->is('admin/dashboard') ? 'activelink' : '' }}">
        <i class="fas fa-home"></i> Dashboard
    </a>

    <!-- Products Menu -->
    {{-- Products Menu Item --}}
    <a href="#submenu1" data-toggle="collapse"
       class="{{ request()->is('admin/products*') ? 'active' : '' }}"
       aria-expanded="{{ request()->is('admin/products*') ? 'true' : 'false' }}">
        <i class="fas fa-list"></i> Products <i class="fas fa-chevron-down float-right"></i>
    </a>
    
    {{-- Products Submenu --}}
    <div class="collapse {{ request()->is('admin/products*') ? 'show' : '' }}" id="submenu1">
        <a href="{{ route('products.index') }}" class="pl-4 {{ request()->routeIs('products.index') ? 'active' : '' }}">
            <i class="fas fa-box-open"></i> All Products
        </a>
        <a href="{{ route('products.create') }}" class="pl-4 {{ request()->routeIs('products.create') ? 'active' : '' }}">
            <i class="fas fa-plus"></i> Add Product
        </a>
    </div>
    {{-- Categories Menu Item --}}
<a href="#submenu2" data-toggle="collapse" 
   aria-expanded="{{ request()->is('admin/categories*') ? 'true' : 'false' }}" 
   class="{{ request()->is('categories*') ? 'active' : '' }}">
    <i class="fas fa-tags"></i> Categories <i class="fas fa-chevron-down float-right"></i>
</a>

{{-- Categories Submenu --}}
<div class="collapse {{ request()->is('admin/categories*') ? 'show' : '' }}" id="submenu2">
    <a href="{{ route('categories.index') }}" class="pl-4 {{ request()->routeIs('categories.index') ? 'active' : '' }}">
        <i class="fas fa-list-alt"></i> All Categories
    </a>
    <a href="{{ route('categories.create') }}" class="pl-4 {{ request()->routeIs('categories.create') ? 'active' : '' }}">
        <i class="fas fa-plus-circle"></i> Add Category
    </a>
</div>
    {{-- Brands Menu Item --}}
    <a href="#submenuBrands" data-toggle="collapse"
       class="{{ request()->is('admin/brands*') ? 'active' : '' }}"
       aria-expanded="{{ request()->is('admin/brands*') ? 'true' : 'false' }}">
        <i class="fas fa-tag"></i> Brands <i class="fas fa-chevron-down float-right"></i>
    </a>
    
    {{-- Brands Submenu --}}
    <div class="collapse {{ request()->is('admin/brands*') ? 'show' : '' }}" id="submenuBrands">
        <a href="{{ route('brands.index') }}" class="pl-4 {{ request()->routeIs('brands.index') ? 'active' : '' }}">
            <i class="fas fa-list-alt"></i> All Brands
        </a>
        <a href="{{ route('brands.create') }}" class="pl-4 {{ request()->routeIs('brands.create') ? 'active' : '' }}">
            <i class="fas fa-plus-circle"></i> Add Brand
        </a>
    </div>

    <!-- Suppliers Menu -->
    <a href="#submenu5" data-toggle="collapse" 
    class="{{ request()->is('admin/suppliers*') ? 'active' : '' }}"
    aria-expanded="{{ request()->is('admin/suppliers*') ? 'true' : 'false' }}">
     <i class="fas fa-truck"></i> Suppliers <i class="fas fa-chevron-down float-right"></i>
 </a>
 <div class="collapse {{ request()->is('admin/suppliers*') ? 'show' : '' }}" id="submenu5">
     <a href="{{ route('suppliers.index') }}" class="pl-4 {{ request()->routeIs('suppliers.index') ? 'active' : '' }}">
         <i class="fas fa-list-alt"></i> All Suppliers
     </a>
     <a href="{{ route('suppliers.create') }}" class="pl-4 {{ request()->routeIs('suppliers.create') ? 'active' : '' }}">
         <i class="fas fa-plus-circle"></i> Add Supplier
     </a>
 </div>

 <!-- Purchase Menu -->
 <a href="#submenu4" data-toggle="collapse"
    class="{{ request()->is('admin/purchase*') ? 'active' : '' }}"
    aria-expanded="{{ request()->is('admin/purchase*') ? 'true' : 'false' }}">
     <i class="fas fa-shopping-cart"></i> Purchase <i class="fas fa-chevron-down float-right"></i>
 </a>
 <div class="collapse {{ request()->is('admin/purchase*') ? 'show' : '' }}" id="submenu4">
     <a href="{{ route('purchases.index') }}" class="pl-4 {{ request()->routeIs('purchases.index') ? 'active' : '' }}">
         <i class="fas fa-list-alt"></i> All Purchases
     </a>
     <a href="{{ route('purchases.create') }}" class="pl-4 {{ request()->routeIs('purchases.create') ? 'active' : '' }}">
         <i class="fas fa-plus-circle"></i> Add Purchase
     </a>
 </div>

    <!-- Stock -->
    <a href="{{ route('stocks.index') }}" class="{{ request()->routeIs('stocks.index') ? 'activelink' : '' }}">
        <i class="fas fa-boxes"></i> Stock
    </a>

    <a href="#submenu-sales" data-toggle="collapse"
    class="{{ request()->is('admin/sales*') ? 'active' : '' }}"
    aria-expanded="{{ request()->is('admin/sales*') ? 'true' : 'false' }}">
     <i class="fas fa-cash-register"></i> Sales & Billing <i class="fas fa-chevron-down float-right"></i>
 </a>
 <div class="collapse {{ request()->is('admin/sales*') ? 'show' : '' }}" id="submenu-sales">
     <a href="{{ route('sales.create') }}" class="pl-4 {{ request()->routeIs('sales.create') ? 'active' : '' }}">
         <i class="fas fa-file-invoice-dollar"></i> New Invoice
     </a>
     <a href="{{ route('sales.index') }}" class="pl-4 {{ request()->routeIs('sales.index') ? 'active' : '' }}">
         <i class="fas fa-list"></i> Sales Records
     </a>
 </div>

    <a href="#submenu-analysis-reports" data-toggle="collapse"
    class="{{ request()->is('admin/report*') || request()->is('admin/product-report') ? 'active' : '' }}"
    aria-expanded="{{ request()->is('admin/reports*') || request()->is('admin/product-report') ? 'true' : 'false' }}">
     <i class="fas fa-chart-bar"></i> Analysis Reports <i class="fas fa-chevron-down float-right"></i>
 </a>
 <div class="collapse {{ request()->is('admin/report*') || request()->is('admin/product-report') ? 'show' : '' }}" id="submenu-analysis-reports">
     <a href="{{ route('report.sales') }}" class="pl-4 {{ request()->routeIs('report.sales') ? 'active' : '' }}">
         <i class="fas fa-chart-line"></i> Sale Report
     </a>
     <a href="{{route('purchases.report')}}" class="pl-4 {{ request()->routeIs('purchases.report') ? 'active' : '' }}">
         <i class="fas fa-shopping-cart"></i> Purchase Report
     </a>
    
 </div>
 
 @php
 $isMessagesActive = request()->is('admin/messages') || request()->is('admin/messages/*');
 @endphp

<a href="#submenuMessages" data-toggle="collapse"
class="{{ $isMessagesActive ? 'active' : '' }}" 
aria-expanded="{{ $isMessagesActive ? 'true' : 'false' }}">
 <i class="fas fa-envelope"></i> Messages <i class="fas fa-chevron-down float-right"></i>
</a>
<div class="collapse {{ $isMessagesActive ? 'show' : '' }}" id="submenuMessages">
 
 <a href="{{ route('messages.index') }}" class="pl-4 {{ request()->is('admin/messages') ? 'active' : '' }}">
     <i class="fas fa-list"></i> All Messages
 </a>
 <a href="{{ route('messages.create') }}" class="pl-4 {{ request()->is('admin/messages/create') ? 'active' : '' }}">
     <i class="fas fa-pencil-alt"></i> Compose
 </a>
</div>


    <!-- Manage Users -->
    <a href="#adminSubmenu" data-toggle="collapse"
    class="{{ request()->is('admin/admins*') ? 'active' : '' }}"
    aria-expanded="{{ request()->is('admin/admins*') ? 'true' : 'false' }}">
    <i class="fas fa-user-shield"></i> Admins <i class="fas fa-chevron-down float-right"></i>
</a>
<div class="collapse {{ request()->is('admin/admins*') ? 'show' : '' }}" id="adminSubmenu">
    <a href="{{ route('admins.index') }}" class="pl-4 {{ request()->routeIs('admin.admins.index') ? 'active' : '' }}">
        <i class="fas fa-list-alt"></i> All Admins
    </a>
    
    <a href="{{ route('admins.create') }}" class="pl-4 {{ request()->routeIs('admin.admins.create') ? 'active' : '' }}">
        <i class="fas fa-plus-circle"></i> Add Admin
    </a>
    
    
</div>

    <!-- Roles -->
    <a href="#submenuRoles" data-toggle="collapse"
    class="{{ request()->is('admin/roles*') ? 'active' : '' }}"
    aria-expanded="{{ request()->is('admin/roles*') ? 'true' : 'false' }}">
     <i class="fas fa-user-tag"></i> Roles <i class="fas fa-chevron-down float-right"></i>
 </a>
 
 <div class="collapse {{ request()->is('admin/roles*') ? 'show' : '' }}" id="submenuRoles">
     <a href="{{ route('roles.index') }}" class="pl-4 {{ request()->routeIs('roles.index') ? 'active' : '' }}">
         <i class="fas fa-list-alt"></i> All Roles
     </a>
     <a href="{{ route('roles.create') }}" class="pl-4 {{ request()->routeIs('roles.create') ? 'active' : '' }}">
         <i class="fas fa-plus-circle"></i> Add Role
     </a>
 </div>
 

    <!-- Permissions -->
    <a href="#submenuPermissions" data-toggle="collapse"
   class="{{ request()->is('admin/permissions*') ? 'active' : '' }}"
   aria-expanded="{{ request()->is('admin/permissions*') ? 'true' : 'false' }}">
    <i class="fas fa-key"></i> Permissions <i class="fas fa-chevron-down float-right"></i>
</a>

<div class="collapse {{ request()->is('admin/permissions*') ? 'show' : '' }}" id="submenuPermissions">
    <a href="{{ route('permissions.index') }}" class="pl-4 {{ request()->routeIs('permissions.index') ? 'active' : '' }}">
        <i class="fas fa-list-alt"></i> All Permissions
    </a>
    <a href="{{ route('permissions.create') }}" class="pl-4 {{ request()->routeIs('permissions.create') ? 'active' : '' }}">
        <i class="fas fa-plus-circle"></i> Add Permission
    </a>
</div>


    <!-- Recycle Bin -->
    <a href="{{ route('trash.index') }}" class=" pl-4 {{ request()->routeIs('trash.index') ? 'active' : '' }}">
        <i class="fas fa-trash"></i> Recycle Bin
    </a>

    <!-- Settings -->
    <a href="/inventory-php/settings.php" class="<?= $current_page == '/inventory-php/settings.php' ? 'active' : '' ?>">
        <i class="fas fa-cog"></i> Settings
    </a>

</div>




