@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"
        integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">
    <style>
        .table-responsive .dropdown,
        .table-responsive .btn-group,
        .table-responsive .btn-group-vertical {
            position: static;
        }
    </style>
@endpush
<x-app>
    <x-container>
        <h2>Users</h2>
        @can('create', \App\Models\User::class)
            <a class="btn btn-primary" href={{ route('reviewer.users.create') }} role="button">Add</a>
        @endcan
        <div class="table-responsive">
            <table class="table bg-white p-4 table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Act</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $key=>$user)
                        <tr>
                            <th scope="row">{{ $key += 1 }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role->name }}</td>
                            <td>
                                <div class="btn-group dropup">
                                    <button type="button" class="btn dropdown-toggle-split hidden-arrow"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        {{-- <li><a class="dropdown-item" href="#">Action</a></li> --}}
                                        <li><a class="dropdown-item"
                                                href={{ route('reviewer.users.edit', $user) }}>Edit</a></li>
                                        <li>
                                            <form action={{ route('reviewer.users.destroy', $user) }} method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="dropdown-item"
                                                    onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No items</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-container>
</x-app>
