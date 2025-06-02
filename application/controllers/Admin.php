<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect('auth');
        } else {
            if ($this->session->userdata('role_id') != 1) {
                redirect('auth/blocked');
            }
        }
        $this->load->model('Admin_model');
        $this->load->model('Rooms_model');
        $this->load->model('Booking_model');
    }

    public function index()
    {
        $data['judul'] = 'Dashboard';
        $data['rooms'] = $this->Rooms_model->getDisplayRoom();
        $data['user'] = $this->Admin_model->getUserBySessionEmail();
        $data['total_users'] = $this->Admin_model->getCountUsers();
        $data['earnings'] = $this->Admin_model->getEarnings();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidenav_admin');
        $this->load->view('admin/index', $data);
        $this->load->view('templates/js');
    }

    public function customerList()
    {
        $data['judul'] = 'Customer List';
        $data['rooms'] = $this->Rooms_model->getDisplayRoom();
        $data['user'] = $this->Admin_model->getUserBySessionEmail();
        $data['customers'] = $this->Admin_model->getAllCustomer();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidenav_admin');
        $this->load->view('admin/customerlist', $data);
        $this->load->view('templates/js');
    }
    public function add()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('phone', 'Phone', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['judul'] = 'Add Customer';
            $data['rooms'] = $this->Rooms_model->getDisplayRoom();
            $data['user'] = $this->Admin_model->getUserBySessionEmail();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidenav_admin');
        $this->load->view('admin/customer_add');
        $this->load->view('templates/js');
        } else {
            $data = [
                'title' => $this->input->post('title'),
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'image' => 'default.jpg',
                'date_created' => time()
            ];

        // Make sure you insert into the same table used elsewhere: 'user'
        $this->db->insert('user', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Customer added successfully!</div>');
        redirect('admin/customerlist'); // Go back to the list
        }
    }



    public function deleteCustomer()
    {
        $selected_ids = $this->input->post('selected_ids');

        if (!empty($selected_ids)) {
            foreach ($selected_ids as $id) {
                $this->Admin_model->deleteCustomerById($id);
            }
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Selected customer(s) deleted successfully!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">No customer selected for deletion.</div>');
        }

        redirect('admin/customerlist');
    }

    public function editCustomer($id)
    {
        $data['judul'] = 'Edit Customer';
        $data['rooms'] = $this->Rooms_model->getDisplayRoom();
        $data['user'] = $this->Admin_model->getUserBySessionEmail();
        $data['customer'] = $this->Admin_model->getCustomerById($id);

        if (!$data['customer']) {
            show_404();
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidenav_admin');
        $this->load->view('admin/edit', $data);
        $this->load->view('templates/js');
    }

    public function updateCustomer($id)
    {
        $data = [
            'title' => $this->input->post('title', true),
            'name' => $this->input->post('name', true),
            'email' => $this->input->post('email', true),
            'phone' => $this->input->post('phone', true)
        ];

        if (!empty($_FILES['image']['name'])) {
            $config['upload_path'] = './assets/img/profile/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = 2048;
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $uploadedData = $this->upload->data();
                $data['image'] = $uploadedData['file_name'];
            }
        }

        $this->Admin_model->updateCustomerById($id, $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Customer updated successfully!</div>');
        redirect('admin/customerlist');
    }

    public function bookingList()
    {
        $data['judul'] = 'Booking List';
        $data['rooms'] = $this->Rooms_model->getDisplayRoom();
        $data['user'] = $this->Admin_model->getUserBySessionEmail();
        $data['booking'] = $this->Booking_model->getAllUserBookings();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidenav_admin');
        $this->load->view('admin/bookinglist', $data);
        $this->load->view('templates/js');
    }

    public function booking_details($id)
    {
        $data['judul'] = 'Booking Details';
        $data['rooms'] = $this->Rooms_model->getDisplayRoom();
        $data['user'] = $this->Admin_model->getUserBySessionEmail();
        $data['booking'] = $this->Booking_model->getBookingsById($id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidenav_admin');
        $this->load->view('admin/booking_details', $data);
        $this->load->view('templates/js');
    }

    public function testimonialList()
    {
        $data['judul'] = 'Testimonial List';
        $data['rooms'] = $this->Rooms_model->getDisplayRoom();
        $data['user'] = $this->Admin_model->getUserBySessionEmail();
        $data['testimonials'] = $this->Admin_model->getAllTestimonials();
        $data['display_testimonials'] = $this->Admin_model->getAllDisplayTestimonials();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidenav_admin');
        $this->load->view('admin/testimonialList', $data);
        $this->load->view('templates/js');
    }
    

    public function addToDisplayTestimonial()
    {
        $data = [
            'id_testimonial' => $this->input->post('id_testimonial', true)
        ];

        $this->Admin_model->insertDisplayTestimonials($data);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Testimonial has been displayed!</div>');
        redirect('admin/testimoniallist');
    }

    public function deleteDisplayTestimonial()
    {
        $id = $this->input->post('id_display', true);

        $this->Admin_model->deleteDisplayTestimonials($id);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Testimonial display has been deleted!</div>');
        redirect('admin/testimoniallist');
    }
    
    public function roomlist()
    {
        $data['judul'] = 'Room List';
        $data['title'] = 'Room List';
        $this->load->model('Room_model');
        $data['rooms'] = $this->Room_model->getAllRooms();
        $data['user'] = $this->Admin_model->getUserBySessionEmail();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidenav_admin');
        $this->load->view('admin/roomlist', $data);
        $this->load->view('templates/js');
    }

    public function addroom()
    {
        $data['judul'] = 'Add Room';
        $data['title'] = 'Add Room';
        $this->load->model('Room_model');
        $data['user'] = $this->Admin_model->getUserBySessionEmail();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('room_number', 'Room Number', 'required|trim|is_unique[rooms.room_number]');
        $this->form_validation->set_rules('type', 'Room Type', 'required|trim');
        $this->form_validation->set_rules('price', 'Price', 'required|trim|numeric');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidenav_admin');
            $this->load->view('admin/addroom', $data);
            $this->load->view('templates/js');
        } else {
            $roomData = [
                'room_number' => $this->input->post('room_number'),
                'type' => $this->input->post('type'),
                'price' => $this->input->post('price'),
                'status' => 'available'
            ];
            // Handle image upload
            if (!empty($_FILES['image']['name'])) {
                $config['upload_path'] = './assets/img/room/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size'] = 2048;
                $config['file_name'] = uniqid('room_');
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('image')) {
                    $uploadData = $this->upload->data();
                    $roomData['image'] = $uploadData['file_name'];
                }
            }
            $this->Room_model->createRoom($roomData);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New room has been added!</div>');
            redirect('admin/roomlist');
        }
    }

    public function editroom($id)
    {
        $data['judul'] = 'Edit Room';
        $data['title'] = 'Edit Room';
        $this->load->model('Room_model');
        $data['user'] = $this->Admin_model->getUserBySessionEmail();
        $data['room'] = $this->Room_model->getRoomById($id);
        // Debug: Log the room data to ensure type is retrieved
        log_message('debug', 'Room data retrieved: ' . json_encode($data['room']));
        $this->load->library('form_validation');
        $this->form_validation->set_rules('room_number', 'Room Number', 'required|trim');
        $this->form_validation->set_rules('type', 'Room Type', 'required|trim');
        $this->form_validation->set_rules('price', 'Price', 'required|trim|numeric');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidenav_admin');
            $this->load->view('admin/editroom', $data);
            $this->load->view('templates/js');
        } else {
            $roomData = [
                'room_number' => $this->input->post('room_number'),
                'type' => $this->input->post('type'),
                'price' => $this->input->post('price'),
                'status' => $this->input->post('status')
            ];
            // Handle image upload
            if (!empty($_FILES['image']['name'])) {
                $config['upload_path'] = './assets/img/room/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size'] = 2048;
                $config['file_name'] = uniqid('room_');
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('image')) {
                    $uploadData = $this->upload->data();
                    $roomData['image'] = $uploadData['file_name'];
                }
            } else {
                // Preserve old image if no new image is uploaded
                $roomData['image'] = $data['room']['image'];
            }
            $this->Room_model->updateRoom($id, $roomData);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Room has been updated!</div>');
            redirect('admin/roomlist');
        }
    }

    public function deleteroom($id)
    {
        $this->load->model('Room_model');
        $this->Room_model->deleteRoom($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Room has been deleted!</div>');
        redirect('admin/roomlist');
    }
}
