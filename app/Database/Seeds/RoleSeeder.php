<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'role_name' => 'Admin',
            ],
            [
                'role_name' => 'User',
            ],
        ];
        //insert data
        $this->db->table('roles')->insertBatch($data);

        $data = [
            [
                'permission_name' => 'Add',
            ],
            [
                'permission_name' => 'Edit',
            ],
            [
                'permission_name' => 'Delete',
            ],
            [
                'permission_name' => 'View',
            ],
        ];
        //insert data
        $this->db->table('permissions')->insertBatch($data);



        $data = [
            [
                'permission_id' => 1,
                'role_id' => 1,
            ],
            [
                'permission_id' => 2,
                'role_id' => 1,
            ],
            [
                'permission_id' => 3,
                'role_id' => 1,
            ],
            [
                'permission_id' => 4,
                'role_id' => 1,
            ],
            [
                'permission_id' => 4,
                'role_id' => 2,
            ],
 
        ];
        //insert data
        $this->db->table('role_permissions')->insertBatch($data);
    }
}
