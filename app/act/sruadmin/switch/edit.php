<?php
/**
 * edycja administratora
 */
class UFact_SruAdmin_Switch_Edit
extends UFact {

	const PREFIX = 'switchEdit';

	public function go() {
		try {
			$this->begin();
			$bean = UFra::factory('UFbean_SruAdmin_Switch');
			$bean->getByPK((int)$this->_srv->get('req')->get->switchId);
			$modelId = $bean->modelId;
			$bean->fillFromPost(self::PREFIX);
			$post = $this->_srv->get('req')->post->{self::PREFIX};

			if (!is_null($bean->hierarchyNo)) {
				$switch = UFra::factory('UFdao_SruAdmin_Switch');
				$exists = $switch->getByHierarchyNoAndDorm($bean->hierarchyNo, $bean->dormitoryId);
				if (!is_null($exists) && $exists['id'] != $bean->id) {
					throw UFra::factory('UFex_Dao_DataNotValid', 'Data hierarchyNo dupliacted in dormitory', 0, E_WARNING, array('hierarchyNo' => 'duplicated'));
				}
			}
			if ($modelId != $bean->modelId && (!array_key_exists('ignoreModelChange', $post) || 0 == $post['ignoreModelChange'])) {
				throw UFra::factory('UFex_Dao_DataNotValid', 'Change of switch model', 0, E_WARNING,  array('model' => 'change'));
			}
			$bean->save();

			if ($modelId != $bean->modelId) {
				try {
					$portlist = UFra::factory('UFbean_SruAdmin_SwitchPortList');
					$portlist->listBySwitchId($bean->id);
					foreach ($portlist as $swport) {
						$port = UFra::factory('UFbean_SruAdmin_SwitchPort');
						$port->getByPK($swport['id']);
						$port->del();
					}
				} catch (UFex_Dao_NotFound $ex) {
				}
				$model = UFra::factory('UFbean_SruAdmin_SwitchModel');
				$model->getByPK($bean->modelId);
				for ($i = 1; $i < $model->ports + 1; $i++) {
					$port = UFra::factory('UFbean_SruAdmin_SwitchPort');
					$port->switchId = $bean->id;
					$port->ordinalNo = $i;
					$port->save();
				}
			}

			$this->postDel(self::PREFIX);
			$this->markOk(self::PREFIX);
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