<?

/**
 * sru
 */
class UFbox_Sru
extends UFbox {

	protected function _getComputerFromGetByCurrentUser() {
		$bean = UFra::factory('UFbean_Sru_Computer');
		$bean->getByUserIdPK((int)$this->_srv->get('session')->auth, (int)$this->_srv->get('req')->get->computerId);

		return $bean;
	}

	public function login() {
		$bean = UFra::factory('UFbean_Sru_User');
		$d['user'] = $bean;

		return $this->render(__FUNCTION__, $d);
	}

	public function userInfo() {
		try 
		{
			$user = UFra::factory('UFbean_Sru_User');
			$user->getFromSession();

			$bean = UFra::factory('UFbean_Sru_PenaltyList');	
			$bean->listByUserId($user->id);
			$d['penalties'] = $bean;

			return $this->render(__FUNCTION__, $d);
		} 
		catch (UFex_Dao_NotFound $e) 
		{
			return $this->render('penaltiesNotFound');
		}
	}

	public function userAdd($admin=false) {
		try{
			$dorms = UFra::factory('UFbean_Sru_DormitoryList');
			$dorms->listAll();
			$faculties = UFra::factory('UFbean_Sru_FacultyList');
			$faculties->listAll();
			$bean = UFra::factory('UFbean_Sru_User');
	
			$d['user'] = $bean;
			$d['dormitories'] = $dorms;
			$d['faculties'] = $faculties;
			$d['admin'] = $admin;

			return $this->render(__FUNCTION__, $d);
		} catch (UFex_Dao_NotFound $e) {
			return '';
		}		
	}

	public function userAddMailTitle($user) {
		$d['user'] = $user;
		return $this->render(__FUNCTION__, $d);
	}

	public function userAddMailBodyToken($user, $password, $token) {
		$d['user'] = $user;
		$d['password'] = $password;
		$d['token'] = $token;
		$d['host'] = $this->_srv->get('req')->server->HTTP_HOST;
		return $this->render(__FUNCTION__, $d);
	}

	public function userAddMailBodyNoToken($user, $password) {
		$d['user'] = $user;
		$d['password'] = $password;
		$d['host'] = $this->_srv->get('req')->server->HTTP_HOST;
		return $this->render(__FUNCTION__, $d);
	}

	public function userAddMailBodyNoInfo($user, $password) {
		$d['user'] = $user;
		$d['password'] = $password;
		$d['host'] = $this->_srv->get('req')->server->HTTP_HOST;
		return $this->render(__FUNCTION__, $d);
	}

	public function userAddMailHeaders($user) {
		$d['user'] = $user;
		return $this->render(__FUNCTION__, $d);
	}

	public function userEdit() {
		try{		
			$bean = UFra::factory('UFbean_Sru_User');
			$bean->getFromSession();
	
			$dorms = UFra::factory('UFbean_Sru_DormitoryList');
			$dorms->listAll();
			$faculties = UFra::factory('UFbean_Sru_FacultyList');
			$faculties->listAll();
	
			$d['user'] = $bean;
			$d['dormitories'] = $dorms;
			$d['faculties'] = $faculties;
	
			return $this->render(__FUNCTION__, $d);
		} catch (UFex_Dao_NotFound $e) {
			return '';
		}			
	}

	public function userComputers() {
		try {
			$user = UFra::factory('UFbean_Sru_User');
			$user->getFromSession();

			$bean = UFra::factory('UFbean_Sru_ComputerList');
			$bean->listByUserId($user->id);

			$d['computers'] = $bean;

			return $this->render(__FUNCTION__, $d);
		} catch (UFex_Dao_NotFound $e) {
			return $this->render(__FUNCTION__.'NotFound');
		}
	}

	public function titleUserComputer() {
		try {
			$bean = $this->_getComputerFromGetByCurrentUser();

			$d['computer'] = $bean;

			return $this->render(__FUNCTION__, $d);
		} catch (UFex_Dao_NotFound $e) {
			return $this->render('titleUserComputerNotFound');
		}
	}

	public function userComputer() {
		try {
			$bean = $this->_getComputerFromGetByCurrentUser();

			$d['computer'] = $bean;

			return $this->render(__FUNCTION__, $d);
		} catch (UFex_Dao_NotFound $e) {
			return $this->render('userComputerNotFound');
		}
	}

	public function userComputerEdit() {
		try {
			$bean = $this->_getComputerFromGetByCurrentUser();

			$d['computer'] = $bean;

			return $this->render(__FUNCTION__, $d);
		} catch (UFex_Dao_NotFound $e) {
			return $this->render('userComputerNotFound');
		}
	}

	public function userComputerAdd() {
		$bean = UFra::factory('UFbean_Sru_Computer');

		$d['computer'] = $bean;
		$d['macAddress'] = $this->getMacAddress();

		return $this->render(__FUNCTION__, $d);
	}

	public function userComputerDel() {
		try {
			$bean = $this->_getComputerFromGetByCurrentUser();

			$d['computer'] = $bean;

			return $this->render(__FUNCTION__, $d);
		} catch (UFex_Dao_NotFound $e) {
			return '';
		}
	}

	public function userBar() {
		try {
			$bean = UFra::factory('UFbean_Sru_User');
			$bean->getFromSession();
			$d['user'] = $bean;

			$sess = $this->_srv->get('session');
			try {
				$d['lastLoginIp'] = $sess->lastLoginIp;
			} catch (UFex_Core_DataNotFound $e) {
				$d['lastLoginIp'] = null;
			}
			try {
				$d['lastLoginAt'] = $sess->lastLoginAt;
			} catch (UFex_Core_DataNotFound $e) {
				$d['lastLoginAt'] = null;
			}

			return $this->render(__FUNCTION__, $d);
		} catch (UFex_Dao_NotFound $e) {
			return '';
		}
	}

	public function userPenalties() {
		try 
		{
			$user = UFra::factory('UFbean_Sru_User');
			$user->getFromSession();

			$bean = UFra::factory('UFbean_Sru_PenaltyList');	
			$bean->listAllByUserId($user->id);
			$d['penalties'] = $bean;

			return $this->render(__FUNCTION__, $d);
		} 
		catch (UFex_Dao_NotFound $e) 
		{
			return $this->render('userPenaltiesNotFound');
		}
	}

	public function userServicesEdit() {
		try {
			$user = UFra::factory('UFbean_Sru_User');
			$user->getFromSession();
			
			try 
			{
				$bean = UFra::factory('UFbean_Sru_UserServiceList');	
				$bean->listAllByUserId($user->id);
				$d['userServices'] = $bean;
			}
			catch (UFex_Dao_NotFound $e) 
			{
				$d['userServices'] = null;
			}

			$bean = UFra::factory('UFbean_Sru_ServiceList');	
			$bean->listAllServices();
			$d['allServices'] = $bean;
			
			return $this->render(__FUNCTION__, $d);
		} 
		catch (UFex_Dao_NotFound $e) 
		{
			return $this->render('userServicesNotFound');
		}
	}

	public function userRecoverPasswordMailBodyToken($user, $token) {
		$d['user'] = $user;
		$d['token'] = $token;
		$d['host'] = $this->_srv->get('req')->server->HTTP_HOST;
		return $this->render(__FUNCTION__, $d);
	}

	public function userRecoverPasswordMailBodyPassword($user, $password) {
		$d['user'] = $user;
		$d['password'] = $password;
		$d['host'] = $this->_srv->get('req')->server->HTTP_HOST;
		return $this->render(__FUNCTION__, $d);
	}

	public function penaltyAddMailTitle($penalty) {
		$d['penalty'] = $penalty;
		return $this->render(__FUNCTION__, $d);
	}
	
	public function penaltyAddMailBody($penalty, $user, $computers) {
		$d['penalty'] = $penalty;
		$d['user'] = $user;
		$d['computers'] = $computers;
		return $this->render(__FUNCTION__, $d);
	}

	public function penaltyEditMailTitle($penalty) {
		$d['penalty'] = $penalty;
		return $this->render(__FUNCTION__, $d);
	}
	
	public function penaltyEditMailBody($penalty, $user) {
		$d['penalty'] = $penalty;
		$d['user'] = $user;
		return $this->render(__FUNCTION__, $d);
	}

	public function dataChangedMailBody($user) {
		$d['user'] = $user;
		return $this->render(__FUNCTION__, $d);
	}

	public function hostChangedMailBody($host, $action) {
		$d['host'] = $host;
		$d['action'] = $action;
		return $this->render(__FUNCTION__, $d);
	}

	private function getMacAddress() {
		$serv = $this->_srv->get('req')->server;
		if($serv->is('HTTP_X_FORWARDED_FOR') && $serv->HTTP_X_FORWARDED_FOR != '' ) {
			$ip = $serv->HTTP_X_FORWARDED_FOR;
		} else {
			$ip =  $serv->REMOTE_ADDR;
		}
		if (strlen($ip) < 9 || substr($ip, 0, 9) != '192.168.0') {
			return null;
		}
		$mac = `arp -an | grep "($ip)" | cut -f 4 -d " "`;

		return trim($mac);
	}
}
