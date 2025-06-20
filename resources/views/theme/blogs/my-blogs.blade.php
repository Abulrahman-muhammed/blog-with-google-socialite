@extends('theme.master')
@section('title', 'My-Blogs')
@section('content')

    @include('theme.partials.hero', ['title' => 'My-Blogs'])

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
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Title</th>
                                <th scope="col" width="15%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($blogs) > 0)
                                @foreach ($blogs as $blog)
                                    <tr>
                                        <td>
                                            <a href="{{ route('blog.show', ['blog' => $blog]) }}"
                                                target="_blank">{{ $blog->name }}</a>
                                        </td>
                                        <td>
                                            <a href="{{ route('blog.edit', ['blog' => $blog]) }}"
                                                class="btn btn-sm btn-primary mr-2">Edit</a>

                                            <form action="{{ route('blog.destroy', ['blog' => $blog]) }}" method="post"
                                                id="delete_form_{{ $blog->id }}" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <a href="javascript:document.getElementById('delete_form_{{ $blog->id }}').submit();"
                                                    class="btn btn-sm btn-danger mr-2">Delete</a>
                                            </form>
                                        </td>

                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    @if (count($blogs) > 0)
                        {{ $blogs->links('pagination::bootstrap-5') }}
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!-- ================ End Blog Post Form Section ================= -->

@endsection
