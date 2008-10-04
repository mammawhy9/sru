<?php

/**
 * dodanie cudzego komputera
 */
class UFact_SruAdmin_Computer_Add
extends UFact {

	const PREFIX = 'computerAdd';

	public function go() {
		try {
			$user = UFra::factory('UFbean_Sru_User');
			$user->getByPK((int)$this->_srv->get('req')->get->userId);

			try {
				$ip = UFra::factory('UFbean_Sru_Ipv4');
				$ip->getFreeByDormitoryId($user->dormitoryId);
			} catch (UFex_Dao_NotFound $e) {
				$this->markErrors(self::PREFIX, array('ip'=>'noFree'));
				return;
			}

			$bean = UFra::factory('UFbean_Sru_Computer');
			$post = $this->_srv->get('req')->post->{self::PREFIX};

			$foundOld = false;

			try {
				$bean->getInactiveByMacUserId($post['mac'], $user->id);
				$bean->active = true;
				$foundOld = true;
			} catch (UFex $e) {
				try {
					$bean->getInactiveByHostUserId($post['host'], $user->id);
					$bean->active = true;
					$foundOld = true;
				} catch (UFex $e) {
				}
			}
			// walidator locationId musi miec dane o akademiku
			$bean->fillFromPost(self::PREFIX, null, array('mac', 'host'));
			if ($foundOld) {
				if ($bean->locationId != $user->locationId) {
					$this->_srv->get('req')->post->computerEdit = $this->_srv->get('req')->post->{self::PREFIX};	// walidator oczekuje computerEdit przy zmianie pokoju
					$bean->locationId = $user->locationAlias;
					$this->_srv->get('req')->post->del('computerEdit');
				}
			} else {
				$bean->locationId = $user->locationId;
			}
			$bean->modifiedById = null;
			$bean->modifiedAt = NOW;
			$bean->userId = $user->id;
			$bean->ip = $ip->ip;
			$conf = UFra::shared('UFconf_Sru');
			$bean->availableTo = $conf->computerAvailableTo;
			$bean->availableMaxTo = $conf->computerAvailableMaxTo;
			$bean->save();

			$this->postDel(self::PREFIX);
			$this->markOk(self::PREFIX);
		} catch (UFex_Dao_DataNotValid $e) {
			$this->markErrors(self::PREFIX, $e->getData());
		} catch (UFex_Db_QueryFailed $e) {
			if (0 == $e->getCode()) {
				$this->markErrors(self::PREFIX, array('mac'=>'regexp'));
			} else {
				throw $e;
			}
		}
	}
}