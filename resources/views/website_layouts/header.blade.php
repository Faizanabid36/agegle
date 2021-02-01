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
</head>
<style>
    .card {
        margin-top: 30px;
        padding: 30px;
        background: #fff;
        max-width: 100%;
        border-radius: 20px;

    }

    .shadow2 {
        box-shadow: 0 7px 30px -10px rgba(150, 170, 180, 0.5);
    }

    .txt {
        color: grey;
        font-family: Nunito Sans, Helvetica, Arial, sans-serif;
    }

    .txt1:hover {
        color: #139adc;
        cursor: pointer;
    }

    :focus {
        outline: none;
    }

    .content {
        position: relative;
    }

    .input {
        width: 100%;
        border: 0;
        padding: 10px 10px;
        border-bottom: 1px solid #929fba;
    }

    .input ~ .border {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 0;
        height: 1px;
    }

    .input:focus ~ .border {
        width: 100%;
        transition: 0.5s;
    }

    .cont {
        border: 0.5px solid;
        padding-bottom: 40px;
    }

    .border {
        border: 1px solid #4285F4 !important;
    }

    .b {
        color: #139adc;
        text-decoration: none;
        font-weight: bold;
    }

    .b:hover {
        color: #139adc;
        text-decoration: none;
        font-weight: bold;
    }
    /* ::selection{
  color: #fff;
  background: #664AFF;
} */

.wrapper{
  max-width: 450px;
  margin: 150px auto;
}

    .wrapper .search-input {
        background: #fff;
        width: 100%;
        border-radius: 5px;
        position: relative;
        border-color: gray;
        box-shadow: 0px 1px 5px 3px rgba(0, 0, 0, 0.12);
    }

    .search-input input {
        height: 45px;
        width: 100%;
        outline: none;
        padding: 0 60px 0 20px;
        font-size: 18px;
        border: 2px solid #b9aeae;
        border-radius: 57px;
    }

    /* .search-input.active input{
      border-radius: 5px 5px 0 0;
    } */

.search-input .autocom-box{
  padding: 0;
  opacity: 0;
  pointer-events: none;
    max-height: 280px;
    overflow-y: auto;
    position: absolute
}

    .search-input.active .autocom-box {
        padding: 10px 8px;
        opacity: 1;
        pointer-events: auto;
        background-color: white;
        /*border-bottom: 1px solid #a3a3a3;*/
        box-shadow: 0 0 3px black;
        border-radius: 15px;
        width: 93%;

    }

    .autocom-box {
        z-index: 9;
    }

    .autocom-box li {
        list-style: none;
        padding: 8px 12px;
  display: none;
  width: 100%;
  cursor: default;
  border-radius: 3px;
  border-bottom: 1px solid rgb(97, 90, 90)
}

.search-input.active .autocom-box li{

  display: block;
}
.autocom-box li:hover{
    background: #efefef;
}

    .search-input .icon {
        position: absolute;
        right: 32px;
        top: 0px;
        height: 20px;
        width: 25px;
        text-align: center;
        line-height: 45px;
        font-size: 20px;
        color: #644bff;
        cursor: pointer;
    }


</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="row">
    <div class="col-xs-12 col-md-4">

    </div>

    <div class="col-xs-12 col-md-4">
        <img width="225" style="margin: 20px auto" src="{{asset('website/assets/images/logo.PNG')}}" alt=""
             class="img-responsive">
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
    icon.onclick = ()=>{
        webLink = "{{route('search')}}?q=" + selectData;
        linkTag.setAttribute("href", webLink);
        linkTag.click();
    }
    searchWrapper.classList.remove("active");
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

