<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <script src="https://kit.fontawesome.com/142309adca.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&family=Open+Sans:wght@600&family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../style/index.css">
        <title>Document</title>
    </head>
    <body>
        <?php include("../include/header.inc");?>
        <div class="jobs_page">
            <section class="title">
                <h1>IT and Developments</h1>
                <p>Thank you for your interest in the IT positions here at our company.<br>
                    We appreciate the time you've taken to consider joining our team.<br>
                    <br>
                    Here are the postions that we are currently hiring<br>
                    &nbsp;<!--idk why margin-bottom doesn't work-->                    
                </p>
            </section>

            <?php

            $host = "feenix-mariadb.swin.edu.au";
            $user = "s104814221"; // your user name
            $pwd = "070205"; // your password (date of birth ddmmyy unless changed)
            $sql_db = "s104814221_db"; // your database
            
            $conn = @mysqli_connect(
                $host,
                $user,
                $pwd,
                $sql_db
            );

            if (!$conn) {
                echo "<p>Database connection failure</p>";
            } else {

                $query = "SELECT * FROM jobs";
                $result = mysqli_query($conn, $query);

                while ($job = mysqli_fetch_assoc($result)) { ?>

                <section class="jobs">
                    <div class="job">
                        <div class="job_info">
                            <div class="job_brief">
                            <h2 class="job_name"><?= $job['name'] ?></h2>
                            <h3 class="job_head">Job brief</h3>
                            <p class="job_desc"><?= $job['brief'] ?></p>
                            <h3 class="job_head">Key responsibilities</h3>
                            <ul class="jobs_ul">
                                <?php
                                $responsibilities = explode("\n", $job['responsibilities']);
                                foreach ($responsibilities as $responsibility) {
                                    echo "<li>" . $responsibility . "</li>";
                                }
                                ?>
                            </ul>
                            <h3 class="job_head">Skills and qualifications</h3>
                            <h4>Essentials</h4>
                            <ul class="jobs_ul" id="essential">
                                <?php
                                $qualifications = explode("\n", $job['skill_essential']);
                                foreach ($qualifications as $qualification) {
                                    echo "<li>" . $qualification . "</li>";
                                }
                                ?>      
                            </ul>
                            <h4>Preferable</h4>
                            <ul class="jobs_ul" id="preferable">
                                <?php
                                $qualifications = explode("\n", $job['skill_preferable']);
                                foreach ($qualifications as $qualification) {
                                    echo "<li>" . $qualification . "</li>";
                                }
                                ?>
                            </ul>
                        </div>
                        <aside>
                        <div class="job_reqs">
                            <h4>Job reference number</h4>
                            <p><?= $job['ref_num'] ?></p>
                            <h4>Salary</h4>
                            <p><?= $job['salary'] ?></p>
                            <h4>Benefits</h4>
                            <p>To help you stay energized, engaged and inspired, we offer a wide range of benefits including:</p>
                            <ol class="jobs_ol">
                                <?php
                                $benefits= explode("\n", $job['benefits']);
                                    foreach ($benefits as $benefit) {
                                        echo "<li>" . $benefit . "</li>";
                                    }
                                ?>
                            </ol>
                            <h4>Applicants please fill this application form and report to Vice Chancellor of HRM</h4>
                            <a href="apply.php">Link to form</a>
                        </div>
                    </aside>
                </div>
        <?php }
            mysqli_close($conn);
        } ?>
        <?php include("../include/footer.inc");?>
    </body>
</html>