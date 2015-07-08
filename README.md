# Conekta-codeigniter
Implementación de conekta en CodeIgniter

# Requisitos
<ul>
<li>Implementado en CodeIgniter 3.0.0</li>
<li>Tener cuenta en http://www.conekta.io</li>
</ul>

# Instalación
<ul>
<li>Descargar esta implementación</li>
<li>Abrir el archivo ./application/config/conekta.php</li>
<li>
  Modificar las llaves pública y privada por defecto por las que te asignó conekta
  <pre>
    $config['conekta_api_key_private'] = 'key_private';
    $config['conekta_api_key_public'] = 'key_public';
  </pre>

</li>
<li>Al abrir el navegador y teclear la dirección de tu proyecto http://dominio/conekta_codeigniter/ deberá imprimir los cargos generados en conekta.
<pre>
public function index(){
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

  //para buscar un cargo existente
  print_r(Conekta_Charge::find($charge->id));

  //cachando errores para crear o buscar cargos
  try{
		print_r(Conekta_Charge::find($charge->id));
  }catch (Conekta_Error $e){
		echo $e->getMessage();
  }
}
</pre>
</li>
</ul>


