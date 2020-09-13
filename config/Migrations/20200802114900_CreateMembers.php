<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateMembers extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('members');
		$table
			->addColumn('username', 'string', [
				'default' => null,
				'limit' => 150,
				'null' => false
			])
			->addColumn('password', 'string', [
				'default' => null,
				'limit' => 255,
				'null' => false
			])
			->addColumn('created', 'datetime')
			->addColumn('modified', 'datetime')
			->create();
    }
}
