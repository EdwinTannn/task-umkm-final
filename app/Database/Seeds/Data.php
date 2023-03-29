<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Data extends Seeder
{
    public function run()
    {
        $password1 = '$2y$10$c.y9N4rNAwuaaGeVhjuil.mecp/EztG8Ho8UuHYlv.TGH8OSVqv3S'; // pass : 1234
		### users
		$this->db->query("INSERT INTO `users` (`id`, `email`, `role`, `password`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES (1, 'madmin@nakama.id', 'admin', '$password1', 1, '2023-02-01 01:24:57', NULL, NULL);");
    }
}
