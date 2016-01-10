<?php
class ModelNewsArticle extends Model {

	public function updateViewed($article_id) {
		$this->db->query("UPDATE " . DB_PREFIX . "news_articles SET viewed = (viewed + 1) WHERE article_id = '" . (int)$article_id . "'");
	}

	public function checkAccess(){
		if($this->customer->isLogged()){
            return 1;
        } else {
            return 0;
        }
	}
	
	public function getArticle($article_id) {

		$sql = "SELECT DISTINCT *, pd.name AS name, p.image, (SELECT AVG(rating) AS total FROM " . DB_PREFIX . "news_review r1 WHERE r1.article_id = p.article_id AND r1.status = '1' GROUP BY r1.article_id) AS rating, (SELECT COUNT(*) AS total FROM " . DB_PREFIX . "news_review r2 WHERE r2.article_id = p.article_id AND r2.status = '1' GROUP BY r2.article_id) AS reviews, p.sort_order FROM " . DB_PREFIX . "news_articles p LEFT JOIN " . DB_PREFIX . "news_articles_description pd ON (p.article_id = pd.article_id) LEFT JOIN " . DB_PREFIX . "news_articles_to_store p2s ON (p.article_id = p2s.article_id) WHERE p.article_id = '" . (int)$article_id . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p.status = '1' AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'";

		$query = $this->db->query($sql);

		if ($query->num_rows) {
			return array(
				'article_id'       => $query->row['article_id'],
				'author_id'		   => $query->row['author_id'],
				'name'             => $query->row['name'],
				'description'      => $query->row['description'],
				'short_description'      => $query->row['short_description'],
				'meta_description' => $query->row['meta_description'],
				'meta_keyword'     => $query->row['meta_keyword'],
				'tag'              => $query->row['tag'],
				'image'            => $query->row['image'],
				'rating'           => round($query->row['rating']),
				'reviews'          => $query->row['reviews'] ? $query->row['reviews'] : 0,
				'sort_order'       => $query->row['sort_order'],
				'status'           => $query->row['status'],
				'date_added'       => $query->row['date_added'],
				'date_modified'    => $query->row['date_modified'],
				'viewed'           => $query->row['viewed'],
				'login_to_view'			=> $query->row['login_to_view']
			);
		} else {
			return false;
		}
	}

	public function getArticles($data = array()) {

		$sql = "SELECT p.article_id, (SELECT AVG(rating) AS total FROM " . DB_PREFIX . "news_review r1 WHERE r1.article_id = p.article_id AND r1.status = '1' GROUP BY r1.article_id) AS rating"; 

		if (!empty($data['filter_category_id'])) {
			if (!empty($data['filter_sub_category'])) {
				$sql .= " FROM " . DB_PREFIX . "news_category_path cp LEFT JOIN " . DB_PREFIX . "news_articles_to_category p2c ON (cp.category_id = p2c.category_id)";			
			} else {
				$sql .= " FROM " . DB_PREFIX . "news_articles_to_category p2c";
			}

			$sql .= " LEFT JOIN " . DB_PREFIX . "news_articles p ON (p2c.article_id = p.article_id)";
			
		} else {
			$sql .= " FROM " . DB_PREFIX . "news_articles p";
		}

		$sql .= " LEFT JOIN " . DB_PREFIX . "news_articles_description pd ON (p.article_id = pd.article_id) LEFT JOIN " . DB_PREFIX . "news_articles_to_store p2s ON (p.article_id = p2s.article_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p.status = '1' AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'";

		if (!empty($data['filter_category_id'])) {
			if (!empty($data['filter_sub_category'])) {
				$sql .= " AND cp.path_id = '" . (int)$data['filter_category_id'] . "'";	
			} else {
				$sql .= " AND p2c.category_id = '" . (int)$data['filter_category_id'] . "'";			
			}	
		}	

		if (!empty($data['filter_name']) || !empty($data['filter_tag'])) {
			$sql .= " AND (";

			if (!empty($data['filter_name'])) {
				$implode = array();

				$words = explode(' ', trim(preg_replace('/\s\s+/', ' ', $data['filter_name'])));

				foreach ($words as $word) {
					$implode[] = "pd.name LIKE '%" . $this->db->escape($word) . "%'";
				}

				if ($implode) {
					$sql .= " " . implode(" AND ", $implode) . "";
				}

				if (!empty($data['filter_description'])) {
					$sql .= " OR pd.description LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
				}
			}

			if (!empty($data['filter_name']) && !empty($data['filter_tag'])) {
				$sql .= " OR ";
			}

			if (!empty($data['filter_tag'])) {
				$sql .= "pd.tag LIKE '%" . $this->db->escape($data['filter_tag']) . "%'";
			}

			$sql .= ")";
		}

		$sql .= " GROUP BY p.article_id";

		$sort_data = array(
			'pd.name',
			'rating',
			'p.sort_order',
			'p.date_added'
		);	

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			if ($data['sort'] == 'pd.name') {
				$sql .= " ORDER BY LCASE(" . $data['sort'] . ")";
			} else {
				$sql .= " ORDER BY " . $data['sort'];
			}
		} else {
			$sql .= " ORDER BY p.sort_order";	
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC, LCASE(pd.name) DESC";
		} else {
			$sql .= " ASC, LCASE(pd.name) ASC";
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

		$articles_data = array();


		$query = $this->db->query($sql);

		foreach ($query->rows as $result) {
			
			$articles_data[$result['article_id']] = $this->getArticle($result['article_id']);
		}

		return $articles_data;
	}

