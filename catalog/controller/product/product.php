<?php
 
class ControllerProductProduct extends Controller {
	private $error = array();

	public function index() {
		/* SETTINGS */
		$all_products_category_id = 59;
		$dose_attribute_id = 12;
		
		$this->document->addStyle($this->config->get('config_url') . 'catalog/view/theme/default/stylesheet/font-awsome.min.css');
		$this->load->language('product/product');

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$this->load->model('catalog/category');

		if (isset($this->request->get['path'])) {
			$path = '';

			$parts = explode('_', (string)$this->request->get['path']);

			$category_id = (int)array_pop($parts);

			foreach ($parts as $path_id) {
				if (!$path) {
					$path = $path_id;
				} else {
					$path .= '_' . $path_id;
				}

				$category_info = $this->model_catalog_category->getCategory($path_id);

				if ($category_info) {
					$data['breadcrumbs'][] = array(
						'text' => $category_info['name'],
						'href' => $this->url->link('product/category', 'path=' . $path)
					);
				}
			}

			// Set the last category breadcrumb
			$category_info = $this->model_catalog_category->getCategory($category_id);

			if ($category_info) {
				$url = '';

				if (isset($this->request->get['sort'])) {
					$url .= '&sort=' . $this->request->get['sort'];
				}

				if (isset($this->request->get['order'])) {
					$url .= '&order=' . $this->request->get['order'];
				}

				if (isset($this->request->get['page'])) {
					$url .= '&page=' . $this->request->get['page'];
				}

				if (isset($this->request->get['limit'])) {
					$url .= '&limit=' . $this->request->get['limit'];
				}

				$data['breadcrumbs'][] = array(
					'text' => $category_info['name'],
					'href' => $this->url->link('product/category', 'path=' . $this->request->get['path'] . $url)
				);
			}
		}

		$this->load->model('catalog/manufacturer');

		if (isset($this->request->get['manufacturer_id'])) {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_brand'),
				'href' => $this->url->link('product/manufacturer')
			);

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$manufacturer_info = $this->model_catalog_manufacturer->getManufacturer($this->request->get['manufacturer_id']);

			if ($manufacturer_info) {
				$data['breadcrumbs'][] = array(
					'text' => $manufacturer_info['name'],
					'href' => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $this->request->get['manufacturer_id'] . $url)
				);
			}
		}

		if (isset($this->request->get['search']) || isset($this->request->get['tag'])) {
			$url = '';

			if (isset($this->request->get['search'])) {
				$url .= '&search=' . $this->request->get['search'];
			}

			if (isset($this->request->get['tag'])) {
				$url .= '&tag=' . $this->request->get['tag'];
			}

			if (isset($this->request->get['description'])) {
				$url .= '&description=' . $this->request->get['description'];
			}

			if (isset($this->request->get['category_id'])) {
				$url .= '&category_id=' . $this->request->get['category_id'];
			}

			if (isset($this->request->get['sub_category'])) {
				$url .= '&sub_category=' . $this->request->get['sub_category'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_search'),
				'href' => $this->url->link('product/search', $url)
			);
		}

		if (isset($this->request->get['product_id'])) {
			$product_id = (int)$this->request->get['product_id'];
		} else {
			$product_id = 0;
		}

		$this->load->model('catalog/product');

		$product_info = $this->model_catalog_product->getProduct($product_id);

		if ($product_info) {
			$url = '';

			if (isset($this->request->get['path'])) {
				$url .= '&path=' . $this->request->get['path'];
			}

			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}

			if (isset($this->request->get['manufacturer_id'])) {
				$url .= '&manufacturer_id=' . $this->request->get['manufacturer_id'];
			}

			if (isset($this->request->get['search'])) {
				$url .= '&search=' . $this->request->get['search'];
			}

			if (isset($this->request->get['tag'])) {
				$url .= '&tag=' . $this->request->get['tag'];
			}

			if (isset($this->request->get['description'])) {
				$url .= '&description=' . $this->request->get['description'];
			}

			if (isset($this->request->get['category_id'])) {
				$url .= '&category_id=' . $this->request->get['category_id'];
			}

			if (isset($this->request->get['sub_category'])) {
				$url .= '&sub_category=' . $this->request->get['sub_category'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$data['breadcrumbs'][] = array(
				'text' => $product_info['name'],
				'href' => $this->url->link('product/product', $url . '&product_id=' . $this->request->get['product_id'])
			);

			$this->document->setTitle(htmlspecialchars_decode($product_info['meta_title']));
			$this->document->setDescription(htmlspecialchars_decode($product_info['meta_description']));
			$this->document->setKeywords($product_info['meta_keyword']);
			$this->document->addLink($this->url->link('product/product', 'product_id=' . $this->request->get['product_id']), 'canonical');
			$this->document->addScript('catalog/view/javascript/jquery/magnific/jquery.magnific-popup.min.js');
			$this->document->addStyle('catalog/view/javascript/jquery/magnific/magnific-popup.css');
			$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/moment/moment.min.js');
			$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/moment/moment-with-locales.min.js');
			$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js');
			$this->document->addStyle('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css');

			$data['heading_title'] = $product_info['name'];
			$data['custom_h1'] = $product_info['custom_h1'];

			$data['text_minimum'] = sprintf($this->language->get('text_minimum'), $product_info['minimum']);
			$data['text_login'] = sprintf($this->language->get('text_login'), $this->url->link('account/login', '', true), $this->url->link('account/register', '', true));

			$this->load->model('catalog/review');

			$data['tab_review'] = sprintf($this->language->get('tab_review'), $product_info['reviews']);

			$data['product_id'] = (int)$this->request->get['product_id'];
			$data['manufacturer'] = $product_info['manufacturer'];
			$data['manufacturers'] = $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $product_info['manufacturer_id']);
			$data['model'] = $product_info['model'];
		
			$data['reward'] = $product_info['reward'];
			$data['points'] = $product_info['points'];
			$data['description'] = html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8');
			$data['description_bottom'] = html_entity_decode($product_info['description_bottom'], ENT_QUOTES, 'UTF-8');

			$data['text_out_of_stock'] = $this->language->get('text_out_of_stock');
			if ($product_info['quantity'] <= 0) {
				$data['stock'] = $product_info['stock_status'];
			} elseif ($this->config->get('config_stock_display')) {
				$data['stock'] = $product_info['quantity'];
			} else {
				$data['stock'] = $this->language->get('text_instock');
			}

			$data['quantity'] = $product_info['quantity'];

			$this->load->model('tool/image');

			if ($product_info['image']) {
				$data['popup'] = $this->model_tool_image->resize($product_info['image'], $this->config->get('theme_' . $this->config->get('config_theme') . '_image_popup_width'), $this->config->get('theme_' . $this->config->get('config_theme') . '_image_popup_height'));
			} else {
				$data['popup'] = '';
			}

			if ($product_info['image']) {
				$data['thumb'] = $this->model_tool_image->resize($product_info['image'], $this->config->get('theme_' . $this->config->get('config_theme') . '_image_thumb_width'), $this->config->get('theme_' . $this->config->get('config_theme') . '_image_thumb_height'));
			} else {
				$data['thumb'] = '';
			}

			$data['images'] = array();

			$results = $this->model_catalog_product->getProductImages($this->request->get['product_id']);

			foreach ($results as $result) {
				$data['images'][] = array(
					'popup' => $this->model_tool_image->resize($result['image'], $this->config->get('theme_' . $this->config->get('config_theme') . '_image_popup_width'), $this->config->get('theme_' . $this->config->get('config_theme') . '_image_popup_height')),
					'thumb' => $this->model_tool_image->resize($result['image'], $this->config->get('theme_' . $this->config->get('config_theme') . '_image_additional_width'), $this->config->get('theme_' . $this->config->get('config_theme') . '_image_additional_height'))
				);
			}

			if ($this->customer->isLogged() || !$this->config->get('config_customer_price')) {
				$data['price'] = $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
			} else {
				$data['price'] = false;
			}

			if ((float)$product_info['special']) {
				$data['special'] = $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
			} else {
				$data['special'] = false;
			}

			if ($this->config->get('config_tax')) {
				$data['tax'] = $this->currency->format((float)$product_info['special'] ? $product_info['special'] : $product_info['price'], $this->session->data['currency']);
			} else {
				$data['tax'] = false;
			}

			$discounts = $this->model_catalog_product->getProductDiscounts($this->request->get['product_id']);

			$data['discounts'] = array();

			foreach ($discounts as $discount) {
				$data['discounts'][] = array(
					'quantity' => $discount['quantity'],
					'price'    => $this->currency->format($this->tax->calculate($discount['price'], $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency'])
				);
			}
			 
			$data['options'] = [];
			$options = $this->model_catalog_product->getProductOptions($this->request->get['product_id']);
 
			$pricelist = [];
			foreach ($options as $i => $option) {
				$product_option_value_data = array();
	 
				foreach ($option['product_option_value'] as $option_value) {
					if (!$option_value['subtract'] || ($option_value['quantity'] > 0)) {
						if ((($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) && (float)$option_value['price']) {
							$price = $this->currency->format($this->tax->calculate($option_value['price'], $product_info['tax_class_id'], $this->config->get('config_tax') ? 'P' : false), $this->session->data['currency']);
							$pricelist[] = (float)$option_value['price'];
						} else {
							$price = false;
						}
			
						$option_name = explode(' ', trim($option_value['name']));
						$items_qnt = (int)$option_name[0];
						$items_name = $option_name[1];
						$price_per_item = (float)$option_value['price'] / (int)$items_qnt;

						// sachets or pills
						$text_per_item = preg_match('/\bsachets\b/', strtolower($items_name)) ? $this->language->get('text_per_bag') : $this->language->get('text_per_pill');
if($option_value['x2']){
	$text_x2_sale =  sprintf($this->language->get('text_x2_sale'), $items_qnt);
} else{
	$text_x2_sale = '';
}
						$product_option_value_data[$option_value['option_value_id']] = array(
							'product_option_value_id' => $option_value['product_option_value_id'],
							'option_value_id'         => $option_value['option_value_id'],
							'name'                    => $option_value['name'],
							'image'                   => $this->model_tool_image->resize($option_value['image'], 50, 50),
							'price'                   => $price,
							'price_raw'               => $option_value['price'],
							'price_prefix'            => $option_value['price_prefix'],
							'price_per_item'		  => $this->currency->format($this->tax->calculate($price_per_item, $product_info['tax_class_id'], $this->config->get('config_tax') ? 'P' : false), $this->session->data['currency']),
							'price_per_item_raw'	  => $price_per_item,
						 	'text_per_item'		      => $text_per_item,
							'items_in_pack'			  => $items_qnt,
							'text_x2_sale'			=> $text_x2_sale,
							'x2' 				  => $option_value['x2'],
							'quantity' 				  => $option_value['quantity']
						);
					}
				}


				$data['options'][$option['option_id']] = array(
					'product_option_id'    => $option['product_option_id'],
					'product_option_value' => $product_option_value_data,
					'option_id'            => $option['option_id'],
					'name'                 => $option['name'],
					'type'                 => $option['type'],
					'value'                => $option['value'],
					'required'             => $option['required']
				);

			}

			if ($product_info['minimum']) {
				$data['minimum'] = $product_info['minimum'];
			} else {
				$data['minimum'] = 1;
			}

			$data['review_status'] = $this->config->get('config_review_status');

			if ($this->config->get('config_review_guest') || $this->customer->isLogged()) {
				$data['review_guest'] = true;
			} else {
				$data['review_guest'] = false;
			}

			if ($this->customer->isLogged()) {
				$data['customer_name'] = $this->customer->getFirstName() . '&nbsp;' . $this->customer->getLastName();
			} else {
				$data['customer_name'] = '';
			}

			if ((int)$product_info['reviews'] > 0) {
				$data['reviews'] = sprintf($this->language->get('text_reviews'), (int)$product_info['reviews'], $product_info['name']);
			} else {
				$data['reviews'] = '';
			}
			$data['rating'] = (int)$product_info['rating'];

			// Captcha
			if ($this->config->get('captcha_' . $this->config->get('config_captcha') . '_status') && in_array('review', (array)$this->config->get('config_captcha_page'))) {
				$data['captcha'] = $this->load->controller('extension/captcha/' . $this->config->get('config_captcha'));
			} else {
				$data['captcha'] = '';
			}

			$jsonld = [
				"@context" => "https://www.schema.org",
				"@type" => "product",
				"name" => $product_info['name'],
				"image" => $data['images'][0]['popup'],
				"description" => strip_tags(html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8')),
			];

			if (!empty($pricelist)) {
				$jsonld["offers"] = [
					"@type"=> "Offer",
					"priceCurrency" => "EUR",
					"price" => min($pricelist),
					"priceValidUntil" => date("Y-m-d"),
					"itemCondition" => "https://schema.org/NewCondition",
					"availability"  =>  $product_info['quantity'] <= 0 ? "https://schema.org/OutOfStock" : "http://schema.org/InStock",
					"seller" => [
						"@type" => "Organization",
						"name" => "manpharma.de"
					],
					"shippingDetails" => [
						"@type" => "OfferShippingDetails",
						"shippingRate" => [
							"@type" => "MonetaryAmount",
							"value" => "10.00",
							"currency" => "EUR"
						],
						"shippingDestination" => [
							"@type" => "DefinedRegion",
							"addressCountry" => "EU"
						],
						"deliveryTime" => [
							"@type" => "ShippingDeliveryTime",
							"handlingTime" => [
							  "@type" => "QuantitativeValue",
							  "minValue" => 0,
							  "maxValue" => 1,
							  "unitCode" => "DAY"
							],
							"transitTime" => [
							  "@type" => "QuantitativeValue",
							  "minValue" => 7,
							  "maxValue" => 10,
							  "unitCode" => "DAY"
							]
						]
				
					],
					"hasMerchantReturnPolicy" => [
						"@type" => "MerchantReturnPolicy",
						"applicableCountry" => "EU",
						"returnPolicyCategory"=> "https://schema.org/MerchantReturnFiniteReturnWindow",
						"merchantReturnDays" => 30,
						"returnMethod" => "https://schema.org/ReturnByMail",
						"returnFees" => "https://schema.org/FreeReturn"
					]
				];
			}

			if (!empty($product_info['manufacturer'])) {
				$jsonld["brand"] = [
					"@type" => "Brand",
					"name" => $product_info['manufacturer']
				];
			}

			if ((int)$product_info['reviews'] > 0) {
				$jsonld["aggregateRating"] = [
					"@type" => "aggregateRating",
					"ratingValue" => (int)$data['rating'],
					"reviewCount" => (int)$product_info['reviews'],
				];
			}
			$data['jsonld'] = json_encode($jsonld, JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT);


            $data['product'] = [
                'href' => $this->url->link('product/product', 'product_id=' . $product_id),
                'name' => $product_info['name'],
                'image' => $product_info['image'],
                'description' => $product_info['description'],
                'sku' => $product_info['sku'],
                'mpn' => $product_info['mpn'],
                'manufacturer' => $product_info['manufacturer'],
                'price' => $product_info['price'],
                'price_valid_until' => $product_info['price_valid_until'] ?? null,
                'stock' => $product_info['quantity'] > 0,
                'rating' => $product_info['rating'],
                'reviews' => $product_info['reviews']
            ];

            $data['reviews'] = $this->model_catalog_review->getReviewsByProductId($product_id);
            $data['base'] = $this->config->get('config_url');
            $data['language_code'] = $this->session->data['language'];

			$data['text_package_delivery']   =  $this->language->get('text_package_delivery');
			$data['text_next_purchase']      =  $this->language->get('text_next_purchase');
			$data['text_you_save']           =  $this->language->get('text_you_save');
			$data['text_select_dose']        =  $this->language->get('text_select_dose');


			$data['share'] = $this->url->link('product/product', 'product_id=' . (int)$this->request->get['product_id']);
			$data['doses'] = [];
			$data['attribute_groups'] = $this->model_catalog_product->getProductAttributes($this->request->get['product_id']);
			
			/* If product grouped by dose */
			if (isset($category_id) && $category_id != $all_products_category_id) {
				$all_doses = $this->model_catalog_product->getProductsList($category_id);
			} elseif (isset($category_id) && $category_id == $all_products_category_id) {
				$all_doses[] = [
					'product_id' => $this->request->get['product_id'],
					'name' => $product_info['name'],
				];
			}

            $current_product = $this->model_catalog_product->getProduct($data['product_id']);
            $current_name = $current_product['name'];
            $base_name = trim(preg_replace('/\d+\s?mg/i', '', $current_name));
            $filtered_doses = [];
            if ($all_doses) {
                foreach ($all_doses as $dose) {
                    $dose_name_clean = preg_replace('/\d+\s?mg/i', '', $dose['name']);
                    if (strcasecmp($dose_name_clean, $base_name) === 0) {
                        $filtered_doses[] = $dose;
                    }
                }
            }

            if ($filtered_doses) {
                foreach ($filtered_doses as $dose) {
                    $dose_attribute_groups = $this->model_catalog_product->getProductAttributes($dose["product_id"]);
                    foreach ($dose_attribute_groups as $attibute_group) {
                        foreach ($attibute_group['attribute'] as $attribute) {
                            if ($attribute['attribute_id'] == $dose_attribute_id ) {
                                $active = $dose["product_id"] == $this->request->get['product_id'];
                                $name = $attribute['text'] ? $attribute['text'] : $dose["name"];
                                if ($active) {
                                    $data['dose_current'] = $name;
                                }
                                $data['doses'][] = [
                                    'active' => $active,
                                    'text' => $attribute['text'] ? $attribute['text'] : $dose["name"],
                                    'href' => $this->url->link('product/product', 'product_id=' . (int)$dose["product_id"])
                                ];
                            }
                        }
                    }
                }
            }
            $data['doses_count'] = count($data['doses']);

			$data['products'] = array();

			$results = $this->model_catalog_product->getProductRelated($this->request->get['product_id']);

			foreach ($results as $result) {
				if ($result['image']) {
					$image = $this->model_tool_image->resize($result['image'], $this->config->get('theme_' . $this->config->get('config_theme') . '_image_related_width'), $this->config->get('theme_' . $this->config->get('config_theme') . '_image_related_height'));
				} else {
					$image = $this->model_tool_image->resize('placeholder.png', $this->config->get('theme_' . $this->config->get('config_theme') . '_image_related_width'), $this->config->get('theme_' . $this->config->get('config_theme') . '_image_related_height'));
				}

				if ($this->customer->isLogged() || !$this->config->get('config_customer_price')) {
					$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
				} else {
					$price = false;
				}

				if ((float)$result['special']) {
					$special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
				} else {
					$special = false;
				}

				if ($this->config->get('config_tax')) {
					$tax = $this->currency->format((float)$result['special'] ? $result['special'] : $result['price'], $this->session->data['currency']);
				} else {
					$tax = false;
				}

				if ($this->config->get('config_review_status')) {
					$rating = (int)$result['rating'];
				} else {
					$rating = false;
				}

				$data['products'][] = array(
					'product_id'  => $result['product_id'],
					'thumb'       => $image,
					'name'        => $result['name'],
					'description' => utf8_substr(trim(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8'))), 0, $this->config->get('theme_' . $this->config->get('config_theme') . '_product_description_length')) . '..',
					'price'       => $price,
					'special'     => $special,
					'tax'         => $tax,
					'minimum'     => $result['minimum'] > 0 ? $result['minimum'] : 1,
					'rating'      => $rating,
					'href'        => $this->url->link('product/product', 'product_id=' . $result['product_id'])
				);
			}

			$data['tags'] = array();

			if ($product_info['tag']) {
				$tags = explode(',', $product_info['tag']);

				foreach ($tags as $tag) {
					$data['tags'][] = array(
						'tag'  => trim($tag),
						'href' => $this->url->link('product/search', 'tag=' . trim($tag))
					);
				}
			}

			$data['recurrings'] = $this->model_catalog_product->getProfiles($this->request->get['product_id']);

			$this->model_catalog_product->updateViewed($this->request->get['product_id']);

			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');

			$this->response->setOutput($this->load->view('product/product', $data));
		} else {
 
			$this->response->redirect($this->url->link('common/home'), 301);
			// $url = '';

			// if (isset($this->request->get['path'])) {
			// 	$url .= '&path=' . $this->request->get['path'];
			// }

			// if (isset($this->request->get['filter'])) {
			// 	$url .= '&filter=' . $this->request->get['filter'];
			// }

			// if (isset($this->request->get['manufacturer_id'])) {
			// 	$url .= '&manufacturer_id=' . $this->request->get['manufacturer_id'];
			// }

			// if (isset($this->request->get['search'])) {
			// 	$url .= '&search=' . $this->request->get['search'];
			// }

			// if (isset($this->request->get['tag'])) {
			// 	$url .= '&tag=' . $this->request->get['tag'];
			// }

			// if (isset($this->request->get['description'])) {
			// 	$url .= '&description=' . $this->request->get['description'];
			// }

			// if (isset($this->request->get['category_id'])) {
			// 	$url .= '&category_id=' . $this->request->get['category_id'];
			// }

			// if (isset($this->request->get['sub_category'])) {
			// 	$url .= '&sub_category=' . $this->request->get['sub_category'];
			// }

			// if (isset($this->request->get['sort'])) {
			// 	$url .= '&sort=' . $this->request->get['sort'];
			// }

			// if (isset($this->request->get['order'])) {
			// 	$url .= '&order=' . $this->request->get['order'];
			// }

			// if (isset($this->request->get['page'])) {
			// 	$url .= '&page=' . $this->request->get['page'];
			// }

			// if (isset($this->request->get['limit'])) {
			// 	$url .= '&limit=' . $this->request->get['limit'];
			// }

			// $data['breadcrumbs'][] = array(
			// 	'text' => $this->language->get('text_error'),
			// 	'href' => $this->url->link('product/product', $url . '&product_id=' . $product_id)
			// );

			// $this->document->setTitle($this->language->get('text_error'));

			// $data['continue'] = $this->url->link('common/home');

			// $this->response->addHeader($this->request->server['SERVER_PROTOCOL'] . ' 404 Not Found');

			// $data['column_left'] = $this->load->controller('common/column_left');
			// $data['column_right'] = $this->load->controller('common/column_right');
			// $data['content_top'] = $this->load->controller('common/content_top');
			// $data['content_bottom'] = $this->load->controller('common/content_bottom');
			// $data['footer'] = $this->load->controller('common/footer');
			// $data['header'] = $this->load->controller('common/header');

			// $this->response->setOutput($this->load->view('error/not_found', $data));
		}
	}

	/**
	 * @param $product_price
	 * @param $option_price
	 * @param $option_prefix
	 * @param $quantity_in_name
	 *
	 * @return array
	 */
	private function getOptionPrice($product_price, $option_price, $option_prefix, $quantity_in_name ) {

		$quantity_in_pack = (float)$quantity_in_name == 0 ? 1 : (float)$quantity_in_name;
		$result = [
			'product_price' => $product_price,
			'option_price' => $option_price,
			'quantity_in_pack' => $quantity_in_pack,
		];

		if($option_price && $product_price) {
			if($option_prefix == '+') {
				$result['option_price'] = $product_price   + $option_price;
			} elseif ($option_prefix == '-') {
				$result['option_price'] = $product_price - $option_price;
			}
		}
		$result['option_price_for_item'] = $option_price / $result['quantity_in_pack'];
		$result['option_price'] = $this->currency->format($result['option_price'], $this->session->data['currency']);
		$result['option_price_for_item'] = $this->currency->format($result['option_price_for_item'], $this->session->data['currency']);
 
		return $result;
	}

	public function review() {
		$this->load->language('product/product');

		$this->load->model('catalog/review');

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$data['reviews'] = array();

		$review_total = $this->model_catalog_review->getTotalReviewsByProductId($this->request->get['product_id']);

		$results = $this->model_catalog_review->getReviewsByProductId($this->request->get['product_id'], ($page - 1) * 5, 5);

		foreach ($results as $result) {
			$data['reviews'][] = array(
				'author'     => $result['author'],
				'text'       => nl2br($result['text']),
				'rating'     => (int)$result['rating'],
				'date_added' => date($this->language->get('date_format_short'), strtotime($result['date_added']))
			);
		}

		$pagination = new Pagination();
		$pagination->total = $review_total;
		$pagination->page = $page;
		$pagination->limit = 5;
		$pagination->url = $this->url->link('product/product/review', 'product_id=' . $this->request->get['product_id'] . '&page={page}');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($review_total) ? (($page - 1) * 5) + 1 : 0, ((($page - 1) * 5) > ($review_total - 5)) ? $review_total : ((($page - 1) * 5) + 5), $review_total, ceil($review_total / 5));

		$this->response->setOutput($this->load->view('product/review', $data));
	}

	public function write() {
		$this->load->language('product/product');

		$json = array();

		if ($this->request->server['REQUEST_METHOD'] == 'POST') {
			if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 25)) {
				$json['error'] = $this->language->get('error_name');
			}

			if ((utf8_strlen($this->request->post['text']) < 25) || (utf8_strlen($this->request->post['text']) > 1000)) {
				$json['error'] = $this->language->get('error_text');
			}

			if (empty($this->request->post['rating']) || $this->request->post['rating'] < 0 || $this->request->post['rating'] > 5) {
				$json['error'] = $this->language->get('error_rating');
			}

			// Captcha
			if ($this->config->get('captcha_' . $this->config->get('config_captcha') . '_status') && in_array('review', (array)$this->config->get('config_captcha_page'))) {
				$captcha = $this->load->controller('extension/captcha/' . $this->config->get('config_captcha') . '/validate');

				if ($captcha) {
					$json['error'] = $captcha;
				}
			}

			if (!isset($json['error'])) {
				$this->load->model('catalog/review');

				$this->model_catalog_review->addReview($this->request->get['product_id'], $this->request->post);

				$json['success'] = $this->language->get('text_success');
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function getRecurringDescription() {
		$this->load->language('product/product');
		$this->load->model('catalog/product');

		if (isset($this->request->post['product_id'])) {
			$product_id = $this->request->post['product_id'];
		} else {
			$product_id = 0;
		}

		if (isset($this->request->post['recurring_id'])) {
			$recurring_id = $this->request->post['recurring_id'];
		} else {
			$recurring_id = 0;
		}

		if (isset($this->request->post['quantity'])) {
			$quantity = $this->request->post['quantity'];
		} else {
			$quantity = 1;
		}

		$product_info = $this->model_catalog_product->getProduct($product_id);

		$recurring_info = $this->model_catalog_product->getProfile($product_id, $recurring_id);

		$json = array();

		if ($product_info && $recurring_info) {
			if (!$json) {
				$frequencies = array(
					'day'        => $this->language->get('text_day'),
					'week'       => $this->language->get('text_week'),
					'semi_month' => $this->language->get('text_semi_month'),
					'month'      => $this->language->get('text_month'),
					'year'       => $this->language->get('text_year'),
				);

				if ($recurring_info['trial_status'] == 1) {
					$price = $this->currency->format($this->tax->calculate($recurring_info['trial_price'] * $quantity, $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
					$trial_text = sprintf($this->language->get('text_trial_description'), $price, $recurring_info['trial_cycle'], $frequencies[$recurring_info['trial_frequency']], $recurring_info['trial_duration']) . ' ';
				} else {
					$trial_text = '';
				}

				$price = $this->currency->format($this->tax->calculate($recurring_info['price'] * $quantity, $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);

				if ($recurring_info['duration']) {
					$text = $trial_text . sprintf($this->language->get('text_payment_description'), $price, $recurring_info['cycle'], $frequencies[$recurring_info['frequency']], $recurring_info['duration']);
				} else {
					$text = $trial_text . sprintf($this->language->get('text_payment_cancel'), $price, $recurring_info['cycle'], $frequencies[$recurring_info['frequency']], $recurring_info['duration']);
				}

				$json['success'] = $text;
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}
