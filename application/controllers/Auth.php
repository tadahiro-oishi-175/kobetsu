<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Auth
 *
 * @author Oishi-Tadahiro
 */
class Auth extends MY_Controller {
    private $user_table_name = 'user';
    
    public function __construct() {
        parent::__construct();
    }

    public function login($cont = '', $method = '', $attr = '') {        
        $next_uri = $this->input->post('nextUri') != NULL ? $this->input->post('nextUri') : "$cont/$method/$attr";

        // after login
        if ($this->session->userdata('is_login') == TRUE) {
            redirect($next_uri);
        }

        // before login
        $userName = $this->input->post('userName');
        $passWord = $this->input->post('passWord');
        $message = '';

        if ($this->db_check($userName, $passWord)) {
            $this->session->sess_destroy();
            $this->session->sess_create();
            $this->session->set_userdata(array('is_login' => TRUE));
            $this->session->set_userdata(array('userName' => $userName));
            redirect($next_uri);
        } else {
            $message = '正しいユーザ名/パスワードを指定してください';
        }

        $data['userName'] = $userName;
        $data['passWord'] = $passWord;
        $data['message'] = $message;
        $data['next'] = $next_uri;
        $this->load->view('login_form', $data);
    }

    public function logout() {
        $this->session->sess_destroy();
        $this->load->view('logout');
    }

    private function db_check($userName, $passWord) {
        $this->db->where('userName', $userName);
        $query = $this->db->get($this->user_table_name);
        if($query->num_rows() > 0){
            if($query->row()->passWord == $passWord){
                return TRUE;
            }
        }
        return FALSE;
    }
}
