<?php
class ControllerCommonMenu extends Controller {
	public function index() {
		$this->load->language('common/menu');

		// Menu
		$this->load->model('catalog/category');

		$this->load->model('catalog/product');
		$data['text_h_contact'] =  $this->language->get('text_h_contact');
		$data['text_h_navigation'] =  $this->language->get('text_h_navigation');
		$data['text_h_cat'] =  $this->language->get('text_h_cat');


		$data['text_contact'] =  $this->language->get('text_contact');

		$data['text_email'] =  $this->language->get('text_email');
		$data['text_adress'] =  $this->language->get('text_adress');
	
		$data['address'] = nl2br($this->config->get('config_address'));
		$data['email'] = nl2br($this->config->get('config_email'));
		$data['categories'] = array();

		$categories = $this->model_catalog_category->getCategories(0);

		foreach ($categories as $category) {
			if ($category['top']) {
				// Level 2
				$children_data = array();

				$children = $this->model_catalog_category->getCategories($category['category_id']);

				foreach ($children as $child) {
					$filter_data = array(
						'filter_category_id'  => $child['category_id'],
						'filter_sub_category' => true
					);

					$children_data[] = array(
						'name'  => $child['name'] . ($this->config->get('config_product_count') ? ' (' . $this->model_catalog_product->getTotalProducts($filter_data) . ')' : ''),
						'href'  => $this->url->link('product/category', 'path=' . $category['category_id'] . '_' . $child['category_id'])
					);
				}
			
				// Level 1
				$data['categories'][] = array(
					'name'     => $category['name'],
					'category_id'     => $category['category_id'],
					'children' => $children_data,
					'column'   => $category['column'] ? $category['column'] : 1,
					'href'     => $this->url->link('product/category', 'path=' . $category['category_id'])
				);
			}
		}
		$data['all_products'] = $this->load->controller('extension/module/all_products');


		// var_dump($data['all_products']);
		$data['others'] = [
			[   
				"name" => $this->language->get('text_comparison'),
				"href" => $this->url->link('information/information', 'information_id=11')
			]
		];

		$this->load->model('catalog/information');
		$data['informations'] = array();

		foreach ($this->model_catalog_information->getInformations() as $result) {
			if ($result['bottom']) {
				$data['informations'][] = array(
					'title' => $result['title'],
					'href'  => $this->url->link('information/information', 'information_id=' . $result['information_id'])
				);
			}
		}
		return $this->load->view('common/menu', $data);
	}
}
