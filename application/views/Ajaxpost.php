<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	* {
  box-sizing: border-box;
}

input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
}

label {
  padding: 12px 12px 12px 0;
  display: inline-block;
}

input[type=submit] {
  background-color: #04AA6D;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: right;
}

input[type=submit]:hover {
  background-color: #45a049;
}

.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}

.col-25 {
  float: left;
  width: 25%;
  margin-top: 6px;
}

.col-75 {
  float: left;
  width: 75%;
  margin-top: 6px;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .col-25, .col-75, input[type=submit] {
    width: 100%;
    margin-top: 0;
  }
}
	</style>
</head>
<body>

<h2>Responsive Form</h2>
<p>Resize the browser window to see the effect. When the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other.</p>

<?=form_open_multipart('create/cr_data')?> 
    <div class="row">
      <div class="col-25">
        <label for="fname">Name</label>
      </div>
      <div class="col-75">
        <input type="text" value="" id="fname" name="name" placeholder="Your name..">
		<?=form_error('name')?>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="lname">email</label>
      </div>
      <div class="col-75">
        <input type="text" id="lname" value="" name="email" placeholder="Your email">
		<?=form_error('email')?>

      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="country">city</label>
      </div>
      <div class="col-75">
	  <input type="text" id="cname" value="" name="city" placeholder="Your city..">
		<?=form_error('city')?>
       
      </div>
    </div>

    <div class="row">
        <span id="myspan"></span>
      <button type="submit" >submit ajax</button>
  <?=form_close()?>

    </div>
</div>

</body>
<script>

function showHint() {
  var var1 = document.getElementById("fname").value;
  var var2 = document.getElementById("lname").value;
  var var3 = document.getElementById("cname").value;

  if (var1.length == 0) {
    document.getElementById("myspan").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("myspan").innerHTML = this.responseText;
      }
    };
    // Use POST request and send data in the request body
    xmlhttp.open("POST", "create/cr_data", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("name=" + var1 + "&email=" + var2 + "&city=" + var3);
  }
}
</script>
</html>
