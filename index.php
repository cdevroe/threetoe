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

include('app/init.php');

// Determine if Twilio is sending a request
if ( isset($_POST) && isset($_POST['Body']) ) :
  threetoe_respond();
  exit;
else : ?>

<html>
  <head>
    <title>Three Toe</title>
  </head>
  <body>
    <h1>Three Toe</h1>
    <p>A simple SMS autoresponder.</p>
    <p><small>Written by <a href="http://cdevroe.com/">Colin Devroe</a></small></p>
  </body>
</html>
<?php endif; ?>
