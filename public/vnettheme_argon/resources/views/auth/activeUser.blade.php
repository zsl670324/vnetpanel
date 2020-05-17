@extends('auth.layouts')
@section('title', trans('active.title'))
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
                                    <h2>{{trans('active.title')}}</h2></div>
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
                                <form class="forget-form" action="/activeUser" method="post" style="display: block;">
                                    @if(\App\Components\Helpers::systemConfig()['is_active_register'])
                                        <div class="form-group mb-3">
                                            <div class="input-group input-group-alternative">
                                                <input class="form-control placeholder-no-fix" type="text"
                                                       autocomplete="off"
                                                       placeholder="{{trans('active.username_placeholder')}}"
                                                       name="username"
                                                       value="{{Request::get('username')}}" required/>
                                                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                            </div>
                                        </div>
                                    @else
                                        <div class="alert alert-danger">
                                            <span> {{trans('active.tips')}} </span>
                                        </div>
                                    @endif
                                    @if(\App\Components\Helpers::systemConfig()['is_active_register'])
                                        <div class="text-center">
                                            <button type="submit"
                                                    class="btn btn-primary my-4">{{trans('active.submit')}}</button>
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
    @if (Session::get('SuccessMsg'))
        <script>
            OK("{{Session::get('SuccessMsg')}}");
        </script>
    @endif
    @if($errors->any())
        <script>
            ERR("{!!$errors->first()!!}");
        </script>
    @endif
@endsection