<?php
App::uses('AppModel', 'Model');
/**
 * ParkImg Model
 *
 */
class ParkImg extends AppModel {

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
