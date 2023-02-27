<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Contact extends Controller
{
    public function index()
    {
        helper(['form']);
        $data = [];
        echo view('contact', $data);
    }

    public function submit()
    {
        helper(['form']);

        $request = service('request');
        $name = $request->getPost('name');
        $email = $request->getPost('email');
        $subject = $request->getPost('subject');
        $message = $request->getPost('message');

        $validation = \Config\Services::validation();

        $validation->setRules([
            'name' => 'required|min_length[3]|max_length[255]',
            'email' => 'required|valid_email',
            'subject' => 'required|min_length[3]|max_length[255]',
            'message' => 'required|min_length[5]'
        ]);

        if (!$validation->run(['name' => $name, 'email' => $email, 'subject' => $subject, 'message' => $message])) {
            $errors = $validation->getErrors();
            return redirect()->to('/contact')->withInput()->with('errors', $errors);
        }

        $db = db_connect();

        $data = [
            'ANSname' => $name,
            'ANSsubject' => $subject,
            'email' => $email,
            'ANSmessage' => $message
        ];

        $builder = $db->table('jdgonzales2_myguests');
        $builder->insert($data);

        $db->close();

        return redirect()->to('/contact')->with('success', 'Data has been added to the database.');
    }
}
