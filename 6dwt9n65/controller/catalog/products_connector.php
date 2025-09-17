<?php
require_once(DIR_SYSTEM . 'library/remote_db.php');

class ControllerCatalogProductsConnector extends Controller
{
    var $remoteDb;
    var $remoteLang;

    public function __construct($params)
    {
        parent::__construct($params);
        $this->remoteDb = new RemoteDB(REMOTE_DB_HOSTNAME, REMOTE_DB_USERNAME, REMOTE_DB_PASSWORD, REMOTE_DB_DATABASE);
        $this->remoteLang = 1;
    }

    public function index()
    {
        $this->load->language('catalog/products_connector');
        $this->document->setTitle($this->language->get('heading_title'));
        $this->load->model('catalog/product');
        $this->getList();
    }

    private function getList()
    {

        $data = array();
        $products = $this->model_catalog_product->getProducts(['sort' => "p.product_id", 'order' => 'ASC']);

        if ($products) {
            foreach ($products as $product) {
                $options = $this->model_catalog_product->getProductOptions($product['product_id']);
                $formated_options = [];
                if ($options) {
                    foreach ($options as $option) {
                        if ($option['product_option_value']) {
                            foreach ($option['product_option_value'] as $option_value) {

                                $option_value = $this->model_catalog_product->getProductOptionValue($product['product_id'], $option_value['product_option_value_id']);
                                $connected_product =  $this->db->query("SELECT remote_product_id, remote_option_value_id FROM " . DB_PREFIX . "product_connected WHERE product_id = '" . (int)$product['product_id'] . "' AND option_value_id ='" . (int)$option_value['option_value_id'] . "'");
                                if ($connected_product) {
                                    $option_value['connected_product'] = $connected_product->row;
                                }
                                $formated_options[] = $option_value;
                            }
                        }
                    }
                }


                $data['products'][] = [
                    'product_id' => $product['product_id'],
                    'name' => $product['name'],
                    'options' => $formated_options,
                ];
            }
        }

        $data['remote_products'] = $this->getListRemote();
        $data['user_token'] = $this->session->data['user_token'];
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');
        $data['text_list'] = $this->language->get('table_title');
        $data['error_warning'] = false;
        $data['success'] = false;
        $this->remoteDb->close();
        $this->response->addHeader('Expires: 0');
        $this->response->addHeader('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
        $this->response->addHeader('Cache-Control: post-check=0, pre-check=0', false);
        $this->response->addHeader('Pragma: no-cache');
        $this->response->setOutput($this->load->view('catalog/products_connector_list', $data));
    }

    private function getListRemote()
    {
        $products =  $this->getProductsRemote();

        if ($products) {
            foreach ($products as $product) {
                $options = $this->getProductOptionsRemote($product['product_id']);
                $formated_options = [];
                if ($options) {
                    foreach ($options as $option) {
                        if ($option['product_option_value']) {
                            foreach ($option['product_option_value'] as $option_value) {
                                $options_values = $this->getProductOptionValueRemote($product['product_id'], $option_value['product_option_value_id']);
                                $formated_options[] = $options_values[0];
                            }
                        }
                    }
                }
                $data['products'][] = [
                    'product_id' => $product['product_id'],
                    'name' => $product['name'],
                    'options' => $formated_options
                ];
            }

            return $data['products'];
        }
    }

    private function getProductsRemote()
    {
        return $this->remoteDb->query("SELECT p.product_id, pd.name FROM " . REMOTE_DB_PREFIX . "product p LEFT JOIN " . REMOTE_DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) WHERE pd.language_id = 1 ORDER BY p.product_id ASC");
    }

    private function getProductOptionsRemote($product_id)
    {

        $product_option_data = array();

        $product_option_query = $this->remoteDb->query("SELECT * FROM `" . REMOTE_DB_PREFIX . "product_option` po LEFT JOIN `" . REMOTE_DB_PREFIX . "option` o ON (po.option_id = o.option_id) LEFT JOIN `" . REMOTE_DB_PREFIX . "option_description` od ON (o.option_id = od.option_id) WHERE po.product_id = '" . (int)$product_id . "' AND od.language_id = 1");

        foreach ($product_option_query as $product_option) {
            $product_option_value_data = array();

            $product_option_value_query = $this->remoteDb->query("SELECT * FROM " . REMOTE_DB_PREFIX . "product_option_value pov LEFT JOIN " . DB_PREFIX . "option_value ov ON(pov.option_value_id = ov.option_value_id) WHERE pov.product_option_id = '" . (int)$product_option['product_option_id'] . "' ORDER BY ov.sort_order ASC");

            foreach ($product_option_value_query as $product_option_value) {
                $product_option_value_data[] = array(
                    'product_option_value_id' => $product_option_value['product_option_value_id'],
                    'option_value_id'         => $product_option_value['option_value_id'],
                    'quantity'                => $product_option_value['quantity'],
                    'subtract'                => $product_option_value['subtract'],
                    'price'                   => $product_option_value['price'],
                    'price_prefix'            => $product_option_value['price_prefix'],
                    'points'                  => $product_option_value['points'],
                    'points_prefix'           => $product_option_value['points_prefix'],
                    'weight'                  => $product_option_value['weight'],
                    'weight_prefix'           => $product_option_value['weight_prefix']
                );
            }

            $product_option_data[] = array(
                'product_option_id'    => $product_option['product_option_id'],
                'product_option_value' => $product_option_value_data,
                'option_id'            => $product_option['option_id'],
                'name'                 => $product_option['name'],
                'type'                 => $product_option['type'],
                'value'                => $product_option['value'],
                'required'             => $product_option['required']
            );
        }

        return $product_option_data;
    }

    private function getProductOptionValueRemote($product_id, $product_option_value_id)
    {
        return $this->remoteDb->query("SELECT pov.option_value_id, ovd.name, pov.quantity, pov.subtract, pov.price, pov.price_prefix, pov.points, pov.points_prefix, pov.weight, pov.weight_prefix FROM " . REMOTE_DB_PREFIX . "product_option_value pov LEFT JOIN " . REMOTE_DB_PREFIX . "option_value ov ON (pov.option_value_id = ov.option_value_id) LEFT JOIN " . REMOTE_DB_PREFIX . "option_value_description ovd ON (ov.option_value_id = ovd.option_value_id) WHERE pov.product_id = '" . (int)$product_id . "' AND pov.product_option_value_id = '" . (int)$product_option_value_id . "' AND ovd.language_id = '1'");
    }

    public function save()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get the JSON data from the request body
            $jsonData = file_get_contents('php://input');

            // Decode the JSON data into a PHP array
            $data = json_decode($jsonData, true);

            // Check if JSON decoding was successful
            if ($data === null) {
                // Handle JSON decoding error
                // For example, return an error response or log the error
                http_response_code(400);
                echo json_encode(array('error' => 'Invalid JSON data'));
                exit;
            }
            $sql = [];
            // Example usage of received data
            foreach ($data as $rowData) {
                $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_connected WHERE product_id = '" . (int)$rowData['product_id'] . "' AND option_id = '14' AND option_value_id = '" . (int)$rowData['option_value_id'] . "'");

                if (!$query->rows) {
                    $this->db->query("INSERT INTO " . DB_PREFIX . "product_connected  (product_id, option_id, option_value_id, remote_product_id, remote_option_id, remote_option_value_id) VALUES('" . (int)$rowData['product_id'] . "', '14', '" . (int)$rowData['option_value_id'] . "', '" . (int)$rowData['remote_product_id'] . "', '14', '" . (int)$rowData['remote_option_value_id'] . "')");
                } else {
                    $this->db->query("UPDATE " . DB_PREFIX . "product_connected SET remote_product_id = '" . (int)$rowData['remote_product_id'] . "', remote_option_id = '14', remote_option_value_id = '" . (int)$rowData['remote_option_value_id'] . "' WHERE product_id = '" . (int)$rowData['product_id'] . "' AND option_id = '14' AND option_value_id = '" . (int)$rowData['option_value_id'] . "'");
                }
            }

            // Once you've processed the data, you can send a response if needed
            // For example, you can return a success message
            die(json_encode(array('message' => 'Data received successfully', 'data' => $sql)));
        }
    }
}
