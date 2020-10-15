<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	   public function __construct()
	    {
	  	  parent::__construct();
	  	
		
	        $this->load->model('regi_model');

	    }
	
	public function index()
	{
		
		 $this->load->view('templates/header');

		 $this->load->view('reg-log');
		
	}

	 function validation(){
		$this->form_validation->set_rules('user_name','Name','required|trim');
		$this->form_validation->set_rules('user_email','Email Address','required|trim|valid_email|is_unique[register.email]');
		$this->form_validation->set_rules('user_password','Password','required');
		if($this->form_validation->run()){
			  $verification_key=md5(rand());
			  $password=md5('user_password');
			  $data=array(
				  'name'=> $this->input->post('user_name'),
				  'email'=> $this->input->post('user_email'),
				  'password'=> $password,
				  'verification_key'=>$verification_key
			  );
			  $id=$this->regi_model->insert($data);
			  if($id>0){
				  $subject="please verify email for login";
				  $message="<p>Hi ".$this->input->post('user_name')."</p>
				  <p>This is email verification mail from codeigniter login register system.For complete registration and login into system,
				  first you want to verify your email by click this <a href='".base_url()."welcome/verify_email/".$verification_key."'>link</a></p>
				  <p>once you click this link your email will be varified and you can login into system.</p>
				  <p>Thanks</p>
				  ";

				//  
				function send_mail(){
					$config['protocol'] = 'smtp';
					$config['smtp_host'] = 'ssl://smtp.googlemail.com';
					$config['smtp_port'] = 465;
					$config['smtp_user'] = 'xyz@gmail.com';
					$config['smtp_pass'] = 'xxxxxxx';
					
					$this->load->library('email', $config);
					$this->email->set_newline("\r\n");
					
					$this->email->from('neginph@gmail.com', 'Negin Phosphate Shomal');
					$this->email->to('neginfos@yahoo.com');
					$this->email->subject('This is an email test');
					$this->email->message('It is working. Great!');
					
					if($this->email->send())
					{
						echo 'Your email was sent, successfully.';
					}
					
					else
					{
						show_error($this->email->print_debugger());
					}
					}


				 
			  }
		}
		else{
			$this->index();
		}
	}
	function verify_email(){
		if($this->uri->segment(3))
		{
			$verification_key=$this->uri->segment(3);
			if($this->regi_model->verify_email($verification_key))
			{
                $data['message']='<h1 style="align:center;">your email has been successfully verified,now you can login from <a href="'.base_url().'login">here</a></h1>';
			}
			else{
				$data['message']='<h1 style="align:center;">Invalid Link</h1>';
			}
			$this->load->view('templates/header');
			$this->load->view('verification_email',$data);
		}
	}
	
}
