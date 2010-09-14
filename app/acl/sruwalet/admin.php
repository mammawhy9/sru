<?
/**
 * sprawdzanie uprawnien administratora Waleta
 */
class UFacl_SruWalet_Admin
extends UFlib_ClassWithService {
	
	const 	DORM = 11,
		HEAD = 12;
	
	protected function _loggedIn() {
		return $this->_srv->get('session')->is('authWaletAdmin');
	}
	
	public function login() {
		return !$this->_loggedIn();
	}

	//tylko kierownictwo moze zarzadzac administratorami Waleta
	public function add() {
		$sess = $this->_srv->get('session');
		
		if($this->_loggedIn() && $sess->is('typeIdWalet') && $sess->typeIdWalet == self::HEAD ) {
			return true;
		}
		return false;
	}

	public function edit($id) {

		$sess = $this->_srv->get('session');
		
		if($this->_loggedIn() && $id == $sess->authWaletAdmin) { //swoje konto kazdy moze edytowac
			return true;	
		}
		if($this->_loggedIn() && $sess->is('typeIdWalet') && $sess->typeIdWalet == self::HEAD) {
			return true;
		}
		return false;
	}

	public function advancedEdit() {//do zmiany uprawnien i aktywnosci

		$sess = $this->_srv->get('session');
		
		if($this->_loggedIn() && $sess->is('typeIdWalet') && $sess->typeIdWalet == self::HEAD) {
			return true;
		}
		return false;
	}

	public function logout() {
		return $this->_loggedIn();
	}
}