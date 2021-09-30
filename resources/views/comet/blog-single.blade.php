@extends('comet.layouts.app')

@section('page-title',$all_posts->title)

@foreach ( $all_posts->categories as $cat)

@section('post-cat',$cat->name)

@endforeach


@section('main-content')
    <section>
      <div class="container">
        <div class="row">
          <div class="col-md-8">
            <article class="post-single">
              <div class="post-info">
                <h2><a href="{{ route('blog.single',$all_posts->slug) }}">{{  $all_posts->title }}</a></h2>
                <h6 class="upper"><span>By</span><a href="#"> {{ $all_posts->user->name }}</a><span class="dot"></span><span>{{ date('d F,Y',strtotime($all_posts->created_at)) }}</span><span class="dot"></span>

                    @foreach ($all_posts->tags as $tag )


                    <a href="#" class="post-tag">{{ $tag->name }}</a>

                    @endforeach

                </h6>
              </div>
              <div class="post-media">

                @php
                    $featured=json_decode($all_posts->featured);
                @endphp

                @if ( $featured->post_type=='Image')

                    <img src="{{ URL::to('') }}/media/post/{{  $featured->post_image }}" alt="">
                @endif


                @if( $featured -> post_type == 'Gallery' )
                <div class="post-media">
                    <div data-options="{&quot;animation&quot;: &quot;slide&quot;, &quot;controlNav&quot;: true" class="flexslider nav-outside">
                        <ul class="slides">

                            @foreach( $featured -> post_gallery as $gall )
                            <li class="flex-active-slide" style="width: 100%; float: left; margin-right: -100%; position: relative; opacity: 1; display: block; z-index: 2;">
                                <img src="{{ URL::to('') }}/media/post/{{ $gall }}" alt="" draggable="true">
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            @if( $featured -> post_type == 'Video' )

            <div class="post-media">
                <div class="media-video">
                  <iframe src="{{ $featured -> post_video }}" frameborder="0"></iframe>
                </div>
              </div>

            @endif

              </div>
              <div class="post-body">

                {!! htmlspecialchars_decode($all_posts->content) !!}

              </div>
            </article>
            <!-- end of article-->

            @if(Session::has('success'))

            <p class="alert alert-success">{{ Session::get('success') }} <button class="close" data-dismiss="alert">&times;</button> </p>

            @endif


            <div id="comments">

              <h5 class="upper">3 Comments</h5>

              <ul class="comments-list">

                @foreach ($all_posts->comments as $comment)

                @if($comment->comment_id ==null)


                <li>
                  <div class="comment">
                    <div class="comment-pic">
                      <img src="{{ URL::to('comet/assets/images/team/1.jpg') }}" alt="" class="img-circle">
                    </div>
                    <div class="comment-text">
                      <h5 class="upper">{{  $comment->user->name }}</h5>
                      <span class="comment-date">Posted on {{ date('d F,Y',strtotime($comment->created_at)) }} at {{ date('g:i',strtotime($comment->created_at)) }}</span>
                      <p>{{ $comment->text }}</p>

                      @guest

                      <p>For reply please <a href="{{ route('admin.login') }}">Login</a> first</p>

                      @else

                      <a class="reply_btn" c_id="{{ $comment->id }}" href="#" class="comment-reply">Reply</a>

                      <div class="reply-box reply-box-{{ $comment->id }}">

                        <form action="{{ route('post.reply') }}" method="POST">
                        @csrf

                         <div class="form-group">
                            <input name="post_id" type="hidden" value="{{ $all_posts->id   }}">
                         </div>
                         <div class="form-group">
                            <input name="comment_id" type="hidden" value="{{ $comment->id  }}">
                         </div>

                        <div class="form-group">
                            <textarea name="reply" placeholder="Comment reply..." class="form-control"></textarea>
                          </div>
                          <div class="form-submit text-right">
                            <button  type="submmit" class="btn btn-color-out">Post Comment</button>
                          </div>

                        </form>

                      </div>

                      @endguest

                    </div>
                  </div>


                  @php
                      $reply=App\Models\Comment::where('comment_id', '!=',null)->where('comment_id',$comment->id)->get();
                  @endphp

                  @foreach ($reply as $rep_comm)



                  <ul class="children">
                    <li>
                      <div class="comment">
                        <div class="comment-pic">
                          <img src="{{ URL::to('comet/assets/images/team/2.jpg') }}" alt="" class="img-circle">
                        </div>
                        <div class="comment-text">

                          <h5 class="upper">{{ $rep_comm->user->name }}</h5>

                          <span class="comment-date">Posted on {{ date('d F,Y',strtotime($rep_comm->created_at)) }} at {{ date('g:i',strtotime($rep_comm->created_at)) }}</span>

                          <p>{{ $rep_comm->text }}</p>

                          <a href="#" class="comment-reply">Reply</a>

                        </div>
                      </div>
                    </li>
                  </ul>

                  @endforeach


                </li>

                @endif
                @endforeach


              </ul>

            </div>


            <!-- end of comments-->



            @guest

            <p>Please <a href="{{ route('admin.login') }}">Login</a> first then write coment </p>
            @else


            <div id="respond">
              <h5 class="upper">Leave a comment</h5>
              <div class="comment-respond">
                <form class="comment-form" action="{{ route('post.comment')}}" method="POST">
                    @csrf
                  <div class="form-double">
                    {{--  <div class="form-group">
                      <input name="author" type="text" placeholder="Name" class="form-control">
                    </div>
                    <div class="form-group last">
                      <input name="email" type="text" placeholder="Email" class="form-control">
                    </div>  --}}
                  </div>
                  <div class="form-group">
                    <input name="post_id" type="hidden" value="{{ $all_posts->id }}">
                  </div>
                  <div class="form-group">
                    <textarea name="comment" placeholder="Comment" class="form-control"></textarea>
                  </div>
                  <div class="form-submit text-right">
                    <button  type="submmit" class="btn btn-color-out">Post Comment</button>
                  </div>
                </form>
              </div>
            </div>
            <!-- end of comment form-->

        @endguest
          </div>



          @include('comet.layouts.partials.sidebar')




        </div>
        <!-- end of row-->

      </div>
    </section>

 @endsection

