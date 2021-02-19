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

    <title>Delete</title>
</head>

<body>
    <?php
    include '_nav.php';
    ?>
    <div class="container my-3">
        <a href=" http://localhost/Event/home.php" class="btn btn-primary mx-2">Back</a>
    </div>




    <div class="container my-5" style="margin-top: 150px;background-color: #92a8d1;">

        <h3 class="my-2 text-center">Search Student Name</h3>
        <hr>
        <div class="d-flex ">
            <form class="col-md-3 mb-3" method="post" action="delete.php">


                <div class="mb-3">
                    <label class="form-label">First Name</label>
                    <input type="text" class="form-control" name="fname" id="fname">
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

                <button type="submit" class="btn btn-primary" name="search">Search</button>
            </form>
        </div>
    </div>

    <div class="container" style="margin-top: 150px; background-color: #92a8d1;">
        <h3 class="my-2 text-center">Show Student</h3>
        <hr>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Sno</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Email address</th>
                    <th scope="col">Contact No</th>
                    <th scope="col">Department</th>
                    <th scope="col">Photo</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Birthdate</th>
                    <th scope="col">Event</th>
                    <th scope="col">Operation</th>
                </tr>
            </thead>

            <?php
            include '_database.php';
            if (isset($_POST['search'])) {

                $dept = $_POST['dept'];
                $fname = $_POST['fname'];

                $sql = "SELECT * FROM `student` WHERE fname = '$fname' AND Department LIKE '%$dept%'";
                $result = mysqli_query($conn, $sql);
                $i = 0;

                while ($row = mysqli_fetch_assoc($result)) {
                    $i++;

                    echo '
                     <tbody>
                      <tr>
                    <th scope="row">' . $i . '</th>
                    <td>' . $row["fname"] . '</td>
                    <td>' . $row["lname"] . '</td>
                    <td>' . $row["email"] . '</td>
                    <td>' . $row["number"] . '</td>
                    <td>' . $row["Department"] . '</td>
                    <td><img src=' . $row['image'] . '  width="100" height="100" ></td>
                    <td>' . $row["gender"] . '</td>
                    <td>' . $row["birthdate"] . '</td>
                    <td>' . $row["event"] . '</td>
                    <td><a href="http://localhost/Event/home.php" class="btn btn-primary">Cancle</a><a href=" http://localhost/Event/deleteitem.php?id=' . $row["id"] . '" class="btn btn-danger mx-2">Delete</a></td>
                    </tr>
                    ';
                }
            }
            ?>


            </tbody>
        </table>

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