@php
    $categories = App\Models\Category::get();
    // $categories = App\Models\Category::take(2)->get();
@endphp

@extends('theme.master')
@section('page-title', $blog->name)
@section('hero', $blog->name)

@section('content')
    @include('theme.partials.hero')
    <!-- ================ contact section start ================= -->
    <section class="section-margin--small section-margin">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li style="color: red">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('blogs.update', $blog) }}" class="form-contact contact_form"
                        novalidate="novalidate" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <input class="form-control border" name="name" id="name" type="text"
                                        placeholder="Title Of Blog" value="{{ $blog->name }}">
                                    @error('name')
                                        <p style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    {{-- <label for="exampleFormControlTextarea1">Content</label> --}}
                                    <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3"
                                        style="min-height: 150px">
{{ $blog->description }}
                                    </textarea>
                                    @error('message')
                                        <p style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <input name="image" type="file" class="form-control-file"
                                        id="exampleFormControlFile1">
                                    @error('image')
                                        <p style="color:red">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group mt-4">
                                    <select class="form-control" name="category_id">
                                        <option>Select One Category</option>
                                        @if (count($categories) > 0)
                                            @foreach ($categories as $category)
                                                @if ($category->id == $blog->category_id)
                                                    <option value="{{ $category->id }}" selected>{{ $category->name }}
                                                    </option>
                                                @else
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('category_id')
                                        <p style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            </div>
                        </div>
                        <div class="form-group text-center text-md-right mt-3">
                            <button type="submit" class="button button--active button-contactForm">Add New Blog</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ contact section end ================= -->
    @if (session('update_msg'))
        <div class="alert alert-success" style="position:fixed; bottom:10px; right: 10px;" role="alert">
            {{ session('update_msg') }}
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success" style="position: fixed; bottom: 10px; right: 10px;" role="alert">
            {{ session('success') }}
        </div>
    @endif

@endsection
