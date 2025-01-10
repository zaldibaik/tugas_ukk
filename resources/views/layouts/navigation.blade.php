<nav x-data="{ open: false }"
    class="bg-white dark:bg-orange-800 border-r border-orange-100 dark:border-orange-700 h-full fixed top-0 left-0 w-64 z-30">
    <div class="flex flex-col h-full overflow-y-auto">
        <!-- Logo -->
        <div class="shrink-0 p-4">
            <a href="{{ route('dashboard') }}">
                <div class="text-white text-3xl font-bold">Cake shop</div>
            </a>
        </div>

        <!-- Navigation Links -->
        <div class="flex flex-col space-y-4 px-4 py-2">
            @if (Auth::check() && Auth::user()->email === 'admin@admin.com')
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-nav-link>
            @endif

            <x-nav-link :href="route('sales.shop')" :active="request()->routeIs('sales.shop')">
                {{ __('Shop') }}
            </x-nav-link>
            <x-nav-link :href="route('cart.show')" :active="request()->routeIs('cart.show')">
                {{ __('Cart') }}
            </x-nav-link>
            <x-nav-link :href="route('wishlists.indexWishlist')" :active="request()->routeIs('wishlists.indexWishlist')">
                    {{ __('wishlists') }}
                </x-nav-link>

            @if (Auth::check() && Auth::user()->email === 'admin@admin.com')
                <x-nav-link :href="route('products.index')" :active="request()->routeIs('products.index')">
                    {{ __('Products Management') }}
                </x-nav-link>
                <x-nav-link :href="route('discounts.index')" :active="request()->routeIs('discounts.index')">
                    {{ __('Discounts Management') }}
                </x-nav-link>
                <x-nav-link :href="route('payments.index')" :active="request()->routeIs('payments.index')">
                    {{ __('Payments Management') }}
                </x-nav-link>
                <x-nav-link :href="route('deliveries.index')" :active="request()->routeIs('deliveries.index')">
                    {{ __('Deliveries Management') }}
                </x-nav-link>
                <x-nav-link :href="route('managementOrder.index')" :active="request()->routeIs('managementOrder.index')">
                    {{ __('Order Management') }}
                </x-nav-link>
                <x-nav-link :href="route('wishlists.index')" :active="request()->routeIs('wishlists.index')">
                    {{ __('wishlists Management') }}
                </x-nav-link>
                <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.index')">
                    {{ __('Management Users') }}
                </x-nav-link>
                <x-nav-link :href="route('categories.create')" :active="request()->routeIs('categories.create')">
                    {{ __('Product Categories') }}
                </x-nav-link>
                <x-nav-link :href="route('discountCategories.create')"
                    :active="request()->routeIs('discountCategories.create')">
                    {{ __('Discount Categories') }}
                </x-nav-link>
            @endif
        </div>

        <!-- User Profile and Logout -->
        <div class="mt-auto p-4 border-t border-orange-200 dark:border-orange-600">
            <div class="font-medium text-base text-orange-800 dark:text-orange-200">{{ Auth::user()->name }}</div>
            <div class="font-medium text-sm text-orange-500">{{ Auth::user()->email }}</div>

            <div class="mt-3 space-y-1">
                <x-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Logout') }}
                    </x-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>