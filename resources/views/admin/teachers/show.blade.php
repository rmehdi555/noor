@extends('admin.master')
@section('content')
    <div id="main-content">
        <div class="container-fluid">
            {{--<div class="block-header">--}}
            {{--<div class="row">--}}
            {{--<div class="col-lg-5 col-md-8 col-sm-12">--}}
            {{--<h2>Jquery Datatable</h2>--}}
            {{--</div>--}}
            {{--<div class="col-lg-7 col-md-4 col-sm-12 text-right">--}}
            {{--<ul class="breadcrumb justify-content-end">--}}
            {{--<li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>--}}
            {{--</ul>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}




            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>{{__('admin/public.show')}}</h2>
                        </div>
                        <div class="body">

                            <form class="form-horizontal" id="form-level-1-save" method="POST"
                                  action="" enctype="multipart/form-data">
                                @csrf
                                @if(count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-md-6 padding-top-15">
                                        <label class="col-md-6 col-sm-6 control-label" for="name">{{__('admin/public.sex')}}
                                            : <span class="required">*</span></label>
                                        <div class="col-md-12 col-sm-10" >
                                            <label class="radio-inline" style="padding: 10px 40px 10px">
                                                <input type="radio" name="sex"
                                                       value="male" @if($teacher->sex=="male") checked @endif
                                                >{{__('admin/public.male')}}
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio"
                                                       name="sex"
                                                       value="female" @if($teacher->sex=="female") checked @endif>{{__('admin/public.female')}}
                                            </label>
                                            @error('sex')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 padding-top-15">

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 padding-top-15">
                                        <label class="col-md-6 col-sm-6 control-label" for="name">{{__('admin/public.name')}}
                                            : <span class="required">*</span></label>
                                        <div class="col-md-12 col-sm-10">
                                            <input type="text" name="name" id="name" value="{{$teacher->name}}"
                                                   class="form-control  @error('name') is-invalid @enderror" required/>
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 padding-top-15">
                                        <label class="col-md-6 col-sm-6 control-label"
                                               for="family">{{__('admin/public.family')}} : <span
                                                    class="required">*</span></label>
                                        <div class="col-md-12 col-sm-10">
                                            <input type="text" name="family" id="family" value="{{$teacher->family}}"
                                                   class="form-control  @error('family') is-invalid @enderror" required/>
                                            @error('family')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 padding-top-15">
                                        <label class="col-md-6 col-sm-6 control-label"
                                               for="f_name">{{__('admin/public.f_name')}} : <span
                                                    class="required">*</span></label>
                                        <div class="col-md-12 col-sm-10">
                                            <input type="text" name="f_name" id="f_name" value="{{$teacher->f_name}}"
                                                   class="form-control  @error('f_name') is-invalid @enderror"/>
                                            @error('f_name')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 padding-top-15">
                                        <label class="col-md-6 col-sm-6 control-label"
                                               for="sh_number">{{__('admin/public.sh_number')}} : <span
                                                    class="required">*</span></label>
                                        <div class="col-md-12 col-sm-10">
                                            <input type="text" name="sh_number" id="sh_number" value="{{$teacher->sh_number}}"
                                                   id="input-name"
                                                   class="form-control  @error('sh_number') is-invalid @enderror" required/>
                                            @error('sh_number')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 padding-top-15">
                                        <label class="col-md-6 col-sm-6 control-label"
                                               for="meli_number">{{__('admin/public.meli_number')}} : <span
                                                    class="required">*</span> </label>
                                        <div class="col-md-12 col-sm-10">
                                            <input type="number" pattern="[0-9]{10}" name="meli_number" id="meli_number"
                                                   value="{{$teacher->meli_number}}" minlength="10"  maxlength="10"
                                                   class="form-control  @error('meli_number') is-invalid @enderror"
                                                   required disabled/>
                                            <span> ({{__('admin/public.meli_number_help_2')}})</span>
                                            @error('meli_number')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 padding-top-15">
                                        <label class="col-md-6 col-sm-6 control-label"
                                               for="sh_sodor">{{__('admin/public.sh_sodor')}} : <span
                                                    class="required">*</span></label>
                                        <div class="col-md-12 col-sm-10">
                                            <input type="text" name="sh_sodor" id="sh_sodor" value="{{$teacher->sh_sodor}}"
                                                   id="input-name"
                                                   class="form-control  @error('sh_sodor') is-invalid @enderror" required/>
                                            @error('sh_sodor')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 padding-top-15">
                                        <label class="col-md-6 col-sm-6 control-label"
                                               for="tavalod_date">{{__('admin/public.tavalod_date')}} : <span
                                                    class="required">*</span></label>
                                        <div class="col-md-12 col-sm-12">
                                            <div class='form-inline row'>
                                                @php
                                                    $tavalod_date=explode("-",$teacher->tavalod_date);
                                                    $teacher->tavalod_date_d=$tavalod_date[2];
                                                    $teacher->tavalod_date_m=$tavalod_date[1];
                                                    $teacher->tavalod_date_y=$tavalod_date[0];

                                                @endphp

                                                <div class='form-group col-sm-4'>
                                                    <select name='tavalod_date_d' class='form-control' required>
                                                        <option selected
                                                                disabled>{{__('admin/public.tavalod_date_d')}}</option>
                                                        @for ($i = 1; $i < 32; $i++)
                                                            <option value="{{$i}}" @php if($teacher->tavalod_date_d==$i) echo "selected"; @endphp>{{$i}}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div class='form-group col-sm-4'>
                                                    <select name='tavalod_date_m' class='form-control' required>
                                                        <option selected
                                                                disabled>{{__('admin/public.tavalod_date_m')}}</option>
                                                        @for ($i = 1; $i < 13; $i++)
                                                            <option value="{{$i}}" @php if($teacher->tavalod_date_m==$i) echo "selected"; @endphp>{{$i}}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div class='form-group col-sm-4'>
                                                    <select name='tavalod_date_y' class='form-control' required>
                                                        <option selected
                                                                disabled>{{__('admin/public.tavalod_date_y')}}</option>
                                                        @for ($i = 1400; $i > 1295; $i--)
                                                            <option value="{{$i}}" @php if($teacher->tavalod_date_y==$i) echo "selected"; @endphp>{{$i}}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                    </div>


                                    <div class="col-md-6 padding-top-15">
                                        <label class="col-md-6 col-sm-6 control-label"
                                               for="married">{{__('admin/public.married')}} : <span class="required">*</span></label>
                                        <div class="col-md-12 col-sm-10">
                                            <label class="radio-inline" style="padding: 10px 40px 10px">
                                                <input type="radio" name="married" checked
                                                       value="{{$teacher->married}}">{{__('admin/public.married_'.$teacher->married)}}
                                            </label>
                                            @php $teacher->married_d=$teacher->married=="no"?"yes":"no";@endphp
                                            <label class="radio-inline">
                                                <input type="radio" name="married"
                                                       value="{{$teacher->married_d}}">{{__('admin/public.married_'.$teacher->married_d)}}
                                            </label>

                                            @error('married')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row div-married div-married-yes">

                                    <div class="col-md-6 padding-top-15">
                                        <label class="col-md-6 col-sm-6 control-label"
                                               for="number_of_children">{{__('admin/public.number_of_children')}} : <span
                                                    class="required">*</span></label>
                                        <div class="col-md-12 col-sm-10">
                                            <input type="number" value="0" min="0" max="20" name="number_of_children"
                                                   id="number_of_children" value="{{$teacher->number_of_children}}"
                                                   class="form-control input-married input-married-yes  @error('number_of_children') is-invalid @enderror"/>
                                            @error('number_of_children')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class="row div-married div-married-no">

                                    <div class="col-md-6 padding-top-15">
                                        <label class="col-md-6 col-sm-6 control-label"
                                               for="phone_f">{{__('admin/public.phone_f')}} : <span class="required">*</span></label>
                                        <div class="col-md-12 col-sm-10">
                                            <input type="tel" placeholder="{{__('admin/public.example')}} : 09125555555"
                                                   pattern="09[0-9]{9}" name="phone_f" id="phone_f"
                                                   value="{{$teacher->phone_f}}" minlength="11"  maxlength="11"
                                                   class="form-control   @error('phone_f') is-invalid @enderror"/>
                                            @error('phone_f')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 padding-top-15">
                                        <label class="col-md-6 col-sm-6 control-label"
                                               for="phone_m">{{__('admin/public.phone_m')}} : <span class="required">*</span></label>
                                        <div class="col-md-12 col-sm-10">
                                            <input type="tel" placeholder="{{__('admin/public.example')}} : 09125555555"
                                                   pattern="09[0-9]{9}" name="phone_m" id="phone_m"
                                                   value="{{$teacher->phone_m}}" minlength="11"  maxlength="11"
                                                   class="form-control @error('phone_m') is-invalid @enderror"/>
                                            @error('phone_m')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>


                                <div class="row">
                                    <div class="col-md-6 padding-top-15">
                                        <label class="col-md-6 col-sm-6 control-label"
                                               for="phone_1">{{__('admin/public.phone_1')}} : <span class="required">*</span></label>
                                        <div class="col-md-12 col-sm-10">
                                            <input type="tel" placeholder="{{__('admin/public.example')}} : 09125555555"
                                                   pattern="09[0-9]{9}" name="phone_1" id="phone_1"
                                                   value="{{$teacher->phone_1}}" minlength="11"  maxlength="11"
                                                   class="form-control  @error('phone_1') is-invalid @enderror" required disabled/>
                                            <span> ({{__('admin/public.phone_1_help_2')}})</span>
                                            @error('phone_1')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 padding-top-15">
                                        <label class="col-md-6 col-sm-6 control-label"
                                               for="phone_2">{{__('admin/public.phone_2')}} :</label>
                                        <div class="col-md-12 col-sm-10">
                                            <input type="tel" placeholder="{{__('admin/public.example')}} : 09125555555"
                                                   pattern="09[0-9]{9}" name="phone_2" id="phone_2"
                                                   value="{{$teacher->phone_2}}" minlength="11"  maxlength="11"
                                                   class="form-control  @error('phone_2') is-invalid @enderror"/>
                                            @error('phone_2')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 padding-top-15">
                                        <label class="col-md-6 col-sm-6 control-label" for="tel">{{__('admin/public.tel')}} :
                                            <span class="required">*</span></label>
                                        <div class="col-md-12 col-sm-10">
                                            <input type="text" name="tel" id="tel"
                                                   placeholder="{{__('admin/public.example')}} : 02122334455"
                                                   value="{{$teacher->tel}}"
                                                   class="form-control  @error('tel') is-invalid @enderror" />
                                            @error('tel')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 padding-top-15">
                                        <label class="col-md-6 col-sm-6 control-label"
                                               for="email">{{__('admin/public.email')}} :</label>
                                        <div class="col-md-12 col-sm-10">
                                            <input type="email" name="email" id="email" value="{{$teacher->email}}"
                                                   class="form-control  @error('email') is-invalid @enderror"/>
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 padding-top-15">
                                        <label class="col-md-6 col-sm-6 control-label"
                                               for="province">{{__('admin/public.province')}} : <span
                                                    class="required">*</span></label>
                                        <div class="col-md-12 col-sm-10">
                                            <select name='province' class='form-control' id="select-province" required>
                                                <option value="0" selected
                                                        disabled>{{__('admin/public.select_option')}}</option>
                                                @foreach ($provinces as $item)
                                                    <option value="{{$item->id}}" class="option-province"
                                                            id="option-province-id" @php if($teacher->province==$item->id) echo "selected"; @endphp>{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('province')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 padding-top-15">
                                        <label class="col-md-6 col-sm-6 control-label" for="city">{{__('admin/public.city')}}
                                            : <span class="required">*</span></label>
                                        <div class="col-md-12 col-sm-10">
                                            <select name='city' class='form-control' id="select-city" required>
                                                <option value="0" selected
                                                        disabled>{{__('admin/public.select_option')}}</option>
                                                @foreach ($cities as $item)
                                                    <option value="{{$item->id}}"
                                                            class="option-city option-city-{{$item->province_id}}"
                                                            id="option-city-{{$item->id}}" @php if($teacher->city==$item->id) echo "selected"; @endphp>{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('city')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6 padding-top-15">
                                        <label class="col-md-6 col-sm-6 control-label"
                                               for="address">{{__('admin/public.address')}} : <span class="required">*</span></label>
                                        <div class="col-md-12 col-sm-10">
                                            <input type="text" name="address" id="address" value="{{$teacher->address}}"
                                                   class="form-control  @error('address') is-invalid @enderror" required/>
                                            @error('address')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 padding-top-15">
                                        <label class="col-md-6 col-sm-6 control-label"
                                               for="post_number">{{__('admin/public.post_number')}} : <span
                                                    class="required">*</span></label>
                                        <div class="col-md-12 col-sm-10">
                                            <input type="number" name="post_number" id="post_number" minlength="10"  maxlength="10"
                                                   value="{{$teacher->post_number}}" id="input-name"
                                                   class="form-control  @error('post_number') is-invalid @enderror"
                                                   required/>
                                            @error('post_number')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 padding-top-15">
                                        <label class="col-md-6 col-sm-6 control-label"
                                               for="education">{{__('admin/public.education')}} : <span
                                                    class="required">*</span></label>
                                        <div class="col-md-12 col-sm-10">
                                            <input type="text" name="education" id="education" value="{{$teacher->education}}"
                                                   class="form-control  @error('education') is-invalid @enderror" required/>
                                            @error('education')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 padding-top-15">
                                        <label class="col-md-6 col-sm-6 control-label" for="job">{{__('admin/public.job')}} :
                                            <span class="required">*</span></label>
                                        <div class="col-md-12 col-sm-10">
                                            <input type="text" name="job" id="job" value="{{$teacher->job}}" id="input-name"
                                                   class="form-control  @error('job') is-invalid @enderror" required/>
                                            @error('job')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <br><br>

                                <p class="bu-margin-bottom-30">مدارک بارگذاری شده: </p>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>جهت مشاهده مدک روی عنوان آن کلیک نماید</th>
                                            {{--<th>{{__('web/public.setting')}}</th>--}}
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php $i=1; @endphp
                                        @foreach($teacher->documents as $item)
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td><a href="{{asset($item->url)}}" target="_blank">{{$item->title}}</a></td>
                                            </tr>
                                            @php $i++; @endphp
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>







                                <div class="d-flex justify-content-center mb-2">
                                    <div class="p-2 ">
                                        {{--<button type="submit"--}}
                                                {{--class="btn btn-primary">{{__('admin/public.next')}}</button>--}}
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection