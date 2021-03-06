<?php

use Phinx\Migration\AbstractMigration;

class CreateStaffTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    addCustomColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Any other destructive changes will result in an error when trying to
     * rollback the migration.
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        // create the table
        // How to change id from integer to biginteger: https://github.com/cakephp/phinx/issues/519
        $table = $this->table('mst_staff', ['id' => false, 'primary_key' => 'id']);
        $table->addColumn('id', 'biginteger', ['identity' => true, 'signed' => false])
            ->addColumn('name', 'string', ['limit' => 15])
            ->addColumn('password', 'string', ['limit' => 32])
            ->create();
//mysql> show columns from mst_staff;
//+----------+---------------------+------+-----+---------+----------------+
//| Field    | Type                | Null | Key | Default | Extra          |
//+----------+---------------------+------+-----+---------+----------------+
//| id       | bigint(20) unsigned | NO   | PRI | NULL    | auto_increment |
//| name     | varchar(15)         | NO   |     | NULL    |                |
//| password | varchar(32)         | NO   |     | NULL    |                |
//+----------+---------------------+------+-----+---------+----------------+
//3 rows in set (0.00 sec)

    }
}
