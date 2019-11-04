<?php

use Phinx\Migration\AbstractMigration;

class CreateProductTable extends AbstractMigration
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
        $table = $this->table('mst_product', ['id' => false, 'primary_key' => 'id']);
        $table->addColumn('id', 'biginteger', ['identity' => true, 'signed' => false])
            ->addColumn('name', 'string', ['limit' => 30])
            ->addColumn('price', 'integer')
            ->addColumn('gazou', 'string', ['limit' => 30])
            ->create();
//$ mysql> show columns from mst_product;
//+-------+---------------------+------+-----+---------+----------------+
//| Field | Type                | Null | Key | Default | Extra          |
//+-------+---------------------+------+-----+---------+----------------+
//| id    | bigint(20) unsigned | NO   | PRI | NULL    | auto_increment |
//| name  | varchar(30)         | NO   |     | NULL    |                |
//| price | int(11)             | NO   |     | NULL    |                |
//| gazou | varchar(30)         | NO   |     | NULL    |                |
//+-------+---------------------+------+-----+---------+----------------+
//4 rows in set (0.01 sec)
    }
}
