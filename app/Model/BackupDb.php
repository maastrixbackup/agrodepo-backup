<?php
App::uses('AppModel', 'Model');
/**
 * BackupDb Model
 *
 */
class BackupDb extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'backup_db';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'backup_id';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'backup_file';

}
