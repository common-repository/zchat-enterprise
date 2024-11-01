<?php
require_once ('ZChat.widget.php');
class ZChat {
	protected $zchat_url = null;
	protected $zchat_displaytype = null;
	protected static $instance;
	public static function get_instance() {
		if (! isset ( self::$instance )) {
			$c = __CLASS__;
			self::$instance = new $c ();
		}
		
		return self::$instance;
	}
	protected function __construct() {
		// add zchat code for page footer
		add_action ( 'wp_footer', array (
				$this,
				'zchat_code' 
		) );
		// create zchat as wprdpress widget
		add_action ( 'widgets_init', create_function ( '', 'return register_widget("ZChatWidget");' ) );
	}
	// get zchat site url
	public function get_zchat_url() {
		if (is_null ( $this->zchat_url )) {
			$this->zchat_url = get_option ( 'zchat_url' );
		}
		return $this->zchat_url;
	}
	// get zchat display type
	public function get_zchat_displaytype() {
		if (is_null ( $this->zchat_displaytype )) {
			$this->zchat_displaytype = get_option ( 'zchat_displaytype' );
		}
		return $this->zchat_displaytype;
	}
	// get zchat code with different display type, only use for embedded chat, chat widget and monitory mode
	public function zchat_code() {
		if (is_null ( $this->get_zchat_url () )) {
			// echo "<a href='http://zchat.com/register.aspx' target='_blank'>Sign up ZChat</a>";
		} else {
			$sptpre = "<div class=\"mod_zchat\">";
			$sptend = "</div>";
			if ($this->get_zchat_displaytype () == "embedded") {
				echo $sptpre . "<script type=\"text/javascript\" async=\"async\" defer=\"defer\" data-cfasync=\"false\" src=\"" . $this->get_zchat_url () . "/chatinline.aspx\"></script>.$sptend";
			}
			if ($this->get_zchat_displaytype () == "widget") {
				echo $sptpre . "<script type=\"text/javascript\" async=\"async\" defer=\"defer\" data-cfasync=\"false\" src=\"" . $this->get_zchat_url () . "/chatwidget.aspx\"></script>.$sptend";
			}
			
			if ($this->get_zchat_displaytype () == "monitor") {
				echo $sptpre . "<script type=\"text/javascript\" async=\"async\" defer=\"defer\" data-cfasync=\"false\" src=\"" . $this->get_zchat_url () . "/chatapi.aspx\"></script>.$sptend";
			}
		}
	}
	// get zchat code for wordpress widget mode only
	public function zchat_widget_code() {
		if (is_null ( $this->get_zchat_url () )) {
			// echo "<a href='http://zchat.com/register.aspx' target='_blank'>Sign up ZChat</a>";
		} else {
			$sptpre = "<div class=\"mod_zchat\">";
			$sptend = "</div>";
			if ($this->get_zchat_displaytype () == "embedded") {
				echo "$sptpre.<script type=\"text/javascript\" async=\"async\" defer=\"defer\" data-cfasync=\"false\" src=\"" . $this->get_zchat_url () . "/chatinline.aspx\"></script>.$sptend";
			}
			if ($this->get_zchat_displaytype () == "widget") {
				echo "$sptpre.<script type=\"text/javascript\" async=\"async\" defer=\"defer\" data-cfasync=\"false\" src=\"" . $this->get_zchat_url () . "/chatwidget.aspx\"></script>.$sptend";
			}
			if ($this->get_zchat_displaytype () == "button") {
				echo "$sptpre.<div id=\"ZChatContainer\"></div><script type=\"text/javascript\" async=\"async\" defer=\"defer\" data-cfasync=\"false\" src=\"" . $this->get_zchat_url () . "/chatbutton.aspx\"></script>.$sptend";
			}
			if ($this->get_zchat_displaytype () == "box") {
				echo "$sptpre.<div id=\"ZChatContainer\"></div><script type=\"text/javascript\" async=\"async\" defer=\"defer\" data-cfasync=\"false\" src=\"" . $this->get_zchat_url () . "/chatbox.aspx\"></script>.$sptend";
			}
			if ($this->get_zchat_displaytype () == "link") {
				echo "$sptpre.<div id=\"ZChatContainer\"></div><script type=\"text/javascript\" async=\"async\" defer=\"defer\" data-cfasync=\"false\" src=\"" . $this->get_zchat_url () . "/chatlink.aspx\"></script>.$sptend";
			} else if ($this->get_zchat_displaytype () == "monitor") {
				echo "$sptpre.<script type=\"text/javascript\" async=\"async\" defer=\"defer\" data-cfasync=\"false\" src=\"" . $this->get_zchat_url () . "/chatapi.aspx\"></script>.$sptend";
			}
		}
	}
}
?>