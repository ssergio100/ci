<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Painel extends CI_Controller {
       private $var;

	public function __construct(){
		parent::__construct();
		$this->load->helper('form');
        $this->load->helper('funcoes');
		$this->load->model('Painel_model', 'painel');

          $this->var = teste();

	}
	public function index()
	{
        $this->load->helper('form');
        $this->load->view('home');
	}

    public function table()
    {
        $this->load->view('table');
    }

	public function get()
	{
     $data['produtos'] = $this->painel->getProdutos(1);
     echo json_encode($data, true);

	}

	public function add()
	{
    $data = array('nome'=>'Produto1','descricao'=>'descrção aqui','quantidade'=>3);
    $result = $this->painel->doAdd($data);

     	if ($result){
     		echo 'id '.$result.' inserido';
     	} else {

     			echo "Não deu!";
     	}





	}
	public function valida(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'nome', 'trim|required|min_length[5]|max_length[12]');
		if ($this->form_validation->run() == FALSE) {
			if(validation_errors()){
				echo validation_errors();die;
			}
		} else {
			# code...
		}
		echo "dsds"; die;
	}

    public function dataJson()
    {

$v = $this->uri->segment(3);
        if ( $v == 1) {
            $array[] = array(
            "id"=>1,
            "nome"=>"uuuuuu",
            "idade"=>41,
            "peso"=>50,
            "info"=>"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Qui dicta minus molestiae vel beatae natus eveniet ratione temporibus aperiam harum alias officiis assumenda officia quibusdam deleniti eos cupiditate dolore doloribus!"
            );
        }

        $array[] = array(
            "id"=>1,
            "nome"=>"SsSsergio",
            "idade"=>41,
            "peso"=>50,
            "info"=>"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Qui dicta minus molestiae vel beatae natus eveniet ratione temporibus aperiam harum alias officiis assumenda officia quibusdam deleniti eos cupiditate dolore doloribus!"
            );
        $array[] = array(
            "id"=>2,
            "nome"=>"Ana",
            //PROPOSITAL
            "peso"=>50,
             "info"=>"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Qui dicta minus molestiae vel beatae natus eveniet ratione temporibus aperiam harum alias officiis assumenda officia quibusdam deleniti eos cupiditate dolore doloribus!"
            );
        $array[] = array(
            "id"=>3,
            "nome"=>"Arthur",
            "idade"=>41,
            "peso"=>15,
             "info"=>"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Qui dicta minus molestiae vel beatae natus eveniet ratione temporibus aperiam harum alias officiis assumenda officia quibusdam deleniti eos cupiditate dolore doloribus!"
            );
        $array[] = array(
            "id"=>4,
            "nome"=>"Sergio",
            "idade"=>41,
            "peso"=>50,
             "info"=>"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Qui dicta minus molestiae vel beatae natus eveniet ratione temporibus aperiam harum alias officiis assumenda officia quibusdam deleniti eos cupiditate dolore doloribus!"
            );
        $array[] = array(
            "id"=>5,
            "nome"=>"Ana",
            "idade"=>40,
            "peso"=>50,
             "info"=>"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Qui dicta minus molestiae vel beatae natus eveniet ratione temporibus aperiam harum alias officiis assumenda officia quibusdam deleniti eos cupiditate dolore doloribus!"
            );
        $array[] = array(
            "id"=>6,
            "nome"=>"Arthur",
            "idade"=>41,
            "peso"=>15
            );
        $array[] = array(
            "id"=>7,
            "nome"=>"Sergio",
            "idade"=>41,
            "peso"=>50
            );
        $array[] = array(
            "id"=>8,
            "nome"=>"Ana",
            "idade"=>40,
            "peso"=>50
            );
        $array[] = array(
            "id"=>9,
            "nome"=>"Arthur",
            "idade"=>41,
            "peso"=>15
            );
        $array[] = array(
            "id"=>10,
            "nome"=>"Sergio",
            "idade"=>41,
            "peso"=>50
            );
        $array[] = array(
            "id"=>11,
            "nome"=>"Ana",
            "idade"=>40,
            "peso"=>50
            );
        $array[] = array(
            "id"=>12,
            "nome"=>"Arthur",
            "idade"=>41,
            "peso"=>15
            );
        $arrReturn['data'] =   $array;
        echo json_encode($arrReturn);
    }
}
