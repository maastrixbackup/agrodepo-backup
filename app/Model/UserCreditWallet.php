<?php
App::uses('AppModel', 'Model');
/**
 * UserCreditWallet Model
 *
 */
class UserCreditWallet extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'user_credit_wallet';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'credit_id';

}
