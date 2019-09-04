<style media="screen">
  .container{
    padding-bottom: 20px;
  }
  textarea{
    max-width: auto;
    min-width: auto;
    max-height: auto;
    min-height: auto;
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
@extends('adminlte::page')
@section('title', 'FAN Intek')
@section('content_header')
@section('content')
<div > <!-- editrole -->
    <form class="modal-content animate" action="/role/edit/{{ $role->Id }}" method="post">
      {{ csrf_field() }}
    <div class="container"  style="overflow-x:auto;">
      <div class="form-row col-md-8 m-auto border pt-4 pb-4" >
        <label>Nama Role :</label>
          <div class="input-group">
               <div class="input-group-addon">
                 <i class="fa fa-male"></i>
               </div>
              <input type="text" class="form-control" id="inputrole" name="Nama_Role" value="{{ $role->Nama_Role }}" readonly>
          </div>
          <br>
          <label>Deskripsi :</label>
          <div class="input-group">
               <div class="input-group-addon">
                 <i class="fas fa-align-left"></i>
               </div>
              <textarea type="text" class="form-control" id="inputEmail4" name="Deskripsi" required>{{ $role->Deskripsi }}</textarea>
          </div>
          <br>
          <label>Data :</label>
          <div class="input-group">
               <div class="input-group-addon">
                 <i class="fas fa-folder"></i>
               </div>
              <textarea type="text" class="form-control" id="inputEmail4" name="Data" required>{{ $role->Data }}</textarea>
          </div>
          <br>
          <a href="/role/list"><button type="button" class="btn btn-danger" style="width: auto;">Cancel</button></a>
          <button type="submit" class="btn btn-primary" style="width: auto;">Save</button>
      </div>
    </div>
  </form>
</div>
@stop
@section('content')
@stop
