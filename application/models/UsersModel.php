<?php


class UsersModel extends CI_Model
{

    public function all()
    {
        $users = $this->db->where('deleted', 0)->order_by('created_at', 'DESC')->get('users');

        return $users->result();
    }

    public function find($id)
    {
        $this->db->where('id', $id);
        $this->db->where('deleted', 0);

        return $this->db->get('users')->result();
    }

    public function add()
    {
        $this->load->library('form_validation');
        $rules = [
            [
                'field' => 'username',
                'label' => 'Login Name',
                'rules' => 'trim|required|is_unique[users.login_name]',
            ],
            [
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'trim|required',
            ],
            [
                'field' => 'password_confirm',
                'label' => 'Confirm Password',
                'rules' => 'trim|required|matches[password]',
            ],
            [
                'field' => 'first_name',
                'label' => 'First Name',
                'rules' => 'trim|required',
            ],
            [
                'field' => 'last_name',
                'label' => 'Last Name',
                'rules' => 'trim|required',
            ],
            [
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'trim|required|valid_email|is_unique[users.email]',
            ],
            [
                'field' => 'role',
                'label' => 'Role',
                'rules' => 'trim|required',
            ],
            [
                'field' => 'business',
                'label' => 'Business Name',
                'rules' => 'trim|required',
            ],
            [
                'field' => 'api_key',
                'label' => 'API Key',
                'rules' => 'trim|required',
            ],
        ];

        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() !== false) {
            $password = md5(crypt($this->input->post('password'), config_item('password_salt')));
            $fields = [
                'login_name' => $this->input->post('username'),
                'password'   => $password,
                'first_name' => $this->input->post('first_name'),
                'last_name'  => $this->input->post('last_name'),
                'email'      => $this->input->post('email'),
                'role'       => $this->input->post('role'),
                'business'   => $this->input->post('business'),
                'address'    => $this->input->post('address'),
                'api_key'    => $this->input->post('api_key'),
            ];
            $this->db->insert('users', $fields);
            set_alert_message('User Added successfully');
            redirect('users');
        }

    }

    public function update($id)
    {
        $this->load->library('form_validation');
        $rules = [
            [
                'field' => 'username',
                'label' => 'Login Name',
                'rules' => 'trim|required',
            ],
            [
                'field' => 'first_name',
                'label' => 'First Name',
                'rules' => 'trim|required',
            ],
            [
                'field' => 'last_name',
                'label' => 'Last Name',
                'rules' => 'trim|required',
            ],
            [
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'trim|required',
            ],
            [
                'field' => 'role',
                'label' => 'Role',
                'rules' => 'trim|required',
            ],
            [
                'field' => 'business',
                'label' => 'Business Name',
                'rules' => 'trim|required',
            ],
            [
                'field' => 'api_key',
                'label' => 'API Key',
                'rules' => 'trim|required',
            ],
        ];

        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() !== false) {
            $has_password = false;
            $password = trim($this->input->post('password'));
            $password_confirm = trim($this->input->post('password_confirm'));
            if (!empty($password) || !empty($password_confirm)) {
                if ($password !== $password_confirm) {
                    set_alert_message('Password Fields did not matched', 'error');

                    return;
                }
                $has_password = true;
                $password = md5(crypt($this->input->post('password'), config_item('password_salt')));
            }
            $fields = [
                'login_name' => $this->input->post('username'),
                'first_name' => $this->input->post('first_name'),
                'last_name'  => $this->input->post('last_name'),
                'email'      => $this->input->post('email'),
                'role'       => $this->input->post('role'),
                'business'   => $this->input->post('business'),
                'address'    => $this->input->post('address'),
                'api_key'    => $this->input->post('api_key'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
            if ($has_password) {
                $fields['password'] = $password;
            }
            $this->db->where('id', $id);
            $this->db->update('users', $fields);
            set_alert_message('User Updated successfully');
            redirect('users');
        }

    }
}
