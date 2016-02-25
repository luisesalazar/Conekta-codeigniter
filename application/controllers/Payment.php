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
        $response= array("status"=>0,"msg"=>"Ocurrio un error");
        if($this->input->is_ajax_request()){
            
            //obtener datos post
            $card= $this->input->post('card');
	   
            try {

               //creamos un cargo
                $charge_new = Conekta_Charge::create(array(
                    'description'=> 'Stogies',
                    'amount'=>20000,
                    'currency'=>'MXN',
                    'card'=> 'tok_test_visa_4242', //prueba, $this->input->post('token_id'),
                    'details'=> array(
                        'buyer'=> $card['name'],
                        'precio'=> 2000,
                        'cantidad'=> 1,
                        'email'=>'logan@x-men.org'
                    )
                ));
               
                if($charge_new->status =='paid'){
                    $response['status']=1;
                    $response['charge_id']= $charge_new->id;
                    $response['msg']="Pago existoso";
                }else{
                     $response['status']=0;
                }
                
            } catch (Conekta_Error $e) {
                $response['status']=0;
                $response['msg']= $e->getMessage();
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
