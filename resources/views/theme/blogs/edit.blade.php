@extends('theme.master')
@section('title', 'Blogs')
@section('contact')
    @include('theme.partials.hero', ['title' => $blog->name])
    <!-- ================ contact section start ================= -->
    <section class="section-margin--small section-margin">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @if (session('status-edit'))
                        <div class="alert alert-success">
                            {{ session('status-edit') }}
                        </div>
                    @endif
                    <form action="{{ route('blogs.update',['blog'=>$blog]) }}" class="form-contact contact_form" enctype="multipart/form-data"
                        method="post" id="contactForm" novalidate="novalidate">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <input class="form-control border" name="name" id="name" type="text"
                                placeholder="Enter your blog title" value="{{ $blog->name }}">
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <div class="form-group">
                            <input class="form-control border" name="image" id="image" type="file">
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        </div>
                        <div class="form-group">
                            <select class="form-control border" name="category_id">
                                <option >Select Category</option>
                                @if (count($categories) > 0)
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" @if ($category->id == $blog->category_id)
                                            selected
                                        @endif>{{ $category->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                        </div>
                        <div class="form-group">
                            <textarea class="w-100 border" rows="8" name="desciption" id="name" type="text"
                                placeholder="Enter your description">{{ $blog->desciption }}</textarea>
                            <x-input-error :messages="$errors->get('desciption')" class="mt-2" />
                        </div>
                        <div class="form-group text-center text-md-right mt-3">
                            <button type="submit" class="button button--active button-contactForm">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ contact section end ================= -->
@endsection
