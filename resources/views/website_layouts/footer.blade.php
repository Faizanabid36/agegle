<style>
    .footer {
   position: fixed;
   left: 0;
   bottom: 0;
   width: 100%;
   background-color: white;
   color: white;
   text-align: center;
}
</style>

<footer class="footer">
    <div style="padding: 21px 0px">
        <div class="container">
            <div class="row">
                <div class="col-xs-3 col-md-3 col-md-3">
                    <div class="fa-container">
                        <i class="fa fa-globe fa-3x" aria-hidden="true"></i>
                    </div>
                    <a href="{{route('home_page')}}" style="text-decoration: none"><h3 class="text-center txt txt1 ">
                            Home
                        </h3>
                    </a>
                </div>

                <div class="col-xs-3 col-md-3 col-md-3">
                    <div class="fa-container">
                        <i class="fa fa-heart-o fa-3x" aria-hidden="true"></i>
                    </div>
                    <a href="{{route('create')}}" style="text-decoration: none"><h3 class="text-center txt txt1">Create
                            Name</h3></a>

                </div>
                <div class="col-xs-3 col-md-3 col-md-3">
                    <div class="fa-container">
                        <i class="fa fa-bell-o fa-3x" aria-hidden="true"></i>
                    </div>
                    <a href="{{route('about')}}" style="text-decoration: none"><h3 class="text-center txt txt1">About
                            Us</h3></a>

                </div>
                <div class="col-xs-3 col-md-3 col-md-3">
                    <div class="fa-container">
                        <i class="fa fa-envelope-o fa-3x" aria-hidden="true"></i>
                    </div>
                    <a href="{{route('contact')}}" style="text-decoration: none"><h3 class="text-center txt txt1">
                            Contact</h3>
                    </a>
                </div>
                @foreach($pages as $page)
                    <div class="col-xs-3 col-md-3 col-md-3">
                        <div class="fa-container">
                            <img width="50" src="{{asset($page->page_icon)}}">
                        </div>
                        <a href="{{route('contact')}}" style="text-decoration: none">
                            <h3 class="text-center txt txt1">
                                {{$page->title}}
                            </h3>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</footer>
<script>
    $(document).ready(function (){
        $('#submit_form_button').click(function (e){
            e.preventDefault()
            $('#submit_form').submit()
        })
    })
</script>
