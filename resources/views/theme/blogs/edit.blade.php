@extends('theme.master')
@section('title', 'Edit-Blog')
@section('content')

@include('theme.partials.hero',['title'=>$blog->name])

<!-- ================ Blog Post Form Section ================= -->
<section class="section-margin--small section-margin">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        @if (session('status-blog'))
          <div class="alert alert-success">
              {{ session('status-blog') }}
          </div>
        @endif

        <form action="{{ route('blog.update',$blog->id) }}" method="POST" enctype="multipart/form-data" class="contact_form">
          @csrf
          @method('PUT')
          <div class="form-group">
            <input class="form-control" type="text" name="name" placeholder="Enter your blog title" value="{{ old('name', $blog->name) }}">
            @error('name') 
              <span class="text-danger"><li>{{ $message }}</li></span>
            @enderror
          </div>

          <div class="form-group">
            <input class="form-control" type="file" name="image">
            @error('image') 
              <span class="text-danger"><li>{{ $message }}</li></span>
              @enderror
              <div class="mt-2">
                <img src="{{ asset('storage/blogs/'.$blog->image) }}" alt="Selected image preview" style=" max-height: 150px;">
              </div>
            </div>

          <div class="form-group">
            <select class="form-control" name="category_id">
              <option value="">Select Category</option>
              @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id',$blog->category_id) == $category->id ? 'selected' : '' }}>
                  {{ $category->name }}
                </option>
              @endforeach
            </select>
            @error('category_id') 
              <span class="text-danger"><li>{{ $message }}</li></span>
            @enderror
          </div>

          <div class="form-group">
            <textarea class="form-control" name="description" rows="5" placeholder="Enter your blog Content">{{  old('description', $blog->description)  }}</textarea>
            @error('description') 
              <span class="text-danger"><li>{{ $message }}</li></span>
            @enderror
          </div>

          <div class="form-group text-right">
            <button type="submit" class="btn btn-dark">SUBMIT</button>
          </div>

        </form>
      </div>
    </div>
  </div>
</section>
<!-- ================ End Blog Post Form Section ================= -->

@endsection