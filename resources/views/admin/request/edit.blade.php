@extends('layouts.admin')

@push('styles')
    <link href="{{asset('backend/lib/select2/css/select2.min.css')}}" rel="stylesheet">
@endpush

    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="index.html">Domov</a>
            <span class="breadcrumb-item active">Pridanie zariadenia</span>
        </nav>

        <div class="sl-pagebody">
            <div class="card pd-20 pd-sm-40">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul style="margin-bottom: 0!important;">
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <h6 class="card-body-title">Zadanie novej žiadosti o techniku</h6>
                <p class="mg-b-20">Formulár pre žiadosť o techniku</p>
                <form action="{{route('request.store')}}" method="post">
                    @csrf
                    <div class="form-layout">
                        <div class="row mg-b-20">
                            <div class="col-lg-12 mg-b-15">
                                <label class="form-control-label" for="types">Typ žiadanej techniky <span
                                        class="tx-danger">*</span></label>
                                <select class="form-control select2"
                                        data-placeholder="Zvoľ typ (1-*) žiadaného zariadenia" multiple id="types"
                                        name="types[]">
                                    @foreach($types as $type)
                                        <option value="{{$type->id}}">{{$type->name}}</option>
                                    @endforeach
                                </select>
                            </div><!-- col-4 -->

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="reason">Dôvod <span
                                            class="tx-danger">*</span></label>
                                    <textarea rows="3" id="reason" class="form-control"
                                              placeholder="Zadaj dôvod žiadosti" name="reason"></textarea>
                                </div>
                            </div><!-- col-4 -->
                        </div><!-- row -->

                        <div class="form-layout-footer">
                            <button class="btn btn-info mg-r-5">Odoslať žiadosť</button>
                        </div><!-- form-layout-footer -->
                    </div><!-- form-layout -->
                </form>
            </div><!-- card -->
        </div>
    </div><!-- sl-mainpanel -->
    <script src="{{asset('backend/lib/jquery/jquery.js')}}"></script>

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
