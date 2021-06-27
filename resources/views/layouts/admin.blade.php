<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Virtuálny sklad</title>

    <!-- vendor css -->
    <link href="{{asset('backend/lib/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('backend/lib/Ionicons/css/ionicons.css')}}" rel="stylesheet">
    <link href="{{asset('backend/lib/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet">
    <link href="{{asset('backend/lib/toastr.js/toastr.min.css')}}" rel="stylesheet">
    <link href="{{asset('backend/lib/highlightjs/github.css')}}" rel="stylesheet">
@stack('styles')

<!-- Starlight CSS -->
    <link rel="stylesheet" href="{{asset('backend/css/starlight.css')}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>

<body>

@guest

@else
    <!-- ########## START: LEFT PANEL ########## -->
    @include('layouts.navbar')
    <!-- ########## END: LEFT PANEL ########## -->

    <!-- ########## START: HEAD PANEL ########## -->
    @include('layouts.headpanel')
    <!-- ########## END: HEAD PANEL ########## -->
@endguest

@yield('admin_content')

<script src="{{asset('backend/lib/jquery/jquery.js')}}"></script>
<script src="{{asset('backend/lib/popper.js/popper.js')}}"></script>
<script src="{{asset('backend/lib/bootstrap/bootstrap.js')}}"></script>
<script src="{{asset('backend/lib/jquery-ui/jquery-ui.js')}}"></script>
<script src="{{asset('backend/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js')}}"></script>

<script src="{{asset('backend/lib/highlightjs/highlight.pack.js')}}"></script>
<script src="{{asset('backend/lib/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('backend/lib/datatables-responsive/dataTables.responsive.js')}}"></script>
<script src="{{asset('backend/lib/select2/js/select2.min.js')}}"></script>


@stack('scripts')

<script src="{{asset('backend/lib/jquery.sparkline.bower/jquery.sparkline.min.js')}}"></script>
<script src="{{asset('backend/lib/d3/d3.js')}}"></script>
<script src="{{asset('backend/lib/rickshaw/rickshaw.min.js')}}"></script>
<script src="{{asset('backend/lib/chart.js/Chart.js')}}"></script>
<script src="{{asset('backend/lib/toastr.js/toastr.min.js')}}"></script>

<script src="{{asset('backend/js/starlight.js')}}"></script>
<script src="{{asset('backend/js/ResizeSensor.js')}}"></script>
<script src="{{asset('backend/js/dashboard.js')}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    @if(Session::has('message'))
    var type = "{{Session::get('alert-type','info')}}"
    switch (type) {
        case 'info':
            toastr.info("{{ Session::get('message') }}");
            break;
        case 'success':
            toastr.success("{{ Session::get('message') }}");
            break;
        case 'warning':
            toastr.warning("{{ Session::get('message') }}");
            break;
        case 'error':
            toastr.error("{{ Session::get('message') }}");
            break;
    }
    @endif
</script>
<script>
    $(document).on("click", "#delete", function (e) {
        e.preventDefault();
        var link = $(this).attr("href");
        Swal.fire({
            title: "Naozaj chcete vymazať?",
            text: "Pokiaľ kliknete na áno, požiadavka na zmazanie bude nevratná!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            cancelButtonText: "Zrušiť",
            confirmButtonText: 'Zmazať',
        })
            .then((result) => {
                if (result.isConfirmed) {
                    window.location.href = link;
                }
            });
    });
</script>
</body>
</html>
