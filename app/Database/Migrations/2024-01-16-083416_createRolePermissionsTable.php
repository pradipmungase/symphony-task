<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRolePermissionsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'role_permission_id' => ['type' => 'INT', 'constraint' => 5, 'unsigned' => true, 'auto_increment' => true],
            'permission_id' => ['type' => 'VARCHAR', 'constraint' => 100],
            'role_id' => ['type' => 'VARCHAR', 'constraint' => 100],
        ]);
        $this->forge->addKey('role_permission_id', true);
        $this->forge->createTable('role_permissions');
        $this->forge->addForeignKey('permission_id', 'permissions', 'permission_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('role_id', 'roles', 'role_id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->forge->dropTable('role_permissions');
    }
}
