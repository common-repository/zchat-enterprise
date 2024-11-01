<?php
require_once ('ZChat.class.php');
final class ZChatAdmin extends ZChat {
	protected $changes_saved = false;
	public static function get_instance() {
		if (! isset ( self::$instance )) {
			$c = __CLASS__;
			self::$instance = new $c ();
		}
		return self::$instance;
	}
	protected function __construct() {
		parent::__construct ();
		add_action ( 'admin_menu', array (
				$this,
				'admin_menu' 
		) );
		if (defined ( 'WP_DEBUG' ) && WP_DEBUG == true) {
			add_action ( 'init', array (
					$this,
					'error_reporting' 
			) );
		}
		if ($_SERVER ['REQUEST_METHOD'] == 'POST' && isset ( $_GET ['saved'] ) && $_GET ['saved'] == '1') {
			$this->update_options ( $_POST );
		}
	}
	//generates zchat menu for wordpress
	public function admin_menu() {
		add_menu_page ( 'ZChat', 'ZChat', 'administrator', 'zchat_settings', array (
				$this,
				'zchat_settings_page' 
		) );
	}
	public function changes_saved() {
		return $this->changes_saved;
	}
	//zchat setting panel html code
	public function zchat_settings_page() {
		echo "<h3>ZChat Settings</h3>
				<div class=\"postbox\" style=\"width:700px\">
				<form method=\"post\" id=\"zchat_settings_form\" action=\"?page=zchat_settings&saved=1\">
				 <table class='form-table'>
	            	<tr>
	                	<td scope=\"row\" style=\"width:160px;\"><label for=\"mylivechat_id\">Your ZChat Site URL:</label></td>
	                	<td ><input style=\"width:400px;\" type=\"text\" name=\"zchat_url\" id=\"zchat_url\" value=\"" . $this->get_zchat_url () . "\"/></td>
	            	</tr>
	                <tr>
						<td scope=\"row\"><label for=\"zchat_displaytype\">Display Type:</label></td>
						<td>
							<select name=\"zchat_displaytype\" id=\"zchat_displaytype\">
								<option value=\"embedded\">Embedded Chat</option>
	                			<option value=\"widget\">Chat Widget</option>
								<option value=\"button\">Chat Image Button</option>
								<option value=\"box\">Chat Box</option>
								<option value=\"link\">Chat Text Link</option>
	                			<option value=\"monitor\">Monitor Only</option>
							</select>
	                	</td>
					</tr>
	                <tr>
						<td colspan=\"2\" style=\"color:red\"><p>If you choose \"Chat Image Button\", \"Chat Box\" and \"Chat Text Live\" display type, you need to go to your wordpress dashboard-->Appearance-->Widget to drag the zchat widget to a sidebar, then they will shows into that sidbar. </p>
						</td>
	                </tr>
	                <tr>
	                	<td>
							<input type=\"hidden\" name=\"changes_saved\" value=\"1\">
							<input type=\"submit\" class=\"button-primary\" value=\"Save changes\" />
	                	</td>
	                	<td>
	                	</td>
	                </tr>
        		</table>
				</form>
				</div>";
		echo "<script type=\"text/javascript\">
				document.getElementById('zchat_displaytype').value='" . $this->get_zchat_displaytype () . "'||'embedded';
			</script>";
		if (isset ( $_GET ['saved'] )) {
			echo "<div id=\"changes_saved_info\" class=\"updated installed_ok\"><p>ZChat settings saved successfully.</p></div>";
		}
	}
	//save zchat setting values
	protected function update_options($data) {
		$zchat_url = isset ( $data ['zchat_url'] ) ? $data ['zchat_url'] : "";
		$zchat_displaytype = isset ( $data ['zchat_displaytype'] ) ? $data ['zchat_displaytype'] : "embedded";
		update_option ( 'zchat_url', $zchat_url );
		update_option ( 'zchat_displaytype', $zchat_displaytype );
		
		if (isset ( $data ['changes_saved'] ) && $data ['changes_saved'] == '1') {
			$this->changes_saved = true;
		}
	}
}

?>