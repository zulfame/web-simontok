<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    // public function index()
    // {
    //     $data['title'] = '404';
    //     $this->load->view('mobile/templates/auth_header', $data);
    //     $this->load->view('mobile/auth/page-under-construction');
    // }

    public function index()
    {
        if ($this->session->userdata('email')) {
            redirect('mobile/tugas');
        }

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login';
            $this->load->view('mobile/templates/auth_header', $data);
            $this->load->view('mobile/auth/page-login');
            $this->load->view('mobile/templates/auth_footer');
        } else {
            // validasi success
            $this->_login();
        }
    }

    private function _login()
    {
        $email        = $this->input->post('email');
        $password    = $this->input->post('password');

        //$user = $this->db->get_where('user', ['email' => $email])->row_array();
        $user = $this->db->query("select * from user join region on region.`id`=user.`region_id` where email='$email'")->row_array();

        // jika usernya ada
        if ($user) {
            if ($user['is_active'] == 1 & $user['m_access'] == 1) {
                // cek password
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email'     => $user['email'],
                        'role_id'   => $user['role_id'],
                        'region'    => $user['region'],
                        'user_code' => $user['user_code'],
                        'alias'     => $user['alias'],
                        'name'      => $user['name']
                    ];
                    $this->session->set_userdata($data);
                    $this->session->set_flashdata('message', 'Login');
                    redirect('mobile/dashboard');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger mb-2 alert-dismissible fade show" role="alert">
					Worng wrong <strong>e-mail</strong> and <strong>password</strong>!
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <ion-icon name="close-outline"></ion-icon>
                    </button>
                	</div>');
                    redirect('mobile/auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger mb-2 alert-dismissible fade show" role="alert">
				This email <strong>not activated</strong> or <strong>not access!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<ion-icon name="close-outline"></ion-icon>
				</button>
				</div>');
                redirect('mobile/auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger mb-2 alert-dismissible fade show" role="alert">
			Email is <strong>not registered!</strong>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<ion-icon name="close-outline"></ion-icon>
			</button>
			</div>');
            redirect('mobile/auth');
        }
    }

    public function registration()
    {
        if ($this->session->userdata('email')) {
            redirect('mobile/tugas');
        }

        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique'     => 'This email has already registered!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches'       => 'Passcode dont match!',
            'min_length'    => 'Passcode too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]', [
            'matches'       => 'Passcode dont match!',
        ]);

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Registration';
            $this->load->view('mobile/templates/auth_header', $data);
            $this->load->view('mobile/auth/page-register');
            $this->load->view('mobile/templates/auth_footer');
        } else {
            $email = $this->input->post('email', true);
            $data = [
                'name'          => htmlspecialchars($this->input->post('name', true)),
                'email'         => htmlspecialchars($email),
                'image'         => 'default.jpg',
                'password'      => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'region_id'     => 9,
                'role_id'       => 6,
                'is_active'     => 0,
                'date_created'  => time()
            ];

            // siapkan token
            $token = base64_encode(random_bytes(32));
            $user_token = [
                'email' => $email,
                'token' => $token,
                'date_created' => time()
            ];

            $this->db->insert('user', $data);
            $this->db->insert('user_token', $user_token);

            $this->_sendEmail($token, 'verify');

            $this->session->set_flashdata('message', '<div class="alert alert-success mb-2 alert-dismissible fade show" role="alert">
			Your account has been created. Please <strong>activate</strong> your account.
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<ion-icon name="close-outline"></ion-icon>
			</button>
			</div>');
            redirect('mobile/auth');
        }
    }


    private function _sendEmail($token, $type)
    {
        $config = [
            'protocol'  => 'smtp',

            'smtp_host' => 'ssl://mail.bprbangunarta.co.id',
            'smtp_user' => 'info@bprbangunarta.co.id',
            'smtp_pass' => '@Pusat09011992',

            // 'smtp_host' => 'ssl://smtp.googlemail.com',
            // 'smtp_user' => 'zulfadlirizal@gmail.com',
            // 'smtp_pass' => 'jksydzvwmmcfwpft',

            'smtp_port' => 465,
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'newline'   => "\r\n"
        ];

        $this->email->initialize($config);

        $this->email->from('info@bprbangunarta.co.id', 'BPR Bangunarta');
        $this->email->to($this->input->post('email'));

        if ($type == 'verify') {
            $this->email->subject('Account Verification');
            $this->email->message('Click this link to verify you account : <a href="' . base_url() . 'mobile/auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Activate</a>');
        } else if ($type == 'forgot') {
            $this->email->subject('Reset Password');
            $this->email->message('Click this link to reset your password : <a href="' . base_url() . 'mobile/auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Password</a>');
        }

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }


    public function verify()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

            if ($user_token) {
                if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
                    $this->db->set('is_active', 1);
                    $this->db->where('email', $email);
                    $this->db->update('user');

                    $this->db->delete('user_token', ['email' => $email]);

                    $this->session->set_flashdata('message', '<div class="alert alert-success mb-2 alert-dismissible fade show" role="alert">
					<strong>' . $email . '</strong> has been <strong>activated!</strong> Please login.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<ion-icon name="close-outline"></ion-icon>
					</button>
					</div>');
                    redirect('mobile/auth');
                } else {
                    $this->db->delete('user', ['email' => $email]);
                    $this->db->delete('user_token', ['email' => $email]);

                    $this->session->set_flashdata('message', '<div class="alert alert-danger mb-2 alert-dismissible fade show" role="alert">
					Account activation <strong>failed!</strong> Token expired.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<ion-icon name="close-outline"></ion-icon>
					</button>
					</div>');
                    redirect('mobile/auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-success mb-2 alert-dismissible fade show" role="alert">
				Account activation <strong>failed!</strong> Wrong token.
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<ion-icon name="close-outline"></ion-icon>
				</button>
				</div>');
                redirect('mobile/auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger mb-2 alert-dismissible fade show" role="alert">
			Account activation <strong>failed!</strong> Wrong email.
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<ion-icon name="close-outline"></ion-icon>
			</button>
			</div>');
            redirect('mobile/auth');
        }
    }


    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('message', '<div class="alert alert-success mb-2 alert-dismissible fade show" role="alert">
		You have been <strong>logged</strong> out!.
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<ion-icon name="close-outline"></ion-icon>
		</button>
		</div>');
        redirect('mobile/auth');
    }


    public function blocked()
    {
        $data['title'] = 'Sorry';
        $this->load->view('mobile/templates/auth_header', $data);
        $this->load->view('mobile/auth/page-blocked');
        $this->load->view('mobile/templates/auth_footer');
    }


    public function forgotPassword()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Forgot Password';
            $this->load->view('mobile/templates/auth_header', $data);
            $this->load->view('mobile/auth/page-forgot-password');
            $this->load->view('mobile/templates/auth_footer');
        } else {
            $email = $this->input->post('email');
            $user = $this->db->get_where('user', ['email' => $email, 'is_active' => 1])->row_array();

            if ($user) {
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email'        => $email,
                    'token'        => $token,
                    'date_created' => time()
                ];

                $this->db->insert('user_token', $user_token);
                $this->_sendEmail($token, 'forgot');

                $this->session->set_flashdata('message', '<div class="alert alert-success mb-2 alert-dismissible fade show" role="alert">
				Please check your email to <strong>reset</strong> your password.
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<ion-icon name="close-outline"></ion-icon>
				</button>
				</div>');
                redirect('mobile/auth/forgotpassword');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger mb-2 alert-dismissible fade show" role="alert">
				Email is <strong>not registered</strong> or <strong>activated</strong>.
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<ion-icon name="close-outline"></ion-icon>
				</button>
				</div>');
                redirect('mobile/auth/forgotpassword');
            }
        }
    }


    public function resetPassword()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

            if ($user_token) {
                $this->session->set_userdata('reset_email', $email);
                $this->changePassword();
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger mb-2 alert-dismissible fade show" role="alert">
				Reset password <strong>failed!</strong> Wrong token.
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<ion-icon name="close-outline"></ion-icon>
				</button>
				</div>');
                redirect('mobile/auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger mb-2 alert-dismissible fade show" role="alert">
			Reset password <strong>failed!</strong> Wrong email.
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<ion-icon name="close-outline"></ion-icon>
			</button>
			</div>');
            redirect('mobile/auth');
        }
    }


    public function changePassword()
    {
        if (!$this->session->userdata('reset_email')) {
            redirect('mobile/auth');
        }

        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches'       => 'Passcode dont match!',
            'min_length'    => 'Passcode too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]', [
            'matches'       => 'Passcode dont match!',
        ]);

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Change Password';
            $this->load->view('mobile/templates/auth_header', $data);
            $this->load->view('mobile/auth/page-change-password');
            $this->load->view('mobile/templates/auth_footer');
        } else {
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_email');

            $this->db->set('password', $password);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->unset_userdata('reset_email');

            $this->db->delete('user_token', ['email' => $email]);

            $this->session->set_flashdata('message', '<div class="alert alert-success mb-2 alert-dismissible fade show" role="alert">
			Password has been <strong>changed!</strong> Please login.
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<ion-icon name="close-outline"></ion-icon>
			</button>
			</div>');
            redirect('mobile/auth');
        }
    }
}
