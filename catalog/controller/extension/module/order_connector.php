<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once(DIR_SYSTEM . 'library/remote_db.php');

class ControllerExtensionModuleOrderConnector extends Controller
{
    var $remoteDb;
    var $remoteLang;

    public function __construct($params)
    {
        parent::__construct($params);
        $this->secret = '9jzevq04l0b8yadnqsxx1u2';
        $this->remoteDb = new RemoteDB(REMOTE_DB_HOSTNAME, REMOTE_DB_USERNAME, REMOTE_DB_PASSWORD, REMOTE_DB_DATABASE);
        $this->remoteLang = 1;
    }

    public function index()
    {
        $this->validateSecret();
        $this->load->model('checkout/order');

        $rows = $this->model_checkout_order->getCompletedOrders(5);

        if ($rows) {
            foreach ($rows as $row) {
                $order_id = $row['order_id'];
                $order = $this->model_checkout_order->getOrder($order_id);
                $products = $this->model_checkout_order->getOrderProducts($order_id);
                $products_remote = [];
                $create_remote_order = true;

                foreach ($products as $product) {

                    $options = $this->model_checkout_order->getOrderOptions($order_id, $product['order_product_id']);
                    foreach ($options as $option) {
                        // echo '<pre>';
                        // print_r($option);
                        // echo '</pre>';
                        $remote_product = $this->model_checkout_order->getConnectedProduct(14, $option['product_option_value_id']);
                        if ($remote_product) {
                            $products_remote[] = $remote_product;
                        } else {
                            $create_remote_order = false;
                            // ADD ERROR LOG HERE
                            echo "ORDER ID {$order_id} OPTION VALUE ID {$option['product_option_value_id']} IS NOT CONNECTED TO REMOTE OPTION <br>";
                        }
                    }
                }

                if ($create_remote_order) {
                    echo '<pre>';
                    print_r($products_remote);
                    echo '</pre>';
                }
            }
        }
    }


    private function validateSecret()
    {
        if (!$this->request->get['s'] || $this->request->get['s'] != $this->secret) {

            $this->response->redirect($this->url->link('common/home'), 301);
        }
    }
}
