<?php
class ControllerCommonFooter extends Controller {
	public function index() {
		$this->load->language('common/header');
		$this->load->language('common/footer');

		$data['text_contact'] = $this->language->get('text_contact');
		$data['text_sitemap'] = $this->language->get('text_sitemap');
		$data['text_findonmap'] = $this->language->get('text_findonmap');
		$data['text_powered'] = $this->language->get('text_powered');

		$data['text_contact_name'] = $this->language->get('text_contact_name');
		$data['text_contact_email'] = $this->language->get('text_contact_email');
		$data['text_contact_topic'] = $this->language->get('text_contact_topic');
		$data['text_contact_message'] = $this->language->get('text_contact_message');
		$data['text_send'] = $this->language->get('text_send');

		$data['text_home']  = $this->language->get('text_home');
		$data['text_introduction']  = $this->language->get('text_introduction');
		$data['text_product'] = $this->language->get('text_product');
		$data['text_newsevent'] = $this->language->get('text_newsevent');
		$data['text_downloads'] = $this->language->get('text_downloads');
		$data['text_job'] = $this->language->get('text_job');
		$data['text_contact'] = $this->language->get('text_contact');
		$data['text_headoffice'] = $this->language->get('text_headoffice');

		$data['home_url'] = $this->url->link('common/home');
		$data['introduction_url'] = $this->url->link('common/about');
		$data['contact_url'] = $this->url->link('common/home');
		$data['product_url'] = $this->url->link('common/home');
		$data['news_url'] = $this->url->link('common/home');
		$data['download_url'] = $this->url->link('common/home');
		$data['jobs_url'] = $this->url->link('news/category', 'news_path=' . DEFAULT_RECRUITMENTCATEGORY_ID);
		$data['sitemap_url'] = $this->url->link('information/sitemap');

		$data['powered'] = sprintf($this->language->get('text_powered'), $this->config->get('config_name'), date('Y', time()));

		// Whos Online
		if ($this->config->get('config_customer_online')) {
			$this->load->model('tool/online');

			if (isset($this->request->server['REMOTE_ADDR'])) {
				$ip = $this->request->server['REMOTE_ADDR'];
			} else {
				$ip = '';
			}

			if (isset($this->request->server['HTTP_HOST']) && isset($this->request->server['REQUEST_URI'])) {
				$url = 'http://' . $this->request->server['HTTP_HOST'] . $this->request->server['REQUEST_URI'];
			} else {
				$url = '';
			}

			if (isset($this->request->server['HTTP_REFERER'])) {
				$referer = $this->request->server['HTTP_REFERER'];
			} else {
				$referer = '';
			}

			$this->model_tool_online->whosonline($ip, $this->customer->getId(), $url, $referer);
		}

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/footer.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/common/footer.tpl', $data);
		} else {
			return $this->load->view('default/template/common/footer.tpl', $data);
		}
	}
}