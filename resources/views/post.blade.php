@extends('layouts.blog-post')


@section('content')



    <!-- Title -->
    <h1 class="mt-4">{{$post->title}}</h1>

    <!-- Author -->
    <p class="lead">
        by
        <a href="#">{{$post->created_at->diffForHumans()}}</a>
    </p>

    <hr>


    <hr>

    <!-- Preview Image -->
    <img class="img-fluid rounded" src="{{$post->photo ? $post->photo->file : null }}" alt="">

    <hr>

    <!-- Post Content -->

    <blockquote class="blockquote">
        <h5 class="mb-0">{!! $post->body !!}</h5>
        <footer class="blockquote-footer">
            <cite title="Source Title">{{$post->user->name}}</cite>
        </footer>
    </blockquote>

    <hr>





    <div id="disqus_thread"></div>
    <script>

        /**
         *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
         *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
        /*
        var disqus_config = function () {
        this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
        this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
        };
        */
        (function() { // DON'T EDIT BELOW THIS LINE
            var d = document, s = d.createElement('script');
            s.src = 'https://codehacking-jrwlpb0lgh.disqus.com/embed.js';
            s.setAttribute('data-timestamp', +new Date());
            (d.head || d.body).appendChild(s);
        })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
    <script id="dsq-count-scr" src="//codehacking-jrwlpb0lgh.disqus.com/count.js" async></script>






@section('scripts')

    <script type="text/javascript">

        $(".comment-reply-container .toggle-reply").click(function (){

            $(this).next().slideDown("slow");



        });

    </script>

@stop





@endsection