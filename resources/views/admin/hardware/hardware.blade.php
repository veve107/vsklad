@extends('layouts.admin')
@push('styles')
    <link rel="stylesheet" href="{{asset('backend/css/profile.css')}}">
    <link href="{{asset('backend/lib/datatables/jquery.dataTables.css')}}" rel="stylesheet">
    <link href="{{asset('backend/lib/select2/css/select2.min.css')}}" rel="stylesheet">
@endpush

@section('admin_content')

    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="index.html">Starlight</a>
            <a class="breadcrumb-item" href="index.html">Tables</a>
            <span class="breadcrumb-item active">Pozície</span>
        </nav>

        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Zariadenia</h5>
            </div><!-- sl-page-title -->
            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Zoznam zariadení <a href="{{route('hardware.add')}}"
                                                                class="btn btn-sm btn-warning"
                                                                style="float: right">Pridať nové zariadenie</a>
                </h6>
                <div class="row">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home"
                               role="tab" aria-controls="home" aria-selected="true">Dostupné zariadenia</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#devices"
                               role="tab" aria-controls="profile" aria-selected="false">Nedostupné zariadenia</a>
                        </li>
                    </ul>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel"
                                 aria-labelledby="home-tab">
                                <div class="tab-content" style="margin-top:2%">
                                    <div class="table-wrapper">
                                        <table id="datatable1" class="table display responsive nowrap" style="width: 100% !important;">
                                            <thead>
                                            <tr>
                                                <th class="wd-5p">ID</th>
                                                <th class="wd-10p">Značka</th>
                                                <th class="wd-10p">Názov zariadenia</th>
                                                <th class="wd-10p">Typ zariadenia</th>
                                                <th class="wd-10p">Číslo objednávky</th>
                                                <th class="wd-10p">Sériové číslo</th>
                                                <th class="wd-10p">Inventárne číslo</th>
                                                <th class="wd-10p">Záruka do</th>
                                                <th class="wd-20p">Akcia</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($devices_available as $device)
                                                <tr>
                                                    <td>{{$device->id}}</td>
                                                    <td>{{$device->brand->name}}</td>
                                                    <td>{{$device->name}}</td>
                                                    <td>{{$device->type->name}}</td>
                                                    <td>{{$device->order->order_number}}</td>
                                                    <td>{{$device->serial_number}}</td>
                                                    <td>{{$device->inventory_number}}</td>
                                                    <td>{{$device->order->end_of_warranty}}</td>
                                                    <td><a href="{{url('edit/position/'.$device->id)}}"
                                                           class="btn btn-sm btn-info">Editovať</a> ||
                                                        <a href="{{url('delete/position/'.$device->id)}}"
                                                           class="btn btn-sm btn-danger"
                                                           id="delete">Zmazať</a></td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div><!-- table-wrapper -->
                                </div>
                            </div>
                            <div class="tab-pane fade" id="devices" role="tabpanel"
                                 aria-labelledby="devices-tab">
                                <div class="tab-content" style="margin-top:2%">
                                    <div class="table-wrapper">
                                        <table id="datatable2" class="table display responsive nowrap" style="width: 100% !important;">
                                            <thead>
                                            <tr>
                                                <th class="wd-5p">ID</th>
                                                <th class="wd-10p">Značka</th>
                                                <th class="wd-10p">Názov zariadenia</th>
                                                <th class="wd-10p">Typ zariadenia</th>
                                                <th class="wd-10p">Číslo objednávky</th>
                                                <th class="wd-10p">Sériové číslo</th>
                                                <th class="wd-10p">Inventárne číslo</th>
                                                <th class="wd-10p">Záruka do</th>
                                                <th class="wd-10p">Používateľ</th>
                                                <th class="wd-20p">Akcia</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($devices_unavailable as $device)
                                                <tr>
                                                    <td>{{$device->id}}</td>
                                                    <td>{{$device->brand->name}}</td>
                                                    <td>{{$device->name}}</td>
                                                    <td>{{$device->type->name}}</td>
                                                    <td>{{$device->order->order_number}}</td>
                                                    <td>{{$device->serial_number}}</td>
                                                    <td>{{$device->inventory_number}}</td>
                                                    <td>{{$device->order->end_of_warranty}}</td>
                                                    <td>{{$device->requests[0]->user->name}}</td>
                                                    <td><a href="{{url('edit/position/'.$device->id)}}"
                                                           class="btn btn-sm btn-info">Editovať</a> ||
                                                        <a href="{{url('delete/position/'.$device->id)}}"
                                                           class="btn btn-sm btn-danger"
                                                           id="delete">Zmazať</a></td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div><!-- table-wrapper -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- card -->
        </div>
    </div><!-- sl-mainpanel -->
@endsection
@push('scripts')
    <script>
        $(function () {
            $('#datatable1').DataTable({
                responsive: true,
                language: {
                    url: '{{asset('backend/lib/datatables/Slovak.json')}}'
                }
            });
            $('#datatable2').DataTable({
                responsive: true,
                language: {
                    url: '{{asset('backend/lib/datatables/Slovak.json')}}'
                }
            });
            // Select2
            $('.dataTables_length select').select2({minimumResultsForSearch: Infinity});
        })
    </script>

@endpush
