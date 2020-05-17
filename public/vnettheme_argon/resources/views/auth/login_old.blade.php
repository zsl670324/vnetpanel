@extends('auth.layouts')
@section('title', trans('login.title'))
@section('css')
@endsection
@section('content')
    <main>
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
    </main>
@endsection
@section('script')
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
            OK("{{Session::get('regSuccessMsg')}}");
        </script>
    @endif
    @if($errors->any())
        <script>
            ERR('{!!$errors->first()!!}');
        </script>
    @endif
@endsection