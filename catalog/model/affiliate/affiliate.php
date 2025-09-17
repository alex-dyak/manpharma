<?php
class ModelAffiliateAffiliate extends Model {
	public function getAffiliateByCode($code) {
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "affiliate WHERE code = '" . $this->db->escape($code) . "'");

        return $query->row;
    }	
}
?>