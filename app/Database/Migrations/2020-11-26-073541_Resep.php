<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Resep extends Migration
{
	private $table = 'resep';
	public function up()
	{
		$this->forge->addField([
			'id_resep'          => [
				'type'           => 'INT',
				'unsigned'		 => true,
				'null'           => false,
                'auto_increment' => true
			],
			'id_user'          => [
				'type'           	 => 'INT',
				'unsigned'		 => true,
			],
			'judul'       => [
					'type'           => 'VARCHAR',
					'constraint'     => '50',
					'default'		 => 'judul_resep',
			],
			'porsi' => [
					'type'           => 'VARCHAR',
					'constraint'     => '20',	
					'default'		 => '1 Orang'
			],
			'lama_memasak' => [
				'type'           => 'VARCHAR',
				'constraint'     => '20',
				'default'		 => '30 Menit'
			],
			'bahan' => [
				'type'           => 'TEXT'
			],
			'tutorial' => [
				'type'           => 'TEXT'
			],
			'gambar_banner' => [
				'type'           => 'TEXT',
				'default'		=> 'img/default.jpg'
			],
			'gambar_tutorial' => [
				'type'           => 'TEXT',
				'null'           => true,
			],
			'created_resep' => [
				'type'           => 'DATETIME',
				'null'           => true
			],
			'updated_resep' => [
				'type'           => 'DATETIME',
				'null'           => true
			]

	]);
	$this->forge->addKey('id_resep', true);
	$this->forge->addForeignKey('id_user','User','id_user','CASCADE','CASCADE');
	$this->forge->createTable($this->table);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable($this->table);
	}
}
