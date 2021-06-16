<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_User extends CI_Model
{
    private $table = "tb_user";
    private $primary = "id_user";
    var $column_order = array(null, 'fullname', 'username', 'section', 'user_status', null); //set column field database for datatable orderable
    var $column_search = array('fullname', 'username', 'section'); //set column field database for datatable searchable 
    var $order = array('id_user' => 'ASC'); // default order 

    private function _get_datatables_query()
    {

        $this->db->select('*')->from($this->table . " as u");
        $i = 0;
        foreach ($this->column_search as $item) // loop column 
        {
            if ($_POST['search']['value']) // if datatable send POST for search
            {
                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
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
        $this->db->select('*');
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function getList()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $data = $this->db->get()->result();
        return $data;
    }
    public function create($data)
    {
        $this->db->insert($this->table, $data);
    }
    public function update($id, $data)
    {
        $this->db->where($this->primary, $id);
        $res = $this->db->update($this->table, $data);
        return $res;
    }
    public function delete($id)
    {
        $this->db->where($this->primary, $id);
        $res = $this->db->delete($this->table);
        return $res;
    }
    // public function get($id)
    // {
    //     $this->db->select('u.*,s.id_section,section_name,d.id_departement,departement_name,div.id_division,division_name,position_name')
    //         ->from($this->table . " as u")
    //         ->join('tb_section s', 'u.id_section=s.id_section', 'LEFT')
    //         ->join('tb_position p', 'u.id_position=p.id_position', 'LEFT')
    //         ->join('tb_departement d', 'd.id_departement=s.id_departement', 'LEFT')
    //         ->join('tb_division div', 'd.id_division=div.id_division', 'LEFT')
    //         ->where("u." . $this->primary, $id);
    //     $data = $this->db->get($this->table)->row_array();
    //     return $data;
    // }
    //modified
    public function get($id)
    {
        $this->db->select('*')
            ->from($this->table . " as u")
            ->where("u." . $this->primary, $id);
        $data = $this->db->get()->row_array();
        return $data;
    }
    public function getByName($name)
    {
        $this->db->select('*');
        $this->db->where('fullname', $name);
        $data = $this->db->get($this->table)->row_array();
        return $data;
    }

    public function exist($data)
    {
        $condition = ['username' => $data['username']];
        $res = $this->db->get_where($this->table, $condition)->row();
        if ($res) {
            return false;
        } else {
            return true;
        }
    }
    public function account($username, $password)
    {
        $this->db->select('*')
            ->from($this->table . " as u")
            ->where(['u.username' => $username, 'u.password' => $password]);
        $data = $this->db->get()->row_array();
        return $data;
    }
}
