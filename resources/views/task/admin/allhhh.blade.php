@extends('layouts.app')

@push('css')

<link rel="stylesheet" href="{{asset('task/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">

@endpush

@section('content')
<div class="box">
  <div class="box-header">
    <h3 class="box-title">Data Table With Full Features</h3>
    <button class="btn btn-xs btn-info pull-right"  data-toggle="modal" data-target="#addmodal"> <i class="fa fa-plus"></i> Add New</button>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <table id="adminTable" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th>ID</th>
        <th>User_ID</th>
        <th>Title</th>
        <th>Description</th>
        <th>File</th>
        <th>Deadline</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
      </thead>
      <tbody>
      
      </tbody>
    </table>
  </div>
  <!-- /.box-body -->
</div>
@endsection

@push('scripts')


<script src="{{asset('task/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('task/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>

<script>
  $(function () {
    var table = $('#adminTable').DataTable({
            processing: true,
            serverSide: true,
            ajax:"{{ route('admin.alltask') }}",
            column: [
              {data: 'id', name: 'id'},
              {data: 'user_id', name: 'user_id'},
              {data: 'title', name: 'title'},
              {data: 'description', name: 'description'},
              {data: 'file', name: 'file'},
              {data: 'deadline', name: 'deadline'},
              {data: 'status', name: 'status'},
              {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
          });
  })
</script>

<script>
  function del(id){
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
      url: "{{url('/admin/task-delete')}}",
      type: "post",
      data: {'id':id, '_token': token},
      success: function(res){
        console.log('ok');
      }
    });
  }
</script>
<script>
    $(function () {
        $('#task').on('submit', function(event){
            event.preventDefault();
            $.ajax({
                url: "{{route('admin.task.store')}}",
                method: "POST",
                data: new FormData(this),
                dataType: "JSON",
                processData: false,
                contentType: false,
                cache: false,
                enctype: 'multipart/form-data',
                success: function(data){
                  $("#addmodal").modal('hide');
                  $('#task').reset();
                  $('#example1').DataTable().ajax.reload();
                }
            });
        });
    })
</script>
@endpush