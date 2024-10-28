@extends('theme.master')
@section('title', 'Blogs')
@section('contact')
    @include('theme.partials.hero', ['title' => 'Add New Blog'])
    <!-- ================ contact section start ================= -->
    <section class="section-margin--small section-margin">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @if (session('status-blog'))
                        <div class="alert alert-success">
                            {{ session('status-blog') }}
                        </div>
                    @endif
                    <form action="{{ route('blogs.store') }}" class="form-contact contact_form" enctype="multipart/form-data"
                        method="post" id="contactForm" novalidate="novalidate">
                        @csrf
                        <div class="form-group">
                            <input class="form-control border" name="name" id="name" type="text"
                                placeholder="Enter your blog title" value="{{ old('name') }}">
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <div class="form-group">
                            <input class="form-control border" name="image" id="image" type="file">
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        </div>
                        <div class="form-group">
                            <select class="form-control border" name="category_id" value="{{ old('name') }}">
                                <option value="">Select Category</option>
                                @if (count($categories) > 0)
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                        </div>
                        <div class="form-group">
                            <textarea class="w-100 border" rows="8" name="desciption" id="name" type="text"
                                placeholder="Enter your description">{{ old('desciption') }}</textarea>
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
