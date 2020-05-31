<?php 

function is_logged_in()
{
    $ci = get_instance();
    if (!$ci->session->userdata('email')) {

        $ci->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Silahkan login untuk melanjutkan !</div>');
        redirect('auth');
    } else {
        // $role_id = $ci->session->userdata('role_id');
        // $menu = $ci->uri->segment(1);

        // $queryMenu = $ci->db->get_where('USER_MENU', ['menu' => $menu])->row_array();
        // $menu_id = $queryMenu['id'];

        // $userAccess = $ci->db->get_where('USER_ACCESS_MENU', [
        //     'role_id' => $role_id,
        //     'menu_id' => $menu_id
        // ]);

        // if ($userAccess->num_rows() < 1) {
        //     redirect('auth/blocked');
        // }
    }
}


function check_access($role_id, $menu_id)
{
    $ci = get_instance();

    $ci->db->where('role_id', $role_id);
    $ci->db->where('menu_id', $menu_id);
    $result = $ci->db->get('USER_ACCESS_MENU');

    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}
