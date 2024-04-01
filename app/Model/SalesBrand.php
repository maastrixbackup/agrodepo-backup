<?php
App::uses('AppModel', 'Model');
/**
 * SalesCategory Model
 *
 */
class SalesBrand extends AppModel {

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'brand_id';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'brand_name';
	
}
