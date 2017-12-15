<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<html>
<head>
    <title>Not found | IABS</title>
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="GOOGLEBOT" content="index no-follow"/>
    <meta name="apple-mobile-web-app-capable" content="yes" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=no" />
</head>
<body>
    <style type="text/css">
        * {
            margin: 0;
            padding: 0;
        }
        body {
            background-color: #fff;
            color: #ccc;
            font-family: "Futura Bk BT","Lucida Grande",sans-serif;
            height: 100%;
            width: 100%;
        }

        a {
            color: #f79422;
            text-decoration: none;
            display: inline-block;
        }

        .input {
            border: 1px solid #f79422;
            padding: 10px;
            width: 350px;
        }
        .button {
            background-color: transparent;
            border: 1px solid #f79422;
            color: #f79422;
            cursor: pointer;
            padding: 10px;
            transition: all 0.3s ease;
        }

        .button:hover {
            background-color: #f79422;
            color: #fff;
            border: 1px solid #f79422;
        }

        #errorbody {
            text-align: center;
            width: auto;
            margin: 30px 0;
        }

        .errorheader {
            margin-bottom: 10px;
        }
        .errorheader h2 {
            font-size: 200px;
        }
        .errorheader h4 {
            font-size: 30px;
            margin: 40px 0 40px 0;
        }

        .erroroptions h4 {
            text-align: center;
            text-transform: uppercase;
            font-size: 20px;
            margin: 20px 0 20px 0;
        }

        .errorlinks {
            margin: 0 20px 0;
        }

        .hire, .update {
            border: 1px solid #f79422;
            padding: 10px;
            transition: all 0.5s ease;
        }

        .hire:hover, .update:hover {
            color: #fff;
            background-color: #f79422;
        }


        /* ==========================================================================
            Responsive
        ========================================================================== */


        /* TABLET
        ---------------------------------------------------------------------------*/
        @media only screen and (max-width: 1100px) and (min-width: 768px) {
            input {
            width: 300px;
            margin-right: 0;
        }
        .errorheader {
            padding-top: 100px;
        }
        .errorheader h2 {
            font-size: 140px;
        }
        .errorheader h4 {
            font-size: 20px;
            margin: 40px 0 40px 0;
        }

        .erroroptions h4 {
            font-size: 16px;
            margin: 20px 0 20px 0;
        }
        }


        /* 10.2 SMALL TABLET
        ---------------------------------------------------------------------------*/
        @media only screen and (max-width: 767px) {
        input {
            width: 260px;
        }
        .errorheader {
            padding-top: 100px;
        }
        .errorheader h2 {
            font-size: 130px;
        }
        .errorheader h4 {
            font-size: 17px;
            margin: 40px 0 40px 0;
        }
        .erroroptions h4 {
            font-size: 16px;
            margin: 20px 0 20px 0;
        }
        }
        @media only screen and (min-width: 600px) {

        }


        /* 10.3 PHONE
        ---------------------------------------------------------------------------*/
        @media only screen and (max-width: 599px) {

            .container { width: 450px; }

            #home-section-container { margin-top: 20px; }

            h1#welcome-msg {
                width: 0;
                height: 0;
                opacity: 0;
            }
            h1#welcome-msg-mobile { display: block; }
            #logo img {
                width: 165px;
                height: 57px;
            }

            .flickr-feed li img {
                width: 61px;
                height: 61px;
            }

        }


        /* 10.4 SMALL PHONE
        ---------------------------------------------------------------------------*/
        @media only screen and (max-width: 479px) {
            #pageTopRest #menu2 {
                display: none;
            }

            #pageTopLogo {
            height: 57px;
            width: 120px;
            margin: 30px 0 0 20px;
            transition: all 1s ease-in-out;
        }

        }
    </style>
    <div id="errorbody">
        <div class="errorheader">
            <h2>Oops!</h2>
            <p>Error Number: 404</p>
            <h4>We tried hard to find what you were looking for but could not find it...</h4>
        </div>
        <div class="erroroptions">
            <div class="errorlinks">
                <a class="hire" href="#">Go home</a>
            </div>
        </div>
    </div>
</body>
</html>