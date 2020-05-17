@extends('auth.layouts')
@section('title', trans('login.title'))
@section('css')
@endsection
@section('content')
    <main>
        <div class="" id="b_page" style="display: none">
            <section class="section section-shaped section-lg">
                <div class="shape shape-style-1 bg-gradient-{{config('theme.bg_color')}}">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <div class="container pt-lg-md">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card bg-secondary shadow border-0">
                                <div class="card-header bg-white pb-5">
                                    <div class="text-muted text-center mt-2 mb-3"><h2>{{trans('login.title')}}</h2>
                                    </div>
                                    <div class="btn-wrapper text-center">
                                        <a href="/register" class="btn btn-neutral btn-icon">
                                            <span class="btn-inner--icon"></span>
                                            <span class="btn-inner--text">{{trans('login.register')}}</span>
                                        </a>
                                        <a href="/resetPassword" class="btn btn-neutral btn-icon">
                                            <span class="btn-inner--icon"></span>
                                            <span class="btn-inner--text">{{trans('login.forget_password')}}</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body px-lg-5 py-lg-5">
                                    <form role="form" action="/login" id="login-form" method="post">
                                        <div class="form-group mb-3">
                                            <div class="input-group input-group-alternative">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                                </div>
                                                <input class="form-control" type="text" autocomplete="off"
                                                       placeholder="{{trans('login.username')}}" name="username"
                                                       value="{{Request::old('username')}}" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group input-group-alternative">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                                class="ni ni-lock-circle-open"></i></span>
                                                </div>
                                                <input class="form-control" type="password" autocomplete="off"
                                                       placeholder="{{trans('login.password')}}" name="password"
                                                       value="{{Request::old('password')}}" required>
                                                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                            </div>
                                        </div>
                                        @switch(\App\Components\Helpers::systemConfig()['is_captcha'])
                                            @case(2)
                                            <div class="form-group">
                                                {!! Geetest::render() !!}
                                            </div>
                                            @break
                                            @case(3)
                                        <!-- Google reCaptcha -->
                                            <div class="form-group">
                                                {!! NoCaptcha::display() !!}
                                                {!! NoCaptcha::renderJs(session::get('locale')) !!}
                                            </div>
                                            @break
                                            @case(4)
                                        <!-- hCaptcha -->
                                            <div class="form-group">
                                                {!! HCaptcha::display() !!}
                                                {!! HCaptcha::renderJs(session::get('locale')) !!}
                                            </div>
                                            @break
                                            @case(1)
                                            <div class="form-group">
                                                <div class="input-group input-group-alternative">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                    class="ni ni-key-25"></i></span>
                                                    </div>
                                                    <input class="form-control form-control-solid placeholder-no-fix"
                                                           type="text" autocomplete="off"
                                                           placeholder="{{trans('login.captcha')}}" name="captcha"
                                                           value=""/>
                                                    <div class="input-group-prepend">
                                                        <img src="{{captcha_src()}}"
                                                             onclick="this.src='/captcha/default?'+Math.random()"
                                                             alt="{{trans('login.captcha')}}" style="float:right;"/>
                                                    </div>
                                                </div>
                                            </div>
                                            @break
                                            @default
                                        @endswitch
                                        <div class="custom-control custom-control-alternative custom-checkbox">
                                            <input class="custom-control-input" id=" customCheckLogin" type="checkbox"
                                                   name="remember" value="1">
                                            <label class="custom-control-label" for=" customCheckLogin">
                                                <span class="text-muted">{{trans('login.remember')}}</span>
                                            </label>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit"
                                                    class="btn btn-primary my-4">{{trans('login.login')}}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="row mt-3">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="" id="a_page">
            <div class="position-relative">
                <section class="section section-lg section-shaped pb-250">
                    <div class="shape shape-style-1 bg-gradient-{{config('theme.bg_color')}}">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <div class="container py-lg-md d-flex">
                        <div class="col px-0">
                            <div class="row">
                                <div class="col-lg-7">
                                    <h1 class="display-3  text-white">{{config('theme.header_title_1')}}
                                        <span>{{config('theme.header_title_2')}}</span></h1>
                                    <p class="lead  text-white">{{config('theme.header_content')}}</p>
                                    <div class="btn-wrapper">
                                        <button class="btn btn-info btn-icon mb-3 mb-sm-0" onclick="S_b();">
                                            <span class="btn-inner--icon"><i class="ni ni-circle-08"></i></span>
                                            <span class="btn-inner--text">{{trans('login.title')}}</span>
                                        </button>
                                        <a href="/register" class="btn btn-white btn-icon mb-3 mb-sm-0">
                                            <span class="btn-inner--icon"><i class="ni ni-user-run"></i></span>
                                            <span class="btn-inner--text">{{trans('login.register')}}</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="separator separator-bottom separator-skew">
                        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1"
                             xmlns="http://www.w3.org/2000/svg">
                            <polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
                        </svg>
                    </div>
                </section>
            </div>
            @if (config('theme.show_card_1'))
                <section class="section section-lg pt-lg-0 mt--200">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-12">
                                <div class="row row-grid">
                                    <div class="col-lg-4">
                                        <div class="card card-lift--hover shadow border-0">
                                            <div class="card-body py-5">
                                                <div class="icon icon-shape icon-shape-primary rounded-circle mb-4">
                                                    <i class="ni ni-check-bold"></i>
                                                </div>
                                                <h6 class="text-primary text-uppercase">{{config('theme.card_title_1')}}</h6>
                                                <p class="description mt-3">{{config('theme.card_content_1')}}</p>
                                                <div>
                                                    <span class="badge badge-pill badge-primary">{{config('theme.card_label_1A')}}</span>
                                                    <span class="badge badge-pill badge-primary">{{config('theme.card_label_1B')}}</span>
                                                    <span class="badge badge-pill badge-primary">{{config('theme.card_label_1C')}}</span>
                                                </div>
                                                <a href="/login" class="btn btn-primary mt-4">选择产品</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="card card-lift--hover shadow border-0">
                                            <div class="card-body py-5">
                                                <div class="icon icon-shape icon-shape-success rounded-circle mb-4">
                                                    <i class="ni ni-istanbul"></i>
                                                </div>
                                                <h6 class="text-success text-uppercase">{{config('theme.card_title_2')}}</h6>
                                                <p class="description mt-3">{{config('theme.card_content_2')}}</p>
                                                <div>
                                                    <span class="badge badge-pill badge-success">{{config('theme.card_label_2A')}}</span>
                                                    <span class="badge badge-pill badge-success">{{config('theme.card_label_2B')}}</span>
                                                    <span class="badge badge-pill badge-success">{{config('theme.card_label_2C')}}</span>
                                                </div>
                                                <a href="/login" class="btn btn-success mt-4">选择产品</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="card card-lift--hover shadow border-0">
                                            <div class="card-body py-5">
                                                <div class="icon icon-shape icon-shape-warning rounded-circle mb-4">
                                                    <i class="ni ni-planet"></i>
                                                </div>
                                                <h6 class="text-warning text-uppercase">{{config('theme.card_title_3')}}</h6>
                                                <p class="description mt-3">{{config('theme.card_content_3')}}</p>
                                                <div>
                                                    <span class="badge badge-pill badge-warning">{{config('theme.card_label_3A')}}</span>
                                                    <span class="badge badge-pill badge-warning">{{config('theme.card_label_3B')}}</span>
                                                    <span class="badge badge-pill badge-warning">{{config('theme.card_label_3C')}}</span>
                                                </div>
                                                <a href="/login" class="btn btn-warning mt-4">选择产品</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            @endif
            @if (config('theme.show_card_2'))
                <section class="section section-lg">
                    <div class="container">
                        <div class="row row-grid align-items-center">
                            <div class="col-md-6 order-md-2">
                                <img src="/argon/img/theme/promo.png" class="img-fluid floating">
                            </div>
                            <div class="col-md-6 order-md-1">
                                <div class="pr-md-5">
                                    <div class="icon icon-lg icon-shape icon-shape-success shadow rounded-circle mb-5">
                                        <i class="fa fa-cog fa-spin fa-1x fa-fw"></i>
                                    </div>
                                    <h3>{{config('theme.card_2_title')}}</h3>
                                    <p>{{config('theme.card_2_content')}}</p>
                                    <ul class="list-unstyled mt-5">
                                        <li class="py-2">
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <div class="badge badge-circle badge-success mr-3">
                                                        <i class="ni ni-settings-gear-65"></i>
                                                    </div>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">{{config('theme.card_2_label_A')}}</h6>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="py-2">
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <div class="badge badge-circle badge-success mr-3">
                                                        <i class="ni ni-html5"></i>
                                                    </div>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">{{config('theme.card_2_label_B')}}</h6>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="py-2">
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <div class="badge badge-circle badge-success mr-3">
                                                        <i class="ni ni-satisfied"></i>
                                                    </div>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">{{config('theme.card_2_label_C')}}</h6>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            @endif
            @if (config('theme.show_card_3'))
                <section class="section bg-secondary">
                    <div class="container">
                        <div class="row row-grid align-items-center">
                            <div class="col-md-6">
                                <div class="card bg-default shadow border-0">
                                    <img src="/argon/img/theme/img-01-1200x1000.jpg" class="card-img-top">
                                    <blockquote class="card-blockquote">
                                        <svg preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg"
                                             viewBox="0 0 583 95" class="svg-bg">
                                            <polygon points="0,52 583,95 0,95" class="fill-default"/>
                                            <polygon points="0,42 583,95 683,0 0,95" opacity=".2" class="fill-default"/>
                                        </svg>
                                        <h4 class="display-3 font-weight-bold text-white">{{config('theme.card_3A_title')}}</h4>
                                        <p class="lead text-italic text-white">{{config('theme.card_3A_content')}}</p>
                                    </blockquote>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="pl-md-5">
                                    <div class="icon icon-lg icon-shape icon-shape-warning shadow rounded-circle mb-5">
                                        <i class="ni ni-settings"></i>
                                    </div>
                                    <h3>{{config('theme.card_3_title')}}</h3>
                                    <p class="lead">{{config('theme.card_3_content_1')}}</p>
                                    <p>{{config('theme.card_3_content_2')}}</p>
                                    <a href="#"
                                       class="font-weight-bold text-warning mt-5">{{config('theme.card_3_content_3')}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            @endif
            @if (config('theme.show_card_4'))
                <section class="section pb-0 bg-gradient-warning">
                    <div class="container">
                        <div class="row row-grid align-items-center">
                            <div class="col-md-6 order-lg-2 ml-lg-auto">
                                <div class="position-relative pl-md-5">
                                    <img src="/argon/img/svg/services.svg" class="img-center img-fluid">
                                </div>
                            </div>
                            <div class="col-lg-6 order-lg-1">
                                <div class="d-flex px-3">
                                    <div>
                                        <div class="icon icon-lg icon-shape bg-gradient-white shadow rounded-circle text-primary">
                                            <i class="ni ni-building text-primary"></i>
                                        </div>
                                    </div>
                                    <div class="pl-4">
                                        <h4 class="display-3 text-white">{{config('theme.card_4A_title')}}</h4>
                                        <p class="text-white">{{config('theme.card_4A_content')}}</p>
                                    </div>
                                </div>
                                <div class="card shadow shadow-lg--hover mt-5">
                                    <div class="card-body">
                                        <div class="d-flex px-3">
                                            <div>
                                                <div class="icon icon-shape bg-gradient-success rounded-circle text-white">
                                                    <i class="ni ni-satisfied"></i>
                                                </div>
                                            </div>
                                            <div class="pl-4">
                                                <h5 class="title text-success">{{config('theme.card_4B_title')}}</h5>
                                                <p>{{config('theme.card_4B_content')}}</p>
                                                <a href="/login" class="text-success">了解更多</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card shadow shadow-lg--hover mt-5">
                                    <div class="card-body">
                                        <div class="d-flex px-3">
                                            <div>
                                                <div class="icon icon-shape bg-gradient-warning rounded-circle text-white">
                                                    <i class="ni ni-active-40"></i>
                                                </div>
                                            </div>
                                            <div class="pl-4">
                                                <h5 class="title text-warning">{{config('theme.card_4C_title')}}</h5>
                                                <p>{{config('theme.card_4C_content')}}</p>
                                                <a href="/login" class="text-warning">了解更多</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="separator separator-bottom separator-skew zindex-100">
                        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1"
                             xmlns="http://www.w3.org/2000/svg">
                            <polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
                        </svg>
                    </div>
                </section>
            @endif
            @if (config('theme.show_card_5'))
                <section class="section section-lg">
                    <div class="container">
                        <div class="row justify-content-center text-center mb-lg">
                            <div class="col-lg-8">
                                <h2 class="display-3">{{config('theme.card_5_title')}}</h2>
                                <p class="lead text-muted">{{config('theme.card_5_content')}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-lg-3 mb-5 mb-lg-0">
                                <div class="px-4">
                                    <img src="/argon/img/theme/team-1-800x800.jpg"
                                         class="rounded-circle img-center img-fluid shadow shadow-lg--hover"
                                         style="width: 200px;">
                                    <div class="pt-4 text-center">
                                        <h5 class="title">
                                            <span class="d-block mb-1">{{config('theme.card_5_name_A')}}</span>
                                            <small class="h6 text-muted">{{config('theme.card_5_job_A')}}</small>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3 mb-5 mb-lg-0">
                                <div class="px-4">
                                    <img src="/argon/img/theme/team-2-800x800.jpg"
                                         class="rounded-circle img-center img-fluid shadow shadow-lg--hover"
                                         style="width: 200px;">
                                    <div class="pt-4 text-center">
                                        <h5 class="title">
                                            <span class="d-block mb-1">{{config('theme.card_5_name_B')}}</span>
                                            <small class="h6 text-muted">{{config('theme.card_5_job_B')}}</small>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3 mb-5 mb-lg-0">
                                <div class="px-4">
                                    <img src="/argon/img/theme/team-3-800x800.jpg"
                                         class="rounded-circle img-center img-fluid shadow shadow-lg--hover"
                                         style="width: 200px;">
                                    <div class="pt-4 text-center">
                                        <h5 class="title">
                                            <span class="d-block mb-1">{{config('theme.card_5_name_C')}}</span>
                                            <small class="h6 text-muted">{{config('theme.card_5_job_C')}}</small>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3 mb-5 mb-lg-0">
                                <div class="px-4">
                                    <img src="/argon/img/theme/team-4-800x800.jpg"
                                         class="rounded-circle img-center img-fluid shadow shadow-lg--hover"
                                         style="width: 200px;">
                                    <div class="pt-4 text-center">
                                        <h5 class="title">
                                            <span class="d-block mb-1">{{config('theme.card_5_name_D')}}</span>
                                            <small class="h6 text-muted">{{config('theme.card_5_job_D')}}</small>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            @endif
            @if (config('theme.show_card_6'))
                <section class="section section-lg pt-0">
                    <div class="container">
                        <div class="card bg-gradient-warning shadow-lg border-0">
                            <div class="p-5">
                                <div class="row align-items-center">
                                    <div class="col-lg-8">
                                        <h3 class="text-white">{{config('theme.card_6_title')}}</h3>
                                        <p class="lead text-white mt-3">{{config('theme.card_6_content')}}</p>
                                    </div>
                                    <div class="col-lg-3 ml-lg-auto">
                                        <a href="/login" class="btn btn-lg btn-block btn-white">了解更多</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            @endif
            @if (config('theme.show_card_7'))
                <section class="section section-lg bg-gradient-default">
                    <div class="container pt-lg pb-300">
                        <div class="row text-center justify-content-center">
                            <div class="col-lg-10">
                                <h2 class="display-3 text-white">{{config('theme.card_7_title')}}</h2>
                                <p class="lead text-white">{{config('theme.card_7_content')}}</p>
                            </div>
                        </div>
                        <div class="row row-grid mt-5">
                            <div class="col-lg-4">
                                <div class="icon icon-lg icon-shape bg-gradient-white shadow rounded-circle text-primary">
                                    <i class="ni ni-settings text-primary"></i>
                                </div>
                                <h5 class="text-white mt-3">{{config('theme.card_7A_title')}}</h5>
                                <p class="text-white mt-3">{{config('theme.card_7A_content')}}</p>
                            </div>
                            <div class="col-lg-4">
                                <div class="icon icon-lg icon-shape bg-gradient-white shadow rounded-circle text-primary">
                                    <i class="ni ni-ruler-pencil text-primary"></i>
                                </div>
                                <h5 class="text-white mt-3">{{config('theme.card_7B_title')}}</h5>
                                <p class="text-white mt-3">{{config('theme.card_7B_content')}}</p>
                            </div>
                            <div class="col-lg-4">
                                <div class="icon icon-lg icon-shape bg-gradient-white shadow rounded-circle text-primary">
                                    <i class="ni ni-atom text-primary"></i>
                                </div>
                                <h5 class="text-white mt-3">{{config('theme.card_7C_title')}}</h5>
                                <p class="text-white mt-3">{{config('theme.card_7C_content')}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="separator separator-bottom separator-skew zindex-100">
                        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1"
                             xmlns="http://www.w3.org/2000/svg">
                            <polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
                        </svg>
                    </div>
                </section>
            @endif
            @if (config('theme.show_card_8'))
                <section class="section section-lg">
                    <div class="container">
                        <div class="row row-grid justify-content-center">
                            <div class="col-lg-8 text-center">
                                <h2 class="display-3">{{config('theme.card_8_title_1')}}<span
                                            class="text-success">{{config('theme.card_8_title_2')}}</span></h2>
                                <p class="lead">{{config('theme.card_8_content')}}</p>
                                <div class="btn-wrapper">
                                    <button onclick="S_b();" class="btn btn-primary">
                                        <span class="btn-inner--icon"><i class="ni ni-circle-08"></i></span>
                                        <span class="btn-inner--text">{{trans('login.title')}}</span>
                                    </button>
                                    <a href="/register" class="btn btn-default">
                                        <span class="btn-inner--icon"><i class="ni ni-user-run"></i></span>
                                        <span class="btn-inner--text">{{trans('login.register')}}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            @endif
        </div>
    </main>
@endsection
@section('script')
    <script>

    </script>

    <script>
        $('#login-form').submit(function (event) {
            @switch(\App\Components\Helpers::systemConfig()['is_captcha'])
            @case(3)
            // 先检查Google reCAPTCHA有没有进行验证
            if ( $('#g-recaptcha-response').val() === '' ) {
                Err("{{trans('login.required_captcha')}}");
                return false;
            }
            @break
            @case(4)
            // 先检查Google reCAPTCHA有没有进行验证
            if ( $('#h-captcha-response').val() === '' ) {
                Err("{{trans('login.required_captcha')}}");
                return false;
            }
            @break
            @default
            @endswitch
        });

        // 生成提示
        function Msg(clear, msg, type) {
            if (!clear) $('.login-form .alert').remove();
            var typeClass = 'alert-danger',
                clear = clear ? clear : false,
                $elem = $('.login-form');
            type === 'error' ? typeClass = 'alert-danger' : typeClass = 'alert-success';
            var tpl = '<div class="alert ' + typeClass + '">' +
                '<button type="button" class="close" onclick="$(this).parent().remove();"></button>' +
                '<span> ' + msg + ' </span></div>';
            if (!clear) {
                $elem.prepend(tpl);
            } else {
                $('.login-form .alert').remove();
            }
        }
    </script>
    @if (Session::get('regSuccessMsg'))
        <script>
            OK('{{Session::get('regSuccessMsg')}}');
        </script>
    @endif
    @if($errors->any())
        <script>
            ERR('{!!$errors->first()!!}');
            S_b();
        </script>
    @endif
@endsection