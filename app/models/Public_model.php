<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Public_model extends CI_Model
{
    // 取得筆數
    public function get_count($table, $column = null, $keyword = null)
    {
        // 如果有關鍵字
        if (!empty($column) && !empty($keyword)) {
            $this->db->like($column, $keyword);
        }
        // 查詢並回傳
        return $this->db->count_all_results($table);
    }

    // 取得資料
    public function get_data($table, $column = null, $keyword = null, $where = null, $limit = null, $offset = null)
    {
        // 如果有關鍵字
        if (!empty($column) && !empty($keyword)) {
            $this->db->like($column, $keyword);
        }
        // 如果有條件
        if (!empty($where)) {
            $this->db->where($where);
        }
        // 排序
        $this->db->order_by('create_date DESC, id DESC');
        // 分頁
        $this->db->limit($limit, $offset);
        // 查詢並回傳
        return $this->db->get($table)->result_array();
    }

    // 新增
    public function add($table, $params)
    {
        // 新增
        return $this->db->insert($table, $params);
    }

    // 更新
    public function update($table, $id, $params)
    {
        // 對應ID
        if (is_array($id)) {
            $this->db->where_in('id', $id);
        } else {
            $this->db->where('id', $id);
        }
        //更新
        return $this->db->update($table, $params);
    }

    // 刪除
    public function del($table, $id)
    {
        // 對應ID
        if (is_array($id)) {
            $this->db->where_in('id', $id);
        } else {
            $this->db->where('id', $id);
        }
        // 刪除
        return $this->db->delete($table);
    }
}
