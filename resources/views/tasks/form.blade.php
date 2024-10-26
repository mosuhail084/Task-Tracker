<div class="card-body">
    <div class="col-6">
        <div class="form-group">
            <label>Task Title</label>
            <input type="text" class="form-control" name="title" value="{{ $task->title ?? '' }}" required="">
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label>Description</label>
            <textarea class="form-control" name="description" required="">{{ $task->description ?? '' }}</textarea>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label>Assign User</label>
            <select class="form-control" name="assigned_to" required="">
                <option value="">Select User</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" 
                        {{ isset($task) && $task->assigned_to == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label>Select Project</label>
            <select class="form-control" name="project_id" required="">
                <option value="">Select Project</option>
                @foreach ($projects as $project)
                    <option value="{{ $project->id }}" 
                        {{ isset($task) && $task->project_id == $project->id ? 'selected' : '' }}>
                        {{ $project->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label>Status</label>
            <select class="form-control" name="status" required="">
                <option value="pending" {{ (isset($task) && $task->status == 'pending') ? 'selected' : '' }}>Pending</option>
                <option value="ongoing" {{ (isset($task) && $task->status == 'ongoing') ? 'selected' : '' }}>Ongoing</option>
                <option value="completed" {{ (isset($task) && $task->status == 'completed') ? 'selected' : '' }}>Completed</option>
            </select>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label>Due Date</label>
            <input type="date" class="form-control" name="due_date" 
                   value="{{ isset($task) ? $task->due_date: '' }}" required="">
        </div>
    </div>
</div>
