<?php

class AppointmentManager
{
    private $db;

    public function __construct()
    {
        // Initialize your database connection (modify the credentials)
        $this->db = new PDO('mysql:host=localhost;dbname=pawheart', 'root', '');
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function insertAppointmentData($name, $email, $contact, $doctor, $petName, $petAge, $petType, $petAmount, $date, $time, $symptoms)
    {
        $stmt = $this->db->prepare("INSERT INTO appointments (name, email, contact_number, doctor_name, petName, petAge, pet_type, petAmount, appointment_date, appointment_time, symptoms) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$name, $email, $contact, $doctor, $petName, $petAge, $petType, $petAmount, $date, $time, $symptoms]);
    }
}
