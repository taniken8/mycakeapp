<?php
namespace App\Controller;

use App\Controller\AppController;

use Cake\Auth\DefaultPasswordHasher;
use Cake\Event\EventInterface;

class AuctionBaseController extends AppController {

	//初期化処理
	public function initialize():void
	{
		parent::initialize();
		//必要なコンポーネントのロード
		$this->loadComponent('RequestHandler');
		$this->loadComponent('Flash');
		$this->loadComponent('Auth', [
			'authorize' => ['Controller'],
			'authenticate' => [
				'Form' => [
					'fields' => [
						'username' => 'username',
						'password' => 'password'
					]
				]
			],
			'loginRedirect' => [
				'controller' => 'Auction',
				'action' => 'index'
			],
			'logoutRedirect' => [
				'controller' => 'Users',
				'action' => 'login',
			],
			'authError' => 'ログインしてください。',
		]);
	}

	//ログイン処理
	function login() {
		//POST時の処理
		if ($this->request->isPost()) {
			$user = $this->Auth->identify();
			//Authのidentifyをユーザーに設定
			if (!empty($user)) {
				$this->Auth->setUser($user);
				return $this->redirect($this->Auth->redirect());
			}
			$this->Flash->error('ユーザー名かパスワードが間違っています。');
		}
	}

	//ログアウト処理
	public function logout()
	{
		//セッションを破棄
		return $this->redirect($this->Auth->logout());
	}

	//認証をしないページの設定
	public function beforeFilter(EventInterface $event)
	{
		parent::beforeFilter($event);
		$this->Auth->allow([]);
	}

	//認証時のロールの処理
	public function isAuthorized($user = null) {
		//管理者はtrue
		if ($user['role'] === admin) {
			return true;
		}
		//一般ユーザーはAuctionControllerのみtrue、他はfalse
		if ($user['role'] === user) {
			if ($this->name == 'Auction') {
				return true;
			} else {
				return false;
			}
		}
		//その他はすべてfalse
		return false;
	}

}