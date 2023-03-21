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
    }
}
