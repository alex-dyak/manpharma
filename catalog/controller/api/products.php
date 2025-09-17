<?php
class ControllerApiProducts extends Controller {
	public function getProductsOptions() {
		$this->load->language('api/order');

		$json = array();

		// if (!isset($this->session->data['api_id'])) {
		// 	$json['error'] = $this->language->get('error_permission');
		// } else {
			$this->load->model('catalog/product');
			$products = $this->model_catalog_product->getProducts();

			if ($products) {
				foreach ($products as $product) {
					$json[] = [
						'product_id' => $product['product_id'],
						'name' => $product['name'],
						'option' => $this->model_catalog_product->getProductOptions($product['product_id'])

					];
				}
			}
		// }
		

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

}