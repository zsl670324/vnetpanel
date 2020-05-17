@extends('auth.layouts')
@section('title', trans('login.forget_password'))
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
                                <div class="text-muted text-center mt-2 mb-3">
                                    <h2>{{trans('login.forget_password')}}</h2></div>
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
                                <form class="forget-form" action="/resetPassword" method="post" style="display: block;">
                                    @if(\App\Components\Helpers::systemConfig()['is_reset_password'])
                                        <div class="form-group">
                                            <div class="input-group input-group-alternative">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                                </div>
                                                <input class="form-control placeholder-no-fix" type="text"
                                                       autocomplete="off"
                                                       placeholder="{{trans('home.username_placeholder')}}"
                                                       name="username" value="{{Request::old('username')}}" required
                                                       autofocus/>
                                                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                            </div>
                                        </div>
                                    @else
                                        <div class="alert alert-danger">
                                            <span> {{trans('home.system_down')}} </span>
                                        </div>
                                    @endif
                                    @if(\App\Components\Helpers::systemConfig()['is_reset_password'])
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
    </main>
@endsection
@section('script')
    @if (Session::get('successMsg'))
        <script>
            OK("{{Session::get('successMsg')}} ");
        </script>
    @endif
    @if($errors->any())
        <script>
            ERR("{!!$errors->first()!!}");
        </script>
    @endif
@endsection