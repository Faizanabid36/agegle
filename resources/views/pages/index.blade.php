@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="mb-5">
                    <h3 class="float-left">Pages</h3>
                    <button class="float-right btn btn-primary"><a href="{{route('admin.pages.create')}}"
                                                                   class="text-white">+ Add New Page</a></button>
                </div>
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="mt-5">
                    <table class="table table-secondary">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Icon</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pages as $page)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$page->title}}</td>
                                <td>{{$page->slug}}</td>
                                <td><img width="60" src="{{$page->page_icon}}" alt=""></td>
                                <td class="d-flex">
                                    <button class="btn btn-warning ml-3">
                                        <a href="{{route('admin.pages.edit',$page->id)}}">Edit</a>
                                    </button>
                                    <form class="ml-3" method="POST" action="{{route('admin.pages.destroy',$page->id)}}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
@endsection
