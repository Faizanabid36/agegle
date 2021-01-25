<div class="section-container">
    <div class="container">
       
        <div class="row">
            <div class="col-xs-3 col-md-3 col-md-3">
                <div class="fa-container txt">
                   
                     <img src="{{asset('website/assets/images/globe-solid.svg')}}" height="40px">
                </div>
               <a href="{{route('home_page')}}" style="text-decoration: none"> <h3 class="text-center txt txt1 " >Home</h3> </a>
               
            </div>

            <div class="col-xs-3 col-md-3 col-md-3">
                <div class="fa-container txt">
                    <i class="fa fa-heart-o fa-3x" aria-hidden="true"></i>
                </div>
              <a href="{{route('create')}}" style="text-decoration: none"> <h3 class="text-center txt txt1">Create Name</h3></a> 
              
            </div>
            <div class="col-xs-3 col-md-3 col-md-3">
                <div class="fa-container txt">
                    <i class="fa fa-bell-o fa-3x" aria-hidden="true"></i>
                </div>
                <a href="{{route('about')}}"style="text-decoration: none"> <h3 class="text-center txt txt1">About Us</h3></a> 
                
            </div>
            <div class="col-xs-3 col-md-3 col-md-3">
                <div class="fa-container">
                    <i class="fa fa-bell-o fa-3x txt" aria-hidden="true"></i>
                </div>
                <a href="{{route('contact')}}" style="text-decoration: none"> <h3 class="text-center txt txt1">Contact</h3></a> 
               
            </div>
        </div>
        
    </div>
</div>


<script>
    document.addEventListener("DOMContentLoaded", function (event) {
        
      googleMapInit(); 
      scrollToAnchor();
      scrollRevelation('reveal');
    });
    </script>
    
    <script>
    document.addEventListener("DOMContentLoaded", function (event) {
      navbarToggleSidebar();
    });
    </script>
    
    
    <script type="text/javascript" src="{{asset('website/main.faaf51f9.js')}}"></script>