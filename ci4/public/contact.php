<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Contact extends Controller {

    public function index() {
      $request = service('request');
      $name = $request->getPost('name');
      $email = $request->getPost('email');
      $subject = $request->getPost('subject');
      $message = $request->getPost('message');

        if(empty($name) || empty($subject) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->response->setJSON(array("status" => "error"));
        }

        $db = db_connect();
        if ($db->connect_errno) {
            return $this->response->setJSON(array("status" => "error"));
        }

        $sql = "INSERT INTO jdgonzales2_myguests (ANSname, ANSsubject, email, ANSmessage) VALUES (?, ?, ?, ?)";

        $result = $db->query($sql, [$name, $subject, $email, $message]);

        if ($result) {
            return $this->response->setJSON(array("status" => "success"));
        } else {
            return $this->response->setJSON(array("status" => "error"));
        }
    }
}
