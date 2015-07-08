<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
            //cargamos la libreria que usará a conekta, esta a su vez
            //carga el archivo config "conekta" que contiene las llaves
            //publica y privada
            $this->load->library("conekta/conekta_main");

            //creamos un cargo
            $charge = Conekta_Charge::create(array(
		    'description'=>'Stogies',
		    'reference_id'=>'9839-wolf_pack',
		    'amount'=>20000,
		    'currency'=>'MXN',
		    'card'=>"tok_test_visa_4242",
		    "details"=> array(
		      "email"=>"logan@x-men.org"
		    )
	     ));

            //imprimimos el objeto charge que devuelve conekta
	    print_r($charge);
            echo '<br/>';
            echo '<br/>';

            //para buscar un cargo existente
	    print_r(Conekta_Charge::find($charge->id));
            echo '<br/>';
            echo '<br/>';

            //cachando errores para crear o buscar cargos
            try{
		print_r(Conekta_Charge::find($charge->id));
	    }catch (Conekta_Error $e){
		echo $e->getMessage();
	    }
	}
}
