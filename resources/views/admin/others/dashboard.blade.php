@extends('admin.home')

@section('dashboard')
    <div class="row row-sm">
        <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
            <div class="card pd-20 pd-sm-25">
                <h6 class="card-body-title">Dokopy: {{$allDevices}}ks techniky</h6>
                <div id="mainGraphHardware" class="ht-200 ht-sm-250"></div>
            </div><!-- card -->
        </div><!-- col-3 -->
        <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
            <div class="card pd-20 pd-sm-25">
                <h6 class="card-body-title">Zloženie hardvéru v sklade</h6>
                <div id="hardwareCompositionGraph" class="ht-200 ht-sm-250"></div>
            </div><!-- card -->
        </div><!-- col-3 -->
        <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
            <div class="card pd-20 pd-sm-25">
                <h6 class="card-body-title">Zloženie doplnkov v sklade</h6>
                <div id="accessoriesCompositionGraph" class="ht-200 ht-sm-250"></div>
            </div><!-- card -->
        </div><!-- col-3 -->
    </div><!-- row -->
@endsection
@push('scripts')
    <script>
        $(function () {
            var mainPieData = [
                {label: "Dostupná technika", data: [[1, {{$availableDevices}}]], color: '#677489'},
                {label: "Vydaná technika", data: [[1, {{$unavailableDevices}}]], color: '#218bc2'},
            ];
            var hardwareCompositionPieData = [
                @foreach($devicesByTypes as $deviceType)
                    @if(!empty($deviceType[0]) && $deviceType[0]->type->type == 1)
                    {
                        label: '{{$deviceType[0]->type->name}}',
                        data: [[1, {{count($deviceType)}}]],
                        color: '#' + randomColor(),
                    },
                    @endif
                @endforeach
            ];
            var accessoriesCompositionPieData = [
                    @foreach($devicesByTypes as $deviceType)
                    @if(!empty($deviceType[0]) && $deviceType[0]->type->type == 2)
                        {
                            label: '{{$deviceType[0]->type->name}}',
                            data: [[1, {{count($deviceType)}}]],
                            color: '#' + randomColor(),
                        },
                        @endif
                @endforeach
            ];

            $.plot('#mainGraphHardware', mainPieData, {
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
                },
                legend: {show: false}
            });

            $.plot('#hardwareCompositionGraph', hardwareCompositionPieData, {
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
                },
                legend: {show: false}
            });

            $.plot('#accessoriesCompositionGraph', accessoriesCompositionPieData, {
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
                },
                legend: {show: false}
            });

            function labelFormatter(label, series) {
                return "<div style='font-size:8pt; text-align:center; padding:4px; color:white;'>" + label + "<br/>" + Math.round(series.percent) + "%</div>";
            }

            function randomColor() {
                return Math.floor(Math.random() * 16777215).toString(16);
            }
        })
    </script>
@endpush
