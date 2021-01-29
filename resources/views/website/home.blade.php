@extends('website_layouts.main')

@section('content')
    <body>
    <div class="section-container">
        <div class="container">
            @if(count($pages)>0)
                <div class="row" id="content">
                    @foreach($pages as $page)
                        <div class="col-xs-4 col-md-3">
                            <a href="{{route('view',$page->slug)}}"><img src="{{$page->extra->first()->attachment_url}}" alt="{{$page->slug}}" class="img-responsive"></a>
                            <div style="margin-left: 10px;">
                                <h4 class="txt" style="color: black;margin: 10px 0 0 0">{{ucfirst($page->name)}}</h4>
                                <p>10 of 50 years</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-12 col-md-12">
                        <h3 class="text-center txt txt1 " id="see_more">See More</h3>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-xs-12 col-md-12 col-md-12">
                        <h2 class="text-center txt" style="color: red">Nothing More to Display</h2>
                    </div>
                </div>
            @endif
        </div>
    </div>
    </body>
@endsection
