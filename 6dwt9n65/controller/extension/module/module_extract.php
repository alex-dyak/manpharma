<?php
class ControllerExtensionModuleModuleExtract extends Controller {
	private $error = array (); 
	private $dissallow_dir = array();
	
	public function index() {
		$this->load->language('extension/module/module_extract');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		$data['heading_title'       ] = $this->language->get('heading_title');
		
		$data['button_modules'      ] = $this->language->get('button_modules');
		$data['text_no_results'     ] = $this->language->get('text_no_results');
		$data['text_module_name'    ] = $this->language->get('text_module_name');
			
		$data['example_module_name' ] = $this->language->get('example_module_name');
		
		$data['error_select_extract'] = $this->language->get('error_select_extract');
		$data['error_select_delete' ] = $this->language->get('error_select_delete');
		
		$data['error_warning'] = $data['success'] = FALSE;
		
		$data['breadcrumbs'] = array (
			array (
				'text'      => $this->language->get('text_home'),
				'href'      => $this->url->link('common/home', 'user_token=' . $this->session->data['user_token'], 'SSL'),
			),
			array (
				'text'      => $this->language->get('text_module'),
				'href'      => $this->url->link('marketplace/extension', 'type=module&user_token=' . $this->session->data['user_token'], 'SSL'),
			),
			array (
				'text'      => $this->language->get('heading_title'),
				'href'      => $this->url->link('extension/module/module_extract', 'user_token=' . $this->session->data['user_token'], 'SSL'),
			)
		);
		
		if (isset ($this->request->get['page'])) {
			$data['page'] = $this->request->get['page'];
		} else {
			$data['page'] = FALSE;
		}

		$data['ocversion'] = $this->getOcVersion();

		if ($data['page'] == 'MODULES_EXTRACT') {
			$url = '&page=' . $data['page'];
			
			$data['text_module_size'] = $this->language->get('text_module_size');
			$data['text_module_date'] = $this->language->get('text_module_date');
			$data['text_module_time'] = $this->language->get('text_module_time');
			$data['text_total'      ] = $this->language->get('text_total');
			
			$data['button_cancel'   ] = $this->language->get('button_cancel');
			$data['button_delete'   ] = $this->language->get('button_delete');
			
			$data['action'] = $this->url->link('extension/module/module_extract', 'user_token=' . $this->session->data['user_token'] . $url, 'SSL');
			$data['cancel'] = $this->url->link('marketplace/extension', 'type=module&user_token=' . $this->session->data['user_token'], 'SSL');
			
			$data['module_total'] = FALSE;
			$data['module_list' ] = array ();
			
			$data['breadcrumbs'][] = array (
				'text'      => $data['button_modules'],
				'href'      => $this->url->link('extension/module/module_extract', 'user_token=' . $this->session->data['user_token'] . $url, 'SSL'),
			);
			
			if ($this->validate() && isset ($this->request->post['module_list']) && is_array ($this->request->post['module_list'])) {
				foreach ($this->request->post['module_list'] as $module) {
					if (file_exists ($module)) {
						unlink ($module);
					}
				}
				
				$this->session->data['success'] = $this->language->get('success_delete');
				$this->setRedirect($this->url->link('extension/module/module_extract', 'user_token=' . $this->session->data['user_token'], 'SSL'));
			}
			
			if ($this->user->hasPermission('modify', 'extension/module/module_extract') && $this->user->hasPermission('access', 'extension/module/module_extract')) {
				$data['module_list' ] = $this->moduleList();
				$data['module_total'] = count ($data['module_list']);
			}
		} else {
			$data['text_search'      ] = $this->language->get('text_search');
			$data['text_total_search'] = $this->language->get('text_total_search');
			$data['text_path_name'   ] = $this->language->get('text_path_name');
			$data['text_file_name'   ] = $this->language->get('text_file_name');
			
			$data['button_cancel'    ] = $this->language->get('button_modules_list');
			$data['button_extract'   ] = $this->language->get('button_extract');
			
			$data['module_name'  ] = FALSE;
			$data['module_search'] = array ();
			
			$data['action'] = $this->url->link('extension/module/module_extract', 'user_token=' . $this->session->data['user_token'], 'SSL');
			$data['cancel'] = $this->url->link('marketplace/extension', 'type=module&user_token=' . $this->session->data['user_token'], 'SSL');
			
			if (isset ($this->request->post['module_name'])) {
				if (!empty ($this->request->post['module_name'])) {
					$data['module_name'] = (string) $this->request->post['module_name'];
				} else {
					$data['error_warning'] = $this->language->get('error_module_name');
				}
			}
			
			if (!isset ($this->request->post['module_search'])) {
				if ($this->validate() && !empty ($data['module_name'])) {
					$directory = str_replace ('/admin/', '', DIR_APPLICATION);
					$this->dissallow_dir = array(
						DIR_IMAGE,
						DIR_STORAGE,
					);
					$data['module_search'] = $this->moduleSearch($directory, $directory, $data['module_name']);
					$data['module_total' ] = count ($data['module_search']);
				}				
			}
			
			if ($this->validate() && isset ($this->request->post['module_search']) && is_array ($this->request->post['module_search'])) {
				$this->moduleExtract($this->request->post['module_search'], $data);
			}
		}
		
		if (isset ($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		}
		
		if (isset ($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];
			unset ($this->session->data['success']);
		}
		
		$data['modules'] = $this->url->link('extension/module/module_extract', 'user_token=' . $this->session->data['user_token'] . '&page=MODULES_EXTRACT', 'SSL');

		$this->setTplRender($data);
	}

	public function download() {
		if (isset($this->request->get['file'])) {
			$file_zip = DIR_DOWNLOAD . 'module_extract/' . $this->request->get['file'];
			if (is_file($file_zip)) {
				header('Content-Type: application/octet-stream');
				header('Content-Disposition: attachment; filename="' . $this->request->get['file'] . '"');
				header('Expires: 0');
				header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
				header('Pragma: public');
				header('Content-Length: ' . filesize($file_zip));
				if (ob_get_level()) ob_end_clean();
				readfile($file_zip);
				exit;
			}
			
		}
	}
	private function moduleList() {
		$modules = array ();
		$files = glob ($this->validateDir() . '*');
		
		foreach ($files as $file) {
			$info = pathinfo ($file);
			$stat = stat ($file);
	
			$link = $this->url->link('extension/module/module_extract/download', 'file=' . $info['basename'] . '&user_token=' . $this->session->data['user_token'], 'SSL');
	
			$modules[] = array (
				'file' => $file,
				'link' => $link,
				'name' => $info['basename'],
				'size' => round (($stat['size'] / 1024), 2),
				'date' => date ('d-m-Y H:i:s', $stat['ctime'])
			);
		}
		
		asort ($modules);
		return $modules;
	}
	
	private function moduleSearch($dir, $dir_, $module_name) {
		static $files = array ();
		$s = '/';
		
		if (is_dir($dir) && $handle = opendir ($dir)) {
			while (FALSE !== ($file = readdir ($handle))) {
				if ($file[0] != '.') {
					$f_name = $dir . $s . $file . $s;
					if (in_array($f_name, $this->dissallow_dir)) {
						continue;
					}
					$f_name = $dir . $s . $file;
					if (is_dir ($f_name)) {
						$files = array_merge ($this->moduleSearch($f_name, $dir_, $module_name), $files);
					} elseif (preg_match ('/'. $module_name . '/', $file)) {
						$info = pathinfo ($dir . $s . $file);
						if (!isset ($files[$info['filename']])) {
							$files[$info['filename']] = array ('module' => $info['filename'], 'files' => array ());
						}
						$files[$info['filename']]['files'][] = array (
							'name' => $dir . $s . $file,
							'path' => str_replace ($dir_, FALSE, $dir),
							'file' => $file
						);
					}
				}
			}
			
			closedir($handle);
		}
		
		return $files;
	}
	
	private function moduleExtract ($module_search, $data) {
		if (class_exists ('ZipArchive')) {

			$dir = $this->validateDir() . $data['module_name'] . '.' . time() . '.' . md5 ($data['module_name']) . '.zip';
			$zip = new ZipArchive();
			if ($zip->open($dir, ZIPARCHIVE::CREATE) !== true) {
				$this->error['warning'] = $this->language->get('error_creat_zip');
			}

			$dir = explode('/', DIR_APPLICATION);
			$dir = array_splice($dir,0,-2);
			array_shift($dir);
			$directory = implode('/',$dir);
					
			foreach ($module_search as $modules) {
				$dir_zip = FALSE;
				$info    = pathinfo ($modules);
				$folders = explode ('/', $info['dirname']);
				
				for ($i = 1; $i < count ($folders); $i++) {
					$dir_zip .= $folders[$i] . '/';
				}
				$dir_replace = 'upload' . str_replace($directory,'', $dir_zip);
				$zip->addFile($modules, $dir_replace . $info['basename']);
			}
			$zip->close();
			
			$this->session->data['success'] = str_replace ('{NAME}', $data['module_name'], $this->language->get('success_extract'));
			$this->setRedirect($this->url->link('extension/module/module_extract', 'user_token=' . $this->session->data['user_token'], 'SSL'));
		} else {
			$this->error['warning'] = $this->language->get('error_class_zip');
		}
	}
	
	private function validateDir() {
		$dir = DIR_DOWNLOAD . '/module_extract';
		if (!is_dir ($dir)) {
			mkdir ($dir);
		}
		return $dir . '/';
	}
	
	private function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/module_extract')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}
	
    public function setTplRender($data) {
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		
		$this->response->setOutput($this->load->view('extension/module/module_extract', $data));
	}

    public function setRedirect($link) {
		$this->response->redirect($link);
	}

    public function getOcVersion() {
        $version = 0;
		$version = explode('.', VERSION); 
        $ocVersion = floatval($version[0].$version[1].$version[2].'.'.(isset($version[3]) ? $version[3] : 0));
		
		return $ocVersion;
	}
}