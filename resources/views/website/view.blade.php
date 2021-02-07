@extends('website_layouts.main')

@section('content')
<body>
<style>

    #myImg {
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
    }

    #myImg:hover {
        opacity: 0.7;
    }

    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        padding-top: 60px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100vh; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0, 0, 0); /* Fallback color */
        background-color: rgba(0, 0, 0, 0.9); /* Black w/ opacity */
    }

    .modal-content {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
    }

    #caption {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
        text-align: center;
        color: #ccc;
        padding: 10px 0;
        /*height: 150px;*/
    }

    .modal-content, #caption {
        -webkit-animation-name: zoom;
        -webkit-animation-duration: 0.6s;
        animation-name: zoom;
        animation-duration: 0.6s;
    }

    @-webkit-keyframes zoom {
        from {
            -webkit-transform: scale(0)
        }
        to {
            -webkit-transform: scale(1)
        }
    }

    @keyframes zoom {
        from {
            transform: scale(0)
        }
        to {
            transform: scale(1)
        }
    }

    .close {
        position: absolute;
        top: 15px;
        right: 35px;
        color: #f1f1f1;
        font-size: 40px;
        font-weight: bold;
        transition: 0.3s;
    }

    .close:hover,
    .close:focus {
        color: #bbb;
        text-decoration: none;
        cursor: pointer;
    }

    @media only screen and (max-width: 600px) {
        .modal-content {
            width: 100%;
        }

        .m {
            font-size: 12px;
        }

        .col-md-3 {
            padding-left: 3px;
            padding-right: 3px;
        }
    }

</style>

<!-- The Modal -->
<div id="myModal" class="modal">
    <span class="close">&times;</span>
    <img class="modal-content" id="img01">
    <div id="caption"></div>
</div>
<div style="padding: 25px 0px">
    <div class="container" style="padding-bottom: 110px">
        <div class="row" id="content">
            @if($profile->is_sponsored)
                <div class="col-xs-6 col-md-3">
                    <a href="{{$profile->sponsor_ad->ad_url}}">
                        <img style="height: 170px;width: 240px;object-fit: contain"
                             src="{{$profile->sponsor_ad->ad_attachment}}" alt=""
                             class="img-responsive zoom">
                    </a>
                    <div style="margin-left: 10px;">
                        <h4 class="txt" style="color: black;margin: 10px 0px 0px 0px">Sponsor Ad</h4>
                        <p>{{$profile->sponsor_ad->ad_title}}</p>
                    </div>
                </div>
            @endif
            @foreach($profile_extras as $profile_extra)
                <div class="col-xs-6 col-md-3">
                    <img style="height: 170px;width: 240px;object-fit: contain"
                         onclick="preview('{{$profile_extra->approved?$profile_extra->attachment_url:asset('icons/unavailable.jpg')}}')"
                         src="{{$profile_extra->approved?$profile_extra->attachment_url:asset('icons/unavailable.jpg')}}"
                         class="img-responsive zoom">
                    <div style="margin-left: 10px; margin-right: 10px">
                        @if($profile_extra->attachment_url==asset('icons/unavailable.jpg'))
                            <img onmouseover="activeIcon(this)" onmouseout="revertIcon(this)"
                                 src="{{asset('website/assets/images/arrow.svg')}}" name="pic"
                                 id="{{$profile_extra->id}}" class="picture "
                                 height="20px" width="20px" style="float: right">
                            <form id="add_image-{{$profile_extra->id}}" enctype="multipart/form-data"
                                  action="{{route('add_image',[$profile->slug,$profile_extra->id])}}"
                                  method="POST">
                                @csrf
                                <input class="fileinput" id="fileinput-{{$profile_extra->id}}" type="file"
                                       name="fileinput" style="display:none"
                                       style="visibility: hidden;"/>
                            </form>
                        @else
                            @auth()
                                <a onclick="return confirm('Do you want to revert the Image?')"
                                   href="{{route('admin.decline',$profile_extra->id)}}">
                                    <img
                                        src="{{asset('website/assets/images/trash.png')}}"
                                        height="20px" width="20px" style="float: right;">
                                </a>
                            @endauth
                        @endif
                        <div style="text-align: center">
                            <h4 class="txt m" style="color: black;margin: 10px 0px 0px 0px">{{$profile->name}}</h4>
                            <p class="txt m">
                                Age {{$profile_extra->age}} {{($profile_extra->age +(int)$profile->started_year)}}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-xs-12 col-md-12 col-md-12">
                <h3 class="text-center txt txt1 " id="see_more">See More</h3>
            </div>
        </div>
    </div>
</div>
</body>
<script>
    // Get the modal
    // var modal = document.getElementById("myModal");
    //
    // // Get the image and insert it inside the modal - use its "alt" text as a caption
    // var img = document.getElementById("myImg");
    // var modalImg = document.getElementById("img01");
    // var captionText = document.getElementById("caption");
    // img.onclick = function () {
    //     modal.style.display = "block";
    //     modalImg.src = this.src;
    //     captionText.innerHTML = this.alt;
    // }
    //
    // // Get the <span> element that closes the modal
    // var span = document.getElementsByClassName("close")[0];
    //
    // // When the user clicks on <span> (x), close the modal
    // span.onclick = function () {
    //     modal.style.display = "none";
    // }
</script>
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

    function preview(src) {
        let modal = document.getElementById("myModal");
        var modalImg = document.getElementById("img01");
        modal.style.display = "block";
        modalImg.src = src;
        // captionText.innerHTML = this.alt;
        let span = document.getElementsByClassName("close")[0];

        span.onclick = function () {
            modal.style.display = "none";
        }

    }

    function inp(e) {
        $(`#fileinput-${e.id}`).trigger('click');
        let id = e.id;
        $(`#fileinput-${id}`).change(function (e) {
            $(`#add_image-${id}`).submit()
        })
    }
</script>
@endsection
