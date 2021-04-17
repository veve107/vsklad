@extends('layouts.admin')

@section('admin_content')

    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="index.html">Starlight</a>
            <a class="breadcrumb-item" href="index.html">Tables</a>
            <span class="breadcrumb-item active">Pozície</span>
        </nav>

        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Oddelenia</h5>
            </div><!-- sl-page-title -->
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>

            @endif
            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Úprava profilu</h6>
                <p class="mg-b-20 mg-sm-b-30">Formulár pre úpravu používateľa</p>
                <form action="{{route('user.update', $user->id)}}" method="post">
                    @csrf
                    <div class="form-layout">
                        <div class="row mg-b-25">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Meno používateľa: <span
                                            class="tx-danger">*</span></label>
                                    <input class="form-control" id="name" type="text" name="name"
                                           value="{{$user->name}}">
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Email: <span
                                            class="tx-danger">*</span></label>
                                    <input class="form-control" id="email" type="text" name="email"
                                           value="{{$user->email}}">
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Rola: <span class="tx-danger">*</span></label>
                                    <select id="role_id" class="form-control select2-show-search" name="role_id"
                                            data-placeholder="Vyber rolu">
                                        @foreach($roles as $role)
                                            @if($user->role_id == $role->id)
                                                <option value="{{$role->id}}" selected="selected">{{$role->name}}</option>
                                            @else
                                                <option value="{{$role->id}}">{{$role->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Typ: <span class="tx-danger">*</span></label>
                                    <select id="position_id" class="form-control select2-show-search" name="position_id"
                                            data-placeholder="Vyber pozíciu">
                                        @foreach($positions as $position)
                                            @if($user->position_id == $position->id)
                                                <option value="{{$position->id}}" selected>{{$position->name}}</option>
                                            @else
                                                <option value="{{$position->id}}">{{$position->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Oddelenie: <span
                                            class="tx-danger">*</span></label>
                                    <select id="department_id" class="form-control select2-show-search" name="department_id"
                                            data-placeholder="Vyber oddelenie">
                                        @foreach($departments as $department)
                                            @if($user->department_id == $department->id)
                                                <option value="{{$department->id}}" selected>{{$department->name}}</option>
                                            @else
                                                <option value="{{$department->id}}">{{$department->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div><!-- col-4 -->
                        </div><!-- row -->

                        <div class="form-layout-footer">
                            <button class="btn btn-info mg-r-5">Uprav používateľa</button>
                        </div><!-- form-layout-footer -->
                    </div><!-- form-layout -->
                </form>
            </div><!-- card -->
        </div>
    </div><!-- sl-mainpanel -->

    <script>
        $(function () {

            'use strict';

            $('.select2').select2({
                minimumResultsForSearch: Infinity
            });

            // Select2 by showing the search
            $('.select2-show-search').select2({
                minimumResultsForSearch: '',
                width: '100%'
            });

            // Select2 with tagging support
            $('.select2-tag').select2({
                tags: true,
                tokenSeparators: [',', ' ']
            });

        });
    </script>
@endsection
