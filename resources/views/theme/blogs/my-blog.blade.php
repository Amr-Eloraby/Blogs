@extends('theme.master')
@section('title', 'Blogs')
@section('contact')
    @include('theme.partials.hero', ['title' => 'My Blogs'])
    <!-- ================ contact section start ================= -->
    <section class="section-margin--small section-margin">
        <div class="container">
            <div class="row">
                @if (session('status-delete'))
                        <div class="alert alert-success">
                            {{ session('status-delete') }}
                        </div>
                    @endif
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($blogs) > 0)
                            @foreach ($blogs as $blog)
                                <tr>
                                    <td>
                                        <a href="{{route('blogs.show',['blog'=>$blog])}}" target="_blank">{{$blog->name}}</a>
                                    </td>
                                    <td>
                                        <a href="{{route('blogs.edit',['blog'=>$blog])}}"  class="btn bt n-sm btn-primary mr-2">
                                            Edit
                                        </a>
                                        <form action="{{route('blogs.destroy',['blog'=>$blog])}}" class="d-inline"
                                             id="delete-form" method="POST">
                                            @method('delete')
                                            @csrf
                                            <a href="javascript:$('form#delete-form').submit();" class="btn btn-sm btn-danger mr-2">
                                                Delete
                                            </a>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                @if (count($blogs)>0)
                    {{$blogs->render('pagination::bootstrap-4')}}
                @endif
            </div>
        </div>
    </section>
    <!-- ================ contact section end ================= -->
@endsection
