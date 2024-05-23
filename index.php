<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
        <title>The Unreal Employees</title>
        <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
        <h1>The UNREAL Employees App</h1>

        <?php
        require_once("login_db.php");
        // Add any new users before querying User table
        $firstname = $_POST['firstname'];
        $title = $_POST['title'];
        $designation = $_POST['designation'];
        $year_of_joining = $_POST['year_of_joining'];
        $date_of_birth = $_POST['date_of_birth'];
        
        if(isset($firstname)) {
                $query = 'INSERT INTO `employees`.`employee` (`firstname`, `title`, `designation`, `year_of_joining`, `date_of_birth`) VALUES("'.$firstname.'", "'.$title.'", "'.$designation.'", "'.$year_of_joining.'", "'.$date_of_birth.'");';
                
                if ($conn->query($query) === TRUE) {
                        echo "User created successfully";
                } else {
                        echo "Error: <br>" . $conn->error;
                }
        }

        $query = 'SELECT * FROM employee';
        $result = $conn->query($query);

        if($result) {
                echo "<table>";
                        echo "<th>Serial_Number</th>";
                        echo "<th>Firstname</th>";
                        echo "<th>Lastname</th>";
                        echo "<th>Designation</th>";
                        echo "<th>Date of Joining</th>";
                        echo "<th>Date of Birth</th>";
                while ($row = mysqli_fetch_array($result)) {
                        echo "<tr>";
                        echo "<td>".$row['serial_num']."</td>";
                        echo "<td>".$row['firstname']."</td>";
                        echo "<td>".$row['title']."</td>";
                        echo "<td>".$row['designation']."</td>";
                        echo "<td>".$row['year_of_joining']."</td>";
                        echo "<td>".$row['date_of_birth']."</td>";
                        echo "</tr>";
                }
                echo "</table>";
        } else {
                echo "Error: The User table might not have been created yet. Query failed: $query";
        }
        ?>

        <h3>Add New User</h3>
        <form action="index.php" method="post">
                FirstName: <input type="text" id="firstname" name="firstname"><br />
                Title: <input type="text" id="title" name="title"><br />
                Designation: <input type="text" id="designation" name="designation"><br />
                Year Of Joining: <input type="text" id="year_of_joining" name="year_of_joining"><br />
                Date of Birth: <input type="text" id="date_of_birth" name="date_of_birth"><br />
                <input type = "submit" onclick="validateUserInfo()">
        </form>

        <script>
                function validateUserInfo() {
                        var firstname = document.getElementById("firstname").value;
                        if(firstname === "") {
                                output += "Name must not be blank.\n";
                        }

                        if(output != "") {
                                alert(output);
                        }
                }
        </script>
</body>
</html>

<?php
$conn->close();
?>

