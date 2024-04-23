<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact_model extends CI_Model {

    public function getContacts($start, $limit) {
        // Lấy dữ liệu từ bảng 'contact' với giới hạn và vị trí bắt đầu
        $query = $this->db->limit($limit, $start)->get('contact');
        $contatos = $query->result_array();

        // Lấy tổng số dòng trong bảng 'contact'
        $total = $this->db->count_all('contact');

        return array(
            "success" => true,
            "total" => $total,
            "contatos" => $contatos
        );
    }


    //Thêm
    public function insertContact($data) {
        // Thêm liên hệ vào bảng 'contact'
        $this->db->insert('contact', $data);

        // Trả về kết quả thêm dưới dạng JSON
        return array(
            "success" => $this->db->error() ? false : true,
            "contatos" => array(
                "id" => $this->db->insert_id(),
                "nome" => $data['name'],
                "email" => $data['email'],
                "phone" => $data['phone']
            )
        );
    }

    //Cập nhật
    public function updateContact($data) {
        // Cập nhật liên hệ trong bảng 'contact'
        $this->db->set('name', $data['name']);
        $this->db->set('email', $data['email']);
        $this->db->set('phone', $data['phone']);
        $this->db->where('id', $data['id']);
        $this->db->update('contact');

        // Trả về kết quả cập nhật dưới dạng JSON
        return array(
            "success" => $this->db->error() ? false : true,
            "contatos" => $data
        );
    }

    //Xóa
    public function deleteContact($id) {
        // Xóa liên hệ từ bảng 'contact' dựa trên 'id'
        $this->db->where('id', $id);
        $this->db->delete('contact');

        // Kiểm tra và trả về kết quả xóa
        return $this->db->error() ? false : true;
    }
}