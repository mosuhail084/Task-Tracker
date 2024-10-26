@extends('layouts.layout')

@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Edit Role</h4>
                            </div>
                            <form method="post" action="{{ route('roles.update', $role->id) }}" enctype="multipart/form-data">
                                @csrf
                                {{ method_field('PUT') }}
                                @include('roles.form') <!-- Make sure to create a form partial for roles -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update Role</button>
                                    <a href="{{ route('roles.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
