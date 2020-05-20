<?php
/*
 * PROGRAMED BY EN.MUHAMMAD KAMAL OMAIR 2017
 * ALL RIGHT RESERVED
 * en.muhammadkamal@live.com
 *
 */

use Admins\AddOthers as other;
use Admins\AdminFunctions as AdminFun;
use Admins\ProjectsItems as items;
use Admins\Services as ser;
use Fun\functions as fun;

if (isset($_GET['formAction'])) {

    $type = $_GET['formAction'];
    $admin = new AdminFun();
    $ser = new ser();
    $item = new items();
    switch ($type) {
        case 'ContactInfo':
            if (isset($_POST['phone'])) {
                $phone = $_POST['phone'];
                for ($i = 0; $i < count($phone); $i++) {
                    $admin->inputData = array(
                        'data_type' => 'phone',
                        'data' => $phone[$i],
                    );
                    $admin->AddContactInfo();
                }
            }
            if (isset($_POST['facebook'])) {
                $facebook = $_POST['facebook'];
                for ($i = 0; $i < count($facebook); $i++) {
                    $admin->inputData = array(
                        'data_type' => 'facebook',
                        'data' => $facebook[$i],
                    );
                    $admin->AddContactInfo();
                }
            }
            if (isset($_POST['twitter'])) {
                $facebook = $_POST['twitter'];
                for ($i = 0; $i < count($facebook); $i++) {
                    $admin->inputData = array(
                        'data_type' => 'twitter',
                        'data' => $facebook[$i],
                    );
                    $admin->AddContactInfo();
                }
            }
            if (isset($_POST['email'])) {
                $facebook = $_POST['email'];
                for ($i = 0; $i < count($facebook); $i++) {
                    $admin->inputData = array(
                        'data_type' => 'email',
                        'data' => $facebook[$i],
                    );
                    $admin->AddContactInfo();
                }
            }
            if (isset($_POST['insta'])) {
                $facebook = $_POST['insta'];
                for ($i = 0; $i < count($facebook); $i++) {
                    $admin->inputData = array(
                        'data_type' => 'insta',
                        'data' => $facebook[$i],
                    );
                    $admin->AddContactInfo();
                }
            }
            if (isset($_POST['youtube'])) {
                $facebook = $_POST['youtube'];
                for ($i = 0; $i < count($facebook); $i++) {
                    $admin->inputData = array(
                        'data_type' => 'youtube',
                        'data' => $facebook[$i],
                    );
                    $admin->AddContactInfo();
                }
            }

            break;
        case 'metaData':
            if (isset($_POST['title_ar']) && isset($_POST['title_en'])) {
                $title_ar = $_POST['title_ar'];
                $title_en = $_POST['title_en'];
                $admin->inputData = array(
                    'data_type' => 'web_title',
                    'data_ar' => $title_ar,
                    'data_en' => $title_en
                );
                $admin->AddCompanyInfo();
            }
            if (isset($_POST['about_ar']) && isset($_POST['about_en'])) {
                if ($_POST['about_ar'] != '' && $_POST['about_en'] != '') {
                    $title_ar = $_POST['about_ar'];
                    $title_en = $_POST['about_en'];
                    $admin->inputData = array(
                        'data_type' => 'background',
                        'data_ar' => $title_ar,
                        'data_en' => $title_en
                    );
                    $admin->AddCompanyInfo();
                }
            }
            if (isset($_POST['close_web'])) {
                $c = intval($_POST['close_web']);
                $admin->inputData = array(
                    'closed' => $c,
                );
                $admin->CloseWeb();
            }
            break;
        case 'services':
            if (
                isset($_POST['service_en']) && $_POST['service_en'] != ''
                && isset($_POST['service_ar']) && $_POST['service_ar'] != ''
                && isset($_POST['city'])
                && isset($_POST['sector_id']) && $_POST['sector_id'] != 0
                && isset($_POST['about_ar']) && $_POST['about_ar'] != ''
                && isset($_POST['about_en']) && $_POST['about_en'] != ''
            ) {
                $ser->inputData = array(
                    'service_ar' => $_POST['service_ar'],
                    'service_en' => $_POST['service_en'],
                    'about_service_ar' => $_POST['about_ar'],
                    'about_service_en' => $_POST['about_en'],
                    'city_id' => $_POST['city'],
                    'sector_id' => $_POST['sector_id'],
                );
                $ser->AddServices();
            }
            break;
        case 'Projects':

            if (
                isset($_POST['title_ar'])
                && isset($_POST['title_en'])
                && isset($_POST['city'])
                && isset($_POST['sector_id'])
                && isset($_POST['service_id'])
                && isset($_POST['start_date'])
                && isset($_POST['end_date'])
                && isset($_POST['client_id'])
                && isset($_POST['con_type'])
                && isset($_POST['ads'])
            ) {
                $item->inputData = array(
                    'title_ar' => $_POST['title_ar'],
                    'title_en' => $_POST['title_en'],
                    'city_id' => $_POST['city'],
                    'sid' => $_POST['sector_id'],
                    'service_id' => $_POST['service_id'],
                    'date_start' => $_POST['start_date'],
                    'date_end' => $_POST['end_date'],
                    'client_id' => $_POST['client_id'],
                    'ProjectType' => 1,
                    'contract_type' => $_POST['con_type'],
                    'advisor' => $_POST['ads'],
                );
                $item->AddProjectsItems();
            }
            break;
        case 'items':

            if (
                isset($_POST['title_ar'])
                && isset($_POST['title_en'])
                && isset($_POST['sector_id'])
                && isset($_POST['service_id'])
                && isset($_FILES['image'])
            ) {
                $item->inputData = array(
                    'name_ar' => $_POST['title_ar'],
                    'name_en' => $_POST['title_en'],
                    'sid' => $_POST['sector_id'],
                    'service_id' => $_POST['service_if'],
                    'photo' => $_FILES['image'],
                );
                $item->AddProjectsItems('items');
            }
            break;
        case 'media':
            if (
                isset($_POST['MediaType'])
                && isset($_POST['name_ar'])
                && isset($_POST['name_en'])
                && isset($_FILES['image'])
            ) {
                if (isset($_POST['media_id'])) {
                    $media_id = $_POST['media_id'];
                } else {
                    $media_id = 0;
                }
                $admin->inputData = array(
                    'media_type' => $_POST['MediaType'],
                    'photo' => $_FILES['image'],
                    'name_ar' => $_POST['name_ar'],
                    'name_en' => $_POST['name_en'],
                    'media_id' => $media_id,
                );
                $admin->AddMedia();
            }

            break;
        case 'client':
            if (isset($_POST['name_ar']) && isset($_POST['name_en'])) {
                $admin->inputData = array(
                    'name_ar' => $_POST['name_ar'],
                    'name_en' => $_POST['name_en']
                );
                $admin->AddClients();
            }
            break;
        case 'sectors':
            if (isset($_POST['title_en']) && isset($_POST['title_ar']) &&
                isset($_POST['about_en'])
                && isset($_POST['about_ar'])
            ) {
                $admin->inputData = array(
                    'title_en' => $_POST['title_en'],
                    'title_ar' => $_POST['title_ar'],
                    'about_en' => $_POST['about_en'],
                    'about_ar' => $_POST['about_ar'],
                );
                $admin->AddSector();
            }
            break;
        case 'page':
            if (
                isset($_POST['title_ar'])
                && isset($_POST['title_en'])
                && isset($_POST['related'])
                && isset($_POST['content_ar'])
                && isset($_POST['content_en'])
            ) {
                $admin->inputData = array(
                    'title_ar' => $_POST['title_ar'],
                    'title_en' => $_POST['title_en'],
                    'related_to' => $_POST['related'],
                    'content_ar' => $_POST['content_ar'],
                    'content_en' => $_POST['content_en'],
                );
                if (isset($_FILES['page_media'])) {

                    $admin->file = $_FILES['page_media'];
                }
                $admin->AddPage();
            }
            break;
        case 'suppliers':
            $other = new other();
            if (isset($_POST['sub_en']) && isset($_POST['sub_ar']) && isset($_POST['link']) && isset($_FILES['sub_logo'])) {
                for ($i = 0; $i < count($_POST['sub_en']); $i++) {
                    $other->file_name = $_FILES['sub_logo']['name'][$i];
                    $other->file_tmp = $_FILES['sub_logo']['tmp_name'][$i];
                    $other->file_type = $_FILES['sub_logo']['type'][$i];
                    if ($other->UploadLogo()) {
                        $other->inputData = array(
                            'name_ar' => $_POST['sub_ar'][$i],
                            'name_en' => $_POST['sub_en'][$i],
                            'webLink' => $_POST['link'][$i],
                            'logo' => $other->logo,
                        );
                        $other->addSuppliers();
                    }
                }
                echo 'Added';
            }
            break;
    }

    exit();
} else if (isset($_GET['Load'])) {
    $type = $_GET['Load'];
    switch ($type) {
        case 'services':
            if (isset($_GET['sid'])) {
                $sid = $_GET['side'];
            } else {
                $sid = false;
            }
            $fun = new fun();
            echo $fun->ServicesListAsOptions(false, $sid);
            break;
        case 'clients':
            $fun = new fun();
            echo $fun->ClientsListAsOptions(false);
            break;
        case 'projects':
            $fun = new fun();
            echo $fun->ProjectsListAsOptions(false);
            break;
        case 'items':
            $fun = new fun();
            echo $fun->ItemsListAsOptions(false);
            break;
        case 'sectors':
            if (isset($_GET['unLoadAll'])) {
                $t = false;
            } else {
                $t = true;
            }
            $fun = new fun();
            echo $fun->SectorsListAsOptions($t);
            break;
        case 'suppliers':
            $fun = new fun();
            if (isset($GET['AsOptions'])) {

                $option = true;
                if (isset($_GET['AllOption'])) {
                    $all = true;
                }
            } else {
                $option = false;
                $all = false;
            }
            echo $fun->SuppliersList($option, $all);
            exit();
            break;
    }
} else if (isset($_GET['Delete'])) {
    $admin = new AdminFun();
    $type = $_GET['Delete'];
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        $admin->DeleteData($id, $type);
    }
}