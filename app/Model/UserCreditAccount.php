<?php
App::uses('AppModel', 'Model');
/**
 * UserCreditAccount Model
 *
 */
class UserCreditAccount extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'user_credit_account';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'credit_id';

}
