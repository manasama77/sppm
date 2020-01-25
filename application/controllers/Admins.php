<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admins extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_admins', 'madmins');
    $this->load->library('encrypt');
    $this->load->library('Template');
  }

  public function index()
  {
		$data['title']   = 'Admin';
		$data['content'] = 'admins/main';
		$data['vitamin'] = 'admins/main_vitamin';
    $this->template->template($data);
  }

  public function ajax_list()
  {
    $lists = $this->madmins->get_datatables();
    $data = array();
    $no = $this->input->post('start');
    foreach ($lists as $list) {
      $no++;
      $row = array();
      $row[] = $no;
      $row[] = $list->username;
      $row[] = '
      <div class="btn-group">
        <button type="button" class="btn btn-sm dark" title="Ubah Password" onClick="reset(\''.$list->id.'\', \''.$list->username.'\');"><i class="fa fa-key"></i></button>
        <button type="button" class="btn btn-sm btn-danger" title="Delete" onClick="deleted(\''.$list->id.'\', \''.$list->username.'\');"><i class="fa fa-trash"></i></button>
      </div>
      ';

      $data[] = $row;
    }

    $output = array(
      "draw"            => $this->input->post('draw'),
      "recordsTotal"    => $this->madmins->count_all(),
      "recordsFiltered" => $this->madmins->count_filtered(),
      "data"            => $data,
    );
    
    echo json_encode($output);
  }

  public function create()
  {
  	$data['title']   = 'Buat Admin Baru';
    $data['content'] = 'admins/form';
    $data['vitamin'] = 'admins/form_vitamin';
    $this->template->template($data);
  }

  public function store()
  {
		$tgl_obj  = new DateTime('now');
		$username = $this->input->post('usernamex', TRUE);
		$password = $this->encrypt->encode($this->input->post('password1'));

    $data = [
			'username'   => $username,
			'password'   => $password,
			'created_at' => $tgl_obj->format('Y-m-d H:i:s'),
			'updated_at' => $tgl_obj->format('Y-m-d H:i:s'),
    ];

    if($this->mcore->store('admin', $data)){
      echo json_encode(['code' => 200]);
      exit;
    }else{
    	echo json_encode(['code' => 500]);
      exit;
    }

  }

  public function reset()
  {
    if($this->input->method() == 'put'){
			$tgl_obj      = new DateTime('now');
			$id           = $this->input->input_stream('id', TRUE);
			$new_password = $this->input->input_stream('new_password',TRUE);
			$new_password = $this->encrypt->encode($new_password);

      $exec = $this->mcore->update('admin', ['password' => $new_password, 'updated_at' => $tgl_obj->format('Y-m-d H:i:s')], ['id' => $id]);

      if($exec){
        http_response_code(200);
      }else{
        http_response_code(500);
      }
    }else{
      http_response_code(405);
    }
  }

  public function delete($id)
  {
    $now = new DateTime('now');

    if($this->input->method() == 'delete'){
      $exec = $this->mcore->update('admin', ['deleted_at' => $now->format('Y-m-d H:i:s')], ['id' => $id]);

      if($exec){
        http_response_code(200);
      }else{
        http_response_code(500);
      }
    }else{
      http_response_code(405);
    }

  }

  public function chk_username($username)
  {
    $exec = $this->mcore->get('admin', '*', ['username' => $username, 'deleted_at' => NULL], NULL, 'ASC', NULL, NULL);
    if($exec->num_rows() == 1){
      http_response_code(400);
    }else{
      http_response_code(200);
    }

  }

}

/* End of file Admins.php */
/* Location: ./application/controllers/Admins.php */