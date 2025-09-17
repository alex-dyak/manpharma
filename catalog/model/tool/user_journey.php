<?php
class ModelToolUserJourney extends Model {
    // Проверяем, существует ли запись для текущей сессии
    public function checkSessionExists($user_ip) {
        $query = $this->db->query("SELECT * FROM user_journey WHERE user_ip = '" . $this->db->escape($user_ip) . "'");
        return $query->num_rows > 0;
    }

    // Добавляем запись о первом посещении
    public function addVisit($user_ip) {
        $this->db->query("INSERT INTO user_journey SET user_ip = '" . $this->db->escape($user_ip) . "', visit = 1");
    }

    // Устанавливаем флаг добавления товара в корзину
    public function setAddToCart($user_ip) {
        $this->db->query("UPDATE user_journey SET add_to_cart = 1 WHERE user_ip = '" . $this->db->escape($user_ip) . "'");
    }

    // Устанавливаем флаг начала оформления заказа (checkout)
    public function setCheckout($user_ip) {
        $this->db->query("UPDATE user_journey SET checkout = 1 WHERE user_ip = '" . $this->db->escape($user_ip) . "'");
    }

    // Устанавливаем флаг завершения заказа
    public function setCompleteOrder($user_ip) {
        $this->db->query("UPDATE user_journey SET complete_order = 1 WHERE user_ip = '" . $this->db->escape($user_ip) . "'");
    }
}