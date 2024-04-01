<?php
App::uses('AppModel', 'Model');
/**
 * PromotionPlan Model
 *
 */
class PromotionPlan extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'promotion_plan';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'promotion_id';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'promotion_days';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'promotion_type' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'promotion_days' => array(
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
		'promotion_price' => array(
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
