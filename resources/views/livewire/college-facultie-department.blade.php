<div>
    <div class="mb-3">
        <label for="colleges" class="form-label">Colleges</label>
        <select wire:model.debounce.500ms="selectedCollege" class="form-select" aria-label="Colleges"
            @if ($typeDropdowns == 'assignments') name="college_id" @endif id="colleges">
            <option selected>Choose Colleges</option>
            @foreach ($colleges as $collage)
                <option value={{ $collage->id }}>{{ $collage->name }}</option>
            @endforeach
        </select>
    </div>

    @if (!is_null($selectedCollege))
        <div class="mb-3">
            <label for="faculties" class="form-label">Faculties</label>
            <select wire:model.debounce.500ms="selecteFacultie" class="form-select" aria-label="Faculties"
                id="faculties">
                <option selected>Choose Faculties</option>
                @foreach ($faculties as $facultie)
                    <option value={{ $facultie->id }}>{{ $facultie->name }}</option>
                @endforeach
            </select>
        </div>
    @endif

    @if (!is_null($selecteFacultie))
        <div class="mb-3">
            <label for="departments" class="form-label">Departments</label>
            <select class="form-select" aria-label="Departments" name="department_id" id="departments">
                <option selected>Choose Departments</option>
                @foreach ($departments as $department)
                    <option value={{ $department->id }}>{{ $department->name }}</option>
                @endforeach
            </select>
        </div>
    @endif

</div>
