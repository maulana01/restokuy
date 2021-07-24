<?php

namespace App\Controllers;

class Sistem extends BaseController
{
    public function adminBaru()
    {
        if ($this->request->getMethod() == 'post') {
            echo "Sistem::adminBaru[post]";
        } else {
            echo "Sistem::adminBaru[get]";
        }
    }

	public function login()
	{
        if ($this->request->getMethod() == 'post') {
            echo "Sistem::login[post]";
        } else {
            echo "Sistem::login[get]";
        }
	}

    public function logout()
    {
        $session->destroy();
        return redirect()->route('/');
    }
}
