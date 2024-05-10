<div class="card-body">
    <div class="form-group">
        <label for="InputFullName">Full Name *</label>
        <input type="text" value="{{ old('name') ?? (isset($record) ? $record->name : '') }}" name="name" class="form-control" id="InputFullName" placeholder="Enter full name" required>
    </div>
    <div class="form-group">
        <label for="InputEmail">Email address *</label>
        <input type="email" value="{{ old('email') ?? (isset($record) ? $record->email : '') }}" name="email" class="form-control" id="InputEmail" placeholder="Enter email" required>
        <span class="text-danger">{{$errors->first('email')}}</span>
    </div>
    <div class="form-group">
        <label for="InputPassword">Password</label>
        <input type="password" name="password" class="form-control" id="InputPassword" placeholder="Password">
        <p>If you want to change the password, Enter a new Password</p>
    </div>
    <div class="form-group">
        <label for="InputRole">Select Role</label>
        <select name="role_id" class="form-control" required>
            <option value="">Select Role</option>
            @foreach($roles as $role)
                <option value="{{$role->id}}" {{ old('email') ?? (isset($record) && $record->role_id == $role->id ? 'selected' : '') }}>{{$role->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="InputProfilePicture">Profile Picture <span class="text-danger">*</span></label>
        <input type="file" value="{{ old('profile_pic') ?? (isset($record) ? $record->profile_pic : '') }}" name="profile_pic" class="form-control" id="InputProfilePicture">
        <span class="text-danger">{{$errors->first('profile_pic')}}</span>
        <div class="row mt-2">
            <div class="col-12">
                <img src="@isset($record){{$record->getProfilePic()}}@else{{url('public/images/avatar.png')}}@endisset" class="border rounded" width="100px" height="100px" alt="">
            </div>
        </div>
    </div>
</div>