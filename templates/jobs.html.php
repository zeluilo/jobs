<?php require '../database.php'?>
<main class="sidebar">
<?php require '../templates/sidebar.html.php';?>
    <h1>Jobs</h1>
        <a class="new" href="/admin/addjob">Add new job</a>
    <form action="#">
        <select style="position: absolute" name="name">
            <?php foreach ($categories as $category) {
                echo '<option value="' . $category['id'] . '">' . $category['name'] . '</option>';
            }
            ?>
            <input style="width: 10%" type="submit" name="submit" value="Search" />
        </select>
    </form><br>
      <br><br>  <table>
            <thead>
                <tr>
                    <th style="width: 35%">Title</th>
                    <th style="width: 25%">Salary</th>
                    <th style="width: 15%">Category</th>
                    <th style="width: 15%">&nbsp;</th>
                    <th style="width: 5%">&nbsp;</th>
                    <th style="width: 5%">&nbsp;</th>
                </tr>

            <?php foreach ($jobs as $job) { ?>
                <tr>
                    <td><?=$job['title']?></td>
                    <td><?=$job['salary']?></td>
                    <td><?=$job['CATNAME']?></td>
                    <td>
                        <a style="float: right" href="/admin/editjobs?id=<?= $job['id']?>">Edit</a>
                    </td>
                    <td>
                        <a style="float: right" href="/admin/applicants?id=<?= $job['id']?>">View applicants ( <?= $job['count']?> )</a></td>
                    <td>
                        <?php if ($job['save'] == 1) { ?>
                        <form method="post" action="/admin/deletejob">
                            <input type="hidden" name="id" value="<?=$job['id']?>" />
                            <input type="submit" name="submit" value="Repost" />
                        </form>
                        <?php } else { ?>
                        <form method="post" action="/admin/deletejob">
                            <input type="hidden" name="id" value="<?=$job['id']?>" />
                            <input type="submit" name="submit" value="Delete" />
                        </form>
                        <?php } ?>
                    </td>
                </tr>
           <?php } ?>
            </thead>
        </table>
    </section>
</main>
