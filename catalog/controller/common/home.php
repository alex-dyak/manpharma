<?php
class ControllerCommonHome extends Controller {
	public function index() {
		$this->load->language('common/home');
		$this->document->setTitle($this->language->get('title'));
		$this->document->setDescription($this->language->get('description'));
		$this->document->setKeywords($this->config->get('config_meta_keyword'));
		$this->document->addStyle('catalog/view/theme/default/stylesheet/font-awsome.min.css');
		if (isset($this->request->get['route'])) {
			$this->document->addLink($this->config->get('config_url'), 'canonical');
		}

        $data['base'] = $this->config->get('config_ssl') ? $this->config->get('config_ssl') : $this->config->get('config_url');
        $data['name'] = $this->config->get('config_name');
        $data['logo'] = $data['base'] . '/image/cache/webp/catalog/manpharma-logo-253x26.webp';
        $data['description'] = $this->config->get('config_meta_description');
        $data['language_code'] = $this->session->data['language'];

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		$this->response->setOutput($this->load->view('common/home', $data));
	}
}
