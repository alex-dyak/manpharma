<?php

/**
 * Class ControllerExtensionModuleProductCategoryDescription
 */
class ControllerExtensionModuleProductCategoryDescription extends Controller {
	public function index() {
		$result = '';
		if(isset($this->request->get['product_id'])) {
			$data['category'] = $this->model_catalog_product->getCategories($this->request->get['product_id']);
			$data['category_description'] = !empty($data['category']['description']) ? html_entity_decode($data['category']['description'], ENT_QUOTES, 'UTF-8') : '';
			$result = $this->load->view('extension/module/product_category_description', $data);
		}
		return $result;
	}
}