<!DOCTYPE html>
<html lang="en">
<head>
    <title>Genius </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('css/open-iconic-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">


    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/magnific-popup.css')}}">

    <link rel="stylesheet" href="{{asset('css/aos.css')}}">

    <link rel="stylesheet" href="{{asset('css/ionicons.min.css')}}">

    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/jquery.timepicker.css')}}">


    <link rel="stylesheet" href="{{asset('css/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('css/icomoon.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="{{route('interface.index')}}"><i class="flaticon-university"></i>Genius <br><small>University</small></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active"><a href="{{route('interface.index')}}" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="{{route('interface.about')}}" class="nav-link">About</a></li>
                <li class="nav-item"><a href="{{route('interface.course')}}" class="nav-link">Courses</a></li>
                <li class="nav-item"><a href="{{route('interface.teacher')}}" class="nav-link">Teacher</a></li>
                {{--<li class="nav-item"><a href="{{route('interface.blog')}}" class="nav-link">Blog</a></li>--}}
                <li class="nav-item"><a href="{{route('interface.event')}}" class="nav-link">Events</a></li>
                <li class="nav-item"><a href="{{route('interface.contact')}}}" class="nav-link">Contact</a></li>
                <li class="nav-item cta"><a href="{{route('login')}}" class="nav-link"><span>Login</span></a></li>
            </ul>
        </div>
    </div>
</nav>
<!-- END nav -->

<div class="hero-wrap hero-wrap-2" style="background-image: url({{asset('images/bg_2.jpg')}}); background-attachment:fixed;">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center" data-scrollax-parent="true">
            <div class="col-md-8 ftco-animate text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="{{route('interface.index')}}">Home</a></span> <span class="mr-2"><a href="{{route('interface.blog')}}">Blog</a></span> <span>Blog Details</span></p>
                <h1 class="mb-3 bread">Blog Details</h1>
            </div>
        </div>
    </div>
</div>

<section class="ftco-section ftco-degree-bg">
    <div class="container">
        <div class="row">
            <div class="col-md-8 ftco-animate">
                <a class="btn btn-success" href="{{route('posts.edit',[$post->id])}}"><small>Edit</small></a>
                <a class="btn btn-danger" href="{{route('posts.destroy',[$post->id])}}"><small>Delete</small></a>
                <h2 class="mb-3">{{$post->title}}</h2>
                <p>{{$post->created_at->diffForHumans()}}</p>

                <p>
                    <img src="{{$post->photo ? $post->photo->file : null}}" alt="" class="img-fluid">
                </p>
                <p>{{$post->body}}</p>





                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>


                    {!! Form::open(['method'=>'POST', 'action'=> 'CommentController@store']) !!}


                    <input type="hidden" name="post_id" value="{{$post->id}}">


                    <div class="form-group">
                        {!! Form::label('body', 'Body:') !!}
                        {!! Form::textarea('body', null, ['class'=>'form-control','rows'=>3])!!}
                    </div>

                    <div class="form-group">
                        {!! Form::submit('Submit comment', ['class'=>'btn btn-primary']) !!}
                    </div>
                    {!! Form::close() !!}


                </div>

            @if(count($comments) > 0)
                    <h3 class="mb-5">{{$comments->count()}} Comments</h3>

                @foreach($comments as $comment)

                    <!-- Comment -->
                        <div class="pt-5 mt-5">

                            <ul class="comment-list">
                                <li class="comment">
                                    <div class="vcard bio">
                                        <img src="{{Auth::user()->photo->file}}" alt="Image placeholder">
                                    </div>
                                    <div class="comment-body">
                                        <h3>{{$comment->author}}</h3>
                                        <div class="meta">{{$comment->created_at->diffForHumans()}}</div>
                                        <p>{{$comment->body}}</p>
                                        <div class="comment-reply-container">
                                            <button class="toggle-reply btn btn-primary pull-right">Reply</button>
                                            <div class="comment-reply col-sm-6">
                                                {!! Form::open(['method'=>'POST', 'action'=> 'CommentReplyController@createReply']) !!}
                                                <div class="form-group">
                                                    <input type="hidden" name="comment_id" value="{{$comment->id}}">
                                                    {!! Form::label('body', 'Body:') !!}
                                                    {!! Form::textarea('body',null, ['class'=>'form-control','rows'=>1])!!}
                                                </div>
                                                <div class="form-group">
                                                    {!! Form::submit('submit', ['class'=>'btn btn-primary']) !!}
                                                </div>
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    @if(count($comment->replies))
                                        @foreach($comment->replies as $reply)
                                            <!-- Nested Comment -->
                                                    <ul class="children">
                                                        <li class="comment">
                                                            <div class="vcard bio">
                                                                <img src="{{Auth::user()->photo->file}}" alt="Image placeholder">
                                                            </div>
                                                            <div class="comment-body">
                                                                <h3>{{$comment->author}}</h3>
                                                                <div class="meta">{{$reply->created_at->diffForHumans()}}</div>
                                                                <p>{{$reply->body}}</p>
                                                            </div>
                                                        </li>
                                                    </ul>

                                                <!-- End Nested Comment -->
                                            @endforeach
                                        @endif
                                    </div>
                                </li>
                            </ul>
                        </div>
                    @endforeach
                @endif
            </div> <!-- .col-md-8 -->
            <div class="col-md-4 sidebar ftco-animate">
                <div class="sidebar-box">
                    <form action="#" class="search-form">
                        <div class="form-group">
                            <span class="icon fa fa-search"></span>
                            <input type="text" class="form-control" placeholder="Type a keyword and hit enter">
                        </div>
                    </form>
                </div>
                <div class="sidebar-box ftco-animate">
                    <div class="categories">
                        <h3>Categories</h3>
                        @foreach($categories as $category)
                        <li><a href="{{route('blog-category',[$category->id])}}">{{$category->name}} <span>{{count($category->posts)}}</span></a></li>
                        @endforeach
                    </div>
                </div>

                <div class="sidebar-box ftco-animate">
                    <h3>Recent Blog</h3>
                    @foreach($posts as $post)
                    <div class="block-21 mb-4 d-flex">
                        <a class="blog-img mr-4" style="background-image: url({{$post->photo->file}});"></a>
                        <div class="text">
                            <h3 class="heading"><a href="{{route('interface.blog-single',[$post->id])}}">{{$post->title}}</a></h3>
                            <div class="meta">
                                <div><a href="{{route('interface.blog-single',[$post->id])}}"><span class="icon-calendar"></span> {{$post->created_at->diffForHumans()}}</a></div>
                                <div><a href="{{route('interface.blog-single',[$post->id])}}"><span class="icon-person"></span>{{$post->user->role_id}}</a></div>
                                <div><a href="{{route('interface.blog-single',[$post->id])}}"><span class="icon-chat"></span> 19</a></div>
                            </div>
                        </div>
                    </div>
                        @endforeach

                </div>

                <div class="sidebar-box ftco-animate">
                    <h3>Tag Cloud</h3>
                    <div class="tagcloud">
                        <a href="#" class="tag-cloud-link">medical</a>
                        <a href="#" class="tag-cloud-link">cure</a>
                        <a href="#" class="tag-cloud-link">remedy</a>
                        <a href="#" class="tag-cloud-link">health</a>
                        <a href="#" class="tag-cloud-link">workout</a>
                        <a href="#" class="tag-cloud-link">medicine</a>
                        <a href="#" class="tag-cloud-link">doctor</a>
                        <a href="#" class="tag-cloud-link">medic</a>
                    </div>
                </div>

                <div class="sidebar-box ftco-animate">
                    <h3>Paragraph</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus itaque, autem necessitatibus voluptate quod mollitia delectus aut, sunt placeat nam vero culpa sapiente consectetur similique, inventore eos fugit cupiditate numquam!</p>
                </div>
            </div>

        </div>
    </div>
</section> <!-- .section -->


<footer class="ftco-footer ftco-bg-dark ftco-section img" style="background-image: url({{asset('images/bg_2.jpg')}}); background-attachment:fixed;">
    <div class="overlay"></div>
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-3">
                <div class="ftco-footer-widget mb-4">
                    <h2><a class="navbar-brand" href="{{route('interface.index')}}"><i class="flaticon-university"></i>Genius <br><small>University</small></a></h2>
                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                        <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                        <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                        <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
                    </ul>
                </div>
            </div>

            <div class="col-md-3">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2">Have a Questions?</h2>
                    <div class="block-23 mb-3">
                        <ul>
                            <li><span class="icon icon-map-marker"></span><span class="text">203 Fake St. Mountain View, San Francisco, California, USA</span></li>
                            <li><a href="#"><span class="icon icon-phone"></span><span class="text">+2 392 3929 210</span></a></li>
                            <li><a href="#"><span class="icon icon-envelope"></span><span class="text">info@yourdomain.com</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">

                <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
            </div>
        </div>
    </div>
</footer>



<!-- loader -->
<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/jquery-migrate-3.0.1.min.js')}}"></script>
<script src="{{asset('js/popper.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/jquery.easing.1.3.js')}}"></script>
<script src="{{asset('js/jquery.waypoints.min.js')}}"></script>
<script src="{{asset('js/jquery.stellar.min.js')}}"></script>
<script src="{{asset('js/owl.carousel.min.js')}}"></script>
<script src="{{asset('js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('js/aos.js')}}"></script>
<script src="{{asset('js/jquery.animateNumber.min.js')}}"></script>
<script src="{{asset('js/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('js/jquery.timepicker.min.js')}}"></script>
<script src="{{asset('js/scrollax.min.js')}}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
<script src="{{asset('js/google-map.js')}}"></script>
<script src="{{asset('js/main.js')}}"></script>

    <script>

        $(".comment-reply-container .toggle-reply").click(function(){

            $(this).next().slideToggle("slow");
        });

    </script>
</body>
</html>