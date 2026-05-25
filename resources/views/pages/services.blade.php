@extends('layouts.app')

@section('content')

    <div>

        <!-- HEADER -->
        <div class="h-[70px] border-b border-gray-200 flex items-center px-6">

            <h1 class="text-[20px] text-gray-700">
                Services
            </h1>

        </div>

        <!-- MODAL -->
        <div id="service-modal" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">

            <div class="bg-white w-[450px] rounded-md p-6">

                <h2 id="modal-title" class="text-[32px] font-semibold text-center mb-6">

                    Add Service

                </h2>

                <form id="service-form">

                    <!-- HIDDEN ID -->
                    <input type="hidden" id="service-id">

                    <!-- SERVICE NAME -->
                    <div class="mb-4">

                        <label class="block text-[14px] font-medium mb-2">
                            Service Name
                        </label>

                        <input type="text" id="service-name" placeholder="Enter service name"
                            class="w-full h-[42px] border border-gray-200 rounded-md px-4 outline-none focus:border-gray-400">

                    </div>

                    <!-- PRICE -->
                    <div class="mb-4">

                        <label class="block text-[14px] font-medium mb-2">
                            Price
                        </label>

                        <input type="number" id="service-price" placeholder="Enter service price"
                            class="w-full h-[42px] border border-gray-200 rounded-md px-4 outline-none focus:border-gray-400">

                    </div>

                    <!-- DESCRIPTION -->
                    <div class="mb-4">

                        <label class="block text-[14px] font-medium mb-2">
                            Description
                        </label>

                        <textarea id="service-description" rows="4" placeholder="Enter description"
                            class="w-full border border-gray-200 rounded-md px-4 py-3 outline-none focus:border-gray-400"></textarea>

                    </div>

                    <!-- STATUS -->
                    <div class="mb-6">

                        <label class="block text-[14px] font-medium mb-2">
                            Status
                        </label>

                        <select id="service-status"
                            class="w-full h-[42px] border border-gray-200 rounded-md px-4 outline-none focus:border-gray-400">

                            <option value="1">
                                Active
                            </option>

                            <option value="0">
                                Inactive
                            </option>

                        </select>

                    </div>

                    <!-- BUTTON -->
                    <div class="flex justify-end gap-2">

                        <button type="button" onclick="closeModal('service-modal')"
                            class="px-4 h-[38px] border border-gray-300 rounded-md text-[14px]">

                            Cancel

                        </button>

                        <button type="submit" class="px-4 h-[38px] bg-[#3F4650] text-white rounded-md text-[14px]">

                            Save

                        </button>

                    </div>

                </form>

            </div>

        </div>

        <!-- BODY -->
        <div class="p-6">

            <!-- BUTTON -->
            <div class="flex justify-end mb-5">

                <button onclick="openCreateModal()"
                    class="h-[46px] px-5 rounded-xl bg-[#3F4650] hover:bg-[#343B44] text-white text-[15px] flex items-center gap-2 transition">

                    +
                    Add Data

                </button>

            </div>

            <!-- TABLE -->
            <div class="bg-white border border-gray-200 overflow-visible">

                <table class="w-full overflow-visible">

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

    <script>

        const API_URL = "http://127.0.0.1:8000/api";

        /*
        |--------------------------------------------------------------------------
        | MODAL
        |--------------------------------------------------------------------------
        */

        function openModal(id) {

            const modal = document.getElementById(id);

            modal.classList.remove('hidden');

            modal.classList.add('flex');

        }

        function closeModal(id) {

            const modal = document.getElementById(id);

            modal.classList.remove('flex');

            modal.classList.add('hidden');

        }

        /*
        |--------------------------------------------------------------------------
        | OPEN CREATE MODAL
        |--------------------------------------------------------------------------
        */

        function openCreateModal() {

            document.getElementById('modal-title').innerText = 'Add Service';

            document.getElementById('service-id').value = '';

            document.getElementById('service-name').value = '';

            document.getElementById('service-price').value = '';

            document.getElementById('service-description').value = '';

            document.getElementById('service-status').value = 1;

            openModal('service-modal');

        }

        /*
        |--------------------------------------------------------------------------
        | FETCH SERVICES
        |--------------------------------------------------------------------------
        */

        function fetchServices() {

            fetch(`${API_URL}/services`)
                .then(res => res.json())
                .then(res => {

                    const tbody = document.getElementById('table-services');

                    tbody.innerHTML = res.data.map(s => `

                                        <tr class="border-b border-gray-200 hover:bg-gray-50">

                                            <td class="px-5 h-[56px]">
                                                ${s.name}
                                            </td>

                                            <td class="px-5 h-[56px]">
                                                Rp ${parseFloat(s.price).toLocaleString('id-ID')}
                                            </td>

                                            <td class="px-5 h-[56px]">

                                                <span class="
                                                    px-3 py-1 rounded-full text-[12px]

                                                    ${s.status
                            ? 'bg-green-100 text-green-600'
                            : 'bg-red-100 text-red-600'}
                                                ">

                                                    ${s.status ? 'Active' : 'Inactive'}

                                                </span>

                                            </td>

                                            <td class="px-5 h-[56px] text-center relative overflow-visible">

                                                <div class="inline-block relative">

                                                    <button
                                                        onclick="toggleDropdown(${s.id})"
                                                        class="w-[34px] h-[34px] rounded hover:bg-gray-100">

                                                        ☰

                                                    </button>

                                                    <div id="dropdown-${s.id}"
                                                        class="hidden absolute right-0 top-[38px] w-[180px] bg-white border border-gray-200 rounded-md shadow-lg z-[9999]">

                                                        <button
                                                            onclick="editService(${s.id})"
                                                            class="w-full text-left px-4 py-2 hover:bg-gray-100 text-[14px]">

                                                            Edit

                                                        </button>

                                                        <button
                                                            onclick="deleteService(${s.id})"
                                                            class="w-full text-left px-4 py-2 hover:bg-red-50 text-red-500 text-[14px]">

                                                            Delete

                                                        </button>

                                                    </div>

                                                </div>

                                            </td>

                                        </tr>

                                    `).join('');

                });

        }

        /*
        |--------------------------------------------------------------------------
        | TOGGLE DROPDOWN
        |--------------------------------------------------------------------------
        */

        function toggleDropdown(id) {

            document.querySelectorAll('[id^="dropdown-"]').forEach(dropdown => {

                if (dropdown.id !== `dropdown-${id}`) {

                    dropdown.classList.add('hidden');

                }

            });

            const dropdown = document.getElementById(`dropdown-${id}`);

            dropdown.classList.toggle('hidden');

        }

        /*
        |--------------------------------------------------------------------------
        | STORE & UPDATE
        |--------------------------------------------------------------------------
        */

        const serviceForm = document.getElementById('service-form');

        serviceForm.addEventListener('submit', function (e) {

            e.preventDefault();

            const id = document.getElementById('service-id').value;

            const data = {

                name: document.getElementById('service-name').value,

                price: document.getElementById('service-price').value,

                description: document.getElementById('service-description').value,

                status: document.getElementById('service-status').value == 1

            };

            let url = `${API_URL}/services`;

            let method = 'POST';

            if (id) {

                url = `${API_URL}/services/${id}`;

                method = 'PUT';

            }

            fetch(url, {

                method: method,

                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },

                body: JSON.stringify(data)

            })
                .then(res => res.json())
                .then(() => {

                    serviceForm.reset();

                    document.getElementById('service-id').value = '';

                    closeModal('service-modal');

                    fetchServices();

                });

        });

        /*
        |--------------------------------------------------------------------------
        | EDIT SERVICE
        |--------------------------------------------------------------------------
        */

        function editService(id) {

            fetch(`${API_URL}/services/${id}`)
                .then(res => res.json())
                .then(res => {

                    const s = res.data;

                    document.getElementById('modal-title').innerText = 'Edit Service';

                    document.getElementById('service-id').value = s.id;

                    document.getElementById('service-name').value = s.name;

                    document.getElementById('service-price').value = s.price;

                    document.getElementById('service-description').value = s.description ?? '';

                    document.getElementById('service-status').value = s.status ? 1 : 0;

                    openModal('service-modal');

                });

        }


        /*
        |--------------------------------------------------------------------------
        | DELETE SERVICE
        |--------------------------------------------------------------------------
        */

        function deleteService(id) {

            const confirmDelete = confirm('Delete this service?');

            if (!confirmDelete) return;

            fetch(`${API_URL}/services/${id}`, {

                method: 'DELETE',

                headers: {
                    'Accept': 'application/json'
                }

            })
                .then(res => res.json())
                .then(data => {

                    if (!data.success) {

                        alert(data.message);

                        return;

                    }

                    fetchServices();

                });

        }

        /*
        |--------------------------------------------------------------------------
        | CLOSE DROPDOWN WHEN CLICK OUTSIDE
        |--------------------------------------------------------------------------
        */

        document.addEventListener('click', function (e) {

            if (!e.target.closest('.relative')) {

                document.querySelectorAll('[id^="dropdown-"]').forEach(dropdown => {

                    dropdown.classList.add('hidden');

                });

            }

        });

        /*
        |--------------------------------------------------------------------------
        | AUTO LOAD
        |--------------------------------------------------------------------------
        */

        document.addEventListener('DOMContentLoaded', () => {

            fetchServices();

        });

    </script>

@endsection