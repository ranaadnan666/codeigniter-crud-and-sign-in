<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
  background-color: black;
}

* {
  box-sizing: border-box;
}

/* Add padding to containers */
.container {
  padding: 16px;
  background-color: white;
}

/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Overwrite default styles of hr */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* Set a style for the submit button */
.registerbtn {
  background-color: #04AA6D;
  color: white;
  padding: 16px 20px;

  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
  margin:auto;
}

.registerbtn:hover {
  opacity: 1;
}

/* Add a blue text color to links */
a {
  color: dodgerblue;
}
.main-login{
    width: 50%;
  margin:auto;
}
/* Set a grey background color and center the text of the "sign in" section */
.signin {
  background-color: #f1f1f1;
  text-align: center;
}
</style>
</head>
<body>

<div class="main-login">
  <?=form_open_multipart('users/login_now')?> 
    <div class="container">
    <h1>Login</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>
    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" id="email" required>
    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" id="password" required>
    <hr>

      <!-- <button type="submit">Done</button> -->
      <button type="submit" class="registerbtn">Register</button>
   
  </div>
  
  <div class="container signin">
  <p>If You are new <a href="<?= base_url('index.php/users/index') ?>">Sign Up</a>.</p>
  <p>If You are new <a href="<?= base_url('index.php/users/forgot_password') ?>">Forget Password</a>.</p>
  </div>

  <?=form_close()?>
</div>

</body>
</html>
