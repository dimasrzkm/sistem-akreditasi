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
        <h2>Evaluations</h2>
        @can('evaluation', \App\Models\User::class)
            <a class="btn btn-primary" href={{ route('prodi.evaluation.create') }} role="button">Add</a>
        @endcan
        <div class="table-responsive">
            <table class="table bg-white p-4 table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">File</th>
                        <th scope="col">Apply At</th>
                        <th scope="col">Assignment At</th>
                        <th scope="col">Act</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($user->getMedia() as $key => $item)
                        <tr>
                            <th scope="row">{{ $key += 1 }}</th>
                            <td>{{ $item->name }}</td>
                            <td>{{ $user->department->apply_at->format('d-F-Y, H:i') }}</td>
                            <td>{{ $user->department->assignment_at->format('d-F-Y, H:i') ?? '-' }}</td>
                            <td>{{ $item->id }}</td>
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
