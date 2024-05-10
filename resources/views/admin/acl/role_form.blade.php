<div class="row">
    <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-2">
        <label for="name">
            Name *
        </label>
        <input type="text" class="form-control" name="role_name" id="role_name" placeholder="Enter Role Name" value="@isset($role){{$role->name}}@endisset" required>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between">
            <h3 class="">Permissions</h3><span class="text-lg font-weight-bold"> Assign All Permissions <input type="checkbox" class=" border-secondary" id="select-all"></span>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-4 col-6 font-weight-bold">
                Assign all view <input type="checkbox" class="check-box border-secondary" id="select-all-view">
                <hr>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-4 col-6 font-weight-bold">
                Assign all create <input type="checkbox" class="check-box border-secondary" id="select-all-create">
                <hr>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-4 col-6 font-weight-bold">
                Assign all update <input type="checkbox" class="check-box border-secondary" id="select-all-update">
                <hr>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-4 col-6 font-weight-bold">
                Assign all delete <input type="checkbox" class="check-box border-secondary" id="select-all-delete">
                <hr>
            </div>
        </div>
        <div class="row">
            <!-- <div class="">
                <div class="row">
                    <div class="col-12">
                    </div>
                </div>
            </div> -->
            @php
            $permissions = Spatie\Permission\Models\Permission::get();
            @endphp
            @foreach ($permissions as $permission)
            <div class="col-lg-3 col-md-3 col-sm-4 col-6 mb-2">
                <label for="name" class="font-weight-normal">
                    {{str_replace('_', ' ', ucfirst($permission->name))}}
                </label>
                <br>
                @php
                $words = explode(' ', str_replace('_', ' ', strtolower($permission->name)));
                $lastWord = end($words);
                $permissionIds = isset($role) ? $role->getAllPermissions()->pluck('id') : [];
                @endphp
                <input type="checkbox" @isset($permission) @if(!empty($permissionIds)) ? @if($permissionIds->contains($permission->id)) checked @endif @endif @endisset class=" border border-secondary check-box {{$lastWord}}" name="permission_id[]" value="{{$permission->id}}">
            </div>
            @endforeach
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-3">
        <button type="submit" class="d-flex btn btn-primary save-button" id="save-button">Save <div class="loader d-none"></div></button>
    </div>
</div>