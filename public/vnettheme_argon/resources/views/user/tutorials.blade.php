@extends('user.layouts')
@section('css')
@endsection
@section('content')
    <div class="header bg-gradient-{{config('theme.bg_color')}} pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">{{\App\Components\Helpers::systemConfig()['website_name']}}</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{trans('home.tutorials')}}</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        <a href="javascript:history.back();" class="btn btn-sm btn-neutral">&laquo;</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card shadow bg-gradient-{{config('theme.tutorials_color')}}">
                    <div class="card-body">
                        <div class="container">
                            <div class="row row-grid align-items-center">
                                <div class="col-md-6 order-lg-2 ml-lg-auto">
                                    <div class="position-relative pl-md-5">
                                        <br><br>
                                        <img src="/argon/img/svg/help.svg" class="img-center img-fluid">
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
                                            <h4 class="display-3 text-white">{{trans('home.tutorials')}}</h4>
                                            <p class="text-white">在这里，你可能会获得一些意想不到的收获……</p>
                                        </div>
                                    </div>
                                    @foreach($articleList as $key => $article)
                                        @if (!config('theme.tutorials_show'))
                                            @if ($article->id != config('theme.windows_id') && $article->id != config('theme.ios_id') && $article->id != config('theme.android_id') && $article->id != config('theme.mac_id') && $article->id != config('theme.linux_id'))
                                                <div class="card shadow shadow-lg--hover mt-5">
                                                    <div class="card-body">
                                                        <div class="d-flex px-3">
                                                            <div>
                                                                <div class="icon icon-shape bg-gradient-success rounded-circle text-white">
                                                                    <i class="ni ni-satisfied"></i>
                                                                </div>
                                                            </div>
                                                            <div class="pl-4">
                                                                <h5 class="title text-success">{{str_limit($article->title, 300)}}</h5>
                                                                <p>{{empty($article->summary) ? '此文章无简介' : $article->summary}} </p>
                                                                <a href="/article/{{$article->id}}"
                                                                   class="btn btn-primary">阅读全文</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @else
                                            <div class="card shadow shadow-lg--hover mt-5">
                                                <div class="card-body">
                                                    <div class="d-flex px-3">
                                                        <div>
                                                            <div class="icon icon-shape bg-gradient-success rounded-circle text-white">
                                                                <i class="ni ni-satisfied"></i>
                                                            </div>
                                                        </div>
                                                        <div class="pl-4">
                                                            <h5 class="title text-success">{{str_limit($article->title, 300)}}</h5>
                                                            <p>{{empty($article->summary) ? '此文章无简介' : $article->summary}} </p>
                                                            <a href="/article/{{$article->id}}"
                                                               class="btn btn-primary">阅读全文</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                    <br><br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection