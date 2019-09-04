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
/*
    .image{
      background-image: url('/css/Fan.png');
      background-repeat: no-repeat;
      display: inline-block;
      background-size: 200px;
      width: 200px;
      height: 200px;
    }
    #upload{
      margin-top: 180px;
      margin-left: 20px;
    } */
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
					<div class="box-body">
            <div id="exTab2">
              <ul class="nav nav-tabs">
                  <li class="active">
                      <a  href="#1" data-toggle="tab">Timeline</a>
                  </li>
                  <li>
                      <a href="#2" data-toggle="tab">Document</a>
                  </li>
                  <li>
                      <a href="#3" data-toggle="tab">Setting</a>
                  </li>
              </ul>
            			<div class="tab-content ">

                    <!--- Timeline --->
            			  <div class="tab-pane active" id="1" style="overflow-x:auto;">
                      @if(session()->has('message.level'))
                            <div class="alert alert-{{ session('message.level') }}">
                            {!! session('message.content') !!}
                            </div>
                        @endif
                      <table class="table">
                        <thead class="thead-light">
                          <tr style="text-align: center;">
                            <th scope="col">No</th>
                            <th scope="col" style="text-align: center">Modul</th>
                            <th scope="col" style="padding-left: 150px">Timeline</th>
                            <th scope="col" style="padding-left: 20px">PIC</th>
                            <th scope="col" style="text-align: center">Status</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        @foreach($listtimeline as $timeline)
                          <tr>
                            <td>{{ $no++ }}</td>
                            <td style="text-align: center">{{ $timeline->Modul }}</td>
                            <td style="text-align: center"><b>{{ date('d F Y', strtotime($timeline->Tanggal_awal)) }}</b> sampai
                                <b>{{ date('d F Y', strtotime($timeline->Tanggal_akhir)) }}</b>
                            </td>
                            <td>{{ $timeline->PIC }}</td>
                            <td>@if($timeline->Status == 1)
                                  <button type="button" class="btn btn-success" style="background-color: green; height: 32px;" disabled>Done</button>
                                @else
                                  <button type="button" class="btn btn-danger" style="background-color: red; height: 32px;" disabled>On Progress</button>
                                @endif
                            </td>
                            <td style="text-align: center;">
                                | <a href="/project/{{ $timeline->Id }}/{{ $detail_project->Id }}/timeline/edit"><i class="fas fa-edit" style="color: #ff7f24;"></i></a>
                            </td>
                          </tr>
                        @endforeach
                      </table>
                      <button onclick="document.getElementById('id01').style.display='block'" type="button" class="btn btn-primary" style="width:auto;">Create</button>
                      <a href="/exportTimelineToExcel/xlsx/{{ $detail_project->Id }}"><button type="button" class="btn btn-success" style="width:auto;">Export Timeline to Excel</button></a>
            				</div>

                    <!--- Document --->
            				<div class="tab-pane" id="2" style="overflow-x:auto;">
                      <table class="table">
                        <thead class="thead-light">
                          <tr style="text-align: center;">
                            <th scope="col">No</th>
                            <th scope="col">Documents name</th>
                            <th scope="col" style="padding-left: 50px;">Upload date</th>
                            <th scope="col">Upload By</th>
                            <th scope="col">Action</th>
                          </tr>
                          @foreach($listdoc as $doc)
                            <tr>
                              <td>{{ $nod++ }}</td>
                              <td>{{ $doc->Nama_Dokumen }}</td>
                              <td>{{ $doc->created_at->format('d F Y | H:i:s') }}</td>
                              <td style="padding-left: 25px;">{{ $doc->Upload_By }}</td>
                              <td><a href="#"><i class="fas fa-eye" style="color: green;"></i></a>
                                  | <a href="/project/{{ $doc->Id }}/{{ $detail_project->Id }}/documents/delete" onclick="return confirm('Anda Yakin Ingin Menghapus?')";><i class="far fa-trash-alt" style="color: #cd2626;"></i></a>
                              </td>
                            </tr>
                          @endforeach
                        </thead>
                      </table>
                      <button onclick="document.getElementById('id02').style.display='block'" type="button" class="btn btn-primary" style="width:auto;">Upload Doc.</button>
            				</div>

                    <!--- Setting --->
                    <div class="tab-pane" id="3" style="overflow-x:auto;">
                      <div class="panel-body">
                        <table>
                          <tr>

                          </tr>
                        </table>
                          <form action="/project/setting/{{ $detail_project->Id }}" method="post" style="width:700px">
                          {{ csrf_field() }}
                            <div class="form-row col-sm-8 col-sm-2" style="float:right;width:400px;">

                                <input type="text" class="form-control" id="inputEmail4" name="Nama_Project" value="{{ $detail_project->Nama_Project }}" placeholder="Project Name" style="width: 227px" readonly>
                                <br>
                                <select class="form-control" name="Nama_Client" style="width: 227px">
                                  @foreach ($listclient as $client)
                                    <option value="<?= $client['Id'] ?>" {{ ($detail_project->Client_Id == $client['Id']) ? 'selected' : null }}><?= $client['Nama_Perusahaan'] ?></option>
                                  @endforeach
                                </select>
                                <br>
                                <select class="form-control" name="Status_Project" style="width: 227px">
                                  <option value="1" {{ ($detail_project->Status_Project == 1) ? 'selected' : null }}>Done</option>
                                  <option value="2" {{ ($detail_project->Status_Project == 2) ? 'selected' : null }}>On Progress</option>
                                </select>
                                <br>
                              <button class="btn btn-primary" type="submit" name="save" value ="save" style="width: 226;">Save</button>
                            </div>
                          </form>

                      </div>
            				</div>
            			</div>
              </div>
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->
			</div>
		</div>
	</div>
  <!-- add timeline -->
  <div id="id01" class="modal">
    <div class="register-box">
            <form class="modal-content animate" action="/project/{{ $detail_project->Id }}/timeline/add" method="post">
              {{ csrf_field() }}
              <div class="imgcontainer">
                <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
              </div>
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
          <div class="register-box-body">
                <label>Modul :</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fas fa-cube"></i></span>
                    <input type="text" name="Modul" class="form-control" required>
                </div>
                <br>
                <label>Start Date :</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fas fa-calendar-alt"></i></span>
                    <input type="date" name="Tanggal_awal" class="form-control" required>
                </div>
                <br>
                <label>End Date :</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fas fa-calendar-alt"></i></span>
                    <input type="date" name="Tanggal_akhir" class="form-control" required>
                </div>
                <br>
                <label>PIC :</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fas fa-user-tie"></i></span>
                    <input type="text" name="PIC" class="form-control" required>
                </div>
                <br>
                <label>Status :</label>
                <div class="input-group">
                    <span class="input-group-addon"></span>
                    <select class="form-control" name="Status">
                      <option value="1">Done</option>
                      <option value="2">On Progress</option>
                    </select>
                </div>
                <br>
                <button type="submit" class="btn btn-primary" style="width: auto;">Save</button>
          </div>
        </form>
    </div>
  </div>
   <!-- adddocuments -->
  <div id="id02" class="modal">
    <div class="register-box">
    <form class="modal-content animate" action="/project/{{ $detail_project->Id }}/documents/add" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}
    <div class="imgcontainer">
      <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
    </div>
    <div class="register-box-body">
        <label>Upload Documents :</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fas fa-file"></i></span>
                <input type="file" name="Document_Url" class="form-control" required>
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
  var modal = document.getElementById('id02');

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
