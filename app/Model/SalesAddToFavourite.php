<?php
App::uses('AppModel', 'Model');
/**
 * SalesAddToFavourite Model
 *
 */
class SalesAddToFavourite extends AppModel {

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'fav_id';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'favcount';

}
