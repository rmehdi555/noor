@extends('admin.master')
@section('content')
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-8 col-sm-12">
                        <h2>تغییر رمز عبور</h2>
                    </div>
                    <div class="col-lg-7 col-md-4 col-sm-12 text-right">
                        <ul class="breadcrumb justify-content-end">
                            {{--<li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>--}}
                            {{--<li class="breadcrumb-item">Table</li>--}}
                            {{--<li class="breadcrumb-item active">Jquery Datatable</li>--}}
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card">

                                <div class="card-body">
                                    <form method="POST" action="{{ route('admin.change.password.store') }}">
                                        @csrf

                                        @foreach ($errors->all() as $error)
                                            <p class="text-danger">{{ $error }}</p>
                                        @endforeach

                                        <div class="form-group row">
                                            <label for="password" class="col-md-4 col-form-label text-md-right">رمز عبور فعلی :</label>

                                            <div class="col-md-6">
                                                <input id="password" type="password" class="form-control" name="current_password" autocomplete="current-password">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="password" class="col-md-4 col-form-label text-md-right">رمز عبور جدید :</label>

                                            <div class="col-md-6">
                                                <input id="new_password" type="password" class="form-control" name="new_password" autocomplete="current-password">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="password" class="col-md-4 col-form-label text-md-right">تکرار رمز عبور جدید :</label>

                                            <div class="col-md-6">
                                                <input id="new_confirm_password" type="password" class="form-control" name="new_confirm_password" autocomplete="current-password">
                                            </div>
                                        </div>

                                        <div class="form-group row mb-0">
                                            <div class="col-md-8 offset-md-4">
                                                <button type="submit" class="btn btn-primary">
                                                    تغییر رمز عبور
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection