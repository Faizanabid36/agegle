<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width,initial-scale=1" name="viewport">
    <meta content="description" name="description">
    <meta name="google" content="notranslate"/>
    <meta content="Faizan Abid" name="author">

    <!-- Disable tap highlight on IE -->
    <meta name="msapplication-tap-highlight" content="no">

    <link href="{{asset('website/assets/apple-touch-icon.png')}}" rel="apple-touch-icon">
    <link href="{{asset('website/assets/images/logo.png')}}" rel="icon">

    <title>{{config('app.name','Agegle')}}</title>

    <link href="{{asset('website/main.97292821.css')}}" rel="stylesheet">
    <link href="{{asset('website/app.css')}}" rel="stylesheet">
</head>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<style>
    @media only screen and (max-width: 600px) {
  .mob {
    margin: 0px auto !important;
    margin-top: 7px !important;
    margin-bottom: 7px !important;
    height: 69px;
    width: 178px;
  }
}
</style>
<div class="row">
    <div class="col-xs-12 col-md-4">

    </div>

    <div class="col-xs-12 col-md-4">
        <img width="225" style="margin: 20px auto" src="{{asset('website/assets/images/logo.PNG')}}" alt=""
             class="img-responsive mob">
    </div>
    <div class="col-xs-12 col-md-4">

    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-md-3 "></div>
    <div class="col-xs-12 col-md-6 ">
        {{--
                <input class="form-control  rounded-pill " type="search" placeholder="Sesdaach for the name"
                       id="example-search-input2" style="width: 100%; border-radius: 20px; text-align: center;"> --}}
        <div class="search-input">
            <form action="{{route('search')}}">
                <a href="" hidden></a>
                <input type="text" placeholder="Search for the name..">
            </form>
            <div class="autocom-box">
                <script>let suggestions = <?php echo $suggestions?>;
                </script>
            </div>
            <div class="icon"><img src="{{asset('website/assets/images/vectorpaint (2).svg')}}" alt=""></div>
        </div>
    </div>
    <div class="col-xs-12 col-md-3 "></div>
</div>
<script>
    // getting all required elements
const searchWrapper = document.querySelector(".search-input");
const inputBox = searchWrapper.querySelector("input");
const suggBox = searchWrapper.querySelector(".autocom-box");
const icon = searchWrapper.querySelector(".icon");
let linkTag = searchWrapper.querySelector("a");
let webLink;

// if user press any key and release
inputBox.onkeyup = (e)=>{
    let userData = e.target.value; //user enetered data
    let emptyArray = [];
    if (userData) {
        icon.onclick = () => {
            webLink = "{{route('search')}}?q=" + userData;
            linkTag.setAttribute("href", webLink);
            console.log(webLink);
            linkTag.click();
        }
        emptyArray = suggestions.filter((data) => {
            //filtering array value and user characters to lowercase and return only those words which are start with user enetered chars
            return data.toLocaleLowerCase().startsWith(userData.toLocaleLowerCase());
        });
        emptyArray = emptyArray.map((data) => {
            // passing return data inside li tag
            return data = '<li>' + data + '</li>';
        });
        searchWrapper.classList.add("active"); //show autocomplete box
        showSuggestions(emptyArray);
        let allList = suggBox.querySelectorAll("li");
        for (let i = 0; i < allList.length; i++) {
            //adding onclick attribute in all li tag
            allList[i].setAttribute("onclick", "select(this)");
        }
    }else{
        searchWrapper.classList.remove("active"); //hide autocomplete box
    }
}

function select(element){
    let selectData = element.textContent;
    inputBox.value = selectData;
    webLink = "{{route('search')}}?q=" + selectData;
    icon.onclick = ()=>{
        linkTag.setAttribute("href", webLink);
        linkTag.click();
    }
    searchWrapper.classList.remove("active");
    window.location = webLink
}

function showSuggestions(list){
    let listData;
    if(!list.length){
        userValue = inputBox.value;
        listData = '<li>'+ userValue +'</li>';
    }else{
        listData = list.join('');
    }
    suggBox.innerHTML = listData;
}

</script>

