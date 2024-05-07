<div class="card-body">
    <div class="row">
        <div class="form-group col-12">
            <label for="InputTitle">Title *</label>
            <input type="text" value="{{ old('title') ?? (isset($record) ? $record->title : '') }}" name="title" class="form-control" id="InputTitle" placeholder="Enter title" required>
        </div>
        <div class="form-group col-6">
            <label for="InputNoticeDate">Notice Date *</label>
            <input type="date" value="{{ old('notice_date') ?? (isset($record) ? $record->notice_date : '') }}" name="notice_date" class="form-control" id="InputNoticeDate" placeholder="Enter notice date" required>
        </div>
        <div class="form-group col-6">
            <label for="InputPublishDate">Publish Date *</label>
            <input type="date" value="{{ old('publish_date') ?? (isset($record) ? $record->publish_date : '') }}" name="publish_date" class="form-control" id="InputPublishDate" placeholder="Enter publish date" required>
        </div>
        <div class="form-group col-12">
            @php 
                $messageToTeacher = isset($record) ? $record->getSingleMessageUser($record->id, 2) : null;
                $messageToStudent = isset($record) ? $record->getSingleMessageUser($record->id, 3) : null;
            @endphp
            <label for="InputMessageTo">Message To *</label>
            <br>
            <label for=""><input {{isset($messageToTeacher) ? 'checked' : ''}} type="checkbox" name="message_to[]" value="2"> Teacher</label>
            <label for="" class="mx-4"><input {{isset($messageToStudent) ? 'checked' : ''}} type="checkbox" class="" name="message_to[]" value="3"> Student</label>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-12">
            <label for="InputMessage">Message *</label>
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Compose New Message</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="form-group">
                        <textarea id="compose-textarea" name="message" class="form-control" style="height: 300px">@isset($record){{$record->message}}@endisset</textarea>
                    </div>
                    <!-- <div class="form-group">
                        <div class="btn btn-default btn-file">
                            <i class="fas fa-paperclip"></i> Attachment
                            <input type="file" name="attachment">
                        </div>
                        <p class="help-block">Max. 32MB</p>
                    </div> -->
                </div>
                <!-- /.card-body -->
                <!-- <div class="card-footer">
                    <div class="float-right">
                        <button type="button" class="btn btn-default"><i class="fas fa-pencil-alt"></i> Draft</button>
                        <button type="submit" class="btn btn-primary"><i class="far fa-envelope"></i> Send</button>
                    </div>
                    <button type="reset" class="btn btn-default"><i class="fas fa-times"></i> Discard</button>
                </div> -->
                <!-- /.card-footer -->
            </div>
            <span class="text-danger">{{$errors->first('email')}}</span>
        </div>
    </div>
</div>