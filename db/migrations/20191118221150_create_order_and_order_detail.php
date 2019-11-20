<?php

use Phinx\Migration\AbstractMigration;

class CreateOrderAndOrderDetail extends AbstractMigration
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
        $order = $this->table('dat_sales', ['id' => false, 'primary_key' => 'id']);
        $order->addColumn('id', 'biginteger', ['identity' => true, 'signed' => false])
            ->addColumn('date', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'comment' => '注文日'])
            ->addColumn('code_member', 'integer')
            ->addColumn('name', 'string', ['limit' => 15])
            ->addColumn('email', 'string', ['limit' => 50])
            ->addColumn('postal1', 'string', ['limit' => 3])
            ->addColumn('postal2', 'string', ['limit' => 4])
            ->addColumn('address', 'string', ['limit' => 50])
            ->addColumn('tell', 'string', ['limit' => 13])
            ->create();

        $detail = $this->table('dat_sales_product', ['id' => false, 'primary_key' => 'id']);
        $detail->addColumn('id', 'biginteger', ['identity' => true, 'signed' => false])
            ->addColumn('sales_id', 'integer')
            ->addColumn('product_id', 'integer')
            ->addColumn('price', 'integer')
            ->addColumn('quantity', 'integer')
            ->create();
    }
}
