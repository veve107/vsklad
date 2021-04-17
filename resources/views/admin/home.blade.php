@extends('layouts.admin')

@section('admin_content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="index.html">Starlight</a>
            <span class="breadcrumb-item active">Dashboard</span>
        </nav>

        <div class="sl-pagebody">

            <div class="row row-sm">
                <div class="col-sm-6 col-xl-3">
                    <div class="card pd-20 bg-primary">
                        <div class="d-flex justify-content-between align-items-center mg-b-10">
                            <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Today's Sales</h6>
                        </div><!-- card-header -->
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span>
                            <h3 class="mg-b-0 tx-white tx-lato tx-bold">$850</h3>
                        </div><!-- card-body -->
                        <div class="d-flex align-items-center justify-content-between mg-t-15 bd-t bd-white-2 pd-t-10">
                            <div>
                                <span class="tx-11 tx-white-6">Gross Sales</span>
                                <h6 class="tx-white mg-b-0">$2,210</h6>
                            </div>
                            <div>
                                <span class="tx-11 tx-white-6">Tax Return</span>
                                <h6 class="tx-white mg-b-0">$320</h6>
                            </div>
                        </div><!-- -->
                    </div><!-- card -->
                </div><!-- col-3 -->
                <div class="col-sm-6 col-xl-3 mg-t-20 mg-sm-t-0">
                    <div class="card pd-20 bg-info">
                        <div class="d-flex justify-content-between align-items-center mg-b-10">
                            <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">This Week's Sales</h6>
                        </div><!-- card-header -->
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span>
                            <h3 class="mg-b-0 tx-white tx-lato tx-bold">$4,625</h3>
                        </div><!-- card-body -->
                        <div class="d-flex align-items-center justify-content-between mg-t-15 bd-t bd-white-2 pd-t-10">
                            <div>
                                <span class="tx-11 tx-white-6">Gross Sales</span>
                                <h6 class="tx-white mg-b-0">$2,210</h6>
                            </div>
                            <div>
                                <span class="tx-11 tx-white-6">Tax Return</span>
                                <h6 class="tx-white mg-b-0">$320</h6>
                            </div>
                        </div><!-- -->
                    </div><!-- card -->
                </div><!-- col-3 -->
                <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
                    <div class="card pd-20 pd-sm-25">
                        <h6 class="card-body-title">Pie Chart</h6>
                        <p class="mg-b-20 mg-sm-b-30">Labels can be hidden if the slice is less than a given percentage
                            of the pie.</p>
                        <div id="flotPie2" class="ht-200 ht-sm-250"></div>
                    </div><!-- card -->
                </div><!-- col-3 -->
            </div><!-- row -->

        </div><!-- sl-pagebody -->
    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
@endsection
@push('scripts')
    <script src="{{asset('backend/lib/Flot/jquery.flot.js')}}"></script>
    <script src="{{asset('backend/lib/Flot/jquery.flot.pie.js')}}"></script>
    <script src="{{asset('backend/lib/Flot/jquery.flot.resize.js')}}"></script>
    <script src="{{asset('backend/lib/flot-spline/jquery.flot.spline.js')}}"></script>
    <script>
        $(function () {
            var piedata = [
                {label: "Dostupná technika", data: [[1, {{\App\Models\Hardware\Device::all()->where('status', '=', '1')->count()}}]], color: '#677489'},
                {label: "Vydaná technika", data: [[1, {{\App\Models\Hardware\Device::all()->where('status', '=', '2')->count()}}]], color: '#218bc2'},
            ];

            $.plot('#flotPie2', piedata, {
                series: {
                    pie: {
                        show: true,
                        radius: 1,
                        innerRadius: 0.2,
                        label: {
                            show: true,
                            radius: 2 / 3,
                            formatter: labelFormatter,
                            threshold: 0.1
                        }
                    }
                },
                grid: {
                    hoverable: true,
                    clickable: true
                },
                legend: {show: false}
            });

            function labelFormatter(label, series) {
                return "<div style='font-size:8pt; text-align:center; padding:4px; color:white;'>" + label + "<br/>" + Math.round(series.percent) + "%</div>";
            }
        })
    </script>

@endpush
