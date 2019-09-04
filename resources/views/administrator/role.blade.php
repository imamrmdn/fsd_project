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
        padding-top: 60px;
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
    textarea{
      max-width: auto;
      max-height: 115px;
      min-height: 115px;
      min-width: auto;
    }
    #inputrole{
      width: 314px;
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
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
@extends('adminlte::page')
@section('title', 'FAN Intek')
@section('content_header')
@section('content')
<div class="container-fluid spark-screen">
  <div class="row">
    <div class="col-md-8 col-md-offset-1">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h2>Role List</h2>
        </div>
        <div class="box-body"  style="overflow-x:auto;">
          <table class="table">
              <thead class="thead" style="background-color:  #636363;">
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Nama Role</th>
                  <th scope="col">Deskripsi</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
               @foreach($listrole as $role)
                <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $role->Nama_Role }}</td>
                  <td>{{ $role->Deskripsi }}</td>
                  <td>
                    @if(Auth::user()->Position_Id == 1)
                      <a href="/role/edit/{{ $role->Id }}"><i class="fas fa-edit" style="color: #ff7f24;"></i></a> |
                    @endif
                      <a href="#"><i class="fas fa-eye"></i></a>
                  </td>
                </tr>
              @endforeach
            </table>
            <br>
            <button onclick="document.getElementById('id01').style.display='block'"  class="btn btn-primary" style="width:auto;">Tambah Role <i class="fas fa-plus"></i></button>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
  </div>
</div>
<!-- form role -->
<div id="id01" class="modal">
  <div class="register-box">
    <form class="modal-content animate" action="/role/add" method="post">
      {{ csrf_field() }}
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
    </div>
    <div class="register-box-body">
        <label>Nama Role :</label>
          <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-male"></i></span>
              <input type="text" name="Nama_Role" class="form-control" required>
          </div>
          <br>
          <label>Deskripsi :</label>
          <div class="input-group">
               <div class="input-group-addon">
                 <i class="fas fa-align-left"></i>
               </div>
              <textarea type="text" class="form-control" name="Deskripsi" required></textarea>
          </div>
          <br>
          <label>Data :</label>
          <div class="input-group">
               <div class="input-group-addon">
                 <i class="fas fa-folder"></i>
               </div>
              <textarea type="text" class="form-control" name="Data" required></textarea>
          </div>
          <br>
        <button type="submit" class="btn btn-primary" style="width: auto;">Save</button>
    </div>
    </form>
  </div>
</div>

<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
@stop
@section('content')
@stop
