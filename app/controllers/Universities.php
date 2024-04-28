<?php
class Universities extends Controller
{
    public function __construct()
    {
        $this->organizationModel = $this->model('Organization');
        $this->userModel = $this->model('User');
        $this->universityModel = $this->model('University');
    }

    public function filterUniversities()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {


            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $universities = $this->universityModel->getFilterUniversities($_POST);

            $data = [
                'universities' => $universities,
            ];

            $this->view('users/admin/universityfilter', $data);

        }
    }

    public function filterDomains()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {


            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $domains = $this->universityModel->getFilterDomains($_POST);

            $data = [
                'domains' => $domains,
            ];
            $this->view('users/admin/unidomainfilter', $data);

        }
    }

    public function deleteUniversity()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $universityId = $_POST['universityId'];
            $data = [
                'universityId' => $universityId,
            ];
            if ($this->universityModel->deleteUniversity($data)) {
                echo true;
            } else {
                echo false;
            }
        }
    }

    public function deleteDomain()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $domainId = $_POST['domainId'];
            $data = [
                'domainId' => $domainId,
            ];
            if ($this->universityModel->deleteDomain($data)) {
                echo true;
            } else {
                echo false;
            }
        }
    }


    public function addUniversityForm()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
            ];
            $this->view('users/admin/addUniversityForm', $data);
        }
    }

    public function addUniversity()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $name = $_POST['name'];
            $unicode = $_POST['unicode'];
            $data = [
                'name' => $name,
                'unicode' => $unicode,
            ];

            if ($this->universityModel->addUniversity($data)) {
                echo true;
            } else {
                echo false;
            }
        }
    }

    public function addDomainForm()
    {
        $universities = $this->userModel->getAllUniversities();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'universities'=>$universities
            ];
            $this->view('users/admin/addUniDomainForm', $data);
        }
    }

    public function addDomain()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $universityId = $_POST['universityId'];
            $domain = $_POST['domain'];
            $data = [
                'universityId' => $universityId,
                'domain' => $domain,
            ];

            if ($this->universityModel->addDomain($data)) {
                echo true;
            } else {
                echo false;
            }
        }
    }

    
}

