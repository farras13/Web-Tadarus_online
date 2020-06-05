<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    //*public function __construct()
    //*{
    //* parent::__construct();
    //*is_logged_in();
    //*}

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('Menu_model', 'm');

        $a = $this->session->userdata('role_id');
        if ($a == null) {
            redirect('Auth', 'refresh');
        } else if ($a != 2) {
            redirect('Auth', 'refresh');
        }
    }

    public function index()
    {
        $data['title'] = 'My Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }

    public function darus()
    {
        $data['title'] = 'Validasi Darus';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $wher = array('jadwal.id_user'=>$this->session->userdata('id'));
        $data['subMenu'] = $this->m->getJoinW('jadwal', 'user', 'user.id = jadwal.id_user', $wher)->result_array();
        $data['menu'] = $this->db->get('user')->result_array();
        $data['darus'] = $this->db->get('darus')->result_array();
        

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/validasi', $data);
        $this->load->view('templates/footer');
    }

    public function valid()
    {
        $s = $this->uri->segment(3);
        $w = array('id_jadwal' => $s,);

        $a = $this->m->getW('jadwal', $w)->row();
        $wa = array('id_user' => $a->id_user);
        $b = $this->m->getWO('darus', $wa, 'id_darus')->row();
        $arrayName = array(
            'id_user' => $a->id_user,
            'juz' => $a->juz,
            'status' => 1,
        );
        if ($a->juz != $b->juz) {
            $this->db->insert('darus', $arrayName);
        }
        redirect('user/darus', 'refresh');
    }
}
