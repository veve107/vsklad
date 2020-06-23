@extends('layouts.admin')

@section('admin_content')
    <div class="d-flex align-items-center justify-content-center bg-sl-primary ht-md-100v">

        <div class="login-wrapper wd-300 wd-xs-400 pd-25 pd-xs-40 bg-white">
            <div class="signin-logo tx-center tx-24 tx-bold tx-inverse">Virtuálny <span
                    class="tx-info tx-normal">Sklad</span></div>
            <div class="tx-center mg-b-30">Bakalárska práca</div>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                    <div>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                               name="name"
                               value="{{ old('name') }}" required autocomplete="name" autofocus
                               placeholder="Zadaj svoje meno">

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div><!-- form-group -->
                <div class="form-group">
                    <div>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                               name="email" value="{{ old('email') }}" required autocomplete="email"
                               placeholder="Zadaj svoj email">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div><!-- form-group -->
                <div class="form-group">
                    <div>
                        <input id="password" type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               name="password" required autocomplete="new-password" placeholder="Zadaj heslo">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                </div><!-- form-group -->
                <div class="form-group">
                    <div>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                               required autocomplete="new-password" placeholder="Potvrď heslo">
                    </div>
                </div><!-- form-group -->
                <button type="submit" class="btn btn-info btn-block">
                    {{ __('Zaregistruj') }}
                </button>
            </form>
            <div class="mg-t-40 tx-center">Už máte účet? <a href="{{route('login')}}" class="tx-info">Prihláste sa!</a>
            </div>
        </div><!-- login-wrapper -->
    </div>
@endsection
