<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SiswaController extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Model');

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
        $this->db->select('siswa.*, cabang.nama_cabang');
        $this->db->from('siswa');
        $this->db->join('cabang', 'siswa.cabang_id = cabang.id');
        // if level kepala cabang, get data students where cabang_id same as his own
        if ($this->session->userdata('level') == 'kepala_cabang') {
            $this->db->where(['cabang_id' => $this->session->userdata('cabang_id')]);
        }
        $siswa = $this->db->get()->result_array();

        $this->load->view('admin/layouts/header');
        $this->load->view('admin/siswa/index', compact('siswa'));
        $this->load->view('admin/layouts/footer');
    }

    public function create()
    {
        $cabang = $this->Model->get('cabang');

        $this->load->view('admin/layouts/header');
        $this->load->view('admin/siswa/create', compact('cabang'));
        $this->load->view('admin/layouts/footer');
    }

    public function store()
    {
        // validation
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('cabang_id', 'Cabang', 'required');
        
        // if false
        if ($this->form_validation->run() == false) {
            redirect('admin/SiswaController/index');
        }

        // hash password
        $_POST['password'] = password_hash($_POST['password'], PASSWORD_BCRYPT); // use bcrypt

        $result = $this->Model->insert('siswa', $_POST);

        if ($result) {
            $this->session->set_flashdata('message', 'Data berhasil diinput');
            redirect('admin/HomeController');
        } else {
            $this->session->set_flashdata('message', 'Data gagal diinput');
            redirect('admin/HomeController');
        }
    }

    public function edit($id)
    {
        $cabang = $this->Model->get('cabang');
        $siswa = $this->Model->get_where('siswa', ['id' => $id])[0];

        $this->load->view('admin/layouts/header');
        $this->load->view('admin/siswa/edit', compact('cabang', 'siswa'));
        $this->load->view('admin/layouts/footer');
    }

    public function update()
    {
        // validation
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('cabang_id', 'Cabang', 'required');
        
        // if false
        if ($this->form_validation->run() == false) {
            redirect('admin/SiswaController/edit/'.$_POST['id']);
        }

        $result = $this->Model->update('siswa', $_POST, ['id' => $_POST['id']]);

        if ($result) {
            $this->session->set_flashdata('message', 'Data berhasil diedit');
            redirect('admin/SiswaController');
        } else {
            $this->session->set_flashdata('message', 'Data gagal diedit');
            redirect('admin/SiswaController');
        }
    }

    public function destroy($id)
    {
        $result = $this->Model->delete('siswa', $id);

        if ($result) {
            $this->session->set_flashdata('message', 'Data berhasil dihapus');
            redirect('admin/SiswaController');
        } else {
            $this->session->set_flashdata('message', 'Data gagal dihapus');
            redirect('admin/SiswaController');
        }
    }
}
