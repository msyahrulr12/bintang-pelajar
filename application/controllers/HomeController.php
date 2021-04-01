<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeController extends CI_Controller {

	public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('level') != 'siswa') {
            $this->session->set_flashdata('message', 'Anda Harus Login!');
            redirect('AuthController/loginAdmin');

        }
        // if (!isset($this->session->userdata('level')) {
        // }


        $this->load->model('Model');
    }

    public function index()
    {
        
        $this->db->select('siswa.*, cabang.nama_cabang');
        $this->db->from('siswa');
        $this->db->join('cabang', 'siswa.cabang_id = cabang.id');
        $this->db->where(['siswa.id' => $this->session->userdata('id')]);
        $siswa = $this->db->get()->result_array()[0];

        $this->load->view('siswa/layouts/header');
        $this->load->view('siswa/index', compact('siswa'));
        $this->load->view('siswa/layouts/footer');
    }
}
