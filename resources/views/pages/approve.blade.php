@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="mb-5">
                    <h3 class="float-left">Pages</h3>
                    <div class="float-right" style="width:40%">
                        <form action="">
                            <input class="rounded-lg" style="width: 80%" name="search"
                                   placeholder="Search By Profile Name">
                            <button type="submit" class="btn btn-sm btn-primary"> Search</button>
                        </form>
                    </div>
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
                            <th scope="col">Link to Profile</th>
                            <th scope="col">Status</th>
                            <th scope="col">Preview</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($images as $image)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$image->profile->name}}</td>
                                <td>
                                    <a href="{{route('view',$image->profile->slug)}}">{{route('view',$image->profile->slug)}}</a>
                                </td>
                                <td>{{$image->profile->is_approved?'Approved':'Pending Approval'}}</td>
                                <td><img src="{{$image->attachment_url}}" width="75" alt=""></td>
                                <td class="d-flex">
                                    <button class="btn btn-danger ml-3">
                                        <a class="text-white"
                                           href="{{route('admin.profile.delete',$profile->id)}}">Remove</a>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
@endsection
