@extends('website_layouts.main')

@section('content')
    <body>
    <div class="section-container">
        <div class="container">
            <div class="row">
                <div class="col-xs-4 col-md-3">
                    <a href=""><img width="250" height="300" src="{{asset('website/assets/images/img-02.jpg')}}" alt="" class="img-responsive"></a>
                    <div style="margin-left: 10px;">
                        <h4 class="txt" style="color: black;margin: 10px 0px 0px 0px">Sponsor Ad</h4>
                        <p>Sponsor ads page</p>
                    </div>
                </div>
                @foreach($profile_extras as $profile_extra)
                    <div class="col-xs-4 col-md-3">
                        <img width="250" height="300" src="{{$profile_extra->attachment_url}}" class="img-responsive">
                        <div style="margin-left: 10px;">
                            <h4 class="txt" style="color: black;margin: 10px 0px 0px 0px">{{$profile->name}}</h4>
                            <p>{{$profile_extra->age}} of {{count($profile->extra)}} years</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-12 col-md-12">
                    <h3 class="text-center txt txt1 ">See More</h3>
                </div>
            </div>
        </div>
    </div>
    </body>

@endsection
