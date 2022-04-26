<?php

namespace App\Controllers;

class Contact extends BaseController
{
    public function send()
    {
        $email = \Config\Services::email();

        $email->setFrom($this->request->getVar('senderEmail'), $this->request->getVar('sender'));
        $email->setTo('seckovic1.miroslav@gmail.com');
        
        $email->setSubject('Email Test');
        $email->setMessage($this->request->getVar('senderMessage'));
        
        $email->send();
        return redirect()->to('home/index');
        
    }
}