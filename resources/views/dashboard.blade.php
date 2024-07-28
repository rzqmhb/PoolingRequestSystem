@extends('layouts.app', ['title' => 'Dashboard', 'side_req' => 'collapsed', 'side_log' => 'collapsed'])

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        @if (session('unauthorized'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('unauthorized') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <section class="section">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Requests Status</h5>

                            <!-- Doughnut Chart -->
                            <canvas id="requestChart" style="max-height: 400px;"></canvas>
                            <script>
                                document.addEventListener("DOMContentLoaded", () => {
                                    new Chart(document.querySelector('#requestChart'), {
                                        type: 'doughnut',
                                        data: {
                                            labels: @json(array_column($requests_count, 'status')),
                                            datasets: [{
                                                label: 'Requests Sum',
                                                data: @json(array_column($requests_count, 'sum')),
                                                backgroundColor: [
                                                    'rgb(201, 203, 207)', //grey
                                                    'rgb(54, 162, 235)', //blue
                                                    'rgb(75, 192, 192)', //green
                                                    'rgb(255, 99, 132)', //red
                                                    'rgb(255, 205, 86)', //yellow
                                                ],
                                                hoverOffset: 4
                                            }]
                                        }
                                    });
                                });
                            </script>
                            <!-- End Doughnut CHart -->

                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Vehicle Types</h5>

                            <!-- Doughnut Chart -->
                            <canvas id="vehicleChart" style="max-height: 400px;"></canvas>
                            <script>
                                document.addEventListener("DOMContentLoaded", () => {
                                    new Chart(document.querySelector('#vehicleChart'), {
                                        type: 'doughnut',
                                        data: {
                                            labels: @json(array_column($vehicles_count, 'type')),
                                            datasets: [{
                                                label: 'Vehicles Sum',
                                                data: @json(array_column($vehicles_count, 'sum')),
                                                backgroundColor: [
                                                    'rgb(255, 205, 86)', //yellow
                                                    'rgb(255, 99, 132)', //red
                                                ],
                                                hoverOffset: 4
                                            }]
                                        }
                                    });
                                });
                            </script>
                            <!-- End Doughnut CHart -->

                        </div>
                    </div>
                </div>

                @foreach ($vehicles_data as $id => $vehicle_data)
                @if (count($vehicle_data) > 0)
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $vehicle_data[0]->vehicle }} Fuel Usage Chart</h5>

                                <!-- Line Chart -->
                                <div id="lineChart{{$id}}"></div>

                                <script>
                                    document.addEventListener("DOMContentLoaded", () => {
                                        const chartData{{ $id }} = {
                                            series: [{
                                                name: "Fuel Usage(Liter)",
                                                data: @json(array_column($vehicle_data, 'fuel_estimation'))
                                            }],
                                            chart: {
                                                height: 350,
                                                type: 'line',
                                                zoom: {
                                                    enabled: false
                                                }
                                            },
                                            dataLabels: {
                                                enabled: false
                                            },
                                            stroke: {
                                                curve: 'smooth'
                                            },
                                            grid: {
                                                row: {
                                                    colors: ['#f3f3f3', 'transparent'],
                                                    opacity: 0.5
                                                }
                                            },
                                            xaxis: {
                                                categories: @json(array_column($vehicle_data, 'usage_date'))
                                            }
                                        };

                                        new ApexCharts(document.querySelector("#lineChart{{ $id }}"), chartData{{ $id }}).render();
                                    });
                                </script>
                                <!-- End Line Chart -->

                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
        </section>
    </main>
@endsection
