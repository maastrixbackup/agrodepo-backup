<?php
App::uses('AppModel', 'Model');
/**
 * MasterMessage Model
 *
 */
class MasterMessage extends AppModel {

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'msg_id';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'msg_name';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'msg_name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'msg' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
}
