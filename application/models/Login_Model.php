<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Login_Model extends ci_Model
{

	public function ceklogin()
	{
		//variable
		$user=$this->input->post("user");
		$pass=MD5($this->input->post("pass"));

		$q="select * from pengguna where username='$user' and password='$pass'";
		$db=$this->db->query($q);

		$qp="select * from petugas where username='$user' and password='$pass'";
		$dbp=$this->db->query($qp);

		if ($db->num_rows()!=0)
		{
			$db=$db->row();
			if($db->level=="1")
			{
				$data=array(
					'level'			=> 'Administrator',
					'id'			=> $db->id,
					'nama'			=> $db->nama,
					'jabatan'		=> $db->jabatan,
					'wilayah'		=> $db->wilayah,
					'date_created'	=> $db->date_created,
				);
				$this->session->set_userdata($data);
				redirect('dashboard');
			}
			elseif ($db->level=="2") 
			{
				$data=array(
					'level'			=> 'Direksi',
					'id'			=> $db->id,
					'nama'			=> $db->nama,
					'jabatan'		=> $db->jabatan,
					'wilayah'		=> $db->wilayah,
					'date_created'	=> $db->date_created,
				);
				$this->session->set_userdata($data);
				redirect('dashboard');
			}
			elseif ($db->level=="3") 
			{
				$data=array(
					'level'			=> 'KKW',
					'id'			=> $db->id,
					'nama'			=> $db->nama,
					'jabatan'		=> $db->jabatan,
					'wilayah'		=> $db->wilayah,
					'date_created'	=> $db->date_created,
				);
				$this->session->set_userdata($data);
				redirect('dashboard/ksk');
			}
			elseif ($db->level=="5") 
			{
				$data=array(
					'level'			=> 'Remedial',
					'id'			=> $db->id,
					'nama'			=> $db->nama,
					'jabatan'		=> $db->jabatan,
					'wilayah'		=> $db->wilayah,
					'date_created'	=> $db->date_created,
				);
				$this->session->set_userdata($data);
				redirect('dashboard/remedial');
			}
		} 
		elseif ($dbp->num_rows()!=0) 
		{
			$dbp=$dbp->row();
			if($dbp->level=="4")
			{
				$data=array(	
					'level'			=> 'AO',
					'nip'			=> $dbp->nip,
					'posisi'			=> $dbp->posisi,
					'nama'			=> $dbp->nama,
					'wilayah'		=> $dbp->wilayah,
					'kd_petugas'	=> $dbp->kd_petugas,
					'date_created'	=> $db->date_created,
				);
				$this->session->set_userdata($data);
				redirect('dashboard/ao');
			}
		} 
		else
		{
			$this->session->set_flashdata('hapus', '<span class="glyphicon glyphicon-ok"></span> Maaf! user dan pass salah!');
			redirect('login');
		}
	}
}
?>