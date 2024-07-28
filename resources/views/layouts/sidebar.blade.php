 <!-- ======= Sidebar ======= -->
 <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link {{$side_dash ?? ' '}}" href="{{route('dashboard')}}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link {{$side_req ?? ' '}}" href="{{route('requests')}}">
                <i class="bi bi-journal-text"></i><span>Request Record</span>
            </a>
        </li><!-- End Forms Nav -->

        <li class="nav-item">
            <a class="nav-link {{$side_log ?? ' '}}" href="{{route('log')}}">
                <i class="bi bi-layout-text-window-reverse"></i><span>Logs</span>
            </a>
        </li><!-- End Tables Nav -->

    </ul>

</aside><!-- End Sidebar-->
