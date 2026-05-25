@extends('layouts.app')

@section('content')

    <div>

        <!-- HEADER -->
        <div class="h-[70px] border-b border-gray-200 flex items-center px-6">

            <h1 class="text-[20px] text-gray-700">
                Customers
            </h1>

        </div>

        <!-- ADD MODAL -->
        <div id="customer-modal" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">

            <div class="bg-white w-[420px] rounded-md p-6">

                <h2 class="text-[28px] font-semibold text-center mb-6">
                    Add Customer
                </h2>

                <form id="customer-form">

                    <div class="mb-4">

                        <label class="block mb-2 text-[14px]">
                            Customer ID
                        </label>

                        <input type="text" name="customer_id"
                            class="w-full h-[42px] border border-gray-200 rounded-md px-4">

                    </div>

                    <div class="mb-4">

                        <label class="block mb-2 text-[14px]">
                            Customer Name
                        </label>

                        <input type="text" name="name" class="w-full h-[42px] border border-gray-200 rounded-md px-4">

                    </div>

                    <div class="mb-4">

                        <label class="block mb-2 text-[14px]">
                            Email
                        </label>

                        <input type="email" name="email" class="w-full h-[42px] border border-gray-200 rounded-md px-4">

                    </div>

                    <div class="mb-4">

                        <label class="block mb-2 text-[14px]">
                            Address
                        </label>

                        <input type="text" name="address" class="w-full h-[42px] border border-gray-200 rounded-md px-4">

                    </div>

                    <div class="mb-6">

                        <label class="block mb-2 text-[14px]">
                            Status
                        </label>

                        <select name="status" class="w-full h-[42px] border border-gray-200 rounded-md px-4">

                            <option value="1">
                                Active
                            </option>

                            <option value="0">
                                Inactive
                            </option>

                        </select>

                    </div>

                    <div class="flex justify-end gap-2">

                        <button type="button" onclick="closeModal('customer-modal')"
                            class="px-4 h-[38px] border border-gray-300 rounded-md">

                            Cancel

                        </button>

                        <button type="submit" class="px-4 h-[38px] bg-[#3F4650] text-white rounded-md">

                            Submit

                        </button>

                    </div>

                </form>

            </div>

        </div>

        <!-- EDIT MODAL -->
        <div id="edit-customer-modal" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">

            <div class="bg-white w-[420px] rounded-md p-6">

                <h2 class="text-[28px] font-semibold text-center mb-6">
                    Edit Customer
                </h2>

                <form id="edit-customer-form">

                    <input type="hidden" id="edit-id">

                    <div class="mb-4">

                        <label class="block mb-2 text-[14px]">
                            Customer ID
                        </label>

                        <input type="text" id="edit-customer-id"
                            class="w-full h-[42px] border border-gray-200 rounded-md px-4">

                    </div>

                    <div class="mb-4">

                        <label class="block mb-2 text-[14px]">
                            Customer Name
                        </label>

                        <input type="text" id="edit-name" class="w-full h-[42px] border border-gray-200 rounded-md px-4">

                    </div>

                    <div class="mb-4">

                        <label class="block mb-2 text-[14px]">
                            Email
                        </label>

                        <input type="email" id="edit-email" class="w-full h-[42px] border border-gray-200 rounded-md px-4">

                    </div>

                    <div class="mb-4">

                        <label class="block mb-2 text-[14px]">
                            Address
                        </label>

                        <input type="text" id="edit-address" class="w-full h-[42px] border border-gray-200 rounded-md px-4">

                    </div>

                    <div class="flex justify-end gap-2">

                        <button type="button" onclick="closeModal('edit-customer-modal')"
                            class="px-4 h-[38px] border border-gray-300 rounded-md">

                            Cancel

                        </button>

                        <button type="submit" class="px-4 h-[38px] bg-[#3F4650] text-white rounded-md">

                            Update

                        </button>

                    </div>

                </form>

            </div>

        </div>

        <!-- BODY -->
        <div class="p-6">

            <div class="flex justify-end mb-5">

                <button onclick="openModal('customer-modal')" class="h-[46px] px-5 rounded-xl bg-[#3F4650] text-white">

                    + Add Data

                </button>

            </div>

            <div class="bg-white border border-gray-200 overflow-visible">

                <table class="w-full overflow-visible">

                    <thead>

                        <tr class="border-b border-gray-200 text-[14px] text-gray-700">

                            <th class="text-left px-5 h-[52px]">
                                Customer ID
                            </th>

                            <th class="text-left px-5 h-[52px]">
                                Name
                            </th>

                            <th class="text-left px-5 h-[52px]">
                                Email
                            </th>

                            <th class="text-left px-5 h-[52px]">
                                Address
                            </th>

                            <th class="text-left px-5 h-[52px]">
                                Status
                            </th>

                            <th class="text-center px-5 h-[52px]">
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

    <script>

        /*
        |--------------------------------------------------------------------------
        | FETCH CUSTOMERS
        |--------------------------------------------------------------------------
        */

        function fetchCustomers() {

            fetch(`${API_URL}/customers`)
                .then(res => res.json())
                .then(res => {

                    const tbody = document.getElementById('table-customers');

                    tbody.innerHTML = res.data.map(c => {

                        const hasSubscription = c.subscriptions_count > 0;

                        return `

                            <tr class="border-b border-gray-200 hover:bg-gray-50">

                                <td class="px-5 h-[56px]">
                                    ${c.customer_id}
                                </td>

                                <td class="px-5 h-[56px]">
                                    ${c.name}
                                </td>

                                <td class="px-5 h-[56px]">
                                    ${c.email}
                                </td>

                                <td class="px-5 h-[56px]">
                                    ${c.address ?? '-'}
                                </td>

                                <td class="px-5 h-[56px]">

                                    <span class="
                                        px-3 py-1 rounded-full text-[12px]

                                        ${c.status
                                ? 'bg-green-100 text-green-600'
                                : 'bg-red-100 text-red-600'}
                                    ">

                                        ${c.status ? 'Active' : 'Inactive'}

                                    </span>

                                </td>

                                <td class="px-5 h-[56px] text-center relative overflow-visible">

                                    <button
                                        onclick="toggleDropdown(${c.id})"
                                        class="w-[32px] h-[32px] rounded hover:bg-gray-100">

                                        ☰

                                    </button>

                                    <div
                                        id="dropdown-${c.id}"
                                        class="hidden absolute right-10 top-10 bg-white border border-gray-200 rounded-md shadow-lg w-[180px] z-50">

                                        <button
                                            onclick='openEditModal(${JSON.stringify(c)})'
                                            class="w-full text-left px-4 py-2 hover:bg-gray-50">

                                            Edit

                                        </button>

                                        ${!hasSubscription
                                ? `
                                                <button
                                                    onclick="deleteCustomer(${c.id})"
                                                    class="w-full text-left px-4 py-2 hover:bg-red-50 text-red-600">

                                                    Delete

                                                </button>
                                            `
                                : `
                                                <div class="px-4 py-2 text-[12px] text-gray-400 text-left">
                                                    Has Subscription
                                                </div>
                                            `
                            }

                                    </div>

                                </td>

                            </tr>

                            `;

                    }).join('');

                });

        }

        /*
        |--------------------------------------------------------------------------
        | ADD CUSTOMER
        |--------------------------------------------------------------------------
        */

        const customerForm = document.getElementById('customer-form');

        customerForm.addEventListener('submit', function (e) {

            e.preventDefault();

            const formData = new FormData(customerForm);

            const data = Object.fromEntries(formData.entries());

            data.status = data.status == 1;

            fetch(`${API_URL}/customers`, {

                method: 'POST',

                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },

                body: JSON.stringify(data)

            })
                .then(res => res.json())
                .then(() => {

                    customerForm.reset();

                    closeModal('customer-modal');

                    fetchCustomers();

                });

        });

        /*
        |--------------------------------------------------------------------------
        | TOGGLE DROPDOWN
        |--------------------------------------------------------------------------
        */

        function toggleDropdown(id) {

            document.querySelectorAll('[id^="dropdown-"]').forEach(el => {

                if (el.id !== `dropdown-${id}`) {
                    el.classList.add('hidden');
                }

            });

            const dropdown = document.getElementById(`dropdown-${id}`);

            dropdown.classList.toggle('hidden');

        }

        /*
        |--------------------------------------------------------------------------
        | OPEN EDIT MODAL
        |--------------------------------------------------------------------------
        */

        function openEditModal(customer) {

            document.getElementById('edit-id').value = customer.id;

            document.getElementById('edit-customer-id').value = customer.customer_id;

            document.getElementById('edit-name').value = customer.name;

            document.getElementById('edit-email').value = customer.email;

            document.getElementById('edit-address').value = customer.address ?? '';

            openModal('edit-customer-modal');

        }

        /*
        |--------------------------------------------------------------------------
        | UPDATE CUSTOMER
        |--------------------------------------------------------------------------
        */

        const editForm = document.getElementById('edit-customer-form');

        editForm.addEventListener('submit', function (e) {

            e.preventDefault();

            const id = document.getElementById('edit-id').value;

            fetch(`${API_URL}/customers/${id}`, {

                method: 'PUT',

                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },

                body: JSON.stringify({

                    customer_id: document.getElementById('edit-customer-id').value,

                    name: document.getElementById('edit-name').value,

                    email: document.getElementById('edit-email').value,

                    address: document.getElementById('edit-address').value

                })

            })
                .then(res => res.json())
                .then(() => {

                    closeModal('edit-customer-modal');

                    fetchCustomers();

                });

        });

        /*
        |--------------------------------------------------------------------------
        | DELETE CUSTOMER
        |--------------------------------------------------------------------------
        */

        function deleteCustomer(id) {

            const confirmDelete = confirm('Delete this customer?');

            if (!confirmDelete) return;

            fetch(`${API_URL}/customers/${id}`, {

                method: 'DELETE'

            })
                .then(res => res.json())
                .then(res => {

                    if (!res.success) {

                        alert(res.message);

                        return;

                    }

                    fetchCustomers();

                });

        }

        /*
        |--------------------------------------------------------------------------
        | CLOSE DROPDOWN WHEN CLICK OUTSIDE
        |--------------------------------------------------------------------------
        */

        document.addEventListener('click', function (e) {

            if (!e.target.closest('[onclick^="toggleDropdown"]') &&
                !e.target.closest('[id^="dropdown-"]')) {

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

            fetchCustomers();

        });

    </script>

@endsection