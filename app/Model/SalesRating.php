<?php
App::uses('AppModel', 'Model');
/**
 * SalesRating Model
 *
 */
class SalesRating extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'sales_rating';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'rating_id';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'rating';

}
