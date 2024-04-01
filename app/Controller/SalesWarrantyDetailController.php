<?php
App::uses('AppController', 'Controller');
/**
 * MasterUsers Controller
 *
 * @property MasterUser $MasterUser
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class SalesWarrantyDetailController extends AppController {
		function warranty_details(){
			if( isset($this->request->data['MasterUser']) && !empty($this->request->data['MasterUser']) ){
				//echo "<pre>";print_r($this->request->data['MasterUser']);//exit;
				$warranty['SalesWarrantyDetail']['warranty_disclaimer'] = trim($this->request->data['MasterUser']['offer']);
				$warranty['SalesWarrantyDetail']['warrent_month'] = trim($this->request->data['MasterUser']['warranty_month']);
				$warranty['SalesWarrantyDetail']['warrent_term'] = trim($this->request->data['MasterUser']['terms_warranty']);
				$warranty['SalesWarrantyDetail']['return_days'] = trim($this->request->data['MasterUser']['return_days']);
				
				//$method_arr = trim($this->request->data['MasterUser']['return']);
				$r_meth = '';
				foreach($this->request->data['MasterUser']['return'] as $k=>$v){
					$r_meth = $r_meth.",".$v;
				}
				$r_meth = ltrim($r_meth,',');
				$r_meth = rtrim($r_meth,',');
				$warranty['SalesWarrantyDetail']['return_method'] = trim($r_meth);
				$warranty['SalesWarrantyDetail']['transportation_cost_support'] = trim($this->request->data['MasterUser']['transport_cost']);
				$warranty['SalesWarrantyDetail']['additional_info'] = trim($this->request->data['MasterUser']['additional_info']);
				
				//$del_method_arr = trim($this->request->data['MasterUser']['delivery_methods']);
				$delivery_meth = '';
				foreach($this->request->data['MasterUser']['delivery_methods'] as $k1=>$v1){
					$delivery_meth = $delivery_meth.",".$v1;
				}
				$delivery_meth = ltrim($delivery_meth,',');
				$delivery_meth = rtrim($delivery_meth,',');
				$warranty['SalesWarrantyDetail']['delivery_type'] = trim($delivery_meth);
				
				$warranty['SalesWarrantyDetail']['delivery_cost'] = trim($this->request->data['MasterUser']['del_cost']);
				$warranty['SalesWarrantyDetail']['delivery_time'] = trim($this->request->data['MasterUser']['dispatch_time']);
				$warranty['SalesWarrantyDetail']['package_details'] = trim($this->request->data['MasterUser']['package_details']);
				
				$payment = '';
				if(isset($this->request->data['MasterUser']['cash']) && $this->request->data['MasterUser']['cash'] != 0){
					$payment = $payment.",".$this->request->data['MasterUser']['cash'];
				}
				if(isset($this->request->data['MasterUser']['upon']) && $this->request->data['MasterUser']['upon'] != 0){
					$payment = $payment.",".$this->request->data['MasterUser']['upon'];
				}
				if(isset($this->request->data['MasterUser']['wire']) && $this->request->data['MasterUser']['wire'] != 0){
					$payment = $payment.",".$this->request->data['MasterUser']['wire'];
				}
				if(isset($this->request->data['MasterUser']['card']) && $this->request->data['MasterUser']['card'] != 0){
					$payment = $payment.",".$this->request->data['MasterUser']['card'];
				}
				if(isset($this->request->data['MasterUser']['other']) && $this->request->data['MasterUser']['other'] != 0){
					$payment = $payment.",".$this->request->data['MasterUser']['other'];
				}
				$payment = ltrim($payment,',');
				$payment = rtrim($payment,',');
				$warranty['SalesWarrantyDetail']['payment_id'] = trim($payment);
				
				
				$warranty['SalesWarrantyDetail']['product_condition'] = trim($this->request->data['MasterUser']['product_cond']);
				$warranty['SalesWarrantyDetail']['send_invoice'] = trim($this->request->data['MasterUser']['invoice']);
				$warranty['SalesWarrantyDetail']['order_response'] = trim($this->request->data['MasterUser']['order_response']);
				$warranty['SalesWarrantyDetail']['msg_content'] = trim($this->request->data['MasterUser']['msg_content']);
				//echo "<pre>";print_r($warranty);exit;
				$this->SalesWarrantyDetail->save($warranty);
				$this->Session->setFlash("Warranty details saved successfully.");
				$this->redirect(array('controller'=>'SalesWarrantyDetail','action' => 'warranty_details'));
			}
			
		}
}
