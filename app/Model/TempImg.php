<?php
App::uses('AppModel', 'Model');
/**
 * TempImg Model
 *
 */
class TempImg extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'temp_img';

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
