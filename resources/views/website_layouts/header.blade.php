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


</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="row">
    <div class="col-xs-12 col-md-4">

    </div>

    <div class="col-xs-12 col-md-4">
        <img width="225" style="margin: 20px auto" src="{{asset('website/assets/images/logo.PNG')}}" alt="" class="img-responsive">
    </div>
    <div class="col-xs-12 col-md-4">

    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-md-3 ">

    </div>

    <div class="col-xs-12 col-md-6 ">


        <input class="form-control  rounded-pill " type="search" placeholder="Seach for the name"
               id="example-search-input2" style="width: 100%; border-radius: 20px; text-align: center;">


    </div>
    <div class="col-xs-12 col-md-3 ">

    </div>
</div>

