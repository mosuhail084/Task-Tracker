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
                                <h4>Edit User</h4>
                            </div>
                            <form method="post" action="{{ route('users.update',$user->id) }}" enctype="multipart/form-data">
                                @csrf
                                {{ method_field('PUT') }}
                                @include('users.form')
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update User</button>
                                    <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection
