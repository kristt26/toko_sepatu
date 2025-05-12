<?php
namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Auth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        // Ambil role user dari session
        $userRoleString = $session->get('role'); // contoh: "admin,editor"

        if (!$userRoleString) {
            return redirect()->to('/auth');
        }

        // Ubah jadi array
        $userRoles = explode(',', $userRoleString);
        $userRoles = array_map('trim', $userRoles); // hapus spasi

        // Role yang diperbolehkan dari $arguments
        $allowedRoles = $arguments; // contoh: ['admin', 'editor']

        // Cek apakah ada peran yang cocok
        $hasAccess = false;
        foreach ($allowedRoles as $role) {
            if (in_array($role, $userRoles)) {
                $hasAccess = true;
                break;
            }
        }

        if (!$hasAccess) {
            return redirect()->to('/no-access');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak perlu
    }
}
