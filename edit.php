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

    <title>Edit</title>
</head>

<body>
    <?php
    include '_nav.php';

    ?>


    <div class="container my-3">
        <a href=" http://localhost/Event/update.php" class="btn btn-primary mx-2">Back</a>
    </div>

    <?php
    include "_database.php";
    $id = $_REQUEST['id'];
    $sql = "SELECT * FROM `student` WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        $fname = $row["fname"];
        $lname = $row["lname"];
        $email = $row["email"];
        $number = $row["number"];
        $Department = $row["Department"];
        $image = $row['image'];
        $gender = $row["gender"];
        $birthdate = $row["birthdate"];
        $event = $row["event"];
    }
    ?>

    <div class="container my-3" style="margin-top: 150px;background-color: #92a8d1;">
        <div class="col-md-12">
            <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <h3 class="my-2 text-center">Enter_Student_Information</h3>
                <hr>
                <div class="d-flex justify-content-center">
                    <form class="col-md-6 mb-3" method="post" action="edithandle.php" enctype="multipart/form-data">

                        <div class="d-flex">
                            <div class="mb-3 col-md-5 mx-0">
                                <label class="form-label">First Name</label>
                                <input type="text" class="form-control" name="fname" id="fname" value="<?php echo $fname ?>">
                            </div>

                            <div class="mb-3 col-md-5 mx-5">
                                <label class="form-label">Last Name</label>
                                <input type="text" class="form-control" name="lname" id="lname" value="<?php echo $lname ?>">
                            </div>
                        </div>


                        <div class="mb-3">
                            <label class="form-label">Email address</label>
                            <input type="email" class="form-control" name="email" id="email" value="<?php echo $email ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Contact No</label>
                            <input type="text" class="form-control" name="number" id="number" value="<?php echo $number ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Department </label><br>
                            <select name="dept" id="dept" class="col-md-12" selected="<?php echo $Department; ?>">
                                <option value="cs" <?php if ($Department == "cs") echo "selected"; ?>>Computer Science Engineering</option>
                                <option value="ee" <?php if ($Department == "ee") echo "selected"; ?>>Electrical Engineering</option>
                                <option value="it" <?php if ($Department == "it") echo "selected"; ?>>Information Technology</option>
                                <option value="ae" <?php if ($Department == "ae") echo "selected"; ?>>Automobile Engineering</option>
                                <option value="ce" <?php if ($Department == "ce") echo "selected"; ?>>Civil Engineering</option>
                                <option value="me" <?php if ($Department == "me") echo "selected"; ?>>Mechanical Engineering</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Photo</label>
                            <input type="file" name="image" id="image" class="form-control" <?php echo $image ?>>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Gender</label><br>
                            <input type="radio" name="gender" id="gender" value="male" <?php if ($gender == "male") echo "checked"; ?>>Male
                            <input type="radio" name="gender" id="gender" value="female" <?php if ($gender == "female") echo "checked"; ?>>Female
                            <input type="radio" name="gender" id="gender" value="other" <?php if ($gender == "other") echo "checked"; ?>>Other
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Birthdate</label><br>
                            <select name="s1">
                                <?php
                                $date = range(1, 31);
                                foreach ($date as $i) {

                                ?>
                                    <option value="<?php echo $i; ?>" <?php if (in_array($i, explode("-", $birthdate))) {
                                                                            echo "selected";
                                                                        } ?>><?php echo $i; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <select name="s2">

                                <?php
                                $date = range(1, 12);
                                foreach ($date as $i) {

                                ?>


                                    <option value="<?php echo $i; ?>" <?php if (in_array($i, explode("-", $birthdate))) {
                                                                            echo "selected";
                                                                        } ?>><?php echo $i; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <select name=" s3">

                                <?php
                                $date = range(1980, 2020);
                                foreach ($date as $i) {

                                ?>

                                    <option value="<?php echo $i; ?>" <?php if (in_array($i, explode("-", $birthdate))) {
                                                                            echo "selected";
                                                                        } ?>><?php echo $i; ?></option>
                                <?php
                                }
                                ?>
                            </select>

                        </div>
                        <p>
                            <label>Select event:(Check all that apply)</label>
                        <table width="200px" ;border="2">
                            <tr>

                                <td><input type="checkbox" name="event[]" value="asp" <?php if (in_array("asp", explode(",", $event, -1))) {
                                                                                            echo "checked";
                                                                                        } ?>>asp</td>
                                <td><input type="checkbox" name="event[]" value="java" <?php if (in_array("java", explode(",", $event, -1))) {
                                                                                            echo "checked";
                                                                                        } ?>>java</td>
                                <td><input type="checkbox" name="event[]" value="html" <?php if (in_array("html", explode(",", $event, -1))) {
                                                                                            echo "checked";
                                                                                        } ?>>html</td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" name="event[]" value="design" <?php if (in_array("design", explode(",", $event, -1))) {
                                                                                                echo "checked";
                                                                                            } ?>>Design</td>
                                <td><input type="checkbox" name="event[]" value="c" <?php if (in_array("c", explode(",", $event, -1))) {
                                                                                        echo "checked";
                                                                                    } ?>>c</td>
                                <td><input type="checkbox" name="event[]" value="php" <?php if (in_array("php", explode(",", $event, -1))) {
                                                                                            echo "checked";
                                                                                        } ?>>php</td>
                            </tr>

                        </table>
                        </p>

                        <a href="http://localhost/Event/update.php" class="btn btn-danger">Cancle</a>
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <button type="submit" class="btn btn-primary" name="update">Update</button>
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