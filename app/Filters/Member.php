<?php 
namespace App\Filters;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Member implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        # not logged in filter
        if (session()->get('is_logged_in') == false) {
            return redirect()->to('/');
        }
        # logged in filter
        // if (session()->get('is_logged_in') == true) {
        //     if ($_SESSION['role'] == 'admin')
        //         return redirect()->to('/attendance/admin/index');
        // }
    }
    
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        
    }
}