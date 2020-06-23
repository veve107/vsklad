@extends('layouts.admin')
@push('styles')
    <link href="{{asset('backend/lib/select2/css/select2.min.css')}}" rel="stylesheet">
@endpush
@section('admin_content')

    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="index.html">Domov</a>
            <span class="breadcrumb-item active">Pridanie zariadenia</span>
        </nav>
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>

        @endif
        <div class="sl-pagebody">
            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Pridanie zariadenia</h6>
                <p class="mg-b-20 mg-sm-b-30">Formulár pre pridanie zariadenia</p>
                <form action="{{route('hardware.store')}}" method="post">
                    @csrf
                    <div class="form-layout">
                        <div class="row mg-b-25">
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Značka: <span class="tx-danger">*</span></label>
                                    <select id="brand_id" class="form-control select2-show-search" name="brand_id"
                                            data-placeholder="Vyber značku">
                                        <option label="Zvoľ značku" disabled></option>
                                        @foreach($brands as $brand)
                                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Model: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="name" placeholder="Zadaj model">
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Typ: <span class="tx-danger">*</span></label>
                                    <select id="type_id" class="form-control select2-show-search" name="type_id"
                                            data-placeholder="Vyber typ">
                                        <option label="Zvoľ značku" disabled></option>
                                        @foreach($types as $type)
                                            <option value="{{$type->id}}">{{$type->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Objednávka: <span
                                            class="tx-danger">*</span></label>
                                    <select id="order_id" class="form-control select2-show-search" name="order_id"
                                            data-placeholder="Vyber objednávku">
                                        <option label="Zvoľ značku" disabled></option>
                                        @foreach($orders as $order)
                                            <option value="{{$order->id}}">{{$order->order_number}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Sériové číslo: <span
                                            class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="serial_number"
                                           placeholder="Zadaj sériové číslo">
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Inventárne číslo: <span
                                            class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="inventory_number"
                                           placeholder="Zadaj inventárne číslo">
                                </div>
                            </div><!-- col-4 -->
                        </div><!-- row -->

                        <div class="form-layout-footer">
                            <button class="btn btn-info mg-r-5">Pridaj zariadenie</button>
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
