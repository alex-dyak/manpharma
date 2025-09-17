<?php
class ControllerExtensionModuleAllProducts extends Controller {
	public function index($setting) {

		if (isset($this->request->get['product_id'])) {
			$product_id = (int)$this->request->get['product_id'];
		} else {
			$product_id = false;
		}
 
		if (isset($this->request->get['route']) && $this->request->get['route'] == "product/category" ) {
			$parts = explode('_', (string)$this->request->get['path']);

			$category_id = (int)array_pop($parts);
		} else {
			$category_id = false;
		}
 
		$this->load->language('extension/module/special');

		$this->load->model('catalog/category');
		$this->load->model('catalog/product');

		$data['products'] = array();
		$all_products_category_id = 59;

		// Get all subcategories of All products category
		$categories = $this->model_catalog_category->getCategories($all_products_category_id);
	 
		foreach ($categories as $category) {
			if ($category['category_id'] == $category_id) {
				$active = true;
			} else {
				$active = false;
			}
			$data['groups'][$category['category_id']] = array(
				'name' => $category['name'],
				'active' => $active,
				'href' => $this->url->link('product/category', 'path=' . $category['category_id'] ),
				'products' => []
			);
		}
 

		$products = $this->model_catalog_product->getProductsList();
 
		if ($products) {
			foreach ($products as $product) {
				// Check if single poduct page
				if ($product['product_id'] == $product_id) {
					$active = true;
				} else {
					$active = false;
				}

				$product_data = array(
					'name'        => $product['name'],
					'active'	  => $active,
					'href'        => $this->url->link('product/product', 'product_id=' . $product['product_id'])
				);

				if (array_key_exists($product['category_id'], $data['groups'])) {
					$data['groups'][$product['category_id']]['products'][] = $product_data;
				} else {
					$data['products'][] = $product_data;
				}
			}
		}

		return $this->load->view('extension/module/all_products', $data);
	}
 
}