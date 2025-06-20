@extends('theme.master')
@section('title', 'Single Blog')
{{-- @section('blog-active', 'active') --}}
@section('content')

    @include('theme.partials.hero', ['title' => $blog->name])

    <!--================ Start Blog Post Area =================-->
    <section class="blog-post-area section-margin">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="main_blog_details">
                        <img class="img-fluid" src="{{asset('storage/blogs/'.$blog->image)}}" alt="">
                        <a href="#">
                            <h4>{{$blog->name}}</h4>
                        </a>
                        <div class="user_details">
                            <div class="float-right mt-sm-0 mt-3">
                                <div class="media">
                                    <div class="media-body">
                                        <h5>{{$blog->user->name}}</h5>
                                        <p>{{ date('d M Y h:i a', strtotime($blog->created_at))}}</p>
                                    </div>
                                    <div class="d-flex">
                                        <img width="42" height="42" src="{{asset('assets')}}/img/avatar.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p>{{$blog->description}}</p>
                    </div>
                @if (count($blog->comments)>0)                    
                    <div class="comments-area">
                        <h4>{{count($blog->comments) }} Comments</h4>
                        @foreach ($blog->comments as $comment)                            
                            <div class="comment-list">
                                <div class="single-comment justify-content-between d-flex">
                                    <div class="user justify-content-between d-flex">
                                        <div class="thumb">
                                            <img src="{{asset('assets')}}/img/avatar.png" width="50px">
                                        </div>
                                        <div class="desc">
                                            <h5><a href="#">{{$comment->name}}</a></h5>
                                            <p class="date"> {{ date('F j, Y \a\t g:i a', strtotime($comment->created_at)) }} </p>
                                            <p class="comment">
                                                {{$comment->message}}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                    <div class="comment-form">
                        <h4>Leave a Reply</h4>
                        @if (session('commentCreateStatus'))
                                <div class="alert alert-success">
                                        {{ session('commentCreateStatus') }}
                                </div>
                        @endif
                        <form method="post" action="{{route('comment.store')}}">
                            @csrf
                            {{-- Store blog id in hidden input field --}}
                            <input type="hidden" name="blog_id" value="{{$blog->id}}" >
                            <div class="form-group form-inline">
                                <div class="form-group col-lg-6 col-md-6 name">
                                    <input type="text" name="name" value="{{old('name')}}" class="form-control" id="name" placeholder="Enter Name"
                                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Name'">
                                            @error('name') 
                                                <span class="text-danger"><li>{{ $message }}</li></span>
                                            @enderror
                                </div>
                                <div class="form-group col-lg-6 col-md-6 email">
                                    <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}"
                                        placeholder="Enter email address" onfocus="this.placeholder = ''"
                                        onblur="this.placeholder = 'Enter email address'">
                                </div>
                                            @error('email') 
                                                <span class="text-danger"><li>{{ $message }}</li></span>
                                            @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="subject" placeholder="Subject" name="subject" value="{{old('subject')}}"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Subject'">
                                            @error('Subject') 
                                                <span class="text-danger"><li>{{ $message }}</li></span>
                                            @enderror
                                </div>
                            <div class="form-group">
                                <textarea class="form-control mb-10" rows="5" name="message" placeholder="Messege" onfocus="this.placeholder = ''"
                                    onblur="this.placeholder = 'Messege'" required="">{{old('message')}}</textarea>
                                            @error('message') 
                                                <span class="text-danger"><li>{{ $message }}</li></span>
                                            @enderror
                                </div>
                                <button type="submit" class="button submit_btn">Post Comment</button>
                        </form>
                    </div>
                </div>

                <!-- Start Blog Post Siddebar -->
                    @include('theme.partials.sidebar')
                <!-- End Blog Post Siddebar -->
            </div>
    </section>
    <!--================ End Blog Post Area =================-->
@endsection
