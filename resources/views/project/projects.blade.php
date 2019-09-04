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
						<h2>List Project</h2>
					</div>
					<div class="box-body" style="overflow-x:auto;">
            @if(session()->has('message.level'))
                  <div class="alert alert-{{ session('message.level') }}">
                  {!! session('message.content') !!}
                  </div>
              @endif
            <table class="table table-striped">
              <thead class="thead" style="background-color: #636363;">
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Nama Project</th>
                  <th scope="col">Status Project</th>
                  <th scope="col">Nama Client</th>
                  <!-- <th scope="col">Upload By</th> -->
                  <th scope="col">Action</th>
                </tr>
              </thead>
              @foreach ($listproject as $project)
              <tbody>
                <tr>
                  <th scope="row">{{ $no++ }}</th>
                  <td>{{ $project->Nama_Project }}</td>
                  <td>
                    @if($project->Status_Project == 1)
                      <button type="button" class="btn btn-success" style="background-color: green; height: 32px; width: 114;" disabled>Done</button>
                    @else
                      <button type="button" class="btn btn-danger" style="background-color: red; height: 32px; width: 114;" disabled>On Progress</button>
                    @endif
                  </td>
                  <td>{{ $project->clientDetail->Nama_Client }} - ( {{  $project->clientDetail->Nama_Perusahaan }} )</td>
                  <!-- <td>{{ $project->Upload_By }}</td> -->
                  <td>
                    @if($project->Upload_By ==  Auth::user()->name )
                      <a class="warna" href="/action/view/{{ $project->Id }}"><i class="fas fa-eye" style="color: green;"></i></a> |
                      <a href="/project/{{ $project->Id }}/delete" onclick="return confirm('Anda Yakin Ingin Menghapus?')";><i class="far fa-trash-alt" style="color: #cd2626;"></i></a>
                    @else
                      <button class="btn btn-danger" type="button" name="button" disabled>Not Access</button>
                    @endif
                  </td>
                </tr>
              </tbody>
              @endforeach
            </table>
            <br>
            <button onclick="document.getElementById('id01').style.display='block'"  class="btn btn-primary" style="width:auto;">Tambah Project <i class="fas fa-plus"></i></button>
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->
			</div>
		</div>
	</div>
  <!-- form project -->
  <div id="id01" class="modal">
    <div class="register-box">
            <form class="modal-content animate" action="/project/add" method="post">
              {{ csrf_field() }}
              <div class="imgcontainer">
                <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
              </div>
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
          <div class="register-box-body">
                <label>Nama Project :</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fas fa-project-diagram"></i></span>
                    <input type="text" name="Nama_Project" class="form-control" required>
                </div>
                <br>
                <label>Status Project :</label>
                <div class="input-group">
                    <span class="input-group-addon"></span>
                    <select class="form-control" name="Status_Project">
                      <option value="1">Done</option>
                      <option value="2">On Progress</option>
                    </select>
                </div>
                <br>
                <label>Nama Client :</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fas fa-user-tie"></i></span>
                    <select class="form-control" name="Client_Id">
                      @foreach ($listclient as $client)
                        <option value="<?= $client['Id'] ?>"><?= $client['Nama_Client'] ?></option>
                      @endforeach
                    </select>
                </div>
                <br>
                <button type="submit" class="btn btn-primary" style="width: auto;">Save</button>
            </form>
        </div>
        <!-- /.form-box -->
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
