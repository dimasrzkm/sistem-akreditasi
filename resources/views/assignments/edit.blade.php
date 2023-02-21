<x-app>
    <x-container>
        <div class="card">
            <div class="card-header">
                Edit Assignments
            </div>
            <div class="card-body">
                <form action={{ route('lpppm.assignment.update', $user->pivot->id) }} method="post">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="reviewer_before" value="{{ $user->pivot->user_id }}">
                    <div class="mb-3">
                        <label for="assignment_before" class="form-label">Assignment Before</label>
                        <input type="text" class="form-control disable" value="{{ $user->pivot->assignment_by }}"
                            id="assignment_before" name="assignment_before" readonly>
                        @error('assignment_before')
                            <div class="form-text text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="assignment" class="form-label">Assignment Now By</label>
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
                                <option @selected($user->pivot->user_id == $reviewer->id) value={{ $reviewer->id }}>{{ $reviewer->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('reviewer_id')
                            <div class="form-text text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="college_department" class="form-label">College</label>
                        <input type="text" class="form-control disable" value="{{ $user->pivot->college }}"
                            id="college_department" name="college_department" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="departments" class="form-label">Departments</label>
                        <select class="form-select" aria-label="Reviewer" name="department_id" id="departments">
                            <option value="{{ $user->id }}" selected>{{ $user->name }}</option>
                        </select>
                    </div>
                    <div class="flex">
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </x-container>
</x-app>
