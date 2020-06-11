<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Test_model extends CI_Model
{

    public function getById($id)
    {
        $this->db->select('id,username,gender,email,avatar_img,nationality,islocked,idt');
        $this->db->where('id', $id);
        $query = $this->db->get('tbl_user');
        $result = $query->row_array();
        if (is_array($result)) {
            return $result;
        } else {
            return false;
        }
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tbl_user');
        return $this->db->affected_rows() > 0;
    }


    public function getListData($limit = 10, $offset = 0,  $search = null)
    {
        $this->db->select("id,concat('(',sortname,'),',name) text");
        $this->db->from("tbl_countries a");
        if (!is_null($search)) {
            $this->db->group_start();
            $this->db->like('a.sortname', $search);
            $this->db->or_like('a.name', $search);
            $this->db->group_end();
        }

        $this->db->where('isdeleted',0);

        $this->db->limit(empty($limit) ? 10 : $limit);
        $this->db->offset(empty($offset) ? 0 : $offset);

        $query = $this->db->get();
        return $query->result();
    }


    public function getListDataTotal($search = null)
    {
        $this->db->select("COUNT(a.id) total");
        $this->db->from("tbl_countries a");

        if (!is_null($search)) {
            $this->db->group_start();
            $this->db->like('a.sortname', $search);
            $this->db->or_like('a.name', $search);
            $this->db->group_end();
        }

        $this->db->where('isdeleted',0);

        $query = $this->db->get();
        return $query->row_array()['total'];
    }
}
                        
/* End of file user.php */
