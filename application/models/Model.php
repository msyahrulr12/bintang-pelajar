<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model extends CI_Model {

    public function query($q)
    {
        return $this->db->query($q);
    }
	public function get($table)
    {
        return $this->db->get($table)->result_array();
    }

    public function get_where($table, $where)
    {
        return $this->db->get_where($table, $where)->result_array();
    }

    public function insert($table, $data)
    {
        $result = $this->db->insert($table, $data);

        if ($result > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function update($table, $data, $where)
    {
        $result = $this->db->update($table, $data, $where);

        if ($result > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($table, $where)
    {
        $result = $this->db->delete($table, $where);

        if ($result > 0) {
            return true;
        } else {
            return false;
        }
    }
}
