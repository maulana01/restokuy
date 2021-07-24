<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class NoAdminFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $noreturn = false;
		if ($arguments !== null) {
			foreach ($arguments as $arg) {
				$noreturn = ($arg == 'noreturn'? true : false);
			}
		}

        $db = db_connect();

        $result = $db->query('SELECT akun.id_akun FROM akun JOIN pegawai ON akun.id_akun=pegawai.id_akun WHERE jabatan="admin"');
        
        if ($result->getNumRows()==0) { // admin kosong
            if (!$noreturn) {
                return redirect()->route('xyz/new');
            }
        } else { // ada admin
            if ($noreturn) {
                return redirect()->route('/');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}