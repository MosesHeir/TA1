<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Room extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Room_model');
        $this->load->model('Admin_model');
        // Check if user is logged in
        if (!$this->session->userdata('email')) {
            redirect('auth');
        }
    }

    public function index()
    {
        $data['title'] = 'Room Management';
        $data['judul'] = 'Room List'; // For sidebar active state
        $data['user'] = $this->Admin_model->getUserBySessionEmail();
        $data['rooms'] = $this->Room_model->getAllRooms();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/roomlist', $data); // Use admin/roomlist as the default view
        $this->load->view('templates/footer');
    }

    public function add()
    {
        $data['title'] = 'Add New Room';
        $data['user'] = $this->Admin_model->getUserBySessionEmail();

        $this->form_validation->set_rules('room_number', 'Room Number', 'required|trim|is_unique[rooms.room_number]');
        $this->form_validation->set_rules('type', 'Room Type', 'required|trim');
        $this->form_validation->set_rules('price', 'Price', 'required|trim|numeric');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('room/add', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'room_number' => $this->input->post('room_number'),
                'type' => $this->input->post('type'),
                'price' => $this->input->post('price'),
                'status' => 'available'
            ];

            $this->Room_model->createRoom($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New room has been added!</div>');
            redirect('room');
        }
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Room';
        $data['user'] = $this->Admin_model->getUserBySessionEmail();
        $data['room'] = $this->Room_model->getRoomById($id);

        $this->form_validation->set_rules('room_number', 'Room Number', 'required|trim');
        $this->form_validation->set_rules('type', 'Room Type', 'required|trim');
        $this->form_validation->set_rules('price', 'Price', 'required|trim|numeric');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('room/editroom', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'room_number' => $this->input->post('room_number'),
                'type' => $this->input->post('type'),
                'price' => $this->input->post('price'),
                'status' => $this->input->post('status')
            ];

            $this->Room_model->updateRoom($id, $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Room has been updated!</div>');
            redirect('room');
        }
    }

    public function delete($id)
    {
        $this->Room_model->deleteRoom($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Room has been deleted!</div>');
        redirect('room');
    }
} 