<?php
// A simple way to determine the current page and apply the active class.
$current_page = basename($_SERVER['PHP_SELF']);
?>
<nav class="sidebar w-64 bg-slate-900 text-white flex flex-col py-6 transition-all duration-300 ease-in-out">
    <div class="sidebar-header px-5 pb-5 text-center text-2xl font-semibold border-b border-gray-700">
        <i class="fas fa-store mr-2"></i> Seavlinh Store for Admin
    </div>
    <ul class="sidebar-nav list-none p-0 my-0 flex-grow">
        <li class="<?php echo ($current_page == 'admin.php') ? 'active' : ''; ?>">
            <a href="admin.php"
                class="flex items-center px-6 py-4 text-gray-300 no-underline font-medium hover:bg-slate-700 hover:text-white transition-colors duration-300">
                <i class="fas fa-tachometer-alt w-5 mr-4 text-center"></i> Dashboard</a>
        </li>
        <li class="<?php echo ($current_page == 'admin_orders.php') ? 'active' : ''; ?>">
            <a href="admin_orders.php"
                class="flex items-center px-6 py-4 text-gray-300 no-underline font-medium hover:bg-slate-700 hover:text-white transition-colors duration-300">
                <i class="fas fa-shopping-cart w-5 mr-4 text-center"></i> Order Management</a>
        </li>
        <li class="<?php echo ($current_page == 'admin_products.php') ? 'active' : ''; ?>">
            <a href="admin_products.php"
                class="flex items-center px-6 py-4 text-gray-300 no-underline font-medium hover:bg-slate-700 hover:text-white transition-colors duration-300">
                <i class="fas fa-box-open w-5 mr-4 text-center"></i> Products</a>
        </li>
        <li class="<?php echo ($current_page == 'admin_customers.php') ? 'active' : ''; ?>">
            <a href="admin_customers.php"
                class="flex items-center px-6 py-4 text-gray-300 no-underline font-medium hover:bg-slate-700 hover:text-white transition-colors duration-300">
                <i class="fas fa-users w-5 mr-4 text-center"></i> Customers</a>
        </li>

    </ul>


</nav>