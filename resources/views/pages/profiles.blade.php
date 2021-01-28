@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="mb-5">
                    <h3 class="float-left">Pages</h3>
                    <div class="float-right" style="width:40%">
                        <input class="rounded-lg" style="width: 80%" placeholder="Search By Profile Name">
                        <button type="submit" class="btn btn-sm btn-primary"> Search</button>
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
                            <th scope="col">Link</th>
                            <th scope="col">Ad attached</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($profiles as $profile)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$profile->name}}</td>
                                <td><a href="{{route('view',$profile->slug)}}">{{route('view',$profile->slug)}}</a></td>
                                <td>{{$profile->is_sponsored?'Yes':'No'}}</td>
                                <td>{{$profile->is_approved?'Approved':'Pending Approval'}}</td>
                                <td class="d-flex">
                                    @if($profile->is_sponsored)
                                        <button class="btn btn-success ml-3">
                                            <a class="text-white" href="{{route('admin.remove_sponsor',$profile->id)}}">Remove
                                                Sponsor</a>
                                        </button>
                                    @else
                                        <button class="btn btn-success ml-3">
                                            <a class="text-white" href="{{route('admin.add_sponsor',$profile->id)}}">Add
                                                Sponsor</a>
                                        </button>
                                    @endif
                                    <button class="btn btn-warning ml-3">
                                        <a href="{{route('admin.pages.edit',$profile->id)}}">Edit</a>
                                    </button>
                                    <button class="btn btn-danger ml-3">
                                        <a class="text-white"
                                           href="{{route('admin.profile.delete',$profile->id)}}">Delete</a>
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
