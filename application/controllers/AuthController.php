<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Model');
    }
    
	public function loginAdmin()
	{
		$this->load->view('admin/auth/login');
	}

    public function registerAdmin()
	{
        $cabang = $this->Model->get('cabang');
		$this->load->view('admin/auth/register', compact('cabang'));
	}

    public function doLoginAdmin()
    {
        // validation
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        // if false
        if ($this->form_validation->run() == false) {
            redirect('AuthController/loginAdmin');
        }

        // check email in database table admin
        $checkAuth = $this->Model->get_where('admin', [
            'email' => $_POST['email'],
        ]);

        // if email is exists
        if(sizeof($checkAuth) > 0 ) {
            $checkAuth = $checkAuth[0];
            $checkPassword = password_verify($_POST['password'], $checkAuth['password']);

            if ($checkPassword) {
                // create session
                $this->session->set_userdata($checkAuth);
                // go to HomeController Admin
                redirect('admin/HomeController');
            } else {
                $this->session->set_flashdata('message', 'Password salah!');
                redirect('AuthController/loginAdmin');
            }
        } else {
            $this->session->set_flashdata('message', 'Email tidak ditemukan!');
            redirect('AuthController/loginAdmin');
        }
    }

    public function doRegisterAdmin()
    {
        // validation
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('retype_password', 'Retype password', 'required');
        $this->form_validation->set_rules('level', 'Level', 'required');
        // $this->form_validation->set_rules('cabang_id', 'Cabang', 'required');
        $this->form_validation->set_rules('terms', 'Terms', 'required');
        // unset terms
        unset($_POST['terms']);

        // check password with retype password
        if ($_POST['password'] !== $_POST['retype_password']) {
            redirect('AuthController/loginAdmin');
        }

        // unset retype_password
        unset($_POST['retype_password']);

        // hash password
        $_POST['password'] = password_hash($_POST['password'], PASSWORD_BCRYPT); // use bcrypt
        $result = $this->Model->insert('admin', $_POST);
        
        if ($result) {
            $this->session->set_flashdata('message', 'Data berhasil diinput');
            redirect('AuthController/loginAdmin');
        } else {
            $this->session->set_flashdata('message', 'Data gagal diinput');
            redirect('AuthController/loginAdmin');
        }
    }

    public function loginSiswa()
	{
		$this->load->view('siswa/auth/login');
	}

    public function registerSiswa()
	{
        $cabang = $this->Model->get('cabang');
		$this->load->view('siswa/auth/register', compact('cabang'));
	}

    public function doLoginSiswa()
    {
        // validation
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        // if false
        if ($this->form_validation->run() == false) {
            redirect('AuthController/loginSiswa');
        }
        
        // check email in database table admin
        $checkAuth = $this->Model->get_where('siswa', [
            'email' => $_POST['email'],
        ]);
        // if email is exists
        if(sizeof($checkAuth) > 0 ) {
            $checkAuth = $checkAuth[0];
            $checkPassword = password_verify($_POST['password'], $checkAuth['password']);

            if ($checkPassword) {
                // add array level to checkAuth
                $checkAuth['level'] = 'siswa';
                // create session
                $this->session->set_userdata($checkAuth);
                // go to HomeController siswa
                redirect('HomeController');
            } else {
                $this->session->set_flashdata('message', 'Password salah!');
                redirect('AuthController/loginSiswa');
            }
        } else {
            $this->session->set_flashdata('message', 'Email tidak ditemukan!');
            redirect('AuthController/loginSiswa');
        }
    }

    public function doRegisterSiswa()
    {
        // validation
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('retype_password', 'Retype password', 'required');
        $this->form_validation->set_rules('level', 'Level', 'required');
        // $this->form_validation->set_rules('cabang_id', 'Cabang', 'required');
        $this->form_validation->set_rules('terms', 'Terms', 'required');
        // unset terms
        unset($_POST['terms']);

        // check password with retype password
        if ($_POST['password'] !== $_POST['retype_password']) {
            redirect('AuthController/loginSiswa');
        }

        // unset retype_password
        unset($_POST['retype_password']);

        // hash password
        $_POST['password'] = password_hash($_POST['password'], PASSWORD_BCRYPT); // use bcrypt
        $result = $this->Model->insert('admin', $_POST);
        
        if ($result) {
            $this->session->set_flashdata('message', 'Data berhasil diinput');
            redirect('AuthController/loginSiswa');
        } else {
            $this->session->set_flashdata('message', 'Data gagal diinput');
            redirect('AuthController/loginSiswa');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('AuthController/loginAdmin');
    }
}
