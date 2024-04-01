<?php
App::uses('AppModel', 'Model');
/**
 * ManageBrand Model
 *
 */
class ManageBrand extends AppModel {
/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'sales_brands';
/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'brand_id';
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'brand_name';
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'brand_name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Enter Brand name',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'status' => array(
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
