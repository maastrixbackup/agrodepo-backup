<?php
App::uses('AppModel', 'Model');
/**
 * RequestImg Model
 *
 */
class RequestImg extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'request_img';

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
