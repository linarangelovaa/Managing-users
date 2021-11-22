@extends('layouts.app')

@section('header')

    <a href="#"
        class="btn inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold
                                                                                                                                                                                                                                                                                                                                                                                                             text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none
                                                                                                                                                                                                                                                                                                                                                                                                              focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
        data-toggle="modal" data-target="#exampleModal">New
        User </a>

@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="">
                        <div class="md:px-32 py-8 w-full">
                            <div class="shadow overflow-hidden rounded border-b border-gray-200">
                                <table class="min-w-full bg-white" id="userTable">
                                    <thead class="bg-gray-800 text-white">
                                        <tr>
                                            <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Username
                                            </th>
                                            <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Email</th>
                                            <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Is Active
                                            </th>
                                            <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody class="text-gray-700">
                                        @foreach ($users as $user)
                                            <tr id="id{{ $user->id }}">
                                                <td class="w-1/3 text-left py-3 px-4">{{ $user->username }}</td>
                                                <td class="w-1/3 text-left py-3 px-4">{{ $user->email }}</td>
                                                <td class="w-1/3 text-left py-3 px-4">
                                                    @if ($user->is_active)
                                                        <a href="{{ route('users.deactivate', $user->id) }}"
                                                            class="underline text-sm text-gray-600 hover:text-gray-900">Deactivate</a>
                                                    @else
                                                        <a href="{{ route('users.activate', $user->id) }}"
                                                            class="underline text-sm text-gray-600 hover:text-gray-900">Activate</a>
                                                    @endif
                                                </td>
                                                <td class="w-1/3 text-left py-3 px-4">
                                                    <a href="javascript:void(0)" onclick="deleteUser({{ $user->id }})"
                                                        class="btn btn-danger btn-sm ">Delete</a>
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>



                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add new User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="userForm">
                        @csrf
                        <div class="form-group">
                            <label for="username" class="block font-medium text-sm text-gray-700">Username</label>
                            <input type="text"
                                class="form-control rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                id="username">
                        </div>
                        <div class="form-group">
                            <label for="email" class="block font-medium text-sm text-gray-700">Email</label>
                            <input type="text"
                                class="form-control rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                id="email">
                        </div>
                        <div class="form-group">
                            <label for="password" class="block font-medium text-sm text-gray-700">Password</label>
                            <input type="password"
                                class="form-control rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                id="password">
                        </div>
                        <button type="submit"
                            class="btn inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Submit</button>


                    </form>
                </div>

            </div>
        </div>
    </div>




@endsection
@section('scripts')
    <script>
        $("#userForm").submit(function(e) {
            e.preventDefault();

            let username = $("#username").val();
            let email = $("#email").val();
            let password = $("#password").val();
            let _token = $("input[name=_token]").val();

            $.ajax({
                url: "{{ route('users.store') }}",
                type: "POST",
                data: {
                    username: username,
                    email: email,
                    password: password,
                    _token: _token

                },
                success: function(response) {
                    if (response) {
                        $("#userTable tbody").prepend('<tr><td class="w-1/3 text-left py-3 px-4">' +
                            response.username + '</td><td class="w-1/3 text-left py-3 px-4">' +
                            response.email + '</td></tr>')
                        $("#userForm")[0].reset();
                        $('#exampleModal').modal('hide');

                    }
                }
            });

        });
    </script>
    <script>
        function deleteUser(id) {

            if (confirm("Do you realy want to delete this user?")) {
                $.ajax({
                    url: '/users/' + id,
                    type: 'DELETE',
                    data: {
                        _token: $("input[name=_token").val()
                    },
                    success: function(response) {
                        $("#id" + id).remove();
                    }
                });

            }

        }
    </script>


@endsection
