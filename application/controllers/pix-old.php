<?php


class Pix extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));

		$this->load->database();
		$this->load->library('image_CRUD');

		$this->data['aquarium_id'] = $this->session->userdata('aquarium_id');
	}

	function _example_output($output = null)
	{
		$this->load->view('example.php',$output);	
	}

	function index()
	{
		$aquarium_id = $this->data['aquarium_id'];

		// $this->load->model('User_model');

		// $photos['aquarium_pix'] =[];

		// $query_aquarium_photos = $this->User_model->get_photos($aquarium_id);
		
		// foreach ($query_aquarium_photos->result_array() as $row) {
		// 	array_push($photos['aquarium_pix'], $row);
		// }

		// $this->load->view('upload_form', array('error' => ' ' ));
		// $this->load->view('aquarium_photos', $photos);
		$this->_example_output((object)array('output' => '' , 'js_files' => array() , 'css_files' => array()));
	}

		function example4()
    {
        $image_crud = new image_CRUD();
 
        $image_crud->set_table('example_2');
 
        $image_crud->set_primary_key_field('image_id');
        $image_crud->set_url_field('url');
        $image_crud->set_title_field('title');
        $image_crud->set_ordering_field('priority')
        ->set_image_path('assets/uploads');
 
        $output = $image_crud->render();
 
        $this->_example_output($output);
    }

	}

	function do_upload()
	{
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		// $config['max_size']	= '100';
		$config['max_width']  = '2000';
		$config['max_height']  = '1400';
		$config['encrypt_name'] = TRUE;

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());

			$this->load->view('upload_form', $error);
		}
		else
		{	
			//creats data about uploaded image
			$data = array('upload_data' => $this->upload->data());

			//If image is larger than we need but was small enough to pass upload rules resize here.
			// if ($data['upload_data']['image_width'] > 1200 || $data['upload_data']['image_height'] >  900){
			// $config['image_library'] = 'gd2';
			// $config['source_image']	= './uploads/'. $data["upload_data"]["file_name"] . '';
			// $config['create_thumb'] = FALSE;
			// $config['maintain_ratio'] = TRUE;
			// $config['width']	 = 1200;
			// // $config['height']	= 50;

			// $this->load->library('image_lib', $config); 

			// $this->image_lib->resize();

			// }

			
			//config for image library, then create thumbnail of uploaded image.
			$config['image_library'] = 'gd2';
			$config['source_image']	= './uploads/'. $data["upload_data"]["file_name"] . '';
			$config['create_thumb'] = TRUE;
			$config['maintain_ratio'] = TRUE;
			$config['width']	 = 75;
			$config['height']	= 50;

			$this->load->library('image_lib', $config); 

			$this->image_lib->resize();

			if ( ! $this->image_lib->resize())
			{
			    echo $this->image_lib->display_errors();
			}
		
			//upload image to db

			$photo_data = array(
					'location' => '/uploads/'. $data["upload_data"]["file_name"] . '',
					'aquarium_id' => $this->data['aquarium_id']
					);


			$this->load->model('User_model');

			$this->User_model->add_photo($photo_data);


			$this->load->view('upload_success', $data);
		}
	}

	// function delete_photo($photo_id){

	// 	$this->load->model('User_model');
	// 	$deleted_photo = $this->User_model->delete_photo($photo_id);

	// 	if ($deleted_photo->num_rows() > 0)
	// 	{
	// 	   $row = $deleted_photo->row(); 
	// 	   $deleted_photo_location = $row->location;
	// 	}
	// 	$deleted_photo_thumb_location = $deleted_photo_location ."_thumb"

	// 	//this function still needs to delete photo from directory

	// 	// $this->load->helper('file');

	// 	// delete_files('./uploads/directory/');

	// 	$this->index();


	// }
// }
?>