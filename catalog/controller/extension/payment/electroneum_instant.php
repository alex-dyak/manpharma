<?php

class ControllerExtensionPaymentElectroneumInstant extends Controller {
	
	/**
     * Main controller function called for Payment Extension Catalog.
     */
	public function index() {
		// include Electroneum Vendor code
		include_once(DIR_SYSTEM . 'library/external/electroneum_instant/Vendor.php');
		$this->load->model('checkout/order');

		$total = $this->cart->getSubTotal();

		$apiKey 	= $this->config->get('payment_electroneum_instant_api_key');
		$apiSecret 	= $this->config->get('payment_electroneum_instant_api_secret');
		$apiOutlet 	= $this->config->get('payment_electroneum_instant_outlet_id');
		
		// create instance of Vendor object
		$vendor 			= new \Electroneum\Vendor\Vendor($apiKey, $apiSecret);
        $data['orderID'] 	= $this->session->data['order_id'];
		$paymentId 			= str_pad($data['orderID'],10,"0", STR_PAD_LEFT);

		$data['paymentId'] 		= $paymentId;
		$data['orderDetails'] 	= $this->model_checkout_order->getOrder($data['orderID']);
		$data['rate'] 			= $this->getConversion($data['orderDetails']['currency_code']);
		$data['etn'] 			= $vendor->currencyToEtn($data['orderDetails']['total'], $data['orderDetails']['currency_code']);
		$data['qr'] 			= $vendor->getQrUrl($vendor->getQrCode((float)$data['etn'], $apiOutlet, $paymentId));
        $data['widget'] 		= "etn-it-" . $apiOutlet . "/" . $paymentId . "/" . (float)$data['etn'];

		// get language text for payment form
        $this->load->language('extension/payment/electroneum_instant');

		$data['bank'] = nl2br($this->config->get('payment_electroneum_instant_bank' . $this->config->get('config_language_id')));

		return $this->load->view('extension/payment/electroneum_instant', $data);
	}
	
	/**
     * Check status of payment for provided order
     *
     * @return $json response with boolean for payment status
	 * 
     */
	public function status() {
		$json = array();
		$this->load->model('account/order');

		if ( isset( $_POST[ 'paymentID' ])){ 
			// Sanitisation	of provided payment ID (as passed from client)		
			$paymentId =  strip_tags(trim($_POST['paymentID']));
			
			// Call model to check status against Payments table
			$this->load->model('extension/payment/electroneum_instant');
            $json['response'] = $this->model_extension_payment_electroneum_instant->checkPaymentStatus($paymentId);
		}else{
			$json['response'] = false;			
		}		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));	
	}

	/**
     * Process Webhook from electroneum.com
     *
     * @return $valid HTTP response code to acknowledge webhook
	 * 
     */
	public function payment() {
		
		// The payload and signature from the webhook
        $payload_json = @file_get_contents('php://input');
        $payload_arr = json_decode($payload_json, true);
		$paymentSignature = $_SERVER['HTTP_ETN_SIGNATURE'];		
		
		
		if ($paymentSignature !== hash_hmac('sha256', $payload_json, $this->config->get('payment_electroneum_instant_api_secret'))){
            // Invalid webhook signature
            http_response_code(401);
        } elseif (strtotime($payload_arr['timestamp']) < strtotime('-5 minutes')) {
            // Expired webhook
            http_response_code(400);
        } else {

            // Valid webhook signature, let Electroneum know.           
			http_response_code(200);
			// Process the transaction (insert into payments table).
			$this->load->model('extension/payment/electroneum_instant');
            $this->model_extension_payment_electroneum_instant->addTransactions($payload_arr);
		}
		
		// all done
        die();
    } 

	/**
     * Confirm the order and re-verify payment has been made.
     * If no correct payment, order set to no payment status as chosen in Extension Admin tool
	 * Else payment set to successful status
	 * Localised text to be included in order email (built and passed to Order History)
	 * 
     */
	public function confirm() {
		$json = array();
		
		if ($this->session->data['payment_method']['code'] == 'electroneum_instant') {

		    $this->load->language('extension/payment/electroneum_instant');

            $this->load->model('checkout/order');
		    $this->load->model('extension/payment/electroneum_instant');

			// Check if payment made
		    $paymentId = str_pad($this->session->data['order_id'],10,"0",STR_PAD_LEFT);
		    $paid = $this->model_extension_payment_electroneum_instant->checkPaymentStatus($paymentId);

			// Set relevant order status and localised text
		    if($paid) {
                $comment = $this->language->get('text_order_paid') . "\n\n";
                $comment .= "PaymentId: ". $paymentId. "\n\n";
                $comment .= $this->language->get('text_instruction') . "\n\n";
                $comment .= $this->config->get('payment_electroneum_instant_bank' . $this->config->get('config_language_id')) . "\n\n";
                $this->model_checkout_order->addOrderHistory($this->session->data['order_id'], $this->config->get('payment_electroneum_instant_order_status_id_paid'), $comment, true);
            }else{
                $comment = $this->language->get('text_order_unpaid') . "\n\n";
                $comment .= "PaymentId: ". $paymentId. "\n\n";
                $comment .= $this->language->get('text_instruction') . "\n\n";
                $comment .= $this->config->get('payment_electroneum_instant_bank' . $this->config->get('config_language_id')) . "\n\n";
                $comment .= $this->language->get('text_payment'). "\n\n";
                $this->model_checkout_order->addOrderHistory($this->session->data['order_id'], $this->config->get('payment_electroneum_instant_order_status_id_unpaid'), $comment, true);
            }
			// Redirect, as order has been placed
			$json['redirect'] = $this->url->link('checkout/success');
		}
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));		
	}

	/**
     * Convert local currency from fiat to ETN
	 * Function included here so that vendor object is not required.
	 * 
	 * @return float
	 * 
     */
	public function getConversion($currency){
		// TODO: add errror handling for if site is down
		$json = file_get_contents('https://supply.electroneum.com/app-value-v2.json');

		// Check the JSON
		$arr = json_decode($json, true);
		if (json_last_error() == JSON_ERROR_NONE) {
			$rate = $arr['price_' . strtolower($currency)]; 
		} else {
			return false;
		}

		return $rate;
	}

}
