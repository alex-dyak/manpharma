<?php
class ModelExtensionPaymentElectroneumInstant extends Model {

	/**
     * Validate payment method.
	 * Check GEO site and min/max levels
     *
     * @return array[]
     */
    public function getMethod($address, $total) {

		$this->load->language('extension/payment/electroneum_instant');

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone_to_geo_zone WHERE geo_zone_id = '" . (int)$this->config->get('payment_electroneum_instant_geo_zone_id') . "' AND country_id = '" . (int)$address['country_id'] . "' AND (zone_id = '" . (int)$address['zone_id'] . "' OR zone_id = '0')");

		if ($this->config->get('payment_electroneum_instant_min_order') > 0 && $this->config->get('payment_electroneum_instant_min_order') > $total) {
			$status = false;
		} elseif ($this->config->get('payment_electroneum_instant_max_order') > 0 && $this->config->get('payment_electroneum_instant_max_order') < $total) {
			$status = false;
		} elseif (!$this->config->get('payment_electroneum_instant_geo_zone_id')) {
			$status = true;
		} elseif ($query->num_rows) {
			$status = true;
		} else {
			$status = false;
		}

		$method_data = array();

		if ($status) {
			$method_data = array(
				'code'       => 'electroneum_instant',
				'title'      => $this->language->get('text_title'),
				'terms'      => 'Orders between ' . $this->config->get('payment_electroneum_instant_min_order') . ' and ' . $this->config->get('payment_electroneum_instant_max_order') . ' only',
				'sort_order' => $this->config->get('payment_electroneum_instant_sort_order')
			);
		}

		return $method_data;
	}

	/**
     * Check if payment made for provided Order ID
     *
     * @return int
     */
	public function checkPaymentStatus($order_id){
		
		// TODO: verify amount as well (sum payments incase of more than one)
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "electroneum_payments WHERE payment_id = '" . $order_id . "'");
		
		return $query->num_rows;
    }

	/**
     * Add new payment (webhook from ETN) to electroneum_payments table
	 * This table is polled by the payment page for the user.
     *
     */
    public function addTransactions($payload_arr){

		// Payload has already been validated, extract relevant data		
    	$paymentRef = $payload_arr["ref"];
		$paymentHost = $_SERVER['HTTP_USER_AGENT'];
		$paymentSignature = $_SERVER['HTTP_ETN_SIGNATURE'];
		$paymentId = $payload_arr["payment_id"];
		$paymentAmount = $payload_arr["amount"];
		$paymentKey = $payload_arr["key"];
		$paymentSent = $payload_arr["timestamp"];
		$paymentEmail  = $payload_arr["customer"];
        $paymentEvent  = $payload_arr["event"];

		$this->db->query("INSERT INTO " . DB_PREFIX . "electroneum_payments SET 
			payment_ref = '" . $this->db->escape($paymentRef) . 
			"', payment_host = '" . $this->db->escape($paymentHost) . 
			"', payment_signature = '" . $this->db->escape($paymentSignature) .
			"', payment_id = '" . $this->db->escape($paymentId) .
			"', payment_amount = '" . $this->db->escape($paymentAmount) .
			"', payment_key = '" . $this->db->escape($paymentKey) .
			"', payment_sent = '" . $this->db->escape($paymentSent) .
			"', payment_email = '" . $this->db->escape($paymentEmail) .
            "', payment_event = '" . $this->db->escape($paymentEvent) .
			"'");
    }
}
