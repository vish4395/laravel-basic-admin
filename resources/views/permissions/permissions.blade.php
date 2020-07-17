@extends('layouts.inner_app')

@section('content')
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
<!-- Content Header (Page header) -->
<?php //echo "<pre>";print_r($roles);die;?>
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{ __('Permissions') }}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
              <li class="breadcrumb-item active">{{ __('Permissions') }}</li>
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
        <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
              @can('Permission-role')
              <li class="nav-item ">
                <a class="nav-link active" id="custom-content-below-group_permissions-tab" data-toggle="pill" href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home" aria-selected="true">{{ __('Roles Permissions') }}</a>
              </li>
              @endcan
              @can('Permission-user')
              <li class="nav-item">
                <a class="nav-link" id="custom-content-below-user_permissions-tab" data-toggle="pill" href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile" aria-selected="false">{{ __('Staff Permissions') }}</a>
              </li>
              @endcan
            </ul>
           <div class="card card-primary card-outline">
            <div class="tab-content" id="custom-content-below-tabContent">
            @can('Permission-role')
              <div class="tab-pane fade active show" id="custom-content-below-home" role="tabpanel" aria-labelledby="custom-content-below-group_permissions-tab">
              <div class="card-header">
                {{ __('Roles Permissions') }}
              </div>
              <div class="card-body">
                 <table id="role_permission_listing" class="table table-bordered table-striped table-sm">
                        <thead>
                           <tr>
                               <th>Actions</th>
                                 @foreach ($roles as $role)
                                 <th>{{$role['name']}}</th>
                                 @endforeach
                            </tr>
                             @foreach ($permissions as $permission)
                                <tr>
                                  <td>{{$permission['name']}}</td>
                                 @foreach ($roles as $role)
                                  @if (in_array($permission['id'],$role['permission_ids'] ))
                                    <td><input type="checkbox" class="assign_permission" data-permission_name = "{{$permission['id']}}" data-role_id = "{{$role['id']}}" checked /></td>
                                  @else
                                     <td><input type="checkbox" class="assign_permission" data-permission_name = "{{$permission['id']}}" data-role_id = "{{$role['id']}}"/></td>
                                  @endif
                                 @endforeach
                                </tr>
                             @endforeach
                        </thead>
                 </table>
              </div>
              </div>
              @endcan
              @can('Permission-user')
              <div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel" aria-labelledby="custom-content-below-user_permissions-tab">
              <div class="card-header">
                {{ __('Staff Permissions') }}
              </div>
              <div class="card-body">
                <div class="table-responsive">
              <table id="permissionsUser_listing" class="table table-bordered table-striped table-sm">
                  <thead>
                      <tr>                             
                             <th>{{ __('Email') }}</th>
                             <th>{{ __('Name') }}</th>
                             <th class="actions">{{ __('Actions') }}</th>
                       </tr>
                  </thead>
               </table>
               </div>
               </div>
              </div>
              @endcan
            </div>
          </div>
          <!-- /.card -->        
        </div>
    </div>
</div>

</div>
    <!-- /.content -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
<script type="text/javascript">
  var userdatatable="";
  $(document).ready(function(){
    userdatatable = $('#permissionsUser_listing').DataTable({
        processing: true,
        serverSide: true,
         "fnDrawCallback" : function() {
              $('#permissionsUser_listing').width("100%");
             },
        ajax: "{!!route('ajax.permUserdata') !!}",
        columns: [
            { data: 'email', name: 'email' },
            { data: 'name', name: 'name' },
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
    });

    $('.assign_permission').change(function(e){
        var action = '';
        if($(this).is(':checked'))
        {
            action = 'insert';
            
        }else{
            action = 'delete';
        }
        var permission_name = $(this).attr('data-permission_name');
        var role_id = $(this).attr('data-role_id');
        assign_permission_to_role(action,permission_name,role_id);
      });
      
      function assign_permission_to_role(action,permission_name,role_id)
      {
        // console.log(action+"and"+permission_name+"and"+role_id);
        var p_name = permission_name;
        var u_id = role_id;
        if(action == 'insert')
        {
            url_link="{!! url('permissions/add_role_permission' ) !!}" + "/" + u_id+'/'+p_name;
        }else{
             url_link="{!! url('permissions/delete_role_permission' ) !!}" + "/" + u_id+'/'+p_name;
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