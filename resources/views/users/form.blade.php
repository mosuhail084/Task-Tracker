<div class="card-body">
    <div class="col-6">
        <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" name="name" value="{{ $user->name ?? '' }}" required="">
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" name="email" value="{{ $user->email ?? '' }}" required="">
        </div>
    </div>
    @if (!Route::is('users.edit'))
        <div class="col-6">
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" required="">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" class="form-control" name="password_confirmation" required="">
            </div>
        </div>
    @endif
    <div class="col-6">
        <div class="form-group">
            <label>Role</label>
            <select class="form-control" name="role" required="">
                <option value="">Select Role</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->name }}"
                        {{ isset($user) && $user->hasRole($role->name) ? 'selected' : '' }}>
                        {{ $role->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>
