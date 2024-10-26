<div class="card-body">
    <div class="col-6">
        <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" name="name" value="{{ $role->name ?? '' }}" required="">
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label>Description</label>
            <input type="text" class="form-control" name="description" value="{{ $role->description ?? '' }}" required="">
        </div>
    </div>
    
    <div class="col-6">
        <div class="form-group">
            <label>Permissions</label>
            <select class="form-control" name="permissions[]" multiple required="" data-height="100%">
                @foreach ($permissions as $permission)
                    <option value="{{ $permission->name }}"
                        {{ isset($role) && $role->permissions->contains($permission->id) ? 'selected' : '' }}>
                        {{ $permission->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    
</div>