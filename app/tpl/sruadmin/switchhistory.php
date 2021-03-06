<?

/**
 * szablon beana historii switcha
 */
class UFtpl_SruAdmin_SwitchHistory extends UFtpl_Common {

	static protected $names = array(
	    'hierarchyNo' => 'Nr w hierarchii',
	    'model' => 'Model',
	    'locationId' => 'Miejsce',
	    'ip' => 'IP',
	    'comment' => 'Komentarz',
	    'inoperational' => 'Uszkodzony',
	);

	protected function _diff(array $old, array $new) {
		$changes = array();
		$arr = ' &rarr; ';
		$names = self::$names;
		foreach ($old as $key => $val) {
			if (!array_key_exists($key, $new) || $val === $new[$key]) {
				continue;
			}
			switch ($key) {
				case 'hierarchyNo':
				case 'model':
				case 'ip':
					$changes[] = $names[$key] . ': ' . $val . $arr . $new[$key];
					break;
				case 'locationId':
					$changes[] = $names[$key] . ': ' . $old['locationAlias'] . '<small>&nbsp;(' . $old['dormitoryAlias'] . ')</small>' . $arr . $new['locationAlias'] . '<small>&nbsp;(' . $new['dormitoryAlias'] . ')</small>';
					break;
				case 'inoperational':
					$changes[] = $names[$key] . ': ' . ($val ? 'tak' : 'nie') . $arr . ($new[$key] ? 'tak' : 'nie');
					break;
				case 'comment':
					$changes[] = $names[$key] . ':<br/>' . UFlib_Diff::toHTML(UFlib_Diff::compare($this->_escape($val), $this->_escape($new[$key])));
					break;
				default: continue;
			}
		}
		if (!count($changes)) {
			return '';
		}
		$return = '';
		foreach ($changes as $c) {
			$return .= '<li>' . $c . '</li>';
		}
		return '<ul>' . $return . '</ul>';
	}

	public function history(array $d, $current) {
		echo '<div class="admin">';
		echo '<h3>Historia zmian</h3>';
		echo '<ol class="history">';

		$curr = array(
		    'ip' => $current->ip,
		    'hierarchyNo' => $current->hierarchyNo,
		    'model' => $current->model,
		    'locationAlias' => $current->locationAlias,
		    'dormitoryId' => $current->dormitoryId,
		    'dormitoryAlias' => $current->dormitoryAlias,
		    'dormitoryName' => $current->dormitoryName,
		    'inoperational' => $current->inoperational,
		    'modifiedById' => $current->modifiedById,
		    'modifiedBy' => $current->modifiedBy,
		    'modifiedAt' => $current->modifiedAt,
		    'comment' => $current->comment,
		);
		$urlAdmin = $this->url(0) . '/admins/';
		foreach ($d as $c) {
			echo '<li>';
			if (is_null($curr['modifiedBy'])) {
				$changed = 'UŻYTKOWNIK';
			} else {
				$changed = '<a href="' . $urlAdmin . $curr['modifiedById'] . '">' . $this->_escape($curr['modifiedBy']) . '</a>';
			}
			echo date(self::TIME_YYMMDD_HHMM, $curr['modifiedAt']) . ' &mdash; ' . $changed;
			echo $this->_diff($c, $curr);
			echo '</li>';
			$curr = $c;
		}
		echo '<li>';
		if (is_null($curr['modifiedBy'])) {
			$changed = 'NIEZNANY';
		} else {
			$changed = '<a href="' . $urlAdmin . $curr['modifiedById'] . '">' . $this->_escape($curr['modifiedBy']) . '</a>';
		}
		echo ((is_null($curr['modifiedAt']) || $curr['modifiedAt'] == 0) ? 'nieznana' : date(self::TIME_YYMMDD_HHMM, $curr['modifiedAt'])) . ' &mdash; ' . $changed;
		echo '<ul><li>Utworzono</li></ul>';
		echo '</li>';

		echo '</ol>';
		echo '</div>';
	}

}
