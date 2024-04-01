<?php
App::uses('AppModel', 'Model');
class AdminLang extends AppModel {

	public $primaryKey = 'lid';
	public $displayField = 'module_name';
	public $validate = array(
		'en_label' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Write English Label',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations

			),
			'unique' => array(
				'rule' => 'isUnique',
				'required' => 'create',
				'message' => 'Label Must be Unique',
			),
		),
		'roman_label' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Write Romanian Label',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'unique' => array(
				'rule' => 'isUnique',
				'required' => 'create',
				'message' => 'Label Must be Unique',
			),
		),
	);
}
