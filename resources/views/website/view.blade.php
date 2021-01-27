@extends('website_layouts.main')

@section('content')
    <body>
    <div class="section-container">
        <div class="container">
            <div class="row">
                @if($profile->is_sponsored)
                    <div class="col-xs-4 col-md-3">
                        <a href="">
                            <img style="height: 170px;width: 240px;"
                                 src="{{asset('website/assets/images/img-02.jpg')}}" alt=""
                                 class="img-responsive">
                        </a>
                        <div style="margin-left: 10px;">
                            <h4 class="txt" style="color: black;margin: 10px 0px 0px 0px">Sponsor Ad</h4>
                            <p>Sponsor ads page</p>
                        </div>
                    </div>
                @endif
                @foreach($profile_extras as $profile_extra)
                    <div class="col-xs-4 col-md-3">
                        <img style="height: 170px;width: 240px;" src="{{$profile_extra->attachment_url}}"
                             class="img-responsive">

                        <div style="margin-left: 10px; margin-right: 10px">
                            @if($profile_extra->attachment_url==asset('icons/unavailable.jpg'))
                                <img src="{{asset('website/assets/images/arrow.svg')}}" name="pic"
                                     id="{{$profile_extra->id}}" class="picture"
                                     height="20px" width="20px" style="float: right">
                                <form id="add_image-{{$profile_extra->id}}" enctype="multipart/form-data"
                                      action="{{route('add_image',[$profile->slug,$profile_extra->id])}}"
                                      method="POST">
                                    @csrf
                                    <input class="fileinput" id="fileinput-{{$profile_extra->id}}" type="file"
                                           name="fileinput" style="display:none"
                                           style="visibility: hidden;"/>
                                </form>
                            @endif
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
    <script type="text/JavaScript"
            src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js">
    </script>

    <script>
        $(function () {
            $('.picture').on('click', function () {
                $(`#fileinput-${this.id}`).trigger('click');
                let id = this.id;
                $(`#fileinput-${id}`).change(function (e) {
                    $(`#add_image-${id}`).submit()
                })
            });
        });
    </script>
@endsection
