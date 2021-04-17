@extends('layouts.admin')
@push('styles')
    <link rel="stylesheet" href="{{asset('backend/css/profile.css')}}">
@endpush
@section('admin_content')
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="index.html">Starlight</a>
            <a class="breadcrumb-item" href="index.html">Tables</a>
            <span class="breadcrumb-item active">Používatelia</span>
        </nav>

        <div class="sl-pagebody">
            <div class="card pd-20 pd-sm-40">
                <div class="sl-page-title">
                    <h5>Môj profil</h5>
                </div><!-- sl-page-title -->
                <form method="post">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="profile-img">
                                <img
                                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS52y5aInsxSm31CvHOFHWujqUx_wWTS9iM6s7BAm21oEN_RiGoog"
                                    alt=""/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="profile-head">
                                <h5>
                                    {{$user->name}}
                                </h5>
                                <h6>
                                    @if(empty($user->department))
                                            Nenastavené
                                    @else
                                        {{$user->department->name}} - {{$user->position->name}}
                                    @endif
                                </h6>
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home"
                                           role="tab" aria-controls="home" aria-selected="true">Informácie</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#devices"
                                           role="tab" aria-controls="profile" aria-selected="false">Zariadenia</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <a href="{{route('user.edit', $user->id)}}" class="btn profile-edit-btn">Upraviť profil</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">

                        </div>
                        <div class="col-md-8">
                            <div class="tab-content profile-tab" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel"
                                     aria-labelledby="home-tab">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>ID Používateľa</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p>{{$user->id}}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Meno</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p>{{$user->name}}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Email</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p>{{$user->email}}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Profesia</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p>Webový vývojár a dizajnér</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="devices" role="tabpanel" aria-labelledby="profile-tab">
                                    @foreach($user->requests as $request)
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h6>Žiadosť číslo: {{$request->id}} z dňa {{$request->created_at->toDayDateTimeString()}}</h6>
                                            </div>
                                            @foreach($request->devices as $device)
                                                <div class="col-md-6">
                                                    <label>{{$device->type->name}}</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <p>{{$device->name}} || {{$device->serial_number}}</p>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- card -->
    </div><!-- sl-mainpanel -->
@endsection
