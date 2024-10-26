@extends('layouts.layout')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>Task Management</h4>
                                <form id="filterForm" method="GET" action="{{ route('tasks.index') }}">
                                    <div class="dropdown d-inline mr-2">
                                        <button class="btn btn-primary dropdown-toggle" type="button" id="userFilterDropdown"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            User
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="userFilterDropdown">
                                            <a class="dropdown-item" href="#" onclick="applyFilter('assigned_to', '')">All Users</a>
                                            @foreach($users as $user)
                                                <a class="dropdown-item" href="#" onclick="applyFilter('assigned_to', {{ $user->id }})">
                                                    {{ $user->name }}
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="dropdown d-inline mr-2">
                                        <button class="btn btn-success dropdown-toggle" type="button" id="projectFilterDropdown"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Project
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="projectFilterDropdown">
                                            <a class="dropdown-item" href="#" onclick="applyFilter('project', '')">All Projects</a>
                                            @foreach($projects as $project)
                                                <a class="dropdown-item" href="#" onclick="applyFilter('project', {{ $project->id }})">
                                                    {{ $project->name }}
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </form>

                                <!-- Create Task Button -->
                                <div class="buttons">
                                    <a href="{{ route('tasks.create') }}" class="btn btn-danger">
                                        <i class="fa fa-plus"></i> Create Task
                                    </a>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-1">
                                        <thead>
                                            <tr class="text-center">
                                                <th>#</th>
                                                <th>Title</th>
                                                <th>Description</th>
                                                <th>Assigned To</th>
                                                <th>Project Name</th>
                                                <th>Status</th>
                                                <th>Due Date</th>
                                                <th>Created At</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($tasks as $task)
                                                <tr class="text-center">
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $task->title }}</td>
                                                    <td>{{ $task->description }}</td>
                                                    <td>{{ $task->assignedTo->name ?? 'N/A' }}</td>
                                                    <td>{{ $task->project->name ?? 'N/A' }}</td>
                                                    <td>{{ ucfirst($task->status) }}</td>
                                                    <td>{{ date('d-m-y', strtotime($task->due_date)) }}</td>
                                                    <td>{{ date('d-m-y', strtotime($task->created_at)) }}</td>
                                                    <td>
                                                        <a class="btn btn-success" href="{{ route('tasks.edit', $task->id) }}">
                                                            <i class="fa fa-edit"></i>
                                                        </a> ||
                                                        <form method="post" action="{{ route('tasks.destroy', $task->id) }}" style="display: inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure to delete this task?')">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        function applyFilter(field, value) {
            const form = document.getElementById('filterForm');
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = field;
            input.value = value;
            form.appendChild(input);
            form.submit();
        }
    </script>
@endsection