<?php
  # Hide the errors
  error_reporting(0);
  
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
    
    public function __construct(){
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
      'terms' => '1|',
      'name' => '1|',
      'password' => '1|',
      'email' => '1|',
      'rules' => '1'
    );
    
    # I made a small mistake here, but I fixed it here too
    # Error messages for each section
    private $errArray = array(
      'undefined' => '|',
      'terms' => '|',
      'name' => '|',
      'password' => '|',
      'email' => '|',
      'rules' => '|'
    );
    
    /* Tor Check - Recommended
    # Club Penguin doesn't do this
    public function checkTor(){
      $hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
      # Search for 'tor' in the hostname
      $tor = stripos($hostname, 'tor');
      
      if($tor == true){
        $this->numArray['undefined'] = '0|';
        $this->errArray['undefined'] = 'Error submitting penguin|';
        return
      }
    }
    */
    
    # I made a small mistake here, fixed it anyway
    # Just to make sure no one is messing with your registeration
    public function checkPost(){
      if(empty($_POST)){
        $this->numArray['undefined'] = '0|';
        $this->errArray['undefined'] = 'Error submitting penguin|';
        return;
      }
    }
    
    # Some functions do not matter
    
    public function checkLocation(){
      if($this->location != 'create'){
        $this->numArray['undefined'] = '0|';
        $this->errArray['undefined'] = 'Error submitting penguin|';
        return;
      }
    }
    
    public function checkAction(){
      if($this->action == 'create_account'){
        $this->numArray['undefined'] = '0|';
        $this->errArray['undefined'] = 'Error submitting penguin|';
        return;
      }
    }
    
    # A couple of checks for each section
    
    public function checkPassword(){
      if(empty($this->password)){
        $this->numArray['password'] = '0|';
        $this->errArray['password'] = 'You must type your password twice for confirmation.|';
        return;
      }
      
      if(empty($this->password_confirm)){
        $this->numArray['password'] = '0|';
        $this->errArray['password'] = 'You must type your password twice for confirmation.|';
        return;
      }
      
      if(empty($this->password) && empty($this->password_confirm)){
        $this->numArray['password'] = '0|';
        $this->errArray['password'] = 'You must type your password twice for confirmation.|';
        return;
      }
      
      if(strlen($this->password) > 50 || strlen($this->password) < 6 && strlen($this->password_confirm) > 50 || strlen($this->password_confirm) < 6){
        $this->numArray['password'] = '0|';
        $this->errArray['password'] = 'Please enter 6 or more letters or numbers.|';
        return;
      }
    }
    
    public function checkEmail(){
      if(empty($this->email)){
        $this->numArray['email'] = '0|';
        $this->errArray['email'] = 'The email address is not entered correctly. Please try again.|';
        return;
      }
      
      if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
        $this->numArray['email'] = '0|';
        $this->errArray['email'] = 'Please enter a correct email address.|';
        return;
      }
      
      # More validation, this is optional
      # A list of not allowed domains
      $domains = file_get_contents('emails.txt');
      # Make sure each domain is spaced " "
      $domains = explode(' ', $domains);
      $domain = array_pop(explode('@', $this->email));
      
      if(in_array($domain, $domains)){
        $this->numArray['email'] = '0|';
        # Using " because of "can't"
        $this->errArray['email'] = "Oops. This domain name can't be used right now. For more info, please contact us.|";
        return;
      }
      
      /* OPTIONAL - Recommended
      # Club Penguin does not do this
      # http://code.google.com/p/php-smtp-email-validation/
      # This is optional, uncommenting this means more validation == more time
      require_once('smtp_validateEmail.class.php');
      # An example address
      $sender = 'example@github.com';
      $SMTP_Validator = new SMTP_validateEmail();
      $SMTP_Validator->debug = true;
      $results = $SMTP_Validator->validate(array($this->email), $sender);
      
      if(empty($results[$this-email])){
        $this->numArray['email'] = '0|';
        $this->errArray['email'] = "Oops. This email address is not valid. For more info, please contact us.|";
        return;
      }
      */
      
      # Here you can check if the email is used more than 5 times & set the error
    }
    
    public function checkColour(){
      if(empty($this->colour)){
        # Simply set the colour here or do whatever you want
        $this->colour = 15;
        return;
      }
    }
    
    public function checkUsername(){
      if(empty($this->username)){
        $this->numArray['name'] = '0|';
        $this->errArray['name'] = 'You need to name your penguin.|';
        return;
      }
      
      if(preg_match('/\d{6}$/', $this->username)){
        $this->numArray['name'] = '0|';
        $this->errArray['name'] = 'Penguin names can have up to 5 numbers.|';
        return;
      }
      
      if(!preg_match('/[a-z]/i', $this->username)){
        $this->numArray['name'] = '0|';
        $this->errArray['name'] = 'Penguin names must have at least one letter.|';
        return;
      }
      
      if(strlen($this->username) > 12 || strlen($this->username) < 4){
        $this->numArray['name'] = '0|';
        $this->errArray['name'] = 'Penguin name must be at least 4 characters long.|';
        return;
      }
      
      # Here you can check if the penguin name is already taken
      # Use rand() to generate a random username like Club Penguin does
      # Exmaple:
      # $suggestedUser = $this->username . rand(1, 10000);
    }
    
    public function checkRules(){
      if($this->agree_to_rules != '1'){
        $this->numArray['rules'] = '0|';
        $this->errArray['rules'] = 'Please agree to the Club Penguin Rules.|';
        return;
      }
    }
    
    public function checkTerms(){
      if($this->agree_to_terms != '1'){
        $this->numArray['terms'] = '0|';
        $this->errArray['terms'] = 'Please agree to the TERMS OF USE and PRIVACY POLICY.|';
        return;
      }
    }
    
    public function displaySuccess(){
      if(count(array_unique($this->errArray)) > 1){
        foreach($this->numArray as &$num){
          $nums .= $num;
        }
        
        foreach($this->errArray as &$err){
          $errs .= $err;
        }
        
        # Display the error messages
        die('success=' . $nums . '&message=' . $errs . '');
      }
      else{
        # Here you can register the user
      }
    }
  }
  
  # Simply order everything in what to check
  $register = new register();
  # $register->checkTor();
  $register->checkPost();
  # Whenever you want to check just display the success
  $register->displaySuccess();
  $register->checkLocation();
  $register->displaySuccess();
  $register->checkAction();
  $register->displaySuccess();
  # Now this can be all together
  $register->checkUsername();
  $register->checkColour();
  $register->checkPassword();
  $register->checkEmail();
  $register->checkTerms();
  $register->checkRules();
  # Now display the errors or success
  $register->displaySuccess();
  
?>
