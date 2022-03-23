@extends('adminlte::page')

@section('title', 'Edit Member')

@section('content_header')
<h1>Edit Member</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
      <div class="card-tools">
      </div>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('member.update', $data->id ) }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            @method('PUT')
            <div class="form-group">
              <label for="nik">NIK:</label>
              <input type="text" class="form-control" placeholder="Enter NIK" id="nik" name="nik" value="{{$data->nik}}">
            </div>
            <div class="form-group">
              <label for="name">Name:</label>
              <input type="text" class="form-control" placeholder="Enter Name" id="name" name="name" value="{{$data->name}}">
            </div>
            <div class="form-group">
              <label for="date">Birthday:</label>
              <input type="date" class="form-control" placeholder="Enter Birthday" id="birthday" name="birthday" value="{{$data->birthday}}">
            </div>
            <div class="form-group">
                <label for="gender">Gender:</label>
                <select class="form-control" id="gender" name="gender">
                    @if($data->gender == "L")
                        <option value="L" selected>Laki-Laki</option>
                        <option value="P">Perempuan</option>
                    @else
                        <option value="L">Laki-Laki</option>
                        <option value="P" selected>Perempuan</option>
                    @endif
                </select>
              </div>
              <div class="form-group">
                <label for="date">Address:</label>
                <x-adminlte-textarea name="address" placeholder="Insert Address">{{$data->address}}</x-adminlte-textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
          
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
