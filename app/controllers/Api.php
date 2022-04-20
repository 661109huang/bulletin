<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api extends CI_Controller
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

	public function add()
	{
		$data = array();

		// 表單驗證類
		$this->load->library('form_validation');
		//驗證規則
		$this->form_validation->set_rules('add_title', '標題', 'trim|required|max_length[5]');
		$this->form_validation->set_rules('add_content', '公告內容', 'trim|required|max_length[500]');

		if ($this->form_validation->run() == FALSE) {
			// 驗證失敗
			$data['status'] = false;
			$data['msg'] = $this->form_validation->error_string();
		} else {
			// 定義
			$title = $this->input->post('add_title');
			$content = $this->input->post('add_content');
			$params = array("title" => $title, "content" => $content);
			// 執行
			$this->Public_model->add("content", $params);
			// 信息
			$data['status'] = true;
			$data['msg'] = '新增完成';
			$data['reload'] = 1;
		}
		echo json_encode($data);
	}

	public function edit()
	{
		$data = array();

		// 表單驗證類
		$this->load->library('form_validation');
		//驗證規則
		$this->form_validation->set_rules('id', '你選擇的公告', 'trim|required|is_exist[content.id]');

		if ($this->form_validation->run() == FALSE) {
			// 驗證失敗
			$data['status'] = false;
			$data['msg'] = $this->form_validation->error_string();
		} else {
			// 定義
			$where = array("id" => $this->input->post('id'));
			// 執行
			$data['data'] = $this->Public_model->get_data("content", null, null, $where);
			// 信息
			$data['status'] = true;
			$data['msg'] = '讀取完成';
		}
		echo json_encode($data);
	}

	// 編輯
	public function update()
	{
		$data = array();

		// 表單驗證類
		$this->load->library('form_validation');
		//驗證規則
		$this->form_validation->set_rules('edit_id', '你選擇的公告', 'trim|required|is_exist[content.id]');
		$this->form_validation->set_rules('edit_title', '標題', 'trim|required|max_length[5]');
		$this->form_validation->set_rules('edit_content', '公告內容', 'trim|required|max_length[500]');

		if ($this->form_validation->run() == FALSE) {
			// 驗證失敗
			$data['status'] = false;
			$data['msg'] = $this->form_validation->error_string();
		} else {
			// 定義
			$id = $this->input->post('edit_id');
			$title = $this->input->post('edit_title');
			$content = $this->input->post('edit_content');
			$params = array("title" => $title, "content" => $content);

			// 執行
			$this->Public_model->update("content", $id, $params);
			// 信息
			$data['status'] = true;
			$data['msg'] = '修改完成';
			$data['reload'] = 1;
		}
		echo json_encode($data);
	}

	// 啟用
	public function on()
	{
		// 表單驗證類
		$this->load->library('form_validation');
		//驗證規則
		$this->form_validation->set_rules('ids[]', '你選擇的公告', 'trim|required|is_exist[content.id]');

		if ($this->form_validation->run() == FALSE) {
			// 驗證失敗
			$data['status'] = false;
			$data['msg'] = $this->form_validation->error_string();
		} else {
			// 定義
			$id = $this->input->post('ids');
			$params = array("status" => 1);
			// 執行
			$this->Public_model->update("content", $id, $params);
			// 信息
			$data['status'] = true;
			$data['msg'] = '啟用成功';
			$data['reload'] = 1;
		}
		echo json_encode($data);
	}

	// 停用
	public function off()
	{
		// 表單驗證類
		$this->load->library('form_validation');
		//驗證規則
		$this->form_validation->set_rules('ids[]', '你選擇的公告', 'trim|required|is_exist[content.id]');

		if ($this->form_validation->run() == FALSE) {
			// 驗證失敗
			$data['status'] = false;
			$data['msg'] = $this->form_validation->error_string();
		} else {
			// 定義
			$id = $this->input->post('ids');
			$params = array("status" => 0);
			// 執行
			$this->Public_model->update("content", $id, $params);
			// 信息
			$data['status'] = true;
			$data['msg'] = '停用成功';
			$data['reload'] = 1;
		}
		echo json_encode($data);
	}

	// 刪除
	public function del()
	{
		// 表單驗證類
		$this->load->library('form_validation');
		//驗證規則
		$this->form_validation->set_rules('ids[]', '你選擇的公告', 'trim|required|is_exist[content.id]');

		if ($this->form_validation->run() == FALSE) {
			// 驗證失敗
			$data['status'] = false;
			$data['msg'] = $this->form_validation->error_string();
		} else {
			// 定義
			$id = $this->input->post('ids');
			// 執行
			$this->Public_model->del("content", $id);
			// 信息
			$data['status'] = true;
			$data['msg'] = '刪除成功';
			$data['reload'] = 1;
		}
		echo json_encode($data);
	}
}
