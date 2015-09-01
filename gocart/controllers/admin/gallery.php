<?php
class Gallery extends Admin_Controller
{
	
	function __construct()
	{
		parent::__construct();

		$this->auth->check_access('Admin', true);
		$this->load->model('gallery_model');
		$this->lang->load('gallery');
	}
		
	function index()
	{
		$data['gallery_title']	= lang('gallery');
		$data['gallerys']		= $this->gallery_model->get_list();
		
		$this->view($this->config->item('admin_folder').'/gallery', $data);
	}
	
	/********************************************************************
	edit gallery
	********************************************************************/
	function form($id = false)
	{
		$this->load->helper('url');
		$this->load->helper('form');
						
		$config['upload_path']		= 'uploads/gallery/full';
		$config['allowed_types']	= 'gif|jpg|png';
		$config['max_size']			= $this->config->item('size_limit');
		$config['encrypt_name']		= true;
		$this->load->library('upload', $config);
		$this->load->library('form_validation');
		//set the default values
		$data['id']			= '';
		$data['title']		= '';
		$data['caption']	= '';
		$data['content']	= '';
		$data['sequence']	= 0;
		$data['seo_title']	= '';
		$data['meta']		= '';		
		$data['enable_date']		= '';
		$data['disable_date']		= '';
		$data['image']		= '';
		$data['status']		= '';
		
		$data['gallery_title']	= lang('gallery_form');
		$data['gallery']		= $this->gallery_model->get_list();
		
		if($id)
		{
			
			$gallery			= $this->gallery_model->get_gallery($id);
			
			if(!$gallery)
			{
				//gallery does not exist
				$this->session->set_flashdata('error', lang('error_page_not_found'));
				redirect($this->config->item('admin_folder').'/gallery');
			}
						
			//set values to db values
			$data['id']				= $gallery['id'];			
			$data['title']			= $gallery['title'];
			$data['caption']		= $gallery['caption'];
			$data['content']		= $gallery['content'];
			$data['sequence']		= $gallery['sequence'];
			$data['seo_title']		= $gallery['seo_title'];
			$data['meta']			= $gallery['meta'];
			$data['enable_date']	= $gallery['enable_date'];
			$data['disable_date']	= $gallery['disable_date'];
			$data['image']			= $gallery['image'];
			$data['status']			= $gallery['status'];
		}
		
		$this->form_validation->set_rules('title', 'lang:title', 'trim|required');
		$this->form_validation->set_rules('caption', 'lang:caption', 'trim');
		$this->form_validation->set_rules('content', 'lang:content', 'trim');
		$this->form_validation->set_rules('enable_date', 'lang:enable_date', 'trim');
		$this->form_validation->set_rules('disable_date', 'lang:disable_date', 'trim');
		$this->form_validation->set_rules('image', 'lang:image', 'trim');
		$this->form_validation->set_rules('seo_title', 'lang:seo_title', 'trim');
		$this->form_validation->set_rules('meta', 'lang:meta', 'trim');
		$this->form_validation->set_rules('sequence', 'lang:sequence', 'trim|integer');
		$this->form_validation->set_rules('status', 'lang:status', 'trim');
		
		// Validate the form
		if($this->form_validation->run() == false)
		{
			$this->view($this->config->item('admin_folder').'/gallery_form', $data);
		}
		else
		{
			$this->load->helper('text');
			
			$uploaded	= $this->upload->do_upload('image');
			
			$save = array();
			
			$save['title']		= $this->input->post('title');
			$save['sequence']	= $this->input->post('sequence');
			$save['content']	= $this->input->post('content');						
			
			$save['seo_title']	= $this->input->post('seo_title');
			$save['meta']		= $this->input->post('meta');
			$save['status']		= $this->input->post('status');
				
								
			if ($id)
			{
				$save['id']			= $id;
			
				//delete the original file if another is uploaded
				if($uploaded)
				{
					if($data['image'] != '')
					{
						$file = 'uploads/gallery/full/'.$data['image'];
			
						//delete the existing file if needed
						if(file_exists($file))
						{
							unlink($file);
						}
					}
				}
			
			}
			else
			{
				if(!$uploaded)
				{
					$data['error']	= $this->upload->display_errors();
					$this->view(config_item('admin_folder').'/gallery_form', $data);
					return; //end script here if there is an error
				}
			}
				
			if($uploaded)
			{
				$image			= $this->upload->data();
				$save['image']	= $image['file_name'];
			}
			
			
			
			//save the gallery
			$gallery_id	= $this->gallery_model->save_gallery($save);
									
			$this->session->set_flashdata('message', lang('message_saved_gallery'));
			
			//go back to the gallery list
			redirect($this->config->item('admin_folder').'/gallery');
		}
	}
	
	
	/********************************************************************
	delete gallery
	********************************************************************/
	function delete($id)
	{
		
		$gallery	= $this->gallery_model->get_gallery($id);
		
		if($gallery)
		{
			$this->gallery_model->delete_gallery($id);
			$this->session->set_flashdata('message', lang('message_deleted_gallery'));
		}
		else
		{
			$this->session->set_flashdata('error', lang('error_page_not_found'));
		}
		
		redirect($this->config->item('admin_folder').'/gallery');
	}
}	