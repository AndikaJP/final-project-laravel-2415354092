@extends('layouts.app')

@section('content')

    <div>

        <!-- HEADER -->
        <div class="h-[70px] border-b border-gray-200 flex items-center px-6">

            <h1 class="text-[20px] text-gray-700">
                Subscriptions
            </h1>

        </div>

        <!-- MODAL -->
        <div id="subscription-modal" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">

            <div class="bg-white w-[450px] rounded-md p-6">

                <h2 class="text-[32px] font-semibold text-center mb-6">
                    Add Subscription
                </h2>

                <form id="subscription-form">

                    <!-- CUSTOMER -->
                    <div class="mb-4">

                        <label class="block text-[14px] font-medium mb-2">
                            Customer
                        </label>

                        <select id="subscription-customer" name="customer_id"
                            class="w-full h-[42px] border border-gray-200 rounded-md px-4 outline-none focus:border-gray-400">

                            <option value="">
                                Select Customer
                            </option>

                        </select>

                    </div>

                    <!-- SERVICE -->
                    <div class="mb-4">

                        <label class="block text-[14px] font-medium mb-2">
                            Service
                        </label>

                        <select id="subscription-service" name="service_id"
                            class="w-full h-[42px] border border-gray-200 rounded-md px-4 outline-none focus:border-gray-400">

                            <option value="">
                                Select Service
                            </option>

                        </select>

                    </div>

                    <!-- START DATE -->
                    <div class="mb-4">

                        <label class="block text-[14px] font-medium mb-2">
                            Start Date
                        </label>

                        <input type="date" name="start_date"
                            class="w-full h-[42px] border border-gray-200 rounded-md px-4 outline-none focus:border-gray-400">

                    </div>

                    <!-- END DATE -->
                    <div class="mb-4">

                        <label class="block text-[14px] font-medium mb-2">
                            End Date
                        </label>

                        <input type="date" name="end_date"
                            class="w-full h-[42px] border border-gray-200 rounded-md px-4 outline-none focus:border-gray-400">

                    </div>

                    <!-- STATUS -->
                    <div class="mb-6">

                        <label class="block text-[14px] font-medium mb-2">
                            Status
                        </label>

                        <select name="status"
                            class="w-full h-[42px] border border-gray-200 rounded-md px-4 outline-none focus:border-gray-400">

                            <option value="">
                                Select Status
                            </option>

                            <option value="active">
                                Active
                            </option>

                            <option value="inactive">
                                Inactive
                            </option>

                            <option value="trial">
                                Trial
                            </option>

                            <option value="isolir">
                                Isolir
                            </option>

                            <option value="dismantled">
                                Dismantled
                            </option>

                        </select>

                    </div>

                    <!-- BUTTON -->
                    <div class="flex justify-end gap-2">

                        <button type="button" onclick="closeModal('subscription-modal')"
                            class="px-4 h-[38px] border border-gray-300 rounded-md text-[14px]">

                            Cancel

                        </button>

                        <button type="submit" class="px-4 h-[38px] bg-[#3F4650] text-white rounded-md text-[14px]">

                            Submit

                        </button>

                    </div>

                </form>

            </div>

        </div>

        <!-- BODY -->
        <div class="p-6">

            <!-- BUTTON -->
            <div class="flex justify-end mb-5">

                <button onclick="openModal('subscription-modal')"
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
                                Customer Name
                            </th>

                            <th class="text-left font-medium px-5 h-[52px]">
                                Services
                            </th>

                            <th class="text-left font-medium px-5 h-[52px]">
                                Service Period
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

    <script>

        /*
        |--------------------------------------------------------------------------
        | FORMAT DATE
        |--------------------------------------------------------------------------
        */

        function formatDate(dateString) {

            if (!dateString) return '-';

            const date = new Date(dateString);

            return date.toLocaleDateString('id-ID', {
                year: 'numeric',
                month: '2-digit',
                day: '2-digit'
            });

        }

        /*
        |--------------------------------------------------------------------------
        | FETCH SUBSCRIPTIONS
        |--------------------------------------------------------------------------
        */

        function fetchSubscriptions() {

            fetch(`${API_URL}/subscriptions`)
                .then(res => res.json())
                .then(res => {

                    const tbody = document.getElementById('table-subscriptions');

                    tbody.innerHTML = res.data.map(s => `

                                        <tr class="border-b border-gray-200 hover:bg-gray-50">

                                            <td class="px-5 h-[56px]">
                                                ${s.customer?.name ?? '-'}
                                            </td>

                                            <td class="px-5 h-[56px]">
                                                ${s.service?.name ?? '-'}
                                            </td>

                                            <td class="px-5 h-[56px]">
                                                ${formatDate(s.start_date)} - ${formatDate(s.end_date)}
                                            </td>

                                            <td class="px-5 h-[56px]">

                                                <span class="
                                                    px-3 py-1 rounded-full text-[12px] capitalize

                                                    ${s.status === 'active'
                            ? 'bg-green-100 text-green-600'

                            : s.status === 'inactive'
                                ? 'bg-gray-200 text-gray-700'

                                : s.status === 'trial'
                                    ? 'bg-blue-100 text-blue-600'

                                    : s.status === 'isolir'
                                        ? 'bg-yellow-100 text-yellow-700'

                                        : s.status === 'dismantled'
                                            ? 'bg-red-100 text-red-600'

                                            : 'bg-gray-100 text-gray-500'
                        }
                                                ">

                                                    ${s.status}

                                                </span>

                                            </td>

                                            <td class="px-5 h-[56px] text-center relative">

                                                ${s.status === 'dismantled'

                            ? `
                                                        <span class="text-gray-400 text-[13px]">
                                                            No Action
                                                        </span>
                                                    `

                            : `

                                                        <div class="relative inline-block">

                                                            <button
                                                                onclick="toggleDropdown(${s.id})"
                                                                class="text-[18px] text-gray-600 hover:text-black"
                                                            >
                                                                ☰
                                                            </button>

                                                            <div
                                                                id="dropdown-${s.id}"
                                                                class="hidden absolute right-0 mt-2 w-[180px] bg-white border border-gray-200 rounded-md shadow-lg z-50"
                                                            >

                                                                <button
                                                                    onclick="changeSubscriptionStatus(${s.id}, 'active')"
                                                                    class="w-full text-left px-4 py-2 hover:bg-gray-100 text-[14px]"
                                                                >
                                                                    Active
                                                                </button>

                                                                <button
                                                                    onclick="changeSubscriptionStatus(${s.id}, 'inactive')"
                                                                    class="w-full text-left px-4 py-2 hover:bg-gray-100 text-[14px]"
                                                                >
                                                                    Inactive
                                                                </button>

                                                                <button
                                                                    onclick="changeSubscriptionStatus(${s.id}, 'trial')"
                                                                    class="w-full text-left px-4 py-2 hover:bg-gray-100 text-[14px]"
                                                                >
                                                                    Trial
                                                                </button>

                                                                <button
                                                                    onclick="changeSubscriptionStatus(${s.id}, 'isolir')"
                                                                    class="w-full text-left px-4 py-2 hover:bg-gray-100 text-[14px]"
                                                                >
                                                                    Isolir
                                                                </button>

                                                                <button
                                                                    onclick="changeSubscriptionStatus(${s.id}, 'dismantled')"
                                                                    class="w-full text-left px-4 py-2 hover:bg-red-50 text-red-600 text-[14px]"
                                                                >
                                                                    Dismantled
                                                                </button>

                                                            </div>

                                                        </div>

                                                    `
                        }

                                            </td>

                                        </tr>

                                    `).join('');

                });

        }

        /*
        |--------------------------------------------------------------------------
        | LOAD CUSTOMERS
        |--------------------------------------------------------------------------
        */

        function loadCustomers() {

            fetch(`${API_URL}/customers`)
                .then(res => res.json())
                .then(res => {

                    const select = document.getElementById('subscription-customer');

                    select.innerHTML = `
                                        <option value="">
                                            Select Customer
                                        </option>
                                    `;

                    select.innerHTML += res.data.map(c => `

                                        <option value="${c.id}">
                                            ${c.name}
                                        </option>

                                    `).join('');

                });

        }

        /*
        |--------------------------------------------------------------------------
        | LOAD SERVICES
        |--------------------------------------------------------------------------
        */

        function loadServices() {

            fetch(`${API_URL}/services`)
                .then(res => res.json())
                .then(res => {

                    const select = document.getElementById('subscription-service');

                    select.innerHTML = `
                                        <option value="">
                                            Select Service
                                        </option>
                                    `;

                    select.innerHTML += res.data.map(s => `

                                        <option value="${s.id}">
                                            ${s.name}
                                        </option>

                                    `).join('');

                });

        }

        /*
        |--------------------------------------------------------------------------
        | STORE SUBSCRIPTION
        |--------------------------------------------------------------------------
        */

        const subscriptionForm = document.getElementById('subscription-form');

        if (subscriptionForm) {

            subscriptionForm.addEventListener('submit', function (e) {

                e.preventDefault();

                const formData = new FormData(subscriptionForm);

                const data = Object.fromEntries(formData.entries());

                fetch(`${API_URL}/subscriptions`, {

                    method: 'POST',

                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },

                    body: JSON.stringify(data)

                })
                    .then(res => res.json())
                    .then(res => {

                        alert(res.message);

                        subscriptionForm.reset();

                        closeModal('subscription-modal');

                        fetchSubscriptions();

                    });

            });

        }

        /*
        |--------------------------------------------------------------------------
        | TOGGLE DROPDOWN
        |--------------------------------------------------------------------------
        */

        function toggleDropdown(id) {

            const dropdown = document.getElementById(`dropdown-${id}`);

            document.querySelectorAll('[id^="dropdown-"]').forEach(el => {

                if (el.id !== `dropdown-${id}`) {
                    el.classList.add('hidden');
                }

            });

            dropdown.classList.toggle('hidden');

        }

        /*
        |--------------------------------------------------------------------------
        | CHANGE STATUS
        |--------------------------------------------------------------------------
        */

        function changeSubscriptionStatus(id, status) {

            fetch(`${API_URL}/subscriptions/${id}/status`, {

                method: 'PATCH',

                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },

                body: JSON.stringify({
                    status: status
                })

            })
                .then(async res => {

                    const data = await res.json();

                    if (!res.ok) {
                        alert(data.message || 'Failed update status');
                        return;
                    }

                    fetchSubscriptions();

                })
                .catch(err => console.log(err));

        }

        /*
        |--------------------------------------------------------------------------
        | CLOSE DROPDOWN OUTSIDE
        |--------------------------------------------------------------------------
        */

        document.addEventListener('click', function (e) {

            if (!e.target.closest('.relative')) {

                document.querySelectorAll('[id^="dropdown-"]').forEach(el => {

                    el.classList.add('hidden');

                });

            }

        });

        /*
        |--------------------------------------------------------------------------
        | AUTO LOAD
        |--------------------------------------------------------------------------
        */

        document.addEventListener('DOMContentLoaded', () => {

            fetchSubscriptions();

            loadCustomers();

            loadServices();

        });

    </script>

@endsection