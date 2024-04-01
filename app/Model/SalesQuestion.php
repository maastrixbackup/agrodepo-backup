<?php
App::uses('AppModel', 'Model');
/**
 * SalesQuestion Model
 *
 */
class SalesQuestion extends AppModel {

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
