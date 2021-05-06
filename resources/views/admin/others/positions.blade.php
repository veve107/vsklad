@extends('layouts.admin')

@push('styles')
    <link href="{{asset('backend/lib/datatables/jquery.dataTables.css')}}" rel="stylesheet">
    <link href="{{asset('backend/lib/select2/css/select2.min.css')}}" rel="stylesheet">
@endpush

@section('admin_content')

    <div class="sl-mainpanel">
        {{\Diglactic\Breadcrumbs\Breadcrumbs::render('positions')}}
        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Pozície</h5>
            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Zoznam pozícii
                    <button class="btn btn-sm btn-warning" id="addPosition" style="float: right">Pridať novú pozíciu</button>
                </h6>

                <div class="table-wrapper">
                    <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                        <tr>
                            <th class="wd-15p">ID</th>
                            <th class="wd-15p">Názov pozície</th>
                            <th class="wd-20p">Akcia</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($positions as $position)
                            <tr>
                                <td>{{$position->id}}</td>
                                <td>{{$position->name}}</td>
                                <td><button class="btn btn-sm btn-info editButton" data-id="{{$position->id}}" data-name="{{$position->name}}">Editovať</button> ||
                                    <a href="{{route('position.delete', $position->id)}}"
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

    <!-- LARGE MODAL -->

    <div id="modaldemo4" class="modal fade">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content tx-size-sm">
                <div class="modal-header pd-x-20">
                    <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Uprav pozíciu</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="" id="updateForm">
                    @csrf
                    <div class="modal-body pd-20">
                        <div class="form-group">
                            <label for="name">Názov pozície</label>
                            <input type="text" class="form-control" id="updateName"
                                   placeholder="Názov pozície" name="name">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info pd-x-20">Upraviť</button>
                        <button type="button" class="btn btn-secondary pd-x-20" data-dismiss="modal">Zavrieť</button>
                    </div>
                </form>
            </div><!-- modal-dialog -->
        </div><!-- modal -->
    </div>

    <div id="modaldemo3" class="modal fade">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content tx-size-sm">
                <div class="modal-header pd-x-20">
                    <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Pridaj pozíciu</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>

                @endif

                <form method="post" action="{{route('position.store')}}">
                    @csrf
                    <div class="modal-body pd-20">
                        <div class="form-group">
                            <label for="name">Názov pozície</label>
                            <input type="text" class="form-control" id="name"
                                   placeholder="Názov pozície" name="name">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info pd-x-20">Pridať</button>
                        <button type="button" class="btn btn-secondary pd-x-20" data-dismiss="modal">Zavrieť</button>
                    </div>
                </form>
            </div><!-- modal-dialog -->
        </div><!-- modal -->
    </div>
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

        $("#addPosition").click(function () {
            Swal.fire({
                title: 'Pridanie novej pozície',
                html:
                    '<form id="createPosition" method="post" action="{{route('position.store')}}"> {{ csrf_field() }}' +
                    '<input id="name" type="text" name="name" class="swal2-input" placeholder="Názov pozície">' +
                    '</form>',
                focusConfirm: false,
                customClass: 'swal2-overflow',
                confirmButtonText: "Pridaj pozíciu",
                preConfirm: () => {
                    return []
                },
            }).then(function (result) {
                if (result.isConfirmed) {
                    $("#createPosition").submit();
                }
            })
        });

        $(".editButton").click(function () {
            Swal.fire({
                title: 'Upravenie názvu pozície',
                html:
                    '<form id="updatePosition" method="post" action="{{route('position.update.dummy')}}/' + $(this).attr('data-id') + '"> {{ csrf_field() }}' +
                    '<input id="name" type="text" name="name" class="swal2-input" placeholder="Názov pozície" value="' + $(this).attr('data-name') + '" >' +
                    '</form>',
                focusConfirm: false,
                customClass: 'swal2-overflow',
                confirmButtonText: "Uprav názov pozície",
                preConfirm: () => {
                    return []
                },
            }).then(function (result) {
                if (result.isConfirmed) {
                    $("#updatePosition").submit();
                }
            })
        });
    </script>

@endpush
