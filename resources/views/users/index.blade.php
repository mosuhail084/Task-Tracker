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
                                <h4>User Management</h4>
                                <div class="buttons">
                                    <a href="{{ route('users.create') }}" class="btn btn-danger">
                                        <i class="fa fa-plus"></i> Create User
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
                                                <th>Email</th>
                                                <th>Created At</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $user)
                                                <tr class="text-center">
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ date('d-m-y', strtotime($user->created_at)) }}</td>
                                                    <td>
                                                        <a class="btn btn-success"
                                                            href="{{ route('users.edit', $user->id) }}">
                                                            <i class="fa fa-edit"></i>
                                                        </a> ||
                                                        <form method="post" action="{{ route('users.destroy', $user->id) }}" style="display: inline">
                                                            @csrf
                                                            @method('DELETE') <!-- Ensure this line is correct -->
                                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure to delete this user?')">
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
