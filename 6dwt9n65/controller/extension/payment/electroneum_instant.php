<?php

class ControllerExtensionPaymentElectroneumInstant extends Controller {	

	// Array for holding Error messages 
	private $error = array();
	
	/**
     * Main controller function called for Payment Extension Admin Area.
     */
	public function index() {
		$this->load->language('extension/payment/electroneum_instant');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('payment_electroneum_instant', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=payment', true));
		}

		// validate required fields and any errors
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['api_key'])) {
			$data['error_api_key'] = $this->error['api_key'];
		} else {
			$data['error_api_key'] = '';
		}

		if (isset($this->error['api_secret'])) {
			$data['error_api_secret'] = $this->error['api_secret'];
		} else {
			$data['error_api_secret'] = '';
		}

		if (isset($this->error['outlet_id'])) {
			$data['error_outlet_id'] = $this->error['outlet_id'];
		} else {
			$data['error_outlet_id'] = '';
		}

		if (isset($this->error['instructions'])) {
			$data['error_instructions'] = $this->error['instructions'];
		} else {
			$data['error_instructions'] = '';
		}

		// Create breadcrumbs
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=payment', true)
		);
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/payment/electroneum_instant', 'user_token=' . $this->session->data['user_token'], true)
		);

		// Action urls
		$data['action'] = $this->url->link('extension/payment/electroneum_instant', 'user_token=' . $this->session->data['user_token'], true);
		$data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=payment', true);
		$data['search'] = $this->url->link('extension/payment/electroneum_instant', 'user_token=' . $this->session->data['user_token'], true);
		
		// Custom URLS used in admin template
		$data['userUrl'] = $this->url->link('customer/customer', 'user_token=' . $this->session->data['user_token'] . '&filter_email=', true);
		$data['orderUrl'] = $this->url->link('sale/order', 'user_token=' . $this->session->data['user_token'] . '&filter_order_id=', true);

		$this->load->model('localisation/language');

		$data['payment_electroneum_instant'] = array();

		$languages = $this->model_localisation_language->getLanguages();		
		foreach ($languages as $language) {
			if (isset($this->request->post['payment_electroneum_instant_instructions' . $language['language_id']])) {
				$data['payment_electroneum_instant_instructions'][$language['language_id']] = $this->request->post['payment_electroneum_instant_instructions' . $language['language_id']];
			} else {
				$data['payment_electroneum_instant_instructions'][$language['language_id']] = $this->config->get('payment_electroneum_instant_instructions' . $language['language_id']);
			}
		}
		$data['languages'] = $languages;

		// Check if admin field is populated and add to data object
		if (isset($this->request->post['payment_electroneum_instant_api_key'])) {
			$data['payment_electroneum_instant_api_key'] = $this->request->post['payment_electroneum_instant_api_key'];
		} else {
			$data['payment_electroneum_instant_api_key'] = $this->config->get('payment_electroneum_instant_api_key');
		}

		if (isset($this->request->post['payment_electroneum_instant_api_secret'])) {
			$data['payment_electroneum_instant_api_secret'] = $this->request->post['payment_electroneum_instant_api_secret'];
		} else {
			$data['payment_electroneum_instant_api_secret'] = $this->config->get('payment_electroneum_instant_api_secret');
		}

		if (isset($this->request->post['payment_electroneum_instant_outlet_id'])) {
			$data['payment_electroneum_instant_outlet_id'] = $this->request->post['payment_electroneum_instant_outlet_id'];
		} else {
			$data['payment_electroneum_instant_outlet_id'] = $this->config->get('payment_electroneum_instant_outlet_id');
		}

		if (isset($this->request->post['payment_electroneum_instant_min_order'])) {
			$data['payment_electroneum_instant_min_order'] = $this->request->post['payment_electroneum_instant_min_order'];
		} else {
			$data['payment_electroneum_instant_min_order'] = $this->config->get('payment_electroneum_instant_min_order');
		}

		if (isset($this->request->post['payment_electroneum_instant_max_order'])) {
			$data['payment_electroneum_instant_max_order'] = $this->request->post['payment_electroneum_instant_max_order'];
		} else {
			$data['payment_electroneum_instant_max_order'] = $this->config->get('payment_electroneum_instant_max_order');
		}

		if (isset($this->request->post['payment_electroneum_instant_order_status_id_paid'])) {
			$data['payment_electroneum_instant_order_status_id_paid'] = $this->request->post['payment_electroneum_instant_order_status_id_paid'];
		} else {
			$data['payment_electroneum_instant_order_status_id_paid'] = $this->config->get('payment_electroneum_instant_order_status_id_paid');
		}

		if (isset($this->request->post['payment_electroneum_instant_order_status_id_unpaid'])) {
			$data['payment_electroneum_instant_order_status_id_unpaid'] = $this->request->post['payment_electroneum_instant_order_status_id_unpaid'];
		} else {
			$data['payment_electroneum_instant_order_status_id_unpaid'] = $this->config->get('payment_electroneum_instant_order_status_id_unpaid');
		}

		// Collect ETN secret and key from admin fields (along with obfescated versions to show on the page)
        $secret = $data['payment_electroneum_instant_api_secret'];
		$data['api_secret_ob'] = substr($secret,0,3) . "********" . substr($secret, -3) ;
		$key = $data['payment_electroneum_instant_api_key'];
        $data['api_key_ob'] = substr($key,0,3) . "********" . substr($key, -3) ; ;

        // Load order status values
		$this->load->model('localisation/order_status');
		$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

		if (isset($this->request->post['payment_electroneum_instant_geo_zone_id'])) {
			$data['payment_electroneum_instant_geo_zone_id'] = $this->request->post['payment_electroneum_instant_geo_zone_id'];
		} else {
			$data['payment_electroneum_instant_geo_zone_id'] = $this->config->get('payment_electroneum_instant_geo_zone_id');
		}

		// Load geo zone
		$this->load->model('localisation/geo_zone');
		$data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

		if (isset($this->request->post['payment_electroneum_instant_status'])) {
			$data['payment_electroneum_instant_status'] = $this->request->post['payment_electroneum_instant_status'];
		} else {
			$data['payment_electroneum_instant_status'] = $this->config->get('payment_electroneum_instant_status');
		}

		if (isset($this->request->post['payment_electroneum_instant_sort_order'])) {
			$data['payment_electroneum_instant_sort_order'] = $this->request->post['payment_electroneum_instant_sort_order'];
		} else {
			$data['payment_electroneum_instant_sort_order'] = $this->config->get('payment_electroneum_instant_sort_order');
		}

		// Load payment records from database
        $this->load->model('extension/payment/electroneum_instant');
		$data['payments'] = $this->model_extension_payment_electroneum_instant->getPayments();

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/payment/electroneum_instant', $data));
	}

	/**
     * Validate form data
     *
     * @return $error object with localised error text
     */
	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/payment/electroneum_instant')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		$this->load->model('localisation/language');

		$languages = $this->model_localisation_language->getLanguages();

		foreach ($languages as $language) {
			if (empty($this->request->post['payment_electroneum_instant_instructions' . $language['language_id']])) {
				$this->error['instructions'][$language['language_id']] = $this->language->get('error_instructions');
			}
		}

		if (empty($this->request->post['payment_electroneum_instant_api_key'])) {
			$this->error['api_key'] = $this->language->get('error_api_key');
		}

		if (empty($this->request->post['payment_electroneum_instant_api_secret'])) {
			$this->error['api_secret'] = $this->language->get('error_api_secret');
		}

		if (empty($this->request->post['payment_electroneum_instant_outlet_id'])) {
			$this->error['outlet_id'] = $this->language->get('error_outlet_id');
		}		

		return !$this->error;
	}

	/**
     * Install function called by OpenCart when admin installs extension
	 * Calls install model function to create payments table 
     */
	public function install() {
	    $this->load->model('extension/payment/electroneum_instant');
        $this->model_extension_payment_electroneum_instant->install();
	}

	/**
     * Uninstall function called by OpenCart when admin uninstalls extension
	 * Calls uninstall model function
     */
    public function uninstall() {
        $this->load->model('extension/payment/electroneum_instant');
        $this->model_extension_payment_electroneum_instant->uninstall();
    }
}