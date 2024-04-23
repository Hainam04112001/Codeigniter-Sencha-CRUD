<?php


class Contact extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Contact_model');
	}

	public function index(){
		$start = $this->input->get('start');
        $limit = $this->input->get('limit');

        // Gọi hàm lấy dữ liệu từ model
        $result = $this->Contact_model->getContacts($start, $limit);

        // Trả về kết quả dưới dạng JSON
        echo json_encode($result);
	}

	public function insert(){
	// Lấy dữ liệu từ POST request
        $info = $this->input->post('contatos');
        $data = json_decode(stripslashes($info), true); // Chú ý: true để trả về mảng chứ không phải đối tượng

        // Gọi hàm thêm dữ liệu từ model
        $result = $this->Contact_model->insertContact($data);

        // Trả về kết quả thêm dưới dạng JSON
        echo json_encode($result);
	}

	public function update(){
		// Lấy dữ liệu từ POST request
		$info = $this->input->post('contatos');
		$data = json_decode(stripslashes($info), true);

		// Gọi hàm cập nhật dữ liệu từ model
		$result = $this->Contact_model->updateContact($data);

		// Trả về kết quả cập nhật dưới dạng JSON
		echo json_encode($result);
	}

	public function delete() {
		 // Lấy dữ liệu từ POST request
		 $info = $this->input->post('contatos');
		 $data = json_decode(stripslashes($info));
 
		 // Lấy ID từ dữ liệu JSON
		 $id = $data->id;
 
		 // Gọi hàm xóa từ model
		 $success = $this->Contact_model->deleteContact($id);
 
		 // Trả về kết quả xóa dưới dạng JSON
		 echo json_encode(array(
			 "success" => $success
		 ));
	}
}
