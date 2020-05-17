@extends('auth.layouts')
@section('title', trans('home.reset_password_title'))
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
                                <div class="text-muted text-center mt-2 mb-3"><h2>设置新密码</h2></div>
                                <div class="btn-wrapper text-center">
                                    <a href="/" class="btn btn-neutral btn-icon">
                                        <span class="btn-inner--icon"></span>
                                        <span class="btn-inner--text">{{trans('login.title')}}</span>
                                    </a>
                                    <a href="/register" class="btn btn-neutral btn-icon">
                                        <span class="btn-inner--icon"></span>
                                        <span class="btn-inner--text">{{trans('login.register')}}</span>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body px-lg-5 py-lg-5">

                                <form class="register-form" action="{{url(Request::getRequestUri())}}" method="post"
                                      style="display: block;">
                                    @if ($verify->status > 0 && count($errors) <= 0 && empty(Session::get('successMsg')))
                                        <div class="alert alert-danger">
                                            <span> 该链接已失效 </span>
                                        </div>
                                    @else
                                        <div class="form-group">
                                            <div class="input-group input-group-alternative">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                                class="ni ni-lock-circle-open"></i></span>
                                                </div>
                                                <input class="form-control placeholder-no-fix" type="password"
                                                       autocomplete="off" placeholder="密码" name="password" value=""
                                                       required/>
                                                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group input-group-alternative">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                                class="ni ni-lock-circle-open"></i></span>
                                                </div>
                                                <input class="form-control placeholder-no-fix" type="password"
                                                       autocomplete="off" placeholder="重复密码" name="repassword" value=""
                                                       required/>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="form-actions">
                                        @if ($verify->status == 0)
                                            <div class="text-center">
                                                <button type="submit"
                                                        class="btn btn-primary my-4">{{trans('register.submit')}}</button>
                                            </div>
                                        @endif
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
    @if(Session::get('successMsg'))
        <script>
            OK("{{Session::get('successMsg')}}");
        </script>
    @endif
    @if($errors->any())
        <script>
            ERR("{{$errors->first()}}");
        </script>
    @endif
@endsection