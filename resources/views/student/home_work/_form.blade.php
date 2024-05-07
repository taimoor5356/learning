<div class="card-body">
    <div class="row">
        <div class="form-group col-12">
            <label for="InputDocument">Document *</label>
            <input type="file" value="{{ old('document') ?? (isset($record) ? $record->document : '') }}" name="document" class="form-control" id="InputDocument">
        </div>
        <div class="form-group col-12">
            <label for="InputMessage">Message *</label>
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Compose New Message</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <textarea id="compose-textarea" name="message" class="form-control" style="height: 300px">@isset($record){{$record->description}}@endisset</textarea>
                    </div>
                </div>
            </div>
            <span class="text-danger">{{$errors->first('email')}}</span>
        </div>
    </div>
</div>