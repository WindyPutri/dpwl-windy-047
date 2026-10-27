<?php
// P5: CRUD Mobil
class Mobil_controller extends Controller
{
    private Mobil_model $model;

    public function __construct()
    {
        require_once APPPATH . 'models/Mobil_model.php';
        require_once APPPATH . 'helpers/auth_helper.php';
        require_once APPPATH . 'helpers/flash_helper.php';

        $this->model = new Mobil_model();
    }

    public function index(): void
    {
        require_admin_login();

        $this->view('admin/mobil_view', [
            'username' => $_SESSION['admin_username'],
            'mobil' => $this->model->getAll(),
            'flash' => get_flash_message(),
            'mode' => null,
            'mobil_dipilih' => null,
            'error' => null,
        ]);
    }
}    