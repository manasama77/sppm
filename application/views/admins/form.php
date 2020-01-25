<div class="page-content">

  <!-- BEGIN PAGE TITLE-->
  <h1 class="page-title"> Buat Admin Baru</h1>
  <!-- END PAGE TITLE-->

  <!-- END PAGE HEADER-->
  <div class="row">
    <div class="col-md-12 ">
      <div class="portlet light portlet-fit portlet-form bordered">
        <div class="portlet-body">

          <form id="form-create" class="form-horizontal">
            <input type="text" id="username" name="username" class="sr-only">
            <input type="password" id="password" name="password" class="sr-only">
            <div class="form-group  margin-top-20">
              <label class="control-label col-md-2" for="usernamex">Username
                <span class="required"> * </span>
              </label>
              <div class="col-md-4">
                <div class="input-icon right">
                  <i class="fa"></i>
                  <input type="text" class="form-control" id="usernamex" name="usernamex" autofocus />
                </div>
              </div>
            </div>
            <div class="form-group  margin-top-20">
              <label class="control-label col-md-2" for="password1">Password
                <span class="required"> * </span>
              </label>
              <div class="col-md-4">
                <div class="input-icon right">
                  <i class="fa"></i>
                  <input type="password" class="form-control" id="password1" name="password1" />
                </div>
              </div>
            </div>
            <div class="form-group  margin-top-20">
              <label class="control-label col-md-2" for="password2">Re-type Password
                <span class="required"> * </span>
              </label>
              <div class="col-md-4">
                <div class="input-icon right">
                  <i class="fa"></i>
                  <input type="password" class="form-control" id="password2" name="password2" />
                </div>
              </div>
            </div>
            <div class="form-actions">
              <div class="row">
                <div class="col-md-offset-2 col-md-9">
                  <button type="submit" class="btn green">Submit</button>
                  <a href="<?=site_url();?>admins/index" class="btn default">Cancel</a>
                </div>
              </div>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>