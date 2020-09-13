<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * Posts seed.
 */
class PostsSeed extends AbstractSeed
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
				'title' => '最初の投稿',
				'description' => "<script>alert('Javascriptの実行');</script>\n最初の投稿の概要\n改行文章",
				'body' => '最初の投稿の内容',
				'published' => 1,
				'created' => '2020-08-01 10:00:00',
				'modified' => '2020-08-01 10:00:00'
			],[
				'title' => '２番目の投稿',
				'description' => '２番目の投稿の概要',
				'body' => '２番目の投稿の内容',
				'published' => 1,
				'created' => '2020-08-01 10:00:00',
				'modified' => '2020-08-01 10:00:00'
			],[
				'title' => '非表示の投稿タイトル',
				'description' => '非表示の投稿の概要',
				'body' => '非表示の投稿の内容',
				'published' => 1,
				'created' => '2020-08-01 10:00:00',
				'modified' => '2020-08-01 10:00:00'
			],[
				'title' => 'テストタイトル',
				'description' => 'テストタイトル投稿の概要',
				'body' => 'テストタイトル投稿の内容',
				'published' => 1,
				'created' => '2020-08-01 10:00:00',
				'modified' => '2020-08-01 10:00:00'
			],[
				'title' => '５番目の投稿',
				'description' => '５番目の投稿の概要',
				'body' => '５番目の投稿の内容',
				'published' => 1,
				'created' => '2020-08-01 10:00:00',
				'modified' => '2020-08-01 10:00:00'
			]
		];

        $table = $this->table('posts');
        $table->insert($data)->save();
    }
}
