@extends('layouts.app')
@section('custom-style')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="/vendor/flexslider/flexslider.css">
@endsection
@section('title',$title_obj)

@section('meta_tags')
    @if($post)
        <meta name='description' itemprop='description' content='{{ str_limit($post->post_description,168,'...')}}' />
        <meta name='keywords' content='{{$post->post_name}}' />
        <meta property='article:published_time' content='{{$post->created_at}}' />

        <meta property="og:url"                content="{{ url()->current() }}" />
        <meta property="og:type"               content="article" />
        <meta property="og:title"              content="{{ $post->post_name }}" />
        <meta property="og:description"        content="{!! str_limit($post->description, 168,'...') !!}" />
        @foreach($post->Images() as $image)
            <meta property="og:image" content="{{ asset($image->full_url) }}" />
        @endforeach
        <meta property="og:image"              content="{{ asset($post->feature_image) }}" />

        <meta name="twitter:card" content="summary" />
        <meta name="twitter:title" content="{{$post->post_name}}" />
        <meta name="twitter:site" content="@KhanVuthy" />
    @endif
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 top-adds">
                <img src="{{ asset('images/adds/ai.gif') }}">
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">

            <div class="col-md-9">
                <div class="custom-bread">
               
                    {{ Breadcrumbs::render('posts',$post) }}
                    
                </div>
                <div class="row">
                    @foreach($posts as $post)
                        <div class="col-md-12 post">
                            <div class="flexslider" id="carouselExampleIndicators">
                              <ul class="slides">
                                @foreach($post->Images as $image)
                                    <li class="item">
                                        <img alt="{{ $post->post_name }}" class="d-block middle" src="{{ asset($image->full_url) }}">
                                    @endforeach
                              </ul>
                            </div>
                            

                            <div class="card">
                                <div class="card-body">
                                    <h1 class="entry-title">
                                        {{ $post->post_name }}
                                    </h1>
                                    <p>
                                        {!! $post->post_description !!}
                                    </p>
                                </div>
                                <div class="card-footer">
                                    <span class="float-left">
                                        <i class="fas fa-map-marked-alt"></i>
                                        @if(Session::get('locale')==='en')
                                            <a href="{{ route('post.location',$post->Location->l_slug) }}">
                                                {{ $post->Location->l_en_name }}
                                            </a>
                                        @else
                                            <a href="{{ route('post.location',$post->Location->l_slug) }}">
                                                {{ $post->Location->l_zh_name }}
                                            </a>
                                        @endif
                                        | 
                                        <i class="far fa-folder-open"></i>
                                        <a href="{{ route('post.category',$post->Category->cate_slug) }}">
                                            @if(Session::get('locale')==='en')
                                                {{ $post->Category->cate_en_name }}
                                            @else
                                                {{ $post->Category->cate_zh_name }}
                                            @endif
                                        </a>
                                    </span>
                                    <span class="float-right"><i class="fas fa-heart"></i></span>
                                </div>
                            </div>                           
                            
                        </div>  
                    @endforeach
                    @include('frontend.includes._author',[$post_auth])
                    <div class="col-md-12">
                        <div class="related_post">
                            <h2 class="entry-title">Related Posts</h2>
                            <div class="row">
                                @foreach($related_post as $post)
                                    <div class="col-md-4 post">
                                        <div class="card">
                                            <div class="card-image">
                                                <img class="middle" src="{{ asset($post->feature_image) }}">
                                            </div>
                                            <div class="card-body">
                                                <h2 class="entry-title">
                                                    <a href="{{ route('post.single',$post->post_slug) }}"> {{ $post->post_name }}</a>
                                                </h2>
                                                <p>
                                                    <?php echo str_limit($post->post_description, 50, ' (...)'); ?>
                                                </p>
                                            </div>
                                            <div class="card-footer">
                                                <span class="float-left">${{ $post->price }}</span>
                                                <span class="float-right"><i class="fas fa-heart"></i></span>
                                            </div>
                                        </div>
                                    </div>  
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>  

            <div class="col-md-3">
                <div class="add-sitebar">
                    <img class="img-fluid" src="{{ asset('images/adds/photo_2018-08-26_15-43-58.jpg') }}">
                </div>
                @include('frontend.includes._sitebar',[$categories])
            </div>

        </div>
    </div>
@endsection
@section('custom-script')
    <script type="text/javascript" src="/vendor/flexslider/jquery.flexslider-min.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($){
            $('.flexslider').flexslider({
                animation: "slide",
                controlNav: false
            });
        });
    </script>
    <script type="text/javascript">
        jQuery(document).ready(function($){
            $('.collapse').on('shown.bs.collapse', function(){
                $(this).parent().find(".fa-minus").removeClass("fa-minus").addClass("fa-plus");
                
            }).on('hidden.bs.collapse', function(){
                $(this).parent().find(".fa-plus").removeClass("fa-plus").addClass("fa-minus");
            });
        });
    </script>
@endsection
