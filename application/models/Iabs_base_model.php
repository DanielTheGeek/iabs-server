<?php
defined('BASEPATH') OR exit('Missed a step, right?');

	/**
	 * IABS Base Model
	 * @since      1.0
     * @author     Daniel Omoniyi     
	*/

	class Iabs_base_model extends CI_Model {

		public function __construct() {
			parent::__construct();
		}

		public function maybe_create_table( $table, $params='', $fields='' ) {
			//ToDo: restructure method
			$this->load->database( $params );
			$this->load->dbforge();

			$this->dbforge->add_field( $fields );
            $this->dbforge->add_key( 'id', TRUE );
			$create = $this->dbforge->create_table( $table, TRUE );

			if ( $create ) {
				return true;
			} else {
				return false;
			}
		}

		public function create_base_tables( $params, $userdata ) {
            $this->load->database( $params );
            $this->load->dbforge();

            $tinyint_type_switch = ( $params['dbdriver'] == 'postgre' ) ? 'SMALLINT' : 'TINYINT' ;
            $id_type_switch = ( $params['dbdriver'] == 'postgre' ) ? 'SERIAL' : 'INT' ;
            
		    $fields = array(
                'uid' => array(
                    'type'          => 'BIGINT',
                    'constraint'    => '15',
                    'unique'        => TRUE
                ),
                'user_name' => array(
                    'type'          =>'VARCHAR',
                    'constraint'    => '20',
                    'unique'        => TRUE
                ),
                'user_secret' => array(
                    'type'          => 'VARCHAR',
                    'constraint'    => '255',
                    'unique'        => TRUE
                ),
                'user_email' => array(
                    'type'          => 'VARCHAR',
                    'constraint'    => '100',
                    'unique'        => TRUE
                ),
                'user_status' => array(
                    'type'      => $tinyint_type_switch,
                    'default'   => '0',
                    'null'      =>  TRUE
                ),
                'user_activation_key' => array(
                    'type'      => 'BIGINT',
                    'constraint'=> '11',
                    'unique'    => TRUE,
                    'null'      => TRUE
                ),
                'user_registered' => array(
                    'type' => 'VARCHAR',
                    'null' =>   TRUE,
                    'constraint' => '250'
                ),
                'is_online' => array(
                    'type'  =>  $tinyint_type_switch,
                    'null'  =>  TRUE
                ),
                'last_seen' => array(
                    'type'          => 'VARCHAR',
                    'null'          =>  TRUE,
                    'constraint'    =>  '250'
                )
            );
            
            $this->dbforge->add_field( $fields );
            $this->dbforge->add_key( "uid", TRUE );
			$this->dbforge->create_table( 'users', TRUE );
            
            $fields = array(
                'user_id' => array(
                    'type' => 'BIGINT',
                    'constraint' => '15'
                ),
                'meta_key' => array(
                    'type'          =>  'VARCHAR',
                    'constraint'    =>  '191'
                ),
                'meta_value' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                )
            );
            
            $this->dbforge->add_field( $fields );
            $this->dbforge->add_key( "user_id", TRUE );
			$this->dbforge->create_table( 'usermeta', TRUE );
            
            $fields = array(
                'option_name' => array(
                    'type'          =>  'VARCHAR',
                    'constraint'    =>  '191',
                    'unique'        =>  TRUE
                ),
                'option_value' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'option_status' => array(
                    'type'    =>  $tinyint_type_switch,
                    'default' =>  '0'
                )
            );

            $this->dbforge->add_field( $fields );
            $this->dbforge->add_field( "id", TRUE );
			$this->dbforge->create_table( 'options', TRUE );

            $fields = array(
                'id' => array(
                    'type'              => $id_type_switch,
                    'auto_increment'    => TRUE,
                    'null'              => FALSE   
                ),
                'system_name' => array(
                    'type'          =>  'VARCHAR',
                    'constraint'    =>  150,
                    'unique'        =>  TRUE
                ),
                'name' => array(
                    'type'          =>  'VARCHAR',
                    'constraint'    =>  150,
                    'null'          =>  FALSE
                ),
                'status' => array(
                    'type'    =>    $tinyint_type_switch,
                    'default' =>    1,
                    'null'    =>    FALSE
                ),
                'uri' => array(
                    'type'          =>  'VARCHAR',
                    'constraint'    =>  255,
                    'null'          =>  TRUE
                ),
                'version' => array(
                    'type'          =>  'VARCHAR',
                    'constraint'    =>  10,
                    'null'          =>  FALSE
                ),
                'description' => array(
                    'type'          =>  'VARCHAR',
                    'constraint'    =>  255,
                    'null'          =>  TRUE
                ),
                'author' => array(
                    'type'          =>  'VARCHAR',
                    'constraint'    =>  50,
                    'null'          =>  TRUE
                ),
                'author_uri' => array(
                    'type'          =>  'VARCHAR',
                    'constraint'    =>  255,
                    'null'          =>  TRUE
                ),
                'data' => array(
                    'type'    =>  'TEXT'
                )
            );
            
            $this->dbforge->add_field( $fields );
            $this->dbforge->add_field( "id", TRUE );
            $this->dbforge->create_table( 'plugins', TRUE );
                                          
            $data = array(
                array(
                    'option_name'   =>  'site_name',
                    'option_value'  =>  $userdata['site_name'],
                    'option_status' =>  '1'
                ),
                array(
                    'option_name'   =>  'site_frontend_url',
                    'option_value'  =>  base_url(),
                    'option_status' =>  '1'
                ),
                array(
                    'option_name'   =>  'site_backend_url',
                    'option_value'  =>  base_url(),
                    'option_status' =>  '1'
                ),
                array(
                    'option_name'   =>  'site_backend_desc',
                    'option_value'  =>  '',
                    'option_status' =>  '1'
                ),
                array(
                    'option_name'   =>  'super_admin_email',
                    'option_value'  =>  $userdata['email'],
                    'option_status' =>  '1'
                ),
                array(
                    'option_name'   =>  'multiple_users',
                    'option_value'  =>  'false',
                    'option_status' =>  '1'
                ),
                array(
                    'option_name'   =>  'week_starts',
                    'option_value'  =>  '1',
                    'option_status' =>  '1'
                ),
                array(
                    'option_name'   =>  'mail_method',
                    'option_value'  =>  'local',
                    'option_status' =>  '1'
                ),
                array(
                    'option_name'   =>  'mail_server',
                    'option_value'  =>  'mail.example.com',
                    'option_status' =>  '1'
                ),
                array(
                    'option_name'   =>  'mail_server_login',
                    'option_value'  =>  'user@example.com',
                    'option_status' =>  '1'
                ),
                array(
                    'option_name'   =>  'mail_server_secret',
                    'option_value'  =>  '',
                    'option_status' =>  '1'
                ),
                array(
                    'option_name'   =>  'is_maintenance',
                    'option_value'  =>  'true',
                    'option_status' =>  '1'
                )
            );
            
            $data2 = array(
                array(
                    'user_id'       =>  $userdata['uid'],
                    'meta_key'      =>  'first_name',
                    'meta_value'    =>  ''
                ),
                array(
                    'user_id'       =>  $userdata['uid'],
                    'meta_key'      =>  'last_name',
                    'meta_value'    =>  ''
                ),
                array(
                    'user_id'       =>  $userdata['uid'],
                    'meta_key'      =>  'description',
                    'meta_value'    =>  ''
                ),
                array(
                    'user_id'       =>  $userdata['uid'],
                    'meta_key'      =>  'user_level',
                    'meta_value'    =>  'administrator'
                )
            );
            
            $data3 = array(
                'uid'            =>     $userdata['uid'],
                'user_name'      =>     $userdata['username'],
                'user_secret'    =>     $userdata['secret'],
                'user_email'     =>     $userdata['email'],
                'user_status'    =>     1,
                'user_registered'=>     time()
            );

            if ( $this->db->table_exists( 'users' ) && 
                 $this->db->table_exists( 'usermeta' ) &&
                 $this->db->table_exists( 'options' )
               )
            {   
                $this->db->insert_batch( 'options', $data );
                $this->db->insert_batch( 'usermeta', $data2 );
                $this->db->insert( 'users', $data3 );
                
                return true;
            } else {
                return false;
            }
		}
	}
?>