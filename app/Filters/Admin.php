<?php 
namespace App\Filters;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Admin implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        # non logged in filter
        if (session()->get('is_logged_in') == false) {
            return redirect()->to('/');
        }
        # logged in filter
        if (session()->get('role') == true) {
            if ($_SESSION['role'] != 'admin')
                return redirect()->to('https://http.cat/200');
        }
    }
    
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        
    }
}