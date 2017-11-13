<?php 
    include "db_config.php";
    class User{
        protected $db;
        public function __construct(){
            $this->db = new DB_con();
            $this->db = $this->db->ret_obj();
        }
        
        /*** for registration process ***/
        
        public function reg_user($fname,$lname,$username,$email,$password){
        //echo "k";
            $password = md5($password);
            //checking if the username or email is available in db
            $query = "SELECT * FROM users WHERE uname='$username' OR uemail='$email'";
            $result = $this->db->query($query) or die($this->db->error);
            $count_row = $result->num_rows;
            //if the username is not in db then insert to the table
            if($count_row == 0){
                $query = "INSERT INTO users SET fname='$fname', lname='$lname', uname='$username', upass='$password', uemail='$email'";
                $result = $this->db->query($query) or die($this->db->error);
                return true;
            } else {
                return false;
            }
        }   
            
    /*** for login process ***/
        public function check_login($emailusername, $password){
        $password = md5($password);
        
        $query = "SELECT uid, fk_role_id from users WHERE uemail='$emailusername' or uname='$emailusername' and upass='$password'";
        
        $result = $this->db->query($query) or die($this->db->error);
        $user_data = $result->fetch_array(MYSQLI_ASSOC);
        $count_row = $result->num_rows;
        
        if ($count_row == 1) {
                unset($_SESSION['permissions']);
                $_SESSION['login'] = true; // this login var will use for the session thing
                $_SESSION['uid'] = $user_data['uid'];
                $_SESSION['role_id'] = $user_data['fk_role_id'];
                return true;
            }
            
        else{
            return false;}
        
    }   
    public function get_status($uid){
            $query = "SELECT role_name FROM roles 
            INNER JOIN users ON fk_role_id = role_id
            WHERE uid = $uid";
            
            $result = $this->db->query($query) or die($this->db->error);        
            $user_data = $result->fetch_array(MYSQLI_ASSOC);
            if ($user_data) {
                $role = $user_data['role_name'];
            } else {
                $role = 'unknow';
            }
            return $role;
    }
    
    // -------------------------------- PROFILE INFORMATION ------------------------------ //
        
    public function get_profile($uid){
            $query = "SELECT members.mem_id, users.uid
            FROM members
            INNER JOIN users ON members.fk_users_id = users.uid
            WHERE uid = $uid";
            
            $result = $this->db->query($query) or die($this->db->error);        
            $user_data = $result->fetch_array(MYSQLI_ASSOC);
        
    }
    
    function InsertInDatabase($finame, $laname, $email, $address, $zipcode, $city, $phone){
    global $mysqli;
    $query = "INSERT INTO `members` (`finame`, `laname`, `email`, `address`, `zipcode`, `city`, `phone`) 
              VALUES ('$finame', '$laname', '$email', '$address', '$zipcode', '$city', '$phone')";
    $result = mysqli_query($mysqli, $query);
    if($result){
        header('location:?');
        exit();
    }
}
    
    public function get_finame($uid){
        $query = "SELECT finame FROM members WHERE uid = $uid";
        
        $result = $this->db->query($query) or die($this->db->error);
        
        $user_data = $result->fetch_array(MYSQLI_ASSOC);
        echo $user_data['finame'];
        
    }
    
    public function get_laname($uid){
        $query = "SELECT laname FROM members WHERE uid = $uid";
        
        $result = $this->db->query($query) or die($this->db->error);
        
        $user_data = $result->fetch_array(MYSQLI_ASSOC);
        echo $user_data['laname'];
        
    }
    
    public function get_email($uid){
        $query = "SELECT email FROM members WHERE uid = $uid";
        
        $result = $this->db->query($query) or die($this->db->error);
        
        $user_data = $result->fetch_array(MYSQLI_ASSOC);
        echo $user_data['email'];
        
    }
        
    public function get_address($uid){
        $query = "SELECT address FROM members WHERE uid = $uid";
        
        $result = $this->db->query($query) or die($this->db->error);
        
        $user_data = $result->fetch_array(MYSQLI_ASSOC);
        echo $user_data['address'];
        
    }
        
    public function get_zip($uid){
        $query = "SELECT zip FROM members WHERE uid = $uid";
        
        $result = $this->db->query($query) or die($this->db->error);
        
        $user_data = $result->fetch_array(MYSQLI_ASSOC);
        echo $user_data['zip'];
        
    }
        
    public function get_city($uid){
        $query = "SELECT city FROM members WHERE uid = $uid";
        
        $result = $this->db->query($query) or die($this->db->error);
        
        $user_data = $result->fetch_array(MYSQLI_ASSOC);
        echo $user_data['city'];
        
    }
        
    public function get_phone($uid){
        $query = "SELECT phone FROM members WHERE uid = $uid";
        
        $result = $this->db->query($query) or die($this->db->error);
        
        $user_data = $result->fetch_array(MYSQLI_ASSOC);
        echo $user_data['phone'];
        
    }
    
    // -------------------------------------- PROFILE INFORMATION ENDS --------------------------- //
    
    public function get_fname($uid){
        $query = "SELECT fname FROM users WHERE uid = $uid";
        
        $result = $this->db->query($query) or die($this->db->error);
        
        $user_data = $result->fetch_array(MYSQLI_ASSOC);
        echo $user_data['fname'];
        
    }
    
    public function get_lname($uid){
        $query = "SELECT lname FROM users WHERE uid = $uid";
        
        $result = $this->db->query($query) or die($this->db->error);
        
        $user_data = $result->fetch_array(MYSQLI_ASSOC);
        echo $user_data['lname'];
        
    }
    
    public function get_uemail($uid){
        $query = "SELECT uemail FROM users WHERE uid = $uid";
        
        $result = $this->db->query($query) or die($this->db->error);
        
        $user_data = $result->fetch_array(MYSQLI_ASSOC);
        echo $user_data['uemail'];
        
    }
    function fetch_role($uid)
    {
       
        if(isset($_SESSION['role_id']))
        {
        // User exists
            $query = "SELECT role_name FROM roles 
            INNER JOIN users ON fk_role_id = role_id
            WHERE uid = $uid";
            $result = $this->db->query($query) or die($this->db->error);        
            $user_data = $result->fetch_array(MYSQLI_ASSOC);
            //echo $user_data['role_name'];
            // RUN THE MYSQL QUERY TO FETCH THE USER, SAVE INTO $row
            if(!empty($user_data))
            {
                $role = $user_data['role_name'];
            } else {
                $role = "guest";
            }
        }
        return $role;
    }
    
    /*** starting the session ***/
    public function get_session(){
        return $_SESSION['login'];
        }
    public function user_logout() {
        $_SESSION['login'] = FALSE;
        unset($_SESSION);
        session_destroy();
        }
    
}

if (isset($_POST['Submit'])) {
        $fname  = mysqli_real_escape_string($mysqli, $_POST["fname"]);
        $lname  = mysqli_real_escape_string($mysqli, $_POST["lname"]);
        $email   = mysqli_real_escape_string($mysqli, $_POST["email"]);
        $address = mysqli_real_escape_string($mysqli, $_POST["address"]);
        $zipcode = mysqli_real_escape_string($mysqli, $_POST["zipcode"]);
        $city    = mysqli_real_escape_string($mysqli, $_POST["city"]);
        $phone   = mysqli_real_escape_string($mysqli, $_POST["phone"]);

        require_once 'Member.php';
        $user = new User;
        $member = new Member($mysqli, $user);
        $member->upsert($fname, $lname, $email, $address, $zipcode, $city, $phone, $_SESSION['uid']);

        echo '<script>alert(\'Your Informations have been updated\')</script>';
    }
