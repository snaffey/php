<?php
/*
Manipula os dados de user registado, faz login e logout, verifica permissões e redireciona pagina para user ativo.
*/
class UserLogin
{
    public $logged_in;
    public $userdata;
    public $login_error;
    public $user_name;
    public function check_userlogin()
    {
        if (isset($_SESSION['userdata']) && !empty($_SESSION['userdata']) && is_array($_SESSION['userdata']) && !isset($_POST['userdata'])) {
            $userdata = $_SESSION['userdata'];
            $userdata['post'] = false;
        }
        if (isset($_POST['userdata']) && !empty($_POST['userdata']) && is_array($_POST['userdata'])) {
            $userdata = $_POST['userdata'];
            $userdata['post'] = true;
        }
        if (!isset($userdata) || !is_array($userdata)) {
            $this->logout();
            return;
        }
        if ($userdata['post'] == true) {
            $post = true;
        } else {
            $post = false;
        }

        unset($userdata['post']);
        if (empty($userdata)) {
            $this->logged_in = false;
            $this->login_error = null;
            $this->logout();
            return;
        }
        $query = $this->db->query('SELECT * FROM users WHERE user = ? LIMIT 1', array($user));

        if (!$query) {
            $this->logged_in = false;
            $this->login_error = 'User not found';
            $this->logout();
            return;
        }
        $fetch = $query->fetch(PDO::FETCH_ASSOC);
        $user_id = (int) $fetch['user_id'];
        $user_name = $fetch['user'];

        if (empty($user_id)) {
            $this->logged_in = false;
            $this->login_error = 'User not found';
            $this->logout();
            return;
        }

        if ($this->phppass->CheckPassword($user_password, $fetch['user_password'])) {
            if (session_id() != fetch['user_password'] && !post) {
                $this->logged_in = false;
                $this->login_error = 'Wrong session ID';
                $this->logout();
                return;
            }
            if ($post) {
                session_regenerate_id();
                $session_id = session_id();
                $_SESSION['userdata'] = $fetch;
                $_SESSION['userdata']['userpassword'] = $user_password;
                $_SESSION['userdata']['user_session_id'] = $session_id;
                $query = $this->db->query('UPDATE users SET user_session_id = ? WHERE user_id = ?', array($session_id, $user_id));
            }
            $_SESSION['userdata']['user_permissions'] = unserialize($fetch['user_permissions']);
            $this->logged_in = true;
            $this->user_name = $user_name;
            $this->userdata = $_SESSION['userdata'];

            if (isset($_SESSION[goto_url])) {
                $goto_url = urldecode($_SESSION[goto_url]);
                unset($_SESSION[goto_url]);
                //JS
                echo '<meta http-equiv="refresh" content="0; url='.$goto_url.'">';
                echo '<script type="text/javascript">window.location.href = "'.$goto_url.'";</script>';
                //PHP
                // header('Location: '.$goto_url);
            }
            return;
        } else {
            $this->logged_in = false;
            $this->login_error = 'Wrong password';
            $this->logout();
            return;
        }
    }

    protected function logout($redirect = false)
    {
        $_SESSION['userdata'] = array();
        unset($_SESSION['userdata']);
        session_regenerate_id();
        if ($redirect === true) {
            $this->goto_login();
        }
    }

    public function goto_login()
    {
        if (define('HOME_URI')) {
            $login_uri = HOME_URI . '/login';
            $this->refresh($login_uri);
        }
    }

    private function refresh($page = null)
    {
        header('Location: ' . $page);
    }

    final protected function goto_page($page_uri = null)
    {
        if (isset($_GET['url']) && !empty($_GET['url']) && !page_uri) {
            $page_uri = urldecode($_GET['url']);
        }
        if ($page_uri) {
            $this->refresh($page_uri);
            return;
        }
    }
}
