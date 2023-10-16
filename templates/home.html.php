
<main class="home">
    <form action="" method="get">
        <select style="position: absolute" name="location">
            <?php foreach ($locations as $location) {
                echo '<option value="' . $location['location'] . '">' . $location['location'] . '</option>';
            }
            ?>
            <input style="width: 10%" type="submit" name="submit" value="Search" />
        </select>
    </form><br><br><br><br>

    <h1>Jobs</h1>
    <p>Welcome to Jo's Jobs, we're a recruitment agency based in Northampton. We offer a range of different office jobs. Get in touch if you'd like to list a job with us.</a></p>

    <h2>Select the type of job you are looking for:</h2>

    <ul class="listing">
        <?php foreach ($jobs as $job) { ?>
            <li>
                <div class="details">
                    <h2> <?php echo $job['title']; ?> </h2>
                    <h3> <?php echo $job['salary']; ?> </h3>
                    <p> <?php echo nl2br($job['description']); ?> </p>
                    <a class="more" href="/job/apply?id=<?= $job['id'] ?>">Apply for this job</a>
                </div>
            </li>
        <?php } ?>
    </ul>
</main>