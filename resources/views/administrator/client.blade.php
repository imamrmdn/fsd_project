<style>
    a.warna:visited{
    color: red !important;
    }
    a.warna:hover{
    color: red !important;
    }
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
			<div class="col-md-10 col-md-offset-1">
				<!-- Default box -->
				<div class="box">
					<div class="box-header with-border">
						<h2>Daftar Nama Client</h2>
					</div>
					<div class="box-body" style="overflow-x:auto;">
            @if(session()->has('message.level'))
                  <div class="alert alert-{{ session('message.level') }}">
                  {!! session('message.content') !!}
                  </div>
              @endif
            <table class="table">
              <thead class="thead" style="background-color: #636363;">
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Nama Client</th>
                  <th scope="col">Nama Perusahaan</th>
                  <th scope="col">Alamat Perusahaan</th>
                  <th scope="col">Logo Perusahan</th>
                  <th scope="col" style="padding-left: 69px;">Created at</th>
                </tr>
              </thead>
              @foreach ($listclient as $client)
              <tbody>
                <tr>
                  <th scope="row">{{ $no++ }}</th>
                  <td>{{ $client->Nama_Client }}</td>
                  <td>{{ $client->Nama_Perusahaan }}</td>
                  <td>{{ $client->Alamat_Perusahaan }}</td>
                  <td><img src="{{ asset($client->Logo_Url) }}" alt="images" style="width: 50px;"></td>
                  <td>{{ $client->created_at->format('d F Y | H:i:s') }}</td>
                </tr>
              </tbody>
              @endforeach
            </table>
            <br>
            <button onclick="document.getElementById('id01').style.display='block'"  class="btn btn-primary" style="width:auto;">Tambah Client <i class="fas fa-plus"></i></button>
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->
			</div>
		</div>
	</div>
  <!-- form client -->
  <div id="id01" class="modal">
    <div class="register-box">
      <form class="modal-content animate" action="/client/add" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
      <div class="imgcontainer">
        <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      </div>
      <div class="register-box-body">
          <label>Logo Perusahaan :</label>
          <div class="input-group">
              <span class="input-group-addon"><i class="fas fa-file"></i></span>
              <input type="file" name="Logo_Url" class="form-control" required>
              @if($errors->has('Logo_Url'))
                <strong>{{ $errors->first('Logo_Url') }}</strong>
              @endif
          </div>
          <br>
          <label>Nama Client :</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-male"></i></span>
                <input type="text" name="Nama_Client" class="form-control" required>
            </div>
            <br>
            <label>Nama Perusahaan :</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fas fa-building"></i></span>
                <input type="text" name="Nama_Perusahaan" class="form-control" required>
            </div>
            <br>
            <label>Alamat :</label>
            <div class="input-group">
                 <div class="input-group-addon">
                   <i class="fas fa-map-marker-alt"></i>
                 </div>
                <textarea type="text" class="form-control" id="inputEmail4" name="Alamat_Perusahaan" style="max-width: 299px; max-height: 115px; min-height: 115px;" required></textarea>
            </div>
            <br>
          <button type="submit" class="btn btn-primary" style="width: auto;">Save</button>
        </div>
      </div>
    </form>
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
