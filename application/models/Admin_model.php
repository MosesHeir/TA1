<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    public function getCustomerById($id)
    {
        return $this->db->get_where('user', ['id' => $id])->row_array();
    }
    public function deleteCustomerById($id)
    {
        $this->db->delete('user', ['id' => $id]); // change 'user' if your table name is different
    }
    public function updateCustomerById($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('user', $data); // Replace 'user' with your actual table name if different
    }
    public function insertCustomer($data)
    {
        return $this->db->insert('customer', $data);
    }
    public function getUserBySessionEmail()
    {
        return $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    }

    public function getAllCustomer()
    {
        return $this->db->get('user')->result_array();
    }

    public function getCountUsers()
    {
        return $this->db->count_all('user');
    }

    public function getEarnings()
    {
        $this->db->select_sum('total_harga');
        return $this->db->get('t_booking')->row_array();
    }

    public function getAllTestimonials()
    {   
        $this->db->select('user.name, user.email, t_testimonial.*');
        $this->db->join('user', 'user.id = t_testimonial.id_customer');
        return $this->db->get('t_testimonial')->result_array();
    }

    public function getAllDisplayTestimonials()
    {   
        $this->db->select('user.name, user.email, t_display_testimonial.*, t_testimonial.*');
        $this->db->join('t_testimonial', 't_testimonial.id_testimonial = t_display_testimonial.id_testimonial');
        $this->db->join('user', 'user.id = t_testimonial.id_customer');
        return $this->db->get('t_display_testimonial')->result_array();
    }

    public function insertDisplayTestimonials($data)
    {
        $this->db->insert('t_display_testimonial', $data);
    }

    public function deleteDisplayTestimonials($id)
    {
        $this->db->delete('t_display_testimonial', ['id_display' => $id]);
    }





}