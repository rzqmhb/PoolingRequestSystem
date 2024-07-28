@extends('layouts.app', ['title' => 'Activity Logs', 'side_dash' => 'collapsed', 'side_req' => 'collapsed'])

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Activity Logs</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">Activity Logs</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th data-type="datetime" data-format="YYYY/MM/DD hh:mm:ss">Time</th>
                                        <th>Activity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($logs as $log)
                                    <tr>
                                        <td>{{$log->user}}</td>
                                        <td>{{$log->activity_time}}</td>
                                        <td>{{$log->activity}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
