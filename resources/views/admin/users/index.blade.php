@extends('admin.layouts.app')

@section('content')
    <div class="p-6 space-y-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">

            <form method="GET" class="flex items-center gap-2 w-full md:w-1/2">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search by name or email..."
                    class="w-full px-4 py-2 rounded-lg border
                       bg-white dark:bg-slate-800
                       border-gray-300 dark:border-slate-700
                       text-gray-800 dark:text-gray-200
                       focus:ring-2 focus:ring-blue-500 outline-none transition"
                >

                <button
                    class="px-5 py-2 rounded-lg bg-blue-600 hover:bg-blue-700
                       text-white transition font-medium">
                    Search
                </button>

            </form>

            {{-- CREATE --}}
            <button
                type="button"
                onclick="openCreateModal()"
                class="px-5 py-2 rounded-lg bg-emerald-600 hover:bg-emerald-700
                   text-white font-medium transition shadow-md">

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
                                type="button"
                                onclick='editUser(@json($user))'
                                class="text-blue-500 hover:text-blue-600 transition font-medium">

                                Edit

                            </button>

                            <button
                                type="button"
                                onclick="deleteUser({{ $user->id }})"
                                class="text-red-500 hover:text-red-600 transition font-medium">

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

                <h2
                    id="modalTitle"
                    class="text-lg font-bold text-gray-800 dark:text-white">

                    User Form

                </h2>

                <button
                    type="button"
                    onclick="closeModal()"
                    class="text-gray-500 hover:text-red-500 text-xl">

                    ✕

                </button>

            </div>

            <form
                id="userForm"
                method="POST"
                action="{{ route('users.store') }}">

                @csrf

                @method('POST')

                <div id="methodContainer"></div>

                <input
                    type="hidden"
                    id="userId">

                <div class="space-y-4">

                    <input
                        id="name"
                        name="name"
                        placeholder="Name"
                        class="w-full px-4 py-2 rounded-lg border
                           bg-white dark:bg-slate-800
                           border-gray-300 dark:border-slate-700
                           text-gray-800 dark:text-gray-200">

                    <input
                        id="email"
                        name="email"
                        placeholder="Email"
                        class="w-full px-4 py-2 rounded-lg border
                           bg-white dark:bg-slate-800
                           border-gray-300 dark:border-slate-700
                           text-gray-800 dark:text-gray-200">

                    <input
                        id="password"
                        name="password"
                        type="password"
                        placeholder="Password (only for create)"
                        class="w-full px-4 py-2 rounded-lg border
                           bg-white dark:bg-slate-800
                           border-gray-300 dark:border-slate-700
                           text-gray-800 dark:text-gray-200">

                </div>

                <button
                    type="submit"
                    class="w-full mt-5 bg-blue-600 hover:bg-blue-700
                       text-white py-2 rounded-lg transition">

                    Save

                </button>

            </form>

        </div>

    </div>

@endsection
@section('script')
    <script>

        const modal = document.getElementById('userModal');
        const form = document.getElementById('userForm');
        const methodContainer = document.getElementById('methodContainer');

        function openModal() {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeModal() {
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }

        function openCreateModal() {

            document.getElementById('modalTitle').innerText = 'Create User';

            form.reset();

            form.action = "{{ route('users.store') }}";

            methodContainer.innerHTML = '';

            document.getElementById('password').style.display = 'block';

            openModal();
        }

        function editUser(user) {

            document.getElementById('modalTitle').innerText = 'Edit User';

            document.getElementById('name').value = user.name;
            document.getElementById('email').value = user.email;
            document.getElementById('password').value = '';

            document.getElementById('password').style.display = 'none';

            form.action = `/admin/pages/users/${user.id}`;

            methodContainer.innerHTML =
                '<input type="hidden" name="_method" value="PUT">';

            openModal();
        }

        function deleteUser(id) {

            if (!confirm('Delete this user?')) {
                return;
            }

            fetch(`/admin/pages/users/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
                .then(res => {
                    if (!res.ok) {
                        throw new Error('Delete failed');
                    }

                    location.reload();
                })
                .catch(err => {
                    console.error(err);
                    alert('Delete failed.');
                });

        }

        modal.addEventListener('click', function (e) {

            if (e.target === modal) {
                closeModal();
            }

        });

    </script>
@endsection
