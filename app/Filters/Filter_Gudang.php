<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Filter_Gudang implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session()->get('logged_in')) {
            // redirect ke halaman login
            return redirect()->to(base_url('/login'));
        }
    }


    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        if (session()->get('user_name') == 'Admin Gudang') {
            // redirect ke halaman login
            return redirect()->to(base_url('/Dashboard/gudang'));
        }
    }
}
