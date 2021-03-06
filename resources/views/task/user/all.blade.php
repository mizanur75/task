@extends('layouts.user.app')

@push('css')

<link rel="stylesheet" href="{{asset('task/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">

@endpush

@section('content')
<div class="box">
  <div class="box-header">
    <h3 class="box-title">Data Table With Full Features</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Description</th>
        <th>File</th>
        <th>Asigned Time</th>
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
        <td>{{date('d-m-Y', strtotime($task->created_at))}}</td>
        <td>{{date('d-m-Y', strtotime($task->deadline))}}</td>
        <td>
        @php($date = date('d-m-Y', strtotime(now())))
        @php($deadline = date('d-m-Y', strtotime($task->deadline)))
          @if($task->status == 1)
              @if($deadline >= $date)
                <span class="badge bg-yellow">Pending</span>
              @else
              <span class="badge bg-red">Fail</span>
              @endif
          @else
          <span class="badge bg-green">Delivered</span>
          @endif
        </td>
        <td>
          @if($task->status == 1)
              @if($deadline >= $date)
              <a href="#" onclick="update({{$task->id}})">
                <span class="badge bg-yellow">Deliver Task</span>
              </a>
              @else
              <span class="badge bg-red">Fail to Deliver</span>
              @endif
          @else
          <span class="badge bg-green">Done</span>
          @endif
        </td>
        
      </tr>
      @endforeach
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
    $('#example1').DataTable();
  })
</script>
<script>
    function update(id){
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
      url: "{{url('/user/task-userupdate')}}",
      type: "post",
      dataType: "JSON",
      data: {'id':id, '_token': token},
      success: function(res){
        console.log(res);
        $('#example1').DataTable().ajax.reload();
      }
    });
  }
</script>
@endpush