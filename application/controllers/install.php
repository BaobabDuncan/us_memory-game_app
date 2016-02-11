<?php
class Install extends CI_Controller{

	private $_dbnaem = 'memory_game';
	private $_user_db = 'user';
	private $_admin_db = 'admin';
	private $_page_db = 'page';
	private $_game_image_db = 'image';
	private $_ranking_db = 'ranking';
	private $_game_db = 'game';

	public function __construct()
	{
		parent::__construct();
		$this->load->dbforge();
	}
	public function index()
	{

		//$this->createDatabase();
		//$this->createFbUserTable();
		$this->createAdminTable();
		$this->createGameImageTable();
		$this->createGameTable();
		$this->createPageTable();
		
		
		$this->createUserTable();
		$this->createRankingTable();

	}
	private function createDatabase()
	{
		try {
			$this->dbforge->create_database($_dbnaem);
		} catch (Exception $e) {
			echo 'Database created!';
		}
	}
	private function createPageTable()
	{
		if ($this->db->table_exists($this->_page_db))
		{
			echo "Table ".$this->_page_db." already exists<br>";
		} else
		{
			$fields = array(
				'page_id' => array(
					'type' => 'VARCHAR',
					'constraint' => '100',				
				),		
				'admin_id' => array(
					'type' => 'VARCHAR',
					'constraint' => '100',
				),
				'page_status' => array(
					'type' => 'INT',
					'constraint' => 1,
				),
				'page_title' => array(
					'type' => 'VARCHAR',
					'constraint' => '100',
				));

			$this->dbforge->add_field($fields);			
			$this->dbforge->add_key('page_id', TRUE);
			$this->dbforge->add_key('admin_id');			
			$this->dbforge->create_table($this->_page_db);
			echo "Table ".$this->_page_db." create<br>";
		}
	}
	private function createGameImageTable()
	{
		if ($this->db->table_exists($this->_game_image_db))
		{
			echo "Table ".$this->_game_image_db." already exists<br>";
		} else
		{
			$fields = array(
				'image_id' => array(
					'type' => 'INT',
					'constraint' => 5,
					'auto_increment' => TRUE
				),		
				'admin_fb_id' => array(
					'type' => 'VARCHAR',
					'constraint' => '100',
				),		
				'image_fb_id' => array(
					'type' => 'VARCHAR',
					'constraint' => '100',
				),
				'src' => array(
					'type' => 'VARCHAR',
					'constraint' => '150',
				),
				'src_small' => array(
					'type' => 'VARCHAR',
					'constraint' => '150',
				));

			$this->dbforge->add_field($fields);
			$this->dbforge->add_key('image_id');
			$this->dbforge->add_key('image_fb_id', TRUE);
			$this->dbforge->add_key('admin_fb_id');			
			$this->dbforge->create_table($this->_game_image_db);
			echo "Table ".$this->_game_image_db." create<br>";
		}
	}
	private function createAdminTable()
	{
		if ($this->db->table_exists($this->_admin_db))
		{
			echo "Table ".$this->_admin_db." already exists<br>";
		} else
		{
			$fields = array(
				'admin_id' => array(
					'type' => 'INT',
					'constraint' => 5,
					'auto_increment' => TRUE
				),		
				'admin_fb_id' => array(
					'type' => 'VARCHAR',
					'constraint' => '100',
				),		
				'admin_name' => array(
					'type' => 'VARCHAR',
					'constraint' => '100',
				),				
				'buy_status' => array(
					'type' => 'INT',
					'constraint' => 1,
				),				
				'game_count' => array(
					'type' => 'INT',
					'constraint' => 1,
				));

			$this->dbforge->add_field($fields);
			$this->dbforge->add_key('admin_fb_id',TRUE);	
			$this->dbforge->add_key('admin_id' );									
			$this->dbforge->create_table($this->_admin_db);
			echo "Table ".$this->_admin_db." create<br>";
		}
	}
	private function createUserTable()
	{
		if ($this->db->table_exists($this->_user_db))
		{
			echo "Table ".$this->_user_db." already exists<br>";
		} else
		{
			$fields = array(
				'user_id' => array(
					'type' => 'INT',
					'constraint' => 5,
					'auto_increment' => TRUE
				),		
				'user_fb_id' => array(
					'type' => 'VARCHAR',
					'constraint' => '100',
				),		
				'user_name' => array(
					'type' => 'VARCHAR',
					'constraint' => '100',
				));

			$this->dbforge->add_field($fields);
			$this->dbforge->add_key('user_id');
			$this->dbforge->add_key('user_fb_id',TRUE);			
			$this->dbforge->create_table($this->_user_db);
			echo "Table ".$this->_user_db." create<br>";
		}
	}
	private function createRankingTable()
	{
		if ($this->db->table_exists($this->_ranking_db))
		{
			echo "Table ".$this->_ranking_db." already exists<br>";
		} else
		{
			$fields = array(
				'ranking_id' => array(
					'type' => 'INT',
					'constraint' => 5,
					'auto_increment' => TRUE
				),
				'update_at' => array(
					'type' => 'DATETIME'					
					),
				'game_id' => array(
					'type' => 'VARCHAR',
					'constraint' => '100'					
					),
				'user_fb_id' => array(
					'type' => 'VARCHAR',
					'constraint' => '100'					
					),
				'user_name' => array(
					'type' => 'VARCHAR',
					'constraint' => '100',
					),
				'click_count' => array(
					'type' => 'INT',
					'constraint' => 5,
				),
				'game_time' => array(
					'type' => 'VARCHAR',
					'constraint' => '13',
				),
				'game_score' => array(
					'type' => 'INT',
					'constraint' => 7,
				));

			$this->dbforge->add_field($fields);
			$this->dbforge->add_key('ranking_id', TRUE);
			$this->dbforge->add_key('game_id');
			$this->dbforge->add_key('user_fb_id');
			$this->dbforge->create_table($this->_ranking_db);
			echo "Table ".$this->_ranking_db." create<br>";
		}
	}
	private function createGameTable()
	{
		if ($this->db->table_exists($this->_game_db))
		{
			echo "Table ".$this->_game_db." already exists<br>";
		} else
		{
			$fields = array(
				'game_id' => array(
					'type' => 'INT',
					'constraint' => 5,
					'auto_increment' => TRUE
				),
				'admin_id' => array(
					'type' => 'VARCHAR',
					'constraint' => '100'							
				),
				'page_id' => array(
					'type' => 'VARCHAR',
					'constraint' => '100',
				),
				'title' => array(
					'type' => 'VARCHAR',
					'constraint' => '100'					
				),
				
				'detail' => array(
					'type' => 'TEXT',
					'null' => TRUE,
				),
				'feed_message' => array(
					'type' => 'VARCHAR',
					'constraint' => '150'					
				),
				'level' => array(
					'type' => 'INT',
					'constraint' => 1,
				),
				'join_count' => array(
					'type' => 'INT',
					'constraint' => 5,
				),
				'active' => array(
					'type' => 'INT',
					'constraint' => 1,
				));

				$this->dbforge->add_field($fields);
				$this->dbforge->add_key('game_id', TRUE);
				$this->dbforge->add_key('page_id');
				$this->dbforge->add_key('admin_id');
				$this->dbforge->create_table($this->_game_db);
				echo "Table ".$this->_game_db." create<br>";
		}
	}

}