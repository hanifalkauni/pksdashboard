@extends('adminlte::page')

@section('title', 'List Member')

@section('content_header')
<h1>List Members</h1>
@stop

@section('content')
{{-- notifikasi sukses --}}
@if ($sukses = Session::get('success'))
<div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button> 
    <strong>{{ $sukses }}</strong>
</div>
@endif
<div class="card">
    <div class="card-header">
      {{-- <a href="/admin/member" class="btn btn-success"><i class="fa fa-plus-square"></i> Add Member</a>  --}}
      <div class="card-tools">
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#importModal">
            <i class="fa fa-upload" aria-hidden="true"></i> Import Data
        </button>
        <a href="{{url('/admin/export')}}" class="btn btn-info"><i class="fa fa-download" aria-hidden="true"></i> Export Data</a>
      </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover" id="table_member">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIK</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Birthday</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                $no=1;
                @endphp
                @foreach ($data as $item)
                <tr>
                    <td style="width:5%">{{$no++}}</td>
                    <td>{{$item->nik}}</td>
                    <td>{{$item->name}}</td>
                    <td>
                        @if ($item->gender == "L")
                            Laki-Laki
                        @else
                            Perempuan
                        @endif  
                    </td>
                    <td>{{$item->birthday}}</td>
                    <td>{{$item->address}}</td>
                    <td>
                        <a href="/admin/member/{{$item->id}}" class="btn btn-success"><i class="fa fa-info-circle" aria-hidden="true"></i> Detail</a>
                        <a href="/admin/member/{{$item->id}}/edit" class="btn btn-info"><i class="fa fa-pencil-square-o"></i> Edit</a>
                        <div>
                        <form method="POST" action="{{ route('member.destroy', $item->id ) }}">
                            @csrf
                            <input name="_method" type="hidden" value="DELETE">
                            <button type="submit" class="btn btn-danger show_confirm" data-toggle="tooltip" title='Delete'> <i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        </div>
                        {{-- <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" data-id={{$item->id}}>
                            <i class="fa fa-trash-o" aria-hidden="true"></i> Delete
                        </button> --}}
                        {{-- <a href="" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a> --}}
                    </td>
                </tr>  
                @endforeach
            </tbody>
          </table>
    </div>
    <div class="card-footer">
    </div>
  </div>



  <!-- Modal -->
  <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post" action="{{url('/admin/import')}}" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
                </div>
                <div class="modal-body">
                    <a href="{{url('/admin/export_format')}}">Fomat Excel click here</a><hr>
                    {{ csrf_field() }}

                    <label>Pilih file excel</label>
                    <div class="form-group">
                        <input type="file" name="file" required="required">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Import</button>
                </div>
            </div>
        </form>
    </div>
  </div>



@stop

@section('css')
<link rel="stylesheet" href="{{asset('font-awesome/css/font-awesome.min.css')}}">
{{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css"> --}}
@stop

@section('js')
{{-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script>
$(document).ready( function () {
    $('#table_member').DataTable();
} );

$('.show_confirm').click(function(event) {
          var form =  $(this).closest("form");
          var name = $(this).data("name");
          event.preventDefault();
          swal({
              title: `Are you sure you want to delete this record?`,
              text: "If you delete this, it will be gone forever.",
              icon: "warning",
              buttons: true,
              dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              form.submit();
            }
          });
      });
</script>
@stop

