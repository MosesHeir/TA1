<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rooms_model extends CI_Model
{
    public function getRoomById($id)
    {
        return $this->db->get_where('rooms', ['id' => $id])->row_array();
    }

    public function getDisplayRoom()
    {
        // Fetch all rooms from the 'rooms' table
        return $this->db->get('rooms')->result_array();
    }

    public function allRoomCount()
    {
        $this->db->select('jenis_kamar');
        $this->db->select('COUNT(*) as row_count');
        $this->db->from('t_kamar');
        $this->db->group_by('jenis_kamar');
        return $this->db->get()->result_array();
    }
}
