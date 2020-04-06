<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Obat_model extends CI_Model
{
    private $_table = 'obat';

    public function insert_new($id_jenis)
    {
        $id_obat = $this->generate_id_obat($id_jenis);
        $data = [
            "nama_obat" => $this->input->post('nama_obat', true),
            "id_jenis" => $id_jenis,
            "id_obat" => $id_obat,
            "harga" => $this->input->post('harga', true),
            "stok" => $this->input->post('stok', true)
        ];
        $this->db->insert($this->_table, $data);
    }

    public function get_obat_by_id($id_obat)
    {
        return $this->db->get_where($this->_table, ['id_obat' => $id_obat])->result_array()[0];
    }

    public function get_all_data()
    {
        return $this->db->get($this->_table)->result();
    }

    public function count_all_data()
    {
        return $this->db->count_all($this->_table);
    }

    public function update($id)
    {
        $data = [
            "nama_obat" => $this->input->post('nama_obat', true),
            "harga" => $this->input->post('harga', true),
            "stok" => $this->input->post('stok', true),
        ];
        $this->db->where('id_obat', $id);
        $this->db->update($this->_table, $data);
    }

    public function delete($id_obat)
    {
        $is_avaible = $this->db->get_where($this->_table, ['id_obat' => $id_obat])->result_array();
        if(sizeof($is_avaible) > 0) {
            $this->db->where('id_obat', $id_obat);
            return $this->db->delete($this->_table);
        } else {
            return null;
        }
    }
    private function generate_id_obat($id)
	{
		do {
			$rand_id = $id . strval(rand(200, 3000));
		} while (sizeof($this->db->get_where($this->_table, ['id_obat' => $rand_id])->result_array()) > 0);
		return $rand_id;
	}
}
