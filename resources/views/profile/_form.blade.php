<div class="card-body">
    <div class="form-group">
        <label for="InputPassword">Old Password *</label>
        <input type="password" name="old_password" value="{{old('old_password')}}" class="form-control" id="InputPassword" placeholder="Enter old password" required>
    </div>
    <div class="form-group">
        <label for="InputNewPassword">New Password *</label>
        <input type="password" name="new_password" class="form-control" id="InputNewPassword" placeholder="Enter new password" required>
    </div>
    <div class="form-group">
        <label for="InputConfirmPassword">Confirm Password *</label>
        <input type="password" name="confirm_password" class="form-control" id="InputConfirmPassword" placeholder="Enter new password again" required>
    </div>
</div>