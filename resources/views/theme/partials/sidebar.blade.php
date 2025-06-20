@php
    $categories=App\Models\Category::all();
    $recentBlogs=App\Models\Blog::latest()->take(3)->get();
@endphp

<div class="col-lg-4 sidebar-widgets">
<div class="widget-wrap">
    <div class="single-sidebar-widget newsletter-widget">
        <h4 class="single-sidebar-widget__title">{{ __('side.newsletter') }}</h4>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
        <form action="{{route('subscriber.store')}}" method="POST">
            @csrf
            <div class="form-group mt-30">
                <div class="col-autos">
                    <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="inlineFormInputGroup" value="{{ old('email') }}"
                        placeholder="Enter email" onfocus="this.placeholder = ''"
                        onblur="this.placeholder = 'Enter email'" >
                        @error('email') 
                        <span class="text-danger"><li> {{$message}} </li></span>
                        @enderror
                </div>
            </div>

            <button type="submit" class="bbtns d-block mt-20 w-100">{{ __('side.subscribe') }}</button>
        </form>
    </div>
</div>

        @if (count($categories) > 0)    
        <div class="single-sidebar-widget post-category-widget">
            <h4 class="single-sidebar-widget__title">{{ __('side.category') }}</h4>
            <ul class="cat-list mt-20">
                            {{-- Display Categories --}}
            @foreach ($categories as $category)
                    <li>
                        <div class="d-flex justify-content-between ">
                            <a class="nav-link text-secondary" href="{{ route('theme.category', $category->id) }}">
                                {{ $category->name }}
                            </a>
                            <span>({{count($category->blogs)}})</span>
                        </div>
                    </li>
            @endforeach
            </ul>
        </div>
        @endif

        @if (count($recentBlogs)>0)
                <div class="single-sidebar-widget popular-post-widget">
                    <h4 class="single-sidebar-widget__title">{{ __('side.recent') }}</h4>
                    <div class="popular-post-list">
                            @foreach ($recentBlogs as $blog)                        
                                <div class="single-post-list">
                                    <div class="thumb">
                                        <img class="card-img rounded-0"
                                            src="{{ asset('storage/blogs/'.$blog->image) }}" alt="">
                                        <ul class="thumb-info">
                                            <li><a href="#" class="text-dark"> {{$blog->user->name}}</a></li>
                                            <li><a href="#" class="text-dark">{{ date('M d', strtotime($blog->created_at))}}</a></li>
                                        </ul>
                                    </div>
                                    <div class="details mt-20">
                                        <a href="{{route('blog.show',$blog)}}">
                                            <h6>{{$blog->name}}</h6>
                                        </a>
                                    </div>
                                </div>
                            @endforeach                    
                    
                    </div>
                </div>
        @endif

    </div>
</div>