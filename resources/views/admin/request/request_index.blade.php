@extends('layouts.admin')
@push('styles')
    <link href="{{asset('backend/lib/datatables/jquery.dataTables.css')}}" rel="stylesheet">
@endpush
@section('admin_content')

    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="index.html">Starlight</a>
            <a class="breadcrumb-item" href="index.html">Tables</a>
            <span class="breadcrumb-item active">Používatelia</span>
        </nav>

        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Žiadosti</h5>
            </div><!-- sl-page-title -->
            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Zoznam žiadostí</h6>

                <div class="table-wrapper">
                    <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                        <tr>
                            <th class="wd-15p">ID</th>
                            <th class="wd-15p">Typ</th>
                            <th class="wd-15p">Meno používateľa</th>
                            <th class="wd-15p">Oddelenie</th>
                            <th class="wd-20p">Akcia</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($requests as $request)
                            <tr>
                                <td>{{$request->id}}</td>
                                <td>
                                    @foreach($request->types as $type)
                                        @if($type == $request->types->last())
                                            {{$type->name}}
                                        @else
                                            {{$type->name}},
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{$request->user->name}}</td>
                                @if($request->user->department == null)
                                    <td>Nenastavené</td>
                                @else
                                    <td>{{$request->user->department->name}}</td>
                                @endif

                                <td>
                                    <div class="btn-group" role="group">
                                        @if($request->state_id == 1)
                                            <a href="{{route('request.process', $request->id)}}"
                                               class="btn btn-sm btn-success pd-x-25">Spracovať</a>

                                            <a href="{{route('request.edit', $request->id)}}"
                                               class="btn btn-sm btn-info pd-x-25">Editovať</a>

                                            <a href="{{route('request.delete', $request->id)}}"
                                               class="btn btn-sm btn-danger pd-x-25"
                                               id="delete">Zmazať</a>
                                        @elseif($request->state_id == 2)
                                            <a href="{{route('request.sendMail', $request->id)}}"
                                               class="btn btn-sm btn-primary pd-x-25">Odoslať mail</a>
                                        @elseif($request->state_id == 3)
                                            <a href="{{route('request.sendMail', $request->id)}}"
                                               class="btn btn-sm btn-warning pd-x-25">Čaká na potvrdenie</a>
                                        @else
                                            <a href="{{route('request.process', $request->id)}}"
                                               class="btn btn-sm btn-secondary pd-x-25">Ukončené</a>
                                        @endif

                                        <a href="{{route('request.detail', $request->id)}}"
                                           class="btn btn-sm btn-teal pd-x-25">Detail</a>
                                    </div>
                                </td>
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
    </script>

@endpush
