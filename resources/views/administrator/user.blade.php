<style>
    ody {font-family: Arial, Helvetica, sans-serif;}

    /* Full-width input fields */
    input[type=text], input[type=password] {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }

    /* Set a style for all buttons */
    button {
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 100%;
    }

    button:hover {
        opacity: 0.8;
    }

    /* Extra styles for the cancel button */
    .cancelbtn {
        width: auto;
        padding: 10px 18px;
        background-color: #f44336;
    }

    /* Center the image and position the close button */
    /* .imgcontainer {
        text-align: center;
        margin: 24px 0 12px 0;
        position: relative;
    }
     */
    .container {
        padding: 16px;
    }

    span.psw {
        float: right;
        padding-top: 16px;
    }

    /* The Modal (background) */
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        padding-top: -10px;
    }

    /* Modal Content/Box */
    .modal-content {
        background-color: #fefefe;
        margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
        border: 1px solid #888;
        width: 100%; /* Could be more or less, depending on screen size */
    }

    /* The Close Button (x) */
    .close {
        position: absolute;
        right: 25px;
        top: 0;
        color: #000;
        font-size: 35px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: red;
        cursor: pointer;
    }

    /* Add Zoom Animation */
    .animate {
        -webkit-animation: animatezoom 0.6s;
        animation: animatezoom 0.6s
    }

    @-webkit-keyframes animatezoom {
        from {-webkit-transform: scale(0)}
        to {-webkit-transform: scale(1)}
    }

    @keyframes animatezoom {
        from {transform: scale(0)}
        to {transform: scale(1)}
    }

    /* Change styles for span and cancel button on extra small screens */
    @media screen and (max-width: 300px) {
        span.psw {
           display: block;
           float: none;
        }
        .cancelbtn {
           width: 100%;
        }
    }
    table {
      border-collapse: collapse;
      border-spacing: 0;
      width: 100%;
      border: 1px solid #ddd;
    }

    th, td {
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even){background-color: #f2f2f2}
</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
@extends('adminlte::page')
@section('title', 'FAN Intek')
@section('content_header')
@section('content')
<div class="container-fluid spark-screen">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h2>User List</h2>
        </div>
        <div class="box-body" style="overflow-x:auto;">
          <input class="form-control" id="myInput" type="text" placeholder="Search.." style="width: auto;">
          @if(session()->has('message.level'))
                <div class="alert alert-{{ session('message.level') }}">
                {!! session('message.content') !!}
                </div>
            @endif
          <br>
          <table class="table table-striped">
              <thead class="thead" style="background-color: #636363;">
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Username</th>
                  <th scope="col">Email</th>
                  <th scope="col">No Handphone</th>
                  <th scope="col" style="text-align: center;">Created at</th>
                  <th scope="col">Status</th>
                  @if(Auth::user()->Position_Id == 1)
                    <th scope="col">Action</th>
                  @endif
                </tr>
              </thead>
              @foreach($listuser as $user)
              <tbody id="myTable">
                <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->email }}</td>
                  <td style="text-align: center;">{{ $user->phone }}</td>
                  <td>{{ date('d F Y | H:i:s', strtotime($user->created_at)) }}</td>
                  <td> active </td>
                  @if(Auth::user()->Position_Id == 1)
                  <td><a href="#"><i class="fas fa-eye" style="color: #66cd00;"></i></a> |
                      <a href="/user/delete/{{ $user->id }}"><i class="far fa-trash-alt" style="color: #cd2626;"></i></a>
                  </td>
                  @endif
                </tr>
              </tbody>
              @endforeach
            </table>
            <br>
            @if(Auth::user()->Position_Id == 1)
              <button type="submit" onclick="document.getElementById('id01').style.display='block'" class="btn btn-primary" style="width: auto;">Tambah User <i class="fas fa-plus"></i></button>
            @endif
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
  </div>
</div>
<!-- form user -->
<div id="id01" class="modal">
  <div class="register-box">

          <form class="modal-content animate" action="/user/add" method="post">
            {{ csrf_field() }}
            <div class="imgcontainer">
              <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
            </div>
              <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <div class="register-box-body">
              <div class="input-group">
                  <span class="input-group-addon"><i class="fas fa-user"></i></span>
                  <input type="text" name="name" class="form-control" value="" placeholder="Full name" required>
              </div>
              <br>
              <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                  <input type="email" name="email" class="form-control" value="" placeholder="Email">
              </div>
              <br>
              <div class="input-group">
                  <span class="input-group-addon"><i class="fas fa-key"></i></span>
                  <input type="password" name="password" class="form-control" placeholder="Password">
              </div>
              <br>
              <div class="input-group">
                  <span class="input-group-addon"><i class="fas fa-key"></i></span>
                  <input type="password" name="password_confirmation" class="form-control" placeholder="Retype password">
              </div>
              <br>
              <div class="input-group">
                  <span class="input-group-addon"><i class="fas fa-user-tie"></i></span>
                  <select class="form-control" name="Position_Id">
                    @foreach ($listrole as $role)
                      <option value="<?= $role['Id'] ?>"><?= $role['Nama_Role'] ?></option>
                    @endforeach
                  </select>
              </div>
              <br>
              <div class="input-group">
                  <span class="input-group-addon"><i class="fas fa-mobile-alt"></i></span>
                  <input type="text" name="phone" placeholder="Phone number" class="form-control">
              </div>
              <br>
              <div class="input-group">
                  <span class="input-group-addon"><i class="fas fa-map-marker-alt"></i></span>
                  <textarea id="home-address" type="text" class="form-control" name="address" style="max-width: 299px; max-height: 115px; min-height: 115px;" required></textarea>
              </div>
              <br>
              <button type="submit" class="btn btn-primary" style="width: auto;">Save</button>
          </form>
      </div>
      <!-- /.form-box -->
  </div><

  <script>
  // Get the modal
  var modal = document.getElementById('id01');

  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
      if (event.target == modal) {
          modal.style.display = "none";
      }
  }

    $(document).ready(function(){
    $("#myInput").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#myTable tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });
  </script>
@stop
@section('content')
@stop
