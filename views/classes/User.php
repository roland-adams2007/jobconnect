<?php
 require_once "Db.php";

 class User extends Db{
    private $connection;

    public function __construct(){
        $this->connection=$this->connect();
    }


    public function updateResume($resume,$id){
        $target_dir = "assets/uploads/resumes/";
        $resume_name = basename($resume["name"]);
        $target_file = $target_dir . time() . "_" . $resume_name;
        
    
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
    
        $resume_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_types = ['pdf', 'doc', 'docx']; // Allowed file types
    
        if (!in_array($resume_type, $allowed_types)) {
            $_SESSION['error']=("Invalid file type. Only PDF, DOC, and DOCX are allowed.");
            return false;
        }
    
        if ($resume["size"] > 5000000) { // 5MB limit
            $_SESSION['error']=("File is too large. Max file size is 5MB.");
            return false;
        }


        if (move_uploaded_file($resume["tmp_name"], $target_file)) {
            $sql="UPDATE users SET resume=? WHERE user_id=?";
            $stmt=$this->connection->prepare($sql);
            $result=$stmt->execute([$target_file,$id]);
            return $result;
        }else {
            return false;
        }


    }

    public function updateUserDetails($name,$phone,$address,$id){
        $sql="UPDATE users SET name=?,phone=?,address=? WHERE user_id=?";
        $stmt=$this->connection->prepare($sql);
        $result=$stmt->execute([$name,$phone,$address,$id]);
        return $result;
    }

    public function getUserDetails($id){
        $user_type = $_SESSION['user_details']['user_type'];
        $sql="SELECT name,email,phone,country,resume,address,company_name,industry,employees FROM users WHERE user_id = ? and user_type=? ";
        $stmt=$this->connection->prepare($sql);
       $stmt->execute([$id,$user_type]);
       $result = $stmt -> fetch(PDO::FETCH_ASSOC);
        return $result;
    }


    public function login_user($email,$password){

        $sql="SELECT user_id,user_type,email,password from users WHERE email = ?";
        $stmt=$this->connection->prepare($sql);
        $stmt->execute([$email]);
        $result=$stmt->fetch(PDO::FETCH_ASSOC);

        if($result){
           $hashed = $result['password'];
           $chk = password_verify($password,$hashed);
           if($chk){
            $_SESSION['user_details']=[
                'user_type' => $result['user_type'],
                'user_id' => $result['user_id']
               ];
               return true;
           }else{
            $_SESSION['error'] = "Invaild credentials";
             return false;
           }

        }else{
            $_SESSION['error'] = "Invaild credentials";
            return false;
        }

    }

    public function checkEmail($email){
        $sql="SELECT email from users WHERE email = ?";
        $stmt=$this->connection->prepare($sql);
        $stmt->execute([$email]);
        $result = $stmt->rowCount();
        return $result;
    }

    public function checkPhone($phone){
        $sql="SELECT phone from users WHERE phone = ?";
        $stmt=$this->connection->prepare($sql);
        $stmt->execute([$phone]);
        $result = $stmt->rowCount();
        return $result;
    }

    public function insert_employer($company_name,$name,$email,$password,$phone,$industry,$employees,$referral,$country,$address){
        $checkedEmail = $this->checkEmail($email);
        $checkedPhone = $this->checkPhone($phone);
        $hashed = password_hash($password, PASSWORD_BCRYPT);
        $user_type='employer';
        $id = rand(1,4000)+1;

        if($checkedEmail > 0){
            $_SESSION['error']=("This email has been registered, try another.");
            return false;
        }

        if($checkedPhone > 0){
            $_SESSION['error']=("This Phone number has been registered, try another.");
            return false;
        }

        $sql="INSERT into users(user_id,user_type,company_name,name,email,password,phone,industry,employees,referral,country,address)VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt=$this->connection->prepare($sql);
        $result = $stmt->execute([$id,$user_type,$company_name,$name,$email,$hashed,$phone,$industry,$employees,$referral,$country,$address]);
        
        if($result){
            $_SESSION['user_details']=[
                'user_type' => $user_type,
                'user_id' => $id
               ];
        return true;
        }else{
        $_SESSION['error']=("An error occurred while trying to register, try again");
        return false;
        }

    }

    public function insert_job_seeker($name, $email, $password, $dob, $gender, $country, $phone, $qualification, $experience, $job_function, $availability, $resume, $address) {

        $checkedEmail = $this->checkEmail($email);
        $checkedPhone = $this->checkPhone($phone);

        if($checkedEmail > 0){
            $_SESSION['error']=("This email has been registered, try another.");
            return false;
        }

        if($checkedPhone > 0){
            $_SESSION['error']=("This Phone number has been registered, try another.");
            return false;
        }

        $user_type = 'job seeker';
        $hashed = password_hash($password, PASSWORD_BCRYPT);

        $target_dir = "assets/uploads/resumes/";
        $resume_name = basename($resume["name"]);
        $target_file = $target_dir . time() . "_" . $resume_name;
        
    
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
    
        $resume_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_types = ['pdf', 'doc', 'docx']; // Allowed file types
    
        if (!in_array($resume_type, $allowed_types)) {
            $_SESSION['error']=("Invalid file type. Only PDF, DOC, and DOCX are allowed.");
            return false;
        }
    
        if ($resume["size"] > 5000000) { // 5MB limit
            $_SESSION['error']=("File is too large. Max file size is 5MB.");
            return false;
        }


    
        // Move uploaded file to the uploads directory
        if (move_uploaded_file($resume["tmp_name"], $target_file)) {
            $id = rand(1,3000)+1;
            $sql = "INSERT INTO users (user_id,user_type, name, email, password, dob, gender, country, phone, highest_qualification, experience, current_job, availability, resume, address) 
                    VALUES (?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->connection->prepare($sql);
            
            $result = $stmt->execute([
                $id,
                $user_type, 
                $name, 
                $email, 
                $hashed, 
                $dob, 
                $gender, 
                $country, 
                $phone, 
                $qualification, 
                $experience, 
                $job_function, 
                $availability, 
                $target_file,
                $address
            ]);
    
            if($result){
                $_SESSION['user_details']=[
                 'user_type' => $user_type,
                 'user_id' => $id
                ];
               return true;
            }else{
                $_SESSION['error']=("An error occured");
               return false;
            }
        } else {
            $_SESSION['error']=("Sorry, there was an error uploading your file.");
            return false;
        }
    }
    

    public function fetch_countries(){
        $sql="SELECT * FROM countries";
        $stmt=$this->connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }



    public function fetch_country_codes(){
        $sql="SELECT * FROM country_codes JOIN countries ON countries.id = country_codes.country_id";
        $stmt=$this->connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function fetch_job_functions(){
        $sql="SELECT * FROM job_functions";
        $stmt=$this->connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function fetch_industries(){
        $sql="SELECT * FROM industries";
        $stmt=$this->connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

   public function logout(){
    unset($_SESSION['user_details']);
   }

 }
?>