@extends('teacher.master')
@section('content')

    <section class="bu-inner-main noPrint">
        <div class=" d-flex justify-content-center mb-2 ">
            <div class="p-2 ">
                <button type="button"
                        class="btn btn-warning" onclick="window.print()">{{__('web/public.print')}}</button>
            </div>
        </div>
    </section>
    <section class="bu-inner-main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-info m-1">
                        <p class="p-1 text-justify">معلم گرامی
                            {{$user->teacher->name}}  {{$user->teacher->family}}
                            مشخصات شما با موفقیت در سامانه نور موعود ثبت گردید.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="bu-inner-main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success m-1">
                        <p class="p-1 text-justify">
                            کد معلم القرآنی :
                            {{$user->teacher->teacher_id }}
                            <br>
                            تاریخ ایجاد :
                            <span >{{\App\Providers\MyProvider::show_date($user->created_at,'H:i j-n-Y ')}}</span>


                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bu-inner-main">
        <div class="container">
            <form class="form-horizontal" id="form-level-1-save" method="POST"
                  action="{{ route('teacher.level.2.save') }}" enctype="multipart/form-data">
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
                        <label class="col-md-6 col-sm-6 control-label" for="name">{{__('web/public.sex')}}
                            : <span class="required">*</span></label>
                        <div class="col-md-12 col-sm-10" >
                            <label class="radio-inline" style="padding: 10px 40px 10px">
                                <input type="radio" name="sex"
                                       value="male" @if($user->teacher->sex=="male") checked @endif
                                >{{__('web/public.male')}}
                            </label>
                            <label class="radio-inline">
                                <input type="radio"
                                       name="sex"
                                       value="female" @if($user->teacher->sex=="female") checked @endif>{{__('web/public.female')}}
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
                        <label class="col-md-6 col-sm-6 control-label" for="name">{{__('web/public.name')}}
                            : <span class="required">*</span></label>
                        <div class="col-md-12 col-sm-10">
                            <input type="text" name="name" id="name" value="{{$user->teacher->name}}"
                                   class="form-control  @error('name') is-invalid @enderror" required disabled/>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 padding-top-15">
                        <label class="col-md-6 col-sm-6 control-label"
                               for="family">{{__('web/public.family')}} : <span
                                    class="required">*</span></label>
                        <div class="col-md-12 col-sm-10">
                            <input type="text" name="family" id="family" value="{{$user->teacher->family}}"
                                   class="form-control  @error('family') is-invalid @enderror" required disabled/>
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
                               for="f_name">{{__('web/public.f_name')}} : <span
                                    class="required">*</span></label>
                        <div class="col-md-12 col-sm-10">
                            <input type="text" name="f_name" id="f_name" value="{{$user->teacher->f_name}}"
                                   class="form-control  @error('f_name') is-invalid @enderror" disabled/>
                            @error('f_name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 padding-top-15">
                        <label class="col-md-6 col-sm-6 control-label"
                               for="sh_number">{{__('web/public.sh_number')}} : <span
                                    class="required">*</span></label>
                        <div class="col-md-12 col-sm-10">
                            <input type="text" name="sh_number" id="sh_number" value="{{$user->teacher->sh_number}}"
                                   id="input-name"
                                   class="form-control  @error('sh_number') is-invalid @enderror" required disabled/>
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
                               for="meli_number">{{__('web/public.meli_number')}} : <span
                                    class="required">*</span> </label>
                        <div class="col-md-12 col-sm-10">
                            <input type="number" pattern="[0-9]{10}" name="meli_number" id="meli_number"
                                   value="{{$user->teacher->meli_number}}"
                                   class="form-control  @error('meli_number') is-invalid @enderror"
                                   required disabled/>
                            <span> ({{__('web/public.meli_number_help_2')}})</span>
                            @error('meli_number')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 padding-top-15">
                        <label class="col-md-6 col-sm-6 control-label"
                               for="sh_sodor">{{__('web/public.sh_sodor')}} : <span
                                    class="required">*</span></label>
                        <div class="col-md-12 col-sm-10">
                            <input type="text" name="sh_sodor" id="sh_sodor" value="{{$user->teacher->sh_sodor}}"
                                   id="input-name"
                                   class="form-control  @error('sh_sodor') is-invalid @enderror" required disabled/>
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
                               for="tavalod_date">{{__('web/public.tavalod_date')}} : <span
                                    class="required">*</span></label>
                        <div class="col-md-12 col-sm-12">
                            <div class='form-inline row'>
                                @php
                                $tavalod_date=explode("-",$user->teacher->tavalod_date);
                                $user->teacher->tavalod_date_d=$tavalod_date[2];
                                $user->teacher->tavalod_date_m=$tavalod_date[1];
                                $user->teacher->tavalod_date_y=$tavalod_date[0];

                                @endphp

                                <div class='form-group col-sm-4'>
                                    <select name='tavalod_date_d' class='form-control' required disabled>
                                        <option selected
                                                disabled>{{__('web/public.tavalod_date_d')}}</option>
                                        @for ($i = 1; $i < 32; $i++)
                                            <option value="{{$i}}" @php if($user->teacher->tavalod_date_d==$i) echo "selected"; @endphp>{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class='form-group col-sm-4'>
                                    <select name='tavalod_date_m' class='form-control' required disabled>
                                        <option selected
                                                disabled>{{__('web/public.tavalod_date_m')}}</option>
                                        @for ($i = 1; $i < 13; $i++)
                                            <option value="{{$i}}" @php if($user->teacher->tavalod_date_m==$i) echo "selected"; @endphp>{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class='form-group col-sm-4'>
                                    <select name='tavalod_date_y' class='form-control' required disabled>
                                        <option selected
                                                disabled>{{__('web/public.tavalod_date_y')}}</option>
                                        @for ($i = 1400; $i > 1295; $i--)
                                            <option value="{{$i}}" @php if($user->teacher->tavalod_date_y==$i) echo "selected"; @endphp>{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>


                    <div class="col-md-6 padding-top-15">
                        <label class="col-md-6 col-sm-6 control-label"
                               for="married">{{__('web/public.married')}} : <span class="required">*</span></label>
                        <div class="col-md-12 col-sm-10">
                            <label class="radio-inline" style="padding: 10px 40px 10px">
                                <input type="radio" name="married" checked disabled
                                       value="{{$user->teacher->married}}">{{__('web/public.married_'.$user->teacher->married)}}
                            </label>
                            @php $user->teacher->married_d=$user->teacher->married=="no"?"yes":"no";@endphp
                            <label class="radio-inline">
                                <input type="radio" name="married" disabled
                                       value="{{$user->teacher->married_d}}">{{__('web/public.married_'.$user->teacher->married_d)}}
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
                               for="number_of_children">{{__('web/public.number_of_children')}} : <span
                                    class="required">*</span></label>
                        <div class="col-md-12 col-sm-10">
                            <input type="number" value="0" min="0" max="20" name="number_of_children"
                                   id="number_of_children" value="{{$user->teacher->number_of_children}}"
                                   class="form-control input-married input-married-yes  @error('number_of_children') is-invalid @enderror" disabled/>
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
                               for="phone_f">{{__('web/public.phone_f')}} : <span class="required">*</span></label>
                        <div class="col-md-12 col-sm-10">
                            <input type="tel" placeholder="{{__('web/public.example')}} : 09125555555"
                                   pattern="09[0-9]{9}" name="phone_f" id="phone_f"
                                   value="{{$user->teacher->phone_f}}"
                                   class="form-control input-married input-married-no  @error('phone_f') is-invalid @enderror" disabled/>
                            @error('phone_f')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 padding-top-15">
                        <label class="col-md-6 col-sm-6 control-label"
                               for="phone_m">{{__('web/public.phone_m')}} : <span class="required">*</span></label>
                        <div class="col-md-12 col-sm-10">
                            <input type="tel" placeholder="{{__('web/public.example')}} : 09125555555"
                                   pattern="09[0-9]{9}" name="phone_m" id="phone_m"
                                   value="{{$user->teacher->phone_m}}" id="input-name"
                                   class="form-control input-married input-married-no @error('phone_m') is-invalid @enderror" disabled/>
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
                               for="phone_1">{{__('web/public.phone_1')}} : <span class="required">*</span></label>
                        <div class="col-md-12 col-sm-10">
                            <input type="tel" placeholder="{{__('web/public.example')}} : 09125555555"
                                   pattern="09[0-9]{9}" name="phone_1" id="phone_1"
                                   value="{{$user->teacher->phone_1}}"
                                   class="form-control  @error('phone_1') is-invalid @enderror" required disabled/>
                            <span> ({{__('web/public.phone_1_help_2')}})</span>
                            @error('phone_1')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 padding-top-15">
                        <label class="col-md-6 col-sm-6 control-label"
                               for="phone_2">{{__('web/public.phone_2')}} :</label>
                        <div class="col-md-12 col-sm-10">
                            <input type="tel" placeholder="{{__('web/public.example')}} : 09125555555"
                                   pattern="09[0-9]{9}" name="phone_2" id="phone_2"
                                   value="{{$user->teacher->phone_2}}" id="input-name"
                                   class="form-control  @error('phone_2') is-invalid @enderror" disabled/>
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
                        <label class="col-md-6 col-sm-6 control-label" for="tel">{{__('web/public.tel')}} :
                            <span class="required">*</span></label>
                        <div class="col-md-12 col-sm-10">
                            <input type="tel" name="tel" id="tel"
                                   placeholder="{{__('web/public.example')}} : 02122334455"
                                   value="{{$user->teacher->tel}}"
                                   class="form-control  @error('tel') is-invalid @enderror"  disabled/>
                            @error('tel')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 padding-top-15">
                        <label class="col-md-6 col-sm-6 control-label"
                               for="email">{{__('web/public.email')}} :</label>
                        <div class="col-md-12 col-sm-10">
                            <input type="email" name="email" id="email" value="{{$user->teacher->email}}"
                                   class="form-control  @error('email') is-invalid @enderror" disabled/>
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
                               for="province">{{__('web/public.province')}} : <span
                                    class="required">*</span></label>
                        <div class="col-md-12 col-sm-10">
                            <select name='province' class='form-control' id="select-province" required disabled>
                                <option value="0" selected
                                        disabled>{{__('web/public.select_option')}}</option>
                                @foreach ($provinces as $item)
                                    <option value="{{$item->id}}" class="option-province"
                                            id="option-province-id" @php if($user->teacher->province==$item->id) echo "selected"; @endphp>{{$item->name}}</option>
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
                        <label class="col-md-6 col-sm-6 control-label" for="city">{{__('web/public.city')}}
                            : <span class="required">*</span></label>
                        <div class="col-md-12 col-sm-10">
                            <select name='city' class='form-control' id="select-city" required disabled>
                                <option value="0" selected
                                        disabled>{{__('web/public.select_option')}}</option>
                                @foreach ($cities as $item)
                                    <option value="{{$item->id}}"
                                            class="option-city option-city-{{$item->province_id}}"
                                            id="option-city-{{$item->id}}" @php if($user->teacher->city==$item->id) echo "selected"; @endphp>{{$item->name}}</option>
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
                               for="address">{{__('web/public.address')}} : <span class="required">*</span></label>
                        <div class="col-md-12 col-sm-10">
                            <input type="text" name="address" id="address" value="{{$user->teacher->address}}"
                                   class="form-control  @error('address') is-invalid @enderror" required disabled/>
                            @error('address')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 padding-top-15">
                        <label class="col-md-6 col-sm-6 control-label"
                               for="post_number">{{__('web/public.post_number')}} : <span
                                    class="required">*</span></label>
                        <div class="col-md-12 col-sm-10">
                            <input type="text" name="post_number" id="post_number"
                                   value="{{$user->teacher->post_number}}" id="input-name"
                                   class="form-control  @error('post_number') is-invalid @enderror"
                                   required disabled/>
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
                               for="education">{{__('web/public.education')}} : <span
                                    class="required">*</span></label>
                        <div class="col-md-12 col-sm-10">
                            <input type="text" name="education" id="education" value="{{$user->teacher->education}}"
                                   class="form-control  @error('education') is-invalid @enderror" required disabled/>
                            @error('education')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 padding-top-15">
                        <label class="col-md-6 col-sm-6 control-label" for="job">{{__('web/public.job')}} :
                            <span class="required">*</span></label>
                        <div class="col-md-12 col-sm-10">
                            <input type="text" name="job" id="job" value="{{$user->teacher->job}}" id="input-name"
                                   class="form-control  @error('job') is-invalid @enderror" required disabled/>
                            @error('job')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <br><br>


            </form>
        </div>

    </section>






@endsection


