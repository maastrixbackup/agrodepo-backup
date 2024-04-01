<?php
App::uses('AppModel', 'Model');
/**
 * PostAd Model
 *
 */
class PostAd extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'sales_advertisements';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'adv_id';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'adv_name';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'category_id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Select category',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'sub_cat_id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Select Sub Category',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'adv_name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Enter Name',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'adv_details' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Write Description',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'product_cond' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Select product Conditions',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'price' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Price Must be numeric',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'currency' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Select currency',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		
		'time_required' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Select Supply length',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'invoice' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Select Invoice',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	
}
