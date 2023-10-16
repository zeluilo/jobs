<?php

namespace Ijdb\Controllers;

class Admin
{
    private $categoriesTable;
    private $jobsTable;
    private $applicantsTable;
    private $adminsTable;
    private $contactTable;

    public function __construct($jobsTable, $categoriesTable, $applicantsTable, $adminsTable, $contactTable)
    {
        $this->applicantsTable = $applicantsTable;

        $this->jobsTable = $jobsTable;

        $this->categoriesTable = $categoriesTable;

        $this->adminsTable = $adminsTable;

        $this->contactTable = $contactTable;
    }
    /*---------------- ENQUIRIES ----------------*/

    public function enquiry(): array
    {
        $this->checklogin();
        $query = 'SELECT c.*, u.username
                    FROM contact c
                    LEFT JOIN user u
                        ON u.userId = c.adminId';
        $enquiries = $this->contactTable->join($query, []);
        return [
            'template' => 'enquiry.html.php',
            'title' => 'Enquiry List',
            'variables' => ['enquiries' => $enquiries]
        ];
    }

    public function completeEnquiry()
    {
        $this->session();
        $this->checklogin();
        $values = [
            'id' => $_POST['id'],
            'adminId' => $_SESSION['userDetails']['userId']];
        $query = 'SELECT c.*, u.username
                    FROM contact c
                    LEFT JOIN user u
                        ON u.userId = c.adminId';
        $this->contactTable->update($values);
        $enquiries = $this->contactTable->join($query, []);

        return [
            'template' => 'enquiry.html.php',
            'title' => 'Enquiry List',
            'variables' => ['enquiries' => $enquiries]
        ];

    }


    /*---------------- APPLICANTS ----------------*/


    public function applicants(): array
    {
        $this->session();
        $this->checklogin();
        $jobs = $this->jobsTable->find('id', $_GET['id'])[0];
        $applicants = $this->applicantsTable->find('jobId', $_GET['id']);

        return [
            'template' => 'applicants.html.php',
            'variables' => ['applicants' => $applicants, 'jobs' => $jobs],
            'title' => 'Applicants'
        ];
    }


    /*---------------- CATEGORY ----------------*/

    public function category(): array
    {
        $this->session();
        $this->checklogin();
        $categories = $this->categoriesTable->findAll();
        return [
            'template' => 'category.html.php',
            'title' => 'Category List',
            'variables' => ['categories' => $categories]
        ];
    }

    public function addcategory(): array
    {
        $this->session();
        $this->checklogin();
        if (isset($_POST['submit'])) {
            $values = [
                'name' => $_POST['name']
            ];
            $this->categoriesTable->insert($values);
            header('location: /admin/category');
        }
        return [
            'template' => 'addcategory.html.php',
            'variables' => [''],
            'title' => 'Add Category'
        ];
    }

    public function editcategory(): array
    {
        $this->session();
        $this->checklogin();
        if (isset($_POST['submit'])) {
            $values = ['name' => $_POST['name'],
                'id' => $_POST['id']];
            $this->categoriesTable->update($values);
            header('location: /admin/category');
        }
        $categories = $this->categoriesTable->find('id', $_GET['id'])[0];
        return [
            'template' => 'editcategory.html.php',
            'variables' => ['categories' => $categories],
            'title' => 'Edit Category'
        ];
    }

    public function deletecategory()
    {
        $this->categoriesTable->delete($_POST['id']);
        header('location: /admin/category');
    }


    /*---------------- JOB ----------------*/

    public function jobs(): array
    {
        $this->session();
        $this->checklogin();
        $this->checklogin();
        $values = [];
        $query = 'SELECT j.*, c.name as CATNAME, (SELECT count(*) as count FROM applicants a WHERE a.jobId = j.id) as count 
                                                    FROM job j
                                                    LEFT JOIN category c 
                                                         ON j.categoryId = c.id';
        if (isset($_GET['name'])) {
            $query .= ' WHERE j.categoryId=:categoryId';
            $values = ['categoryId' => $_GET['name']];
        }
        $jobs = $this->jobsTable->join($query, $values);
        $categories = $this->categoriesTable->findAll();
        return [
            'template' => 'jobs.html.php',
            'title' => 'Job List',
            'variables' => ['jobs' => $jobs, 'categories' => $categories]
        ];
    }

