<?php

class Hello extends CI_Controller{
    public function index(){
        $this->load->view('header');
        $this->load->view('index');
        $this->load->view('footer');
    }

    public function login(){
        $this->load->view('auth');
    }
    public function register(){
        $this->load->view('register');
    }
    public function form(){
        $this->load->view('header');
        $this->load->view('form');
        $this->load->view('footer');
    }
}
