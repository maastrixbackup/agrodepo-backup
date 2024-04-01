<?php
App::uses('AppModel', 'Model');
/**
 * RequestQuestion Model
 *
 */
class RequestQuestion extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'request_question';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'question_id';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'description' => array(
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
