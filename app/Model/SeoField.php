<?php
App::uses('AppModel', 'Model');
/**
 * SeoField Model
 *
 */
class SeoField extends AppModel {

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'seo_id';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'page_name';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'page_name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Enter page Name',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'meta_title' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Enter Meta Title',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
}
