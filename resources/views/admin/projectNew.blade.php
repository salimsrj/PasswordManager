
@extends('admin.master')
@section('content')
<!-- Main content -->
<section class="content">
        <div class="row">
            <div class="col-md-12">
            @if($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul style="margin:0; list-style:none; padding:0;">
                    @foreach($errors->all() as $error)            
                    <li>{{ $error }}</li>            
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="box box-primary">
            
            <form method="post" action="/projects" role="form">
            <div class="box-body">
                @csrf
                <!-- text input -->
                <div class="form-group">
                    <label>Project Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Project Name">
                </div>
                <!-- textarea -->
                <div class="form-group">
                    <label>Project Description</label>
                    <textarea name="description" class="form-control" rows="4" placeholder="Project Description"></textarea>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

                </div>
              </form>
              
            </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection


    