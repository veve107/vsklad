@extends('layouts.admin')

@push('styles')
    <link href="{{asset('backend/lib/select2/css/select2.min.css')}}" rel="stylesheet">
@endpush

@section('admin_content')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        {{\Diglactic\Breadcrumbs\Breadcrumbs::render('detailRequest', $request)}}
        @if($errors->any())
            <div class="alert alert-danger">
                <ul style="margin-bottom: 0!important;">
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="sl-pagebody">
            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Spracovanie žiadosti</h6>
                <p class="mg-b-20 mg-sm-b-30">Žiadosť číslo {{$request->id}}</p>

                <div class="form-layout">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Meno:</label>
                                <input class="form-control" type="text" name="name" value="{{$request->user->name}}"
                                       disabled>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label class="form-control-label">Oddelenie:</label>
                                <input class="form-control" type="text" name="department"
                                       value="{{$request->user->department->name}}" disabled>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label class="form-control-label">Pozícia:</label>
                                <input class="form-control" type="text" name="position"
                                       value="{{$request->user->position->name}}" disabled>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Emailová adresa:</label>
                                <input class="form-control" type="text" name="email" value="{{$request->user->email}}"
                                       disabled>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-12">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Dôvod žiadosti:</label>
                                <textarea rows="3" id="reason" class="form-control" name="reason"
                                          disabled>{{$request->reason}}</textarea>
                            </div>
                        </div><!-- col-8 -->
                    </div><!-- row -->
                </div><!-- form-layout -->
            </div>
        </div>
        <div class="sl-pagebody">
            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Zariadenia</h6>
                <div class="form-layout">
                    <div class="row mg-b-25">
                        @foreach($request->devices as $device)
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">{{$device->type->name}}</label>
                                    <input class="form-control" type="text"
                                           value="{{$device->name}} {{!empty($device->serial_number) ? "|| SN:" . $device->serial_number : ""}}"
                                           disabled>
                                </div>
                            </div><!-- col-4 -->
                        @endforeach
                    </div><!-- row -->
                </div><!-- form-layout -->
            </div><!-- card -->
        </div><!-- card -->
        <div class="sl-pagebody">
            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Vrátenie zariadení</h6>
                <div class="form-layout">
                    <form action="{{route('request.return.store')}}" method="post">
                        @csrf
                        <input hidden name="request_id" value="{{$request->id}}">
                        @foreach($request->devices as $device)
                            @if($device->type->type == 1)
                                <h5>{{$device->type->name}}</h5>
                                <div class="row mg-b-25">
                                    <div class="col-lg-1 mg-t-30">
                                        <label class="ckbox">
                                            <input type="checkbox" name="{{$device->type->name}}-checkbox"><span>{{$device->name}}</span>
                                        </label>
                                    </div><!-- col-3 -->
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label">Sériové číslo</label>
                                            <input class="form-control" type="text" placeholder="Skontrolvať pred odovzdaním" name="{{$device->type->name}}-serial">
                                        </div>
                                    </div><!-- col-4 -->
                                </div>
                            @else
                                <div class="row mg-b-25">
                                    <div class="col-lg-3 mg-t-20 mg-lg-t-0">
                                        <label class="ckbox">
                                            <input type="checkbox" name="{{$device->type->name}}-checkbox"><span>{{$device->name}}</span>
                                        </label>
                                    </div><!-- col-3 -->
                                </div>
                            @endif
                        @endforeach
                        <div class="form-layout-footer">
                            <button class="btn btn-info mg-r-5">Vrátiť</button>
                            <a href="{{route('request.index')}}" class="btn btn-secondary">Zrušiť</a>
                        </div><!-- form-layout-footer -->
                    </form>
                </div><!-- form-layout -->
            </div><!-- card -->
        </div><!-- card -->
    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
@endsection
