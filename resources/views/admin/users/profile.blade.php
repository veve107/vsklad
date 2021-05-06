@extends('layouts.admin')
@push('styles')
    <link rel="stylesheet" href="{{asset('backend/css/profile.css')}}">
@endpush
@section('admin_content')
    <div class="sl-mainpanel">
        {{\Diglactic\Breadcrumbs\Breadcrumbs::render('profile', $user)}}
        <div class="sl-pagebody">
            <div class="card pd-20 pd-sm-40">
                <div class="sl-page-title">
                    <h5>Môj profil</h5>
                </div><!-- sl-page-title -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">
                            <img
                                src="https://www.placecage.com/800/800"
                                alt=""/>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <form method="post">
                            <div class="row">
                                <div class="col-md-9">
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
                                                   role="tab" aria-controls="profile" aria-selected="false">Žiadosti</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <a href="{{route('user.edit', $user->id)}}" class="btn profile-edit-btn">Upraviť profil</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="tab-content profile-tab" id="myTabContent">
                                        <div class="tab-pane fade show active" id="home" role="tabpanel"
                                             aria-labelledby="home-tab">
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
                                                    <label>Telefón</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <p>
                                                        @if(empty($user->phone_number))
                                                            Nenastavené
                                                        @else
                                                            {{$user->phone_number}}
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="devices" role="tabpanel" aria-labelledby="profile-tab">
                                            @foreach($user->requests as $request)
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h5 class="tx-inverse" style="color: {{$request->state_id == 6 ? "red" : "green"}}">Žiadosť číslo: {{$request->id}} z dňa {{\Carbon\Carbon::parse($request->created_at)->format('d.m.Y')}} {{$request->state_id == 6 ? "Ukončená" : "Aktívna"}}</h5>
                                                    </div>
                                                    @foreach($request->devices as $device)
                                                        <div class="col-md-6">
                                                            <label>{{$device->type->name}}</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <p>{{$device->brand->name}} {{$device->name}} {{!empty($device->serial_number) ? "|| " . $device->serial_number : ""}}</p>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <hr>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>

            </div>
        </div><!-- card -->
    </div><!-- sl-mainpanel -->
@endsection
