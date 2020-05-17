@extends('user.layouts')
@section('css')
@endsection
@section('content')
    <div class="header pb-6 d-flex align-items-center"
         style="min-height: 200px; background-image: url(/argon/img/theme/profile-cover.jpg); background-size: cover; background-position: center top;">
        <!-- Mask -->
        <span class="mask bg-gradient-default opacity-8"></span>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-xl-4 order-xl-2">
                <div class="card card-profile">
                    <img src="/argon/img/theme/img-01-1000x600.jpg" alt="Image placeholder" class="card-img-top">
                    <div class="row justify-content-center">
                        <div class="col-lg-3 order-lg-2">
                            <div class="card-profile-image">
                                <a href="#">
                                    <img src="/argon/img/theme/team-1-800x800.jpg" class="rounded-circle">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                        <div class="d-flex justify-content-between">
                            <a href="/" class="btn btn-sm btn-info mr-4">{{trans('home.home')}}</a>
                            <a href="/nodeList"
                               class="btn btn-sm btn-default float-right">{{trans('home.my_service')}}</a>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col">
                                <div class="card-profile-stats d-flex justify-content-center">
                                    <div>
                                        <span class="heading">{{flowAutoShow(Auth::user()->transfer_enable)}}</span>
                                        <span class="description">{{trans('home.account_total_traffic')}}</span>
                                    </div>
                                    <div>
                                        <span class="heading">{{flowAutoShow(Auth::user()->u + Auth::user()->d)}}</span>
                                        <span class="description">{{trans('home.account_bandwidth_usage')}}</span>
                                    </div>
                                    <div>
                                        <span class="heading">{{Auth::user()->credit}}元</span>
                                        <span class="description">{{trans('home.account_balance')}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <h5 class="h3">{{Auth::user()->username}}</h5>
                            <div class="h5 mt-4">
                                <i class="ni business_briefcase-24 mr-2"></i>{{trans('home.referral_my_link')}}
                                - {{\App\Components\Helpers::systemConfig()['website_url']}}
                                /register?aff={{Auth::user()->code}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 order-xl-1">
                <div class="row">
                    <div class="col-lg-6">
                        <a onclick="S_a();">
                            <div class="card bg-gradient-info border-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-0 text-white"> {{trans('home.password')}}</h5>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-white text-dark rounded-circle shadow">
                                                <i class="fa fa-key"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-6">
                        <a onclick="S_b();">
                            <div class="card bg-gradient-danger border-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-0 text-white">{{trans('home.contact')}}</h5>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-white text-dark rounded-circle shadow">
                                                <i class="fa fa-address-card"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="" id="a_page">
                    <form action="/profile" method="post" enctype="multipart/form-data" class="form-bordered">
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <h3 class="mb-0">{{trans('home.password')}} </h3>
                                    </div>
                                    <div class="col-4 text-right">
                                        <button type="submit"
                                                class="btn btn-sm btn-primary">{{trans('home.submit')}}</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label">{{trans('home.current_password')}}</label>
                                                <input type="password" class="form-control" name="old_password"
                                                       id="old_password" autofocus required/>
                                                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label">{{trans('home.new_password')}}</label>
                                                <input type="password" class="form-control" name="new_password"
                                                       id="new_password" required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="" id="b_page" style="display: none">
                    <form action="/profile" method="post" enctype="multipart/form-data" class="form-bordered">
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <h3 class="mb-0">{{trans('home.contact')}} </h3>
                                    </div>
                                    <div class="col-4 text-right">
                                        <button type="submit"
                                                class="btn btn-sm btn-primary">{{trans('home.submit')}}</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="form-control-label">{{trans('home.gender')}}</label>
                                                <div class="mt-radio-inline">
                                                    <label class="mt-radio">
                                                        <input type="radio" name="gender"
                                                               value="1" {{Auth::user()->gender ? 'checked' : ''}}>
                                                        男
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-radio">
                                                        <input type="radio" name="gender"
                                                               value="0" {{!Auth::user()->gender ? 'checked' : ''}}>
                                                        女
                                                        <span></span>
                                                    </label>
                                                </div>
                                                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label">联系电话</label>
                                                <input type="text" class="form-control" name="phone"
                                                       value="{{Auth::user()->phone}}" id="phone" required/>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label">{{trans('home.wechat')}}</label>
                                                <input type="text" class="form-control" name="wechat"
                                                       value="{{Auth::user()->wechat}}" id="wechat" required/>
                                                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label"> QQ </label>
                                                <input type="text" class="form-control" name="qq"
                                                       value="{{Auth::user()->qq}}"
                                                       id="qq" required/>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label"> {{trans('home.address')}} </label>
                                                <input type="text" class="form-control" name="address"
                                                       value="{{Auth::user()->address}}" id="address"
                                                       autocomplete="off"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    @if (Session::has('successMsg'))
        <script>
            OK("{{Session::get('successMsg')}}");
        </script>
    @endif
    @if($errors->any())
        <script>
            ERR("{{$errors->first()}} ");
        </script>
    @endif
@endsection