<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Email
| -------------------------------------------------------------------------
| This file lets you define parameters for sending emails.
| Please see the user guide for info:
|
|	http://codeigniter.com/user_guide/libraries/email.html
|
*/
$config['protocol']         = 'mail';        
$config['mailpath']         = '/usr/sbin/sendmail';
$config['smtp_host']        = '';
$config['smtp_user']        = '';
$config['smtp_pass']        = '';
$config['smtp_port']        = 25;

$config['mailtype'] = 'html';
$config['charset'] = 'utf-8';
$config['newline'] = "\r\n";


/* End of file email.php */
/* Location: ./application/config/email.php */