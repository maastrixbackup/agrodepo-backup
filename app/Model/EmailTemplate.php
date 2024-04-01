<?php
App::uses('AppModel', 'Model');
/**
 * EmailTemplate Model
 *
 */
class EmailTemplate extends AppModel {

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'compose_id';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'mail_subject';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'email_of' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Select page to assign',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'mail_subject' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Select Subject',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'mail_body' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Select Mail Body',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'compose_status' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Select Status',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
}
