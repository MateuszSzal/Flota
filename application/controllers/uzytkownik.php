<?php 

class Uzytkownik extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Model_m');
	}

	public function Index()
	{
		$dane['assets_url']=base_url() . 'assets';
		if($this->session->userdata('zalogowany')!=FALSE)
		{
			$zalogowany=$this->session->userdata('zalogowany');
			if ($zalogowany==TRUE)
			{
				echo "Witaj ".$this->session->userdata('login');
			}
			else
				echo "bład...";
		}
		else
		{
			$dane['rekordy']=$this->Model_m->get('konto_uzytkownika');
			
			$this->load->view('indexx', $dane);
		}

	}

	public function Rejestracja()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('imie', 'Imię', 'required|min_length[4]');
		$this->form_validation->set_rules('e_mail', 'Email', 'callback_email_check');
		$this->form_validation->set_rules('telefon', 'Hasło', 'required');
		$this->form_validation->set_rules('rodzaj_konta', 'Rodzaj konta', 'required');
		$this->form_validation->set_rules('haslo', 'Hasło', 'required');
		$this->form_validation->set_rules('haslo2', 'Hasła', 'required|matches[haslo]');
		$this->form_validation->set_rules('nazwisko', 'Nazwisko', 'required|min_length[4]');
		$this->form_validation->set_rules('login', 'Login', 'callback_username_check');
		$this->form_validation->set_message('required', 'Pole %s jest wymagane');
		$this->form_validation->set_message('min_length', 'Pole %s jest za krótkie');
		$this->form_validation->set_message('valid_email', 'To nie jest poprawny email');
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('rejestracja');
		}
		else
		{
			
			$data['nazwisko']=ucwords($this->input->post('nazwisko'));
			$data['imie']=ucwords($this->input->post('imie'));
			$data['telefon']=$this->input->post('telefon');
			$data['e_mail']=strtolower($this->input->post('e_mail'));
			$data['login']=strtolower($this->input->post('login'));			
			$data['haslo']=password_hash($this->input->post('haslo'), PASSWORD_DEFAULT);
			$data['rodzaj_konta']=$this->input->post('rodzaj_konta');
			
			$this->Model_m->dodaj('konto_uzytkownika', $data);
			$this->load->view('formsuccess', $data);
		}
	}

	public function zaloguj()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('haslo', 'Hasło', 'required');
		$this->form_validation->set_rules('login', 'Login', 'required');
		$this->form_validation->set_message('required', 'Pole %s jest wymagane');
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('zaloguj');
		}
		else
		{
			$data['login']=strtolower($this->input->post('login'));			
			$data['haslo']=$this->input->post('haslo');
			
			$odp=$this->Model_m->log($data['login'], $data['haslo'], 'konto_uzytkownika');
			if($odp==2) //zalogowano
			{

				$newdata = array(                       //dodanie do sesji info o zalogowaniu
                   'login'  => $data['login'],
                   'zalogowany' => TRUE
               );

				$this->session->set_userdata($newdata);
				$url=base_url();
				header('location: '.$url.'uzytkownik');
			}
			elseif ($odp==3)
			{
				$dane['komunikat']="Nie prawidlowe haslo";
				$this->load->view('zaloguj', $dane);
			}
			elseif ($odp==0)
			{
				$dane['komunikat']="Nie istnieje użytkownik o takim loginie";
				$this->load->view('zaloguj', $dane);
			}
			else
			{
				echo "Grubszy bład... ;///";
			}
		}
	}

	public function modyfikacja()
	{
		if($this->session->userdata('zalogowany')!=FALSE)
		{
			$zalogowany=$this->session->userdata('zalogowany');
			if ($zalogowany==TRUE)
			{
				$this->load->helper('form');
				$this->load->library('form_validation');
				$this->form_validation->set_rules('imie', 'Imię', 'min_length[4]');
				$this->form_validation->set_rules('telefon', 'Hasło');
				$this->form_validation->set_rules('haslo', 'Hasło');
				$this->form_validation->set_rules('haslo2', 'Hasła', 'matches[haslo]');
				$this->form_validation->set_rules('nazwisko', 'Nazwisko', 'min_length[4]');
				$this->form_validation->set_message('required', 'Pole %s jest wymagane');
				$this->form_validation->set_message('min_length', 'Pole %s jest za krótkie');
				if ($this->form_validation->run() == FALSE)
				{
					$dane['rekordy']=$this->Model_m->pobierzgdzie('login', $this->session->userdata('login'), 'konto_uzytkownika');
					$this->load->view('modyfikacja', $dane);
				}
				else
				{
					
					if($this->input->post('nazwisko')!="")
						$dane['nazwisko']=ucwords($this->input->post('nazwisko'));
					if($this->input->post('imie')!="")
						$dane['imie']=ucwords($this->input->post('imie'));
					if($this->input->post('telefon')!="")
						$dane['telefon']=$this->input->post('telefon');	
					if($this->input->post('haslo')!="")
						$dane['haslo']=password_hash($this->input->post('haslo'), PASSWORD_DEFAULT);
					
					$this->Model_m->update('konto_uzytkownika', $dane, 'login', $this->session->userdata('login'));
					echo "update";
				}

			}
			else
				echo "bład...";
		}
		else
		{
			header('location: '.$url.'zaloguj');
		}
	}

	public function wyloguj()
	{
		//$array_items = array('login' => '', 'zalogowany' => '');
		//$this->session->unset_userdata($array_items);
		echo "Wylogowano";
		$this->session->sess_destroy();
	}




	function username_check($str)
	{
		$wynik=$this->Model_m->where('login', $str, 'konto_uzytkownika');

		if($str=='')
		{
			$this->form_validation->set_message('username_check', 'Podaj login');
			return FALSE;
		}
		if ($wynik==0)
		{
			$this->form_validation->set_message('username_check', 'Login %s istnieje juz w bazie danych, wybierz inny :)');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	function email_check($str)
	{
		$wynik=$this->Model_m->where('e_mail', $str, 'konto_uzytkownika');

		if($str=='')
		{
			$this->form_validation->set_message('email_check', 'Podaj email');
			return FALSE;
		}
		if ($wynik==0)
		{
			$this->form_validation->set_message('email_check', 'E-mail %s istnieje juz w bazie danych, wybierz inny :)');
			return FALSE;
		}
		else
		{
			return TRUE;
		}	
	}



}