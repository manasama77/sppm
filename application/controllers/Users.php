<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_core', 'mcore');
    $this->load->model('M_users', 'musers');
    $this->load->library('Template');
  }

  public function index()
  {
    $data['content'] = 'users/main';
    $data['vitamin'] = 'users/main_vitamin';
    $this->template->template($data);
  }

  public function ajax_list()
  {
    $lists = $this->musers->get_datatables();
    $data = array();
    $no = $this->input->post('start');
    foreach ($lists as $list) {
      $no++;
      $row = array();
      $row[] = $no;
      $row[] = $list->username;
      $row[] = '
      <div class="btn-group">
        <button type="button" class="btn btn-sm dark" title="Reset Password" onClick="reset(\''.$list->id.'\', \''.$list->username.'\');"><i class="fa fa-key"></i></button>
        <button type="button" class="btn btn-sm btn-danger" title="Delete" onClick="deleted(\''.$list->id.'\', \''.$list->username.'\');"><i class="fa fa-trash"></i></button>
      </div>
      ';

      $data[] = $row;
    }

    $output = array(
      "draw"            => $this->input->post('draw'),
      "recordsTotal"    => $this->musers->count_all(),
      "recordsFiltered" => $this->musers->count_filtered(),
      "data"            => $data,
    );
    
    //output to json format
    echo json_encode($output);
  }

  public function create()
  {
    $data['content'] = 'users/form';
    $data['vitamin'] = 'users/form_vitamin';
    $this->template->template($data);
  }

  public function store()
  {
    $username = $this->input->post('usernamex', TRUE);
    $password = md5($this->input->post('password1').SALT);

    $data = [
      'username' => $username,
      'password' => $password,
    ];

    if($this->mcore->store('admins', $data)){
      http_response_code(200);
    }else{
      http_response_code(500);
    }

  }

  public function reset()
  {
    if($this->input->method() == 'put'){
      $id = $this->input->input_stream('id', TRUE);
      $new_password = $this->input->input_stream('new_password',TRUE);
      $new_password = md5($new_password.SALT);

      $exec = $this->mcore->update('admins', ['password' => $new_password], ['id' => $id]);

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
      $exec = $this->mcore->update('admins', ['deleted_at' => $now->format('Y-m-d H:i:s')], ['id' => $id]);

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
    $exec = $this->mcore->get('admins', '*', ['username' => $username], NULL, 'ASC', NULL, NULL);
    if($exec->num_rows() == 1){
      http_response_code(400);
    }else{
      http_response_code(200);
    }

  }

}

/* End of file Users.php */
/* Location: ./application/controllers/Users.php */