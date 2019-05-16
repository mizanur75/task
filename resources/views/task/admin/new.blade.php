@extends('layouts.app')

@push('css')

@endpush

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Task Assign</h3>
    </div>
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

        <div class="box-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
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
                    alert();
                }
            });
        });
    })
</script>
@endpush