<div id="user_jobs">
@inject('roles', 'App\Http\Controllers\Authorization\RolesController')
    <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card">
                  <div class="card-header">{{ __('Edit Role') }}</div>
                  <div class="card-body">
                      <form method="post" action="{{route('updateRolePermission')}}">
                          @csrf
                        <div class="form-group">
                          <label>Role Name</label>
                          <input type="hidden" name="role_id" class="form-control" placeholder="Role ID" value="{{$role->id}}">
                          <input type="text" name="name" class="form-control" placeholder="Role Name" value="{{$role->name}}">
                        </div>
                        <br><br>
                        <div class="form-group">
                        <label for="name">Permissions : </label> <br>
                          <div class="form-check">
                              <input type="checkbox" class="form-check-input" name="permissions[]" id="checkpermissionAll">
                              <label class="form-check-label" for="checkpermissionAll">ALL</label>
                              <br>
                          </div>
                      <hr>
                      @php $i=1; @endphp
                      @foreach($permission_groups as $group)
                              <div class="row">
                                  <div class="col-3">
                                  <div class="form-check">
                                      <input type="checkbox" class="form-check-input" id="{{ $i }}ids" value="{{ $group->group_name }}"
                                      onclick="checkPermissionByGroup('{{ $i }}-subgroup', this)">
                                      <label class="form-check-label" for="{{ $i }}ids">{{ $group->group_name }}</label>
                                      <br>
                                  </div>
                                  </div>
                                  <div class="col-9 {{ $i }}-subgroup">
                                  @php
                                  
                                  $permissions = $roles::getpermissionsByGroupName($group->group_name);
                                  $j =1;
                                  @endphp
                                  @foreach($permissions as $row)
                                          <div class="form-check">
                                              <input type="checkbox" class="form-check-input" name="permission[] {{ $role->hasPermissionTo($row->name) ? 'checked' : '' }}" id="checkPermission{{$row->id}}" value="{{ $row->id }}">
                                              <label class="form-check-label" for="checkPermission{{$row->id}}">{{ $row->name }}</label>
                                              <br>
                                          </div>
                                          @php
                                              $j++ ;
                                          @endphp
                                  @endforeach
                                  </div>
                              </div>
                              @php
                                   $i++ ;
                              @endphp
                          @endforeach


                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                      </form>
                  </div>
                  </div>
              </div>
          </div>
      </div>

  <script>
      $("#checkpermissionAll").click(function(){
          if($(this).is(':checked')){
              //check all checkbox
              $('input[type=checkbox]').prop('checked',true);
          }else{
              //uncheck all checjbox
              $('input[type=checkbox]').prop('checked',false);
          }
      });

      function checkPermissionByGroup(className, checkThis){

          const groupIdName = $("#"+checkThis.id);
          const classCheckBox = $('.'+className+' input');
         // alert(classCheckBox);
          if(groupIdName.is(':checked')){
              classCheckBox.prop('checked',true);
          }else{
              classCheckBox.prop('checked',false);
          }
      }
      </script>
</div>
