<?php
/*
 * PROGRAMED BY EN.MUHAMMAD KAMAL OMAIR 2017
 * ALL RIGHT RESERVED
 * en.muhammadkamal@live.com
 *
 */

use AdminPanel\DB_DATA as data;
use AdminPanel\Functions as fun;
use PROCESS\prs as prs;

$data = new data();
$fun = new fun();
if (isset($_GET['LoginAction'])) {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $pass = $_POST['password'];

        $data->email = $_POST['email'];
        $data->password = $_POST['password'];
        echo $data->Login();
    }

//    exit();
} else if (isset($_GET['LogOutAction'])) {
    $data->ClearSession();
} else if (isset($_SESSION['user_signed_email'])) {
    if (isset($_GET['addUser'])) {
        if (
            isset($_POST['name'])
            && isset($_POST['email'])
            && isset($_POST['user_pass'])
            && isset($_POST['user_type'])
        ) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $pass = $_POST['user_pass'];
            $user_type = $_POST['user_type'];
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $domains = array('yeco-aden.com');
                $pattern = "/^[a-z0-9._%+-]+@[a-z0-9.-]*(" . implode('|', $domains) . ")$/i";
                if (preg_match($pattern, $email)) {
                    prs::unSetData();
                    prs::$table = ADMIN_TABLE;
                    prs::$select_cond = array('email' => $email);
                    if (empty(prs::select__record())) {
                        $fun->password = $pass;
                        $new_pass = $fun->PasswordHash();
                        prs::unSetData();
                        prs::$table = ADMIN_TABLE;
                        prs::$data_in = array(
                            'name' => $name,
                            'password' => $new_pass,
                            'email' => $email,
                            'uid' => 0,
                            'user_type' => $user_type
                        );
                        prs::add__record();
                    } else {
                        echo 'EX';
                    }
                } else {
                    echo 'ONYECO';
                }
            } else {
                echo 'EMLERR';
            }
        }
    } else if (isset($_GET['addData'])) {

        if (isset($_POST['type'])) {

            $type = $_POST['type'];
            switch ($type) {
                case 'addSlides':
                    if (isset($_FILES['slide_photo'])) {
                        $media_file = $_FILES['slide_photo'];
                        $fun->files = $media_file;
                        $fun->folder = 'images\slides';
                        $fun->UploadSingleMedia();
                        $media_info = $fun->file_info;
                        if ($media_info['error'] == 0) {
                            prs::unSetData();
                            prs::$table = SLIDES_TABLE;
                            prs::$data_in = array('url' => $media_info['file_name']);
                            prs::add__record();
                            echo 'yes';
                        }
                    }
                    break;
                case 'branches':
                    if (
                        isset($_POST['name'])
                        && isset($_POST['phone'])
                        && isset($_POST['email'])
                        && isset($_POST['fax'])
                        && isset($_POST['city'])
                        && isset($_POST['address'])

                    ) {
                        $admin = new data();
                        $user_perm = $admin->GetUserType();
                        $allow = (($user_perm == 'admin' || $user_perm == 'mod' || $user_perm == 'branchs_controller') ? true : false);
                        if ($allow) {
                            $name = prs::xss_clean($_POST['name']);
                            $phone = intval($_POST['phone']);
                            $email_contact = $_POST['email'];
                            $fax = intval($_POST['fax']);
                            $city = intval($_POST['city']);
                            $address = $_POST['address'];
                            prs::unSetData();
                            prs::$table = BRAN_TABLE;
                            prs::$data_in = array(
                                'name' => $name,
                                'email_contact' => $email_contact,
                                'phone' => $phone,
                                'fax' => $fax,
                                'city' => $city,
                                'address' => $address,
                            );
                            prs::add__record();
                        }
                    }
                    break;
                case 'sectors':

                    if (
                        isset($_POST['name'])
                        && isset($_POST['about'])
                    ) {
                        $name = $_POST['name'];
                        $about = $_POST['about'];
                        $admin = new data();
                        $user_perm = $admin->GetUserType();
                        $allow = (($user_perm == 'admin' || $user_perm == 'mod' || $user_perm == 'sectors_controller') ? true : false);
                        if ($allow) {
                            $name = $_POST['name'];
                            $about = $_POST['about'];
                            prs::unSetData();
                            prs::$table = SECT_TABLE;
                            prs::$data_in = array(
                                'name' => $name,
                                'about' => $about,
                            );
                            prs::add__record();
                        }
                    }
                    break;
                case 'news':

                    if (
                        isset($_POST['name'])
                        && isset($_POST['keywords'])
                        && isset($_POST['content'])
                        && isset($_POST['date'])
                        && isset($_POST['publish'])
                        && isset($_POST['branch_id'])
                        && isset($_POST['sector_id'])
                    ) {
                        $title = $_POST['name'];
                        $keywords = $_POST['keywords'];
                        $content = $_POST['content'];

                        $date = $_POST['date'];
                        $pub = $_POST['publish'];
                        $br_id = $_POST['branch_id'];
                        $s_id = $_POST['sector_id'];
                        prs::unSetData();
                        prs::$table = NEWS_TABLE;
                        prs::$data_in = array(
                            'title' => $title,
                            'keywords' => $keywords,
                            'content' => $content,
                            'date' => $date,
                            'published' => $pub,
                            'br_id' => $br_id,
                            'sc_id' => $s_id,
                        );
                        prs::add__record();
                        $news_id = prs::$last_id;
                        if (isset($_FILES['media'])) {
                            $media_file = $_FILES['media'];
                            $fun->files = $media_file;
                            $fun->UploadMedia();
                            $media_info = $fun->file_info;
                            foreach ($media_info as $item => $data) {
                                prs::unSetData();
                                $error = $data['error'];
                                if ($error != 1) {
                                    $media_name = $data['file_name'];
                                    prs::$table = NEWS_MEDIA_TABLE;
                                    prs::$data_in = array(
                                        'nid' => $news_id,
                                        'media_url' => $media_name,
                                        'media_type' => $data['media_type']
                                    );
                                    prs::add__record();
                                }
                            }
                        }
                    }
                    break;

            }

        }
    } else if (isset($_GET['UpdatePublish'])) {
        if (isset($_GET['nid'])) {
            echo $_GET['nid'];
            prs::unSetData();
            prs::$table = NEWS_TABLE;
            prs::$select_cond = array('id' => intval($_GET['nid']), 'published' => 0);
            if (!empty(prs::select__record())) {
                prs::unSetData();
                prs::$table = NEWS_TABLE;
                prs::$update_value = array('published' => 1);
                prs::$update_cond = array('id' => intval($_GET['nid']));
                prs::update__record();
            } else {
                prs::unSetData();
                prs::$table = NEWS_TABLE;
                prs::$update_value = array('published' => 0);
                prs::$update_cond = array('id' => intval($_GET['nid']));
                prs::update__record();
            }
        }

    } else if (isset($_GET['FetchDataTable'])) {
        if (isset($_GET['type'])) {
            $type = $_GET['type'];
            switch ($type) {
                case 'slides':
                    prs::unSetData();
                    prs::$table = SLIDES_TABLE;
                    $data = array();
                    foreach (prs::select__record() as $r => $get) {
                        array_push($data, array(
                            'url' =>
                                '<img src="../images/slides/' . $get['image'] . '" width=150>',
                            'option' => '<button class="btn btn-block btn-danger"><i class="fa fa-trash"></button>',
                        ));
                    }
                    echo json_encode($data);
                    break;
                case 'news':
                    prs::unSetData();
                    prs::$table = NEWS_TABLE;
                    $data = array();
                    foreach (prs::select__record() as $r => $get) {
                        array_push($data, array(
                            'title' => $get['title'],
                            'date' => $get['date'],
                            'publish' => (($get['published'] != 0) ? "
                             <button type='button' onclick='UpdatePublish(" . $get['id'] . ",this)' class=\"btn btn-danger\" title='ايقاف النشر'>
                            <i class=\"fa fa-pause\"></i>&nbsp;
                            <span>
                            تم النشر
                            </span>
                            </button>
                            " : "
                             <button class=\"btn btn-danger\" type='button' onclick='UpdatePublish(" . $get['id'] . ",this)'>
                            <i class=\"fa fa-play\"></i>&nbsp;
                            <span>غير منشور</span>
                            </button>
                            "),
                            'linked' => (($get['br_id'] != 0) ? "مرتبط بالفرع" : "غير مرتبط بالفروع") . ' كذلك ' .
                                (($get['sc_id'] != 0) ? "مرتبط بقطاع" : "غير مرتبط بالقطاعات"),
                            'options' => (($get['published'] != 0) ? '
                           
                         
                            ' : '
                            
                            '

                            )
                        ));
                    }
                    echo json_encode($data);
                    break;
//                case 'sectors':
//                    prs::unSetData();
//                    prs::$table = SECT_TABLE;
//                    $data = array();
//                    foreach (prs::select__record() as $r=>$get){
//                        array_push($data,array(
//                            'name'=>$get['name'],
//                            'about'=>$get['about'],
//                            'options'=>'
//                            <button class="btn btn-danger btn-sm" onclick="deleteData('.$get['id'].',\'sectors\')">
//                            <i class="fa fa-trash"></i>
//                            </button>'
//
//                        ));
//                    }
//                    echo json_encode($data);
//                    break;
            }
        }
    } else if (isset($_GET['deleteData'])) {
        if (isset($_GET['type']) && isset($_GET['id'])) {
            $type = $_GET['type'];
            $id = intval($_GET['id']);
            switch ($type) {
                case 'news':

                    break;
//                case 'sectors':
//                    prs::unSetData();
//                    prs::$table = SECT_TABLE;
//                    prs::$cond = array('id'=>$id);
//                    prs::delete__record();
//                    break;
            }
        }

    } else if (isset($_GET['updateHomePage'])) {
        if (isset($_GET['section'])) {
            $section = $_GET['section'];

            switch ($section) {
                case 'About':


                    break;

                case 'Managers':
                    if (
                        isset($_POST['ManagerName'])
                        && isset($_POST['ManagerArt'])

                        && isset($_POST['ManagerAbout'])
                        && isset($_POST['ViceName'])
                        && isset($_POST['ViceArt'])

                        && isset($_POST['ViceAbout'])
                    ) {
                        $manager_name = $_POST['ManagerName'];
                        $manager_article = $_POST['ManagerArt'];

                        $manager_about = $_POST['ManagerAbout'];
                        $vice_name = $_POST['ViceName'];
                        $vice_article = $_POST['ViceArt'];

                        $vice_about = $_POST['ViceAbout'];
                        if (isset($_FILES['ManagerMedia'])) {
                            $fun->folder = 'home_data';
                            $fun->files = $_FILES['ManagerMedia'];
                            $fun->new_name = 'HEAD-MANAGER';
                            $fun->UpdateData();
                            $photo_manager_name = $fun->file_info['file_name'];
                        }
                        if (isset($_FILES['ViceMedia'])) {
                            $fun->folder = 'home_data';
                            $fun->files = $_FILES['ViceMedia'];
                            $fun->new_name = 'VICE';
                            $fun->UpdateData();
                            $photo_vice_name = $fun->file_info['file_name'];
                        }
                        prs::unSetData();
                        prs::$table = HOME_MANAGER_TABLE;
                        if (empty(prs::select__record())) {
                            prs::$data_in = array(
                                'm_name' => $manager_name,
                                'm_about' => $manager_about,
                                'm_article' => $manager_article,

                                'v_name' => $vice_name,
                                'v_about' => $vice_about,
                                'v_article' => $vice_article,
                            );
                            if (isset($_FILES['ManagerMedia'])) {
                                prs::$data_in['m_photo_url'] = $photo_manager_name;
                            }
                            if (isset($_FILES['ViceMedia'])) {
                                prs::$data_in['v_photo_url'] = $photo_vice_name;
                            }
                            prs::add__record();
                        } else {
                            prs::$update_value = array(
                                'm_name' => $manager_name,
                                'm_about' => $manager_about,
                                'm_article' => $manager_article,
                                'v_name' => $vice_name,
                                'v_about' => $vice_about,
                                'v_article' => $vice_article,
                            );
                            if (isset($_FILES['ManagerMedia'])) {
                                prs::$update_value['m_photo_url'] = $photo_manager_name;
                            }
                            if (isset($_FILES['ViceMedia'])) {
                                prs::$update_value['v_photo_url'] = $photo_vice_name;
                            }
                            prs::update__record();
                        }
                    }
                    break;
                case 'ContactUs':

                    break;

                case 'Advanced':

                    break;

            }

        }
    }
}