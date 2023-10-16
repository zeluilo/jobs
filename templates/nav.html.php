<nav>
    <ul>
        <li><a href="/">Home</a></li>
        <li>Jobs
            <ul>
                <?php
                require '../database.php';
                use CSY2028\DatabaseTable;

                $categoriesTable = new databaseTable($pdo,'category', 'id');
                $categories = $categoriesTable->findAll();
                foreach($categories as $category) {
                    echo '<li><a href="../job/jobList?id=' .$category['id'] . '">' . $category['name'] . '</a></li>';
                }
                ?>
            </ul>
        <li><a href="../job/contact">Contact Us</a></li>
        <li><a href="../job/about">About Us</a></li>
        <li><a href="../job/faqs">FAQs</a></li>
    </ul>
</nav>