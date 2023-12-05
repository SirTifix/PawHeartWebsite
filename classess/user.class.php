<?php

require_once 'db.php';

Class User{
    //attributes

    public $id;
    public $name;
    public $email;
    public $password;
    public $contact;
    public $petName;
    public $petType;
    public $petAge;
    public $doctor;
    public $date;
    public $time;
    public $symptoms;
    public $petAmount;

    protected $db;

    function __construct()
    {
        $this->db = new dbConnect();

        if ($this->db->connect() === null) {
            die("Error: Database connection failed.");
        }
    }

    //Methods

    function add($name, $email, $contact, $petname, $password, $pettype, $petage){
        $sql = "INSERT INTO paw(name, email, contact, petName, password, petType, petAge) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $query = $this->db->connect()->prepare($sql);
        
        // Hash the password securely using password_hash
        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);
    
        $query->bind_param('sssssss', $this->name, $this->email, $this->contact, $this->petName, $hashedPassword, $this->petType, $this->petAge);
    
        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    function edit(){
        $sql = "UPDATE paw SET name=?, email=?, contact=?, password=?, petName=?, petType=?, petAge=? WHERE id=?";
        $query = $this->db->connect()->prepare($sql);
        $query->bind_param('sssssssi', $this->name, $this->email, $this->contact, $this->password, $this->petName, $this->petType, $this->petAge, $this->id);
    
        // Hash the password securely using password_hash
        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);
        $query->bindParam(4, $hashedPassword);
    
        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function fetch($id){
        $sql = "SELECT * FROM paw WHERE id = ?";
        $query = $this->db->connect()->prepare($sql);
        $query->bind_param('i', $id); // Assuming 'id' is an integer, adjust if needed
        
        if($query->execute()){
            $result = $query->get_result();
            $data = $result->fetch_assoc();
            return $data;
        } else {
            return false;
        }
    }
    
// Example usage
    function is_email_exist(){
        $sql = "SELECT * FROM paw WHERE email = ?";
        $query = $this->db->connect()->prepare($sql);
        $query->bind_param('s', $this->email);
        if($query->execute()){
            if($query->get_result()->num_rows > 0){
                return true;
            }
        }
        return false;
    }

    // Appointment Function - carl
    public function insertUserData($name, $email, $contact, $petName, $petType, $petAge, $doctor, $date, $time, $symptoms, $petAmount) {
    // Use prepared statements to prevent SQL injection - carl
    $sql = "INSERT INTO appointment(name, email, contact_number, petName, pet_type, petAge, doctor_name, appointment_date, appointment_time, symptoms, petAmount) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $query = $this->db->connect()->prepare($sql);

    // Bind parameters to the prepared statement
    $query->bind_param("sssssssssss", $name, $email, $contact, $petName, $petType, $petAge, $doctor, $date, $time, $symptoms, $petAmount);

    // Execute the statement
    $query->execute();

    // Close the statement
    $query->close();
}

}
?>