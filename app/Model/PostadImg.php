<?php
App::uses('AppModel', 'Model');
/**
 * PostadImg Model
 *
 */
class PostadImg extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'postad_img';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'imgid';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'img_path';

}
