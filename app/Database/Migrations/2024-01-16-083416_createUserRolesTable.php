<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUserRolesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'user_role_id' => ['type' => 'INT', 'constraint' => 5, 'unsigned' => true, 'auto_increment' => true],
            'user_id' => ['type' => 'VARCHAR', 'constraint' => 100],
            'role_id' => ['type' => 'VARCHAR', 'constraint' => 100],
        ]);
        $this->forge->addKey('user_role_id', true);
        $this->forge->createTable('user_roles');
        $this->forge->addForeignKey('user_id', 'users', 'user_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('role_id', 'roles', 'role_id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->forge->dropTable('user_roles');
    }
}
