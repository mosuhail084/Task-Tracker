<div class="card-body">
    <div class="col-6">
        <div class="form-group">
            <label>Project Name</label>
            <input type="text" class="form-control" name="name" value="{{ $project->name ?? '' }}" required>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label>Description</label>
            <textarea class="form-control" name="description" required>{{ $project->description ?? '' }}</textarea>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label>Start Date</label>
            <input type="date" class="form-control" name="start_date" value="{{ $project->start_date ?? '' }}" required>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label>End Date</label>
            <input type="date" class="form-control" name="end_date" value="{{ $project->end_date ?? '' }}">
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label>Status</label>
            <select class="form-control" name="status" required>
                <option value="">Select Status</option>
                <option value="ongoing" {{ isset($project) && $project->status == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                <option value="completed" {{ isset($project) && $project->status == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="pending" {{ isset($project) && $project->status == 'pending' ? 'selected' : '' }}>Pending</option>
            </select>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label>Manager</label>
            <select class="form-control" name="manager_id" required>
                <option value="">Select Manager</option>
                @foreach($managers as $manager)
                    <option value="{{ $manager->id }}" {{ isset($project) && $project->manager_id == $manager->id ? 'selected' : '' }}>
                        {{ $manager->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>