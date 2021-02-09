@extends('website_layouts.main')

@section('content')

<style>
    .zoom {
        transition: transform .8s;
    }

    .zoom:hover {
        -ms-transform: scale(1.5); /* IE 9 */
        -webkit-transform: scale(1.5); /* Safari 3-8 */
        transform: scale(1.2);
    }

    @media only screen and (max-width: 500px) {
        .z {
            height: 130px !important;
            width: 130px !important;
            margin-left: 0px !important;
        }
    }
</style>
<body>
<div style="padding: 25px 0px">
    <div class="container" style="padding-bottom: 110px">
        @if(count($pages)>0)
            <div class="row" id="content">
                @foreach($pages as $page)
                    <div class="col-xs-6 col-md-3">
                        <a href="{{route('view',$page->slug)}}">
                            <img style="height: 180px;width: 300px;object-fit: contain"
                                 src="{{$page->display_image->approved ?$page->display_image->attachment_url:asset('icons/unavailable.jpg')}}"
                                 alt="{{$page->slug}}"
                                 class="img-responsive zoom">
                        </a>
                        <div style="margin-left: 5px;text-align: center">
                            <h4 class="txt" style="color: black;">{{ucfirst($page->name)}}</h4>
                            <p>Age {{$page->display_image->approved ? $page->display_image->age : $page->extra->count()}} of {{$page->extra->count()}} years</p>
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
