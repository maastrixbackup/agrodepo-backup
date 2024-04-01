<?php
App::uses('AppModel', 'Model');
/**
 * SalesOrder Model
 *
 */
class SalesOrder extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'sales_order';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'orderid';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'delivery_method' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Select Delivery Method',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'fname' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Enter First Name',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'lname' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Enter last Name',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'county' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Select County',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'location' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Select Location',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'postcode' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Enter your Postcode',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Postcode Must be numeric',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'delivery_add' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Write Delivery Address',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
}
