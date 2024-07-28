<!DOCTYPE html>
<html lang="en">
    @include('layouts.head', ['title' => $title])
    <body>
        @include('layouts.navbar')

        @include('layouts.sidebar', ['side_dash' => ($side_dash ?? ' '), 'side_req' => ($side_req ?? ' '), 'side_log' => ($side_log ?? ' ')])

        @yield('content')

        @include('layouts.footer')

        @include('layouts.script')
    </body>
</html>
