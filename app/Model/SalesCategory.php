<?php
App::uses('AppModel', 'Model');
/**
 * SalesCategory Model
 *
 */
class SalesCategory extends AppModel {

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'category_id';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'category_name';
	
}
