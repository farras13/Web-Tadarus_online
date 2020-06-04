<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('Menu_model', 'm');
        $a = $this->session->userdata('role_id');
        if ($a == null) {
            redirect('Auth', 'refresh');
        } else if ($a != 3) {
            redirect('Auth', 'refresh');
        }
    }
    
    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

    public function jadwal()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Menu_model', 'menu');

        $data['subMenu'] = $this->m->getJoin('jadwal', 'user', 'user.id = jadwal.id_user')->result_array();
        $data['menu'] = $this->db->get('user')->result_array();
        $data['darus'] = $this->db->get('darus')->result_array();

        $this->form_validation->set_rules('user', 'User', 'trim|required');
        $this->form_validation->set_rules('url', 'Url', 'trim|required');
        
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/jadwal', $data);
            $this->load->view('templates/footer');
        } else {
            $obj = array(
                'id_user' => $this->input->post('user'),
                'url' => $this->input->post('url')
            );
            $this->db->insert('jadwal', $obj);
            redirect('admin/jadwal','refresh');
            
        }
    }

    public function setJadwal()
    {
        $d = $this->m->getJoin('jadwal', 'user', 'user.id = jadwal.id_user')->result_array();
        $i = count($d);

        for ($t = 0; $t < $i; $t++) {
            $a = rand(1, 30);
            if ($d[$t]['juz'] != $a) {

                $arrayName = array('juz' => $a,);
                $w = array('id_jadwal' => $t + 1,);
                $this->db->update('jadwal', $arrayName, $w);
            }
        }
        redirect('admin/jadwal', 'refresh');
    }

    public function acak()
    {
        $d = $this->m->getJoin('jadwal', 'user', 'user.id = jadwal.id_user')->result_array();
        $i = count($d);
        $s = $this->uri->segment(3);        
        for ($t = 0; $t < $i; $t++) {
            $a = rand(1, 30);
            if ($d[$t]['juz'] != $a) {
                $arrayName = array('juz' => $a,);
                $w = array('id_user' => $s,);
                $this->db->update('jadwal', $arrayName, $w);
            }
        }
        redirect('admin/jadwal', 'refresh');
    }
}
