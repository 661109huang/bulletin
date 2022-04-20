<?php defined('BASEPATH') or exit('No direct script access allowed');

class MY_Pagination extends CI_pagination
{
    protected $CI;

    public function __construct()
    {
        parent::__construct();
        $this->CI = &get_instance();
    }

    // 後台用分類樣式
    public function backend($config)
    {
        // 放在你当前页码的前面和后面的“数字”链接的数量。比方说值为 2 就会在每一边放置两个数字链接， 就像此页顶端的示例链接那样。
        $config['num_links'] = 3;
        // 默认分页的 URL 中显示的是你当前正在从哪条记录开始分页，如果你希望显示实际的页数，将该参数设置为 TRUE 。
        // $config['use_page_numbers'] = TRUE;
        // 默认情况下你的查询字符串参数会被忽略，将这个参数设置为 TRUE ，将会将查询字符串参数添加到 URI 分段的后面 以及 URL 后缀的前面。
        $config['reuse_query_string'] = TRUE;
        // 起始标签-放在所有结果的左侧。
        $config['full_tag_open'] = '<nav><ul class="pagination no-gutters">';
        // 结束标签-放在所有结果的右侧。
        $config['full_tag_close'] = '</ul></nav>';
        // 左边第一个链接显示的文本，如果你不想显示该链接，将其设置为 FALSE 。
        $config['first_link'] = '<span><i class="mdi mdi-chevron-double-left"></i></span>';
        // 第一个链接的起始标签。
        $config['first_tag_open'] = '<li>';
        // 第一个链接的结束标签。
        $config['first_tag_close'] = '</li>';
        // 右边最后一个链接显示的文本，如果你不想显示该链接，将其设置为 FALSE 。
        $config['last_link'] = '<span><i class="mdi mdi-chevron-double-right"></i></span>';
        // 最后一个链接的起始标签。
        $config['last_tag_open'] = '<li>';
        // 最后一个链接的结束标签。
        $config['last_tag_close'] = '</li>';
        // 下一页链接显示的文本，如果你不想显示该链接，将其设置为 FALSE 。
        $config['next_link'] = '<span><i class="mdi mdi-chevron-right"></i></span>';
        // 下一页链接的起始标签。
        $config['next_tag_open'] = '<li>';
        // 下一页链接的结束标签。
        $config['next_tag_close'] = '</li>';
        // 上一页链接显示的文本，如果你不想显示该链接，将其设置为 FALSE 。
        $config['prev_link'] = '<span><i class="mdi mdi-chevron-left"></i></span>';
        // 上一页链接的起始标签。
        $config['prev_tag_open'] = '<li>';
        // 上一页链接的结束标签。
        $config['prev_tag_close'] = '</li>';
        // 当前页链接的起始标签。
        $config['cur_tag_open'] = '<li class="active disabled"><span>';
        // 当前页链接的结束标签。
        $config['cur_tag_close'] = '</span></li>';
        // 数字链接的起始标签。
        $config['num_tag_open'] = '<li>';
        // 数字链接的结束标签。
        $config['num_tag_close'] = '</li>';
        //初始化分类页
        $this->CI->pagination->initialize($config);
    }
}
