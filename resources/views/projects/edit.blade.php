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
                                <h4>Edit Project</h4>
                            </div>
                            <form method="post" action="{{ route('projects.update', $project->id) }}" enctype="multipart/form-data">
                                @csrf
                                {{ method_field('PUT') }}
                                @include('projects.form') <!-- Include the form for projects -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update Project</button>
                                    <a href="{{ route('projects.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
