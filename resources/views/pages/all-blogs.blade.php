@extends('layout')

@section('content')

    <!-- CONTENT AREA -->
    <article>


        <!-- Page Starts-->
        <div class="blogs-list">
            <div class="container">
                <div class="title-wrap pb-20">
                    <div class="my_title_link my_title_link_blogs">
                        <h2 class="section-title"> Блоги </h2>
                    </div>
                </div>
                <div class="row">
                    @foreach($model->blogs as $blog)
                        <div class="col-md-4">
                            <div class="blog-wrap img-effect">
                                <div class="blog-img">
                                    <a href="{{ url_blog_page($blog->slug, $model->language) }}" class="img-hover">
                                        <img src="{{ $blog->image->medium }}" alt="{{ $blog->title }}">
                                    </a>
                                </div>
                                <div class="blog-page-wrap">
                                    <div class="blog-heading">
                                        <a href="{{ url_blog_page($blog->slug, $model->language) }}" class="date">
                                            <span class="font-2 fsz-24">{{ $blog->created_at->format('d') }}</span>
                                            <b>{{ $blog->created_at->formatLocalized('%f') }}</b>
                                        </a>
                                        <a href="{{ url_blog_page($blog->slug, $model->language) }}" class="blog-title">
                                            {{ $blog->title }}
                                        </a>
                                    </div>
                                    <div class="blog-detail">
                                        <p>
                                            {{ $blog->short_description }}
                                        </p>
                                    </div>
                                    <div class="blog-meta">
                                        <ul class="list-inline">
                                            <li>
                                                <a href="{{ url_blog_page($blog->slug, $model->language) }}">
                                                    <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                                                    <b>{{ $blog->created_at->format('d-m-Y') }}</b>
                                                </a>
                                            </li>
                                            {{--<li> <a href="#"> <i class="fa fa-comments-o"></i> <b>156</b> </a> </li>--}}
                                            <li>
                                                <a href="{{ url_blog_page($blog->slug, $model->language) }}">
                                                    <i class="fa fa-eye"></i>
                                                    <b>{{ $blog->number_of_views }}</b>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                @include('partial.all-blogs-page.pagination')

                {{--<div class="block-inline pagination-wrap text-center">--}}
                    {{--<ul class="pagination-1">--}}
                        {{--<li class="prv"> <a href="#"> <i class="fa fa-long-arrow-left"></i> </a> </li>--}}
                        {{--<li> <a href="#" class="active"> 1 </a> </li>--}}
                        {{--<li> <a href="#"> 2 </a> </li>--}}
                        {{--<li> <a href="#"> 3 </a> </li>--}}
                        {{--<li class="nxt"> <a href="#"> <i class="fa fa-long-arrow-right"></i> </a> </li>--}}
                    {{--</ul>--}}
                {{--</div>--}}
            </div>
        </div>
        <!-- / Page Ends -->


    </article>
    <!-- / CONTENT AREA -->

@endsection