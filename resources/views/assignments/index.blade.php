@push('styles')
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
        <h2>Assignmets</h2>
        @can('assignment', \App\Models\User::class)
            <a class="btn btn-primary" href={{ route('lpppm.assignment.create') }} role="button">Add</a>
        @endcan
        <div class="table-responsive">
            <table class="table bg-white p-4 table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Department</th>
                        <th scope="col">College</th>
                        <th scope="col">Reviewer</th>
                        <th scope="col">Assign By</th>
                        @can('assignment', \App\Models\User::class)
                            <th scope="col">Act</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $key => $user)
                        @foreach ($user->departments as $item)
                            <tr>
                                <th scope="row">{{ $key += 1 }}</th>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->pivot->college }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $item->pivot->assignment_by }}</td>
                                @can('assignment', \App\Models\User::class)
                                    <td>
                                        <div class="btn-group dropup">
                                            <button type="button" class="btn dropdown-toggle-split hidden-arrow"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item"
                                                        href={{ route('lpppm.assignment.edit', [$user, $item->pivot->id]) }}>Edit
                                                    </a>
                                                </li>
                                                <li>
                                                    <form
                                                        action={{ route('lpppm.assignment.destroy', [$user, $item->pivot->id]) }}
                                                        method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="dropdown-item"
                                                            onclick="return confirm('Are you sure?')">Delete</button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                @endcan

                            </tr>
                        @endforeach
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No items</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-container>
</x-app>
