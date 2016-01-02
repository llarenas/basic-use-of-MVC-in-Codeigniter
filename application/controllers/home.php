<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	// index////////////////////////////////////////
	public function index()
	{
	 $this->load->view('file/header'); //
	  $this->load->view('file/menu');
	$this->load->view('home');
	 $this->load->view('file/footer');
	}
/////////////////////////////////////////////////////


	public function insertstudent()
	{
		
	  $this->load->view('file/header');
	  $this->load->view('file/menu');
	  $this->load->view('form');

	  ///////////////////////

	if (isset($_POST['submit']))   // if click ang submit nga button.
	{
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email'); //validation para sa email textbx
		$this->form_validation->set_rules('name', 'name', 'required');
		$this->form_validation->set_rules('id', 'id', 'required');

			if ($this->form_validation->run() == FALSE) // kung false means may kulang
			{
				$this->load->view('form');
			}
			else { //else tsakto
			
			$id=$_POST['id']; // ang mga value sa form ibutang   sa variables
			$name=$_POST['name'];
			$address=$_POST['address'];
			$phone=$_POST['phone'];
			$email=$_POST['email'];
		
			$result=$this->student->insertstudent($id, $name, $address, $phone, $email); // sa model ang /student/ file, /insertstudent/ functon.
				
				if($result) {
				echo "<div class='success'>";
				echo "Successfully Data Inserted";
				echo "</div>";
							}
				else {
				echo "<div class='success'>";
				echo "Somthing Is Missing";
				echo "</div>";
						}
	
	
			}
	
	
	
	}
	else {
	
	}
	 $this->load->view('file/footer');
		
	}


/////////////////////////////////////////////////// delete
	public function DeleteStudent($id)
	{
			
		
	$this->load->view('file/header');
	$this->load->view('file/menu');
	  ////////////////////////
	  echo "<script> x = confirm ('You want to proceed deleting?')";
	 /////////////////////////////
	  $r=$this->student->deletestudent($id);
	  if($r){ /////if naipasa to sa model
	  echo "Successfully Deleted Data";
	  }
	  else {
		  echo "Can Not Delete Data";
	  }
	  
	   
	  
	  $result['query']=$this->student->showstudent();
	  $this->load->view('demoview',$result);
	  $this->load->view('file/footer');
	 
	}



	/////////////////////////////////////////////////////////
 public function ShowData()
 {

  $result['query']=$this->student->showstudent(); // from model
     
	$this->load->view('file/header');
	$this->load->view('file/menu');
	$this->load->view('demoview',$result);
	$this->load->view('file/footer');
 }





 ////////////////////////////////////////////////////////
 public function editstudent($id)
 {
 	$query['data']=$this->student->showstudentCon($id); //model studentcon, for viewing sng gn search

if (isset($_POST['submit']))
	{
		//checking lang ni ya sang validatin input//////////////////////////////////////
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('name', 'name', 'required');
		$this->form_validation->set_rules('id', 'id', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('file/header');
	  		$this->load->view('file/menu');
			$this->load->view('form', $query);
			$this->load->view('file/footer');
		}
		else {
			
	
		$id=$_POST['id'];
		$name=$_POST['name'];
		$address=$_POST['address'];
		$phone=$_POST['phone'];
		$email=$_POST['email'];


//////////////////////////////////
	$result=$this->student->updatestudent($id, $name, $address, $phone, $email);
//////////////////////////


	if($result) //if nakasulod update sa db
	{
		//view sang header kag menu
		$this->load->view('file/header');
	  	$this->load->view('file/menu');
	  	 

	  	/////////////////////////////
		echo "<div class='success'>";
		echo "Successfully Updated";
		echo "</div>";
		$this->load->view('file/footer');
		
		
	}
	else { // kung wala ka sulod sa db
			
			$this->load->view('file/header');
	  		$this->load->view('file/menu');
			echo "<div class='error'>";
			echo "Somthins Is Missing";
			echo "</div>";
			$this->load->view('file/footer');
		
	}
	
	
		}
	
	
	
	}
else {
		$this->load->view('file/header');
	  	$this->load->view('file/menu');
		$this->load->view('form', $query);
		 $this->load->view('file/footer');
	}
	
		 
 }
	
}
