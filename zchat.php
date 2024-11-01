<?php
/*
Plugin Name: ZChat
Plugin URI: http://zchat.com/
Description: ZChat is a fast, high performance and most user-friendly live chat solution. It allows you to live chat with website visitors, monitor site traffic, and analyze visitors web activities, including their search engine and keyword usage.
Author: ZChat
Author URI: http://zchat.com/
Version: 1.0.0
*/
require_once(dirname(__FILE__).'/plugin_files/ZChatAdmin.class.php');
	ZChatAdmin::get_instance();

?>