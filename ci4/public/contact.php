<?php

$request = \Config\Services::request();

if(empty($request->getPost('name')) || empty($request->getPost('subject')) || empty($request->getPost('message')) || !filter_var($request->getPost('email'), FILTER_VALIDATE_EMAIL)) {
  echo json_encode(array("status" => "error"));
  exit();
}

$name = strip_tags(htmlspecialchars($request->getPost('name')));
$email = strip_tags(htmlspecialchars($request->getPost('email')));
$subject = strip_tags(htmlspecialchars($request->getPost('subject')));
$message = strip_tags(htmlspecialchars($request->getPost('message')));

$db = \Config\Database::connect();

$data = [
    'ANSname' => $name,
    'ANSsubject' => $subject,
    'email' => $email,
    'ANSmessage' => $message
];

if ($db->table('jdgonzales2_myguests')->insert($data)) {
  echo json_encode(array("status" => "success"));
} else {
  echo json_encode(array("status" => "error"));
}
