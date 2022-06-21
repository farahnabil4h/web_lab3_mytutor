<?php
include_once("dbconnect.php");
if (isset($_GET['subid'])) {
    $subid = $_GET['subid'];
    $sqlsubjects = "SELECT * FROM tbl_subjects WHERE subject_id = '$subid'";
    $stmt = $conn->prepare($sqlsubjects);
    $stmt->execute();
    $number_of_result = $stmt->rowCount();
    if($number_of_result>0){
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $rows = $stmt->fetchAll();
    } else{
        echo "<script>alert('Subject not found.');</script>";
        echo "<script> window.location.replace('main.php')</script>";
    }
}else{
    echo "<script>alert('Page Error.');</script>";
    echo "<script> window.location.replace('main.php')</script>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="../js/menu.js" defer></script>
    <link rel="stylesheet" href="../css/style.css">
    <title>Welcome to MY Tutor</title>
</head>

<body>
    <!-- Sidebar -->
    <div class="w3-sidebar w3-bar-block w3-card w3-animate-left w3-large" style="display:none; z-index:5;" id="mySidebar">
        <button onclick="w3_close()" class="w3-bar-item w3-button w3-large">Close &times;</button>
        <a href="main.php" class="w3-bar-item w3-button w3-hover-green"><i class="fa fa-home"></i>&ensp;Dashboard</a>
        <a href="main.php" class="w3-bar-item w3-button w3-hover-green"><i class="fa fa-html5"></i>&ensp;Courses</a>
        <a href="tutors.php" class="w3-bar-item w3-button w3-hover-green"><i class="fa fa-book"></i>&ensp;Tutors</a>
        <a href="#" class="w3-bar-item w3-button w3-hover-green"><i class="fa fa-bell"></i>&ensp;Subscription</a>
        <a href="#" class="w3-bar-item w3-button w3-hover-green"><i class="fa fa-user"></i>&ensp;Profile</a>
    </div>

    <div class="w3-overlay" onclick="w3_close()" style="cursor:pointer" id="myOverlay"></div>

    <header class="w3-green w3-header">
        <button class="w3-button w3-green w3-xlarge" onclick="w3_open()">☰</button>
        <div class="w3-display-container w3-center w3-padding">
            <h1 style="font-size:calc(8px+4vw);">Subject Details</h1>
        </div>
        <div class="w3-bar w3-green">
                <a href="main.php" class="w3-bar-item w3-button w3-right">Back</a>
        </div>
    </header>

    <div>
        <?php
            foreach ($rows as $subjects) {
                $subid = $subjects['subject_id'];
                $subname = $subjects['subject_name'];
                $subdesc = $subjects['subject_description'];
                $subprice = number_format((float)$subjects['subject_price'], 2, '.', ''); 
                $subsessions = $subjects['subject_sessions'];
                $subrating = number_format((float)$subjects['subject_rating'], 2, '.', '');
            }
            echo "<div class='w3-center w3-half w3-container w3-padding-large'><div class='w3-row'><img class='w3-image resimg' src=../../admin/res/assets/courses/$subid.png" .
            " onerror=this.onerror=null;this.src='../../user/res/images/logomytutor.png'"
            . "><hr></div></div>";
            echo "<div class='w3-container w3-half'><div class='w3-row'><h3><b>$subname</b></h3>
            <p class='w3-text-green' style= 'font-weight: 700; font-size: 40px; margin: 0px;'>RM $subprice</p>
            <p class='w3-text-green' style= 'font-weight: 500; font-size: 20px; margin: 0px;'>$subsessions Sessions</p>
            <p class='w3-text-green' style= 'font-weight: 500; font-size: 20px; margin: 0px;'>Rating: $subrating/5</p>
            <p><b>Description</b><br><br>$subdesc</p>
            </div></div>";
        ?>
    </div>

    <footer class="w3-footer w3-center w3-bottom w3-green">Copyright &copy; 2022 MY Tutor</footer>
</body>
</html>