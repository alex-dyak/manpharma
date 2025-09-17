<?php
class ControllerExtensionModuleSummernoteExt extends Controller {
	private $error = array();
	
	public function index() {
		$this->load->language('extension/module/summernote_ext');

		$this->document->setTitle(strip_tags($this->language->get('heading_title')));

		$this->load->model('setting/setting');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {			
			
			$this->model_setting_setting->editSetting('module_summernote_ext', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_module_success');

			$this->response->redirect($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true));
		}		

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}		

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/module/summernote_ext', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['action'] = $this->url->link('extension/module/summernote_ext', 'user_token=' . $this->session->data['user_token'], true);

		$data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true);	

		if (isset($this->request->post['module_summernote_ext_status'])) {
			$data['module_summernote_ext_status'] = $this->request->post['module_summernote_ext_status'];
		} else {
			$data['module_summernote_ext_status'] = $this->config->get('module_summernote_ext_status');
		}
		
		if (isset($this->request->post['module_summernote_ext_cleaner'])) {
			$data['module_summernote_ext_cleaner'] = $this->request->post['module_summernote_ext_cleaner'];
		} else {
			$data['module_summernote_ext_cleaner'] = $this->config->get('module_summernote_ext_cleaner');
		}
		
		// styles and scripts
		$this->document->addScript('view/javascript/md_bootstrap_switch/js/summernote-ext-switch.min.js');
        $this->document->addStyle('view/javascript/md_bootstrap_switch/css/summernote-ext-switch.css');
		$this->document->addStyle('view/stylesheet/summernote-ext.css');		

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		
		$this->response->setOutput($this->load->view('extension/module/summernote_ext', $data));
	}
	
	public function install() {		
		$this->load->model('extension/module/summernote_ext');
        $this->model_extension_module_summernote_ext->install();		
	}
	
	public function uninstall() {		       
		$this->load->model('setting/setting');
        $this->model_setting_setting->deleteSetting('summernote_ext');
	}	

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/summernote_ext')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
				
		return !$this->error;
	}
}