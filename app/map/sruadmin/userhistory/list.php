<?
/**
 * wyciagniecie pojedynczego uzytkownika
 */
class UFmap_SruAdmin_UserHistory_List
extends UFmap {

	protected $columns = array(
		'id'             => 'u.id',
		'userId'         => 'u.user_id',
		'login'          => 'u.login',
		'name'           => 'u.name',
		'surname'        => 'u.surname',
		'email'          => 'u.email',
		'facultyId'      => 'u.faculty_id',
		'facultyName'    => 'f.name',
		'facultyAlias'   => 'f.alias',
		'studyYearId'    => 'u.study_year_id',
		'locationId'     => 'u.location_id',
		'locationAlias'  => 'l.alias',
		'dormitoryId'    => 'l.dormitory_id',
		'dormitoryAlias' => 'd.alias',
		'dormitoryName'  => 'd.name',
		'modifiedById'   => 'u.modified_by',
		'modifiedBy'     => 'a.name',
		'modifiedAt'     => 'u.modified_at',
		'comment'        => 'u.comment',
	);
	protected $columnTypes = array(
		'id'             => self::INT,
		'userId'         => self::INT,
		'login'          => self::TEXT,
		'name'           => self::TEXT,
		'surname'        => self::TEXT,
		'email'          => self::TEXT,
		'facultyId'      => self::NULL_INT,
		'facultyName'    => self::TEXT,
		'facultyAlias'   => self::TEXT,
		'studyYearId'    => self::NULL_INT,
		'locationId'     => self::INT,
		'locationAlias'  => self::TEXT,
		'dormitoryId'    => self::INT,
		'dormitoryAlias' => self::TEXT,
		'dormitoryName'  => self::TEXT,
		'modifiedById'   => self::NULL_INT,
		'modifiedBy'     => self::TEXT,
		'modifiedAt'     => self::TS,
		'comment'        => self::TEXT,
	);
	protected $tables = array(
		'u' => 'users_history',
	);
	protected $joins = array(
		'f' => 'faculties',
		'l' => 'locations',
		'd' => 'dormitories',
		'a' => 'admins',
	);
	protected $joinOns = array(
		'f' => 'u.faculty_id=f.id',
		'l' => 'u.location_id=l.id',
		'd' => 'l.dormitory_id=d.id',
		'a' => 'u.modified_by=a.id',
	);
	protected $pk = 'u.id';
}
