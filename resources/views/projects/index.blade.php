@extends('layouts.layout')

@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>Project Management</h4>
                                <div class="buttons">
                                    <a href="{{ route('projects.create') }}" class="btn btn-danger">
                                        <i class="fa fa-plus"></i> Create Project
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-1">
                                        <thead>
                                            <tr class="text-center">
                                                <th>#</th>
                                                <th>Project Name</th>
                                                <th>Description</th>
                                                <th>Created At</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($projects as $project)
                                                <tr class="text-center">
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $project->name }}</td>
                                                    <td>{{ $project->description }}</td>
                                                    <td>{{ date('d-m-y', strtotime($project->created_at)) }}</td>
                                                    <td>
                                                        <a class="btn btn-success"
                                                            href="{{ route('projects.edit', $project->id) }}">
                                                            <i class="fa fa-edit"></i>
                                                        </a> ||
                                                        <form method="post" action="{{ route('projects.destroy', $project->id) }}" style="display: inline">
                                                            @csrf
                                                            @method('DELETE') <!-- Ensure this line is correct -->
                                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure to delete this project?')">
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
@endsection