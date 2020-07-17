@extends('layouts.inner_app')

@section('content')
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
<!-- Content Header (Page header) -->
<?php //echo "<pre>";print_r($user_permission);die;?>
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{ __('Permissions') }}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ url('/permissions') }}">{{ __('Permissions') }}</a></li>
              <li class="breadcrumb-item active">{{$user['name']}}</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
           <div class="card card-primary card-outline">
          <div class="card-header">
            <h3 class="card-title">
            {{ __('Staff Permissions') }} - {{$user['name']}}
            </h3>
          </div>
          <div class="card-body">
               <table id="user_permission_listing" class="table table-bordered table-striped table-sm">
                        <thead>
                           <tr>
                               <th>Actions/User</th>
                               <th>{{$user['name']}}</th>
                            </tr>
                            <tbody>
                             @foreach ($permissions as $permission)
                                <tr>
                                  <td>{{$permission['name']}}</td>
                                  @if (in_array($permission['id'],$user_permission))
                                    <td><input type="checkbox" class="assign_permission" 
                                 data-permission_name = "{{$permission['id']}}" data-user_id = "{{$user['id']}}" checked /></td>
                                  @else
                                     <td><input type="checkbox" class="assign_permission" data-permission_name = "{{$permission['id']}}" data-user_id = "{{$user['id']}}"/></td>
                                  @endif
                                </tr>
                             @endforeach
                         </tbody>
                        </thead>
                        
                 </table>
          </div>
          <!-- /.card -->
        </div>
        </div>
    </div>
</div>

</div>
    <!-- /.content -->
<script type="text/javascript">
 $(document).ready(function(){
        
    $('.assign_permission').change(function(e){
        var action = '';
        if($(this).is(':checked'))
        {
            action = 'insert';
            
        }else{
            action = 'delete';
        }
        var permission_name = $(this).attr('data-permission_name');
        var user_id = $(this).attr('data-user_id');
        assign_permission_to_user(action,permission_name,user_id);
      });
      
      function assign_permission_to_user(action,permission_name,user_id)
      {
        console.log(action+"and"+permission_name+"and"+user_id);
        var p_name = permission_name;
        var u_id = user_id;
        if(action == 'insert')
        {
            url_link="{!! url('permissions/add_user_permission' ) !!}" + "/" + u_id+'/'+p_name;
        }else{
             url_link="{!! url('permissions/delete_user_permission' ) !!}" + "/" + u_id+'/'+p_name;
        }
        $.ajax({
          url:url_link,
          dataType:'json',
          type:'GET',
          success:function(result){
              if(result.status==1)
              {  
                toastr.success(result.message);
              }
              else
              {
                toastr.error(result.message);
              }
              
            }
            });
            return false;   
      } 
    });
</script>
@endsection