<?php
  
  # This is just an example
  # Written by master Astro260
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
    private $numArray = array(
      'undefined' => '1|',
      'password' => '1|',
      'email' => '1|',
      'name' => '1|',
      'rules' => '1|',
      'terms' => '1|'
    );
    
    # Error messages for each section
    private $errArray = array(
      'undefined' => '1|',
      'password' => '1|',
      'email' => '1|',
      'name' => '1|',
      'rules' => '1|',
      'terms' => '1|'
    );
    
    # Just to make sure no one is messing with your registeration
    private function checkPost(){
      if(empty($_POST)){
        $this->numArray['unknown'] = '0|';
        $this->errArray['unknown'] = 'Error submitting penguin|';
      }
    }
    
    # Some functions do not matter
    
    private function checkLocation(){
      if($this->location != 'create'){
        $this->numArray['unknown'] = '0|';
        $this->errArray['unknown'] = 'Error submitting penguin|';
      }
    }
    
    private function checkAction(){
      if($this->action == 'create_account'){
        $this->numArray['unknown'] = '0|';
        $this->errArray['unknown'] = 'Error submitting penguin|';
      }
    }
    
    # A couple of checks for each section
    
    private function checkPassword(){
      if(empty($this->password)){
        $this->numArray['password'] = '0|';
        $this->errArray['password'] = 'You must type your password twice for confirmation.|';
      }
      elseif(empty($this->password_confirm)){
        $this->numArray['password'] = '0|';
        $this->errArray['password'] = 'You must type your password twice for confirmation.|';
      }
      elseif(empty($this->password) && empty($this->password_confirm)){
        $this->numArray['password'] = '0|';
        $this->errArray['password'] = 'You must type your password twice for confirmation.|';
      }
      elseif(strlen($this->password) > 50 || strlen($this->password) < 6 && strlen($this->password_confirm) > 50 || strlen($this->password_confirm) < 6){
        $this->numArray['password'] = '0|';
        $this->errArray['password'] = 'Please enter 6 or more letters or numbers.|';
      }
    }
    
    private function checkEmail(){
      if(empty($this->email)){
        $this->numArray['email'] = '0|';
        $this->errArray['email'] = 'The email address is not entered correctly. Please try again.|';
      }
      
      # Here you can check if the email is used more than 5 times & set the error
    }
    
    private function checkColour(){
      if(empty($this->colour)){
        # Simply set the colour here or do whatever you want
      }
    }
    
    private function checkUsername(){
      if(empty($this->username)){
        $this->numArray['name'] = '0|';
        $this->errArray['name'] = 'You need to name your penguin.|';
      }
      elseif(preg_match('/\d{6}$/', $this->username)){
        $this->numArray['name'] = '0|';
        $this->errArray['name'] = 'Penguin names can have up to 5 numbers.|';
      }
      elseif(!preg_match('/[a-z]/i', $this->username)){
        $this->numArray['name'] = '0|';
        $this->errArray['name'] = 'Penguin names must have at least one letter.|';
      }
      elseif(strlen($this->username) > 12 || strlen($this->username) < 4){
        $this->numArray['name'] = '0|';
        $this->errArray['name'] = 'Penguin name must be at least 4 characters long.|';
      }
      
      # Here you can check if the penguin name is already taken
      # Use rand() to generate a random username like Club Penguin does
      # Exmaple:
      # $suggestedUser = $this->username . rand(1, 10000);
    }
    
    private function checkRules(){
      if($this->agree_to_rules != '1'){
        $this->numArray['rules'] = '0|';
        $this->errArray['rules'] = 'Please agree to the Club Penguin Rules.|';
      }
    }
    
    private function checkTerms(){
      if($this->agree_to_terms != '1'){
        $this->numArray['terms'] = '0|';
        $this->errArray['terms'] = 'Please agree to the TERMS OF USE and PRIVACY POLICY.|';
      }
    }
    
    private function displaySuccess(){
      if(count(array_unique($this->errArray)) > 1){
        foreach($this->numArray as &$num){
          $nums .= $num;
        }
        
        foreach($this->errArray as &$err){
          $errs .= $err;
        }
        
        # Display the error messages
        die('success=' . $errs . '&message=' . $nums . '');
      }
      else{
        # Here you can register the user
      }
    }
  }
  
  # Simply order everything in what to check
  $register = new register();
  $register->checkPost();
  $register->checkLocation();
  $register->checkAction();
  $register->checkUsername();
  $register->checkColour();
  $register->checkPassword();
  $register->checkEmail();
  $register->checkTerms();
  $register->checkRules();
  # Now display the errors or success
  $register->displaySuccess();
  
?>
