<?php
App::uses('AppModel', 'Model');
/**
 * Managecategory Model
 *
 */
class Managecategory extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'sales_categories';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'category_id';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'category_name';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'category_name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Enter Category Name',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			/*'unique' => array(
				'rule' => 'isUnique',
				'required' => 'create',
				'message' => 'Category must be Unique',
			),*/
		),
		'status' => array(
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
