@extends('layouts.app', ['title' => 'Request Record', 'side_dash' => 'collapsed', 'side_log' => 'collapsed'])

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Request Record</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">Request Record</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session('success')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <section class="section">
            <div class="row">
                <div class="col-lg-3">
                    @include('layouts.form')
                </div>
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Export to .xlsx</h5>

                            <button type="button" class="btn btn-primary" >
                                <a href="{{route('request.export')}}" style="text-decoration: none; color: white">Export</a>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Vehicle</th>
                                        <th>Driver Name</th>
                                        <th data-type="number">Fuel Estimation</th>
                                        <th>Approver 1</th>
                                        <th>Approver 2</th>
                                        <th data-type="date" data-format="YYYY/MM/DD">Start Date</th>
                                        <th data-type="date" data-format="YYYY/MM/DD">End Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $row)
                                        <tr>
                                            <td>{{ $row->id }}</td>
                                            <td>{{ $row->vehicle }}</td>
                                            <td>{{ $row->driver }}</td>
                                            <td>{{ $row->fuel_estimation }}</td>
                                            <td style="text-align: justify">{{ $row->approver1_name }}<br>{{ $row->approver1_status }}</td>
                                            <td style="text-align: justify">{{ $row->approver2_name }}<br>{{ $row->approver2_status }}</td>
                                            <td>{{ $row->start_date }}</td>
                                            <td>{{ $row->end_date }}</td>
                                            <td>{{ $row->request_status }}</td>
                                        </tr>
                                    @endforeach
                                    {{-- <tr>
                                        <td>Manhauler 1</td>
                                        <td>Islah</td>
                                        <td>43.2</td>
                                        <td style="text-align: justify">Aryo<br>Pending</td>
                                        <td style="text-align: justify">Aldin<br>Accept</td>
                                        <td>2005/02/11</td>
                                        <td>2005/02/11</td>
                                        <td>Single Approval</td>
                                    </tr> --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
