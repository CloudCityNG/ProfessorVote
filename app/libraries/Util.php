<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class Util {

	function resolve_links($link) {
		if (is_array($link)) {
			$out = "";
			$CI = &get_instance();
			$CI -> load -> helper('url');

				$type = $link[type];
				$name = $link [name];
				$url = site_url('/index.php/' . $type . '/view/' . $name);
				$out = $out . anchor($url, $name);

			
			return $out;
		}
	}

	function make_table($fieldarray, $result) {
		//count number of columns
		$columns = count($fieldarray);
		//run the query

		$fields = "";
		$th = "";
		foreach ($fieldarray as $field) {
			$fields = $fields . ',' . $field;
			$th = $th . "<th>" . $field . "</th>";
		}
		$field = substr($field, 1);

		$html = "<table><tr>" . $th . "</tr>";
	
		if ($result -> num_rows() > 0) {
			foreach ($result->result_array() as $row) {

				$html = $html . "<tr>";

				for ($x = 0; $x < $columns; $x++) {
					$type_orig =ucfirst($fieldarray[$x]);
					$type =ucfirst($fieldarray[$x]);
					if($type =='Name'){
						
						$uris = explode('/',uri_string());
						$type=$uris[0];
						
					}
					$name = ucfirst($row[Name]);
					$in = array('type' => $type, 'name' => $row[$type_orig]);
					$html = $html . "<td>" . $this -> resolve_links($in) . "</td>";
				}
				$html = $html . "</tr>";
			}
		}
		$html = $html . "</table>";
		return $html;
	}

}
