<?php
App::uses('AppModel', 'Model');
/**
 * SalesView Model
 *
 */
class SalesView extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'sales_view';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'view_id';

}
