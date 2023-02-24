<div>
    <div class="mb-3">
        <label for="role" class="form-label">Role</label>
        <select class="form-select" aria-label="Role user" name="role_id" id="role" wire:model="selectedRole">
            <option selected>Role User</option>
            @foreach ($roles as $role)
                <option value={{ $role->id }}>{{ $role->name }}</option>
            @endforeach
        </select>
        @error('role_id')
            <div class="form-text text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>

    @if (!is_null($selectedRole) && $selectedRole == 2)
        @livewire('college-facultie-department', ['type' => 'create_user'])
    @endif
</div>
