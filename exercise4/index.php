<?php
require_once "pdo.php";
session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP/AJAX Exercise</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">


</head>
  <body class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-8 text-center mt-5">
        <h1>Exercise 4 | PHP/AJAX</h1>
      </div>
      <div class="col-12 ">
        <button data-bs-toggle="modal" data-bs-target="#userModal"  onclick="EditUser(0)" class="float-end btn btn-xs btn-primary m-3">New User Information</button>
          <div id="table-data"></div>
      </div>
    </div>
    
  


<script src="https://code.jquery.com/jquery-3.5.0.js"></script>
<script src="crud.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>



<!-- MODAL -->
<div class="modal fade" id="userModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="userModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">User's Information</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="userForm"></div>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnSaveUser" class="btn btn-primary">Save changes</button>
        <button type="button"  class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- TOAST-->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
  <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <span class='toast-icon bi-info-circle'></span>
      <strong class="me-auto">&nbsp; Notifications</strong>
      <!-- <small>11 mins ago</small> -->
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
      <div id="toast-msg"></div>
    </div>
  </div>
</div>