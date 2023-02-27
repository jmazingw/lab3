<?php namespace App\Controllers;

use CodeIgniter\Controller;

class Contact extends Controller {
    public function index() {
        helper(['form', 'url']);

        if(!$this->validate([
            'name' => 'required',
            'subject' => 'required',
            'message' => 'required',
            'email' => 'required|valid_email'
        ])) {
            return json_encode(array("status" => "error"));
        }

        $name = $this->request->getVar('name', FILTER_SANITIZE_STRING);
        $email = $this->request->getVar('email', FILTER_SANITIZE_EMAIL);
        $subject = $this->request->getVar('subject', FILTER_SANITIZE_STRING);
        $message = $this->request->getVar('message', FILTER_SANITIZE_STRING);

        $servername = "192.168.150.213";
        $username = "webprogss211";
        $password = "fancyR!ce36";
        $dbname = "webprogss211";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

        $sql = "INSERT INTO jdgonzales2_myguests(ANSname, ANSsubject, email, ANSmessage)
        VALUES ('$name', '$subject', '$email', '$message')";

        if ($conn->query($sql) === TRUE) {
          return json_encode(array("status" => "success"));
        } else {
          return json_encode(array("status" => "error"));
        }

        $conn->close();
    }
}
