<?php
require '../database.php'; ?>

    <section class="left">
<?php if ($_SESSION["userDetails"]["checkadmin"] == 'ADMIN') { ?>
        <ul>
            <li><a href="/admin/register">Register</a></li>
            <li><a href="/admin/category">Categories</a></li>
            <li><a href="/admin/enquiry">Enquires</a></li>
            <li><a href="/admin/admin">Admins</a></li>
            <?php } ?>
            <li><a href="/admin/jobs">Jobs</a></li>
        </ul>
    </section>
    <section class="right">



