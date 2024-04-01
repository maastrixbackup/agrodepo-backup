<?php
App::uses('AppModel', 'Model');
/**
 * ParkQuestion Model
 *
 */
class ParkQuestion extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'park_question';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'qid';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'question' => array(
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
