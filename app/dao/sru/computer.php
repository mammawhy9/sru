<?
/**
 * komputer
 */
class UFdao_Sru_Computer
extends UFdao {

	public function edit(array $data, array $dataAll=array()) {
		$return = parent::edit($data, $dataAll);
		$this->cacheDel($this->cachePrefix.'/getByUserIdPK/'.$dataAll['userId'].'/'.$dataAll['id']);
		$this->cacheDel($this->cachePrefix.'/listAllByUserId/'.$dataAll['userId']);
		$this->cacheDel($this->cachePrefix.'/getByHost/'.$dataAll['host']);
		return $return;
	}

	public function getByHost($host) {
		$mapping = $this->mapping('get');

		$query = $this->prepareSelect($mapping);
		$query->where($mapping->host, $host);
		$query->where($mapping->active, true);

		return $this->doSelectFirst($query);
	}

	public function getByMac($mac) {
		$mapping = $this->mapping('get');

		$query = $this->prepareSelect($mapping);
		$query->where($mapping->mac, $mac);
		$query->where($mapping->active, true);

		return $this->doSelectFirst($query);
	}

	public function listByUserId($id) {
		$mapping = $this->mapping('list');

		$query = $this->prepareSelect($mapping);
		$query->where($mapping->userId, $id);
		$query->where($mapping->active, true);
		$query->order($mapping->host, $query->ASC);

		return $this->doSelect($query);
	}

	public function listByUserIdAll($id) {
		$mapping = $this->mapping('list');

		$query = $this->prepareSelect($mapping);
		$query->where($mapping->userId, $id);
		$query->order($mapping->active, $query->DESC);
		$query->order($mapping->host, $query->ASC);

		return $this->doSelect($query);
	}

	public function getByMacUserId($mac, $user) {
		$key = $this->cachePrefix.'/'.__FUNCTION__.'/'.$mac.'/'.$user;
		try {
			return $this->cacheGet($key);
		} catch (UFex_Core_DataNotFound $e) {
			$mapping = $this->mapping('get');

			$query = $this->prepareSelect($mapping);
			$query->where($mapping->mac, $mac);
			$query->where($mapping->userId, $user);

			$return = $this->doSelectFirst($query);
			$this->cacheSet($key, $return);
			return $return;
		}
	}

	public function getByHostUserId($host, $user) {
		$key = $this->cachePrefix.'/'.__FUNCTION__.'/'.$host.'/'.$user;
		try {
			return $this->cacheGet($key);
		} catch (UFex_Core_DataNotFound $e) {
			$mapping = $this->mapping('get');

			$query = $this->prepareSelect($mapping);
			$query->where($mapping->host, $host);
			$query->where($mapping->userId, $user);

			$return = $this->doSelectFirst($query);
			$this->cacheSet($key, $return);
			return $return;
		}
	}

	public function getByUserIdPK($user, $pk) {
		$key = $this->cachePrefix.'/'.__FUNCTION__.'/'.$user.'/'.$pk;
		try {
			return $this->cacheGet($key);
		} catch (UFex_Core_DataNotFound $e) {
			$mapping = $this->mapping('get');

			$query = $this->prepareSelect($mapping);
			$query->where($mapping->pkName(), $pk);
			$query->where($mapping->userId, $user);

			$return = $this->doSelectFirst($query);
			$this->cacheSet($key, $return);
			return $return;
		}
	}

	public function listAllActive() {
		$mapping = $this->mapping('list');

		$query = $this->prepareSelect($mapping);
		$query->where($mapping->active, true);
		$query->order($mapping->host, $query->ASC);

		return $this->doSelect($query);
	}

	public function search($params) {
		$key = $this->cachePrefix.'/'.__FUNCTION__.'/'.print_r($params, true);
		try {
			return $this->cacheGet($key);
		} catch (UFex_Core_DataNotFound $e) {
			$mapping = $this->mapping('list');

			$query = $this->prepareSelect($mapping);
			$query->order($mapping->active, $query->DESC);
			$query->order($mapping->host, $query->ASC);
			foreach ($params as $var=>$val) {
				switch ($var) {
					case 'host':
						$val = str_replace('%', '', $val);
						$val = str_replace('*', '%', $val);
						$query->where($var, $val, UFlib_Db_Query::LIKE);
						break;
					default:
						$query->where($var, $val);
				}
			}

			$return = $this->doSelect($query);
			$this->cacheSet($key, $return);
			return $return;
		}
	}

	public function updateLocationByUserId($location, $user) {
		$mapping = $this->mapping('set');

		$query = UFra::factory('UFlib_Db_Query');
		$query->tables($mapping->tables());
		$query->joins($mapping->joins(), $mapping->joinOns());
		$data = array(
			$mapping->locationId => $location,
		);
		$query->values($mapping->columns(), $data,  $mapping->columnTypes());
		$query->where($mapping->userId, $user);
		$query->where($mapping->active, true);

		$return = $this->doUpdate($query);
		return $return;
	}
}
