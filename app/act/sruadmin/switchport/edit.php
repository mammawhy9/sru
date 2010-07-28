<?php
/**
 * edycja portu switcha
 */
class UFact_SruAdmin_SwitchPort_Edit
extends UFact {

	const PREFIX = 'switchPortEdit';
	const MAX_PORT_NAME = 64;

	public function go() {
		try {
			$this->begin();
			$post = $this->_srv->get('req')->post->{self::PREFIX};

			$bean = UFra::factory('UFbean_SruAdmin_SwitchPort');
			$bean->getByPK((int)$this->_srv->get('req')->get->portId);
			$switch = UFra::factory('UFbean_SruAdmin_Switch');
			$switch->getByPK($bean->switchId);

			$bean->fillFromPost(self::PREFIX);

			if ($post['locationAlias'] != '' && $bean->connectedSwitchId != '') {
				throw UFra::factory('UFex_Dao_DataNotValid', 'Location and connected switch set in one time', 0, E_WARNING, array('locationAlias' => 'roomAndSwitch'));
			}
			if ($bean->connectedSwitchId != '' && $bean->admin == true) {
				throw UFra::factory('UFex_Dao_DataNotValid', 'Connected switch and admin set in one time', 0, E_WARNING, array('connectedSwitchId' => 'switchAndAdmin'));
			}
			if ($post['locationAlias'] != '') {
				try {
					$dorm = UFra::factory('UFbean_Sru_Dormitory');
					$dorm->getByPK($switch->dormitoryId);
				} catch (UFex $e) {
					throw UFra::factory('UFex_Dao_DataNotValid', 'Data dormitory error', 0, E_WARNING, array('locationAlias' => 'noDormitory'));
				}
				try {
					$loc = UFra::factory('UFbean_Sru_Location');
					$loc->getByAliasDormitory($post['locationAlias'], $dorm->id);
					$bean->locationId = $loc->id;
				} catch (UFex $e) {
					throw UFra::factory('UFex_Dao_DataNotValid', 'Data room error', 0, E_WARNING, array('locationAlias' => 'noRoom'));
				}
			} else {
				$bean->locationId = NULL;
			}

			if (!$post['copyToSwitch'] && isset($post['portStatus']) && $post['portStatus'] != $post['portEnabled']) {
				throw UFra::factory('UFex_Dao_DataNotValid', 'Changing port status without writing to switch', 0, E_WARNING, array('switch' => 'noWriting'));
			}

			if ($post['copyToSwitch'] && !is_null($switch->ip)) {
				$hp = UFra::factory('UFlib_Snmp_Hp', $switch->ip);
				$result = false;
				if ($post['locationAlias'] != '') {
					if ($post['comment'] != '') {
						$name = $post['locationAlias'] . ': ' . $hp->removeSpecialChars($post['comment']);
						$name = substr($name, 0, self::MAX_PORT_NAME);
						$result = $hp->setPortAlias($bean->ordinalNo, $name);
					} else {
						$result = $hp->setPortAlias($bean->ordinalNo, $post['locationAlias']);
					}
				} else if ($post['connectedSwitchId'] != '') {
					$connectedSwitch = UFra::factory('UFbean_SruAdmin_Switch');
					$connectedSwitch->getByPK($post['connectedSwitchId']);
					if ($post['comment'] != '') {
						$name = $connectedSwitch->dormitoryAlias.'-hp'.$connectedSwitch->hierarchyNo . ': ' . $hp->removeSpecialChars($post['comment']);
						$name = substr($name, 0, self::MAX_PORT_NAME);
						$result = $hp->setPortAlias($bean->ordinalNo, $name);
					} else {
						$result = $hp->setPortAlias($bean->ordinalNo, $connectedSwitch->dormitoryAlias.'-hp'.$connectedSwitch->hierarchyNo);
					}
				} else if ($post['comment'] != '') {
					$result = $hp->setPortAlias($bean->ordinalNo, $hp->removeSpecialChars($post['comment']));
				} else {
					$result = $hp->setPortAlias($bean->ordinalNo, '');
				}
				if (!$result) {
					throw UFra::factory('UFex_Dao_DataNotValid', 'Writing to switch error', 0, E_WARNING, array('switch' => 'writingError'));
				}
				if ($post['portEnabled']) {
					$status = UFlib_Snmp_Hp::ENABLED;
				} else {
					$status = UFlib_Snmp_Hp::DISABLED;
				}
				$result = $hp->setPortStatus($bean->ordinalNo, $status);
				if (!$result) {
					throw UFra::factory('UFex_Dao_DataNotValid', 'Writing to switch error', 0, E_WARNING, array('switch' => 'writingError'));
				}
			}

			$bean->save();

 			$this->markOk(self::PREFIX);
 			$this->postDel(self::PREFIX);
 			$this->commit();
		} catch (UFex_Dao_DataNotValid $e) {
			$this->rollback();
			$this->markErrors(self::PREFIX, $e->getData());
		} catch (UFex $e) {
			$this->rollback();
			UFra::error($e);
		}
	}
}
