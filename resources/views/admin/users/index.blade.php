@extends('admin.layouts.app')

@section('header')
    @include('admin.layouts.navbar')
@endsection

@section('content')
    <div class="p-6 space-y-6">

        @include('admin.layouts.sidebar')

        {{-- HEADER --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">

            {{-- SEARCH --}}
            <form method="GET"
                  class="flex items-center gap-2 w-full md:w-1/2">

                <input
                    type="text"
                    name="search"
                    placeholder="Search by name or email..."
                    class="w-full px-4 py-2 rounded-lg border
                       bg-white dark:bg-slate-800
                       border-gray-300 dark:border-slate-700
                       text-gray-800 dark:text-gray-200
                       focus:ring-2 focus:ring-blue-500 outline-none transition"
                >

                <button
                    class="px-5 py-2 rounded-lg bg-blue-600 hover:bg-blue-700
                       text-white transition font-medium"
                >
                    Search
                </button>
            </form>

            {{-- CREATE --}}
            <button
                onclick="openCreateModal()"
                class="px-5 py-2 rounded-lg bg-emerald-600 hover:bg-emerald-700
                   text-white font-medium transition shadow-md"
            >
                + New User
            </button>

        </div>

        {{-- TABLE --}}
        <div class="rounded-xl overflow-hidden border
                border-gray-200 dark:border-slate-700
                bg-white dark:bg-slate-900 shadow">

            <table class="w-full text-sm">

                <thead class="bg-gray-100 dark:bg-slate-800 text-gray-700 dark:text-gray-300">
                <tr>
                    <th class="p-4 text-left">ID</th>
                    <th class="text-right">Name</th>
                    <th class="text-right">Email</th>
                    <th class="text-right p-4">Actions</th>
                </tr>
                </thead>

                <tbody class="divide-y divide-gray-200 dark:divide-slate-700">

                @foreach($users as $user)
                    <tr class="hover:bg-gray-50 dark:hover:bg-slate-800 transition">

                        <td class="p-4 text-gray-700 dark:text-gray-300">
                            #{{ $user->id }}
                        </td>

                        <td class="font-medium text-gray-900 dark:text-gray-100 text-right">
                            {{ $user->name }}
                        </td>

                        <td class="text-gray-600 dark:text-gray-400 text-right">
                            {{ $user->email }}
                        </td>

                        <td class="p-4 flex justify-end gap-3">

                            <button
                                onclick='editUser(@json($user))'
                                class="text-blue-500 hover:text-blue-600 transition font-medium"
                            >
                                Edit
                            </button>

                            <button
                                onclick="deleteUser({{ $user->id }})"
                                class="text-red-500 hover:text-red-600 transition font-medium"
                            >
                                Delete
                            </button>

                        </td>

                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>

        <div class="dark:text-gray-300">
            {{ $users->links() }}
        </div>

    </div>

    {{-- MODAL --}}
    <div id="userModal"
         class="fixed inset-0 hidden items-center justify-center
            bg-black/50 backdrop-blur-sm z-50">

        <div class="w-full max-w-md bg-white dark:bg-slate-900 rounded-xl shadow-xl p-6">

            <div class="flex justify-between items-center mb-4">
                <h2 id="modalTitle" class="text-lg font-bold text-gray-800 dark:text-white">
                    User Form
                </h2>

                <button onclick="closeModal()"
                        class="text-gray-500 hover:text-red-500 text-xl">
                    ✕
                </button>
            </div>

            <form id="userForm" method="POST">

                @csrf

                <input type="hidden" name="id" id="userId">

                <div class="space-y-4">

                    <input
                        id="name"
                        name="name"
                        placeholder="Name"
                        class="w-full px-4 py-2 rounded-lg border
                           bg-white dark:bg-slate-800
                           border-gray-300 dark:border-slate-700
                           text-gray-800 dark:text-gray-200"
                    >

                    <input
                        id="email"
                        name="email"
                        placeholder="Email"
                        class="w-full px-4 py-2 rounded-lg border
                           bg-white dark:bg-slate-800
                           border-gray-300 dark:border-slate-700
                           text-gray-800 dark:text-gray-200"
                    >

                    <input
                        id="password"
                        name="password"
                        type="password"
                        placeholder="Password (only for create)"
                        class="w-full px-4 py-2 rounded-lg border
                           bg-white dark:bg-slate-800
                           border-gray-300 dark:border-slate-700
                           text-gray-800 dark:text-gray-200"
                    >

                </div>

                <button
                    type="submit"
                    class="w-full mt-5 bg-blue-600 hover:bg-blue-700
                       text-white py-2 rounded-lg transition"
                >
                    Save
                </button>

            </form>

        </div>
    </div>

@endsection
@section('script')
    <script>

        const modal = document.getElementById('userModal');

        function openModal() {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeModal() {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function openCreateModal() {
            document.getElementById('modalTitle').innerText = "Create User";
            document.getElementById('userForm').reset();
            document.getElementById('userId').value = '';
            openModal();
        }

        function editUser(user) {
            document.getElementById('modalTitle').innerText = "Edit User";

            document.getElementById('userId').value = user.id;
            document.getElementById('name').value = user.name;
            document.getElementById('email').value = user.email;

            openModal();
        }

        function deleteUser(id) {
            if (!confirm('Delete this user?')) return;

            fetch(`/admin/users/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }).then(() => location.reload());
        }

        // close modal on outside click
        modal.addEventListener('click', (e) => {
            if (e.target === modal) closeModal();
        });

    </script>
@endsection
