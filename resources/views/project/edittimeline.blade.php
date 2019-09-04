<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
@extends('adminlte::page')
@section('title', 'FAN Intek')
@section('content_header')
@section('content')
<div class="box">
  <div class="box-body" style="overflow-x:auto;">
    <form action="/project/{{ $listtimeline->Id }}/{{ $detail_project->Id }}/timeline/edit" method="post">
      {{ csrf_field() }}

        <label>Modul :</label>
        <div class="input-group">
            <span class="input-group-addon"><i class="fas fa-cube"></i></span>
            <input type="text" name="Modul" value="{{ $listtimeline->Modul }}" class="form-control" required>
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
        <a href="/action/view/{{ $detail_project->Id }}"><button type="button" class="btn btn-danger">Cancel</button></a>
        <button type="submit" class="btn btn-primary" style="width: auto;">Save</button>

  </form>
  </div>
</div>
@stop
@section('content')
@stop
