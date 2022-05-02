<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

use RestServer\Libraries\REST_Controller;

class RestController extends REST_Controller{

    public function __construct(){
		parent::__construct();
		$this->load->library('session');
        $this->load->helper('url');	
	}

	public function index_get()
	{
		$this->response(json_decode(json_encode(array("success"=>"True","Massage"=>"Inside Rest Api"))),200);
		exit();
	}

    public function verifyLoginCredential_post(){

       
		try{
            $incomingContentType1=$_SERVER['CONTENT_TYPE'];
			$incomingContentType2=explode(";",$incomingContentType1);

			if($incomingContentType2[0]!='application/json'){
				$this->response(json_decode(json_encode(array("success"=>"False","Massage"=>"Required CONTENT_TYPE Type Should be application/json, Your CONTENT_TYPE is : ".$incomingContentType1))),500);
				exit();
			}

            

		  	$decodedData=json_decode(trim(file_get_contents('php://input')), TRUE);

              if($decodedData!=null){
				$patientId=trim($decodedData['username']," ");
				$patientPass=trim($decodedData['password']," ");
                $responce=array("success"=>"True","Massage"=>"Logged In Successfully..");
                echo json_encode($responce) ;
				exit();

              }
              else{
                echo "Null Data";
              }
        }
        catch(Exception $e){
			header($_SERVER['SERVER_PROTOCOL'].'500 Internal Server Error');
			exit();
		}
    }

    public function uploadVideos_post(){
        $msg="";
        $webMsg="";
        try{

            $requestFrom=$this->input->post('requestFrom');

            $userId="123456789";
            
            $tmp_file=$_FILES["fileToUpload"]["tmp_name"];
            $file_name=$_FILES["fileToUpload"]["name"];

            if($requestFrom!=null && $requestFrom!="" &&
                $tmp_file!=null){

                for($i=0; $i<count($tmp_file); $i++){

                    $videofilename = $userId."_".rand().".mp4";
                    $path = "videoFile/".$videofilename;

                    $filename=explode(".",$file_name[$i]);

                    if(end($filename)=="mp4"){
                        if(move_uploaded_file($tmp_file[$i],"./".$path)){
                            $tmp="File ".($i+1)."(".$videofilename.") Uploaded";
                            $msg.=$tmp;
                            $msg.=", ";
                            $webMsg.=$tmp;
                            $webMsg.=" <br> ";
                        }
                        else{
                            $tmp="File ".($i+1)."(".$videofilename.") Failed To Upload";

                            $msg.=$tmp;
                            $msg.=", ";
                            $webMsg.=$tmp;
                            $webMsg.=" <br> ";

                        }

                    }
                    else{
                            $tmp="File(".$file_name[$i].") should be .mp4";

                            $msg.=$tmp;
                            $msg.=", ";
                            $webMsg.=$tmp;
                            $webMsg.=" <br> ";
                    }
                }

                if($requestFrom=="web"){
                    $this->load->view("message",array("msg"=>$webMsg));

                }
                else{echo $msg;}

            }
            else{
                $msg.="some data missing";
                $webMsg.="some data missing";
                if($requestFrom=="web"){
                    
                    $this->load->view("message",array("msg"=>$webMsg));

                }
                else{echo $msg;}
                
            }
        }
        catch(Exception $e){
            echo "Internal Server Error";
        }
    }

   
}
