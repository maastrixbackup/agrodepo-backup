<?php
App::uses('AppModel', 'Model');
/**
 * BidQuestion Model
 *
 */
class BidQuestion extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'bid_question';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'qid';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'question';

}
