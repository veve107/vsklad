@extends('layouts.admin')

@push('styles')
    <link href="{{asset('backend/lib/datatables/jquery.dataTables.css')}}" rel="stylesheet">
    <link href="{{asset('backend/lib/select2/css/select2.min.css')}}" rel="stylesheet">
@endpush

@section('admin_content')

    <div class="sl-mainpanel">
        {{\Diglactic\Breadcrumbs\Breadcrumbs::render('brands')}}
        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Značky</h5>
            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Zoznam značiek zariadení
                    <button class="btn btn-sm btn-warning"
                            id="addBrand"
                            style="float: right">Pridať novú značku
                    </button>
                </h6>

                <div class="table-wrapper">
                    <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                        <tr>
                            <th class="wd-15p">ID</th>
                            <th class="wd-15p">Značka</th>
                            <th class="wd-20p">Akcia</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($brands as $brand)
                            <tr>
                                <td>{{$brand->id}}</td>
                                <td>{{$brand->name}}</td>
                                <td>
                                    <button class="btn btn-sm btn-info editButton"
                                            data-id="{{$brand->id}}"
                                            data-name="{{$brand->name}}">Editovať
                                    </button>
                                    ||
                                    <a href="{{route('brand.delete', $brand->id)}}"
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

            $(".editButtosn").click(function () {
                $("#updateForm").attr("action", '{{route('brand.update.dummy')}}/' + $(this).attr("data-id"));
                $("#updateName").val($(this).attr('data-name'));
            })

            $("#addBrand").click(function () {
                Swal.fire({
                    title: 'Pridanie novej značky',
                    html:
                        '<form id="createBrand" method="post" action="{{route('brand.store')}}"> {{ csrf_field() }}' +
                        '<input id="name" type="text" name="name" class="swal2-input" placeholder="Názov značky">' +
                        '</form>',
                    focusConfirm: false,
                    customClass: 'swal2-overflow',
                    confirmButtonText: "Pridaj značku",
                    preConfirm: () => {
                        return []
                    },
                }).then(function (result) {
                    if (result.isConfirmed) {
                        $("#createBrand").submit();
                    }
                })
            });

            $(".editButton").click(function () {
                Swal.fire({
                    title: 'Upravenie názvu značky',
                    html:
                        '<form id="updateBrand" method="post" action="{{route('brand.update.dummy')}}/' + $(this).attr('data-id') + '"> {{ csrf_field() }}' +
                        '<input id="name" type="text" name="name" class="swal2-input" placeholder="Názov značky" value="' + $(this).attr('data-name') + '" >' +
                        '</form>',
                    focusConfirm: false,
                    customClass: 'swal2-overflow',
                    confirmButtonText: "Uprav názov značky",
                    preConfirm: () => {
                        return []
                    },
                }).then(function (result) {
                    if (result.isConfirmed) {
                        $("#updateBrand").submit();
                    }
                })
            });
        })
    </script>

@endpush
