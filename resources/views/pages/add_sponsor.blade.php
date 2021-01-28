@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h3>{{'Add Sponsor to Profile '.$profile->name}}</h3>
            <div class="col-md-10">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="mb-5">
                    <h3 class="float-left">New Ad</h3>
                </div>
                <div class="mt-5">
                    <div class="card">
                        <div class="card-header">
                            <h1>Add Sponsor ad to Profile: <u>{{$profile->name}}</u></h1>
                        </div>
                        <div class="card-body">
                            <form method="post" enctype="multipart/form-data"
                                  action="{{route('admin.store_sponsor',$profile->id)}}">
                                @csrf
                                <div class="form-group">
                                    <label for="ad_title">Sponsor title</label>
                                    <input name="ad_title" required type="text"
                                           class="form-control"
                                           id="ad_title" placeholder="Enter title">
                                </div>
                                <div class="form-group">
                                    <label for="ad_url">Sponsor URL</label>
                                    <input name="ad_url" required type="text"
                                           class="form-control"
                                           id="ad_url" placeholder="Enter URL">
                                </div>
                                <div class="form-group">
                                    <label for="icon">Choose Image</label>
                                    <input type="file" class="form-control" name="pic" id="icon"
                                           placeholder="Choose File">
                                </div>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