	public function getArticleDescriptions($article_id) {
		$article_description_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "news_articles_description WHERE article_id = '" . (int)$article_id . "'");

		foreach ($query->rows as $result) {
			$article_description_data[$result['language_id']] = array(
				'name'       => $result['name'],
				'description' => $result['description']
			);
		}

		return $article_description_data;
	}

	public function getArticleStores($article_id) {
		$article_store_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "news_articles_to_store WHERE article_id = '" . (int)$article_id . "'");

		foreach ($query->rows as $result) {
			$article_store_data[] = $result['store_id'];
		}

		return $article_store_data;
	}

	public function getArticleLayouts($article_id) {
		$article_layout_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "news_articles_to_layout WHERE article_id = '" . (int)$article_id . "'");

		foreach ($query->rows as $result) {
			$article_layout_data[$result['store_id']] = $result['layout_id'];
		}

		return $article_layout_data;
	}

	public function getTotalArticles() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "news_articles");

		return $query->row['total'];
	}	

	public function getTotalArticlesByLayoutId($layout_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "news_articles_to_layout WHERE layout_id = '" . (int)$layout_id . "'");

		return $query->row['total'];
	}	

	public function getArticleCategory($article_id) {
		$article_category_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "news_articles_to_category WHERE article_id = '" . (int)$article_id . "'");

		foreach ($query->rows as $result) {
			$article_category_data[] = $result['category_id'];
		}

		return $article_category_data;
	}

	public function getArticleToCategory($article_id) {

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "news_articles_to_category a2c LEFT JOIN " . DB_PREFIX . "news_category_description c ON (a2c.category_id = c.category_id) WHERE article_id = '" . (int)$article_id . "'");

		return $query->row;
	}

	public function getArticleRelated($article_id) {
		$article_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "news_articles_to_related a2r LEFT JOIN " . DB_PREFIX . "news_articles a ON (a2r.related_id = a.article_id) LEFT JOIN " . DB_PREFIX . "news_articles_to_store a2s ON (a.article_id = a2s.article_id) LEFT JOIN " . DB_PREFIX . "news_articles_description ad ON (a.article_id=ad.article_id) WHERE a2r.article_id = '" . (int)$article_id . "' AND a.status = '1' AND a2s.store_id = '" . (int)$this->config->get('config_store_id') . "'");

		foreach ($query->rows as $result) { 
			$article_data[$result['related_id']] = $this->getArticle($result['related_id']);
		}

		return $article_data;
	}

	public function getArticlesByCategory($category_id) {		
		
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX ."news_articles_to_category WHERE category_id= '" .(int)$category_id . "'");
		
		return $query->row['total'];
	}

	public function getArticleCarousel($category_id) {

		$article_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "news_articles_to_category a2c LEFT JOIN " . DB_PREFIX . "news_articles_description ad ON (a2c.article_id = ad.article_id) LEFT JOIN " . DB_PREFIX . "news_articles a ON (ad.article_id = a.article_id) WHERE category_id = '" . (int)$category_id . "'");

		/*foreach ($query->rows as $value) {
			$article_data[] = array(
				'article_id' => $value['article_id'],
				'login_to_view' => $value['login_to_view'],
				'name' => $value['name'],
				'image' => $value['image']
			);
		}*/

		return $query->rows;
	}

}
?>