<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Room_model extends CI_Model
{
    public function getAllRooms()
    {
        $this->db->select('id, room_number, type, price, status, image');
        return $this->db->get('rooms')->result_array();
    }

    public function getRoomById($id)
    {
        $this->db->select('id, room_number, type, price, status, image');
        return $this->db->get_where('rooms', ['id' => $id])->row_array();
    }

    public function createRoom($data)
    {
        return $this->db->insert('rooms', $data);
    }

    public function updateRoom($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('rooms', $data);
    }

    public function deleteRoom($id)
    {
        return $this->db->delete('rooms', ['id' => $id]);
    }

    public function getRoomCount()
    {
        return $this->db->count_all('rooms');
    }

    public function getAvailableRooms()
    {
        $this->db->where('status', 'available');
        return $this->db->get('rooms')->result_array();
    }

    public function getOccupiedRooms()
    {
        $this->db->where('status', 'occupied');
        return $this->db->get('rooms')->result_array();
    }
}