    public function jobList(): array
    {
        $this->session();
        $this->checklogin();
        $jobs = $this->jobsTable->find('categoryId', $_GET['id']);
        $categories = $this->categoriesTable->findAll();
        $categorySet = $this->categoriesTable->find('id', $_GET['id']);

        return [
            'template' => 'list.html.php',
            'title' => 'Job List',
            'variables' => ['jobs' => $jobs, 'categories' => $categories, 'categorySet' => $categorySet]
        ];
    }

    public function addjob(): array
    {
        $this->session();
        $this->checklogin();
        $categories = $this->categoriesTable->findAll();
        if (isset($_POST['submit'])) {
            $values = [
                'title' => $_POST['title'],
                'description' => $_POST['description'],
                'salary' => $_POST['salary'],
                'location' => $_POST['location'],
                'categoryId' => $_POST['categoryId'],
                'closingDate' => $_POST['closingDate']
            ];
            $this->jobsTable->insert($values);
            header('location: /admin/jobs');
        }
        return [
            'template' => 'addjob.html.php',
            'variables' => ['categories' => $categories],
            'title' => 'Add Job'
        ];
    }

    public function editjobs(): array
    {
        $this->session();
        $this->checklogin();
        $category = $this->categoriesTable->findAll();
        $job = $this->jobsTable->find('id', $_GET['id'])[0];
        if (isset($_POST['submit'])) {
            $values = [
                'id' => $_POST['id'],
                'title' => $_POST['title'],
                'description' => $_POST['description'],
                'salary' => $_POST['salary'],
                'location' => $_POST['location'],
                'categoryId' => $_POST['categoryId'],
                'closingDate' => $_POST['closingDate'],
            ];
            $this->jobsTable->update($values);
            header('location: /admin/jobs');
        }
        return [
            'template' => 'editjobs.html.php',
            'variables' => ['category' => $category, 'job' => $job],
            'title' => 'Edit Job'
        ];
    }

    public function deletejob()
    {
        $this->session();
        $this->checklogin();
        $values = [
            'id' => $_POST['id'],
            'save' => 1
        ];
        $this->jobsTable->update($values);
        header('location: /admin/jobs');
    }

    public function archive()
    {
        $this->session();
        $this->checklogin();
        $values = [
            'id' => $_POST['id'],
            'save' => NULL
        ];
        $this->jobsTable->update($values);
        header('location: /admin/jobs');
    }


    /*----------------REGISTER & LOGIN ----------------*/
    public function admin(): array
    {
        $this->session();
        $this->checklogin();
        $admins = $this->adminsTable->findAll();
        return [
            'template' => 'admin.html.php',
            'title' => 'Admin Login List',
            'variables' => ['admins' => $admins]
        ];
    }

    public function deleteadmin()
    {
        $this->session();
        $this->checklogin();
        $this->adminsTable->delete($_POST['userid']);
        header('location: /admin/job');
    }

    public function session()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    public function checklogin()
    {
        if (!isset($_SESSION['loggedin'])) {
            header("Location: /admin/login");
            exit();
        }
    }

    public function register(): array
    {
        if (isset($_POST['submit'])) {
            $pw = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $values = [
                'username' => $_POST['username'],
                'email' => $_POST['email'],
                'password' => $pw,
                'checkadmin' => $_POST['checkadmin']
            ];
            $this->adminsTable->insert($values);
        }
        return [
            'template' => 'register.html.php',
            'title' => 'Register',
            'variables' => []
        ];
    }

    public function login(): array
    {
        $show_message = '';
        if (isset($_POST['submit'])) {
            $username = $this->adminsTable->find('username', $_POST['username']);
            if ($username) {
                $verify_pw = password_verify($_POST['password'], $username[0]['password']);
                if ($verify_pw) {
                    $_SESSION['loggedin'] = $username[0]['userId'];
                    $_SESSION['userDetails'] = $username[0];

                    header("Location: /admin/jobs");
                } else {
                    $show_message = 'Wrong Information'; // for your password
                }
            } else {
                $show_message = 'Wrong Information'; // for your email
            }
        }
        return [
            'template' => 'login.html.php',
            'title' => 'Login',
            'variables' => ['show_message' => $show_message]
        ];
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        header("Location: /job/home");
    }
}