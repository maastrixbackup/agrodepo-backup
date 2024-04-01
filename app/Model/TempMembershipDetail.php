<?php
App::uses('AppModel', 'Model');
/**
 * TempMembershipDetail Model
 *
 */
class TempMembershipDetail extends AppModel {

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'temp_mem_id';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'fname';

}
