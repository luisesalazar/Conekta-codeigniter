<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //cargamos la libreria que usará a conekta, esta a su vez
        //carga el archivo config "conekta" que contiene las llaves
        //publica y privada
        $this->load->library("conekta/conekta_main");
    }

    public function index() {
        $this->load->view("payment_new");
    }

    public function create() {
        $response= array();
        if(!$this->input->is_ajax_request()){
	    show_404();
        }else{
            print_r_pre_d($this->input->post());

            try {
               //creamos un cargo
                $charge = Conekta_Charge::create(array(
                            'description' => 'Stogies',
                            'reference_id' => '9839-wolf_pack',
                            'amount' => 20000,
                            'currency' => 'MXN',
                            'card' => "tok_test_visa_4242",
                            "details" => array(
                                "email" => "logan@x-men.org"
                            )
                ));

                $response['charge']= $charge;
            } catch (Conekta_Error $e) {
                echo $e->getMessage();
            }
        }

        //Regresamos la info ...Cocinado!!
        $json = json_encode($response);
        echo isset($_GET['callback']) ? "{$_GET['callback']}($json)" : $json;
    }

    public function find($id) {

        //para buscar un cargo existente
        try {
             print_r_pre(Conekta_Charge::find($id));
        } catch (Conekta_Error $e) {
            echo $e->getMessage();
        }
    }

}
