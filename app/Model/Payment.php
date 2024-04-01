<?php
App::uses('AppModel', 'Model');
/**
 * Payment Model
 *
 */
class Payment extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'upgrade_membership';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'upgrade_id';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

}
