<?php

namespace App\Controllers;

use App\Models\Student; 
use CodeIgniter\RESTful\ResourceController;

class Students extends ResourceController
{

    private $student;

    public function __construct()
    {
        helper(['url']);
        $this->student = new Student();
    }

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        echo view('inc/header');
        $data['students']=$this->student->orderby('id','DESC')->paginate(3,'group1');
        $data['pager']=$this->student->pager;
        echo view('student/index',$data);
        echo view('inc/footer');
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $student = $this->student->find($id);
        if ($student) {
            return $this->respond($student);
        }
        return $this->failNotFound('Sorry! no student found');
    }


    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        $validation = $this->validate([
            'name' => 'required',
            "email" => "required|valid_email|is_unique[students.email]|min_length[6]",
        ]);

        if (!$validation) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

       
            $name= $this->request->getVar('name');
            $email = $this->request->getVar('email');
       
        $studentId = $this->student->insert($student);
        session()->setFlashdata("success","Data inserted succesfuly");
        redirect()->to(base_url());
        if ($studentId) {
            $student['id'] = $studentId;
            return $this->respondCreated($student);
        }
        return $this->fail('Sorry! no student created');
    }


    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        $student = $this->student->find($id);
        if ($student) {

            $validation = $this->validate([
                'name' => 'required',
                "email" => "required|valid_email",
            ]);

            if (!$validation) {
                return $this->failValidationErrors($this->validator->getErrors());
            }

            $student = [
                'id' => $id,
                'name' => $this->request->getVar('name'),
                'email' => $this->request->getVar('email')
            ];

            $response = $this->student->save($student);
            if ($response) {
                return $this->respond($student);
            }
            return $this->fail('Sorry! not updated');
        }
        return $this->failNotFound('Sorry! no student found');
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $student = $this->student->find($id);
        if ($student) {
            $response = $this->student->delete($id);
            if ($response) {
                return $this->respond($student);
            }
            return $this->fail('Sorry! not deleted');
        }
        return $this->failNotFound('Sorry! no student found');
    }
}