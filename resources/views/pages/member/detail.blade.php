@extends('adminlte::page')

@section('title', 'Detail Member')

@section('content_header')
<h1>Detail Member</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
      <div class="card-tools">
      </div>
    </div>
    <div class="card-body">
        <ul class="list-group list-group-flush">
            <li class="list-group-item">NIK : <b>{{$data->nik}}</b></li>
            <li class="list-group-item">Name : <b>{{$data->name}}</b></li>
            <li class="list-group-item">Gender : <b>
                @if ($data->gender == "L")
                Laki-Laki
                @else
                    Perempuan
                @endif 
            </b></li>
            <li class="list-group-item">Birthday : <b>{{$data->birthday}}</b></li>
            <li class="list-group-item">Address :<b>{{$data->address}}</b></li>
          </ul>
    </div>
    <div class="card-footer">
    </div>
</div>

@stop

@section('css')
{{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
<script>

</script>
@stop
