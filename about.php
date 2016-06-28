<?php
/*
App: Three Toe
Description: A simple SMS autoresponder on top of the Twilio API
Author: Colin Devroe
Author URL: http://cdevroe.com/

------------------------------------------------------------------------
Copyright 2016 Colin Devroe

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see http://www.gnu.org/licenses.
*/

include('app/init.php'); ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ThreeToe</title>
    <link rel="stylesheet" href="<?php echo $app_url; ?>assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $app_url; ?>assets/css/styles.css">
</head>

<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header"><a class="navbar-brand navbar-link" href="<?php echo $app_url; ?>">ThreeToe </a>
                <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
            </div>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav">
                    <li role="presentation"><a href="<?php echo $app_url; ?>configure/">Configure </a></li>
                    <li class="active" role="presentation"><a href="<?php echo $app_url; ?>about.php">About </a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>About Three Toe <?php echo $app_version; ?></h1>
                <p>Three Toe is a simple SMS autoresponder built on top of the Twilio API. Send a phone number a code, get an SMS in response. It was <a href="http://cdevroe.com/2016/06/24/three-toe-a-simple-sms-autoresponder-on-top-of-the-twilio-api/">built by Colin Devroe to scratch an itch</a>.</p>
                <p>If you would like something like this, or would like to have Three Toe customized for your needs, <a href="http://cdevroe.com/hire">just ask</a>.</p>
                <p><a href="https://github.com/cdevroe/threetoe">Code available on Github</a></p>
            </div>
        </div>
    </div>
    <footer style="margin-top: 25px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                  <hr>
                    <p class="text-center">Created by <a href="http://cdevroe.com" title="Colin Devroe, programmer and photographer for hire">Colin Devroe</a>.</p>
                </div>
            </div>
        </div>
    </footer>
    <script src="<?php echo $app_url; ?>assets/js/jquery.min.js"></script>
    <script src="<?php echo $app_url; ?>assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
