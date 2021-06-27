@extends('layouts.admin')

@section('admin_content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        {{\Diglactic\Breadcrumbs\Breadcrumbs::render('dashboard')}}
        <div class="sl-pagebody">
            @yield('dashboard')
        </div><!-- sl-pagebody -->
    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
@endsection
@push('scripts')
    <script src="{{asset('backend/lib/Flot/jquery.flot.js')}}"></script>
    <script src="{{asset('backend/lib/Flot/jquery.flot.pie.js')}}"></script>
    <script src="{{asset('backend/lib/Flot/jquery.flot.resize.js')}}"></script>
    <script src="{{asset('backend/lib/flot-spline/jquery.flot.spline.js')}}"></script>
@endpush
