<?php 


/**
* 
*/
class Model_m extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function dodaj($tabela, $dane)
	{
		$this->db->insert($tabela, $dane);
	}

	public function update($tabela, $dane, $par1, $par2)
	{
		$this->db->where($par1, $par2);
		$this->db->update($tabela, $dane); 
	}

	public function get($tabela)
	{
		$query = $this->db->get($tabela);
		return $query->result();
	}

	public function where($par1, $par2, $tabela)
	{
		$this->db->where($par1, $par2);
		$query = $this->db->get($tabela); 
		if ($query->num_rows() > 0)
		{
			return 0;
		}
		else
		{
			return 1;
		}
	}

	public function log($login, $haslo, $tabela)
	{
		$this->db->where('login', $login);
		$query = $this->db->get($tabela); 
		if ($query->num_rows() > 0)
		{
			$wiersz=$query->row();
			$haslo_hash=$wiersz->haslo;

			if ((password_verify($haslo, $haslo_hash)))
			{
				return 2;  //zalogowano
			}
			else
			{
				return 3;  //nie prawidlowe hasło
			}
		}
		else
		{
			return 0;  //nie jesteje taki login
		}
	}

	public function pobierzgdzie($par1, $par2, $tabela)
	{
		$this->db->where($par1, $par2);
		$query = $this->db->get($tabela); 
		if ($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return FALSE;
		}
	}

	
}