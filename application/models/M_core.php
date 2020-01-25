<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_core extends CI_Model {

  public function get($table, $select = '*', $where = NULL, $orderBy = NULL, $orderOrien = 'ASC', $limit = NULL, $offset = NULL)
  {
    $this->db->select($select);
    if($where != NULL){
      $this->db->where($where);
    }
    $this->db->order_by($orderBy, $orderOrien);
    return $this->db->get($table, $limit, $offset);
  }

  public function store($table, $object)
  {
    return $this->db->insert($table, $object);
  }

  public function store_batch($table, $object)
  {
    return $this->db->insert_batch($table, $object);
  }

  public function update($table, $object, $where)
  {
    $this->db->where($where);
    return $this->db->update($table, $object);
  }

  public function delete($table, $where)
  {
    $this->db->where($where);
    return $this->db->delete($table);
  }

  

}

/* End of file M_core.php */
/* Location: ./application/models/M_core.php */