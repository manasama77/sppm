<?php
defined('BASEPATH') OR exit('No direct script access allowed');

# DEFAULT
$route['default_controller']   = 'login';
$route['404_override']         = '';
$route['translate_uri_dashes'] = FALSE;

# UTILITY
$route['dummy/(:any)']['get'] = 'login/dummy/$1';
$route['logout']['get']       = 'login/logout';
$route['auth']['post']        = 'login/auth';

# DASHBOARD
$route['dashboard']['get']                 = 'dashboard/index';
$route['dashboard/total_admins']['get']    = 'dashboard/total_admins';
$route['dashboard/total_guru']['get']      = 'dashboard/total_guru';
$route['dashboard/total_siswa']['get']     = 'dashboard/total_siswa';
$route['dashboard/data_bday_guru']['get']  = 'dashboard/data_bday_guru';
$route['dashboard/data_bday_siswa']['get'] = 'dashboard/data_bday_siswa';
$route['test']['get']                      = 'dashboard/test';

# admins
$route['admin']['get']                  = 'admins/index';
$route['ajax_list_admin']['post']       = 'admins/ajax_list';
$route['create_admin']['get']           = 'admins/create';
$route['store_admin']['post']           = 'admins/store';
$route['reset_admin']['put']            = 'admins/reset';
$route['delete_admin/(:num)']['delete'] = 'admins/delete/$1';
$route['chk_username/(:any)']['get']    = 'admins/chk_username/$1';

# guru
$route['guru/index']['get']            = 'guru/index';
$route['guru/resign']['get']           = 'guru/resign';
$route['guru/show/(:any)']['get']      = 'guru/show/$1';
$route['guru/create']['get']           = 'guru/create';
$route['guru/store']['post']           = 'guru/store';
$route['guru/edit/(:any)']['get']      = 'guru/edit/$1';
$route['guru/update']['put']           = 'guru/update';
$route['guru/resigned']['put']         = 'guru/resigned';
$route['guru/delete/(:any)']['delete'] = 'guru/delete/$1';
$route['guru/reset']['put']            = 'guru/reset';
$route['guru/chk_nik/(:num)']['get']   = 'guru/chk_nik/$1';

# siswa
$route['siswa/index']['get']             = 'siswa/index';
$route['siswa/lulus']['get']             = 'siswa/lulus';
$route['siswa/berhenti']['get']          = 'siswa/berhenti';
$route['siswa/show/(:any)']['get']       = 'siswa/show/$1';
$route['siswa/create']['get']            = 'siswa/create';
$route['siswa/store']['post']            = 'siswa/store';
$route['siswa/edit/(:any)']['get']       = 'siswa/edit/$1';
$route['siswa/update']['post']           = 'siswa/update';
$route['siswa/berhentis']['put']         = 'siswa/berhentis';
$route['siswa/delete/(:any)']['delete']  = 'siswa/delete/$1';
$route['chk_nis/(:any)']['get']          = 'siswa/chk_nis/$1';
$route['get_kecamatan/(:num)']['get']    = 'siswa/get_kecamatan/$1';
$route['get_desa/(:num)']['get']         = 'siswa/get_desa/$1';
$route['get_siswa/(:any)/(:num)']['get'] = 'siswa/get_siswa/$1/$2';

# SPP
$route['spp/index']['get']                      = 'spp/index';
$route['spp/create']['get']                     = 'spp/create';
$route['spp/show/(:num)/(:any)']['get']         = 'spp/show/$1/$2';
$route['spp/show_nominal/(:num)/(:any)']['get'] = 'spp/show_nominal/$1/$2';
$route['spp/store']['post']                     = 'spp/store';


# setup
$route['setup/aplikasi']['get']         = 'setup/aplikasi';
$route['setup/update_aplikasi']['post'] = 'setup/aplikasi_update';

$route['setup/periode']['get']          = 'setup/periode';
$route['setup/periode/ganti']['get']    = 'setup/ganti_periode';
$route['setup/periode/update']['post']    = 'setup/update_periode';

$route['setup_kelas']['get']            = 'setup/kelas';
$route['show_kelas/(:num)']['get']      = 'setup/show_kelas/$1';
$route['get_kelas']['get']              = 'setup/get_kelas';
$route['store_kelas']['post']           = 'setup/store_kelas';
$route['edit_kelas/(:num)']['get']      = 'setup/edit_kelas/$1';
$route['update_kelas']['put']           = 'setup/update_kelas';
$route['delete_kelas/(:num)']['delete'] = 'setup/delete_kelas/$1';
