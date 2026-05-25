<aside class="w-[220px] bg-[#F8F8F8] border-r border-gray-200 flex flex-col justify-between">

    <div>

        <!-- LOGO -->
        <div class="h-[70px] px-6 flex items-center justify-between border-b border-gray-200">

            <div class="flex items-center gap-3">

                <div class="w-9 h-9 bg-gray-700 rounded-sm"></div>

                <span class="font-bold text-[30px] tracking-tight text-gray-700">
                    ERP
                </span>

            </div>

        </div>

        <!-- MENU -->
        <nav class="px-3 py-6 space-y-1">

            <a href="/users" class="w-full h-[46px] rounded-md flex items-center gap-3 px-4 text-[15px]
                {{ request()->is('users') ? 'bg-gray-200 text-gray-800' : 'text-gray-600 hover:bg-gray-100' }}">

                👤 Users
            </a>

            <a href="/customers"
                class="w-full h-[46px] rounded-md flex items-center gap-3 px-4 text-[15px]
                {{ request()->is('customers') || request()->is('/') ? 'bg-gray-200 text-gray-800' : 'text-gray-600 hover:bg-gray-100' }}">

                👥 Customers
            </a>

            <a href="/services" class="w-full h-[46px] rounded-md flex items-center gap-3 px-4 text-[15px]
                {{ request()->is('services') ? 'bg-gray-200 text-gray-800' : 'text-gray-600 hover:bg-gray-100' }}">

                🧩 Services
            </a>

            <a href="/subscriptions"
                class="w-full h-[46px] rounded-md flex items-center gap-3 px-4 text-[15px]
                {{ request()->is('subscriptions') ? 'bg-gray-200 text-gray-800' : 'text-gray-600 hover:bg-gray-100' }}">

                📄 Subscription
            </a>

        </nav>

    </div>

    <!-- SIGN OUT -->
    <div class="p-4">

        <button class="flex items-center gap-3 text-gray-600 text-[15px]">
            🚪 Sign Out
        </button>

    </div>

</aside>