@extends('layouts.admin')

@push('styles')
    <link href="{{asset('backend/lib/datatables/jquery.dataTables.css')}}" rel="stylesheet">
    <link href="{{asset('backend/lib/select2/css/select2.min.css')}}" rel="stylesheet">
@endpush

@section('admin_content')

    <div class="sl-mainpanel">
        {{\Diglactic\Breadcrumbs\Breadcrumbs::render('departments')}}
        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Oddelenia</h5>
            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Zoznam oddelení <button class="btn btn-sm btn-warning" id="addDepartment" style="float: right">Pridať nové oddelenie</button>
                </h6>

                <div class="table-wrapper">
                    <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                        <tr>
                            <th class="wd-15p">ID</th>
                            <th class="wd-15p">Názov oddelenia</th>
                            <th class="wd-20p">Akcia</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($departments as $department)
                            <tr>
                                <td>{{$department->id}}</td>
                                <td>{{$department->name}}</td>
                                <td><button class="btn btn-sm btn-info editButton" data-id="{{$department->id}}" data-name="{{$department->name}}">Editovať</button> ||
                                    <a href="{{route('department.delete', $department->id)}}"
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
        })
        $("#addDepartment").click(function () {
            Swal.fire({
                title: 'Pridanie nového oddelenia',
                html:
                    '<form id="createDepartment" method="post" action="{{route('department.store')}}"> {{ csrf_field() }}' +
                    '<input id="name" type="text" name="name" class="swal2-input" placeholder="Názov oddelenia">' +
                    '</form>',
                focusConfirm: false,
                customClass: 'swal2-overflow',
                confirmButtonText: "Pridaj oddelenie",
                preConfirm: () => {
                    return []
                },
            }).then(function (result) {
                if (result.isConfirmed) {
                    $("#createDepartment").submit();
                }
            })
        });

        $(".editButton").click(function () {
            Swal.fire({
                title: 'Upravenie názvu pozície',
                html:
                    '<form id="updateDepartment" method="post" action="{{route('department.update.dummy')}}/' + $(this).attr('data-id') + '"> {{ csrf_field() }}' +
                    '<input id="name" type="text" name="name" class="swal2-input" placeholder="Názov oddelenia" value="' + $(this).attr('data-name') + '" >' +
                    '</form>',
                focusConfirm: false,
                customClass: 'swal2-overflow',
                confirmButtonText: "Uprav názov oddelenia",
                preConfirm: () => {
                    return []
                },
            }).then(function (result) {
                if (result.isConfirmed) {
                    $("#updateDepartment").submit();
                }
            })
        });
    </script>

@endpush
