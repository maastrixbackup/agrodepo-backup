<?php
App::uses('AppModel', 'Model');
/**
 * PromotionAd Model
 *
 */
class PromotionAd extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'promotion_ad';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'promotion_id';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'total_price';

}
