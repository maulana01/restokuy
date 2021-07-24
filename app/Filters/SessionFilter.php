<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class SessionFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $login = false;
		if ($arguments !== null) {
			foreach ($arguments as $arg) {
				$login = ($arg == 'login'? true : false);
			}
		}

        if ($session->has('id_akun') && $session->has('password') && $login) {
            $id_akun = $session->get('id_akun');
            $pass = $session->get('password');

            $db = db_connect();

            $loginSql = 'SELECT username FROM akun WHERE id_akun = ? AND password = ?';
            $loginResult = $db->query($loginSql, [$id_akun, $pass]);

            if ($loginResult->getNumRows()==0) {
                $session->destroy();

                $db->close();
                return redirect()->route('/');
            }

            $pegawaiSql = 'SELECT id_pegawai FROM pegawai WHERE id_akun = ?';
            $pegawaiResult = $db->query($pegawaiSql, [$id_akun]);

            if ($pegawaiResult->getNumRows()==0) {
                $hapusAkunSql = 'DELETE FROM akun WHERE id_akun = ?';
                $db->query($hapusAkunSql);
                $session->destroy();

                $db->close();
                return redirect()->route('/');
            }

            $jabatanSql = 'SELECT jabatan FROM pegawai JOIN akun ON pegawai.id_akun=akun.id_akun WHERE id_akun = ?';
            $jabatanResult = $db->query($jabatanSql, [$id_akun]);
            $jabatan = strtolower($jabatanResult->getRow()->jabatan);
            
            switch ($jabatan) {
                case 'admin':
                    // do nothing
                    break;
                case 'koki':
                    // do nothing
                    break;
                case 'pelayan':
                    // do nothing
                    break;
                case 'kasir':
                    // do nothing
                    break;
                default:
                    $hapusPegawaiSql = 'DELETE FROM pegawai WHERE id_akun = ?';
                    $db->query($hapusPegawaiSql, [$id_akun]);
                    $hapusAkunSql = 'DELETE FROM akun WHERE id_akun = ?';
                    $db->query($hapusAkunSql, [$id_akun]);
                    $session->destroy();

                    $db->close();
                    return redirect()->route('/');
            }
        } else {
            if (!$login) {
                return redirect()->route('/');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}