<?php
class ZChatWidget extends WP_Widget {
	private static $my_id_base = 'zchat_widget';
	static public function get_id_base() {
		return self::$my_id_base;
	}
	function __construct() {
		parent::__construct ( 'zchat_widget', 'ZChat', array (
				'classname' => 'ZChatWidget',
				'description' => 'Install ZChat to let your visitors start a chat with you.' 
		), array (
				'id_base' => self::$my_id_base 
		) );
	}
	function widget($args, $instance) {
		ZChat::get_instance ()->zchat_widget_code ();
	}
}
?>