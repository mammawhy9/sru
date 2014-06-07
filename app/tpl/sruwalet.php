<?
/**
 * szablon modulu Waleta
 */
class UFtpl_SruWalet
extends UFtpl_Common {

	public function titleLogin() {
		echo 'Zaloguj się';
	}

	public function login(array $d) {
		$form = UFra::factory('UFlib_Form');

		echo $form->_start();
		echo $form->_fieldset('Zaloguj się');
		echo '<h3>System Ewidencji Mieszkańców<br/>Osiedla Studenckiego PG</h3>';
		if ($this->_srv->get('msg')->get('adminLogin/errors')) {
			echo $this->ERR('Nieprawidłowy login lub hasło');
		}
		echo $d['admin']->write('formLogin');
		echo $form->_submit('Zaloguj');
		echo $form->_end();
		echo $form->_end(true);

		echo '<div class="waletImg"><img src="'.UFURL_BASE.'/i/img/walet.png" alt="Walet"/></div>';
		
		UFlib_Script::focusIfLoginNotEmpty('adminLogin_password', 'adminLogin_login');
	}

	public function logout(array $d) {
		$form = UFra::factory('UFlib_Form');

		echo $form->_start($this->url(0).'/');
		echo $form->_fieldset('Wyloguj się');
		echo $d['admin']->write('formLogout');
		echo $form->_submit('Wyloguj', array('name'=>'adminLogout'));
		echo $form->_end();
		echo $form->_end(true);
	}

	public function title() {
		echo 'Administracja SKOS';
	}

	public function menuWalet() {
		$acl = $this->_srv->get('acl');
		
		echo '<ul id="nav">';
		echo '<li><a href="'.UFURL_BASE.'/walet/">Wyszukiwanie</a></li>';
		echo '<li><a href="'.UFURL_BASE.'/walet/inhabitants/">Obsadzenie</a></li>';
		if ($acl->sruWalet('inventory', 'view')) {
			echo '<li><a href="'.UFURL_BASE.'/walet/inventory/">Sprzęt</a></li>';
		}
		echo '<li><a href="'.UFURL_BASE.'/walet/stats/">Statystyki</a></li>';
		if ($acl->sruWalet('country', 'view')) {
			echo '<li><a href="'.UFURL_BASE.'/walet/nations/">Narodowości</a></li>';
		}
		if ($acl->sruWalet('admin', 'view')) {
			echo '<li><a href="'.UFURL_BASE.'/walet/admins/">Administratorzy</a></li>';
		}
		echo '</ul>';
	}

	public function waletBar(array $d) {
		$form = UFra::factory('UFlib_Form', 'adminLogout');
		$sruConf = UFra::shared('UFconf_Sru');
		$timeToInvalidatePassword = $d['admin']->lastPswChange + $sruConf->passwordValidTime - time();

		echo $form->_start($this->url(0).'/', array('class'=>'userBar'));
		echo $form->_fieldset();
		if($d['admin']->typeId != UFacl_SruWalet_Admin::PORTIER && $timeToInvalidatePassword < $sruConf->passwordOutdatedWarning){
		    echo '<img src="'.UFURL_BASE.'/i/img/padlock.jpg" alt="Padlock" title="Zbliża się czas wygaśnięcia hasła" />&nbsp;';
		}
		echo $d['admin']->write(__FUNCTION__, $d['lastLoginIp'], $d['lastLoginAt'], $d['lastInvLoginIp'], $d['lastInvLoginAt']);
		echo $form->logout('', array('type'=>$form->HIDDEN, 'value'=>true));
		echo $form->_submit('Wyloguj', array('name'=>'adminLogout'));
		echo $form->_end();
		echo $form->_end(true);
	}

	public function titleMain() {
		echo 'System Rejestracji Użytkowników - Walet';
	}


	/* Mieszkańcy */

	public function titleUserSearch() {
		echo 'Znajdź użytkownika';
	}

	public function userSearch(array $d) {
		$form = UFra::factory('UFlib_Form');

		if ($this->_srv->get('msg')->get('userDel/ok')) {
			echo $this->OK('Użytkownik został wymeldowany.');
		}

		echo '<div class="userSearch">';
		echo $form->_start($this->url(0).'/users/search');
		echo $form->_fieldset('<img src="'.UFURL_BASE.'/i/img/lupa.png" alt="" /> Znajdź mieszkańca');
		echo $d['user']->write('formSearchWalet', $d['searched']);
		echo $form->_submit('Znajdź');
		echo $form->_end();
		echo $form->_end(true);
		echo '</div>';
	}

	public function toDoList(array $d) {
		$acl = $this->_srv->get('acl');
		
		if ($acl->sruWalet('admin', 'toDoListView')) {
			$form = UFra::factory('UFlib_Form');
			echo $form->_fieldset('<img src="'.UFURL_BASE.'/i/img/todo.png" alt="" /> Lista zadań');
			echo $d['admin']->write('toDoList', $d['users']);
			echo $form->_end();
		}
	}

	public function mainPageInfo() {
		echo '<div><br/>Wszelkie znalezione błędy prosimy zgłaszać na adres <a href="mailto:admin@ds.pg.gda.pl">admin@ds.pg.gda.pl</a>.</div>';
	}

	private function generateNewUserLink(array $searched) {
		$acl = $this->_srv->get('acl');
		if (!$acl->sruWalet('user', 'add')) {
			return '';
		}
			
		$search = '';
		isset($searched['surname']) ? $search = '/surname:'.$searched['surname'] : '';
		if (isset($searched['registryNo'])) {
			if ($search == '') {
				$search = '/registryNo:'.$searched['registryNo'];
			} else {
				$search = $search.'/registryNo:'.$searched['registryNo'];
			}
		}
		if (isset($searched['pesel'])) {
			if ($search == '') {
				$search = '/pesel:'.$searched['pesel'];
			} else {
				$search = $search.'/pesel:'.$searched['pesel'];
			}
		}
		return ' <a href="'.$this->url(0).'/users/:add'.$search.'">Dodaj nowego mieszkańca</a>.';
	}

	public function addUserLink(array $d) {
		echo $this->generateNewUserLink($d['searched']);
	}

	public function userSearchResults(array $d) {
		echo '<div class="userSearchResults">';
		echo $d['users']->write('searchResultsWalet');
		echo '</div>';
	}

	public function quickUserSearchResults(array $d) {
		$response = array();
		foreach ($d['users'] as $user) {
			$response[] = $user['surname'];
		}
		echo json_encode(array_values(array_unique($response)));
	}

	public function quickCountrySearchResults(array $d) {
		$response = array();
		foreach ($d['countries'] as $country) {
			$response[] = $country['nationality'];
		}
		echo json_encode(array_values(array_unique($response)));
	}

	public function validatePeselResults(array $d) {
		if (!UFbean_Sru_User::validatePeselFormat($d['pesel'])) {
			echo json_encode(false);
			return;
		} else {
			$yearEndStr = substr($d['pesel'], 0, 2);
			$monthStr = substr($d['pesel'], 2, 2);
			$dayStr = substr($d['pesel'], 4,2);
			$month = intval($monthStr);
			$yearStartStr = '19';
			if ($month >= 80) {
				$yearStartStr = '18';
				$month = $month - 80;
			} else if ($month >= 60) {
				$yearStartStr = '22';
				$month = $month - 60;
			} else if ($month >= 40) {
				$yearStartStr = '21';
				$month = $month - 40;
			} else if ($month >= 20) {
				$yearStartStr = '20';
				$month = $month - 20;
			}
			$yearStr = $yearStartStr.$yearEndStr;
			$monthStr = $month;
			if (strlen($monthStr) < 2) {
				$monthStr = '0'.$monthStr;
			}
			$date = $yearStr.'-'.$monthStr.'-'.$dayStr;

			echo json_encode($date);
			return;
		}
	}

        public function checkRegistryNoResults(array $d) {
                $user = UFbean_Sru_User::checkRegistryNo($d['registryNo']);
                if($user == 'ok') { //nr indeksu unikalny
                        echo 'ok';
                } else if($user == 'invalid') { //niepoprawny format
                        echo 'invalid';
                } else { //utworzenie linku do usera o takim samym nr indeksu
                        echo "<strong class=\"msgError\"><a href=\"", $this->url(0), "/users/", $user->id, "\">", $user->name, " ", $user->surname, "</a> posiada ten sam numer indeksu</strong>" ;
                }
        }
                
	public function userSearchResultsNotFound(array $d) {
		echo $this->ERR('Nie znaleziono.');
	}

	public function user(array $d) {
		$url = $this->url(0).'/users/'.$d['user']->id;
		$msg = '';
		if ($this->_srv->get('msg')->get('userAdd/ok')) {
?>
<script type="text/javascript">
window.open("<? echo $url; ?>/:print/<? echo $this->_srv->get('req')->get->password; ?>", "Wydruk potwierdzenia zameldowania",'width=800,height=600');
</script>
<?
			$msg = '<br/>Konto zostało założone.<br/><a href="'.$url.'/:print/'.$this->_srv->get('req')->get->password.'" target="_blank">Wydrukuj potwierdzenie założenia konta</a>.';
		}
		if ($this->_srv->get('msg')->get('userEdit/ok')) {
			try {
				if ($this->_srv->get('req')->get->printConfirmation) {
?>
<script type="text/javascript">
window.open("<? echo $url; ?>/:print/<? echo $this->_srv->get('req')->get->password; ?>", "Wydruk potwierdzenia zameldowania",'width=800,height=600');
</script>
<?
					$msg = '<br/><a href="'.$url.'/:print/'.$this->_srv->get('req')->get->password.'" target="_blank">Wydrukuj potwierdzenie zameldowania</a>.';
				}
				if ($this->_srv->get('req')->get->activated) {
?>
<script type="text/javascript">
window.open("<? echo $url; ?>/:print", "Wydruk potwierdzenia zameldowania",'width=800,height=600');
</script>
<?
					$msg = '<br/><a href="'.$url.'/:print" target="_blank">Wydrukuj potwierdzenie zameldowania</a>.';
				}
			} catch (UFex_Core_DataNotFound $e) {
			}
		}
		if ($this->_srv->get('msg')->get('userAdd/warn') || $this->_srv->get('msg')->get('userEdit/warn')) {
			echo $this->OK('Dane zostały zapisane, ale są <b>niekompletne</b>.'.$msg);
		} else if($this->_srv->get('msg')->get('userEdit/ok')) {
			echo $this->OK('Dane zostały zapisane.'.$msg);
		}

		echo '<div class="user">';
		$d['user']->write('detailsWalet');
		echo '</div>';
	}

	public function userNotFound() {
		echo $this->ERR('Nie znaleziono użytkownika');
	}

	public function titleUser(array $d) {
		echo $d['user']->write('titleDetails');
	}

	public function titleUserNotFound() {
		echo 'Nie znaleziono użytkownika';
	}

	public function titleUserEdit(array $d) {
		echo $d['user']->write('titleEdit');
	}

	public function titleUserEditNotFound(array $d) {
		$this->titleUserNotFound();
	}

	public function userEdit(array $d) {
		$url = $this->url(0).'/users/'.$d['user']->id;
		$form = UFra::factory('UFlib_Form');

		echo '<h2>Edycja</h2>';
		echo $form->_start($this->url());
		echo $form->_fieldset('Edycja użytkownika');
		echo $d['user']->write('formEditWalet', $d['dormitories'], $d['faculties']);
		echo $form->_submit('Zapisz');
		echo $form->_end();
		echo $form->_end(true);
	}

	public function userDel(array $d) {
		$url = $this->url(0).'/users/'.$d['user']->id;
		$form = UFra::factory('UFlib_Form');

		echo '<h2>Wymeldowanie</h2>';
		echo $form->_start($this->url());
		echo $form->_fieldset('Wymeldowanie użytkownika');
		echo $d['user']->write('formDelWalet');
		echo $form->_submit('Zapisz');
		echo $form->_end();
		echo $form->_end(true);
	}

	public function userHistory(array $d) {
		echo '<div class="user">';
		echo '<h2>Historia profilu</h2>';
		echo '<ol class="history">';
		$d['history']->write('table', $d['user'], true);
		echo '</ol>';
		echo '</div>';
	}

	public function titleUserAdd() {
		echo 'Załóż konto';
	}

	public function userAdd(array $d) {
		$form = UFra::factory('UFlib_Form');

		echo $form->_start();
		echo $form->_fieldset('Załóż konto');
		echo $d['user']->write('formAddWalet', $d['dormitories'], $d['faculties'], $d['surname'], $d['registryNo'], $d['pesel']);
		echo $form->_submit('Załóż');
		echo $form->_end();
		echo $form->_end(true);
	}

	public function titleUserPrint() {
		echo 'Wydruk potwierdzenia zameldowania';
	}

	public function userPrint(array $d) {
		echo '<h3>Witamy w Osiedlu Studenckim Politechniki Gdańskiej!</h3>';
		echo '<div class="printable">';
		echo '<i>imię i nazwisko:</i> '.$d['user']->name.' '.$d['user']->surname.'<br/>';
		echo '<i>zameldowanie:</i> '.$d['user']->dormitoryName.', pok. '.$d['user']->locationAlias.'<br/>';
		echo '<p>Aby mieć Internet, zaloguj się na swoje konto w Systemie Rejestracji Użytkowników (http://sru.ds.pg.gda.pl) skorzystaj z następujących danych:<br/><br/>
			<i>login:</i> <span class="credentials">'.$d['user']->login.'</span><br/>';
		if (is_null($d['password'])) {
			echo '<br/>Użyj tego samego hasła, jakiego używał(a/e)ś poprzednio. Jeśli nie pamiętasz go, skorzystaj z przypomnienia hasła na SRU lub odwiedź administratora w godzinach dyżuru. Nie zapomnij wejściówki! Aby mieć Internet, po zalogowaniu się przywróć swoje komputery i odczekaj ok godzinę.';
		} else {
			echo '<i>hasło:</i> <span class="credentials">'.$d['password'].'</span><br/><br/>
				Zaraz po zalogowaniu zostaniesz poproszon(a/y) o zmianę hasła oraz uzupełnienie swoich danych kontaktowych i statystycznych. Następnie dodaj komputer i w przeciągu godziny ciesz się Internetem!';
		}
		echo '</p><hr/>';
		echo $d['userPrintWaletText'];
		echo '<hr/>';
		echo $d['userPrintSkosText'];
		echo '<hr/></div>';
	}

	public function userPrintError() {
		echo 'Błąd generowania wydruku';
	}
	
	/* Sprzet */
	
	public function titleInventory(array $d) {
		echo 'Lista sprzętu SKOS';
	}
	
	public function inventory(array $d) {
		echo '<h2>Lista sprzętu SKOS</h2>';
		$d['inventory']->write('inventoryList', false);
	}
	
	public function inventoryNotFound(array $d) {
		echo $this->ERR('Brak sprzętu na stanie.');
	}

	/* Narodowości */

	public function titleNations() {
		echo 'Narodowości';
	}

	public function nations(array $d) {
		echo '<h2>Narodowości</h2>';
		echo '<p><img src="'.UFURL_BASE.'/i/img/pytajnik.png" alt="?" /> Kliknij w nazwę narodowości, by ją edytować.</p>';
		$d['countries']->write('nations');
	}
	
	public function nationsNotFound() {
		echo $this->ERR('Nie znaleziono narodowości');
	}

	public function quickNationSaveResults(array $d) {
		echo $d['nation'];
	}

	/* Obsadzenie */

	public function titleInhabitants() {
		echo 'Obsadzenie pokoi';
	}

	public function inhabitants(array $d) {
		echo '<h2>Obsadzenie</h2>';
		$d['dormitories']->write('inhabitants', $d['rooms']);
	}

	public function titleDorm(array $d) {
		echo $d['dorm']->name.' - obsadzenie';
	}

	public function dorm(array $d) {
		if ($this->_srv->get('msg')->get('roomEdit/ok')) {
			echo $this->OK('Zmodyfikowano dane pokoju');
		}
		echo '<h2><a href="'.$this->url(0).'/inhabitants">Obsadzenie</a><br/>';
		$d['dorm']->write('exportPanel');
		echo '<h3>'.$d['dorm']->name.'</h3>';
		$d['rooms']->write('dormInhabitants', $d['dorm'], $d['users']);
	}

	public function titleDormNotFound() {
		echo 'Nie znaleziono domu studenckiego';
	}

	public function dormNotFound(array $d) {
		echo $this->ERR('Nie znaleziono domu studenckiego');
	}

	public function titleDormExport(array $d) {
		echo $d['dorm']->alias.'-obsadzenie';
	}

	public function dormExport(array $d) {
		echo '<h2>'.$d['dorm']->name.' - obsadzenie</h2>';
		$d['rooms']->write('dormInhabitants', $d['dorm'], $d['users'], true);
	}

	public function titleDormUsersExport(array $d) {
		echo $d['dorm']->alias.'-mieszkancy';
	}

	public function dormUsersExport(array $d) {
		echo '<h2>'.$d['dorm']->name.' - lista mieszkańców</h2>';
		$d['dorm']->write('inhabitantsAlphabetically', $d['users'], $d['settings']);
	}

	public function titleDormRegBookExport(array $d) {
		echo $d['dorm']->alias.'-ksiazka_meldunkowa';
	}

	public function dormRegBookExport(array $d) {
		echo '<h2>'.$d['dorm']->name.' - Książka meldunkowa</h2>';
		$d['dorm']->write('regBook', $d['users'], $d['settings']);
	}
	
	public function titleRoom(array $d) {
		echo $d['room']->write('titleDetails');
	}
	
	public function roomEdit(array $d) {
		echo $d['room']->write('formEditWalet');
	}
	
	public function roomNotFound() {
		echo $this->ERR('Nie znaleziono pokoju');
	}
	
	public function titleRoomNotFound() {
		echo 'Nie znaleziono pokoju';
	}


	/* Statystyki */

	public function titleStatsUsers() {
		echo 'Statystyki użytkowników';
	}
	
	public function statsUsers(array $d) {
		echo '<h2>Użytkownicy | <a href="'.$this->url(1).'/dormitories">Akademiki</a><br/>';
		echo '<small><a href="'.$this->url(2).'/:usersexport">Eksportuj do pliku MS Word&#153;</a></small></h2>';
		$d['users']->write('stats');
	}
	
	public function statsUsersNotFound(array $d) {
		echo $this->ERR('Błąd wyświetlenia statystyk');
	}

	public function titleStatsDormitories() {
		echo 'Statystyki akademików';
	}
	
	public function statsDormitories(array $d) {
		echo '<h2><a href="'.$this->url(1).'">Użytkownicy</a> | Akademiki<br/>';
		echo '<small><a href="'.$this->url(1).'/:dormitoriesexport">Eksportuj do pliku MS Word&#153;</a></small></h2>';
		$d['users']->write('statsDorms');
	}
	
	public function statsDormitoriesNotFound(array $d) {
		echo $this->ERR('Błąd wyświetlenia statystyk');
	}

	public function titleStatsUsersExport() {
		echo 'StatystykiUzytkownikow';
	}
	
	public function statsUsersExport(array $d) {
		echo '<h2>Statystyki użytkowników</h2>';
		$d['users']->write('stats');
	}

	public function titleStatsDormitoriesExport() {
		echo 'StatystykiAkademikow';
	}
	
	public function statsDormitoriesExport(array $d) {
		echo '<h2>Statystyki Domów Studenckich</h2>';
		$d['users']->write('statsDorms');
	}


	/* Admini */

	public function titleAdmins() {
		echo 'Administratorzy';
	}

	public function admins(array $d) {
		$url = $this->url(0).'/admins/';
		$acl = $this->_srv->get('acl');
		
		if ($this->_srv->get('msg')->get('adminAdd/ok')) {
			echo $this->OK('Konto zostało założone');
		}
		
		echo '<div class="admins">';
		echo '<h2>Administratorzy OS ('.count($d['admins']).')</h2>';

		$d['admins']->write('listAdmin', $d['dormitories'], 1);

		echo '</div>';
		
		if($acl->sruWalet('admin', 'add')) {
			echo '<p class="nav"><a href="'.$url.':add">Dodaj nowego administratora</a></p>';
		}
	}

	public function inactiveAdmins(array $d) {
		echo '<div class="admins inactive">';
		echo '<h2>Nieaktywni Administratorzy OS ('.count($d['admins']).')</h2>';

		$d['admins']->write('listAdmin', $d['dormitories'], 2);

		echo '</div>';
	}

	public function sruAdmins(array $d) {		
		echo '<div class="admins inactive">';
		echo '<h2>Administratorzy SKOS ('.count($d['admins']).') | <a href="http://dyzury.ds.pg.gda.pl">Dyżury</a></h2>';

		$d['admins']->write('listAdmin', true);

		echo '</div>';
	}

	public function titleAdminNotFound() {
		echo 'Nie znaleziono administratora';
	}

	public function adminNotFound() {
		echo $this->ERR('Nie znaleziono administratora');
	}	

	public function titleAdmin(array $d) {
		echo $d['admin']->write('titleDetails');
	}

	public function adminAdd(array $d) {
		$form = UFra::factory('UFlib_Form');
		echo '<h2>Dodawanie nowego administratora</h2>';
		echo $form->_start();
		

		echo $d['admin']->write('formAdd', $d['dormitories']);
		echo $form->_submit('Dodaj');
		echo ' <a href="'.$this->url(1).'">Powrót</a>';
		echo $form->_end();
		echo $form->_end(true);
	}

	public function titleAdminAdd(array $d) {
		echo 'Dodawanie nowego administratora';
	}

	public function adminEdit(array $d) {
		$form = UFra::factory('UFlib_Form');
		echo '<h2>Edycja administratora</h2>';
		echo $form->_start();
		
		echo $d['admin']->write('formEdit', $d['dormitories'], $d['dormList'], $d['advanced']);
		echo $form->_submit('Zapisz');
		echo ' <a href="'.$this->url(1).'">Powrót</a>';
		echo $form->_end();
		echo $form->_end(true);
	}
	
	public function titleOwnPswEdit(array $d){
	    echo 'Konieczna zmiana hasła';
	}
	
	public function ownPswEdit(array $d){
	    $form = UFra::factory('UFlib_Form');
	    echo '<h2>Konieczna zmiana hasła</h2>';
	    echo $form->_start();
	    echo $d['admin']->write('ownPswEdit');
	    echo $form->_end(true);
	}

	public function titleAdminEdit(array $d) {
		echo $d['admin']->write('titleDetails');
	}

	public function adminsNotFound() {
		$acl = $this->_srv->get('acl');
		$url = $this->url(0).'/admins/';
		
		echo '<h2>Administratorzy OS</h2>';
		echo $this->ERR('Nie znaleziono administratorów');
		
		if($acl->sruWalet('admin', 'add')) {
			echo '<p class="nav"><a href="'.$url.':add">Dodaj nowego administratora</a></p>';
		}
	}
	
	public function sruAdminsNotFound() {
		echo '<h2>Administratorzy SKOS | <a href="http://dyzury.ds.pg.gda.pl">Dyżury</a></h2>';
		echo $this->ERR('Nie znaleziono administratorów SKOS');		
	}

	public function inactiveAdminsNotFound() {
		echo '<h2>Nieaktywni Administratorzy OS</h2>';
		echo $this->ERR('Nie znaleziono administratorów');
	}

	public function admin(array $d) {
		$url = $this->url(0).'/admins/'.$d['admin']->id;
		$acl = $this->_srv->get('acl');
		
		if ($this->_srv->get('msg')->get('adminEdit/ok')) {
			echo $this->OK('Dane zostały zmienione');
		}
		
		echo '<div class="admin">';
		$d['admin']->write('details');
		
		echo '<p class="nav">';
		echo '<a href="'.$url.'/history">Historia profilu</a> &bull; ';
		if($acl->sruWalet('admin', 'edit', $d['admin']->id)) {
			echo '<a href="'.$url.'/:edit">Edycja</a> &bull; ';
		}
		echo '<a href="'.$this->url(0).'/admins/">Powrót</a></p></div>';
	}
	
	public function adminHistory(array $d) {
		$d['history']->write('history', $d['admin']);
	}

	public function adminDorms(array $d) {
		if (is_null($d['dormList'])) {
			$this->adminDormsNotFound();
			return;
		}

		$url = $this->url(0).'/admins/'.$d['admin']->id;
		$acl = $this->_srv->get('acl');

		echo '<h3>Domy studenckie</h3>';
		$d['admin']->write('listDorms', $d['dormList']);
		if($acl->sruWalet('admin', 'edit', $d['admin']->id)) {
			echo '<a href="'.$url.'/:edit">Edycja</a> &bull; ';
		}
		echo '<a href="'.$this->url(0).'/admins/">Powrót</a>';
	}

	public function adminDormsNotFound() {
		echo '<h3>Domy studenckie</h3>';
		echo $this->ERR('Brak przypisanych DSów');
	}

	public function adminDutyHours(array $d) {
		$url = $this->url(0).'/admins/'.$d['admin']->id;
		$acl = $this->_srv->get('acl');

		echo '<h3>Godziny dyżurów</h3>';
		$d['hours']->write('listDutyHours');
		if($acl->sruAdmin('admin', 'edit', $d['admin']->id)) {
			echo '<a href="'.$url.'/:edit">Edycja</a> &bull; ';
		}
		echo '<a href="'.$this->url(0).'/admins/">Powrót</a>';
	}

	public function adminDutyHoursNotFound() {
		echo '<h3>Godziny dyżurów</h3>';
		echo $this->ERR('Brak godzin dyżurów');
	}

	public function adminHosts(array $d) {
		$url = $this->url(0).'/admins/'.$d['admin']->id;
		$acl = $this->_srv->get('acl');

		echo '<div class="computers">';
		echo '<h3>Komputery pod opieką</h3>';
		echo '<ul>';
		$d['hosts']->write('listWalet');
		echo '</ul>';
		echo '</div>';

		echo '<a href="'.$this->url(0).'/admins/">Powrót</a>';
	}

	public function adminHostsNotFound() {
		echo '<h3>Komputery pod opieką</h3>';
		echo $this->ERR('Brak komputerów pod opieką');
	}

	public function adminUsersModified(array $d) {
		echo '<h3>Osoby ostatnio modyfikowane/dodane</h3>';
		$d['modifiedUsers']->write('userLastModified');
	}
}
