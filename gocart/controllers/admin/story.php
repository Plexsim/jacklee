<?php
class Story extends Admin_Controller
{
	
	function __construct()
	{
		parent::__construct();

		$this->auth->check_access('Admin', true);
		$this->load->model('story_model');
		$this->lang->load('story');
	}
		
	function index()
	{
		$data['story_title']	= lang('story');
		$data['storys']		= $this->story_model->get_list();
		
		$this->view($this->config->item('admin_folder').'/story', $data);
	}
	
	/********************************************************************
	edit story
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
		
		$data['story_title']	= lang('story_form');
		$data['story']		= $this->story_model->get_list();
		
		if($id)
		{
			
			$story			= $this->story_model->get_story($id);
			
			if(!$story)
			{
				//story does not exist
				$this->session->set_flashdata('error', lang('error_page_not_found'));
				redirect($this->config->item('admin_folder').'/story');
			}
						
			//set values to db values
			$data['id']				= $story['id'];			
			$data['title']			= $story['title'];
			$data['caption']		= $story['caption'];
			$data['content']		= $story['content'];
			$data['sequence']		= $story['sequence'];
			$data['seo_title']		= $story['seo_title'];
			$data['meta']			= $story['meta'];
			$data['enable_date']	= $story['enable_date'];
			$data['disable_date']	= $story['disable_date'];
			$data['image']			= $story['image'];
			$data['status']			= $story['status'];
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
			$this->view($this->config->item('admin_folder').'/story_form', $data);
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
					$this->view(config_item('admin_folder').'/story_form', $data);
					return; //end script here if there is an error
				}
			}
				
			if($uploaded)
			{
				$image			= $this->upload->data();
				$save['image']	= $image['file_name'];
			}
			
			
			
			//save the story
			$story_id	= $this->story_model->save_story($save);
									
			$this->session->set_flashdata('message', lang('message_saved_story'));
			
			//go back to the story list
			redirect($this->config->item('admin_folder').'/story');
		}
	}
	
	
	/********************************************************************
	delete story
	********************************************************************/
	function delete($id)
	{
		
		$story	= $this->story_model->get_story($id);
		
		if($story)
		{
			$this->story_model->delete_story($id);
			$this->session->set_flashdata('message', lang('message_deleted_story'));
		}
		else
		{
			$this->session->set_flashdata('error', lang('error_page_not_found'));
		}
		
		redirect($this->config->item('admin_folder').'/story');
	}
}	