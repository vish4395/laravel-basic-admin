<form method="PUT" action="{{ url('api/staff/'.$staff->id) }}" id="edit_role">
    @csrf
    <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label" for="name">Name*</label>
                        <input type="text" name="name" value="{{$staff->name}}" id="edit_name" class="form-control" placeholder="Name" data-parsley-required="true"  />
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label" for="email">Email*</label>
                        <input type="text" name="email" value="{{$staff->email}}" id="edit_email" class="form-control" placeholder="Email" data-parsley-required="true"  />
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-md-6">
                        <label class="control-label" for="password">Password*</label>
                        <input type="password" name="password" value="" id="edit_password" class="form-control" placeholder="Password"  />
                    </div>
                    <div class="col-md-6">
                        <label class="control-label" for="confirm_password">Confirm password*</label>
                        <input type="password" name="confirm_password" value="" id="edit_confirm_password" class="form-control" placeholder="Confirm password" data-parsley-equalto="#edit_password"/>
                    </div>
                    <div class="col-md-12">
                      <span class="text-muted">{{__('Leave blank if you don’t want to change password.')}}</span>
                    </div>
                  </div>                    
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                      <label>Roles</label>
                        <div class="select2-primary">
                          <select name="roles[]" class="select2" multiple="multiple" data-placeholder="Select roles" data-dropdown-css-class="select2-primary" style="width: 100%;" data-parsley-required="true" >
                          @foreach ($roles as $role)
                              <option value="{{ $role->id }}" {{ (in_array($role->name,$staff_roles))?'selected':'' }}>{{ $role->name }}</option>
                          @endforeach
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>    

    <hr style="margin: 1em -15px">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary float-right save"><span class="spinner-grow spinner-grow-sm formloader"
            style="display: none;" role="status" aria-hidden="true"></span> Save</button>

</form>

<script>
    $(document).ready(function(){
$('.select2').select2();
$('#edit_role').parsley();
$("#edit_role").on('submit',function(e){ 
  e.preventDefault();
  var _this=$(this); 
    $('#group_loader').fadeIn();
    var values = $('#edit_role').serialize();
    $.ajax({
    url:'{{ url('api/staff/'.$staff->id) }}',
    dataType:'json',
    data:values,
    type:'PUT',
    beforeSend: function (){before(_this)},
    // hides the loader after completion of request, whether successfull or failor.
    complete: function (){complete(_this)},
    success:function(result){
          toastr.success(`User ${result.name} has been Updated!`)
          setTimeout(function(){$('#disappear_add').fadeOut('slow')},3000)
          $('#edit_role').parsley().reset();
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
});
</script>