<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_users extends CI_Model {

  var $table = 'admins';
  var $column_order = [null, 'username'];
  var $column_search = ['username'];
  var $order = ['id' => 'asc']; // DEFAULT ORDERNYA

  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  private function _get_datatables_query()
  {
    $this->db->from($this->table);
    $this->db->where('deleted_at IS NULL', NULL, FALSE);

    $i = 0;

    foreach ($this->column_search as $item) // loop column 
    {
      if($this->input->post('search')['value']) // if datatable send POST for search
      {
        // first loop
        if($i===0){
          // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
          $this->db->group_start();
          $this->db->like($item, $this->input->post('search')['value']);
        }else{
          $this->db->or_like($item, $this->input->post('search')['value']);
        }

        if(count($this->column_search) - 1 == $i) //last loop
        $this->db->group_end(); //close bracket
      }
      $i++;
    }

    // here order processing
    if($this->input->post('order') != NULL){
      $this->db->order_by($this->column_order[$this->input->post('order')['0']['column']], $this->input->post('order')['0']['dir']);
    }elseif(isset($this->order)){
      $order = $this->order;
      $this->db->order_by(key($order), $order[key($order)]);
    }
  }

  function get_datatables()
  {
    $this->_get_datatables_query();
    if($this->input->post('length') != -1)
      $this->db->limit($this->input->post('length'), $this->input->post('start'));
    $query = $this->db->get();
    return $query->result();
  }

  function count_filtered()
  {
    $this->_get_datatables_query();
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function count_all()
  {
    $this->db->from($this->table);
    return $this->db->count_all_results();
  }

}

/* End of file M_users.php */
/* Location: ./application/models/M_users.php */