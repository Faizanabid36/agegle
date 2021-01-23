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
                <div class="mb-5">
                    <h3 class="float-left">Edit Page</h3>
                </div>
                <div class="mt-5">
                    <div class="card">
                        <div class="card-header">
                            <h1>Edit Page</h1>
                        </div>
                        <div class="card-body">
                            @include('pages.form',['data'=>'update','page'=>$page])
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
