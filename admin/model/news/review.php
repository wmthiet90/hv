<?php
class ModelNewsReview extends Model {
	public function addReview($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "news_review SET author = '" . $this->db->escape($data['author']) . "', article_id = '" . $this->db->escape($data['article_id']) . "', text = '" . $this->db->escape(strip_tags($data['text'])) . "', rating = '" . (int)$data['rating'] . "', status = '" . (int)$data['status'] . "', date_added = NOW()");

		$this->cache->delete('article');
	}

	public function editReview($review_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "news_review SET author = '" . $this->db->escape($data['author']) . "', article_id = '" . $this->db->escape($data['article_id']) . "', text = '" . $this->db->escape(strip_tags($data['text'])) . "', rating = '" . (int)$data['rating'] . "', status = '" . (int)$data['status'] . "', date_added = NOW() WHERE review_id = '" . (int)$review_id . "'");

		$this->cache->delete('article');
	}

	public function deleteReview($review_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "news_review WHERE review_id = '" . (int)$review_id . "'");

		$this->cache->delete('article');
	}

	public function getReview($review_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT ad.name FROM " . DB_PREFIX . "news_articles_description ad WHERE ad.article_id = r.article_id AND ad.language_id = '" . (int)$this->config->get('config_language_id') . "') AS article FROM " . DB_PREFIX . "news_review r WHERE r.review_id = '" . (int)$review_id . "'");

		return $query->row;
	}

	public function getReviews($data = array()) {
		$sql = "SELECT r.review_id, ad.name, r.author, r.rating, r.status, r.date_added FROM " . DB_PREFIX . "news_review r LEFT JOIN " . DB_PREFIX . "news_articles_description ad ON (r.article_id = ad.article_id) WHERE ad.language_id = '" . (int)$this->config->get('config_language_id') . "'";																																					  

		$sort_data = array(
			'ad.name',
			'r.author',
			'r.rating',
			'r.status',
			'r.date_added'
		);

		if (!empty($data['filter_date_added'])) {
				$sql .= " AND r.date_added LIKE '" . $this->db->escape($data['filter_date_added']) . "%'";
		}	

		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
				$sql .= " AND r.status = '" . (int)$data['filter_status'] . "'";
		}

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];	
		} else {
			$sql .= " ORDER BY r.date_added";	
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}			

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}	

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}																																							  

		$query = $this->db->query($sql);																																				

		return $query->rows;	
	}

	public function getTotalReviews() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "review");

		return $query->row['total'];
	}

	public function getTotalReviewsAwaitingApproval() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "news_review WHERE status = '0'");

		return $query->row['total'];
	}

	public function setApproval($review_id, $column_name, $value){
		$this->db->query("UPDATE " . DB_PREFIX . "news_review SET " . $column_name . " = '" . (int)$value . "' WHERE review_id = '" . (int)$review_id . "'");
	}
}
?>