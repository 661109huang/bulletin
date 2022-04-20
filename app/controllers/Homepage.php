<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Homepage extends CI_Controller
{
	public function __construct()
	{
		// 繼承CI
		parent::__construct();
		// 連接數據庫
		$this->load->database();
		// 使用model
		$this->load->model('Public_model');
	}

	public function index($offset = '')
	{
		$data = array();

		// 關鍵字
		$keyword = $this->input->get('keyword');

		// 配置分頁
		$this->load->library('pagination');
		// 配置分頁設定
		$config['base_url'] = site_url('Homepage/index');
		$config['total_rows'] = $this->Public_model->get_count("content", "title", $keyword);
		$config['per_page'] = 10;
		// 初始化分類
		$this->pagination->backend($config);
		// 生成分頁信息
		$data['pageinfo'] = $this->pagination->create_links();

		// 取得列表
		$data['data'] = $this->Public_model->get_data("content", "title", $keyword, null, $config['per_page'], $offset);

		// var_dump($data);exit;
		$this->load->view('homepage', $data);
	}
}
