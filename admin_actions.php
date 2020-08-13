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
                $max_order = $admin->GetLastSectorNumber();
                $new_order = $max_order + 1;
                $admin->inputData = array(
                    'title_en' => $_POST['title_en'],
                    'title_ar' => $_POST['title_ar'],
                    'about_en' => $_POST['about_en'],
                    'about_ar' => $_POST['about_ar'],
                    'menu_order' => $new_order
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
                    if (!empty($_FILES['page_media'])) {
                        $admin->file = $_FILES['page_media'];
                    }
                }
                $admin->AddPage();
                if ($_POST['related'] == 'about' || $_POST['related'] == 'contact') {
                    $order_num = $admin->GetLastMenuNumber($_POST['related']) + 1;
                    $id = $admin->output_id;
                    $type = $_POST['related'];
                    $admin->addMenuOrder($id, $type, $order_num);
                }
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
        case 'branches':
            $other = new other();
            if (isset($_GET['update_mc'])) {
                if (isset($_GET['id'])) {
                    $other->UpdateBrMC(intval($_GET['id']));
                }
            } else {
                if (
                    isset($_POST['address_en'])
                    && isset($_POST['address_ar'])
                    && isset($_POST['city_id'])
                    && isset($_POST['email_address'])
                    && isset($_POST['phone'])
                    && isset($_POST['fax'])
                    && isset($_POST['whatsapp'])
                ) {

                    $other->inputData = array(
                        'city_id' => $_POST['city_id'],
                        'address_ar' => $_POST['address_ar'],
                        'address_en' => $_POST['address_en'],
                        'phone' => $_POST['phone'],
                        'email' => $_POST['email_address'],
                        'fax' => $_POST['fax'],
                        'whatsapp' => $_POST['whatsapp'],
                    );
                    $other->addBranch();
                }
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
            if (isset($_GET['LoadAll'])) {
                $all = true;
            } else {
                $all = false;
            }
            $fun = new fun();
            echo $fun->ServicesListAsOptions($all, $sid);
            break;
        case 'clients':
            $fun = new fun();
            echo $fun->ClientsListAsOptions(false);
            break;
        case 'projects':
            if (isset($_GET['LoadAll'])) {
                $all = true;
            } else {
                $all = false;
            }
            if (isset($_GET['service'])) {
                $sid = $_GET['service'];
            } else {
                $sid = 0;
            }
            $fun = new fun();
            echo $fun->ProjectsListAsOptions($all, $sid);
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
        case 'branches':
            $other = new other();
            echo $other->BranchesList();
            break;
        case 'Pages':
            $other = new other();
            echo $other->PagesList(true);
            break;
    }
} else if (isset($_GET['LoadUpdates'])) {
    $type = $_GET['type'];
    $fun = new fun();
    switch ($type) {
        case 'services':
            if (isset($_GET['service_id'])) {
                $service = $_GET['service_id'];
                echo json_encode($fun->ServicesListAsArray($service));
            }
            break;
        case 'project':
            if (isset($_GET['pid'])) {
                $pid = $_GET['pid'];
                echo json_encode($fun->ProjectListAsArray($pid));
            }
            break;
        case 'media':
            if (isset($_GET['MediaType'])) {
                $media = $_GET['MediaType'];
                $admin = new AdminFun();
                $admin->inputData['type'] = $media;
                echo json_encode($admin->GetMedia());
            }
            break;
        case 'page':
            if (isset($_GET['pid'])) {
                $id = $_GET['pid'];
                $fun = new fun();
                echo json_encode($fun->PageAsArray($id));
            }
            break;
    }
    exit();
} else if (isset($_GET['updateData'])) {
    $admin = new AdminFun();
    if (isset($_GET['type'])) {
        $type = $_GET['type'];
        switch ($type) {
            case 'sectors':
                if (isset($_POST['sector_id'])) {
                    $id = intval($_POST['sector_id']);
                    if (
                        isset($_POST['sector_en'])
                        && isset($_POST['sector_ar'])
                    ) {

                        $admin->inputID = $id;
                        $admin->inputData = array(
                            'title_en' => $_POST['sector_en'],
                            'title_ar' => $_POST['sector_ar'],
                        );
                        $admin->UpdateSector();
                    }
                }
                break;
            case 'service':
                if (
                    isset($_POST['service_id'])
                    && isset($_POST['service_en'])
                    && isset($_POST['service_ar'])
                    && isset($_POST['city'])
                    && isset($_POST['about_en'])
                    && isset($_POST['about_ar'])
                ) {
                    $ser = new ser();
                    $ser->inputID = $_POST['service_id'];
                    $ser->inputData = array(
                        'service_ar' => $_POST['service_ar'],
                        'service_en' => $_POST['service_en'],
                        'city_id' => $_POST['city'],
                        'about_service_ar' => $_POST['about_ar'],
                        'about_service_en' => $_POST['about_en'],
                    );
                    $ser->UpdateServices();
                }
                break;
            case 'project':
                print_r($_REQUEST);
                if (
                    isset($_POST['project_id'])
                    && isset($_POST['project_name_en'])
                    && isset($_POST['project_name_ar'])
                    && isset($_POST['project_city'])
                    && isset($_POST['start'])
                    && isset($_POST['end'])
                    && isset($_POST['client_project'])
                    && isset($_POST['contract'])
                    && isset($_POST['adv'])
                ) {
                    $item = new items();
                    $item->inputID = $_POST['project_id'];
                    $item->inputData = array(
                        'title_ar' => $_POST['project_name_ar'],
                        'title_en' => $_POST['project_name_en'],
                        'city_id' => $_POST['project_city'],
                        'date_start' => $_POST['start'],
                        'date_end' => $_POST['end'],
                        'client_id' => $_POST['client_project'],
                        'contract_type' => $_POST['contract'],
                        'advisor' => $_POST['adv'],
                    );
                    $item->UpdateProjectItems();
                }
                break;
            case 'pages':
                if (
                    isset($_POST['page_id'])
                    && isset($_POST['title_en'])
                    && isset($_POST['title_ar'])
                    && isset($_POST['related'])
                    && isset($_POST['content_en'])
                    && isset($_POST['content_ar'])
                ) {
                    $page = new other();
                    $page->inputID = $_POST['page_id'];
                    $page->inputData = array(
                        'title_ar' => $_POST['title_ar'],
                        'title_en' => $_POST['title_en'],
                        'related_to' => $_POST['related'],
                        'content_ar' => $_POST['content_ar'],
                        'content_en' => $_POST['content_en'],
                    );
                    $page->UpdatePage();
                }
                break;
            case 'updateMenuOrder':
                if (isset($_GET['id'])) {
                    $id = intval($_GET['id']);
                    if (isset($_GET['order_up'])) {
                        $type = 'up';
                    } else {
                        $type = 'down';
                    }
                    if (isset($_GET['ptype'])) {
                        $page_type = $_GET['ptype'];
                    } else {
                        $page_type = 'about';
                    }
                    $order = new other();
                    $order->UpdateOrder($id, $type, $page_type);
                }
                break;
        }
    }

    exit();
} else if (isset($_GET['Delete'])) {
    $admin = new AdminFun();
    $type = $_GET['Delete'];
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        $admin->DeleteData($id, $type);
    }
}