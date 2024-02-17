<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddnewfieldToStudentsTable extends Migration
{
    public function up()
    {
         ## Add age column
         $addfields = [
            'phone' => [
                  'type' => 'INT',
                  'constraint' => '13',
            ],
       ];
       $this->forge->addColumn('students', $addfields);
    }

    public function down()
    {
        //
    }
}
