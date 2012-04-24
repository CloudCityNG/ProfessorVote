<?php
class Pulse_model extends CI_Model {

    function getCoursePulseVotes($id) {
        $query1 = $this -> db -> query("SELECT * FROM course_pulse_votes WHERE `item_id`= $item_id AND `vote_value`>0");
        $upVotes = 0;
        foreach ($query1->result() as $row) {
                $$upVotes += $row['vote_value'];
            }
        $upVotes = (int)$upVotes;

        $query2 = "SELECT * FROM course_pulse_votes WHERE `item_id`= $item_id AND `vote_value`<0";
        
        $result2 = mysql_query($query2);
        print_r($result2);
        $downVotes = 0;
        while ($row = mysql_fetch_assoc($result2)) {
            $downVotes += $row['vote_value'];
        }
        $downVotes = (int)-$votes;

        return $upVotes + $downVotes;
    }

    function countCourseUpVotes($item_id) {
        $query = "SELECT * FROM course_pulse_votes WHERE `item_id`= $item_id AND `vote_value`>0";
        $result = mysql_query($query);
        $votes = 0;
        while ($row = mysql_fetch_assoc($result)) {
            $votes += $row['vote_value'];
        }
        return (int)$votes;
    }

    function countCourseDownVotes($item_id) {
        $query = "SELECT * FROM course_pulse_votes WHERE `item_id`= $item_id AND `vote_value`<0";
        $result = mysql_query($query);
        $votes = 0;
        while ($row = mysql_fetch_assoc($result)) {
            $votes += $row['vote_value'];
        }
        return (int)-$votes;
        // returns a POSITIVE integer
    }

}
