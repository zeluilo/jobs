<?php
namespace Ijdb\Controllers;
class Page
{
    private $categoriesTable;
    private $jobsTable;
    private $applicantsTable;
    private $contactTable;

    public function __construct($jobsTable, $categoriesTable, $applicantsTable, $contactTable)
    {
        $this->applicantsTable = $applicantsTable;

        $this->jobsTable = $jobsTable;

        $this->contactTable = $contactTable;

        $this->categoriesTable = $categoriesTable;

    }


    /*---------------- HOME ----------------*/
    public
    function home(): array
    {
        $values = [];
        $query = 'SELECT j.*, c.id AS catId 
                    FROM job j
                        
                    LEFT JOIN category c 
                        ON c.id = j.categoryId';
        if (isset($_GET['location'])) {
            $query .= ' WHERE j.location=:location AND j.save IS NULL  ORDER BY j.closingDate ASC LIMIT 10';
            $values = ['location' => $_GET['location']];
        } else {
            $query .= ' WHERE j.save IS NULL  ORDER BY j.closingDate ASC LIMIT 10';
        }
        $jobs = $this->jobsTable->join($query, $values);
        $criteria = 'SELECT DISTINCT location FROM job';
        $locations = $this->jobsTable->join($criteria, []);
        return [
            'template' => 'home.html.php',
            'title' => "Jo's Jobs - Home",
            'variables' => ['jobs' => $jobs, 'locations' => $locations]
        ];
    }

    public function jobList(): array
    {
        $jobs = $this->jobsTable->find('categoryId', $_GET['id']);
        $categories = $this->categoriesTable->findAll();
        $categorySet = $this->categoriesTable->find('id', $_GET['id']);

        return [
            'template' => 'list.html.php',
            'title' => 'Job List',
            'variables' => ['jobs' => $jobs, 'categories' => $categories, 'categorySet' => $categorySet]
        ];
    }

    public
    function faqs(): array
    {
        return [
            'template' => 'faqs.html.php',
            'title' => 'FAQs',
            'variables' => ['']
        ];
    }

    public
    function about(): array
    {
        return [
            'template' => 'about.html.php',
            'title' => 'Jo"s Jobs - About',
            'variables' => ['']
        ];
    }

    public
    function contact(): array
    {
        if (isset($_POST['submit'])) {
            $values = [
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'telephone' => $_POST['telephone'],
                'enquiry' => $_POST['enquiry']
            ];
            $this->contactTable->insert($values);
            header('location: /job/contact');
        }
        return [
            'template' => 'contact.html.php',
            'title' => 'Contact Us',
            'variables' => ['']
        ];
    }

    public
    function apply()
    {
        $show_message = '';
        if (isset($_POST['submit'])) {
            if ($_FILES['cv']['error'] == 0) {

                $parts = explode('.', $_FILES['cv']['name']);
                $extension = end($parts);
                $fileName = uniqid() . '.' . $extension;
                move_uploaded_file($_FILES['cv']['tmp_name'], 'cvs/' . $fileName);

                $criteria = [
                    'name' => $_POST['name'],
                    'email' => $_POST['email'],
                    'details' => $_POST['details'],
                    'jobId' => $_POST['jobId'],
                    'cv' => $fileName
                ];
                $this->applicantsTable->insert($criteria);
                header('location: /job/home');
            } else {
                $show_message = 'There was an error uploading your CV';
            }
        } else {
            $job = $this->jobsTable->find('id', $_GET['id'])[0];
        }
        return [
            'template' => 'apply.html.php',
            'title' => 'Apply For Jobs',
            'variables' => ['job' => $job, 'show_message' => $show_message]
        ];
    }
}
