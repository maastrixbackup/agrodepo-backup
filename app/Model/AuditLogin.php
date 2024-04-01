<?php
App::uses('AppModel', 'Model');
/**
 * Banner Model
 *
 */
class  AuditLogin extends AppModel {

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'audit_id';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'login_date';

}
