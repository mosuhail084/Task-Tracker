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
                                <h4>Role Management</h4>
                                <div class="buttons">
                                    <a href="{{ route('roles.create') }}" class="btn btn-danger">
                                        <i class="fa fa-plus"></i> Create Role
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-1">
                                        <thead>
                                            <tr class="text-center">
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Description</th>
                                                <th>Created At</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($roles as $role)
                                                <tr class="text-center">
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $role->name }}</td>
                                                    <td>{{ $role->description ?? 'N/A' }}</td>
                                                    <td>{{ date('d-m-y', strtotime($role->created_at)) }}</td>
                                                    <td>
                                                        <a class="btn btn-success"
                                                           href="{{ route('roles.edit', $role->id) }}">
                                                            <i class="fa fa-edit"></i>
                                                        </a> ||
                                                        <form method="post" action="{{ route('roles.destroy', $role->id) }}" style="display: inline">
                                                            @csrf
                                                            @method('DELETE') <!-- Ensure this line is correct -->
                                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure to delete this role?')">
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