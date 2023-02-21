<x-app>
    <x-container>
        <div class="card">
            <div class="card-header">
                Assignments
            </div>
            <div class="card-body">
                <form action={{ route('lpppm.assignment.store') }} method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="assignment" class="form-label">Assignment By</label>
                        <input type="text" class="form-control disable" value="{{ auth()->user()->name }}"
                            id="assignment" name="assignment_by" readonly>
                        @error('assignment')
                            <div class="form-text text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="reviewer" class="form-label">Reviewers</label>
                        <select class="form-select" aria-label="Reviewer" name="reviewer_id" id="reviewer">
                            <option selected>Choose Reviewer</option>
                            @foreach ($reviewers as $reviewer)
                                <option value={{ $reviewer->id }}>{{ $reviewer->name }}</option>
                            @endforeach
                        </select>
                        @error('reviewer_id')
                            <div class="form-text text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    @livewire('college-facultie-department', ['type' => 'assignments'])
                    <div class="flex">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </x-container>
</x-app>
