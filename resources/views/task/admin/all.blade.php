@extends('layouts.app')

@push('css')

<link rel="stylesheet" href="{{asset('task/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

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
        <th>Title</th>
        <th>Description</th>
        <th>File</th>
        <th>Asigned User</th>
        <th>Deadline</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
      </thead>
      <tbody>
      @foreach($tasks as $task)
      <tr>
        
        <td>{{$task->id}}</td>
        <td>{{$task->title}}</td>
        <td>{{$task->description}}</td>
        <td><a href="{{asset('uploads/'.$task->file)}}" target="_blank">{{$task->file}}</a></td>
        <td>{{$task->user->name}}</td>
        <td>{{date('d-m-Y', strtotime($task->deadline))}}</td>
        <td>
            @if($task->status == 1)
                @if($task->deadline < now())
                <span class="badge bg-red">Fail to Deliver</span>
                @else
                <span class="badge bg-yellow">Pending</span>
                @endif
            @else
            <span class="badge bg-green">Done</span>
            @endif
        </td>
        <td>
        <a class="btn btn-sm btn-danger" href="#" onclick="del({{$task->id}})" ><i class="fa fa-trash"></i></a> 
        
        </td>
        @csrf
      </tr>
      @endforeach
    </table>
  </div>
  <!-- /.box-body -->
</div>

<div class="modal fade" id="addmodal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Task Assign</h4>
      </div>
      <div class="modal-body">
        <div class="box box-primary">
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" action="{{route('admin.task.store')}}" method="post" enctype="multipart/form-data" id="task">
          @csrf
          @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif
              <div class="box-body">
                  <div class="form-group">
                      <label for="title">Title</label>
                      <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title">
                  </div>
                  <div class="form-group">
                      <label for="description">Description</label>
                      <textarea type="text" class="form-control" name="description" id="description" placeholder="description"></textarea>
                  </div>
                  <div class="form-group">
                      <label for="file">File input</label>
                      <input type="file" id="file" name="file">
                  </div>
                  <div class="form-group">
                      <label for="deadline">Deadline</label>
                      <input type="date" class="form-control" id="deadline" name="deadline" placeholder="Enter deadline">
                  </div>
                  <div class="form-group">
                      <label for="user_id">Assign to User</label>
                      <select class="form-control" id="user_id" name="user_id">
                          <option></option>
                          @foreach($users as $user)
                          <option value="{{$user->id}}">{{$user->name}}</option>
                          @endforeach
                      </select>
                  </div>
              </div>
              <!-- /.box-body -->

              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Assign</button>
            </div>
          </form>
      </div>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
@endsection

@push('scripts')


<script src="{{asset('task/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('task/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>

<script>
  $(function () {
    $('#adminTable').DataTable();
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
        $('#example1').DataTable().ajax.reload();
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