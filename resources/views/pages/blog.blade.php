@extends('layout')

@section('content')

    <!-- Page Starts-->
    <div class="container theme-container pt-70">
        <div class="row">

            {{--BLOG Starts--}}
            <aside class="col-md-12 col-sm-12 single-post margin-after-header">
                <div class="blog-wrap">
                    <div class="blog-img">
                        <a class="img-hover" href="{{ url_blog_page($model->blog->slug, $model->language) }}">
                            <img alt="{{ $model->blog->title }}" src="{{ $model->blog->image->big }}">
                        </a>
                    </div>
                    <div class="blog-page-wrap">
                        <div class="blog-heading">
                            <a class="date" href="{{ url_blog_page($model->blog->slug, $model->language) }}">
                                <span class="font-2 fsz-24">{{ $model->blog->created_at->format('d') }}</span>
                                <b>{{ $model->blog->created_at->formatLocalized('%f') }}</b>
                            </a>
                            <h2 class="blog-title">{{ $model->blog->title }}</h2>
                        </div>
                        <div class="blog-detail">
                            {!! $model->blog->description !!}
                        </div>
                        <div class="row">
                            <div class="col-md-4 ptb-15">
                                <div class="blog-meta">
                                    <ul class="list-inline">
                                        <li>
                                            <a href="{{ url_blog_page($model->blog->slug, $model->language) }}">
                                                <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                                                <b>{{ $model->blog->created_at->format('d-m-Y') }}</b>
                                            </a>
                                        </li>
                                        {{--<li> <a href="#"> <i class="fa fa-comments-o"></i> <b>156</b> </a> </li>--}}
                                        <li>
                                            <a href="{{ url_blog_page($model->blog->slug, $model->language) }}">
                                                <i class="fa fa-eye"></i>
                                                <b>{{ $model->blog->number_of_views }}</b>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- POPULAR BLOGS Starts-->
                    <div class="related-blog">
                        <h2 class="section-title pb-30"> Популярні </h2>
                        <div class="row">
                            @foreach($model->popularBlogs as $popularBlog)
                                <div class="col-md-4">
                                    <div class="blog-wrap img-effect">
                                        <div class="blog-img">
                                            <a class="img-hover" href="blog.htm">
                                                <img alt="{{ $popularBlog->title }}" src="{{ $popularBlog->image->medium }}">
                                            </a>
                                        </div>
                                        <div class="blog-page-wrap">
                                            <div class="blog-heading">
                                                <a href="{{ url_blog_page($popularBlog->slug, $model->language) }}" class="date">
                                                    <span class="font-2 fsz-24">{{ $popularBlog->created_at->format('d') }}</span>
                                                    <b>{{ $popularBlog->created_at->formatLocalized('%f') }}</b>
                                                </a>
                                                <a href="{{ url_blog_page($popularBlog->slug, $model->language) }}" class="blog-title">
                                                    {{ $popularBlog->title }}
                                                </a>
                                                {{--<a class="blog-title" href="blog-single.htm"> SUSTAINABLE STYLE: JUST LOVELY HANDBAGS </a>--}}
                                            </div>
                                            <div class="blog-detail pt-25">
                                                <p>
                                                    {{ $popularBlog->short_description }}
                                                </p>
                                            </div>
                                            <div class="blog-meta">
                                                <ul class="list-inline">
                                                    <li>
                                                        <a href="{{ url_blog_page($popularBlog->slug, $model->language) }}">
                                                            <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                                                            <b>{{ $popularBlog->created_at->format('d-m-Y') }}</b>
                                                        </a>
                                                    </li>
                                                    {{--<li> <a href="#"> <i class="fa fa-comments-o"></i> <b>156</b> </a> </li>--}}
                                                    <li>
                                                        <a href="{{ url_blog_page($popularBlog->slug, $model->language) }}">
                                                            <i class="fa fa-eye"></i>
                                                            <b>{{ $popularBlog->number_of_views }}</b>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- / POPULAR BLOGS Ends -->
                </div>
            </aside>
        </div>
    </div>
    <!-- / Page Ends -->

@endsection