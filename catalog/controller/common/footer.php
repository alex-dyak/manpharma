<?php
class ControllerCommonFooter extends Controller {
	public function index() {
	$data['checkout_page'] = isset($this->request->get['route']) && $this->request->get['route'] == 'extension/quickcheckout/checkout' ? true : false;
		$this->load->language('common/footer');

		$this->load->model('catalog/information');
		$this->load->model('catalog/category');
		$this->load->model('tool/image');

		$data['categories'] = array();

		$categories = $this->model_catalog_category->getCategories(0);
		foreach ($categories as $category) {
 
				$data['categories'][] = array(
					'name'     => $category['name'], 
					'href'     => $this->url->link('product/category', 'path=' . $category['category_id'])
				);
		 
		}
		$data['informations'] = array();

		foreach ($this->model_catalog_information->getInformations() as $result) {
			if ($result['bottom']) {
				$data['informations'][] = array(
					'title' => $result['title'],
					'href'  => $this->url->link('information/information', 'information_id=' . $result['information_id'])
				);
			}
		}
		if ($this->request->server['HTTPS']) {
			$server = $this->config->get('config_ssl');
		} else {
			$server = $this->config->get('config_url');
		}

		$data['text_categories'] = $this->language->get('text_categories');
		$data['text_navigation'] = $this->language->get('text_navigation');
		$data['text_contacts'] = $this->language->get('text_contacts');
		$data['text_payments'] = $this->language->get('text_payments');
		$data['text_shipping'] = $this->language->get('text_shipping');
		$data['text_terms'] = $this->language->get('text_terms');
		$data['text_forgot'] = $this->language->get('text_forgot');
		$data['text_address'] = $this->language->get('text_address');

		$data['forgot'] =  $this->url->link('account/forgotten', '', true);


		$data['logo_w'] = '253';
		$data['logo_h'] = '26';

		if (is_file(DIR_IMAGE . $this->config->get('config_logo'))) {
			$data['logo'] =  $this->model_tool_image->resize($this->config->get('config_logo'), $data['logo_w'], $data['logo_h']);
		} else {
			$data['logo'] = '';
		}
		$data['shipping_img_w'] = '233';
		$data['shipping_img_h'] = '30';
		if (is_file(DIR_IMAGE . 'catalog/shipping.png')) {
			$data['shipping_img'] = $this->model_tool_image->resize('catalog/shipping.png', $data['shipping_img_w'], $data['shipping_img_h']);
		}
		$data['return'] = $this->url->link('account/return/add', '', true);
		$data['sitemap'] = $this->url->link('information/sitemap');
		$data['tracking'] = $this->url->link('information/tracking');
		$data['manufacturer'] = $this->url->link('product/manufacturer');
		$data['voucher'] = $this->url->link('account/voucher', '', true);
		$data['affiliate'] = $this->url->link('affiliate/login', '', true);
		$data['special'] = $this->url->link('product/special');
		$data['account'] = $this->url->link('account/account', '', true);
		$data['order'] = $this->url->link('account/order', '', true);
		$data['wishlist'] = $this->url->link('account/wishlist', '', true);
		$data['newsletter'] = $this->url->link('account/newsletter', '', true);
		$data['logged'] = $this->customer->isLogged();
		$data['powered'] = sprintf($this->language->get('text_powered'), date('Y', time()));
		$data['scripts'] = $this->document->getScripts('footer');
		$data['address'] = nl2br($this->config->get('config_address'));
		// Whos Online
		if ($this->config->get('config_customer_online')) {
			$this->load->model('tool/online');

			if (isset($this->request->server['REMOTE_ADDR'])) {
				$ip = $this->request->server['REMOTE_ADDR'];
			} else {
				$ip = '';
			}

			if (isset($this->request->server['HTTP_HOST']) && isset($this->request->server['REQUEST_URI'])) {
				$url = ($this->request->server['HTTPS'] ? 'https://' : 'http://') . $this->request->server['HTTP_HOST'] . $this->request->server['REQUEST_URI'];
			} else {
				$url = '';
			}

			if (isset($this->request->server['HTTP_REFERER'])) {
				$referer = $this->request->server['HTTP_REFERER'];
			} else {
				$referer = '';
			}

			$this->model_tool_online->addOnline($ip, $this->customer->getId(), $url, $referer);
		}

		$data['scripts'] = $this->document->getScripts('footer');
		
		return $this->load->view('common/footer', $data);
	}
}
