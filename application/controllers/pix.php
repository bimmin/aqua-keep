<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pix extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		/* Standard Libraries */
		$this->load->database();
		/* ------------------ */
		
		$this->load->helper('url'); //Just for the examples, this is not required thought for the library
		
		$this->load->library('image_CRUD');

		$this->data['aquarium_id'] = $this->session->userdata('aquarium_id');
	}
	
	function _index($output = null)
	{
		$this->load->view('example.php', $output);	
	}
	
	function index()
	{
		 $this->_index((object)array('output' => '' , 'js_files' => array() , 'css_files' => array()));
	}	

	function edit_pix()
	{
		$image_crud = new image_CRUD();
	
		$image_crud->set_primary_key_field('id');
		$image_crud->set_url_field('url');
		$image_crud->set_title_field('title');
		$image_crud->set_table('photos')
		->set_relation_field('aquarium_id')
		->set_ordering_field('priority')
		->set_image_path('assets/uploads');
			
		$output = $image_crud->render();
	
		// $this->_index($output);

		$this->_index($output,(object)array('output' => '' , 'js_files' => array() , 'css_files' => array()));
	}
	
	function simple_photo_gallery()
	{
		$image_crud = new image_CRUD();
		
		$image_crud->unset_upload();
		$image_crud->unset_delete();
		
		$image_crud->set_primary_key_field('id');
		$image_crud->set_url_field('url');
		$image_crud->set_table('photos')
		->set_relation_field('aquarium_id')
		->set_image_path('assets/uploads');
		
		$output = $image_crud->render();
		
		$this->_index($output);		
	}
}