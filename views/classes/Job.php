<?php
 require_once "Db.php";

 class Job extends Db{
    private $connection;

    public function __construct()
    {
        $this->connection=$this->connect();
    }

    public function insert_jobs($title, $location, $salary, $category, $job_type, $description, $status) {
        $job_id = rand(1, 4329) + 1;
        $id = $_SESSION['user_details']['user_id'];
        $user_details = $this->getUserDetails($id);
        $employer_id = $_SESSION['user_details']['user_id'];
        
        $sql = "INSERT INTO jobs(job_id, employer_id, title, location, country, salary, category, job_type, description, status, expiration_date) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, DATE_ADD(NOW(), INTERVAL 1 YEAR))";
        
        $stmt = $this->connection->prepare($sql);
        $result = $stmt->execute([$job_id, $employer_id, $title, $location, $user_details['country'], $salary, $category, $job_type, $description, $status]);
        
        return $result;
    }
    

    public function fetch_jobs(){
        $today = date('Y-m-d');
        $sql="SELECT job_id,employer_id,title,location,jobs.country,salary,category,job_type,description,status,date_added,user_id,company_name,expiration_date FROM jobs JOIN users On user_id = employer_id WHERE expiration_date >= $today ORDER BY date_added DESC";
        $stmt=$this->connection->prepare($sql);
        $stmt->execute();
        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function fetch_jobs_limit_6(){
        $today = date('Y-m-d');
        $sql="SELECT job_id,employer_id,title,location,jobs.country,salary,category,job_type,description,status,date_added,user_id,company_name,expiration_date FROM jobs JOIN users On user_id = employer_id WHERE expiration_date >= $today ORDER BY date_added DESC LIMIT 6";
        $stmt=$this->connection->prepare($sql);
        $stmt->execute();
        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function fetch_locations($id){
         $user_details = $this->getUserDetails($id);
         $sql = "
         SELECT * FROM locations WHERE country = ? 
         UNION 
         SELECT * FROM locations WHERE state = 'Remote';
     ";
        $stmt=$this->connection->prepare($sql);
        $stmt->execute([$user_details['country']]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getUserDetails($id){
        $sql="SELECT country,email FROM users WHERE user_id = ?";
        $stmt=$this->connection->prepare($sql);
       $stmt->execute([$id]);
       $result = $stmt -> fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function fetch_job_functions(){
        $sql="SELECT * FROM job_functions";
        $stmt=$this->connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function job_application($job_id,$fname,$lname,$email,$phone,$cover_letter,$years,$url,$comment,$resume,$applicant_id){

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
                $application_id = rand(1,3000)+1;
            $sql="INSERT into applications(application_id,job_id,fname,lname,email,phone,cover_letter,years,url,comment,resume,applicant_id)VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";
            $stmt=$this->connection->prepare($sql);
            $result = $stmt->execute([$application_id,$job_id,$fname,$lname,$email,$phone,$cover_letter,$years,$url,$comment,$target_file,$applicant_id]);
            return $result;
        }else {
            $_SESSION['error']=("Sorry, there was an error uploading your file.");
            return false;
        }
    }

    public function check_application_form($application_id,$applicant_id){
        $sql="SELECT * FROM applications WHERE job_id = ? AND applicant_id=?";
        $stmt=$this->connection->prepare($sql);
        $stmt->execute([$application_id,$applicant_id]);
        $result=$stmt->rowCount();
        return $result;
    }

    public function fetch_all_application($employer_id) {
        $sql = "SELECT 
                    a.application_id,
                    a.job_id,
                    a.applicant_id,
                    a.resume,
                    a.cover_letter,
                    j.title AS job_title,
                    u.name AS applicant_name,
                    u.email AS applicant_email,
                    a.date_applied
                FROM 
                    applications a
                JOIN 
                    jobs j ON a.job_id = j.job_id
                JOIN 
                    users u ON a.applicant_id = u.user_id
                WHERE 
                    j.employer_id = ? ORDER BY a.date_applied DESC";
    
        $stmt = $this->connection->prepare($sql);
    
        $stmt->execute([$employer_id]);

        $applications = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $applications;
    }
    
 
    public function getJobPostingsByEmployer($employer_id) {
        $query = "SELECT * FROM jobs WHERE employer_id = :employer_id ORDER BY date_added DESC"; // Adjust table name and columns as needed
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':employer_id', $employer_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetching all matching job postings
    }

    public function getRecentApplicationsByEmployer($employer_id) {
        $query = "
            SELECT applications.*, jobs.title AS job_title, users.name AS applicant_name 
            FROM applications 
            INNER JOIN jobs ON applications.job_id = jobs.job_id 
            INNER JOIN users ON applications.applicant_id = users.user_id 
            WHERE jobs.employer_id = :employer_id 
            ORDER BY applications.date_applied DESC 
            LIMIT 10"; // Adjust limit as needed
        
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':employer_id', $employer_id, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetching all recent applications
    }

    public function get_job_by_id($id){
        $sql="SELECT * FROM jobs JOIN users On user_id = employer_id WHERE job_id=?";
        $stmt=$this->connection->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    

    public function fetch_all_jobs(){
        $today = date('Y-m-d');
        $sql="SELECT job_id,employer_id,title,location,jobs.country,salary,category,job_type,description,date_added,user_id,company_name,expiration_date FROM jobs JOIN users On user_id = employer_id WHERE expiration_date >= $today ORDER BY RAND()";
        $stmt=$this->connection->prepare($sql);
        $stmt->execute();
        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function fetch_jobseeker_applications($applicant_id){
      $sql="SELECT * FROM applications JOIN jobs ON jobs.job_id = applications.job_id WHERE applicant_id=?";
      $stmt=$this->connection->prepare($sql);
      $stmt->execute([$applicant_id]);
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $result;
    }

    public function withdraw($application_id){
        $sql="DELETE FROM applications WHERE application_id=?";
        $stmt=$this->connection->prepare($sql);
        $result = $stmt->execute([$application_id]);
        return $result;
    }
  

 }

?>