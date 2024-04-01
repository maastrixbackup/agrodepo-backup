<?php
App::uses('AppModel', 'Model');
/**
 * SubscribeAlert Model
 *
 */
class SubscribeAlert extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'subscribe_alert';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'alert_id';
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'brand_list' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Select Your Brand',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'categories' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Select Category',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'couties' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Select Counties',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

}
