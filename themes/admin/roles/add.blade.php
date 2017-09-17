<div class="box" id="role-edit" style="display: none">
    <div class="box-header with-border">
        <h3 class="box-title">Add Role</h3>
        <div class="pull-right">
            <button type="button" id="roles-all" class="btn btn-success btn-xs">
                <i class="fa fa-list" aria-hidden="true"></i> All Roles
            </button>
        </div>
    </div>
    <div class="box-body">
        <form data-action="{{site_url('roles/add')}}" method="post" class="form-horizontal" id="edit-form">
            <input type="hidden" name="ajax_submit" value="1">
            <input type="hidden" id="form_action" value="add">
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Role Name:</label>
                <div class="col-sm-10">
                    <input type="text" name="name" id="name" class="form-control">
                </div>
            </div>
            <div class="text-center">
                <div class="btn-group">
                    <input type="submit" name="submit" id="submit" value="Add Role" class="btn btn-primary">
                    <button type="button" id="cancel" class="btn btn-warning">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>

