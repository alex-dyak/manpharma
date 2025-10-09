<?php

class ControllerCommonHeader extends Controller {
    private function isBot($user_agent) {
        $bots = [
            'Googlebot',
            'Bingbot',
            'Slurp',           // Yahoo
            'DuckDuckBot',
            'Baiduspider',
            'YandexBot',
            'Sogou',
            'Exabot',
            'facebot',
            'ia_archiver',     // Alexa
            'MJ12bot',         // Majestic-12
            'AhrefsBot',
            'SemrushBot',
            'DotBot',
            'SeznamBot',
            'Mediapartners-Google',
            'AdsBot-Google',
        ];
        foreach ($bots as $bot) {
            if (stripos($user_agent, $bot) !== false) {
                return true;
            }
        }

        return false;
    }
	public function index() {
        $this->load->model('tool/user_journey');

        $user_ip = $_SERVER['REMOTE_ADDR'];
        $user_agent = $_SERVER['HTTP_USER_AGENT'];

//        if ($this->isBot($user_agent)) {
//            return;
//        }
        if (!$this->model_tool_user_journey->checkSessionExists($user_ip)) {
            $this->model_tool_user_journey->addVisit($user_ip);
        }


		$data['checkout_page'] = isset($this->request->get['route']) && $this->request->get['route'] == 'extension/quickcheckout/checkout' ? true : false;
		// Analytics
		$this->load->model('setting/extension');

		$data['analytics'] = array();

		$analytics = $this->model_setting_extension->getExtensions('analytics');

		foreach ($analytics as $analytic) {
			if ($this->config->get('analytics_' . $analytic['code'] . '_status')) {
				$data['analytics'][] = $this->load->controller('extension/analytics/' . $analytic['code'], $this->config->get('analytics_' . $analytic['code'] . '_status'));
			}
		}

		if ($this->request->server['HTTPS']) {
			$server = $this->config->get('config_ssl');
		} else {
			$server = $this->config->get('config_url');
		}

		if (is_file(DIR_IMAGE . $this->config->get('config_icon'))) {
			$this->document->addLink($server . 'image/' . $this->config->get('config_icon'), 'icon');
		}

		$data['title'] = $this->document->getTitle();

		$data['base'] = $server;
		$data['description'] = $this->document->getDescription();
		$data['keywords'] = $this->document->getKeywords();
		$data['links'] = $this->document->getLinks();
		$data['styles'] = $this->document->getStyles();
		$data['scripts'] = $this->document->getScripts('header');
		$data['lang'] = $this->language->get('code');
		$data['direction'] = $this->language->get('direction');

		$data['name'] = $this->config->get('config_name');
		$data['logo_w'] = '178';
		$data['logo_h'] = '18';

		if (is_file(DIR_IMAGE . $this->config->get('config_logo'))) {
			$data['logo'] =  $this->model_tool_image->resize($this->config->get('config_logo'), $data['logo_w'], $data['logo_h']);
			$data['logo'] =  $this->model_tool_image->resize($this->config->get('config_logo'), $data['logo_w'], $data['logo_h']);

		} else {
			$data['logo'] = '';
		}
		$this->load->language('common/header');

		// Wishlist
		if ($this->customer->isLogged()) {
			$this->load->model('account/wishlist');

			$data['text_wishlist'] = sprintf($this->language->get('text_wishlist'), $this->model_account_wishlist->getTotalWishlist());
		} else {
			$data['text_wishlist'] = sprintf($this->language->get('text_wishlist'), (isset($this->session->data['wishlist']) ? count($this->session->data['wishlist']) : 0));
		}
		$data['text_org_microformat'] = $this->language->get('text_org_microformat');
        $data['schema_org_fallback_de'] = true;
        $data['route'] = $this->request->get['route'] ?? 'common/home';

        $canonical = $this->url->link($data['route'], '', true);
        $get_params = $this->request->get;
        unset($get_params['_route_'], $get_params['route']);

        if (!empty($get_params)) {
            $canonical = $this->url->link($data['route'], http_build_query($get_params), true);
        }
        $this->document->addLink($canonical, 'canonical');

        // ===== HREFLANG alternate links =====
        $hreflangsCustom = [];
        $languages = $this->model_localisation_language->getLanguages();
        $base_url = rtrim(HTTPS_SERVER ?: HTTP_SERVER, '/');

        if (!empty($languages) && is_array($languages)) {
            $route = $this->request->get['route'] ?? 'common/home';
            $get_params = $this->request->get;
            unset($get_params['_route_'], $get_params['route']);

            foreach ($languages as $lang) {
                if (empty($lang['status'])) continue;

                $code = strtolower($lang['code']);
                if (strpos($code, 'de') === 0) $hreflang_val = 'de-DE';
                elseif (strpos($code, 'en') === 0) $hreflang_val = 'en';
                elseif (strpos($code, 'fr') === 0) $hreflang_val = 'fr';
                else $hreflang_val = explode('-', $code)[0];

                if (!empty($get_params)) {
                    $lang_url = $this->url->link($route, http_build_query($get_params), true);
                } else {
                    $lang_url = $this->url->link($route, '', true);
                }

                if ($hreflang_val !== 'de-DE') {
                    $parsed = parse_url($lang_url);
                    $path = isset($parsed['path']) ? $parsed['path'] : '';
                    $lang_url = $parsed['scheme'] . '://' . $parsed['host'] . '/' . $hreflang_val . rtrim($path, '/');
                    if (!empty($parsed['query'])) $lang_url .= '?' . $parsed['query'];
                }

                $hreflangsCustom[] = [
                    'hreflang' => $hreflang_val,
                    'href' => $lang_url
                ];
            }

            // x-default
            $hreflangsCustom[] = [
                'hreflang' => 'x-default',
                'href' => $base_url . '/'
            ];
        }
        $data['hreflangsCustom'] = $hreflangsCustom;

        if ($this->session->data['language'] == 'de-de') {
            $information_id = $this->request->get['information_id'] ?? null;

            $schema_home     = $data['route'] == 'common/home';
            $schema_category = $data['route'] == 'product/category';
            $schema_product  = $data['route'] == 'product/product';
            $schema_contact  = $data['route'] == 'information/contact';
            $schema_about    = $data['route'] == 'information/information' && $information_id == '4';

            $data['schema_org_fallback_de'] = !(
                $schema_home ||
                $schema_category ||
                $schema_product ||
                $schema_contact ||
                $schema_about
            );
        }

        $data['text_logged'] = sprintf($this->language->get('text_logged'), $this->url->link('account/account', '', true), $this->customer->getFirstName(), $this->url->link('account/logout', '', true));

		$data['home'] = $this->url->link('common/home');
		$data['wishlist'] = $this->url->link('account/wishlist', '', true);
		$data['logged'] = $this->customer->isLogged();
		$data['account'] = $this->url->link('account/account', '', true);
		$data['register'] = $this->url->link('account/register', '', true);
		$data['login'] = $this->url->link('account/login', '', true);
		$data['order'] = $this->url->link('account/order', '', true);
		$data['transaction'] = $this->url->link('account/transaction', '', true);
		$data['download'] = $this->url->link('account/download', '', true);
		$data['logout'] = $this->url->link('account/logout', '', true);
		$data['shopping_cart'] = $this->url->link('checkout/cart');
		$data['checkout'] = $this->url->link('checkout/checkout', '', true);
		$data['contact'] = $this->url->link('information/contact');
		$data['telephone'] = $this->config->get('config_telephone');

		$data['about_us'] = $this->url->link('information/information', 'information_id=4');
		$data['faq'] = $this->url->link('information/information', 'information_id=6');

		// $data['hreflang'] = $this->load->controller('extension/module/ocd_hreflang');
		$data['language'] = $this->load->controller('common/language');
		$data['currency'] = $this->load->controller('common/currency');
		$data['search'] = $this->load->controller('common/search');
		$data['cart'] = $this->load->controller('common/cart');
		$data['menu'] = $this->load->controller('common/menu');
		$data['all_products'] = $this->load->controller('extension/module/all_products');

		return $this->load->view('common/header', $data);
	}
}
