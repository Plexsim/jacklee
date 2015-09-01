<?php

class Settings extends Admin_Controller {
    
    function __construct()
    {
        parent::__construct();

        $this->auth->check_access('Admin', true);
        $this->load->model('Settings_model');
        $this->load->model('Messages_model');
        $this->lang->load('settings');
        $this->load->helper('inflector');
    }
    
    function index()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');


        $this->form_validation->set_rules('company_name', 'lang:company_name', 'required');
        $this->form_validation->set_rules('theme', 'lang:theme', 'required');
        $this->form_validation->set_rules('email', 'lang:cart_email', 'required|valid_email');

        $this->form_validation->set_rules('country_id', 'lang:country');
        $this->form_validation->set_rules('address1', 'lang:address');
        $this->form_validation->set_rules('address2', 'lang:address');
        $this->form_validation->set_rules('zone_id', 'lang:state');
        $this->form_validation->set_rules('zip', 'lang:zip');

        $this->form_validation->set_rules('locale', 'lang:locale', 'required');
        $this->form_validation->set_rules('currency_iso', 'lang:currency', 'required');

      

        $data = $this->Settings_model->get_settings('gocart');
        
        $data['config'] = $data;
        //break out order statuses to an array

        //get installed themes
        $data['themes'] = array();
        if ($handle = opendir(FCPATH.APPPATH.'/themes')) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != ".." && is_dir(FCPATH.APPPATH.'/themes/'.$entry)) {
                    $data['themes'][$entry] = $entry;
                }
            }
            closedir($handle);
        }
        asort($data['themes']);

        //get locales
        $locales = ResourceBundle::getLocales('');
        $data['locales'] = array();
        foreach($locales as $locale)
        {
            $data['locales'][$locale] = locale_get_display_name($locale);
        }
        asort($data['locales']);
        //get ISO 4217 codes
        $data['iso_4217'] = array();
        $iso_4217 =json_decode(json_encode(simplexml_load_file(FCPATH.'ISO_4217.xml')));
        $iso_4217 = $iso_4217->CcyTbl->CcyNtry;
        foreach($iso_4217 as $iso_code)
        {
            if(isset($iso_code->Ccy))
            {
                $data['iso_4217'][$iso_code->Ccy] = $iso_code->Ccy;    
            }
        }
        asort($data['iso_4217']);


        $data['countries_menu'] = $this->Location_model->get_countries_menu();
        if(!empty($data['country_id']))
        {
            $data['zones_menu'] = $this->Location_model->get_zones_menu($data['country_id']);
        }
        else
        {
            $data['zones_menu'] = $this->Location_model->get_zones_menu(array_shift(array_keys($data['countries_menu'])));
        }

        $data['page_title'] = lang('common_gocart_configuration');

        if ($this->form_validation->run() == FALSE)
        {
            $data['error'] = validation_errors();
            $this->view($this->config->item('admin_folder').'/settings', $data);
        }
        else
        {
            $this->session->set_flashdata('message', lang('config_updated_message'));

            $save = $this->input->post();
            //fix boolean values
            $save['ssl_support'] = $this->input->post('ssl_support');
            $save['require_login'] = $this->input->post('require_login');
            $save['new_customer_status'] = $this->input->post('new_customer_status');
            $save['allow_os_purchase'] = $this->input->post('allow_os_purchase');
            $save['tax_shipping'] = $this->input->post('tax_shipping');

            $this->Settings_model->save_settings('gocart', $save);

            redirect(config_item('admin_folder').'/settings');
        }
        
    }
    
    function gps_setting()
    {
    	$this->load->helper('form');
    	$this->load->library('form_validation');
        		
    	$this->form_validation->set_rules('address', 'lang:address','required');
    	$this->form_validation->set_rules('gps', 'lang:gps','required');
    
    	$data = $this->Settings_model->get_settings('gocart');
    
    	$data['page_title'] = lang('common_gps_setting');    	
    	
    	
    	if ($this->form_validation->run() == FALSE)
    	{
    		$data['error'] = validation_errors();
    		$this->view($this->config->item('admin_folder').'/gps_setting', $data);
    	}
    	else
    	{
    		$this->session->set_flashdata('message', lang('gps_updated_message'));
    	
    		$save = $this->input->post();
    		//fix boolean values
    		$save['address'] = $this->input->post('address');
    		$save['gps'] = $this->input->post('gps');    		
    		$this->Settings_model->save_settings('gocart', $save);
    	
    		redirect(config_item('admin_folder').'/settings/gps_setting');
    	}
    
    }
    
    function wife_setting()
    {
    	$this->load->helper('form');
    	$this->load->library('form_validation');
    	
    	$this->load->helper('url');
    	$this->load->helper('form');
    	
    	$config['upload_path']		= 'uploads/gallery/full';
    	$config['allowed_types']	= 'gif|jpg|png';
    	$config['max_size']			= $this->config->item('size_limit');
    	$config['encrypt_name']		= true;
    	$this->load->library('upload', $config);    	
    
    	$this->form_validation->set_rules('wife_name', 'lang:wife_name','required');
    	$this->form_validation->set_rules('wife_description', 'lang:wife_description');
    	$this->form_validation->set_rules('wife_image', 'lang:wife_image', 'trim');
    
    	$data = $this->Settings_model->get_settings('gocart');    
    	$data['page_title'] = lang('common_wife_setting');
    	 
    	if ($this->form_validation->run() == FALSE)
    	{
    		$data['error'] = validation_errors();
    		$this->view($this->config->item('admin_folder').'/wife_setting', $data);
    	}
    	else
    	{
    		
    		$this->load->helper('text');
    		 
    		$uploaded	= $this->upload->do_upload('wife_image');    		 
    		$save = array();
    		 
    		$save = $this->input->post();
    		//fix boolean values
    		$save['wife_name'] 	 = $this->input->post('wife_name');
    		$save['wife_description'] = $this->input->post('wife_description');
    		    		
    		//delete the original file if another is uploaded
    		if($uploaded)
    		{
    			if($data['wife_image'] != '')
    			{
    				$file = 'uploads/gallery/full/'.$data['wife_image'];
    		
    				//delete the existing file if needed
    				if(file_exists($file))
    				{
    					unlink($file);
    				}
    			}
    		}
    		
    		if(!$uploaded)
    		{
    			$data['error']	= $this->upload->display_errors();
    			$this->view(config_item('admin_folder').'/wife_setting', $data);
    			return; //end script here if there is an error
    		}
    		
    		if($uploaded)
    		{
    			$image			= $this->upload->data();
    			$save['wife_image']	= $image['file_name'];
    		}
    		
    		$this->session->set_flashdata('message', lang('wife_updated_message'));
    		$this->Settings_model->save_settings('gocart', $save);
    		 
    		redirect(config_item('admin_folder').'/settings/wife_setting');
    	}   

    }
    
    function husband_setting()
    {
    	$this->load->helper('form');
    	$this->load->library('form_validation');
    	 
    	$this->load->helper('url');
    	$this->load->helper('form');
    	 
    	$config['upload_path']		= 'uploads/gallery/full';
    	$config['allowed_types']	= 'gif|jpg|png';
    	$config['max_size']			= $this->config->item('size_limit');
    	$config['encrypt_name']		= true;
    	$this->load->library('upload', $config);
    
    	$this->form_validation->set_rules('husband_name', 'lang:husband_name','required');
    	$this->form_validation->set_rules('husband_description', 'lang:husband_description');
    	$this->form_validation->set_rules('husband_image', 'lang:husband_image', 'trim');
    
    	$data = $this->Settings_model->get_settings('gocart');
    	$data['page_title'] = lang('common_husband_setting');
    
    	if ($this->form_validation->run() == FALSE)
    	{
    		$data['error'] = validation_errors();
    		$this->view($this->config->item('admin_folder').'/husband_setting', $data);
    	}
    	else
    	{
    
    		$this->load->helper('text');
    		 
    		$uploaded	= $this->upload->do_upload('husband_image');
    		$save = array();
    		 
    		$save = $this->input->post();
    		//fix boolean values
    		$save['husband_name'] 	 = $this->input->post('husband_name');
    		$save['husband_description'] = $this->input->post('husband_description');
    
    		//delete the original file if another is uploaded
    		if($uploaded)
    		{
    			if($data['husband_image'] != '')
    			{
    				$file = 'uploads/gallery/full/'.$data['husband_image'];
    
    				//delete the existing file if needed
    				if(file_exists($file))
    				{
    					unlink($file);
    				}
    			}
    		}
    
    		if(!$uploaded)
    		{
    			$data['error']	= $this->upload->display_errors();
    			$this->view(config_item('admin_folder').'/husband_setting', $data);
    			return; //end script here if there is an error
    		}
    
    		if($uploaded)
    		{
    			$image			= $this->upload->data();
    			$save['husband_image']	= $image['file_name'];
    		}
    
    		$this->session->set_flashdata('message', lang('husband_updated_message'));
    		$this->Settings_model->save_settings('gocart', $save);
    		 
    		redirect(config_item('admin_folder').'/settings/husband_setting');
    	}
    
    }
    

    function canned_messages()
    {
        $data['canned_messages'] = $this->Messages_model->get_list();
        $data['page_title'] = lang('common_canned_messages');
        $this->view($this->config->item('admin_folder').'/canned_messages', $data);
    }

  
    function canned_message_form($id=false)
    {
        $data['page_title'] = lang('canned_message_form');

        $data['id']         = $id;
        $data['name']       = '';
        $data['subject']    = '';
        $data['content']    = '';
        $data['deletable']  = 1;
        
        if($id)
        {
            $message = $this->Messages_model->get_message($id);
                        
            $data['name']       = $message['name'];
            $data['subject']    = $message['subject'];
            $data['content']    = $message['content'];
            $data['deletable']  = $message['deletable'];
        }
        
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('name', 'lang:message_name', 'trim|required|max_length[50]');
        $this->form_validation->set_rules('subject', 'lang:subject', 'trim|required|max_length[100]');
        $this->form_validation->set_rules('content', 'lang:message_content', 'trim|required');
        
        if ($this->form_validation->run() == FALSE)
        {
            $data['errors'] = validation_errors();
            
            $this->view($this->config->item('admin_folder').'/canned_message_form', $data);
        }
        else
        {
            
            $save['id']         = $id;
            $save['name']       = $this->input->post('name');
            $save['subject']    = $this->input->post('subject');
            $save['content']    = $this->input->post('content');
            
            //all created messages are typed to order so admins can send them from the view order page.
            if($data['deletable'])
            {
                $save['type'] = 'order';
            }
            $this->Messages_model->save_message($save);
            
            $this->session->set_flashdata('message', lang('message_saved_message'));
            redirect($this->config->item('admin_folder').'/settings/canned_messages');
        }
    }
    
    function delete_message($id)
    {
        $this->Messages_model->delete_message($id);
        
        $this->session->set_flashdata('message', lang('message_deleted_message'));
        redirect($this->config->item('admin_folder').'/settings/canned_messages');
    }
}