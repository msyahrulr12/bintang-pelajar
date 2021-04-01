<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeController extends CI_Controller {

	public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('level') == null) {
            $this->session->set_flashdata('message', 'Anda Harus Login!');
            redirect('AuthController/loginAdmin');
        } else {
            // check level
            if ($this->session->userdata('level') == 'siswa') {
                $this->session->set_flashdata('message', 'Anda Harus Login!');
                redirect('AuthController/loginSiswa');
            }
        }
    }

    public function index()
    {
        // if level kepala cabang, get data students where cabang_id same as his own
        if ($this->session->userdata('level') == 'kepala_cabang') {
            $jumlah_siswa = $this->db->query('SELECT COUNT(id) as count FROM siswa WHERE cabang_id = '.$this->session->userdata('cabang_id'))->result_array()[0]['count'] ?? 0;
        } else {
            $jumlah_siswa = $this->db->count_all('siswa');
        }

        $this->load->view('admin/layouts/header');
        $this->load->view('admin/index', compact('jumlah_siswa'));
        $this->load->view('admin/layouts/footer');
    }
}
