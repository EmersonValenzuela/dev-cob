<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();
        check_login_user();
    }

    public function index()
    {
        $data['title'] = 'Inicio Administrador COPERE';
        $data['links'] = array();
        $data['scripts'] = array();

        $this->template->load('copere/template', 'copere/dashboard', $data);
    }
}
