<?php

class Admin_model extends CI_Model
{

  public function __construct()
  {
    parent::__construct();
  }

  //HI
  function tampil_hi (){
    if($this->session->userdata('rolenya') == '1') {
    $get = $this->db->query("SELECT 
          a.id_hi,a.id_unit,hi.updated_at,(SELECT nama_unit FROM unit WHERE id_unit = a.`id_unit`) AS nama_unitnya, 
          ROUND((SUM(hi.bobot_kondisi) + SUM(hi.bobot_urgensi) + SUM(hi.bobot_urgensi) - SUM(hi.bobot_standard) - SUM(hi.bobot_lifetime) - SUM(hi.bobot_gangguan)) / (SUM(hi_standard.bobot_kondisi) + SUM(hi_standard.bobot_urgensi) + SUM(hi_standard.bobot_urgensi))*100) AS total_hi
          FROM network_device a
          JOIN hi ON a.id_hi = hi.id_hi
          JOIN hi_standard ON hi.id_hi_standard = hi_standard.id_hi_standard
          WHERE hi.status = '1'
          AND a.status_terpasang = '1'
          GROUP BY a.id_unit DESC ");
          return $get;
      }
    else {
    $sub_unit = $this->session->userdata('sub_unitnya');
    $get = $this->db->query("SELECT 
          a.id_hi,a.id_unit,hi.updated_at,unit.sub_unit,(SELECT nama_unit FROM unit WHERE id_unit = a.`id_unit`) AS nama_unitnya, 
          ROUND((SUM(hi.bobot_kondisi) + SUM(hi.bobot_urgensi) + SUM(hi.bobot_urgensi) - SUM(hi.bobot_standard) - SUM(hi.bobot_lifetime) - SUM(hi.bobot_gangguan)) / (SUM(hi_standard.bobot_kondisi) + SUM(hi_standard.bobot_urgensi) + SUM(hi_standard.bobot_urgensi))*100) AS total_hi
          FROM network_device a
          JOIN hi ON a.id_hi = hi.id_hi
          JOIN hi_standard ON hi.id_hi_standard = hi_standard.id_hi_standard
          JOIN unit ON unit.id_unit = a.id_unit
          WHERE hi.status = '1'
          AND a.status_terpasang = '1'
          AND unit.sub_unit = $sub_unit
          GROUP BY a.id_unit DESC ");
          return $get; 
    }
  }
  function tampil_non_hi (){
    if($this->session->userdata('rolenya') == '1') {
    $get = $this->db->query("SELECT a.id_hi,a.id_unit,(SELECT nama_unit FROM unit WHERE id_unit = a.`id_unit`) AS nama_unitnya, (SELECT COUNT(`id_unit`)) AS perangkat FROM network_device a WHERE a.id_hi = '0' AND a.status_terpasang = '1' AND a.id_unit != '' GROUP BY a.id_unit");
          return $get;
    } else {
    $sub_unit = $this->session->userdata('sub_unitnya');
    $get = $this->db->query("SELECT a.id_hi,a.id_unit,b.sub_unit,(SELECT nama_unit FROM unit WHERE id_unit = a.`id_unit`) AS nama_unitnya, (SELECT COUNT(a.id_unit)) AS perangkat FROM network_device a JOIN unit b ON b.id_unit = a.id_unit WHERE a.id_hi = '0' AND a.status_terpasang = '1' AND b.sub_unit = $sub_unit GROUP BY a.id_unit");
          return $get;
    }
      }
  function get_hi_unit($id_unit) {
    $get = $this->db->query("SELECT 
          a.*,hi.*,merek.merek,l.label_perangkat,(SELECT nama_unit FROM unit WHERE id_unit = a.`id_unit`) AS nama_unitnya,
          ROUND((hi.bobot_kondisi + hi.bobot_urgensi + hi.bobot_urgensi - hi.bobot_standard - hi.bobot_lifetime - hi.bobot_gangguan) /( hi_standard.bobot_kondisi + hi_standard.bobot_urgensi + hi_standard.bobot_urgensi)*100) AS hi_device
          FROM network_device a
          JOIN merek ON a.id_merek = merek.id_merek
          JOIN hi ON a.id_hi = hi.id_hi
          JOIN hi_standard ON hi.id_hi_standard = hi_standard.id_hi_standard
          LEFT JOIN m_label l ON a.id_network_device = l.assign_to
          WHERE a.id_unit = $id_unit 
          AND hi.status = '1'" );
          return $get;
    }
  function tampil_hi_sumut1 (){
    $get = $this->db->query("SELECT 
          a.id_hi,a.id_unit,hi.updated_at,unit.*,(SELECT nama_unit FROM unit WHERE id_unit = a.`id_unit`) AS nama_unitnya, 
          ROUND((SUM(hi.bobot_kondisi) + SUM(hi.bobot_urgensi) + SUM(hi.bobot_urgensi) - SUM(hi.bobot_standard) - SUM(hi.bobot_lifetime) - SUM(hi.bobot_gangguan)) / (SUM(hi_standard.bobot_kondisi) + SUM(hi_standard.bobot_urgensi) + SUM(hi_standard.bobot_urgensi))*100) AS total_hi
          FROM network_device a
          JOIN hi ON a.id_hi = hi.id_hi
          JOIN hi_standard ON hi.id_hi_standard = hi_standard.id_hi_standard
          JOIN unit ON a.id_unit = unit.id_unit
          WHERE hi.status = '1'
          AND unit.wilayah_kerja = 'Sumut 1'
          AND a.status_terpasang = '1'
          GROUP BY unit.wilayah_kerja DESC ");
           if ($get->num_rows() == 1) {
            return $get->row_array();
          }
      }
  function tampil_hi_sumut2 (){
    $get = $this->db->query("SELECT 
          a.id_hi,a.id_unit,hi.updated_at,unit.*,(SELECT nama_unit FROM unit WHERE id_unit = a.`id_unit`) AS nama_unitnya, 
          ROUND((SUM(hi.bobot_kondisi) + SUM(hi.bobot_urgensi) + SUM(hi.bobot_urgensi) - SUM(hi.bobot_standard) - SUM(hi.bobot_lifetime) - SUM(hi.bobot_gangguan)) / (SUM(hi_standard.bobot_kondisi) + SUM(hi_standard.bobot_urgensi) + SUM(hi_standard.bobot_urgensi))*100) AS total_hi
          FROM network_device a
          JOIN hi ON a.id_hi = hi.id_hi
          JOIN hi_standard ON hi.id_hi_standard = hi_standard.id_hi_standard
          JOIN unit ON a.id_unit = unit.id_unit
          WHERE hi.status = '1'
          AND unit.wilayah_kerja = 'Sumut 2'
          AND a.status_terpasang = '1'
          GROUP BY unit.wilayah_kerja DESC ");
            if ($get->num_rows() == 1) {
            return $get->row_array();
          }
      }
  function tampil_hi_sumut () {
    $get = $this->db->query("SELECT 
          a.id_hi,a.id_unit,hi.updated_at,unit.*,(SELECT nama_unit FROM unit WHERE id_unit = a.`id_unit`) AS nama_unitnya, 
          ROUND((SUM(hi.bobot_kondisi) + SUM(hi.bobot_urgensi) + SUM(hi.bobot_urgensi) - SUM(hi.bobot_standard) - SUM(hi.bobot_lifetime) - SUM(hi.bobot_gangguan)) / (SUM(hi_standard.bobot_kondisi) + SUM(hi_standard.bobot_urgensi) + SUM(hi_standard.bobot_urgensi))*100) AS total_hi
          FROM network_device a
          JOIN hi ON a.id_hi = hi.id_hi
          JOIN hi_standard ON hi.id_hi_standard = hi_standard.id_hi_standard
          JOIN unit ON a.id_unit = unit.id_unit
          WHERE hi.status = '1'
          AND a.status_terpasang = '1'
          GROUP BY hi.status  DESC ");
          if ($get->num_rows() == 1) {
            return $get->row_array();
          }
  }
  function tampil_latest_sumut () {
    $get = $this->db->query("SELECT MAX(updated_at) AS Updated FROM `hi` WHERE status= '1'");
          if ($get->num_rows() == 1) {
            return $get->row_array();
          }
  }
  function tampil_latest_sumut1 () {
    $get = $this->db->query("SELECT a.*,MAX(b.updated_at) AS Updated FROM network_device a JOIN hi b ON b.id_hi = a.id_hi WHERE b.status= '1' AND nama_pengguna = 'stisumut1'");
          if ($get->num_rows() == 1) {
            return $get->row_array();
          }
  }
  function tampil_latest_sumut2 () {
    $get = $this->db->query("SELECT a.*,MAX(b.updated_at) AS Updated FROM network_device a JOIN hi b ON b.id_hi = a.id_hi WHERE b.status= '1' AND nama_pengguna = 'stisumut2'");
          if ($get->num_rows() == 1) {
            return $get->row_array();
          }
  }
  function tampil_best_hi (){
      $get = $this->db->query("SELECT 
            a.id_hi,a.id_unit,hi.updated_at,(SELECT nama_unit FROM unit WHERE id_unit = a.`id_unit`) AS nama_unitnya, 
            ROUND((SUM(hi.bobot_kondisi) + SUM(hi.bobot_urgensi) + SUM(hi.bobot_urgensi) - SUM(hi.bobot_standard) - SUM(hi.bobot_lifetime) - SUM(hi.bobot_gangguan)) / (SUM(hi_standard.bobot_kondisi) + SUM(hi_standard.bobot_urgensi) + SUM(hi_standard.bobot_urgensi))*100) AS total_hi
            FROM network_device a
            JOIN hi ON a.id_hi = hi.id_hi
            JOIN hi_standard ON hi.id_hi_standard = hi_standard.id_hi_standard
            WHERE hi.status = '1'
            AND a.status_terpasang = '1'
            GROUP BY a.id_unit 
            HAVING (ROUND((SUM(hi.bobot_kondisi) + SUM(hi.bobot_urgensi) + SUM(hi.bobot_urgensi) - SUM(hi.bobot_standard) - SUM(hi.bobot_lifetime) - SUM(hi.bobot_gangguan)) / (SUM(hi_standard.bobot_kondisi) + SUM(hi_standard.bobot_urgensi) + SUM(hi_standard.bobot_urgensi))*100)) >= '80' ");
            return $get;
        }
    function tampil_worst_hi (){
      $get = $this->db->query("SELECT 
            a.id_hi,a.id_unit,hi.updated_at,(SELECT nama_unit FROM unit WHERE id_unit = a.`id_unit`) AS nama_unitnya, 
            ROUND((SUM(hi.bobot_kondisi) + SUM(hi.bobot_urgensi) + SUM(hi.bobot_urgensi) - SUM(hi.bobot_standard) - SUM(hi.bobot_lifetime) - SUM(hi.bobot_gangguan)) / (SUM(hi_standard.bobot_kondisi) + SUM(hi_standard.bobot_urgensi) + SUM(hi_standard.bobot_urgensi))*100) AS total_hi
            FROM network_device a
            JOIN hi ON a.id_hi = hi.id_hi
            JOIN hi_standard ON hi.id_hi_standard = hi_standard.id_hi_standard
            WHERE hi.status = '1'
            AND a.status_terpasang = '1'
            GROUP BY a.id_unit 
            HAVING (ROUND((SUM(hi.bobot_kondisi) + SUM(hi.bobot_urgensi) + SUM(hi.bobot_urgensi) - SUM(hi.bobot_standard) - SUM(hi.bobot_lifetime) - SUM(hi.bobot_gangguan)) / (SUM(hi_standard.bobot_kondisi) + SUM(hi_standard.bobot_urgensi) + SUM(hi_standard.bobot_urgensi))*100)) <= '50' ");
            return $get;
        }
  function list_network_device($id_unit){
    $get = $this->db->query("SELECT a.*, m.*,g.id_ggn,g.desk_ggn,g.foto_ggn,g.tgl_gangguan,g.solusi,g.foto_solusi,g.created_at,g.solved_at,g.deleted_at, l.label_perangkat , COUNT(g.id_network_device) as total_ggn
          FROM network_device a 
          JOIN merek m ON a.id_merek = m.id_merek
          LEFT JOIN m_label l ON l.assign_to = a.id_network_device
          LEFT JOIN gangguan g ON g.id_network_device = a.id_network_device
          WHERE (g.id_network_device IS NULL AND a.id_unit = $id_unit AND a.id_hi = '0')
          OR (g.id_network_device IS NOT NULL AND a.id_unit = $id_unit AND a.id_hi = '0')  
          GROUP BY a.id_network_device  DESC  
          ORDER BY `g`.`id_ggn` ASC");
          return $get;
  } 
  function list_unit_hi($id_unit) {
    $get = $this->db->query("SELECT * FROM unit WHERE id_unit = $id_unit");
        return $get;
  }
  function get_id_hi($id_hi){
    $get = $this->db->query("SELECT a.*,network_device.*,merek.* FROM hi a JOIN network_device ON a.id_hi = network_device.id_hi JOIN merek ON network_device.id_merek = merek.id_merek WHERE a.id_hi = $id_hi");
        return $get;
  }
  function get_id_hi_standard($id_hi){
    $get = $this->db->query("SELECT * FROM hi_standard WHERE id_hi_standard = $id_hi");
        return $get;
  }
  function get_max_id_hi(){
    $get = $this->db->query("SELECT MAX(id_hi) AS maxid FROM hi");
        return $get;
  }  
  function get_max_id_hi_standard(){
    $get = $this->db->query("SELECT MAX(id_hi_standard) AS maxidstnd FROM hi_standard");
        return $get;
  }
  public function add_hi($data) {
    $input = $this->db->insert('hi', $data);
    return $input;
  }
  public function add_hi_standard($data) {
    $input = $this->db->insert('hi_standard', $data);
    return $input;
  }
  function update_hi($data, $id_hi) {
    $update = $this->db->update('hi', $data, array('id_hi' => $id_hi));
    return $update;
  }
  //GANGGUAN
  function gangguan(){
    if($this->session->userdata('rolenya') == '1') {
    
    $get = $this->db->query("SELECT a.*,b.*,m.*,u.* FROM gangguan a 
          JOIN network_device b ON a.id_network_device = b.id_network_device  
          JOIN merek m ON b.id_merek = m.id_merek
          JOIN unit u ON b.id_unit = u.id_unit
          WHERE b.status_terpasang = '1'");
    return $get;
    } else {
    $sub_unit = $this->session->userdata('sub_unitnya');
    $get = $this->db->query("SELECT a.*,b.*,m.*,u.* FROM gangguan a 
          JOIN network_device b ON a.id_network_device = b.id_network_device  
          JOIN merek m ON b.id_merek = m.id_merek
          JOIN unit u ON b.id_unit = u.id_unit
          WHERE b.status_terpasang = '1'
          AND u.sub_unit = $sub_unit");
    return $get;
  }
  }
	public function add_gangguan($data) {
    $input = $this->db->insert('gangguan', $data);
    return $input;
  }
  public function update_gangguan($data, $id_ggn) {
    $input = $this->db->update('gangguan', $data, array('id_ggn' => $id_ggn));
    return $input;
  }
  
  function get_gangguan($id_ggn) {
      $get = $this->db->query("SELECT a.*,b.*,m.*,u.* FROM gangguan a 
      JOIN network_device b ON a.id_network_device = b.id_network_device  
      JOIN merek m ON b.id_merek = m.id_merek
      JOIN unit u ON b.id_unit = u.id_unit
      WHERE a.id_ggn = $id_ggn 
      AND b.status_terpasang = '1'");
      if ($get->num_rows() == 1) {
          return $get->row_array();
      }
  }

  //USER
  function search_users($username)
  {
    $get = $this->db->query("SELECT password,id_role
     FROM users where username = '$username' ");
    if ($get->num_rows() == 1) {
      return $get->row_array();
    }
  }
  public function getUser()
	{
		$this->db->select('*');
		$this->db->from('users');
		$query = $this->db->get();
		return $query->result_array();
	}

  function tampil_user()
  {
    $get = $this->db->query("SELECT 
      a.id_users,
      a.username,
      a.password,
      a.id_role,
      (SELECT 
      b.nama_role 
      FROM
      role b 
      WHERE a.id_role = b.id_role) AS nama_role 
      FROM
      users a 
      ORDER BY id_users DESC ");
    return $get;
  }


  public function add_users_data($data)
  {
    $input = $this->db->insert('users', $data);
    return $input;
  }

  function update_users($data, $id_users)
  {
    $update = $this->db->update('users', $data, array('id_users' => $id_users));

    return $update;
  }

  function users_delete($id)
  {
    $delete = $this->db->delete('users', array('id_users' => $id));
    return $delete;
  }

  function get_users($id_users)
  {
    $get = $this->db->query("SELECT *
     FROM users a
     WHERE a.id_users =$id_users");
    if ($get->num_rows() == 1) {
      return $get->row_array();
    }
  }



  //Vendor
  function tampil_vendor()
  {
    $get = $this->db->query("SELECT 
		  *
      FROM
      vendor
      ORDER BY id_vendor DESC ");
    return $get;
  }


  public function add_vendor_data($data)
  {
    $input = $this->db->insert('vendor', $data);
    return $input;
  }

  function update_vendor($data, $id_vendor)
  {
    $update = $this->db->update('vendor', $data, array('id_vendor' => $id_vendor));

    return $update;
  }

  function vendor_delete($id)
  {
    $delete = $this->db->delete('vendor', array('id_vendor' => $id));
    return $delete;
  }

  function get_vendor($id_vendor)
  {
    $get = $this->db->query("SELECT *
     FROM vendor a
     WHERE a.id_vendor =$id_vendor");
    if ($get->num_rows() == 1) {
      return $get->row_array();
    }
  }

//UNIT
  function tampil_unit()
  {
    $get = $this->db->query("SELECT a.id_kantor_induk, a.nama_kantor_induk, a.wilayah_kerja, b.id_unit_level2, b.nama_unit_level2, c.id_unit_level3, c.nama_unit_level3 FROM (unit_level3 c JOIN unit_level2 b ON c.id_unit_level2 = b.id_unit_level2) JOIN kantor_induk a ON c.id_kantor_induk = a.id_kantor_induk GROUP BY c.id_unit_level3");
    return $get;
  }

  function list_unit()
  {
    $get = $this->db->query("SELECT 
      id_unit, nama_unit
      FROM
      unit
      ORDER BY id_unit DESC ");
    return $get;
  }

function unit_level1()
  {
    $this->db->select('*');
    $this->db->group_by('level1');
    $this->db->order_by('id_unit', 'ASC');
    return $this->db->from('unit')->get()->result();
  }

  function unit_level2($level1)
  {
    $this->db->where('level1', $level1);
    $this->db->group_by('level2');
    $this->db->order_by('id_unit', 'ASC');
    return $this->db->from('unit')->get()->result();
  }

  function unit_level3($level2)
  {
    $this->db->where('level2', $level2);
    $this->db->group_by('level3');
    $this->db->order_by('id_unit', 'ASC');
    return $this->db->from('unit')->get()->result();
  }


  public function add_unit_data($kantor_induk, $level2, $level3, $wilayah_kerja)
  {
    
      $data_kantor_induk = array(
          'nama_kantor_induk' => $kantor_induk,
          'wilayah_kerja' => $wilayah_kerja
      );
      $input_kantor_induk = $this->db->insert('kantor_induk', $data_kantor_induk);
      $id_kantor_induk = $this->db->insert_id();
    
      $data_level2 = array(
          'id_kantor_induk' => $id_kantor_induk,
          'nama_unit_level2' => $level2,
      );
      $input_level2 = $this->db->insert('unit_level2', $data_level2);
      $id_unit_level2 = $this->db->insert_id();
    
      $data_level3 = array(
          'id_kantor_induk' => $id_kantor_induk,
          'id_unit_level2' => $id_unit_level2,
          'nama_unit_level3' => $level3
      );

      $update = $this->db->insert('unit_level3', $data_level3);
      return $update;
  }

  function update_unit($data_kantor_induk, $id_kantor_induk, $data_unit_level2, $id_unit_level2, $data_unit_level3, $id_unit_level3)
  {
    
      $update_kantor_induk = $this->db->update('kantor_induk', $data_kantor_induk, array('id_kantor_induk' => $id_kantor_induk));
      $update_unit_level2 = $this->db->update('unit_level2', $data_unit_level2, array('id_unit_level2' => $id_unit_level2));
      $update = $this->db->update('unit_level3', $data_unit_level3, array('id_unit_level3' => $id_unit_level3));

      return $update;
  }

  function unit_delete($id)
  {
    $delete = $this->db->delete('unit_level3', array('id_unit_level3' => $id));
    return $delete;
  }

  function get_unit($id_unit)
  {
    $get = $this->db->query("SELECT a.id_kantor_induk, a.nama_kantor_induk , a.wilayah_kerja, b.id_unit_level2, b.nama_unit_level2, c.id_unit_level3, c.nama_unit_level3 FROM kantor_induk a JOIN unit_level2 b ON b.id_kantor_induk = a.id_kantor_induk JOIN unit_level3 c ON c.id_kantor_induk = a.id_kantor_induk WHERE c.id_unit_level3 = $id_unit GROUP BY c.id_unit_level3 ORDER BY a.id_kantor_induk ASC");
    if ($get->num_rows() == 1) {
      return $get->row_array();
    }
  }


  //Laptop
  function tampil_laptop()
  {
    $get = $this->db->query("SELECT 
      a.*,
      (SELECT 
      nama_unit_level3 
      FROM
      unit_level3 
      WHERE id_unit_level3 = a.`id_unit`) AS nama_unitnya,
      (SELECT 
      merek 
      FROM
      merek 
      WHERE id_merek = a.id_merek) AS nama_mereknya, 
      (SELECT 
      nama_vendor 
      FROM
      vendor 
      WHERE id_vendor = a.id_vendor) AS nama_vendornya  
      FROM
      laptop a 
      ORDER BY a.id_laptop DESC ");
    return $get;
  }

  public function add_laptop_data($data)
  {
    $input = $this->db->insert('laptop', $data);
    return $input;
  }

  function update_laptop($data, $id_laptop)
  {
    $update = $this->db->update('laptop', $data, array('id_laptop' => $id_laptop));

    return $update;
  }

  function laptop_delete($id)
  {
    $delete = $this->db->delete('laptop', array('id_laptop' => $id));
    return $delete;
  }

  function get_laptop($id_laptop)
  {
    $get = $this->db->query("SELECT 
      a.*,
      (SELECT 
      nama_unit_level3 
      FROM
      unit_level3 
      WHERE id_unit_level3 = a.`id_unit`) AS nama_unitnya,
      (SELECT 
      merek 
      FROM
      merek 
      WHERE id_merek = a.id_merek) AS nama_mereknya,
      (SELECT 
      nama_vendor 
      FROM
      vendor 
      WHERE id_vendor = a.id_vendor) AS nama_vendornya  
      FROM
      laptop a
      WHERE a.id_laptop =$id_laptop");
    if ($get->num_rows() == 1) {
      return $get->row_array();
    }
  }

  function list_merek_laptop()
  {
    $get = $this->db->query("SELECT 
		  * 
      FROM
      merek 
      WHERE kategori = 'Laptop' 
      ORDER BY id_merek DESC");
    return $get;
  }

  function list_vendor()
  {
    $get = $this->db->query("SELECT 
		  * 
      FROM
      vendor 
      ORDER BY id_vendor DESC");
    return $get;
  }

  //Merek
  function tampil_merek()
  {
    $get = $this->db->query("SELECT 
      a.* 
      FROM
      merek a

      ORDER BY a.id_merek DESC ");
    return $get;
  }


  public function add_merek_data($data)
  {
    $input = $this->db->insert('merek', $data);
    return $input;
  }

  function update_merek($data, $id_merek)
  {
    $update = $this->db->update('merek', $data, array('id_merek' => $id_merek));

    return $update;
  }

  function merek_delete($id)
  {
    $delete = $this->db->delete('merek', array('id_merek' => $id));
    return $delete;
  }

  function get_merek($id_merek)
  {
    $get = $this->db->query("SELECT *
     FROM merek a
     WHERE a.id_merek =$id_merek");
    if ($get->num_rows() == 1) {
      return $get->row_array();
    }
  }




  //PC & KOMPUTER
  function tampil_komputer()
  {
    $get = $this->db->query("SELECT 
      a.*,
      (SELECT 
      nama_unit_level3 
      FROM
      unit_level3 
      WHERE id_unit_level3 = a.`id_unit`) AS nama_unitnya,
      (SELECT 
      merek 
      FROM
      merek 
      WHERE id_merek = a.id_merek) AS nama_mereknya, 
      (SELECT 
      nama_vendor 
      FROM
      vendor 
      WHERE id_vendor = a.id_vendor) AS nama_vendornya  
      FROM
      komputer a 
      ORDER BY a.id_komputer DESC ");
    return $get;
  }

  public function add_komputer_data($data)
  {
    $input = $this->db->insert('komputer', $data);
    return $input;
  }

  function update_komputer($data, $id_komputer)
  {
    $update = $this->db->update('komputer', $data, array('id_komputer' => $id_komputer));

    return $update;
  }

  function komputer_delete($id)
  {
    $delete = $this->db->delete('komputer', array('id_komputer' => $id));
    return $delete;
  }

  function get_komputer($id_komputer)
  {
    $get = $this->db->query("SELECT 
      a.*,
      (SELECT 
      nama_unit_level3
      FROM
      unit_level3 
      WHERE id_unit_level3 = a.`id_unit`) AS nama_unitnya,
      (SELECT 
      merek 
      FROM
      merek 
      WHERE id_merek = a.id_merek) AS nama_mereknya, 
      (SELECT 
      nama_vendor 
      FROM
      vendor 
      WHERE id_vendor = a.id_vendor) AS nama_vendornya  
      FROM
      komputer a
      WHERE a.id_komputer =$id_komputer");
    if ($get->num_rows() == 1) {
      return $get->row_array();
    }
  }

  function list_merek_komputer()
  {
    $get = $this->db->query("SELECT 
		  * 
      FROM
      merek 
      WHERE kategori = 'PC' 
      ORDER BY id_merek DESC");
    return $get;
  }


  //Monitor
  function tampil_monitor()
  {
    $get = $this->db->query("SELECT 
      a.*,
      (SELECT 
      nama_unit_level3 
      FROM
      unit_level3 
      WHERE id_unit_level3 = a.`id_unit`) AS nama_unitnya,
      (SELECT 
      merek 
      FROM
      merek 
      WHERE id_merek = a.id_merek) AS nama_mereknya, 
      (SELECT 
      nama_vendor 
      FROM
      vendor 
      WHERE id_vendor = a.id_vendor) AS nama_vendornya
      FROM
      monitor a 
      ORDER BY a.id_monitor DESC ");
    return $get;
  }

  public function add_monitor_data($data)
  {
    $input = $this->db->insert('monitor', $data);
    return $input;
  }

  function update_monitor($data, $id_monitor)
  {
    $update = $this->db->update('monitor', $data, array('id_monitor' => $id_monitor));

    return $update;
  }

  function monitor_delete($id)
  {
    $delete = $this->db->delete('monitor', array('id_monitor' => $id));
    return $delete;
  }

  function get_monitor($id_monitor)
  {
    $get = $this->db->query("SELECT 
      a.*,
      (SELECT 
      nama_unit_level3 
      FROM
      unit_level3 
      WHERE id_unit_level3 = a.`id_unit`) AS nama_unitnya,
      (SELECT 
      merek 
      FROM
      merek 
      WHERE id_merek = a.id_merek) AS nama_mereknya, 
      (SELECT 
      nama_vendor 
      FROM
      vendor 
      WHERE id_vendor = a.id_vendor) AS nama_vendornya  
      FROM
      monitor a
      WHERE a.id_monitor =$id_monitor");
    if ($get->num_rows() == 1) {
      return $get->row_array();
    }
  }

  function list_merek_monitor()
  {
    $get = $this->db->query("SELECT 
		  * 
      FROM
      merek 
      WHERE kategori = 'Monitor' 
      ORDER BY id_merek DESC");
    return $get;
  }

  //Printer
  function tampil_printer()
  {
    $get = $this->db->query("SELECT 
      a.*,
      (SELECT 
      nama_unit_level3 
      FROM
      unit_level3
      WHERE id_unit_level3 = a.`id_unit`) AS nama_unitnya,
      (SELECT 
      merek 
      FROM
      merek 
      WHERE id_merek = a.id_merek) AS nama_mereknya, 
      (SELECT 
      nama_vendor 
      FROM
      vendor 
      WHERE id_vendor = a.id_vendor) AS nama_vendornya 
      FROM
      printer a 
      ORDER BY a.id_printer DESC ");
    return $get;
  }

  public function add_printer_data($data)
  {
    $input = $this->db->insert('printer', $data);
    return $input;
  }

  function update_printer($data, $id_printer)
  {
    $update = $this->db->update('printer', $data, array('id_printer' => $id_printer));

    return $update;
  }

  function printer_delete($id)
  {
    $delete = $this->db->delete('printer', array('id_printer' => $id));
    return $delete;
  }

  function get_printer($id_printer)
  {
    $get = $this->db->query("SELECT 
      a.*,
      (SELECT 
      nama_unit_level3 
      FROM
      unit_level3 
      WHERE id_unit_level3 = a.`id_unit`) AS nama_unitnya,
      (SELECT 
      merek 
      FROM
      merek 
      WHERE id_merek = a.id_merek) AS nama_mereknya, 
      (SELECT 
      nama_vendor 
      FROM
      vendor 
      WHERE id_vendor = a.id_vendor) AS nama_vendornya  
      FROM
      printer a
      WHERE a.id_printer =$id_printer");
    if ($get->num_rows() == 1) {
      return $get->row_array();
    }
  }

  function list_merek_printer()
  {
    $get = $this->db->query("SELECT 
		  * 
      FROM
      merek 
      WHERE kategori = 'Printer' 
      ORDER BY id_merek DESC");
    return $get;
  }

  //Aplikasi Lokal
  function tampil_aplikasi_lokal()
  {
    $get = $this->db->query("SELECT 
      a.*,
      (SELECT 
      nama_unit_level3 
      FROM
      unit_level3 
      WHERE id_unit_level3 = a.`id_unit`) AS nama_unitnya
      FROM
      aplikasi_lokal a 
      ORDER BY a.id_aplikasi_lokal DESC ");
    return $get;
  }

  public function add_aplikasi_lokal_data($data)
  {
    $input = $this->db->insert('aplikasi_lokal', $data);
    return $input;
  }

  function update_aplikasi_lokal($data, $id_aplikasi_lokal)
  {
    $update = $this->db->update('aplikasi_lokal', $data, array('id_aplikasi_lokal' => $id_aplikasi_lokal));

    return $update;
  }

  function aplikasi_lokal_delete($id)
  {
    $delete = $this->db->delete('aplikasi_lokal', array('id_aplikasi_lokal' => $id));
    return $delete;
  }

  function get_aplikasi_lokal($id_aplikasi_lokal)
  {
    $get = $this->db->query("SELECT 
      a.*,
      (SELECT 
      nama_unit_level3 
      FROM
      unit_level3 
      WHERE id_unit_level3 = a.`id_unit`) AS nama_unitnya
      FROM
      aplikasi_lokal a
      WHERE a.id_aplikasi_lokal =$id_aplikasi_lokal");
    if ($get->num_rows() == 1) {
      return $get->row_array();
    }
  }

  //Network Device 
  function tampil_network_device()
  {
    $get = $this->db->query("SELECT 
      a.*,
      (SELECT 
      nama_unit_level3
      FROM
      unit_level3
      WHERE id_unit_level3 = id_kantor_induk) AS nama_unitnya,
      (SELECT 
      merek 
      FROM
      merek 
      WHERE id_merek = a.id_merek) AS nama_mereknya, 
      (SELECT 
      nama_vendor 
      FROM
      vendor 
      WHERE id_vendor = a.id_vendor) AS nama_vendornya 
      FROM
      network_device a 
      ORDER BY a.id_network_device DESC ");
    return $get;
  }

  public function add_network_device_data($data)
  {
    $input = $this->db->insert('network_device', $data);
    return $input;
  }

  function update_network_device($data, $id_network_device)
  {
    $update = $this->db->update('network_device', $data, array('id_network_device' => $id_network_device));

    return $update;
  }

  function network_device_delete($id)
  {
    $delete = $this->db->delete('network_device', array('id_network_device' => $id));
    return $delete;
  }

  function get_network_device($id_network_device)
  {
    $get = $this->db->query("SELECT 
      a.*,
      (SELECT 
      nama_unit_level3
      FROM
      unit_level3 
      WHERE id_unit_level3 = a.`id_unit_level3`) AS nama_unitnya,
      (SELECT 
      merek 
      FROM
      merek 
      WHERE id_merek = a.id_merek) AS nama_mereknya, 
      (SELECT 
      nama_vendor 
      FROM
      vendor 
      WHERE id_vendor = a.id_vendor) AS nama_vendornya  
      FROM
      network_device a
      WHERE a.id_network_device =$id_network_device");
    if ($get->num_rows() == 1) {
      return $get->row_array();
    }
  }

  function list_merek_network_device()
  {
    $get = $this->db->query("SELECT 
		  * 
      FROM
      merek 
      WHERE kategori = 'Network Device' 
      ORDER BY id_merek DESC");
    return $get;
  }

  //Server 
  function tampil_server()
  {
    $get = $this->db->query("SELECT 
      a.*,
      (SELECT 
      nama_unit_level3 
      FROM
      unit_level3 
      WHERE id_unit_level3 = a.`id_unit`) AS nama_unitnya,
      (SELECT 
      merek 
      FROM
      merek 
      WHERE id_merek = a.id_merek) AS nama_mereknya
      FROM
      server a 
      ORDER BY a.id_server DESC ");
    return $get;
  }

  public function add_server_data($data)
  {
    $input = $this->db->insert('server', $data);
    return $input;
  }

  function update_server($data, $id_server)
  {
    $update = $this->db->update('server', $data, array('id_server' => $id_server));

    return $update;
  }

  function server_delete($id)
  {
    $delete = $this->db->delete('server', array('id_server' => $id));
    return $delete;
  }

  function get_server($id_server)
  {
    $get = $this->db->query("SELECT 
      a.*,
      (SELECT 
      nama_unit_level3 
      FROM
      unit_level3 
      WHERE id_unit_level3 = a.`id_unit`) AS nama_unitnya,
      (SELECT 
      merek 
      FROM
      merek 
      WHERE id_merek = a.id_merek) AS nama_mereknya 
      FROM
      server a
      WHERE a.id_server =$id_server");
    if ($get->num_rows() == 1) {
      return $get->row_array();
    }
  }

  function list_merek_server()
  {
    $get = $this->db->query("SELECT 
		  * 
      FROM
      merek 
      WHERE kategori = 'Server' 
      ORDER BY id_merek DESC");
    return $get;
  }

  function menghitung_jumlah_perangkat()
  {
    $get = $this->db->query("SELECT 
      COUNT(a.id_laptop)AS jumlah_laptop,
      (SELECT 
      COUNT(id_komputer) 
      FROM
      komputer) AS jumlah_komputer,
      (SELECT 
      COUNT(id_server) 
      FROM
      server) AS jumlah_server,
      (SELECT 
      COUNT(id_network_device) 
      FROM
      network_device) AS jumlah_network_device ,
      (SELECT 
      COUNT(id) 
      FROM
      it_support) AS jumlah_it_support ,
      (SELECT 
      COUNT(pegawai_id) 
      FROM
      pegawai) AS jumlah_pegawai,
      (SELECT
      COUNT(log_id)
      FROM
      log_gangguan WHERE status_log='Open') AS jumlah_log
      FROM
      laptop a");
    if ($get->num_rows() == 1) {
      return $get->row_array();
    }
  }

  function menghitung_jumlah_service_wilayah()
  {
    $get = $this->db->query('SELECT 
      COUNT(a.data_id)AS jumlah_data_network,
      (SELECT COUNT(data_id) FROM data_network WHERE service = "IP VPN" AND asman = "1") AS ipvpn_s1,
      (SELECT COUNT(data_id) FROM data_network WHERE service = "Metronet" AND asman = "1") AS metronet_s1,
      (SELECT COUNT(data_id) FROM data_network WHERE service = "VSAT IP" AND asman = "1") AS vsatip_s1,
      (SELECT COUNT(data_id) FROM data_network WHERE service = "Clear Channel" AND asman = "1") AS clearchannel_s1,
      (SELECT COUNT(data_id) FROM data_network WHERE service = "Internet" AND asman = "1") AS internet_s1,
      (SELECT COUNT(data_id) FROM data_network WHERE service = "IP VPN" AND asman = "2") AS ipvpn_s2,
      (SELECT COUNT(data_id) FROM data_network WHERE service = "Metronet" AND asman = "2") AS metronet_s2,
      (SELECT COUNT(data_id) FROM data_network WHERE service = "VSAT IP" AND asman = "2") AS vsatip_s2,
      (SELECT COUNT(data_id) FROM data_network WHERE service = "Clear Channel" AND asman = "2") AS clearchannel_s2,
      (SELECT COUNT(data_id) FROM data_network WHERE service = "Internet" AND asman = "2") AS internet_s2
      FROM
      data_network a');
    if ($get->num_rows() == 1) {
      return $get->row_array();
    }
  }


  //Vicon
  function tampil_vicon()
  {
    $get = $this->db->query("SELECT 
      a.*,
      (SELECT 
      nama_unit_level3
      FROM
      unit_level3 
      WHERE id_unit_level3 = a.`id_unit`) AS nama_unitnya,
      (SELECT 
      merek 
      FROM
      merek 
      WHERE id_merek = a.id_merek) AS nama_mereknya 
      FROM
      vicon a 
      ORDER BY a.id_vicon DESC ");
    return $get;
  }

  public function add_vicon_data($data)
  {
    $input = $this->db->insert('vicon', $data);
    return $input;
  }

  function update_vicon($data, $id_vicon)
  {
    $update = $this->db->update('vicon', $data, array('id_vicon' => $id_vicon));

    return $update;
  }

  function vicon_delete($id)
  {
    $delete = $this->db->delete('vicon', array('id_vicon' => $id));
    return $delete;
  }

  function get_vicon($id_vicon)
  {
    $get = $this->db->query("SELECT 
      a.*,
      (SELECT 
      nama_unit_level3 
      FROM
      unit_level3 
      WHERE id_unit_level3 = a.`id_unit`) AS nama_unitnya,
      (SELECT 
      merek 
      FROM
      merek 
      WHERE id_merek = a.id_merek) AS nama_mereknya 
      FROM
      vicon a
      WHERE a.id_vicon =$id_vicon");
    if ($get->num_rows() == 1) {
      return $get->row_array();
    }
  }

  function list_merek_vicon()
  {
    $get = $this->db->query("SELECT 
		  * 
      FROM
      merek 
      WHERE kategori = 'Vicon' 
      ORDER BY id_merek DESC");
    return $get;
  }

  //LOG GANGGUAN
  function tampil_lgangguan()
  {
    $get = $this->db->query("SELECT a.*, b.kategori, c.nama_kantor_induk, c.wilayah_kerja FROM log_gangguan a JOIN kategori_gangguan b ON a.penyebab = b.id_kategori JOIN kantor_induk c ON a.id_kantor_induk = c.id_kantor_induk ORDER BY a.log_id DESC ");
    return $get;
  }

  function list_kategori_gangguan()
  {
    $get = $this->db->query("SELECT id_kategori, kategori FROM kategori_gangguan ORDER BY id_kategori DESC ");
    return $get;
  }

  public function add_lgangguan_data($data)
  {
    $input = $this->db->insert('log_gangguan', $data);
    return $input;
  }

  function get_lgangguan($value, $column)
  {
    $get = $this->db->query("SELECT a.*, b.kategori FROM log_gangguan a JOIN kategori_gangguan b ON a.penyebab = b.id_kategori WHERE a.$column =$value");
    if ($get->num_rows() == 1) {
      return $get->row_array();
    }
  }

  function update_lgangguan($data, $log_id)
  {
    $update = $this->db->update('log_gangguan', $data, array('log_id' => $log_id));
    return $update;
  }

  function lgangguan_delete($id)
  {
    $delete = $this->db->delete('log_gangguan', array('log_id' => $id));
    return $delete;
  }

  public function lgangguan_filter($no_tiket, $asman, $kantor_induk, $layanan, $year, $month)
  {
    $query = "SELECT a.*, b.kategori, c.nama_kantor_induk, c.wilayah_kerja FROM log_gangguan a JOIN kategori_gangguan b ON a.penyebab = b.id_kategori JOIN kantor_induk c ON a.id_kantor_induk = c.id_kantor_induk WHERE ";
    $requirement = 0;

    if(!empty($no_tiket)) {
      $query .= "a.no_tiket = '$no_tiket' ";
      $requirement++;
    } 

    if(!empty($asman)) {
      if($requirement > 0){
        $query .= "AND ";
      }
      $query .= " c.wilayah_kerja = '$asman' ";  
      $requirement++;
    } 

    if(!empty($kantor_induk)) {
      if($requirement > 0){
        $query .= "AND ";
      }
      $query .= " a.id_kantor_induk = '$kantor_induk' ";  
      $requirement++;
    } 

    if(!empty($layanan)) {
      if($requirement > 0){
        $query .= "AND ";
      }
      $query .= "a.layanan = '$layanan' ";
      $requirement++;
    } 

    if(!empty($year)){
      if(!empty($month)){
        if($requirement > 0){
          $query .= "AND ";
        }
        $query .= "a.periode_tahun = '$year' AND a.periode_bulan = '$month'";
      } else {
        if($requirement > 0){
          $query .= "AND ";
        }
        $query .= "a.periode_tahun = '$year'";
      }
    } else {
      if(!empty($month)){
        if($requirement > 0){
          $query .= "AND ";
        }
        $query .= "a.periode_bulan = '$month'";
      } 
    }

    $get = $this->db->query($query);
    return $get;
  }

  //DATA NETWORK
  function tampil_data_network()
  {
    $get = $this->db->query("SELECT a.*, b.nama_unit_level3 FROM data_network a JOIN unit_level3 b ON a.id_unit = b.id_unit_level3 ORDER BY a.service_id DESC ");
    return $get;
  }

  function list_unit_sumut1()
  {
    $get = $this->db->query("SELECT a.wilayah_kerja, c.id_unit_level3, c.nama_unit_level3 FROM unit_level3 c JOIN kantor_induk a ON c.id_kantor_induk = a.id_kantor_induk WHERE a.wilayah_kerja = 1 ORDER BY c.id_unit_level3 DESC ");
    return $get;
  }

  function list_unit_sumut2()
  {
    $get = $this->db->query("SELECT a.wilayah_kerja, c.id_unit_level3, c.nama_unit_level3 FROM unit_level3 c JOIN kantor_induk a ON c.id_kantor_induk = a.id_kantor_induk WHERE a.wilayah_kerja = 2 ORDER BY c.id_unit_level3 DESC ");
    return $get;
  }

  public function add_data_network_data($data)
  {
    $input = $this->db->insert('data_network', $data);
    return $input;
  }

  function get_data_network($value, $column)
  {
    $get = $this->db->query("SELECT a.* FROM data_network a WHERE a.$column =$value");
    if ($get->num_rows() == 1) {
      return $get->row_array();
    }
  }

  function update_data_network($data, $data_id)
  {
    $update = $this->db->update('data_network', $data, array('data_id' => $data_id));
    return $update;
  }

  function data_network_delete($id)
  {
    $delete = $this->db->delete('data_network', array('data_id' => $id));
    return $delete;
  }

  public function data_network_filter($id)
  {
    $query = "SELECT a.*, b.nama_unit_level3 FROM data_network a JOIN unit_level3 b ON a.id_unit = b.id_unit_level3 WHERE a.id_unit = $id ORDER BY a.service_id DESC";
    $get = $this->db->query($query);
    return $get;
  }

  //KATEGORI GANGGUAN
  function tampil_kategori_gangguan()
  {
    $get = $this->db->query("SELECT a.* FROM kategori_gangguan a ORDER BY a.id_kategori DESC ");
    return $get;
  }

  public function add_kategori_gangguan_data($data)
  {
    $input = $this->db->insert('kategori_gangguan', $data);
    return $input;
  }

  function get_kategori_gangguan($value, $column)
  {
    $get = $this->db->query("SELECT a.* FROM kategori_gangguan a WHERE a.$column =$value");
    if ($get->num_rows() == 1) {
      return $get->row_array();
    }
  }

  function update_kategori_gangguan($data, $data_id)
  {
    $update = $this->db->update('kategori_gangguan', $data, array('id_kategori' => $data_id));
    return $update;
  }

  function kategori_gangguan_delete($id)
  {
    $delete = $this->db->delete('kategori_gangguan', array('id_kategori' => $id));
    return $delete;
  }

  function dashboard_merek_laptop_dell()
  {
    $get = $this->db->query("SELECT 
     COUNT(*) AS jumlahnya,
     (SELECT 
     merek 
     FROM
     merek 
     WHERE id_merek = laptop.`id_merek`) AS nama_merek 
     FROM
     laptop 
     WHERE id_merek = 3");
    if ($get->num_rows() == 1) {
      return $get->row_array();
    }
  }

  function dashboard_merek_laptop_hp()
  {
    $get = $this->db->query("SELECT 
     COUNT(*) AS jumlahnya,
     (SELECT 
     merek 
     FROM
     merek 
     WHERE id_merek = laptop.`id_merek`) AS nama_merek 
     FROM
     laptop 
     WHERE id_merek = 1");
    if ($get->num_rows() == 1) {
      return $get->row_array();
    }
  }

  function dashboard_merek_laptop_toshiba()
  {
    $get = $this->db->query("SELECT 
     COUNT(*) AS jumlahnya,
     (SELECT 
     merek 
     FROM
     merek 
     WHERE id_merek = laptop.`id_merek`) AS nama_merek 
     FROM
     laptop 
     WHERE id_merek = 5");
    if ($get->num_rows() == 1) {
      return $get->row_array();
    }
  }

  function dashboard_merek_laptop_lenovo()
  {
    $get = $this->db->query("SELECT 
     COUNT(*) AS jumlahnya,
     (SELECT 
     merek 
     FROM
     merek 
     WHERE id_merek = laptop.`id_merek`) AS nama_merek 
     FROM
     laptop 
     WHERE id_merek = 7");
    if ($get->num_rows() == 1) {
      return $get->row_array();
    }
  }

  function dashboard_merek_laptop_asus()
  {
    $get = $this->db->query("SELECT 
     COUNT(*) AS jumlahnya,
     (SELECT 
     merek 
     FROM
     merek 
     WHERE id_merek = laptop.`id_merek`) AS nama_merek 
     FROM
     laptop 
     WHERE id_merek = 9");
    if ($get->num_rows() == 1) {
      return $get->row_array();
    }
  }

  function dashboard_merek_laptop_apple()
  {
    $get = $this->db->query("SELECT 
     COUNT(*) AS jumlahnya,
     (SELECT 
     merek 
     FROM
     merek 
     WHERE id_merek = laptop.`id_merek`) AS nama_merek 
     FROM
     laptop 
     WHERE id_merek = 11");
    if ($get->num_rows() == 1) {
      return $get->row_array();
    }
  }

  function dashboard_merek_pc()
  {
    $get = $this->db->query("SELECT COUNT(komputer.id_merek) AS jumlahnya, merek.merek as nama_merek FROM merek LEFT JOIN komputer ON komputer.id_merek = merek.id_merek GROUP BY nama_merek");
    return $get;
  }

  function dashboard_merek_printer()
  {
    $get = $this->db->query("SELECT COUNT(printer.id_merek) AS jumlahnya, merek.merek as nama_merek FROM merek LEFT JOIN printer ON printer.id_merek = merek.id_merek GROUP BY nama_merek");
    return $get;
  }

  function dashboard_merek_network_device()
  {
    $get = $this->db->query("SELECT COUNT(network_device.id_merek) AS jumlahnya, merek.merek as nama_merek FROM merek LEFT JOIN network_device ON network_device.id_merek = merek.id_merek GROUP BY nama_merek");
    return $get;
  }

  function dashboard_merek_server()
  {
    $get = $this->db->query("SELECT COUNT(server.id_merek) AS jumlahnya, merek.merek as nama_merek FROM merek LEFT JOIN server ON server.id_merek = merek.id_merek GROUP BY nama_merek");
    return $get;
  }

  function dashboard_merek_vicon()
  {
    $get = $this->db->query("SELECT COUNT(vicon.id_merek) AS jumlahnya, merek.merek as nama_merek FROM merek LEFT JOIN vicon ON vicon.id_merek = merek.id_merek GROUP BY nama_merek");
    return $get;
  }

  function dashboard_status_kepemilikan_sewa()
  {
    $laptop = $this->db->query("SELECT COUNT(*) as jumlah FROM laptop WHERE status_kepemilikan = 'Sewa'");
    $komputer = $this->db->query("SELECT COUNT(*) as jumlah FROM komputer WHERE status_kepemilikan = 'Sewa'");
    $printer = $this->db->query("SELECT COUNT(*) as jumlah FROM printer WHERE status_kepemilikan = 'Sewa'");
    $monitor = $this->db->query("SELECT COUNT(*) as jumlah FROM monitor WHERE status_kepemilikan = 'Sewa'");
    $networkDevice = $this->db->query("SELECT COUNT(*) as jumlah FROM network_device WHERE status_kepemilikan = 'Sewa'");

    $combine = array_merge_recursive($laptop->row_array(), $komputer->row_array(), $printer->row_array(), $monitor->row_array(), $networkDevice->row_array());
    foreach ($combine as $c) {
      $tes = "[ " . $c[0] . ", " . $c[1] . ", " . $c[2] . ", " . $c[3] . ", " . $c[4] . " ]";
    }
    return $tes;
  }

  function dashboard_status_kepemilikan_pln()
  {
    $laptop = $this->db->query("SELECT COUNT(*) as jumlah FROM laptop WHERE status_kepemilikan = 'Aset PLN'");
    $komputer = $this->db->query("SELECT COUNT(*) as jumlah FROM komputer WHERE status_kepemilikan = 'Aset PLN'");
    $printer = $this->db->query("SELECT COUNT(*) as jumlah FROM printer WHERE status_kepemilikan = 'Aset PLN'");
    $monitor = $this->db->query("SELECT COUNT(*) as jumlah FROM monitor WHERE status_kepemilikan = 'Aset PLN'");
    $networkDevice = $this->db->query("SELECT COUNT(*) as jumlah FROM network_device WHERE status_kepemilikan = 'Aset PLN'");

    $combine = array_merge_recursive($laptop->row_array(), $komputer->row_array(), $printer->row_array(), $monitor->row_array(), $networkDevice->row_array());
    foreach ($combine as $c) {
      $tes = "[ " . $c[0] . ", " . $c[1] . ", " . $c[2] . ", " . $c[3] . ", " . $c[4] . " ]";
    }
    return $tes;
  }

  function dashboard_sid_bermasalah()
  {
    $get = $this->db->query("SELECT COUNT(a.log_id) AS jumlahnya, b.nama_unit_level3 FROM log_gangguan a JOIN unit_level3 b ON a.id_unit_level3 = b.id_unit_level3 GROUP BY a.id_unit_level3 ORDER BY jumlahnya DESC LIMIT 10");
    
    return $get;
  }

  function dashboard_gangguan_terbanyak()
  {
    $get = $this->db->query("SELECT COUNT(a.log_id) AS jumlahnya, b.kategori FROM log_gangguan a JOIN kategori_gangguan b ON a.penyebab = b.id_kategori GROUP BY a.id_unit_level3 ORDER BY jumlahnya DESC LIMIT 5");
    
    return $get;
  }

  //TINGKAT KERAWANAN
  function tampil_tingkat_kerawanan()
  {
    $get = $this->db->query("SELECT a.* FROM kerawanan a ORDER BY a.id_kerawanan DESC ");
    return $get;
  }

  function add_tingkat_kerawanan($data)
  {
    $input = $this->db->insert('kerawanan', $data);
    return $input;
  }

  function tingkat_kerawanan_delete($data_id)
  {
    $delete = $this->db->delete('kerawanan', array('id_kerawanan' => $data_id));
    return $delete;
  }

  function get_tingkat_kerawanan($value, $column)
  {
    $get = $this->db->query("SELECT a.* FROM kerawanan a WHERE a.$column =$value");
    if ($get->num_rows() == 1) {
      return $get->row_array();
    }
  }

  function update_tingkat_kerawanan($data, $data_id) {
    $update = $this->db->update('kerawanan', $data, array('id_kerawanan' => $data_id));
    return $update;
  }
//Stok perangkat
function tampil_stok()
{
  $get = $this->db->query("SELECT 
    a.* 
    FROM
    stok_perangkat a

    ORDER BY a.id_stok DESC ");
  return $get;
}


public function add_stok_data($data)
{
  $input = $this->db->insert('stok_perangkat', $data);
  return $input;
}

function update_stok($data, $id_stok)
{
  $update = $this->db->update('stok_perangkat', $data, array('id_stok' => $id_stok));

  return $update;
}

function stok_delete($id)
{
  $delete = $this->db->delete('stok_perangkat', array('id_stok' => $id));
  return $delete;
}

function get_stok($id_stok)
{
  $get = $this->db->query("SELECT *
   FROM stok_perangkat a
   WHERE a.id_stok =$id_stok");
  if ($get->num_rows() == 1) {
    return $get->row_array();
  }
}



 
}
