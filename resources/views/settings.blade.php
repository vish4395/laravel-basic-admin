@extends('layouts.inner_app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{ __('Settings') }}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
              <li class="breadcrumb-item active">{{ __('Settings') }}</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
<div class="container"> 
    @if (session('status'))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
        {{ session('status') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-6">
        <div class="card card-primary card-outline">
                <div class="card-header">{{ __('Email Settings') }}</div>
                <form method="POST" action="{{ url('/sendVerificationLink') }}" id="change_email">
    @csrf
                <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label" for="email">Email*</label>
                        
                        <input type="text" name="email" value="{{Auth::user()->email}}" id="email" class="form-control" placeholder="Email" data-parsley-required="true"  />
                      </div>
                      <div class="form-group">
                        <label class="control-label" for="name">Current Password*</label>
                        <input type="password" name="current_password" value="" id="current_password" class="form-control" placeholder="Current Password" data-parsley-required="true"  />
                      </div>
                     
                    </div>
                  </div>   
                </div>
                <div class="card-footer">
    <button type="submit" class="btn btn-primary float-right save"><span class="spinner-grow spinner-grow-sm formloader"
            style="display: none;" role="status" aria-hidden="true"></span> Save</button>
            </div>

</form>
            </div>
            
        </div>
        <div class="col-md-6">
        <div class="card card-primary card-outline">
        <div class="card-header">{{ __('Password Settings') }}</div>
        <form method="POST" action="{{ url('/changePassword') }}" id="change_password">
    @csrf
                <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="control-label" for="name">{{ __('Current Password') }}*</label>
                        <input type="password" name="current_password" value="" id="current_password" class="form-control" placeholder="{{ __('Current Password') }}" data-parsley-required="true"  />
                      </div>
                      <div class="form-group">
                        <label class="control-label" for="name">{{ __('New Password') }}*</label>
                        <input type="password" name="new_password" value="" id="new_password" class="form-control" placeholder="{{ __('New Password') }}" data-parsley-required="true"  />
                      </div>
                      <div class="form-group">
                        <label class="control-label" for="name">{{ __('Confirm Password') }}*</label>
                        <input type="password" name="confirm_password" value="" id="confirm_password" class="form-control" placeholder="{{ __('Confirm Password') }}" data-parsley-required="true" data-parsley-equalto="#new_password" />
                      </div>
                    </div>
                  </div>   
                </div>
                <div class="card-footer">
    <button type="submit" class="btn btn-primary float-right save"><span class="spinner-grow spinner-grow-sm formloader"
            style="display: none;" role="status" aria-hidden="true"></span> Save</button>
            </div>

</form>
            </div>
            
        </div>
    </div>
</div>

</div>
    <!-- /.content -->

<script src="{{ asset('js/parsley.min.js') }}"></script>
<script>
$(document).ready(function(){
$('#change_email').parsley();
$('#change_password').parsley();

$("#change_email").on('submit',function(e){
  e.preventDefault();
  var _this=$(this); 
    $('#group_loader').fadeIn();
    var values = $('#change_email').serialize();
    $.ajax({
    url:'{{ url('sendVerificationLink') }}',
    dataType:'json',
    data:values,
    type:'POST',
    beforeSend: function (){before(_this)},
    // hides the loader after completion of request, whether successfull or failor.
    complete: function (){complete(_this)},
    success:function(result){
        if(result.status){
          toastr.success(result.message)
          $('#change_email')[0].reset();
          $('#change_email').parsley().reset();
        }else{
          toastr.error(result.message)
        }
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

$("#change_password").on('submit',function(e){
  e.preventDefault();
  var _this=$(this); 
    $('#group_loader').fadeIn();
    var values = $('#change_password').serialize();
    $.ajax({
    url:'{{ url('changePassword') }}',
    dataType:'json',
    data:values,
    type:'POST',
    beforeSend: function (){before(_this)},
    // hides the loader after completion of request, whether successfull or failor.
    complete: function (){complete(_this)},
    success:function(result){
        if(result.status){
          toastr.success(result.message)
          $('#change_password')[0].reset();
          $('#change_password').parsley().reset();
        }else{
          toastr.error(result.message)
        }
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


  });
</script>

@endsection
