@extends('layouts.inner_app')

@section('content')
 
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}"> 
<!-- Content Header (Page header) -->
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{ __('Staff') }}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
              <li class="breadcrumb-item active">{{ __('Staff') }}</li>
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
                <div class="card-header">{{ __('Manage Staff') }}
                @can('Staff-create')
              <a href="#" class="btn btn-primary float-right" title="{{ __('Add Staff') }}" data-toggle="modal" data-target="#add_modal" ><i class="fa fa-plus"></i> {{ __('Add') }}</a>
              @endcan
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                    <table  id="staff_listing" class="table table-striped table-bordered table-sm">
                        <thead>
                            <tr>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('Created At') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

</div>
    <!-- /.content -->

<!-- Modals -->

<div class="modal fade" id="add_modal">
        <div class="modal-dialog">
          <div class="modal-content">
          <form method="POST" action="{{ url('api/staff') }}" id="add_staff">
          @csrf
            <div class="modal-header">
              <h4 class="modal-title">Add New Staff</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label" for="name">Name*</label>
                        <input type="text" name="name" value="" id="name" class="form-control" placeholder="Name" data-parsley-required="true"  />
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label" for="email">Email*</label>
                        <input type="text" name="email" value="" id="email" class="form-control" placeholder="Email" data-parsley-required="true"  />
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label" for="password">Password*</label>
                        <input type="password" name="password" value="" id="password" class="form-control" placeholder="Password" data-parsley-required="true"  />
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label" for="confirm_password">Confirm password*</label>
                        <input type="password" name="confirm_password" value="" id="confirm_password" class="form-control" placeholder="Confirm password" data-parsley-required="true"  />
                      </div>
                    </div>
                  </div>                    
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                      <label>Roles</label>
                        <div class="select2-primary">
                          <select name="roles[]" class="select2" multiple="multiple" data-placeholder="Select roles" data-dropdown-css-class="select2-primary" style="width: 100%;" data-parsley-required="true" >
                          @foreach ($roles as $role)
                              <option value="{{ $role->id }}">{{ $role->name }}</option>
                          @endforeach
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>                    
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary save"><span class="spinner-grow spinner-grow-sm formloader" style="display: none;" role="status" aria-hidden="true"></span> Save</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

<div class="modal fade" id="editModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Staff</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                  <div id="edit_staff_response"></div>  
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

<!-- /Modals -->

<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/parsley.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
<script>
var ajax_datatable;
$(document).ready(function(){
$('#add_staff').parsley();
$('.select2').select2();
ajax_datatable = $('#staff_listing').DataTable({
    processing: true,
    serverSide: true,
    ajax: '{{ url('api/staff') }}',
    columns: [
      { data: 'name', name: 'name' },
      { data: 'email', name: 'email' },
      { data: 'created_at', name: 'created_at' },
      {data: 'id', name: 'id', orderable: false, searchable: false}
    ],
    rowCallback: function(row, data, iDisplayIndex) {     
      var links='';
      @can('Staff-edit')
      links += `<a href="#" data-staff_id="${data.id}" title="Edit Details" class="btn btn-primary btn-xs edit_staff mr-1" ><span class="fa fa-edit"></span></a>`;
      @endcan
      @can('Staff-delete')
      links += `<a href="#" data-staff_id="${data.id}" title="Delete staff" class="btn btn-danger btn-xs delete_staff mr-1" ><span class="fa fa-trash"></span></a>`;
      @endcan
      $('td:eq(3)', row).html(links);
      },
});

@can('Staff-create')
$("#add_staff").on('submit',function(e){
  e.preventDefault();
  var _this=$(this); 
    $('#group_loader').fadeIn();
    var values = $('#add_staff').serialize();
    $.ajax({
    url:'{{ url('api/staff') }}',
    dataType:'json',
    data:values,
    type:'POST',
    beforeSend: function (){before(_this)},
    // hides the loader after completion of request, whether successfull or failor.
    complete: function (){complete(_this)},
    success:function(result){
          toastr.success(`Staff ${result.name} has been created!`)
          setTimeout(function(){$('#disappear_add').fadeOut('slow')},3000)
          $('#add_staff')[0].reset();
          $('#add_staff').parsley().reset();
          ajax_datatable.draw();
      },
    error:function(jqXHR,textStatus,textStatus){
      if(jqXHR.responseJSON.errors){
        $.each(jqXHR.responseJSON.errors, function( index, value ) {
          toastr.error(value)
        });
      }else{
        toastr.error(jqXHR.responseJSON.message)
      }
    }
      });
      return false;   
    });
@endcan
@can('Staff-edit')
//Edit staff
$(document).on('click','.edit_staff',function(e){
    e.preventDefault();
    $('#edit_staff_response').empty();
    id = $(this).attr('data-staff_id');
    $.ajax({
       url:'{{url('staff/edit')}}/'+id,
       dataType: 'html',
       success:function(result)
       {
        $('#edit_staff_response').html(result);
       } 
    });
    $('#editModal').modal('show');
 });
@endcan
@can('Staff-delete')
$(document).on('click','.delete_staff',function(e){
      e.preventDefault();
      var response = confirm('Are you sure want to delete this staff?');
      if(response){
        id = $(this).data('staff_id');
        $.ajax({
          type: 'post',
          data: {_method: 'delete', _token: "{{ csrf_token() }}"},
          dataType:'json',
          url: "{!! url('api/staff' )!!}" + "/" + id,
          success:function(){
            toastr.success('{{ __('Staff is deleted successfully') }}');
            ajax_datatable.draw();
          },   
          error:function(jqXHR,textStatus,textStatus){
            console.log(jqXHR);
            toastr.error(jqXHR.statusText)
          }
      });
      }
      return false;
    }); 
@endcan



  });
</script>

@endsection
