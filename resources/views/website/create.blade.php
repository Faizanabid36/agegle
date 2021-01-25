@extends('website_layouts.main')

@section('content')

    <div class="">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-3 ">
                </div>

                <div class="col-xs-12 col-md-6 ">
                    <div class="card shadow2">
                        <form id="submit_form" action="{{route('store')}}" method="POST">
                            @csrf
                            <div class="">
                                <div class="content mt-5 mx-auto">
                                    <input name="name" class="input" id="form-one" type="text"
                                           placeholder="Person Name">
                                    <span class="border"></span>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-md-6 col-lg-6 ">
                                        <div class="content mt-5 mx-auto">
                                            <input name="started_year" class="input" id="form-two" min="1900"
                                                   type="number" placeholder="Life Started Year">
                                            <span class="border"></span>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6 col-lg-6 ">
                                        <div class="content mt-5 mx-auto">
                                            <input name="ended_year" class="input" id="form-three" type="text"
                                                   placeholder="Life Ended Year (optional)">
                                            <span class="border"></span>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">

                                    <div class="col-xs-12 col-md-12 col-lg-12 ">
                                        <div class="content mt-5 mx-auto">
                                            <p>You can delete this profile by email deletion link</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-xs-12 col-md-12 col-lg-12 ">
                                        <div class="content mt-5 mx-auto">
                                            <input name="email" class="input" id="form-four" type="email"
                                                   placeholder="Email Address (optional)">
                                            <span class="border"></span>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">

                                    <div class="col-xs-12 col-md-12 col-lg-12 ">
                                        <div align="center">
                                            <a id="submit_form_button" href="" class="b">Submit</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-xs-12 col-md-3 ">
                </div>
            </div>
@endsection
