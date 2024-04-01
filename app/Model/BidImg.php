<?php
App::uses('AppModel', 'Model');
/**
 * BidImg Model
 *
 */
class BidImg extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'bid_img';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'img_id';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'img_path';

}
