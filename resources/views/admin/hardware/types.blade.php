@extends('layouts.admin')

@push('styles')
    <link href="{{asset('backend/lib/datatables/jquery.dataTables.css')}}" rel="stylesheet">
    <link href="{{asset('backend/lib/select2/css/select2.min.css')}}" rel="stylesheet">
@endpush

@section('admin_content')

    <div class="sl-mainpanel">
        {{\Diglactic\Breadcrumbs\Breadcrumbs::render('types')}}
        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Typy</h5>
            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Zoznam typov zariadení
                    <button class="btn btn-sm btn-warning" id="addType" style="float: right">Pridať nový typ</button>
                </h6>

                <div class="table-wrapper">
                    <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                        <tr>
                            <th class="wd-15p">ID</th>
                            <th class="wd-15p">Názov</th>
                            <th class="wd-15p">Druh</th>
                            <th class="wd-20p">Akcia</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($types as $type)
                            <tr>
                                <td>{{$type->id}}</td>
                                <td>{{$type->name}}</td>
                                <td>{{$type->type == 1 ? "Hardvér" : "Doplnok"}}</td>
                                <td><button class="btn btn-sm btn-info editButton"
                                       data-id="{{$type->id}}"
                                       data-name="{{$type->name}}">Editovať</button> ||
                                    <a href="{{route('type.delete', $type->id)}}"
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
            $("#addType").click(function () {
                Swal.fire({
                    title: 'Pridanie nového typu techniky',
                    html:
                        '<form id="createType" method="post" action="{{route('type.store')}}"> {{ csrf_field() }}' +
                        '<input id="name" type="text" name="name" class="swal2-input" placeholder="Názov typu">' +
                        '<select id="type" name="type" class="swal2-input" placeholder="Druh"><option value=1>Hardvér</option><option value=2>Doplnky</option></select>' +
                        '</form>',
                    focusConfirm: false,
                    customClass: 'swal2-overflow',
                    confirmButtonText: "Pridaj typ",
                    preConfirm: () => {
                        return []
                    },
                }).then(function (result) {
                    if (result.isConfirmed) {
                        $("#createType").submit();
                    }
                })
            });

            $(".editButton").click(function () {
                Swal.fire({
                    title: 'Upravenie názvu typu',
                    html:
                        '<form id="updateType" method="post" action="{{route('type.update.dummy')}}/' + $(this).attr('data-id') + '"> {{ csrf_field() }}' +
                        '<input id="name" type="text" name="name" class="swal2-input" placeholder="Názov typu" value="' + $(this).attr('data-name') + '" >' +
                        '</form>',
                    focusConfirm: false,
                    customClass: 'swal2-overflow',
                    confirmButtonText: "Uprav názov typu",
                    preConfirm: () => {
                        return []
                    },
                }).then(function (result) {
                    if (result.isConfirmed) {
                        $("#updateType").submit();
                    }
                })
            });
        })
    </script>

@endpush
