<?
/**
 * szablon modulu sru
 */
class UFtpl_Sru
extends UFtpl_Common {

	public function titleLogin() {
		echo 'Zaloguj się';
	}

	public function login(array $d) {
		$form = UFra::factory('UFlib_Form');

		echo $form->_start();
		echo $form->_fieldset('Zaloguj się');

		if ($this->_srv->get('msg')->get('userAdd/ok')) {
			echo $this->OK('Konto zostało założone. Hasło otrzymasz wkrótce na maila.');
		} elseif ($this->_srv->get('msg')->get('userConfirm/errors/token/invalid')) {
			echo $this->ERR('Token w linku jest nieprawidłowy.');
		} elseif ($this->_srv->get('msg')->get('userLogin/errors')) {
			echo $this->ERR('Nieprawidłowy login lub hasło. Czy aktywowałeś swoje konto u administratora lub linkiem z maila?');
		}
		echo $d['user']->write('formLogin');
		echo $form->_submit('Zaloguj');
		echo ' <a href="'.$this->url(0).'/create">Załóż konto</a>';
		echo $form->_end();
		echo $form->_end(true);
	}

	public function titleUserAdd() {
		echo 'Załóż konto';
	}

	public function userAdd(array $d) {
		$form = UFra::factory('UFlib_Form');

		echo $form->_start();
		echo $form->_fieldset('Załóż konto');
		if ($this->_srv->get('msg')->get('userAdd/ok')) {
			echo $this->OK('Konto zostało założone');
		}
		echo $d['user']->write('formAdd', $d['dormitories'], $d['faculties'], $d['admin']);
		echo '<br/><b>Założenie konta oznacza akceptację <a href="../regulamin.html">Regulaminu SKOS PG</a>.</b><br/><br/>';
		echo $form->_submit('Załóż');
		echo $form->_end();
		echo $form->_end(true);
	}

	public function userAddMailTitle(array $d) {
		echo 'Witamy w sieci SKOS';
	}

	protected function userAddMailBody(array $d, $info='') {
		echo 'Witamy w Sieci Komputerowej Osiedla Studenckiego Politechniki Gdańskiej!'."\n";
		echo "\n";
		echo 'Jeżeli otrzymałeś/aś tę wiadomość, a nie chciałeś/aś założyć konta w SKOS PG,'."\n";
		echo 'prosimy o zignorowanie tej wiadomości.'."\n";
		echo $info;
		echo "\n";
		echo 'W razie jakichkolwiek problemów zachęcamy do skorzystania z FAQ:'."\n";
		echo 'http://skos.pg.gda.pl/'."\n";
		echo "\n";
		echo '- - - - - - - - - - -'."\n";
		echo "\n";
		echo 'Dane, na które zostało założone konto:'."\n";
		echo $d['user']->write('userAddMailBody', $d['password']);
		echo "\n";
		echo 'System Rejestracji Użytkowników: http://'.$d['host'].'/'."\n";
		echo 'PROSIMY O ZMIANĘ HASŁA ZARAZ PO PIERWSZYM ZALOGOWANIU SIĘ!'."\n";
		echo "\n";
		echo '- - - - - - - - - - -'."\n";
		echo "\n";
		echo 'Nasza sieć obejmuje swoim zasięgiem sieci LAN wszystkich Domów Studenckich'."\n";
		echo 'Politechniki Gdańskiej, jest częścią Uczelnianej Sieci Komputerowej (USK PG) i'."\n";
		echo 'dołączona jest bezpośrednio do sieci TASK.'."\n";
		echo "\n";
		echo 'Wszelkie informacje na temat funkcjonowania sieci, godzin dyżurów'."\n";
		echo 'administratorów SKOS PG oraz Regulamin SKOS PG znajdziesz na stronie'."\n";
		echo 'http://skos.pg.gda.pl/'."\n";
		echo "\n";
		echo '-- '."\n";
		echo 'Pozdrawiamy,'."\n";
		echo 'Administratorzy SKOS PG'."\n";
		echo 'http://skos.pg.gda.pl/'."\n";
		echo '[wiadomość została wygenerowana automatycznie]'."\n";
	}

	public function userAddMailBodyNoToken(array $d) {
		$info = "\n";
		$info .= 'Aby dokończyć proces aktywacji konta, zgłoś się do swojego administratora'."\n";
		$info .= 'lokalnego z wejściówką do DS-u. Godziny, w których możesz go zastać znajdziesz'."\n";
		$info .= 'tutaj: http://skos.pg.gda.pl/'."\n";
		$this->userAddMailBody($d, $info);
	}

	public function userAddMailBodyNoInfo(array $d) {
		$this->userAddMailBody($d);
	}

	public function userAddMailBodyToken(array $d) {
		$info = "\n";
		$info .= 'Aby aktywować swoje konto, kliknij:'."\n";
		$info .= 'http://'.$d['host'].$this->url(0).'/'.$d['token']->token."\n";
		$this->userAddMailBody($d, $info);
	}

	public function mailHeaders() {
		echo 'MIME-Version: 1.0'."\n";
		echo 'Content-Type: text/plain; charset=UTF-8'."\n";
		echo 'Content-Transfer-Encoding: 8bit'."\n";
		echo 'From: Administratorzy SKOS <adnet@ds.pg.gda.pl>'."\n";
	}

	public function userAddMailHeaders(array $d) {
		$this->mailHeaders();
	}

	public function titleMain() {
		echo 'System Rejestracji Użytkowników';
	}

	public function userInfo(array $d) {
		$form = UFra::factory('UFlib_Form');

		echo $form->_start($this->url(0).'/');
		echo $form->_fieldset('Ważne informacje');
		echo $d['penalties']->write('listPenalty');
		echo $form->_end();
		echo $form->_end(true);
	}

	public function userPenalties(array $d) {
		$d['penalties']->write('listAllPenalty');
	}


	public function titlePenalties() {
		echo 'Archiwum kar i ostrzeżeń';
	}

	public function penaltiesNotFound() {
		$form = UFra::factory('UFlib_Form');

		echo $form->_start($this->url(0).'/');
		echo $form->_fieldset('Ważne informacje');
		echo "<h3>Hurra! Brak aktywnych kar i ostrzeżeń! ;)</h3>";
		echo $form->_end();
		echo $form->_end(true);
	}

	public function userPenaltiesNotFound() {
		echo "<h3>Hurra! Brak kar i ostrzeżeń! ;)</h3>";
	}

	public function userMainMenu() {
		echo '<div class="mainMenu"><h1>System Rejestracji Użytkowników</h1>';
		if ($this->_srv->get('msg')->get('userConfirm/ok')) {
			echo $this->OK('Konto zostało aktywowane - teraz <a href="'.$this->url(0).'/computers">dodaj komputer</a>');
		}
		echo '<ul>';
		echo '<li><a href="'.$this->url(0).'/profile">Profil</a></li>';
		echo '<li><a href="'.$this->url(0).'/computers">Komputery</a></li>';
		echo '<li><a href="'.$this->url(0).'/penalties">Kary</a></li>';
		/*
		echo '<li><a href="'.$this->url(0).'/services">Usługi</a></li>';
		*/
		echo '</ul></div>';
	}

	public function titleError404() {
		echo 'Strony nie znaleziono';
	}

	public function error403() {
		echo $this->ERR('Nie masz uprawnień do oglądania tej strony. Wróć do <a href="'.$this->url(0).'/" title="System Rejestracji Użytkowników">SRU</a>.');
	}

	public function titleError403() {
		echo 'Brak uprawnień';
	}

	public function error404() {
		echo $this->ERR('Strony nie znaleziono. Wróć do <a href="'.$this->url(0).'/" title="System Rejestracji Użytkowników">SRU</a>.');
	}

	public function titleUserEdit() {
		echo 'Edycja Twoich danych';
	}

	public function userEdit(array $d) {
		$form = UFra::factory('UFlib_Form');

		echo $form->_start();
		echo $form->_fieldset('Twoje dane');
		if ($this->_srv->get('msg')->get('userEdit/ok')) {
			echo $this->OK('Dane zostały zmienione');
		}
		echo $d['user']->write('formEdit', $d['dormitories'], $d['faculties']);
		echo $form->_submit('Zapisz');
		echo $form->_end();
		echo $form->_end(true);
	}

	public function titleUserComputers() {
		echo 'Twoje komputery';
	}

	public function userComputers(array $d) {
		echo '<h1>Twoje komputery</h1><ul>';
		if ($this->_srv->get('msg')->get('computerAdd/ok')) {
			echo $this->OK('Komputer został dodany');
		} elseif ($this->_srv->get('msg')->get('computerDel/ok')) {
			echo $this->OK('Komputer został wyrejestrowany');
		}
		$d['computers']->write('listOwn');
		echo '</ul>';
		echo '<p>Samodzielnie możesz dodać tylko jeden komputer. Jeżeli chcesz zarejestrować kolejny, zgłoś się do administratora lokalnego.</p>';
	}

	public function userComputersNotFound() {
		echo '<h1>Twoje komputery</h1>';
		echo $this->ERR('Nie posiadasz komputerów. <a href="'.$this->url(1).'/:add">Dodaj komputer</a>.');
	}

	public function titleUserComputer(array $d) {
		echo $d['computer']->write('titleDetails');
	}

	public function titleUserComputerNotFound(array $d) {
		echo 'Komputera nie znaleziono';
	}

	public function userComputer(array $d) {
		echo '<div class="computer">';
		$d['computer']->write('detailsOwn');
		echo '<p class="nav"><a href="'.$this->url(1).'">Powrót do listy</a> <small><a href="'.$this->url(2).'/:edit">Edytuj</a></small></p>';
		echo '</div>';
	}

	public function userComputerNotFound() {
		echo $this->ERR('Komputera nie znaleziono');
	}

	public function userComputerEdit(array $d) {
		$form = UFra::factory('UFlib_Form');

		echo $form->_start($this->url(3).'/');
		echo $form->_fieldset('Zmień dane komputera');
		if ($this->_srv->get('msg')->get('computerEdit/ok')) {
			echo $this->OK('Dane zostały zmienione');
		}
		echo $d['computer']->write('formEdit');
		echo $form->_submit('Zapisz');
		echo $form->_end();
		echo $form->_end(true);
		echo '<p class="nav"><a href="'.$this->url(2).'">Powrót</a></p>';
	}

	public function titleUserComputerAdd() {
		echo 'Dodaj komputer';
	}

	public function userComputerAdd(array $d) {
		$form = UFra::factory('UFlib_Form');

		echo $form->_start($this->url(0).'/computers/:add');
		echo $form->_fieldset('Dodaj komputer');
		echo $d['computer']->write('formAdd');
		echo $form->_submit('Dodaj');
		echo $form->_end();
		echo $form->_end(true);
	}

	public function userComputerDel(array $d) {
		$form = UFra::factory('UFlib_Form');

		echo $form->_start($this->url(3).'/');
		echo $form->_fieldset('Wyrejestruj komputer');
		echo $d['computer']->write('formDel');
		echo $form->_submit('Wyrejestruj');
		echo $form->_end();
		echo $form->_end(true);
	}

	public function userBar(array $d) {
		$form = UFra::factory('UFlib_Form');

		echo $form->_start($this->url(0).'/', array('class'=>'userBar'));
		echo $form->_fieldset();
		echo $d['user']->write(__FUNCTION__);
		echo $form->_submit('Wyloguj', array('name'=>'userLogout'));
		echo $form->_end();
		echo $form->_end(true);
	}

	public function recoverPassword(array $d) {
		$form = UFra::factory('UFlib_Form', 'sendPassword');

		echo $form->_start($this->url(0));
		echo $form->_fieldset('Zmień hasło');

		if ($this->_isOK('sendPassword')) {
			echo $this->OK('Kliknij link, który został wysłany na maila.');
		} elseif ($this->_isOK('userConfirmPassword')) {
			echo $this->OK('Nowe hasło zostało wysłane na maila.');
		} elseif ($this->_srv->get('msg')->get('sendPassword/errors/email/notUnique')) {
			echo $this->ERR('Podany email jest przypisany do kilku kont - proszę zgłosić się do administratora lokalnego w celu zmiany hasła.');
		} elseif ($this->_isErr('sendPassword')) {
			echo $this->ERR('Nie znaleziono aktywnego konta z podanym mailem.');
		}
		echo $form->email('E-mail');
		echo $form->_submit('Zmień');
		echo $form->_end();
		echo $form->_end(true);
	}

	public function userRecoverPasswordMailTitle(array $d) {
		echo '[SRU] Zmiana hasła';
	}

	public function userRecoverPasswordMailBodyToken(array $d) {
		echo 'Kliknij poniższy link, aby zmienić hasło do Twojego konta w Systemie'."\n";
		echo 'Rejestracji Użytkowników (http://'.$d['host'].'/):'."\n";
		echo 'http://'.$d['host'].$this->url(0).'/'.$d['token']->token."\n\n";
		echo '-- '."\n";
		echo 'Pozdrawiamy,'."\n";
		echo 'Administratorzy SKOS PG'."\n";
		echo 'http://skos.pg.gda.pl/'."\n";
		echo '[wiadomość została wygenerowana automatycznie]'."\n";
	}

	public function userRecoverPasswordMailBodyPassword(array $d) {
		echo 'Twój login: '.$d['user']->login."\n";
		echo 'Twoje nowe hasło: '.$d['password']."\n\n";
		echo 'System Rejestracji Użytkowników: http://'.$d['host'].'/'."\n";
		echo 'PROSIMY O ZMIANĘ HASŁA ZARAZ PO PIERWSZYM ZALOGOWANIU!'."\n\n";
		echo '-- '."\n";
		echo 'Pozdrawiamy,'."\n";
		echo 'Administratorzy SKOS PG'."\n";
		echo 'http://skos.pg.gda.pl/'."\n";
		echo '[wiadomość została wygenerowana automatycznie]'."\n";
	}

	public function userRecoverPasswordMailHeaders(array $d) {
		$this->mailHeaders();
	}
}
