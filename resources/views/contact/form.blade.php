<div class="modal fade" id="modal-form" tabindex="1" role="dialog" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog dialog-lg">
        <div class="modal-content">
            <form  action="" method="post" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('POST') }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss ="model" aria-label="Close">
                        <span aria-hidden="true"> &times;</span>
                    </button>
                    <h3 class="modal-title"></h3>
                </div>

                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    <div class="form-group">
                        <label for="name" class="col-md-3 control-label">Name</label>
                        <div class="col-md-6">
                            <input type="text" id="name" name="name" class="form-control" autofocus required>
                            <span class="help-block with-error"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-md-3 control-label">Email</label>
                        <div class="col-md-6">
                            <input type="email" id="email" name="email" class="form-control" autofocus required>
                            <span class="help-block with-error"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="photo" class="col-md-3 control-label">photo</label>
                        <div class="col-md-6">
                            <input type="file" id="photo" name="photo" class="form-control" autofocus>
                            <span class="help-block with-error"></span>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary btn-save" type="submit">Submit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>