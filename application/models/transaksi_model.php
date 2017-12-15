<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transaksi_model extends CI_Model {
	
	function where($where = '') {
		if($where != '') $this->db->where($where);
		return $this;
	}
	
	function set_limit($limit, $start = 0) {
    	$this->db->limit($limit, $start);
        return $this;
    }
	
	function order_by($field, $direction = 'asc') {
		$this->db->order_by($field, $direction);
		return $this;
	}
	
	function like($field, $keyword, $pattern = 'both') {
		$this->db->like($field, $keyword, $pattern);
		return $this;
	}
	
	function or_like($field, $keyword = '', $pattern = 'both'){
		if($keyword != '') $this->db->or_like($field, $keyword, $pattern);
		else  $this->db->or_like($field);
		return $this;
	}
	
	function group_by($group_by = ''){
		$this->db->group_by($group_by);
		return $this;
	}
	
	/* ---------------------------------------- All About Admin ------------------------- */
	
	function get_row(){
		return $this->db->get('transaksi')->row_array();
	}
	
	function get_all(){
		return $this->db->get('transaksi')->result_array();
	}
	
	function posts($data){
		return $this->db->insert('transaksi', $data);
	}
	
	function puts($data){
		return $this->db->update('transaksi', $data);
	}
	
	function delete($data){
		return $this->db->delete('transaksi', $data);
	}

	function get_customer_skip($query_opt = '') {
		$this->db->select("COUNT(trans_id_layanan) as jumlah,
			  $query_opt
			  ");
		$this->db->from('transaksi');
		$this->db->join('layanan', 'trans_id_layanan = lay_id_layanan', 'left');
		$this->db->join('group_layanan', 'trans_id_group_layanan = grolay_id_group_layanan', 'left');
		$this->db->join('lokets', 'trans_id_loket = lokets_id', 'left');
		$this->db->where(array('trans_status_transaksi' => 3)); 

		return $this->db->get()->row_array();
	}

	function get_customer_sedangdilayani($query_opt = '') {
		$this->db->select("COUNT(trans_id_layanan) as jumlah,
			  $query_opt
			  ");
		$this->db->from('transaksi');
		$this->db->join('layanan', 'trans_id_layanan = lay_id_layanan', 'left');
		$this->db->join('group_layanan', 'trans_id_group_layanan = grolay_id_group_layanan', 'left');
		$this->db->join('lokets', 'trans_id_loket = lokets_id', 'left');
		$this->db->where(array('trans_status_transaksi' => 2));

		return $this->db->get()->row_array();
	}
	
	function get_customer_tidakterlayani($query_opt = '') {
		$this->db->select("COUNT(trans_id_layanan) as jumlah,
			  $query_opt
			  ");
		$this->db->from('transaksi');
		$this->db->join('layanan', 'trans_id_layanan = lay_id_layanan', 'left');
		$this->db->join('group_layanan', 'trans_id_group_layanan = grolay_id_group_layanan', 'left');
		$this->db->join('lokets', 'trans_id_loket = lokets_id', 'left');
		$this->db->where(array('trans_status_transaksi' => 0));

		return $this->db->get()->row_array();
	}

	function get_customer_terlayani($query_opt = '') {
		$this->db->select("COUNT(trans_id_layanan) as jumlah,
			  $query_opt
			  ");
		$this->db->from('transaksi');
		$this->db->join('layanan', 'trans_id_layanan = lay_id_layanan', 'left');
		$this->db->join('group_layanan', 'trans_id_group_layanan = grolay_id_group_layanan', 'left');
		$this->db->join('lokets', 'trans_id_loket = lokets_id', 'left');
		$this->db->where(array('trans_status_transaksi' => 5));

		return $this->db->get()->row_array();
	}

    function get_all_loket_info() {
        $q = 'SELECT * 
		FROM anf_prioritas_layanan
		JOIN anf_group_layanan ON (prilay_id_group_layanan = grolay_id_group_layanan)
		JOIN anf_layanan ON (grolay_id_group_layanan = lay_id_group_layanan)
		JOIN anf_grouplokets ON (prilay_id_group_loket = grolok_id)
		JOIN anf_lokets ON (grolok_id = lokets_grolok_id)
		ORDER BY lokets_id';

        $vItems = array(
            'layanan_info' 				=> array(),
            'loket_info' 				=> array(),
            'user_info' 				=> array(),
            'loket_num_status' 			=> array(),
            'num_status' 				=> array(),
            'waktu_performance' 		=> array(),
            'waktu_melayani_second' 	=> array(),
        );
        $query = $this->db->query($q);
        foreach ($query->result() as $vRow)
        {
            $vItems['layanan_info'][$vRow->lay_id_layanan] = $vRow->lay_nama_layanan;
            $vItems['loket_info'][$vRow->lokets_id] = $vRow->lokets_name;
            $vItems['user_info'][$vRow->lokets_id] = '-';

            $vItems['loket_num_status'][$vRow->lokets_id][$vRow->lay_id_layanan][0] = 0;
            $vItems['loket_num_status'][$vRow->lokets_id][$vRow->lay_id_layanan][1] = 0;
            $vItems['loket_num_status'][$vRow->lokets_id][$vRow->lay_id_layanan][2] = 0;
            $vItems['loket_num_status'][$vRow->lokets_id][$vRow->lay_id_layanan][3] = 0;
            $vItems['loket_num_status'][$vRow->lokets_id][$vRow->lay_id_layanan][5] = 0;

            $vItems['num_status'][$vRow->lokets_id][0] = 0;
            $vItems['num_status'][$vRow->lokets_id][1] = 0;
            $vItems['num_status'][$vRow->lokets_id][2] = 0;
            $vItems['num_status'][$vRow->lokets_id][3] = 0;
            $vItems['num_status'][$vRow->lokets_id][5] = 0;
        }
        return $vItems;
    }

	function get_loket_info($now = true) {

	    $where = '';
	    if($now) {
            $date_now = date('Y-m-d');
            $date_now = str_replace('-', '', $date_now);
            $where = ' WHERE trans_tanggal_transaksi = "' . $date_now . '" ';
        }
		
		$q = 'SELECT 
		trans_id_transaksi, trans_id_loket, trans_id_layanan, trans_status_transaksi, lay_nama_layanan, lokets_name, trans_id_user, admusr_username, TIME_TO_SEC(TIMEDIFF(trans_waktu_finish, trans_waktu_panggil)) as waktu_performance, TIME_TO_SEC(TIMEDIFF(CURTIME(), trans_waktu_panggil)) as waktu_melayani_second 
		FROM anf_transaksi
		LEFT JOIN anf_layanan ON (trans_id_layanan = lay_id_layanan)
		LEFT JOIN anf_group_layanan ON (trans_id_group_layanan = grolay_id_group_layanan)
		LEFT JOIN anf_lokets ON (trans_id_loket = lokets_id) 
		LEFT JOIN anf_adminusers ON (trans_id_user = admusr_id) 
		'.$where.' 
		ORDER BY trans_id_loket';

		$vItems = array(
			'layanan_info' 				=> array(),
			'loket_info' 				=> array(),
			'user_info' 				=> array(),
			'loket_num_status' 			=> array(),
			'num_status' 				=> array(),
			'waktu_performance' 		=> array(),
			'waktu_melayani_second' 	=> array(),
		);
		$query = $this->db->query($q);
		foreach ($query->result() as $vRow)
		{
			$vItems['layanan_info'][$vRow->trans_id_layanan] = $vRow->lay_nama_layanan;
			$vItems['loket_info'][$vRow->trans_id_loket] = $vRow->lokets_name;
			$vItems['user_info'][$vRow->trans_id_loket] = $vRow->admusr_username;

			if(!empty($where)) {
                if(empty($vItems['loket_num_status'][$vRow->trans_id_loket][$vRow->trans_id_layanan][$vRow->trans_status_transaksi])) {
                    $vItems['loket_num_status'][$vRow->trans_id_loket][$vRow->trans_id_layanan][$vRow->trans_status_transaksi] = 1;
                } else {
                    $vItems['loket_num_status'][$vRow->trans_id_loket][$vRow->trans_id_layanan][$vRow->trans_status_transaksi]++;
                }

                if(empty($vItems['num_status'][$vRow->trans_id_loket][$vRow->trans_status_transaksi])) {
                    $vItems['num_status'][$vRow->trans_id_loket][$vRow->trans_status_transaksi] = 1;
                } else {
                    $vItems['num_status'][$vRow->trans_id_loket][$vRow->trans_status_transaksi]++;
                }

                if($vRow->trans_status_transaksi == 5 AND !empty($vRow->waktu_performance)) {
                    $vItems['waktu_performance'][$vRow->trans_id_loket][$vRow->trans_id_transaksi] = ceil($vRow->waktu_performance / 60);
                }

                if($vRow->trans_status_transaksi == 2 AND !empty($vRow->waktu_melayani_second)) {
                    $vItems['waktu_melayani_second'][$vRow->trans_id_loket] = ceil($vRow->waktu_melayani_second / 60);
                }
            } else {
                $vItems['loket_num_status'][$vRow->trans_id_loket][$vRow->trans_id_layanan][$vRow->trans_status_transaksi] = 0;

                $vItems['num_status'][$vRow->trans_id_loket][$vRow->trans_status_transaksi] = 0;
            }
		}
		return $vItems;
	}

	function get_layanan_info() {
		$date_now = date('Y-m-d');
		$date_now = str_replace('-', '', $date_now);

		$q = 'SELECT 
		trans_id_loket, lokets_name, trans_id_layanan, trans_status_transaksi, lay_nama_layanan, TIME_TO_SEC(TIMEDIFF(trans_waktu_panggil, trans_waktu_ambil)) as waktu_tunggu, TIME_TO_SEC(TIMEDIFF(trans_waktu_finish, trans_waktu_panggil)) as waktu_melayani
		FROM anf_transaksi
		LEFT JOIN anf_layanan ON (trans_id_layanan = lay_id_layanan)
		LEFT JOIN anf_group_layanan ON (trans_id_group_layanan = grolay_id_group_layanan)
		LEFT JOIN anf_lokets ON (trans_id_loket = lokets_id) 
		LEFT JOIN anf_adminusers ON (trans_id_user = admusr_id) 
		WHERE trans_tanggal_transaksi = "' . $date_now . '"
		ORDER BY trans_id_layanan';

		$vItems = array(
			'layanan_info' 				=> array(),
			'loket_info' 				=> array(),
			'num_status' 				=> array(),
			'waktu_tunggu' 				=> array(),
			'waktu_layanan' 			=> array(),
		);
		$query = $this->db->query($q);
		foreach ($query->result() as $vRow)
		{
			$vItems['layanan_info'][$vRow->trans_id_layanan] = $vRow->lay_nama_layanan;

			if(!empty($vRow->trans_id_loket)) {
				$vItems['loket_info'][$vRow->trans_id_layanan][$vRow->trans_id_loket] = $vRow->lokets_name;
			}

			if(empty($vItems['num_status'][$vRow->trans_id_layanan][$vRow->trans_status_transaksi])) { 
				$vItems['num_status'][$vRow->trans_id_layanan][$vRow->trans_status_transaksi] = 1;
			} else {
				$vItems['num_status'][$vRow->trans_id_layanan][$vRow->trans_status_transaksi]++;
			}

			if($vRow->trans_status_transaksi == 5 AND !empty($vRow->waktu_melayani)) {
				$vItems['waktu_layanan'][$vRow->trans_id_layanan][$vRow->trans_id_transaksi] = ceil($vRow->waktu_melayani / 60);
			}

			if($vRow->trans_status_transaksi == 2 AND !empty($vRow->waktu_tunggu)) {
				$vItems['waktu_tunggu'][$vRow->trans_id_layanan][$vRow->trans_id_transaksi] = ceil($vRow->waktu_tunggu / 60);
			}

		}
		return $vItems;
	}

}

?>