@extends('layouts.admin')
@push('styles')
    <link href="{{asset('backend/lib/datatables/jquery.dataTables.css')}}" rel="stylesheet">
@endpush
@section('admin_content')

    <div class="sl-mainpanel">
        {{\Diglactic\Breadcrumbs\Breadcrumbs::render('requests')}}
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
                            @if($request->user->id == \Illuminate\Support\Facades\Auth::user()->id || (\Illuminate\Support\Facades\Auth::user()->role->id == 1 || \Illuminate\Support\Facades\Auth::user()->role->id == 2))
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
                                                @if(\Illuminate\Support\Facades\Auth::user()->role->id == 1 || \Illuminate\Support\Facades\Auth::user()->role->id == 2)
                                                    <a href="{{route('request.process', $request->id)}}"
                                                       class="btn btn-sm btn-success pd-x-25">Spracovať</a>
                                                @else
                                                    <button
                                                        class="btn btn-sm btn-secondary pd-x-25">Čaká na spracovanie
                                                    </button>
                                                @endif
                                                <a href="{{route('request.edit', $request->id)}}"
                                                   class="btn btn-sm btn-info pd-x-25">Editovať</a>

                                                <a href="{{route('request.delete', $request->id)}}"
                                                   class="btn btn-sm btn-danger pd-x-25"
                                                   id="delete">Zmazať</a>
                                            @elseif($request->state_id == 2)
                                                @if(\Illuminate\Support\Facades\Auth::user()->role->id == 1 || \Illuminate\Support\Facades\Auth::user()->role->id == 2)
                                                    <a href="{{route('request.processForIssue', $request->id)}}"
                                                       class="btn btn-sm btn-primary pd-x-25">Pripraviť na výdaj</a>
                                                @else
                                                    <button
                                                        class="btn btn-sm btn-secondary pd-x-25">Čaká na výdaj
                                                    </button>
                                                @endif
                                            @elseif($request->state_id == 3)
                                                @if($request->user->id == \Illuminate\Support\Facades\Auth::user()->id)
                                                    <a href="{{route('request.receive', $request->id)}}"
                                                       class="btn btn-sm btn-warning pd-x-25 receiveButton">Prevziať</a>
                                                @else
                                                    <button
                                                        class="btn btn-sm btn-secondary pd-x-25">Čaká na prevzatie
                                                    </button>
                                                @endif
                                            @elseif($request->state_id == 4)
                                                @if($request->user->id == \Illuminate\Support\Facades\Auth::user()->id)
                                                    <a href="{{route('request.return', $request->id)}}"
                                                       class="btn btn-sm btn-purple pd-x-25">Vrátiť</a>
                                                @else
                                                    <button
                                                        class="btn btn-sm btn-secondary pd-x-25">Vydané
                                                    </button>
                                                @endif
                                            @elseif($request->state_id == 5)
                                                @if(\Illuminate\Support\Facades\Auth::user()->role->id == 1 || \Illuminate\Support\Facades\Auth::user()->role->id == 2)
                                                    <a href="{{route('request.confirm', $request->id)}}"
                                                       class="btn btn-sm btn-teal pd-x-25">Potvrdiť vrátenie</a>
                                                @else
                                                    <button
                                                        class="btn btn-sm btn-secondary pd-x-25">Čaká sa na potvrdenie
                                                    </button>
                                                @endif
                                            @elseif($request->state_id == 6)
                                                <button
                                                    class="btn btn-sm btn-secondary pd-x-25">Žiadosť ukončená
                                                </button>
                                            @endif

                                            <a href="{{route('request.detail', $request->id)}}"
                                               class="btn btn-sm btn-teal pd-x-25">Detail</a>
                                        </div>
                                    </td>
                                </tr>
                            @endif
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
        $(".receiveButton").click(function (e) {
            e.preventDefault();
            let link = $(this).attr("href");
            Swal.fire({
                title: 'Súhlasíte s podmienkami a ste si vedomý svojich povinností po prebratí firemného hardvéru?',
                text: "Tento súhlas je nevratný!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Áno, súhlasím.',
                cancelButtonText: 'Nie, nesúhlasím.'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = link;
                }
            })
        });


    </script>

@endpush
