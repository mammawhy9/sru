<?
/**
 * szablon statystyk transferu
 */
class UFtpl_SruAdmin_Transfer
extends UFtpl_Common {
	public function transferStats(array $d) {
		$conf = UFra::shared('UFconf_Sru');
		$exAdmins = $conf->exAdmins;

		echo '<ul>';
		$sumAvg = 0;
		$sum = 0;
		foreach ($d as $uploader) {
			$suffix = '';
			$class = '<li>';
			if ($uploader['isAdmin']) {
				$class = '<li class="admin">';
				$suffix = ' - admin';
			} else if ($uploader['typeId'] == UFbean_Sru_Computer::TYPE_ORGANIZATION) {
				$class = '<li class="org">';
				$suffix = ' - organizacja';
			} else if ($uploader['typeId'] == UFbean_Sru_Computer::TYPE_ADMINISTRATION) {
				$class = '<li class="adm">';
				$suffix = ' - administracja';
			} else if ($uploader['typeId'] == UFbean_Sru_Computer::TYPE_SERVER) {
				$class = '<li class="serv">';
				$suffix = ' - serwer';
			} else if ($uploader['exAdmin']) {
				$class = '<li class="exAdmin">';
				$suffix = ' - exAdmin';
			}
			// jeśli zbanowany, nadpiszmy kolor
			if ($uploader['isBanned']) {
				$class = '<li class="ban">';
			}

			echo $class.'<a href="'.$this->url(0).'/computers/'.$uploader['hostId'].'/stats">'.$uploader['host'].' <small>('.$uploader['ip'].')</small></a>: '.$uploader['bytes_min'].'/<b>'.$uploader['bytes_sum'].'</b>/'.$uploader['bytes_max'].' kB/s'.$suffix.'</li>';
			$sumAvg += $uploader['bytes_sum'];
			$sum++;
		}
		echo '</ul><hr/>';
		echo 'Uploaderów: '.$sum.', średnio: '.round($sumAvg/$sum).'kB/s<br/>';
		echo 'Format: min/avg/max. Dane pochodzą z ostatnich 30 minut, maksymalnie 20 najbardziej aktywnych IP z transferem powyżej 10kB/s.';
	}

	public function myTransferStats(array $d, array $uploadList, $host) {
		$this->displayComputerStats($host, $uploadList[$host]);

		foreach ($uploadList as $uploader) {
			$uploader = current($uploadList);
			if (key($uploadList) != $host) {
				$this->displayComputerStats(key($uploadList), $uploader);
			}
			next($uploadList);
		}
	}

	private function displayComputerStats($host, $uploader) {
		if (is_null($uploader)) {
			echo $host.':0/0/0'."\n";
		} else {
			echo $host.':'.$uploader->getBytesMin().'/'.$uploader->getBytesSum().'/'.$uploader->getBytesMax()."\n";
		}
	}
}
