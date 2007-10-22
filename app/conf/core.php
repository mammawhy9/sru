<?

class UFconf_Core
extends UFconf {

	protected $timezone = 'Europe/Warsaw';

	protected $db = array(
		'driver'    => 'Postgresql',
		'host'      => 'localhost',
		'user'      => 'hrynek',
		'pass'      => 'hrynek',
		'base'      => 'skos',
		'encoding'  => 'utf8',
		'collation' => 'utf8_polish_ci',
		'pconnect'  => true,
		'prefix'    => '',
		'autoconnect'=> true,
	);

	protected $maxViewChanges = 3;

	protected $title = 'SKOS';
	protected $titleDelimiter = ' - ';

	protected $cacheDao = '';
	protected $cacheBox = '';

	protected $debugAllowed = array(
		'127.0.0.1',
		'153.19.210.85',
		'153.19.212.255',
	);
}
