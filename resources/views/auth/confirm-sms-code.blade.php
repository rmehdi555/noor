@extends('web.master-product')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('web/public.activation_account_by_sms') }}</div>

                <div class="card-body">


                    <form method="POST" action="{{ route('web.activation.account.by.sms') }}">
                        @csrf
                        <input type="hidden" name="phone" value="{{$user->phone}}">

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right"> {{ __('web/public.enter_code_sms') }}</label>

                            <div class="col-md-6">
                                <input id="code" type="code" class="form-control @error('code') is-invalid @enderror" name="code" required autocomplete="current-code">

                                @error('code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('web/public.submit') }}
                                </button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
