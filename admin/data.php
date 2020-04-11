<?php
/*
 * PROGRAMED BY EN.MUHAMMAD KAMAL OMAIR 2017
 * ALL RIGHT RESERVED
 * en.muhammadkamal@live.com
 *
 */

namespace AdminPanel;

use PROCESS\prs as prs;

class Functions
{

//    var $rows = array();
    var $values = array();
    var $table = array();
    var $cond = array();
    var $select_cond = array();
    var $password;
    var $files = array();
    var $folder = 'files';
    var $accepted_files = array(
        'image/jpg', 'image/jpeg', 'image/png', 'video/mp4'
    );
    var $accepted_photo = array(
        'image/jpg', 'image/jpeg', 'image/png'
    );
    var $new_name = 'AKHRAM-';
    var $file_info = array();

    function PasswordHash()
    {
        $options = [
            'cost' => 8,
        ];
        return password_hash($this->password, PASSWORD_BCRYPT, $options);
    }

    function get_data()
    {
        prs::unSetData();
        prs::$table = $this->table;
        prs::$select_cond = $this->cond;
        return prs::select__record();
    }

    function AddData()
    {
        prs::unSetData();
        prs::$table = $this->table;
        prs::$data_in = $this->values;
        prs::add__record();
    }

    function DeleteData()
    {
        prs::unSetData();
        prs::$cond = $this->cond;
        prs::$table = $this->table;
        prs::delete__record();
    }

    function UpdateData()
    {
        $tmp = $this->files['tmp_name'];
        $name = $this->files['name'];
        $ext = pathinfo($name, PATHINFO_EXTENSION);
        $mime_file = mime_content_type($tmp);
//        $mime_file = $info['mime'];
        if (in_array($mime_file, $this->accepted_photo)) {
            $uploaded_name = 'AKHRAM-' . $this->new_name . '.' . $ext;
            $upload_dir = DIR . DS . $this->folder . DS . $uploaded_name;
            if (move_uploaded_file($tmp, $upload_dir)) {
                $this->file_info = array(
                    'error' => 0,
                    'file_name' => $uploaded_name,
                    'media_type' => $mime_file,
                );
            }
        } else {
            $this->file_info = array(
                'error' => 1,
                'file_name' => 'error',
                'media_type' => 'error',
            );
        }
    }

    function UploadSingleMedia()
    {

        $tmp = $this->files['tmp_name'];
        $name = $this->files['name'];
        $ext = pathinfo($name, PATHINFO_EXTENSION);
        $mime_file = $this->files['type'];
//        $mime_file = $info['mime'];
        if (in_array($mime_file, $this->accepted_files)) {
            $uploaded_name = $this->new_name . '_' . time() . '-' . '.' . $ext;
            $upload_dir = DIR . DS . $this->folder . DS . $uploaded_name;
            if (move_uploaded_file($tmp, $upload_dir)) {
                $this->file_info = array(
                    'error' => 0,
                    'file_name' => $uploaded_name,
                    'media_type' => $mime_file,
                );
            }
        } else {
            $this->file_info = array(
                'error' => 1,
                'file_name' => 'error',
                'media_type' => 'error',
            );
        }
    }

    function UploadMedia()
    {
        for ($i = 0; $i < count($this->files['name']); $i++) {
            $tmp = $this->files['tmp_name'][$i];
            $name = $this->files['name'][$i];
            $ext = pathinfo($name, PATHINFO_EXTENSION);
            $mime_file = $this->files['type'][$i];
//        $mime_file = $info['mime'];
            if (in_array($mime_file, $this->accepted_files)) {
                $uploaded_name = $this->new_name . '_' . time() . '-' . $i . '.' . $ext;
                $upload_dir = DIR . DS . $this->folder . DS . $uploaded_name;
                if (move_uploaded_file($tmp, $upload_dir)) {
                    $this->file_info[$i] = array(
                        'error' => 0,
                        'file_name' => $tmp,
                        'media_type' => $mime_file,
                    );
                }
            } else {
                $this->file_info[$i] = array(
                    'error' => 1,
                    'file_name' => 'error',
                    'media_type' => 'error',
                );
            }


        }


    }

}

class DB_DATA
{

    var $email;
    var $password;
    var $uid;
    var $id;
    var $user_type;


    function Login()
    {
        if (filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $domains = array('yeco-aden.com');
            $pattern = "/^[a-z0-9._%+-]+@[a-z0-9.-]*(" . implode('|', $domains) . ")$/i";
            if (preg_match($pattern, $this->email)) {

                $fun = new prs();
                prs::$table = ADMIN_TABLE;
                prs::$select_cond = array('email' => $this->email);
                if (!empty(prs::select__record())) {
                    $cur_pass = '';
                    foreach (prs::select__record() as $t => $da) {
                        $cur_pass = $da['password'];
                        $this->id = $da['id'];
                        $this->user_type = $da['user_type'];
                    }
                    if (password_verify($this->password, $cur_pass)) {
                        $this->SaveSession();
                        return 100;
                    } else {
//                    password error
                        return 1;
                    }
                } else {
//                not found
                    return 0;
                }
            } else {
                return 5;
//                'Only Yeco Emails';
            }
        } else {
            return 4;
//            email error
        }
    }

    function SaveSession()
    {
        $_SESSION['user_signed_email'] = $this->email;
        $_SESSION['user_signed_id'] = $this->id;
//    $_SESSION['user_signed_type'] = $this->user_type;
    }

    function GetUserType()
    {
        prs::unSetData();
        prs::$table = ADMIN_TABLE;
        prs::$select_cond = array('email' => $_SESSION['user_signed_email']);
        foreach (prs::select__record() as $r => $t) {
            $this->user_type = $t['user_type'];
        }
        return $this->user_type;
    }

    function ClearSession()
    {
        $_SESSION['user_signed_id'] = '';
        $_SESSION['user_signed_email'] = '';
        $_SESSION['user_signed_type'] = '';
        unset($_SESSION['user_signed_email']);
        unset($_SESSION['user_signed_id']);
        unset($_SESSION['user_signed_type']);

    }

    function GetCityList()
    {
        prs::unSetData();
        prs::$table = CITIES_TABLE;
        return prs::select__record();
    }

    function GetSectionsList()
    {
        prs::unSetData();
        prs::$table = SECT_TABLE;
        return prs::select__record();
    }

    function GetBranList()
    {
        prs::unSetData();
        prs::$table = BRAN_TABLE;
        return prs::select__record();
    }
}