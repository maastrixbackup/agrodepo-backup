<?php
App::uses('AppModel', 'Model');
/**
 * UserMembership Model
 *
 */
class UserMembership extends AppModel {

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'memb_id';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'memb_type';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'memb_type' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Enter  Membership Type',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'unique' => array(
				'rule' => 'isUnique',
				'required' => 'create',
				'message' => 'Membership type must be Unique',
			),
		),
		'credits' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Enter Credits',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'price' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
}
