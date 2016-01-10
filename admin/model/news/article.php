<?php
class ModelNewsArticle extends Model {
	public function addArticle($data) {
		$this->event->trigger('pre.admin.article.add', $data);

		$this->db->query("INSERT INTO " . DB_PREFIX . "news_articles SET sort_order = '" . (int)$data['sort_order'] . "', author_id = '" . $data['article_author'] . "', status = '" . (int)$data['status'] . "', date_added = NOW(), date_modified = NOW()");

		$article_id = $this->db->getLastId();

		foreach ($data['article_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "news_articles_description SET article_id = '" . (int)$article_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "', short_description = '" . $this->db->escape($value['short_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', tag = '" . $this->db->escape($value['tag']) . "'");
		}

		if(isset($data['login_to_view'])){
			$this->db->query("UPDATE " . DB_PREFIX . "news_articles SET login_to_view = '" . (int)$data['login_to_view'] . "' WHERE article_id = '" . (int)$article_id . "'");
		}

		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "news_articles SET image = '" . $this->db->escape(html_entity_decode($data['image'], ENT_QUOTES, 'UTF-8')) . "' WHERE article_id = '" . (int)$article_id . "'");
		}

		if (isset($data['article_store'])) {
			foreach ($data['article_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "news_articles_to_store SET article_id = '" . (int)$article_id . "', store_id = '" . (int)$store_id . "'");
			}
		}

		if (isset($data['article_layout'])) {
			foreach ($data['article_layout'] as $store_id => $layout_id) {

				$this->db->query("INSERT INTO " . DB_PREFIX . "news_articles_to_layout SET article_id = '" . (int)$article_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout_id . "'");

			}
		}

		if (isset($data['article_related'])) {
			foreach ($data['article_related'] as $related_id) {
				$this->db->query("DELETE FROM " . DB_PREFIX . "news_articles_to_related WHERE article_id = '" . (int)$article_id . "' AND related_id = '" . (int)$related_id . "'");
				$this->db->query("INSERT INTO " . DB_PREFIX . "news_articles_to_related SET article_id = '" . (int)$article_id . "', related_id = '" . (int)$related_id . "'");
				$this->db->query("DELETE FROM " . DB_PREFIX . "news_articles_to_related WHERE article_id = '" . (int)$article_id . "' AND related_id = '" . (int)$related_id . "'");
				$this->db->query("INSERT INTO " . DB_PREFIX . "news_articles_to_related SET article_id = '" . (int)$article_id . "', related_id = '" . (int)$related_id . "'");
			}
		}

		if (isset($data['keyword'])) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'article_id=" . (int)$article_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		} else {
            $firstlang_data = $data['article_description'][$this->config->get('config_language_id')];
            $keyword = preg_replace('~&([a-z]{1,2})(acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities(strtolower(str_replace(' ', '_', $firstlang_data['name'])), ENT_QUOTES, 'UTF-8'));
            $keyword = preg_replace("/^[^a-z0-9]?(.*?)[^a-z0-9]?$/i", "$1", $keyword);
            unset($firstlang_data);
            $this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'article_id=" . (int)$article_id . "', keyword = '" . $this->db->escape($keyword) . "'");
        }

		if (isset($data['article_category'])) {
			foreach ($data['article_category'] as $category_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "news_articles_to_category SET article_id = '" . (int)$article_id . "', category_id = '" . (int)$category_id . "'");
			}
		} else {
            $firstlang_data = $data['article_description'][$this->config->get('config_language_id')];
            $keyword = preg_replace('~&([a-z]{1,2})(acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities(strtolower(str_replace(' ', '_', $firstlang_data['name'])), ENT_QUOTES, 'UTF-8'));
            $keyword = preg_replace("/^[^a-z0-9]?(.*?)[^a-z0-9]?$/i", "$1", $keyword);
            unset($firstlang_data);
            $this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'article_id=" . (int)$article_id . "', keyword = '" . $this->db->escape($keyword) . "'");
        }

		$this->cache->delete('article');
	}

	public function editArticle($article_id, $data) {
		if($data['login_to_view']){
			$this->db->query("UPDATE " . DB_PREFIX . "news_articles SET sort_order = '" . (int)$data['sort_order'] . "', author_id = '" . $data['article_author'] . "', login_to_view = '" . $data['login_to_view'] . "', status = '" . (int)$data['status'] . "', date_modified = NOW() WHERE article_id = '" . (int)$article_id . "'");
		} else {
			$this->db->query("UPDATE " . DB_PREFIX . "news_articles SET sort_order = '" . (int)$data['sort_order'] . "', author_id = '1', login_to_view = '0', status = '" . (int)$data['status'] . "', date_modified = NOW() WHERE article_id = '" . (int)$article_id . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "news_articles_description WHERE article_id = '" . (int)$article_id . "'");

		foreach ($data['article_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "news_articles_description SET article_id = '" . (int)$article_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "', short_description = '" . $this->db->escape($value['short_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', tag = '" . $this->db->escape($value['tag']) . "'");
		}

		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "news_articles SET image = '" . $this->db->escape(html_entity_decode($data['image'], ENT_QUOTES, 'UTF-8')) . "' WHERE article_id = '" . (int)$article_id . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "news_articles_to_store WHERE article_id = '" . (int)$article_id . "'");

		if (isset($data['article_store'])) {
			foreach ($data['article_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "news_articles_to_store SET article_id = '" . (int)$article_id . "', store_id = '" . (int)$store_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "news_articles_to_layout WHERE article_id = '" . (int)$article_id . "'");

		if (isset($data['article_layout'])) {
			foreach ($data['article_layout'] as $store_id => $layout_id) {

				$this->db->query("INSERT INTO " . DB_PREFIX . "news_articles_to_layout SET article_id = '" . (int)$article_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout_id . "'");

			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "news_articles_to_related WHERE article_id = '" . (int)$article_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "news_articles_to_related WHERE related_id = '" . (int)$article_id . "'");

		if (isset($data['article_related'])) {
			foreach ($data['article_related'] as $related_id) {
				$this->db->query("DELETE FROM " . DB_PREFIX . "news_articles_to_related WHERE article_id = '" . (int)$article_id . "' AND related_id = '" . (int)$related_id . "'");
				$this->db->query("INSERT INTO " . DB_PREFIX . "news_articles_to_related SET article_id = '" . (int)$article_id . "', related_id = '" . (int)$related_id . "'");
				$this->db->query("DELETE FROM " . DB_PREFIX . "news_articles_to_related WHERE article_id = '" . (int)$related_id . "' AND related_id = '" . (int)$article_id . "'");
				$this->db->query("INSERT INTO " . DB_PREFIX . "news_articles_to_related SET article_id = '" . (int)$related_id . "', related_id = '" . (int)$article_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'article_id=" . (int)$article_id. "'");

		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'article_id=" . (int)$article_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		} else {
            $firstlang_data = $data['article_description'][$this->config->get('config_language_id')];
            $keyword = preg_replace('~&([a-z]{1,2})(acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities(strtolower(str_replace(' ', '_', $firstlang_data['name'])), ENT_QUOTES, 'UTF-8'));
            $keyword = preg_replace("/^[^a-z0-9]?(.*?)[^a-z0-9]?$/i", "$1", $keyword);
            unset($firstlang_data);
            $this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'article_id=" . (int)$article_id . "', keyword = '" . $this->db->escape($keyword) . "'");
        }

		$this->db->query("DELETE FROM " . DB_PREFIX . "news_articles_to_category WHERE article_id = '" . (int)$article_id . "'");

		if (isset($data['article_category'])) {
			foreach ($data['article_category'] as $category_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "news_articles_to_category SET article_id = '" . (int)$article_id . "', category_id = '" . (int)$category_id . "'");
			}
		}

		$this->cache->delete('article');
	}

	public function copyArticle($article_id){
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "news_articles a LEFT JOIN " . DB_PREFIX . "news_articles_description ad ON (a.article_id = ad.article_id) WHERE a.article_id = '" . (int)$article_id . "' AND ad.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		if ($query->num_rows) {
			$article = $query->row;

			$data['keyword'] = '';
			$data['status'] = '0';
			$data['viewed'] = '0';

			$data['article_description'] = $this->getArticleDescriptions($article_id);

			$data['article_author'] = $article['author_id'];
			$data['article_category'] = $this->getArticleCategory($article_id);
			$data['article_layout'] = $this->getArticleLayouts($article_id);
			$data['article_store'] = $this->getArticleStores($article_id);

			$this->addArticle($data);
		}
	}

	public function deleteArticle($article_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "news_articles WHERE article_id = '" . (int)$article_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "news_articles_description WHERE article_id = '" . (int)$article_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "news_articles_to_store WHERE article_id = '" . (int)$article_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "news_articles_to_layout WHERE article_id = '" . (int)$article_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "news_articles_to_category WHERE article_id = '" . (int)$article_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'article_id=" . (int)$article_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "news_articles_to_related WHERE article_id = '" . (int)$article_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "news_articles_to_related WHERE related_id = '" . (int)$article_id . "'");

		$this->cache->delete('article');
	}

	public function getArticle($article_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'article_id=" . (int)$article_id . "') AS keyword FROM " . DB_PREFIX . "news_articles a LEFT JOIN " . DB_PREFIX . "news_articles_description ad ON (a.article_id=ad.article_id) WHERE a.article_id = '" . (int)$article_id . "' AND ad.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

	public function getArticles($data = array()) {
		if ($data) {
			$sql = "SELECT * FROM " . DB_PREFIX . "news_articles i LEFT JOIN " . DB_PREFIX . "news_articles_description id ON (i.article_id = id.article_id)";

			if (!empty($data['filter_category'])) {
				$sql .= " LEFT JOIN " . DB_PREFIX . "news_articles_to_category a2c ON (i.article_id = a2c.article_id)";
			}

			$sql .= " WHERE id.language_id = '" . (int)$this->config->get('config_language_id') . "'";

			if (!empty($data['filter_name'])) {
				$sql .= " AND id.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
			}

			if (!empty($data['filter_date_added'])) {
				$sql .= " AND i.date_added LIKE '" . $this->db->escape($data['filter_date_added']) . "%'";
			}

			if (!empty($data['filter_date_modified'])) {
				$sql .= " AND i.date_modified LIKE '" . $this->db->escape($data['filter_date_modified']) . "%'";
			}

			if (!empty($data['filter_category'])) {
				$sql .= " AND a2c.category_id = '" . $this->db->escape($data['filter_category']) . "'";
			}

			if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
				$sql .= " AND i.status = '" . (int)$data['filter_status'] . "'";
			}

			$sort_data = array(
				'id.name',
				'i.sort_order'
			);

			if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
				$sql .= " ORDER BY " . $data['sort'];
			} else {
				$sql .= " ORDER BY id.name";
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
		} else {
			$articles_data = $this->cache->get('article.' . (int)$this->config->get('config_language_id'));

			if (!$articles_data) {
				$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "news_articles i LEFT JOIN " . DB_PREFIX . "news_articles_description id ON (i.article_id = id.article_id) WHERE id.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY id.name");

				$articles_data = $query->rows;

				$this->cache->set('article.' . (int)$this->config->get('config_language_id'), $articles_data);
			}

			return $articles_data;
		}
	}

	public function getArticleDescriptions($article_id) {
		$article_description_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "news_articles_description WHERE article_id = '" . (int)$article_id . "'");

		foreach ($query->rows as $result) {
			$article_description_data[$result['language_id']] = array(
				'name'       => $result['name'],
				'description' => $result['description'],
				'short_description'	=> $result['short_description'],
				'meta_description' => $result['meta_description'],
				'meta_keyword'	=> $result['meta_keyword'],
				'tag'	=> $result['tag']
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

	public function getArticleRelated($article_id) {
		$article_related_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "news_articles_to_related WHERE article_id = '" . (int)$article_id . "'");

		foreach ($query->rows as $result) {
			$article_related_data[] = $result['related_id'];
		}

		return $article_related_data;
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

}
?>