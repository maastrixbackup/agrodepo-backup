<?php
App::uses('AppModel', 'Model');
/**
 * UserRating Model
 *
 */
class UserRating extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'user_rating';

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
	public $displayField = 'grade';

}
