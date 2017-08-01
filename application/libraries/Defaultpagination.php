<?php
/*
bu dokumandaki kodlar tarafıma (özgün eşim) aittir. izinsiz kullanılamaz!
ozgunesim@gmail.com
http://inoverse.com
*/
if (!defined('BASEPATH')) exit('No direct script access allowed');
Class DefaultPagination{
	var $CI = null;
	function __construct(){
		$this->CI =& get_instance();
	}

	public function create_links(&$config){
		$this->CI->load->library('pagination');
		$this->CI->load->config('pagination');
		$limit = $this->CI->config->item('pagination_limit');
		$config['per_page'] = $limit;
		$config['use_page_numbers'] = TRUE;
		//$config['attributes'] = array('class' => 'btn btn-default');
		$config['full_tag_open'] = '<div class="text-center"><ul class="pagination">';
		$config['full_tag_close'] = '</ul></div>';
		$config['num_tag_open'] = "<li>";
		$config['num_tag_close'] = "</li>";
		$config['cur_tag_open'] = "<li class='active'><a>";
		$config['cur_tag_close'] = "</a></li>";
		$config['prev_tag_open'] = "<li>";
		$config['prev_tag_close'] = "</li>";
		$config['next_tag_open'] = "<li>";
		$config['next_tag_close'] = "</li>";
		$config['first_tag_open'] = "<li>";
		$config['first_tag_close'] = "</li>";
		$config['last_tag_open'] = "<li>";
		$config['last_tag_close'] = "</li>";
		$config['last_link'] = 'Son';
		$config['first_link'] = 'İlk';
		$config['next_link'] = '<i class="fa fa-chevron-right"></i>';
		$config['prev_link'] = '<i class="fa fa-chevron-left"></i>';
		$this->CI->pagination->initialize($config);
		return $this->CI->pagination->create_links();

	}


}

?>