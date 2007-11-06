<?
/**
 * front controller czesci administracyjnej sru
 */
class UFctl_SruAdmin_Front
extends UFctl {

	protected function parseParameters() {
		$req = $this->_srv->get('req');
		$get = $req->get;
		$acl = $this->_srv->get('acl');
		
		$segCount = $req->segmentsCount();
		if (0 == $segCount) {
			$get->view = 'main';
		} else {
			switch ($req->segment(1)) {
				case 'users':
					$ctl = UFra::factory('UFctl_SruAdmin_Users');
					$ctl->go();
					return false;
				case 'computers':
					$ctl = UFra::factory('UFctl_SruAdmin_Computers');
					$ctl->go();
					return false;
				default:
					$get->view = 'error404';
					break;
			}
		}
	}

	protected function chooseAction($action = null) {
		$req = $this->_srv->get('req');
		$get = $req->get;
		$post = $req->post;
		$acl = $this->_srv->get('acl');

		if ($post->is('adminLogout') && $acl->sruAdmin('admin', 'logout')) {
			$act = 'Admin_Logout';
		} elseif ($post->is('adminLogin') && $acl->sruAdmin('admin', 'login')) {
			$act = 'Admin_Login';
		}

		if (isset($act)) {
			$action = 'SruAdmin_'.$act;
		}

		return $action;
	}

	protected function chooseView($view = null) {
		$req = $this->_srv->get('req');
		$get = $req->get;
		$post= $req->post;
		$msg = $this->_srv->get('msg');
		$acl = $this->_srv->get('acl');

		switch ($get->view) {
			case 'main':
				if ($acl->sruAdmin('admin', 'logout')) {
					return 'SruAdmin_Main';
				} else {
					return 'SruAdmin_Login';
				}
			default:
				return 'Sru_Error404';
		}
	}
}
