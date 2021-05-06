@extends('layouts.admin')

@push('styles')
    <link href="{{asset('backend/lib/select2/css/select2.min.css')}}" rel="stylesheet">
@endpush
@section('admin_content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        {{\Diglactic\Breadcrumbs\Breadcrumbs::render('processRequest', $request)}}
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
                <form action="{{route('request.process.store', $request->id)}}" method="post">
                    @csrf
                    <div class="form-layout">
                        <div class="row mg-b-25">
                            @foreach($types as $type)
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">{{$type->name}}</label>
                                        <select id="{{$type->name}}_id" class="form-control select2-show-search"
                                                name="{{$type->name}}"
                                                data-placeholder="">
                                            <option label="Výber..." disabled selected></option>
                                            @foreach($type->devices as $device)
                                                @if($device->status == 1)
                                                    <option value="{{$device->id}}">{{$device->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div><!-- col-4 -->
                            @endforeach
                            @if(!empty($types->find('1')) || !empty($types->find('2')))
                                @foreach($accessories as $accessory)
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label">{{$accessory->name}}</label>
                                            <select id="{{$accessory->name}}_id" class="form-control select2-show-search"
                                                    name="{{$accessory->name}}"
                                                    data-placeholder="">
                                                <option label="Výber..." disabled selected></option>
                                                @foreach($accessory->devices as $device)
                                                    @if($device->status == 1)
                                                        <option value="{{$device->id}}">{{$device->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div><!-- col-4 -->
                                @endforeach
                            @endif
                        </div><!-- row -->

                        <div class="form-layout-footer">
                            <button class="btn btn-info mg-r-5">Uložiť</button>
                            <a href="{{route('request.index')}}" class="btn btn-secondary">Zrušiť</a>
                        </div><!-- form-layout-footer -->
                    </div><!-- form-layout -->
                </form>
            </div><!-- card -->
        </div><!-- card -->
    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
@endsection

