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
                                <form role="form" action="{{url(Request::getRequestUri())}}" method="post">
                                    <div class="text-center">
                                        <button type="button" class="btn btn-primary my-4"
                                                onclick="login()">{{trans('active.login_button')}}</button>
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
    @if(Session::get('errorMsg'))
        <script>
            ERR("{{Session::get('errorMsg')}}");
        </script>
    @endif
    @if(Session::get('successMsg'))
        <script>
            OK("{{Session::get('successMsg')}}");
        </script>
    @endif
@endsection