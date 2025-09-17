<?php
class ControllerExtensionModuleSummernoteExt extends Controller {
	public function index() {		
		$this->load->language('extension/module/summernote_ext');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		
		$data['summernote_ext_status'] = $this->config->get('module_summernote_ext_status');				

        return $this->load->view('extension/module/summernote_ext', $data);
	}
	public function info() {
		$this->response->setOutput($this->index());
	}
}