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
                <div class="form-layout">
                    <div class="row mg-b-25">
                        @foreach($request->devices as $device)
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">{{$device->type->name}}</label>
                                    <input class="form-control" type="text"
                                           value="{{$device->name}} {{!empty($device->serial_number) ? "|| ".$device->serial_number : ""}}"
                                           disabled>
                                </div>
                            </div><!-- col-4 -->
                        @endforeach
                    </div><!-- row -->

                    <div class="form-layout-footer">
                        <a href="{{route('request.index')}}" class="btn btn-secondary">Späť</a>
                    </div><!-- form-layout-footer -->
                </div><!-- form-layout -->
            </div><!-- card -->
        </div><!-- card -->
    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
@endsection

@push('scripts')
    <script src="{{asset('backend/lib/jquery.steps/jquery.steps.js')}}"></script>
    <script src="{{asset('backend/lib/parsleyjs/parsley.js')}}"></script>
    <script>
        (function ($) {
            $('#wizard2').steps({
                headerTag: 'h3',
                bodyTag: 'section',
                autoFocus: true,
                titleTemplate: '<span class="number">#index#</span> <span class="title">#title#</span>',
                onStepChanging: function (event, currentIndex, newIndex) {
                    if (currentIndex < newIndex) {
                        // Step 1 form validation
                        if (currentIndex === 0) {
                            var types = $("#types").parsley();
                            if (types.isValid()) {
                                return true;
                            } else {
                                types.validate();
                            }
                        }

                        // Step 2 form validation
                        if (currentIndex === 1) {
                            var reason = $('#reason').parsley();
                            if (email.isValid()) {
                                return true;
                            } else {
                                email.validate();
                            }
                        }
                        // Always allow step back to the previous step even if the current step is not valid.
                    } else {
                        return true;
                    }
                }
            });
            $('.select2').select2({
                minimumResultsForSearch: Infinity
            });
        })(jQuery);


    </script>
@endpush

