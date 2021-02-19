<?php
session_start();

if (isset($_SESSION['uid'])) {
    echo "";
} else {
    header("http://localhost/Event/");
}
?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <title>Add</title>
</head>

<body>
    <?php
    include '_nav.php';

    ?>
    <div class="container my-3">
        <a href=" http://localhost/Event/home.php" class="btn btn-primary mx-2">Back</a>
    </div>

    <?php


    include "_database.php";

    if (isset($_POST['submit'])) {


        $fname = $_POST['fname'];  #fname
        $lname = $_POST['lname'];  #lname
        $email = $_POST['email'];  #email
        $number = $_POST['number']; #number
        $dept = $_POST['dept'];     #dept
        $gender = $_POST['gender'];  #gender


        if (!empty($_POST['s1']) && !empty($_POST['s2']) && !empty($_POST['s3'])) {      #birthdate
            $a = $_POST['s1'];
            $b = $_POST['s2'];
            $c = $_POST['s3'];

            $birthdate = $a . '-' . $b . '-' . $c;
        }

        $event = "";   #event
        foreach ($_POST['event'] as $i) {
            $event .= $i . ',';
        }

        #image
        $file_name = $_FILES['image']['name'];
        $file_type = $_FILES['image']['type'];
        $file_tmp_name = $_FILES['image']['tmp_name'];
        $file_size = $_FILES['image']['size'];
        $file_address = "userimage/" . $file_name;

        $fileext = explode('.', $file_name);
        $filecheck = strtolower(end($fileext));
        $fileextstore = array("jpg", "png", "jpeg");
        if (in_array($filecheck, $fileext)) {
            move_uploaded_file($file_tmp_name, $file_address);
        }

        $sql = "INSERT INTO `student` (`fname`, `lname`, `email`, `number`, `Department`, `image`, `gender`, `birthdate`, `event`, `date`) VALUES ('$fname', '$lname', ' $email', '$number', '$dept', '$file_address', '$gender', '$birthdate', '$event', current_timestamp())";
        $result = mysqli_query($conn, $sql);


        header('Location: http://localhost/Event/home.php');
        exit;
    }




    ?>






    <div class="container my-3" style="margin-top: 150px;background-color: #92a8d1;">
        <div class="col-md-12">
            <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <h3 class="my-2 text-center">Enter_Student_Information</h3>
                <hr>
                <div class="d-flex justify-content-center">
                    <form class="col-md-6 mb-3" method="post" action="add.php" enctype="multipart/form-data">

                        <div class="d-flex">
                            <div class="mb-3 col-md-5 mx-0">
                                <label class="form-label">First Name</label>
                                <input type="text" class="form-control" name="fname" id="fname">
                            </div>

                            <div class="mb-3 col-md-5 mx-5">
                                <label class="form-label">Last Name</label>
                                <input type="text" class="form-control" name="lname" id="lname">
                            </div>
                        </div>


                        <div class="mb-3">
                            <label class="form-label">Email address</label>
                            <input type="email" class="form-control" name="email" id="email">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Contact No</label>
                            <input type="text" class="form-control" name="number" id="number">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Department </label><br>
                            <select name="dept" id="dept" class="col-md-12">
                                <option value="cs">Computer Science Engineering</option>
                                <option value="ee">Electrical Engineering</option>
                                <option value="it">Information Technology</option>
                                <option value="ae">Automobile Engineering</option>
                                <option value="ce">Civil Engineering</option>
                                <option value="me">Mechanical Engineering</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Photo</label>
                            <input type="file" name="image" id="image" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Gender</label><br>
                            <input type="radio" name="gender" id="gender" value="male" checked>Male
                            <input type="radio" name="gender" id="gender" value="female">Female
                            <input type="radio" name="gender" id="gender" value="other">Other
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Birthdate</label><br>
                            <select name="s1">
                                <?php
                                $date = range(1, 31);
                                foreach ($date as $i) {

                                ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <select name="s2">

                                <?php
                                $date = range(1, 12);
                                foreach ($date as $i) {

                                ?>


                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <select name="s3">

                                <?php
                                $date = range(1980, 2020);
                                foreach ($date as $i) {

                                ?>

                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php
                                }
                                ?>
                            </select>

                        </div>
                        <p>
                            <label>Select event:(Check all that apply)</label>
                        <table width="200px" ;border="2">




                            <tr>
                                <td><input type="checkbox" name="event[]" value="asp">asp</td>
                                <td><input type="checkbox" name="event[]" value="java">java</td>
                                <td><input type="checkbox" name="event[]" value="html">html</td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" name="event[]" value="design">Design</td>
                                <td><input type="checkbox" name="event[]" value="c">c</td>
                                <td><input type="checkbox" name="event[]" value="php">php</td>
                            </tr>

                        </table>
                        </p> <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    -->
</body>

</html>