@extends('layouts.admin')

@push('styles')
    <link href="{{asset('backend/lib/datatables/jquery.dataTables.css')}}" rel="stylesheet">
    <link href="{{asset('backend/lib/select2/css/select2.min.css')}}" rel="stylesheet">
@endpush

@section('admin_content')

    <div class="sl-mainpanel">
        {{\Diglactic\Breadcrumbs\Breadcrumbs::render('orders')}}
        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Objednávky</h5>
            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Zoznam typov zariadení
                    <button class="btn btn-sm btn-warning" style="float: right" id="addOrder">
                        Pridať novú objednávku
                    </button>
                </h6>

                <div class="table-wrapper">
                    <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                        <tr>
                            <th class="wd-15p">ID</th>
                            <th class="wd-15p">Číslo objednávky</th>
                            <th class="wd-15p">Dátum dodania</th>
                            <th class="wd-15p">Dátum konca záruky</th>
                            <th class="wd-15p">Akcia</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{$order->id}}</td>
                                <td>{{$order->order_number}}</td>
                                <td>{{\Carbon\Carbon::parse($order->delivery_date)->format('d.m.Y')}}</td>
                                <td>{{\Carbon\Carbon::parse($order->end_of_warranty)->format('d.m.Y')}}</td>
                                <td><a href="{{route('order.delete', $order->id)}}"
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
        $("#addOrder").click(function () {
            Swal.fire({
                title: 'Pridanie novej objednávky',
                html:
                    '<form id="createOrder" method="post" action="{{route('order.store')}}"> {{ csrf_field() }}' +
                    '<input id="order_number" type="text" name="order_number" class="swal2-input" placeholder="Číslo objednávky">' +
                    '<input id="delivery_date" name="delivery_date" class="swal2-input fc-datepicker" placeholder="Dátum dodania">' +
                    '<input id="warranty_years" type="text" name="warranty_years" class="swal2-input" placeholder="Počet rokov záruky">' +
                    '</form>',
                focusConfirm: false,
                customClass: 'swal2-overflow',
                confirmButtonText: "Pridaj objednávku",
                preConfirm: () => {
                    return [
                        document.getElementById('order_number').value,
                        document.getElementById('delivery_date').value
                    ]
                },
                onOpen: function () {
                    $('#delivery_date').datepicker({
                        showOtherMonths: true,
                        selectOtherMonths: true
                    });
                },
            }).then(function (result) {
                if (result.isConfirmed) {
                    $("#createOrder").submit()
                }
            })
        });

    </script>

@endpush
