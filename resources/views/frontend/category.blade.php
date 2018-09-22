@extends('layouts.app')
@section('custom-style')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
@endsection
@section('title',$title_obj)
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
                <div class="row">
                    @foreach($posts as $post)
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
                                        {{ str_limit($post->post_description,50,'...') }}
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
                <div class="row">
                    <div class="col-md-12">
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>  
            <div class="col-md-3">
                @include('frontend.includes._sitebar',[$categories])
            </div>
        </div>
    </div>
@endsection
@section('custom-script')
    <script type="text/javascript">
        jQuery(document).ready(function(){
            $('.collapse').on('shown.bs.collapse', function(){
                $(this).parent().find(".fa-minus").removeClass("fa-minus").addClass("fa-plus");
                
            }).on('hidden.bs.collapse', function(){
                $(this).parent().find(".fa-plus").removeClass("fa-plus").addClass("fa-minus");
            });
        });
    </script>
@endsection
