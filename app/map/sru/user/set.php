<?
/**
 * modyfikacja uzytkownika
 */
class UFmap_Sru_User_Set
extends UFmap {

	protected $columns = array(
		'login'          => 'login',
		'password'       => 'password',
		'typeId'	 => 'type_id',
		'name'           => 'name',
		'surname'        => 'surname',
		'email'          => 'email',
		'facultyId'      => 'faculty_id',
		'studyYearId'    => 'study_year_id',
		'locationId'     => 'location_id',
		'modifiedById'   => 'modified_by',
		'modifiedAt'     => 'modified_at',
		'comment'        => 'comment',
		'active'         => 'active',
		'lastLoginAt'	 => 'last_login_at',
		'lastLoginIp'	 => 'last_login_ip',
		'lastInvLoginAt' => 'last_inv_login_at',
		'lastInvLoginIp' => 'last_inv_login_ip',
		'lang'			 => 'lang',
		'referralStart'	 => 'referral_start',
		'referralEnd'	 => 'referral_end',
		'registryNo'	 => 'registry_no',
		'updateNeeded'	 => 'update_needed',
		'changePasswordNeeded'	=> 'change_password_needed',
		'address'		=> 'address',
		'documentType'	=> 'document_type',
		'documentNumber'=> 'document_number',
		'nationality'	=> 'nationality',
		'pesel'			=> 'pesel',
		'birthDate'		=> 'birth_date',
		'birthPlace'	=> 'birth_place',
		'userPhoneNumber'	=> 'user_phone_number',
		'guardianPhoneNumber'	=> 'guardian_phone_number',
		'sex'			=> 'sex',
		'lastLocationChange' => 'last_location_change',
		'commentSkos'	=> 'comment_skos',
		'overLimit'		=> 'over_limit',
		'toDeactivate'		=> 'to_deactivate',
	);
	protected $columnTypes = array(
		'login'          => self::TEXT,
		'password'       => self::TEXT,
		'typeId'	 => self::INT,
		'name'           => self::TEXT,
		'surname'        => self::TEXT,
		'email'          => self::TEXT,
		'facultyId'      => self::NULL_INT,
		'studyYearId'    => self::NULL_INT,
		'dormitory'      => self::TEXT,	// kolumna tylko do walidacji
		'locationId'     => self::INT,
		'locationAlias'  => self::TEXT,	// kolumna tylko do walidacji
		'modifiedById'   => self::NULL_INT,
		'modifiedAt'     => self::TS,
		'comment'        => self::TEXT,
		'active'         => self::BOOL,
		'lastLoginAt'	 => self::TS,
		'lastLoginIp'	 => self::TEXT,
		'lastInvLoginAt' => self::TS,
		'lastInvLoginIp' => self::TEXT,
		'lang'           => self::TEXT,
		'referralStart'	 => self::TS,
		'referralEnd'	 => self::TS,
		'registryNo'	 => self::NULL_INT,
		'updateNeeded'	 => self::BOOL,
		'changePasswordNeeded'	=> self::BOOL,
		'address'		=> self::NULL_TEXT,
		'documentType'	=> self::INT,
		'documentNumber'=> self::NULL_TEXT,
		'nationality'	=> self::NULL_INT,
		'nationalityName' => self::TEXT,	// kolumna tylko do walidacji
		'pesel'			=> self::NULL_TEXT,
		'birthDate'		=> self::NULL_TS,
		'birthPlace'	=> self::NULL_TEXT,
		'userPhoneNumber'	=> self::NULL_TEXT,
		'guardianPhoneNumber'	=> self::NULL_TEXT,
		'sex'			=> self::BOOL,
		'lastLocationChange' => self::TS,
		'commentSkos'	=> self::TEXT,
		'overLimit'		=> self::BOOL,
		'toDeactivate'		=> self::BOOL,
	);
	protected $tables = array(
		'' => 'users',
	);
	protected $valids = array(
		'login' => array('textMin'=>1, 'textMax'=>100, 'regexp'=>'^[-a-zA-Z0-9\.@_]+$'),
		'password' => array('textMin'=>6),
		'name' => array('textMin'=>1, 'textMax'=>100, 'regexp'=>'^[a-zA-ZąćęłńóśźżĄĆĘŁŃÓŚŹŻ ]+$'),
		'surname' => array('textMin'=>1, 'textMax'=>100, 'regexp'=>'^[a-zA-ZąćęłńóśźżĄĆĘŁŃÓŚŹŻ -]+$'),
		'email' => array('email'=>true, 'textMax'=>100),
		'facultyId' => array('textMin'=>1, 'regexp'=>'^(1|2|3|4|5|6|7|8|9|0)+$'),
		'studyYearId' => array('textMin'=>1, 'regexp'=>'^(1|2|3|4|5|6|7|8|9|10|11|0)+$'),
		'dormitory' => array('textMin'=>1),
		'locationAlias' => array('textMin'=>1),
		'locationId' => array('intMin'=>1),
		'registryNo' => array('regexp'=>'^(|[0-9]{5,6})$'),
		'nationalityName' => array('textMax'=>50, 'regexp'=>'^[a-zA-ZąćęłńóśźżĄĆĘŁŃÓŚŹŻ]+$'),
		'documentNumber' => array('textMax'=>20),
		'pesel' => array('textMax'=>11),
		'birthPlace' => array('textMax'=>100),
		'userPhoneNumber' => array('textMax'=>20),
		'guardianPhoneNumber' => array('textMax'=>20),
	);
	protected $pk = 'id';
}
