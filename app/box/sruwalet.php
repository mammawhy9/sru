<?

/**
 * Walet
 */
class UFbox_SruWalet
extends UFbox {

	protected function _getAdminFromGet() {
		$bean = UFra::factory('UFbean_SruWalet_Admin');
		$bean->getByPK((int)$this->_srv->get('req')->get->adminId);

		return $bean;
	}

	protected function _getUserFromGet() {
		$bean = UFra::factory('UFbean_Sru_User');
		$bean->getByPK((int)$this->_srv->get('req')->get->userId);

		return $bean;
	}

	protected function _getDormFromGet() {
		$bean = UFra::factory('UFbean_Sru_Dormitory');
		$bean->getByAlias($this->_srv->get('req')->get->dormAlias);
		return $bean;
	}

	public function login() {
		$bean = UFra::factory('UFbean_SruWalet_Admin');

		$d['admin'] = $bean;

		return $this->render(__FUNCTION__, $d);
	}

	public function logout() {
		try{
			$bean = UFra::factory('UFbean_SruWalet_Admin');
			$bean->getFromSession();

			$d['admin'] = $bean;

			return $this->render(__FUNCTION__, $d);
		} catch (UFex_Dao_NotFound $e) {
			return '';
		}
	}

	public function waletBar() {
		try {
			$bean = UFra::factory('UFbean_SruWalet_Admin');
			$bean->getFromSession();
			$d['admin'] = $bean;


			$sess = $this->_srv->get('session');
			try {
				$d['lastLoginIp'] = $sess->lastLoginIpWalet;
			} catch (UFex_Core_DataNotFound $e) {
				$d['lastLoginIp'] = null;
			}
			try {
				$d['lastLoginAt'] = $sess->lastLoginAtWalet;
			} catch (UFex_Core_DataNotFound $e) {
				$d['lastLoginAt'] = null;
			}

			return $this->render(__FUNCTION__, $d);
		} catch (UFex_Dao_NotFound $e) {
			return '';
		}
	}

	/* Mieszkańcy */

	public function userSearch() {
		$bean = UFra::factory('UFbean_Sru_User');

		$d['user'] = $bean;

		$get = $this->_srv->get('req')->get;
		$tmp = array();
		try {
			$tmp['surname'] = $get->searchedSurname;
		} catch (UFex_Core_DataNotFound $e) {
		}
		try {
			$tmp['registryNo'] = $get->searchedRegistryNo;
		} catch (UFex_Core_DataNotFound $e) {
		}
		$d['searched'] = $tmp;

		return $this->render(__FUNCTION__, $d);
	}

	public function addUserLink() {
		try {
			$get = $this->_srv->get('req')->get;
			$tmp = array();
			try {
				$tmp['surname'] = $get->searchedSurname;
			} catch (UFex_Core_DataNotFound $e) {
			}
			try {
				$tmp['registryNo'] = $get->searchedRegistryNo;
			} catch (UFex_Core_DataNotFound $e) {
			}
			$d['searched'] = $tmp;

			return $this->render(__FUNCTION__, $d);
		} catch (UFex_Dao_NotFound $e) {
			return $this->render('userSearchResultsNotFound');
		}
	}

	public function userSearchResults() {
		try {
			$bean = UFra::factory('UFbean_Sru_UserList');

			$get = $this->_srv->get('req')->get;
			$tmp = array();
			try {
				$tmp['surname'] = $get->searchedSurname;
			} catch (UFex_Core_DataNotFound $e) {
			}
			try {
				$tmp['registryNo'] = $get->searchedRegistryNo;
			} catch (UFex_Core_DataNotFound $e) {
			}
			$bean->search($tmp);
			if (1 == count($bean)) {
				$get->userId = $bean[0]['id'];
				return $this->user();
			}

			$d['users'] = $bean;

			return $this->render(__FUNCTION__, $d);
		} catch (UFex_Dao_NotFound $e) {
			return $this->render(__FUNCTION__.'NotFound');
		}
	}

	public function quickUserSearchResults() {
		try {
			$bean = UFra::factory('UFbean_Sru_UserList');

			$get = $this->_srv->get('req')->get;
			$tmp = array();
			try {
				$tmp['surname'] = $get->searchedSurname.'*';
			} catch (UFex_Core_DataNotFound $e) {
			}
			$bean->quickSearch($tmp);

			$d['users'] = $bean;

			return $this->render(__FUNCTION__, $d);
		} catch (UFex_Dao_NotFound $e) {
			return $this->render('userSearchResultsNotFound');
		}
	}

	public function titleUser() {
		try {
			$bean = $this->_getUserFromGet();

			$d['user'] = $bean;

			return $this->render(__FUNCTION__, $d);
		} catch (UFex_Dao_NotFound $e) {
			return $this->render(__FUNCTION__.'NotFound');
		}
	}

	public function user() {
		try {
			$bean = $this->_getUserFromGet();

			$d['user'] = $bean;

			return $this->render(__FUNCTION__, $d);
		} catch (UFex_Dao_NotFound $e) {
			return $this->render(__FUNCTION__.'NotFound');
		}
	}

	public function userEdit() {
		try {
			$bean = $this->_getUserFromGet();

			$admin = UFra::factory('UFbean_SruWalet_Admin');
			$admin->getFromSession();
			if ($admin->typeId != UFacl_SruWalet_Admin::HEAD) {
				try {
					$dorms = UFra::factory('UFbean_SruWalet_AdminDormitoryList');
					$dorms->listAllById($admin->id);
				} catch (UFex_Dao_NotFound $e) {
					$dorms = null;
				}
			} else {
				$dorms = UFra::factory('UFbean_Sru_DormitoryList');
				$dorms->listAllForWalet();
			}

			$d['user'] = $bean;
			$d['dormitories'] = $dorms;

			return $this->render(__FUNCTION__, $d);
		} catch (UFex_Dao_NotFound $e) {
			return $this->render('computerNotFound');
		}
	}

	public function titleUserEdit() {
		try {
			$bean = $this->_getUserFromGet();

			$d['user'] = $bean;

			return $this->render(__FUNCTION__, $d);
		} catch (UFex_Dao_NotFound $e) {
			return $this->render(__FUNCTION__.'NotFound');
		}
	}

	public function userHistory() {
		try {
			$bean = $this->_getUserFromGet();
			$d['user'] = $bean;
		} catch (UFex_Dao_NotFound $e) {
			return '';
		}

		$history = UFra::factory('UFbean_SruAdmin_UserHistoryList');
		try {
			$history->listByUserId($bean->id);
		} catch (UFex_Dao_NotFound $e) {
		}
		$d['history'] = $history;

		return $this->render(__FUNCTION__, $d);
	}

	public function userAdd() {
		try {
			$faculties = UFra::factory('UFbean_Sru_FacultyList');
			$faculties->listAll();

			$admin = UFra::factory('UFbean_SruWalet_Admin');
			$admin->getFromSession();
			if ($admin->typeId != UFacl_SruWalet_Admin::HEAD) {
				try {
					$dorms = UFra::factory('UFbean_SruWalet_AdminDormitoryList');
					$dorms->listAllById($admin->id);
				} catch (UFex_Dao_NotFound $e) {
					$dorms = null;
				}
			} else {
				$dorms = UFra::factory('UFbean_Sru_DormitoryList');
				$dorms->listAllForWalet();
			}

			$bean = UFra::factory('UFbean_Sru_User');

			$get = $this->_srv->get('req')->get;
			$tmp = array();
			try {
				$d['surname'] = ucwords(strtolower($get->inputSurname));
			} catch (UFex_Core_DataNotFound $e) {
				$d['surname'] = null;
			}
			try {
				$d['registryNo'] = $get->inputRegistryNo;
			} catch (UFex_Core_DataNotFound $e) {
				$d['registryNo'] = null;
			}
	
			$d['user'] = $bean;
			$d['dormitories'] = $dorms;
			$d['faculties'] = $faculties;

			return $this->render(__FUNCTION__, $d);
		} catch (UFex_Dao_NotFound $e) {
			return '';
		}
	}

	public function userPrint() {
		try {
			try {
				$bean = $this->_getUserFromGet();
				$d['user'] = $bean;
			} catch (UFex_Core_DataNotFound $e) {
				return $this->render(__FUNCTION__.'Error');
			}
			try {
				$d['password'] = $this->_srv->get('req')->get->password;
			} catch (UFex_Core_DataNotFound $e) {
				$d['password'] = null;
			}

			$conf = UFra::shared('UFconf_Sru');
			$d['userPrintWaletText'] = $conf->userPrintWaletText;
			$d['userPrintSkosText'] = $conf->userPrintSkosText;

			return $this->render(__FUNCTION__, $d);
		} catch (UFex_Dao_NotFound $e) {
			return '';
		}
	}

	/* Obsadzenie */

	public function inhabitants() {
		try {
			$dorms = UFra::factory('UFbean_Sru_DormitoryList');
			$dorms->listAll();
			$d['dormitories'] = $dorms;

			try {
				$rooms = UFra::factory('UFbean_SruAdmin_RoomList');
				$rooms->listAllOrdered(); 

				$d['rooms'] = $rooms;
			} catch (UFex_Dao_NotFound $e) {
				$d['rooms'] = null;
			}
		
			return $this->render(__FUNCTION__, $d);
		} catch (UFex_Dao_NotFound $e) {
			return $this->render(__FUNCTION__.'NotFound', $d);
		}
	}

	public function titleDorm() {
		try {
			$bean = $this->_getDormFromGet();

			$d['dorm'] = $bean;

			return $this->render(__FUNCTION__, $d);
		} catch (UFex_Dao_NotFound $e) {
			return $this->render(__FUNCTION__.'NotFound');
		}
	}

	public function dorm() {
		try {
			$bean = $this->_getDormFromGet();
			$d['dorm'] = $bean;
			
			try {
				$rooms = UFra::factory('UFbean_SruAdmin_RoomList');
				$rooms->listByDormitoryId($bean->id); 
				
				$d['rooms'] = $rooms;
			} catch (UFex_Dao_NotFound $e) {
				$d['rooms'] = null;
			}

			try {
				$users = UFra::factory('UFbean_Sru_UserList');
				$users->listActiveByDorm($bean->id);
				
				$d['users'] = $users;
			} catch (UFex_Dao_NotFound $e) {
				$d['users'] = null;
			}
		
			return $this->render(__FUNCTION__, $d);
		} catch (UFex_Dao_NotFound $e) {
			return $this->render(__FUNCTION__.'NotFound');
		}
	}

	/* Statystyki */

	public function statsUsers() {
		try {
			$user = UFra::factory('UFbean_Sru_UserList');
			$user->listAllActive();
			$d['users'] = $user;
		
			return $this->render(__FUNCTION__, $d);
		} catch (UFex_Dao_NotFound $e) {
			return $this->render(__FUNCTION__.'NotFound', $d);
		}
	}

	public function statsDormitories() {
		try {
			$user = UFra::factory('UFbean_Sru_UserList');
			$user->listAllActive();
			$d['users'] = $user;
		
			return $this->render(__FUNCTION__, $d);
		} catch (UFex_Dao_NotFound $e) {
			return $this->render(__FUNCTION__.'NotFound', $d);
		}
	}

	/* Admini */

	public function admins() {
		try {
			$bean = UFra::factory('UFbean_SruWalet_AdminList');
			$bean->listAll();
			$d['admins'] = $bean;

			return $this->render(__FUNCTION__, $d);
		} 
		catch (UFex_Dao_NotFound $e) {
			return $this->render('adminsNotFound');
		}
	}

	public function inactiveAdmins() {
		try {
			$bean = UFra::factory('UFbean_SruWalet_AdminList');	
			$bean->listAllInactive();
			$d['admins'] = $bean;

			return $this->render(__FUNCTION__, $d);
		} catch (UFex_Dao_NotFound $e) {
			return $this->render('inactiveAdminsNotFound');
		}
	}

	public function titleAdmin() {
		try {
			$bean = $this->_getAdminFromGet();
			$d['admin'] = $bean;

			return $this->render(__FUNCTION__, $d);
		} catch (UFex_Dao_NotFound $e) {
			return $this->render('titleAdminNotFound');
		}
	}

	public function admin() {
		try {
			$bean = $this->_getAdminFromGet();
			$d['admin'] = $bean;

			try {
				$admDorm = UFra::factory('UFbean_SruWalet_AdminDormitoryList');
				$admDorm->listAllById($bean->id);
				$d['dormList'] = $admDorm;
			} catch (UFex_Dao_NotFound $e) {
				$d['dormList'] = null;
			}
			
			return $this->render(__FUNCTION__, $d);
		} catch (UFex_Dao_NotFound $e) {
			return $this->render(__FUNCTION__.'NotFound');
		}
	}

	public function adminAdd() {
		$dorms = UFra::factory('UFbean_Sru_DormitoryList');
		$dorms->listAll();
		
		$bean = UFra::factory('UFbean_SruWalet_Admin');
		$d['admin'] = $bean;
		$d['dormitories'] = $dorms;


		return $this->render(__FUNCTION__, $d);
	}

	public function titleAdminEdit() {
		try {
			$bean = $this->_getAdminFromGet();
			$d['admin'] = $bean;

			return $this->render(__FUNCTION__, $d);
		} catch (UFex_Dao_NotFound $e) {
			return $this->render('titleAdminNotFound');
		}
	}

	public function adminEdit() {
		try {
			$bean = $this->_getAdminFromGet();
			$dorms = UFra::factory('UFbean_Sru_DormitoryList');
			$dorms->listAll();

			try {
				$admDorm = UFra::factory('UFbean_SruWalet_AdminDormitoryList');
				$admDorm->listAllById($bean->id);
				$d['dormList'] = $admDorm;
			} catch (UFex_Dao_NotFound $e) {
				$d['dormList'] = null;
			}
			
			$bean = $this->_getAdminFromGet();
			$acl  = $this->_srv->get('acl');
	
			$d['admin'] = $bean;
			$d['dormitories'] = $dorms;
			$d['advanced'] = $acl->sruWalet('admin', 'advancedEdit');

			return $this->render(__FUNCTION__, $d);
		} catch (UFex_Dao_NotFound $e) {
			return $this->render('adminNotFound');
		}
	}

	public function adminUsersModified() {
		try{
			$bean = $this->_getAdminFromGet();
			
			$modified = UFra::factory('UFbean_Sru_UserList');
			$modified->listLastModified($bean->id);
			$d['modifiedUsers'] = $modified;
			
			return $this->render(__FUNCTION__, $d);
		}catch(UFex_Dao_NotFound $e){
			return '';
		}	
	}
}
