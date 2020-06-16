@extends('layouts.admin')

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
                <h6 class="card-body-title">Zoznam zariadení <a href="{{route('add.hardware')}}"
                                                                class="btn btn-sm btn-warning"
                                                                style="float: right">Pridať nové zariadenie</a>
                </h6>

                <div class="table-wrapper">
                    <table id="datatable1" class="table display responsive nowrap">
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
                        @foreach($devices as $device)
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
            </div><!-- card -->
        </div>
    </div><!-- sl-mainpanel -->
@endsection
