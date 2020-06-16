@extends('layouts.admin')

@section('admin_content')

    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{route('admin.home')}}">Domov</a>
            <span class="breadcrumb-item active">Pridanie objednávky</span>
        </nav>

        <div class="sl-pagebody">
            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Pridanie objednávky</h6>
                <p class="mg-b-20 mg-sm-b-30">Formulár pre pridanie objednávky</p>
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>

                @endif

                <form method="post" action="{{route('store.order')}}">
                    @csrf

                    <div class="form-layout">
                        <div class="row mg-b-25">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Model: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="name" placeholder="Zadaj model">
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Dátum prijatia: <span class="tx-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                                        <input type="text" class="form-control fc-datepicker" placeholder="MM/DD/YYYY">
                                    </div>
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Dátum konca záruky: <span class="tx-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                                        <input type="text" class="form-control fc-datepicker" placeholder="MM/DD/YYYY">
                                    </div>
                                </div>
                            </div><!-- col-4 -->
                        </div><!-- row -->

                        <div class="form-layout-footer">
                            <button class="btn btn-info mg-r-5">Pridaj zariadenie</button>
                        </div><!-- form-layout-footer -->
                    </div><!-- form-layout -->

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info pd-x-20">Pridať</button>
                        <button type="button" class="btn btn-secondary pd-x-20" data-dismiss="modal">Zavrieť</button>
                    </div>
                </form>
            </div><!-- card -->
        </div>
    </div><!-- sl-mainpanel -->

    <script src="{{asset('backend/lib/jquery/jquery.js')}}"></script>
    <script src="{{asset('backend/lib/jquery-ui/jquery-ui.js')}}"></script>

    <script>
        // Datepicker

        $('.fc-datepicker').datepicker({
            showOtherMonths: true,
            selectOtherMonths: true
        });
    </script>

@endsection
