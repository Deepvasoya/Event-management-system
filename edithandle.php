  <?php
    include "_database.php";
    if (isset($_POST['update'])) {


        $id = $_POST['id'];
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

        $sql = "UPDATE `student` SET `fname` = '$fname', `lname` = '$lname', `email` = '$email', `number` = '$number', `Department` = '$dept', `image` = '$file_address', `gender` = '$gender', `birthdate` = '$birthdate', `event` = ' $event', `date` = 'current_timestamp()' WHERE `student`.`id` = $id";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Record Update successfully');</script>";
            echo "<script>window.location.href = 'update.php';</script>";
        } else {
            echo "<script>alert('Record Not Update');</script>";
            echo "<script>window.location.href = 'edit.php';</script>";
        }
        exit;
    }
    ?>
