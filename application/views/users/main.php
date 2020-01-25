<div class="page-content">

  <!-- BEGIN PAGE BAR -->
  <!--div class="page-bar">
    <ul class="page-breadcrumb">
      <li>
        <a href="<?=site_url();?>dashboard">Dashboard</a>
      </li>
    </ul>
  </div-->
  <!-- END PAGE BAR -->

  <!-- BEGIN PAGE TITLE-->
  <h1 class="page-title"> List Users</h1>
  <!-- END PAGE TITLE-->

  <!-- END PAGE HEADER-->
  <div class="row">
    <div class="col-md-12 ">
      <!-- BEGIN Portlet PORTLET-->
      <div class="portlet box green-meadow">
        <div class="portlet-title">
          <div class="caption">
            <i class="fa fa-table"></i>List Users
          </div>
          <div class="tools">
            <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
            <a href="" class="fullscreen" data-original-title="" title=""> </a>
            <a id="refresh" href="javascript:;" class="reload" data-original-title="Reload Table" title="Reload Table"> </a>
          </div>
          <div class="actions" style="margin-right:10px;">
            <a href="<?=site_url();?>users/create" class="btn btn-sm grey-mint">
              <i class="fa fa-plus"></i> Create New User
            </a>
          </div>
        </div>
        <div class="portlet-body" style="display: block;">
          <div class="table-responsive">
            <table id="table" class="table table-striped table-hover" style="width:100% !important;">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Username</th>
                  <th width="100px" class="text-center"><i class="fa fa-cogs"></i></th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>#</th>
                  <th>Username</th>
                  <th><i class="fa fa-cogs"></i></th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<div class="modal fade" id="modal-reset">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" >&times;</button>
        <h4 class="modal-title">Reset Password</h4>
      </div>
      <form id="form-reset">
        <div class="modal-body">
            <div clas="form-group">
              <label for="username">Username</label>
              <input type="text" class="form-control" id="username" name="username" readonly>
            </div>
            <div clas="form-group">
              <label for="new_password">New Password</label>
              <input type="text" class="form-control" id="new_password" name="new_password">
            </div>    
        </div>
        <div class="modal-footer">
          <input type="hidden" id="id" name="id">
          <button type="submit" class="btn btn-primary">Save changes</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>