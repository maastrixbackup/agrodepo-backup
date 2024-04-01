<?php
App::uses('AppModel', 'Model');
/**
 * RequestPart Model
 *
 */
class RequestPart extends AppModel {

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'request_id';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'engines';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'brand_id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Select Brand',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'model_id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Select Model',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'version' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Enter Version',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'yr_of_manufacture' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Enter year of manufacture',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'engines' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Enter Engines',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'want_song' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Select a Doriti Piesa',
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
		'city' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Select City',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
}
