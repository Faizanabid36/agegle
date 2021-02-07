@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('errors'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('errors')->first() }}
                    </div>
                @endif
                <div class="mb-5">
                    <h3 class="float-left">Edit Profile</h3>
                </div>
                <div class="mt-5">
                    <div class="card">
                        <div class="card-header">
                            <h1>Edit Page</h1>
                        </div>
                        <div class="card-body">
                            <form method="post" enctype="multipart/form-data"
                                  action="{{route('admin.profile.update',$profile->id)}}">
                                @csrf
                                <div class="form-group">
                                    <label for="title">Profile Name</label>
                                    <input value="{{$profile->name}}" name="name" required
                                           type="text"
                                           class="form-control"
                                           id="title" placeholder="Enter title">
                                </div>
                                <div class="form-group">
                                    <label for="ended_year">Life Ended Year</label>
                                    <input value="{{$profile->ended_year}}" name="ended_year"
                                           type="text"
                                           class="form-control"
                                           id="ended_year" placeholder="Death Year(optional)">
                                </div>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
