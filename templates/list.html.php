<main class="sidebar">
	<section class="left">
		<ul>
			<?php
			foreach ($categories as $category) {
				echo '<li class="current"><a href="../jobList?id=' . $category['id'] . '">' . $category['name'] . '</a></li>';
			}
			?>
		</ul>
	</section>

	<section class="right">
		<h1>
            <?php
            if(isset($categorySet)) {
                echo $categorySet[0]['name'];
            }
            ?>
        Jobs</h1>
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
	</section>
</main>