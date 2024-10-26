@extends('layouts.layout')
@section('title', 'Dashboard')
@section('content')

    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="row ">
                <div class="col-xl-3 col-lg-6">
                    <div class="card l-bg-green-dark">
                        <div class="card-statistic-3">
                            <div class="card-icon card-icon-large"><i class="fa fa-folder-open"></i></div>
                            <div class="card-content">
                                <h4 class="card-title">Total Projects</h4>
                                <span>{{ $data['totalProjects'] }}</span>
                                <div class="progress mt-1 mb-1" data-height="8">
                                    <div class="progress-bar l-bg-purple" role="progressbar" data-width="25%"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <p class="mb-0 text-sm">
                                    <span class="mr-2"><i class="fa fa-arrow-up"></i> 10%</span>
                                    <span class="text-nowrap">Since last month</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card l-bg-cyan-dark">
                        <div class="card-statistic-3">
                            <div class="card-icon card-icon-large"><i class="fa fa-tasks"></i></div>
                            <div class="card-content">
                                <h4 class="card-title">Total Tasks</h4>
                                <span>{{ $data['totalTasks'] }}</span>
                                <div class="progress mt-1 mb-1" data-height="8">
                                    <div class="progress-bar l-bg-orange" role="progressbar" data-width="25%"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <p class="mb-0 text-sm">
                                    <span class="mr-2"><i class="fa fa-arrow-up"></i> 10%</span>
                                    <span class="text-nowrap">Since last month</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card l-bg-purple-dark">
                        <div class="card-statistic-3">
                            <div class="card-icon card-icon-large"><i class="fa fa-hourglass-half"></i></div>
                            <div class="card-content">
                                <h4 class="card-title">Task Ongoing</h4>
                                <span>{{ $data['tasksOngoing'] }}</span>
                                <div class="progress mt-1 mb-1" data-height="8">
                                    <div class="progress-bar l-bg-cyan" role="progressbar" data-width="25%"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <p class="mb-0 text-sm">
                                    <span class="mr-2"><i class="fa fa-arrow-up"></i> 10%</span>
                                    <span class="text-nowrap">Since last month</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card l-bg-orange-dark">
                        <div class="card-statistic-3">
                            <div class="card-icon card-icon-large"><i class="fa fa-check-circle"></i></div>
                            <div class="card-content">
                                <h4 class="card-title">Completed Tasks</h4>
                                <span>{{ $data['completedTasks'] }}</span>
                                <div class="progress mt-1 mb-1" data-height="8">
                                    <div class="progress-bar l-bg-green" role="progressbar" data-width="25%"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <p class="mb-0 text-sm">
                                    <span class="mr-2"><i class="fa fa-arrow-up"></i> 10%</span>
                                    <span class="text-nowrap">Since last month</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- TODO:: charts/visuals to show task status report --}}
            {{-- TODO:: charts/visuals to show spilled over task --}}
            {{-- <div class="row">
                <div class="col-lg-6 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="chart-title">
                                <p class="mb-3 text-muted pull-left text-sm">
                                    <span class="text-success mr-2 font-20"><i class="fa fa-arrow-up"></i>
                                        10%</span> <span class="text-nowrap">Since
                                        last month</span>
                                </p>
                            </div>
                            <canvas id="chart-1"></canvas>
                            <div class="row text-center">
                                <div class="col-4 m-t-15">
                                    <h5>91%</h5>
                                    <p class="text-muted m-b-0">Online</p>
                                </div>
                                <div class="col-4 m-t-15">
                                    <h5>8%</h5>
                                    <p class="text-muted m-b-0">Offline</p>
                                </div>
                                <div class="col-4 m-t-15">
                                    <h5>1%</h5>
                                    <p class="text-muted m-b-0">NA</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Pie Chart</h4>
                        </div>
                        <div class="card-body">
                            <div id="echart_pie" class="chartsh"></div>
                        </div>
                    </div>
                </div>
            </div> --}}

        </section>
    </div>
@endsection
