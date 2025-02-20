@extends('theme.master')
@section('page-title', 'single blog')
@section('hero', 'Single Blog Page')

@section('content')
    @include('theme.partials.hero')

    <!--================ Start Blog Post Area =================-->
    <section class="blog-post-area section-margin">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="main_blog_details">
                        <img class="img-fluid" src="{{ asset('storage') }}/blogs/{{ $blog->image }}" alt="">
                        <a href="#">
                            <h4>{{ $blog->name }}</h4>
                        </a>
                        <div class="user_details">
                            <div class="float-right mt-sm-0 mt-3">
                                <div class="media">
                                    <div class="media-body">
                                        <h5>{{ $blog->user->name }}</h5>
                                        <p>{{ $blog->created_at->format('d M Y') }}</p>
                                    </div>
                                    <div class="d-flex">
                                        <img width="42" height="42" src="{{ asset('assets') }}/img/avatar.png"
                                            alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p>{{ $blog->description }}</p>
                    </div>

                    @if (session('comment_add'))
                        <div class="alert alert-success">
                            {{ session('comment_add') }}
                        </div>
                    @endif
                    <div class="comments-area">
                        @if (count($blog->comments) > 0)
                            <h4>{{ count($blog->comments) }} Comments</h4>
                            @foreach ($blog->comments as $comment)
                                <div class="comment-list">
                                    <div class="single-comment justify-content-between d-flex">
                                        <div class="user justify-content-between d-flex">
                                            <div class="thumb">
                                                <img src="{{ asset('assets') }}/img/avatar.png" width="50px">
                                            </div>
                                            <div class="desc">
                                                <h5><a>{{ $comment->name }}</a></h5>
                                                <p class="date">{{ $comment->created_at->format('d M Y') }}</p>
                                                <p class="comment">
                                                    {{ $comment->message }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <div class="comment-form">
                        <h4>Leave a Reply</h4>
                        <form method="POST" action="{{ route('comment.store') }}">
                            @csrf
                            <div class="form-group form-inline">
                                <div class="form-group col-lg-6 col-md-6 name">
                                    <input type="text" class="form-control" id="name" placeholder="Enter Name"
                                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Name'"
                                        name="name">
                                </div>
                                <div class="form-group col-lg-6 col-md-6 email">
                                    <input type="email" class="form-control" id="email"
                                        placeholder="Enter email address" onfocus="this.placeholder = ''"
                                        onblur="this.placeholder = 'Enter email address'" name="email">
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="subject" placeholder="Subject"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Subject'" name="subject">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control mb-10" rows="5" name="message" placeholder="Messege" onfocus="this.placeholder = ''"
                                    onblur="this.placeholder = 'Messege'" required="" name="message"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                            </div>
                            <input type="submit" value="Post Comment" class="button submit_btn">
                        </form>
                    </div>
                </div>

                @include('theme.partials.sidebar')
            </div>
    </section>
    <!--================ End Blog Post Area =================-->
@endsection
