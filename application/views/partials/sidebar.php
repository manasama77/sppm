<div class="page-sidebar-wrapper">
	<div class="page-sidebar navbar-collapse collapse">
		<!-- BEGIN SIDEBAR MENU -->
		<ul class="page-sidebar-menu page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
			<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
			<li class="sidebar-toggler-wrapper hide">
				<div class="sidebar-toggler"><span></span></div>
			</li>
			<!-- END SIDEBAR TOGGLER BUTTON -->

			<li class="nav-item start <?=($this->uri->segment(1) == 'dashboard')? 'active': '';?>">
				<a href="<?=site_url();?>dashboard" class="nav-link">
					<i class="fa fa-dashboard"></i>
					<span class="title">Dashboard</span>
				</a>
			</li>
			<li class="heading">
				<h3 class="uppercase <?=(in_array($this->uri->segment(1), ['admin', 'create_admin']))? 'font-green': '';?>">Management Super Admin</h3>
			</li>
			<li class="nav-item <?=(in_array($this->uri->segment(1), ['admin', 'create_admin']))? 'active': '';?>">
				<a href="javascript:;" class="nav-link nav-toggle">
					<i class="fa fa-user-secret fa-fw"></i>
					<span class="title">Super Admin</span>
					<span class="arrow <?=(in_array($this->uri->segment(1), ['admin', 'create_admin']))? 'open': '';?>"></span>
				</a>
				<ul class="sub-menu active">
					<li class="nav-item <?=($this->uri->segment(1) == 'create_admin')? 'active': '';?>">
						<a href="<?=site_url();?>create_admin" class="nav-link ">
							<span class="title"><i class="fa fa-user-secret fa-fw"></i> Buat Super Admin Baru</span>
						</a>
					</li>
					<li class="nav-item <?=($this->uri->segment(1) == 'admin')? 'active': '';?>">
						<a href="<?=site_url();?>admin" class="nav-link ">
							<span class="title"><i class="fa fa-user-secret fa-fw"></i> List Super Admin</span>
						</a>
					</li>
				</ul>
			</li>

			<li class="heading">
				<h3 class="uppercase <?=($this->uri->segment(1) == 'guru')? 'font-green': '';?>">Management Guru</h3>
			</li>

			<li class="nav-item start <?=($this->uri->segment(1) == 'guru' && $this->uri->segment(2) == 'create')? 'active': '';?>">
				<a href="<?=site_url();?>guru/create" class="nav-link">
					<span class="title"><i class="fa fa-user-plus fa-fw"></i> Buat Guru Baru</span>
				</a>
			</li>
			<li class="nav-item <?=($this->uri->segment(1) == 'guru' && $this->uri->segment(2) != 'create')? 'active': '';?>">
				<a href="javascript:;" class="nav-link nav-toggle">
					<i class="fa fa-users fa-fw"></i>
					<span class="title">Master Guru</span>
					<span class="arrow <?=($this->uri->segment(1) == 'guru' && $this->uri->segment(2) != 'create')? 'open': '';?>"></span>
				</a>
				<ul class="sub-menu active">
					<li class="nav-item <?=($this->uri->segment(1) == 'guru' && $this->uri->segment(2) == 'index')? 'active': '';?>">
						<a href="<?=site_url();?>guru/index" class="nav-link ">
							<span class="title"><i class="fa fa-user fa-fw"></i> List Guru Aktif</span>
						</a>
					</li>
					<li class="nav-item <?=($this->uri->segment(1) == 'guru' && $this->uri->segment(2) == 'resign')? 'active': '';?>">
						<a href="<?=site_url();?>guru/resign" class="nav-link ">
							<span class="title"><i class="fa fa-user fa-fw"></i> List Guru Resign</span>
						</a>
					</li>
				</ul>
			</li>

			<li class="heading">
				<h3 class="uppercase <?=($this->uri->segment(1) == 'siswa')? 'font-green': '';?>">Management Siswa</h3>
			</li>

			<li class="nav-item start <?=($this->uri->segment(1) == 'siswa' && $this->uri->segment(2) == 'create')? 'active': '';?>">
				<a href="<?=site_url();?>siswa/create" class="nav-link">
					<span class="title"><i class="fa fa-user-plus fa-fw"></i> Buat Siswa Baru</span>
				</a>
			</li>
			<li class="nav-item <?=($this->uri->segment(1) == 'siswa' && $this->uri->segment(2) != 'create')? 'active': '';?>">
				<a href="javascript:;" class="nav-link nav-toggle">
					<i class="fa fa-users fa-fw"></i>
					<span class="title">Master Siswa</span>
					<span class="arrow <?=($this->uri->segment(1) == 'siswa' && $this->uri->segment(2) != 'create')? 'open': '';?>"></span>
				</a>
				<ul class="sub-menu active">
					<li class="nav-item <?=($this->uri->segment(1) == 'siswa' && $this->uri->segment(2) == 'index')? 'active': '';?>">
						<a href="<?=site_url();?>siswa/index" class="nav-link ">
							<span class="title"><i class="fa fa-user fa-fw"></i> List Siswa Aktif</span>
						</a>
					</li>
					<li class="nav-item <?=($this->uri->segment(1) == 'siswa' && $this->uri->segment(2) == 'lulus')? 'active': '';?>">
						<a href="<?=site_url();?>siswa/lulus" class="nav-link ">
							<span class="title"><i class="fa fa-graduation-cap fa-fw"></i> List Siswa Lulus</span>
						</a>
					</li>
					<li class="nav-item <?=($this->uri->segment(1) == 'siswa' && $this->uri->segment(2) == 'berhenti')? 'active': '';?>">
						<a href="<?=site_url();?>siswa/berhenti" class="nav-link ">
							<span class="title"><i class="fa fa-user fa-fw"></i> List Siswa Berhenti</span>
						</a>
					</li>
				</ul>
			</li>

			<li class="nav-item <?=($this->uri->segment(1) == 'spp')? 'active': '';?>">
				<a href="javascript:;" class="nav-link nav-toggle">
					<i class="fa fa-book fa-fw"></i>
					<span class="title">SPP Management</span>
					<span class="arrow <?=($this->uri->segment(1) == 'spp' && $this->uri->segment(2) != 'create')? 'open': '';?>"></span>
				</a>
				<ul class="sub-menu active">
					<li class="nav-item <?=($this->uri->segment(1) == 'spp' && $this->uri->segment(2) == 'create')? 'active': '';?>">
						<a href="<?=site_url();?>spp/create" class="nav-link ">
							<span class="title"><i class="fa fa-plus-circle fa-fw"></i> Bayar SPP</span>
						</a>
					</li>
					<li class="nav-item <?=($this->uri->segment(1) == 'spp' && $this->uri->segment(2) == 'index')? 'active': '';?>">
						<a href="<?=site_url();?>spp/index" class="nav-link ">
							<span class="title"><i class="fa fa-file-text fa-fw"></i> Data SPP</span>
						</a>
					</li>
					<li class="nav-item <?=($this->uri->segment(1) == 'spp' && $this->uri->segment(2) == 'tunggakan')? 'active': '';?>">
						<a href="<?=site_url();?>siswa/lulus" class="nav-link ">
							<span class="title"><i class="fa fa-asterisk fa-fw"></i> Tunggakan SPP</span>
						</a>
					</li>
				</ul>
			</li>

			<li class="heading">
				<h3 class="uppercase <?=(in_array($this->uri->segment(1), ['setup']))? 'font-green': '';?>">Setup</h3>
			</li>
			<li class="nav-item start <?=($this->uri->segment(1) == 'setup' && $this->uri->segment(2) == 'aplikasi')? 'active': '';?>">
				<a href="<?=site_url();?>setup/aplikasi" class="nav-link">
					<i class="fa fa-cog"></i>
					<span class="title">Aplikasi</span>
				</a>
			</li>
			<li class="nav-item start <?=($this->uri->segment(1) == 'setup' && $this->uri->segment(1) == 'periode')? 'active': '';?>">
				<a href="<?=site_url();?>setup/periode" class="nav-link">
					<i class="fa fa-cog"></i>
					<span class="title">periode</span>
				</a>
			</li>
			<li class="nav-item start <?=($this->uri->segment(1) == 'setup_kelas')? 'active': '';?>">
				<a href="<?=site_url();?>setup_kelas" class="nav-link">
					<i class="fa fa-building"></i>
					<span class="title">Kelas</span>
				</a>
			</li>

		</ul>
	</div>
</div>