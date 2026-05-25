<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ERP</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#202020] font-sans overflow-hidden">

    <div class="w-screen h-screen">

        <div class="bg-[#F5F5F5] w-full h-full flex overflow-hidden">

            <!-- SIDEBAR -->
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

                        <button class="text-gray-500 text-sm">
                            ◫
                        </button>

                    </div>

                    <!-- MENU -->
                    <nav class="px-3 py-6 space-y-1">

                        <button id="btn-users" onclick="switchPage('users')"
                            class="w-full h-[46px] rounded-md flex items-center gap-3 px-4 text-[15px] text-gray-600 hover:bg-gray-100 transition">

                            👤 Users
                        </button>

                        <button id="btn-customers" onclick="switchPage('customers')"
                            class="w-full h-[46px] rounded-md flex items-center gap-3 px-4 text-[15px] bg-gray-200 text-gray-800">

                            👥 Customers
                        </button>

                        <button id="btn-services" onclick="switchPage('services')"
                            class="w-full h-[46px] rounded-md flex items-center gap-3 px-4 text-[15px] text-gray-600 hover:bg-gray-100 transition">

                            🧩 Services
                        </button>

                        <button id="btn-subscriptions" onclick="switchPage('subscriptions')"
                            class="w-full h-[46px] rounded-md flex items-center gap-3 px-4 text-[15px] text-gray-600 hover:bg-gray-100 transition">

                            📄 Subscription
                        </button>

                    </nav>

                </div>

                <!-- SIGN OUT -->
                <div class="p-4">

                    <button class="flex items-center gap-3 text-gray-600 text-[15px]">
                        🚪 Sign Out
                    </button>

                </div>

            </aside>

            <!-- CONTENT -->
            <main class="flex-1 overflow-auto">

                <!-- CUSTOMERS -->
                <div id="page-customers" class="page-content">

                    <!-- HEADER -->
                    <div class="h-[70px] border-b border-gray-200 flex items-center px-6">

                        <h1 class="text-[20px] text-gray-700">
                            Customers
                        </h1>

                    </div>

                    <!-- BODY -->
                    <div class="p-6">

                        <!-- TOP BUTTON -->
                        <div class="flex justify-end mb-5">

                            <button onclick="openModal('customer')"
                                class="h-[46px] px-5 rounded-xl bg-[#3F4650] hover:bg-[#343B44] text-white text-[15px] flex items-center gap-2 transition">

                                +
                                Add Data

                            </button>

                        </div>

                        <!-- TABLE -->
                        <div class="bg-white border border-gray-200">

                            <table class="w-full">

                                <thead>

                                    <tr class="border-b border-gray-200 text-gray-700 text-[14px]">

                                        <th class="text-left font-medium px-5 h-[52px]">
                                            Customer ID
                                        </th>

                                        <th class="text-left font-medium px-5 h-[52px]">
                                            Customer Name
                                        </th>

                                        <th class="text-left font-medium px-5 h-[52px]">
                                            Email
                                        </th>

                                        <th class="text-left font-medium px-5 h-[52px]">
                                            Address
                                        </th>

                                        <th class="text-left font-medium px-5 h-[52px]">
                                            Status
                                        </th>

                                        <th class="text-center font-medium px-5 h-[52px]">
                                            Action
                                        </th>

                                    </tr>

                                </thead>

                                <tbody id="table-customers">

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

                <!-- USERS -->
                <div id="page-users" class="page-content hidden">

                    <div class="h-[70px] border-b border-gray-200 flex items-center px-6">

                        <h1 class="text-[20px] text-gray-700">
                            Users
                        </h1>

                    </div>

                    <div class="p-6">

                        <div class="bg-white border border-gray-200 p-6 text-gray-600">
                            Users Page
                        </div>

                    </div>

                </div>

                <!-- SERVICES -->
                <div id="page-services" class="page-content hidden">

                    <div class="h-[70px] border-b border-gray-200 flex items-center justify-between px-6">

                        <h1 class="text-[20px] text-gray-700">
                            Services
                        </h1>

                        <button onclick="openModal('service')"
                            class="h-[46px] px-5 rounded-xl bg-[#3F4650] hover:bg-[#343B44] text-white text-[15px] flex items-center gap-2 transition">

                            +
                            Add Data

                        </button>

                    </div>

                    <div class="p-6">

                        <div class="bg-white border border-gray-200">

                            <table class="w-full">

                                <thead>

                                    <tr class="border-b border-gray-200 text-gray-700 text-[14px]">

                                        <th class="text-left font-medium px-5 h-[52px]">
                                            Service Name
                                        </th>

                                        <th class="text-left font-medium px-5 h-[52px]">
                                            Price
                                        </th>

                                        <th class="text-left font-medium px-5 h-[52px]">
                                            Status
                                        </th>

                                        <th class="text-center font-medium px-5 h-[52px]">
                                            Action
                                        </th>

                                    </tr>

                                </thead>

                                <tbody id="table-services">

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

                <!-- SUBSCRIPTIONS -->
                <div id="page-subscriptions" class="page-content hidden">

                    <div class="h-[70px] border-b border-gray-200 flex items-center justify-between px-6">

                        <h1 class="text-[20px] text-gray-700">
                            Subscription
                        </h1>

                        <button onclick="openModal('subscription')"
                            class="h-[46px] px-5 rounded-xl bg-[#3F4650] hover:bg-[#343B44] text-white text-[15px] flex items-center gap-2 transition">

                            +
                            Add Data

                        </button>

                    </div>

                    <div class="p-6">

                        <div class="bg-white border border-gray-200">

                            <table class="w-full">

                                <thead>

                                    <tr class="border-b border-gray-200 text-gray-700 text-[14px]">

                                        <th class="text-left font-medium px-5 h-[52px]">
                                            Customer
                                        </th>

                                        <th class="text-left font-medium px-5 h-[52px]">
                                            Service
                                        </th>

                                        <th class="text-left font-medium px-5 h-[52px]">
                                            Period
                                        </th>

                                        <th class="text-left font-medium px-5 h-[52px]">
                                            Status
                                        </th>

                                        <th class="text-center font-medium px-5 h-[52px]">
                                            Action
                                        </th>

                                    </tr>

                                </thead>

                                <tbody id="table-subscriptions">

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

            </main>

        </div>

    </div>

</body>

</html>