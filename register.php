<?php
  
  # This is just an example
  class register{
    private $lang;
    private $action;
    private $location;
    private $AID;
    private $CJSID;
    private $password;
    private $password_confirm;
    private $email;
    private $colour;
    private $username;
    private $agree_to_rules;
    private $PID;
    private $agree_to_terms;
    private $affiliate;
    
    private function __construct(){
      $this->lang = $_POST['lang'];
      $this->action = $_POST['action'];
      $this->location = $_POST['location'];
      $this->AID = $_POST['AID'];
      $this->CJSID = $_POST['CJSID'];
      $this->password = $_POST['password'];
      $this->password_confirm = $_POST['password_confirm'];
      $this->email = $_POST['email'];
      $this->colour = $_POST['colour'];
      $this->username = $_POST['username'];
      $this->agree_to_rules = $_POST['agree_to_rules'];
      $this->PID = $_POST['PID'];
      $this->agree_to_terms = $_POST['agree_to_terms'];
      $this->affiliate = $_POST['affiliate'];
    }
    
    # Amount of errors for each section
    private $amountArray = array(
      'undefined' => '1|',
      'terms' => '1|',
      'name' => '1|',
      'password' => '1|',
      'email' => '1|',
      'rules' => '1|'
    );
    
    # Error messages for each section
    private $errArray = array(
      'undefined' => '|',
      'terms' => '|',
      'name' => '|',
      'password' => '|',
      'email' => '|',
      'rules' => '|'
    );
    
    
  }
  
?>
