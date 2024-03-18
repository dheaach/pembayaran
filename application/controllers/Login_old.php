<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property  Users_model $user
 */
class Login extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Users_model', 'user');
    }

	public function index() {
        $this->load->view('login');
    }

    public function filter($data) {
        $hasil = preg_replace('/[^a-zA-Z0-9@.]/', '', $data);
        return $hasil;
    }

    public function cek_login() {

        $return = array('success' => false);
        $username = $this->filter($this->input->post('username'));
        $password = $this->filter($this->input->post('password'));

        //if( $_SERVER["HTTP_HOST"] != "supplier.suksesjayamlg.com" ) {
            $login = $this->user->validate();
            if (!empty($login) && count($login) > 0) {
                if ($login['is_Super'] == 1) {
                    $session = array(
                        "id_user" => $login['User_id'],
                        "gudang_no" => $login['gud_no'],
                        "is_super" => $login['is_Super'],
                        "username" => $login['user_name'],
                        "cat_gudang_no" => empty($login['cat_gud_no']) ? "all" : $login['cat_gud_no'],
                        "is_logged_in" => 1,
                        "login_role" => ""
                    );

                    $this->session->set_userdata($session);
                    $return['success'] = true;
                    $return['redirecturl'] = "dashboard";
                } else {
                    $return['text'] = "Anda Tidak Punya Akses ke Aplikasi ini";
                }
            } else {
                $return['text'] = "Username atau Password Anda Kurang Tepat";
            }
        //}
        /*else {

            $this->db->where('user_name', $this->input->post('username'));
            $this->db->where('user_pass', $this->input->post('password'));
            $this->db->where('is_delete', 0);

            $query = $this->db->get('tusers_supplier', 1);
            if( $query->num_rows() ) {
                $row = $query->row();
                $session = array(
                    "id_user" => $row->id,
                    "gudang_no" => $row->cat_gud_no,
                    "username" => $row->user_name,
                    "person_no" => $row->person_no,
                    "is_logged_in" => 1,
                    "login_role" => "supplier"
                );

                $this->session->set_userdata($session);
                $return['success'] = true;
                $return['redirecturl'] = "dashboard";
            }
            else {
                $return['text'] = "Username atau Password Anda Kurang Tepat";
            }
        }*/
        
        header('Content-Type: application/json');
        echo json_encode($return);

    }

    public function out(){
        $this->session->sess_destroy();
        redirect( site_url() );
    }
}
