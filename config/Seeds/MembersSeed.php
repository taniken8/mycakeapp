<?php
declare(strict_types=1);

use Migrations\AbstractSeed;
use Authentication\PasswordHasher\DefaultPasswordHasher;

/**
 * Members seed.
 */
class MembersSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {
		$data = [
			[
				'username' => 'admin',
				'password' => $this->_setPassword('admin'),
				'created' => '2020-08-01 10:00:00',
				'modified' => '2020-08-01 10:00:00'
			],[
				'username' => 'yamada',
				'password' => $this->_setPassword('yamada'),
				'created' => '2020-08-01 10:00:00',
				'modified' => '2020-08-01 10:00:00'
			]
		];

        $table = $this->table('members');
        $table->insert($data)->save();
	}
	protected function _setPassword(string $password) : ?string
    {
        if (strlen($password) > 0) {
            return (new DefaultPasswordHasher())->hash($password);
        }
    }
}
