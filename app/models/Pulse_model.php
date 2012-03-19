<?php
class Pulse_model extends CI_Model {

	public function votedBefore($item_id) {
		$q = $this -> db -> get('pulse_votes');
		if ($_COOKIE['pulse_item_' . $item_id] == 1) {// check sessions first; voted before
			return true;
		} else {// session says user hasn't voted yet. So check against IP
			$ip = $_SERVER['REMOTE_ADDR'];
			$query = "SELECT * FROM {$this->votes_table} WHERE `ip` = '$ip' AND `item_id` = $item_id";
			$result = mysql_query($query);
			if (mysql_num_rows($result) > 0) {// already voted
				return true;
			} elseif (mysql_num_rows($result) == 0) {// haven't voted
				return false;
			}
		}
	}

}
