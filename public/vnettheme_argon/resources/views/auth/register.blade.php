@extends('auth.layouts')
@section('title', trans('register.title'))
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
                                <div class="text-muted text-center mt-2 mb-3"><h2>{{trans('login.register')}}</h2></div>
                                <div class="btn-wrapper text-center">
                                    <a href="/" class="btn btn-neutral btn-icon">
                                        <span class="btn-inner--icon"></span>
                                        <span class="btn-inner--text">{{trans('login.title')}}</span>
                                    </a>
                                    <a href="/resetPassword" class="btn btn-neutral btn-icon">
                                        <span class="btn-inner--icon"></span>
                                        <span class="btn-inner--text">{{trans('login.forget_password')}}</span>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body px-lg-5 py-lg-5">
                                <form class="register-form" id="register-form" action="/register" method="post">
                                    @if(\App\Components\Helpers::systemConfig()['is_register'])
                                        <input type="hidden" name="register_token"
                                               value="{{Session::get('register_token')}}"/>
                                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                        <input type="hidden" name="aff" value="{{Session::get('register_aff')}}"/>
                                            @if(\App\Components\Helpers::systemConfig()['is_register_type'] == 2)
                                                <div class="form-group">
                                                    <div class="input-group input-group-merge mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                        class="ni ni-email-83"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control"
                                                               placeholder="{{trans('register.username_placeholder')}}"
                                                               name="username" id="username"
                                                               value="{{Request::old('username')}}">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1">@</span>
                                                        </div>
                                                        <select class="input-group-append" name="domain" id="domain">
                                                            @foreach(\App\Components\Helpers::whiteDomains() as $vo)
                                                                <option value="{{'@' . $vo->words}}">{{ $vo->words}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="form-group">
                                                    <div class="input-group input-group-alternative mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                        class="ni ni-email-83"></i></span>
                                                        </div>
                                                        <input class="form-control"
                                                               placeholder="{{trans('register.username_placeholder')}}"
                                                               type="email" name="username" id="username"
                                                               value="{{Request::old('username')}}" required>
                                                    </div>
                                                </div>
                                            @endif

                                        @if(\App\Components\Helpers::systemConfig()['is_verify_register'])
                                            <div class="form-group">
                                                <div class="input-group input-group-alternative mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                    class="ni ni-key-25"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" placeholder="验证码"
                                                           aria-label="" name="verify_code"
                                                           value="{{Request::old('verify_code')}}">
                                                    <div class="input-group-append">
                                                        <input type="button" class="btn btn-primary" id="sendCode"
                                                               value="验证码" style="float:right;"
                                                               onclick="sendVerifyCode()">
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="form-group">
                                            <div class="input-group input-group-alternative">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                                class="ni ni-lock-circle-open"></i></span>
                                                </div>
                                                <input class="form-control" placeholder="{{trans('register.password')}}"
                                                       type="password" name="password" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group input-group-alternative">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                                class="ni ni-lock-circle-open"></i></span>
                                                </div>
                                                <input class="form-control"
                                                       placeholder="{{trans('register.retype_password')}}"
                                                       type="password" name="repassword" required>
                                            </div>
                                        </div>
                                        @if(\App\Components\Helpers::systemConfig()['is_invite_register'])
                                            <div class="form-group">
                                                <div class="input-group input-group-alternative">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                    class="ni ni-glasses-2"></i></span>
                                                    </div>
                                                    <input class="form-control placeholder-no-fix" type="text"
                                                           autocomplete="off" placeholder="{{trans('register.code')}}"
                                                           name="code"
                                                           value="{{Request::old('code') ? Request::old('code') : Request::get('code')}}"
                                                           @if(\App\Components\Helpers::systemConfig()['is_invite_register'] == 2) required @endif />
                                                </div>
                                            </div>
                                            @if(\App\Components\Helpers::systemConfig()['is_free_code'])
                                                <p class="hint">
                                                    <a href="/free"
                                                                   target="_blank">{{trans('register.get_free_code')}}</a>
                                                </p>
                                            @endif
                                        @endif
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
                                        <div class="row my-4">
                                            <div class="col-12">
                                                <div class="custom-control custom-control-alternative custom-checkbox">
                                                    <input class="custom-control-input" id="customCheckRegister"
                                                           type="checkbox" checked disabled/>
                                                    <label class="custom-control-label" for="customCheckRegister">
                                                        <span class="text-muted">{{trans('register.tnc_button')}}<a
                                                                    href="#" data-toggle="modal"
                                                                    data-target="#tos_modal"> {{trans('register.tnc_link')}} </a></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="alert alert-danger">
                                            <span> {{trans('register.register_alter')}} </span>
                                        </div>
                                    @endif
                                    @if(\App\Components\Helpers::systemConfig()['is_register'])
                                        <div class="text-center">
                                            <button type="submit"
                                                    class="btn btn-primary my-4">{{trans('register.submit')}}</button>
                                        </div>
                                    @endif
                                </form>
                            </div>
                        </div>
                        <div class="row mt-3">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="modal fade" id="tos_modal" tabindex="-1" role="dialog" aria-labelledby="modal-notification"
             aria-hidden="true">
            <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                <div class="modal-content bg-gradient-danger">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-title-notification">服务条款</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="py-3">
                            {!! trans('register.tnc_content') !!}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white"
                                data-dismiss="modal">{{trans('register.tnc_button')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('script')
    <script>
        // 发送注册验证码
        function sendVerifyCode() {
            var flag = true; // 请求成功与否标记
            var username = $("#username").val();
            var domain = $("#domain option:selected").val();
            if (username == '' || username == undefined) {
                ERR("请填入邮箱");
                return false;
            }

            // 白名单模式下拼邮箱地址
            @if(\App\Components\Helpers::systemConfig()['is_register_type'] == 2)
                username = username + domain;
            @endif

            $.ajax({
                type: "POST",
                url: "/sendCode",
                async: false,
                data: {_token: '{{csrf_token()}}', username: username},
                dataType: 'json',
                success: function (ret) {
                    if (ret.status == 'fail') {
                        ERR(ret.message);
                        $("#sendCode").attr('disabled', false);
                        flag = false;
                    } else {
                        OK('验证码已发送至您的邮箱，请稍作等待或查看垃圾箱');
                        $("#sendCode").attr('disabled', true);
                        flag = true;
                    }
                },
                error: function (ret) {
                    ERR("请求异常，请刷新页面重试");
                    flag = false;
                }
            });
// 请求成功才开始倒计时
            if (flag) {
// 60秒后重新发送
                var left_time = 60;
                var tt = window.setInterval(function () {
                    left_time = left_time - 1;
                    if (left_time <= 0) {
                        window.clearInterval(tt);
                        $("#sendCode").attr('disabled', false).val('发送');
                    } else {
                        $("#sendCode").val(left_time);
                    }
                }, 1000);
            }
        }

        $('#register-form').submit(function (event) {
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
            if (!clear) $('.register-form .alert').remove();
            var typeClass = 'alert-danger',
                clear = clear ? clear : false,
                $elem = $('.register-form');
            type === 'error' ? typeClass = 'alert-danger' : typeClass = 'alert-success';
            var tpl = '<div class="alert ' + typeClass + '">' +
                '<button type="button" class="close" onclick="$(this).parent().remove();"></button>' +
                '<span> ' + msg + ' </span></div>';
            if (!clear) {
                $elem.prepend(tpl);
            } else {
                $('.register-form .alert').remove();
            }
        }
    </script>
    @if($errors->any())
        <script type="text/javascript">
            ERR(" {!!$errors->first()!!}");
        </script>
    @endif
@endsection