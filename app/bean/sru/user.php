<?
/**
 * uzytkownik
 */
class UFbean_Sru_User
extends UFbeanSingle {

	protected $_locationId = null;
	protected $_password = null;

	protected $notifyAbout = array(
		'login',
		'name',
		'surname',
		'email',
		'gg',
		'facultyId',
		'studyYearId',
		'locationId',
	);

	/**
	 * zaszyfrowane haslo
	 * 
	 * @param string $login - login
	 * @param string $password - haslo
	 * @return string
	 */
	static function generatePassword($login, $password) {
		return md5($login.$password);
	}

	protected function normalizeName($val, $change) {
		return trim($val);
	}

	protected function normalizeSurname($val, $change) {
		return trim($val);
	}

	protected function validateLogin($val, $change) {
		try {
			$bean = UFra::factory('UFbean_Sru_User');
			$bean->getByLogin($val);
			if ($change && $this->data['id'] == $bean->id) {
				return;
			}
			return 'duplicated';
		} catch (UFex_Dao_NotFound $e) {
		}
	}

	protected function normalizeFacultyId($val, $change) {
		if ('0' === $val) {
			return null;
		} else {
			return (int)$val;
		}
	}

	protected function normalizeStudyYearId($val, $change) {
		if ('-' === $val) {
			return null;
		} else {
			return (int)$val;
		}
	}

	protected function validateLocationAlias($val, $change) {
		$post = $this->_srv->get('req')->post->{$change?'userEdit':'userAdd'};
		try {
			$dorm = UFra::factory('UFbean_Sru_Dormitory');
			$dorm->getByPK((int)$post['dormitory']);
		} catch (UFex $e) {
			return 'noDormitory';
		}
		try {
			$loc = UFra::factory('UFbean_Sru_Location');
			$loc->getByAliasDormitory((string)$val, $dorm->id);
			$this->data['locationAlias'] = $val;
			$this->dataChanged['locationAlias'] = $val;
			if (!$change || (isset($this->data['locationId']) && $this->data['locationId']!=$loc->id)) {
				$this->data['locationId'] = $loc->id;
				$this->dataChanged['locationId'] = $loc->id;
			}
		} catch (UFex $e) {
			return 'noRoom';
		}
	}

	protected function validateRegistryNo($val, $change) {
		if (is_null($val) || $val == '') {
			return;
		}
		try {
			$bean = UFra::factory('UFbean_Sru_User');
			$bean->getByRegistryNo($val);
			if ($change && $this->data['id'] == $bean->id) {
				return;
			}
			return 'duplicated';
		} catch (UFex_Dao_NotFound $e) {
		}
	}

	public function notifyByEmail() {
		// nie mozna tego zrobic w jednej linii, bo php rzuca bledem "Can't use
		// function return value in write context"
		$ans = array_intersect(array_keys($this->dataChanged), $this->notifyAbout);
		return !empty($ans);
	}
}
