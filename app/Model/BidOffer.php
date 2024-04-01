<?php
App::uses('AppModel', 'Model');
/**
 * BidOffer Model
 *
 */
class BidOffer extends AppModel {

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'bid_id';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'piece';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'piece' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Enter Denumire piesa',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'offers' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Enter Denumire piesa',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'price' => array(
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
		'currency' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'warranty' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Selectați Garanție',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
}
