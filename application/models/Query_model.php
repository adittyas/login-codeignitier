<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Query_model extends CI_Model
{
    public function allData($table, $selectField = 'all')
    {
        if ($selectField == 'all') {
            return $this->db->get($table)->result_array();
        } else {
            return $this->db->select($selectField)->get($table)->result_array();
        }
    }
    public function singleData($table, $data, $selectField = 'all')
    {
        if ($selectField == 'all') {
            return $this->db->get_where($table, $data)->row_array();
        } else {
            return $this->db->select($selectField)->get_where($table, $data)->row_array();
        }
    }
    public function dataById($table)
    {
        return $this->db->get_where($table, array('id' => $this->input->post('id', true)))->result_array();
    }
    public function insertData($table, $data)
    {
        $this->db->insert($table, $data);
    }
    public function updateData($where = [], $table, $data = [])
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
    public function deleteData($where = [], $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
}