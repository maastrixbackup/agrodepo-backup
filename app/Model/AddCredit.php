<?php
App::uses('AppModel', 'Model');
/**
 * AddCredit Model
 *
 */
class AddCredit extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'credits';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'credits' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Enter Credits',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Credits value must be numeric',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
}
