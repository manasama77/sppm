<div class="page-header navbar navbar-fixed-top">
  <div class="page-header-inner ">
    <div class="page-logo">
      <a href="<?=site_url('dashboard');?>">
        <img src="<?=base_url('assets/global/img/').$sekolah->row()->logo;?>" alt="<?=$sekolah->row()->logo;?>" class="logo-default" width="50" style="margin: -2px 0 0 0 !important;" />
      </a>
      <div class="menu-toggler sidebar-toggler"><span></span></div>
    </div>
    <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"><span></span></a>
    <div class="top-menu">
    	<div class="tooltips btn btn-sm" style="padding-top:15px; cursor: context-menu;">
    		<a href="javascript:;" class="font-white" style="text-decoration: none; cursor: context-menu;">
    			<strong>
    				<i class="fa fa-calendar fa-fw"></i> <?=$cutoffs_from->format('j-M-Y');?> ~ <?=$cutoffs_to->format('j-M-Y');?>
    			</strong>
    		</a>
    	</div>
      <ul class="nav navbar-nav pull-right">
        <li class="dropdown dropdown-user">
          <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
            <img alt="" class="img-circle" src="<?=$pp;?>" />
            <span class="username username-hide-on-mobile"> <?=$name;?> </span>
            <i class="fa fa-angle-down"></i>
          </a>
          <ul class="dropdown-menu dropdown-menu-default">
            <li>
              <a href="page_user_profile_1.html">
                <i class="icon-user"></i> My Profile 
              </a>
            </li>
            <li class="divider"> </li>
            <li>
              <a href="<?=site_url();?>logout">
                <i class="icon-key"></i> Log Out 
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</div>