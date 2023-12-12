<?php

namespace App\Controllers;

use App\Models\UserModel;


use App\Controllers\BaseController;
use Config\Validation;

class DataAkun extends BaseController
{
    public function index()
    {
        $model = new UserModel;
        $keyword = $this->request->getVar('cari');
        if ($keyword) {
            $model->search($keyword);
        } else {
            $model->getdata();
        }
        $user['getUser'] = $model->getdata();
        $user['title'] = 'Data Akun';
        echo view('/user/UserView', $user);
    }

    public function tambahUser()
    {
        session();
        $user['validation'] = \Config\Services::validation();
        $user['title'] = 'Tambah Data User';
        return  view('/user/tambahUserView', $user);
    }

    public function add()
    {
        if (!$this->validate([
            'user_name' => [
                'rules' => 'required|is_unique[users.user_name]',
                'errors' => [
                    'required' => 'Data Nama Akun  harus diisi',
                    'is_unique' => 'Data Nama Akun sudah ada'
                ]
            ],
            'user_email' => [
                'rules' => 'required|is_unique[users.user_email]',
                'errors' => [
                    'required' => 'Email harus diisi',
                    'is_unique' => 'Email sudah ada'
                ]
            ],
            'user_password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password harus diisi'
                ]
            ],
        ])) {
            # code...
            $validation = \Config\Services::validation();
            return redirect()->to('/DataAkun/tambahUser')->withInput()->with('validation', $validation);
        }
        $UserModel = new UserModel;
        $data = [
            'user_name' => $this->request->getPost('user_name'),
            'user_email' => $this->request->getPost('user_email'),
            'user_password'     => password_hash($this->request->getVar('user_password'), PASSWORD_DEFAULT),
            'user_create_at' => date('Y-m-d H:i:s')
        ];
        $UserModel->save($data);
        session()->setFlashData('pesan_tambah', "Data Akun Berhasil Ditambah");
        return redirect()->to('DataAkun');
    }
    // edit
    public function edit($id)
    {
        session();
        $UserModel = new UserModel;
        $getUser = $UserModel->getUser($id)->getRow();

        if (isset($getUser)) {
            $user = [
                'validation' => \Config\Services::validation(),
                'title' => 'Edit Data User ' . $getUser->user_name,
            ];
            $user['user'] = $getUser;
            return view('/User/editUserView', $user);
        } else {
            session()->setFlashData('pesan_edit', 'Id User tidak ditemukan');
            return redirect()->to('/User');
        }
    }

    public function update($id)
    {
        if (!$this->validate([
            'user_name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Akun  harus diisi',
                ]
            ],
            'user_email' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Email harus diisi'
                ]
            ],
            'user_password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password harus diisi'
                ]
            ],
            'user_create_at' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Time harus diisi'
                ]
            ]
        ])) {
            # code...
            $validation = \Config\Services::validation();
            return redirect()->to('/User/edit/' . $this->request->getVar('id'))->withInput()->with('validation', $validation);
        }
        $UserModel = new UserModel;
        $user = [
            'user_id' => $id,
            'user_name' => $this->request->getPost('nama'),
            'user_email' => $this->request->getPost('email'),
            'user_password' => $this->request->getPost('password'),
            'user_crete_at' => $this->request->getVar('time')
        ];
        // dd($supplier);
        $UserModel->update($id, $user);
        session()->setFlashData('pesan_edit', "Data Akun Berhasil Diedit");
        return redirect()->to('Userr');
    }

    // Hapus
    public function hapus($id)
    {
        $model = new UserModel;
        $getUser = $model->getdata($id)->getRow();
        if (isset($getUser)) {
            $model->delete($id);
            session()->setFlashData('pesan_hapus', "Data berhasil dihapus");
            return redirect()->to('/DataAkun');
        } else {
            session()->setFlashData('pesan_hapus', "Data gagal dihapus");
            return redirect()->to('/DataAkun');
        }
    }
}
