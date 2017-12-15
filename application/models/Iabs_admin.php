<?php
defined('BASEPATH') OR exit('Missed a step, right?');

class Iabs_Admin extends CI_Model {
    protected $user;
    
    public function __construct() {
        parent::__construct();
        $this->user = (isset($_SESSION['username'])) ? $this->db->escape_str($_SESSION['username']) : '' ;
    }

    public function insert($data,$table) {
        // Data insertion
        $insert = $this->db->insert($table,$data);
        return $insert;
    }

    // Data update method
    public function update($key,$data,$table,$door,$other_door='',$other_key='') {
        $this->db->set($data);
        $this->db->where($door, $key);
        if ($other_door != '') {
            $this->db->where($other_door, $other_key);
        }
        $this->db->update($table, $data);
        return true;
    }

    // Data fetcher method
    public function fetch($table, $row, $door, $key, $other='') {
        $query = $this->db->query("SELECT $row FROM $table WHERE $door='$key' $other");

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                return $row;
            }
        } else {
            return false;
        }
    }

    public function validate_user($user,$pass) {
        // Fetch the salt
        $fetch = $this->fetch('users', 'secret', 'username', $user, "LIMIT 1");
        
        // Row was fetched
        if ($fetch) {
            $secret = $fetch->secret;

            // If password is not hashed/secure
            if (password_needs_rehash($secret, 1)) {
                // Rehash the password
                $options = ['cost' => '10'];
                $hashed = password_hash($secret, PASSWORD_BCRYPT, $options);

                // Insert the newly hashed password into the database
                $data = ['secret' => $hashed];
                $update = $this->update($user, $data, 'users', 'username');

                if ($update) {
                    return false;
                } else {
                    $this->validate_user($user, $pass);
                }
            } elseif (password_verify($pass, $secret)) {
                return true;
            }
        } else {
            return false;
        }
    }

    // User login status setter
    public function set_status($user, $id) {
        // Igniting session
        $this->session->set_userdata([
            'username' =>   $user,
            'id'       =>   $id
        ]);

        // Set user login status
        $last_seen = date('Y-m-d G:i:s');
        $update_data = ['last_seen' => "$last_seen", 'status' => '1'];
        $this->update($user,$update_data,'users_other','username');
    }

    // User status checker method
    public function check_status($user='', $redirect='') {
        $this->load->helper('cookie');
        $return = (empty($redirect)) ? uri_string() : $redirect;

        if (!empty($user)) {
            // Checking activation status
            $row = $this->fetch('users','activated','username',$user,'LIMIT 1');

            if ($row) {
                // Current status
                $status = $row->activated;

                // Okay, user exists but is not yet activated
                if ($status == 0) {
                    return "<script type='text/javascript'>
                        window.href='".base_url()."activation?return_to=".$return."';
                    </script>";
                    exit();
                } else {
                    return true;
                }
            }
        } elseif (!isset($_SESSION['username']) || $user == '') {
            if (get_cookie('username') && get_cookie('door')) {
                $uname = $this->db->escape_str(get_cookie('username'));
                $db_secret = $this->db->query("SELECT secret FROM users WHERE username = '$uname' LIMIT 1")->row()->secret;
                $user = $this->db->query("SELECT username FROM users WHERE username = '$uname' LIMIT 1")->row()->username; 
                $uid = $this->db->query("SELECT uid FROM users WHERE username = '$uname' LIMIT 1")->row()->uid;
                if ($db_secret == get_cookie('door')) {
                    $this->session->set_userdata([
                        'username' =>   $uname,
                        'id'       =>   $uid
                    ]);
                }
            } elseif ($this->input->is_ajax_request()) {
                echo('Your session has expired, please click <a href="'.base_url().'login?return_to='.$return.'">this</a> link to login again');
                exit();
            } else {
                redirect(base_url().'login?return_to='.$return);
            }
        }
        // If user's session isn't set, what the heck are they doing here... log 'em out
        else {
            $this->unset_status();
        }
    }

    public function unset_status($mode='', $redirect='') {
        $this->load->helper('date', 'cookie');
        $this->load->library('rango_date');

        switch ($mode) {
            // The quiet mode is used to silently log out a user with abnormal account behaviour.
            // Probably when a worst case scenario such as a hack occurs, this is useful for locking them out.
            case 'quiet':
                // Unset session
                $this->session->unset_userdata('username');
                $this->session->unset_userdata('id');

                // Destroy cookies
                delete_cookie('username');
                delete_cookie('door');

                redirect(base_url()."login?return_to=$redirect");
            break;
            
            default:
                // This is different from the quiet mode because it also updates their last-seen field in the db
                // Unset user login status
                $last_seen = date('Y-m-d G:i:s');
                $update_data = ['last_seen' => "$last_seen", 'status' => '0'];
                $this->update($this->user,$update_data,'users_other','username');

                // Unset session
                $this->session->unset_userdata('username');
                $this->session->unset_userdata('id');

                // Destroy cookies
                delete_cookie('username');
                delete_cookie('door');
            break;
        }
    }

    // Mail sending method, sends mail using given params
    public function send_mail($from, $name, $to, $subject, $message) {            
        // Load the mail lib
        $this->load->library('email');

        // Mail configuration
        $config = [
            /*'protocol' => 'smtp',*/
            //'smtp_host' => 'ssl://smtp.gmail.com',
            //'smtp_port' => '465',
            //'smtp_timeout' => '7',
            //'smtp_user' => '', 
            //'smtp_pass' => '', 
            'charset' => 'utf-8',
            'mailtype' => 'html',
            //'validation' => TRUE
        ];

        $this->email->initialize($config);
        
        // Mail params
        $this->email->from("$from", "$name");
        $this->email->to("$to");
        $this->email->subject("$subject");
        $this->email->message("$message");

        // Send mail
        $send = $this->email->send();

        if ($send) {
            return true;
        } else {
            return true;
        }
    }

    // User Account Activation Model
    public function activate($email,$token,$scope) {
        // Checking if a token was generated for the user
        $row = $this->fetch('tokens', '*', 'token_for', $email, "AND token='$token' AND token_scope='$scope' LIMIT 1");

        if ($row) {
            $stored_token = $row->token;
            $expiry = $row->token_expiry; 

            if ($row->token_status == '1') {
                return 'already_active';
            } elseif ($token == $stored_token) {
                if (time() > $expiry) {
                    // Token has expired
                    $delete = $this->db->delete('tokens', array('token' => $stored_token));

                    if ($delete) {
                        exit();
                    } else {
                        //Todo: log issue
                        echo 'An internal server error has occurred, we have been notified and will fix it ASAP';
                    }
                } else {
                    $this->db->delete('tokens', array('token' => $stored_token));

                    // Activate the user
                    $data = [
                        'activated'  =>  '1'
                    ];

                    $this->update($email, $data, 'users', 'email');
                    //ToDo: Send A Welcome Email with some categories
                    return true;
                }
            }
        } else {
            return false;
        } 
    }
}