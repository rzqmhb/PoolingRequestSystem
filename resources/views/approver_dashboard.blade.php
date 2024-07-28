<!DOCTYPE html>
<html lang="en">
@include('layouts.head', ['title' => 'Dashboard'])

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <i class="bi bi-list toggle-sidebar-btn"></i>

        <div class="d-flex m-auto align-items-center justify-content-between">
            <a href="{{ route('approver.dashboard') }}" class="logo d-flex align-items-center">
                <img src="{{ asset('../../img/logo.png') }}" alt="">
                <span class="d-none d-lg-block">Nickel Mine</span>
            </a>
        </div><!-- End Logo -->

        <nav class="header-nav">
            <ul class="d-flex align-items-center">
                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                        data-bs-toggle="dropdown">
                        <img src="{{ asset('../img/person.png') }}" alt="Profile" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2">{{ $current_user->user_name }}</span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>{{ $current_user->user_name }}</h6>
                            <span>{{ $current_user->user_role }}</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link" href="{{ route('approver.dashboard') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->
        </ul>

    </aside><!-- End Sidebar-->

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Request Record</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Request Record</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        @if (session('unauthorized'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{session('unauthorized')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <section class="section">
            <div class="row">
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
                                        <th data-type="date" data-format="YYYY/MM/DD">Start Date</th>
                                        <th data-type="date" data-format="YYYY/MM/DD">End Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $row)
                                        <tr>
                                            <td>{{ $row->id }}</td>
                                            <td>{{ $row->vehicle }}</td>
                                            <td>{{ $row->driver }}</td>
                                            <td>{{ $row->fuel_estimation }}</td>
                                            <td>{{ $row->start_date }}</td>
                                            <td>{{ $row->end_date }}</td>
                                            <td>{{ $row->request_status }}</td>
                                            <td>
                                                <form action="{{route('approver.update', [$row->id])}}" method="post">
                                                    @csrf
                                                    <input type="text" name="approver_id" value="{{$current_user->id}}" hidden>
                                                    <input type="text" name="approvers_id" value="{{$row->approvers_id}}" hidden>
                                                    <input type="text" name="decision" value="accepted" id="" hidden>
                                                    <button type="submit" id="accept-{{$row->id}}" class="btn btn-success rounded-pill"
                                                        @if ($row->request_status == 'approved' || $row->request_status == 'declined') disabled @endif
                                                        @if ($row->approver1_status != 'pending' && $row->approver1_id == $current_user->id || $row->approver2_status != 'pending' && $row->approver2_id == $current_user->id) disabled @endif
                                                    >Accept</button>
                                                </form>
                                                <form action="{{route('approver.update', [$row->id])}}" method="post">
                                                    @csrf
                                                    <input type="text" name="approver_id" value="{{$current_user->id}}" hidden>
                                                    <input type="text" name="approvers_id" value="{{$row->approvers_id}}" hidden>
                                                    <input type="text" name="decision" value="declined" id="" hidden>
                                                    <button type="submit" id="decline-{{$row->id}}" class="btn btn-danger rounded-pill"
                                                        @if ($row->request_status == 'approved' || $row->request_status == 'declined') disabled @endif
                                                        @if ($row->approver1_status != 'pending' && $row->approver1_id == $current_user->id || $row->approver2_status != 'pending' && $row->approver2_id == $current_user->id) disabled @endif
                                                    >Decline</button>
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
        </section>
    </main>

    @include('layouts.footer')

    @include('layouts.script')
</body>

</html>
