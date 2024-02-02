<?php
// Assuming you have a database connection established
$servername = "localhost";
$username = "root";
$password = "";
$database = "db_attendance";

// Create connection
$db = new mysqli($servername, $username, $password, $database);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Check if the class_ID is provided in the URL
if (isset($_GET['id'])) {
    $classID = $_GET['id'];

    // Fetch class details from the database
    $query = "SELECT * FROM tb_class WHERE class_ID = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $classID);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the class exists
    if ($result->num_rows > 0) {
        $classData = $result->fetch_assoc();
    } else {
        // Handle the case where the class is not found
        echo "Class not found!";
        exit;
    }

    // Close the prepared statement
    $stmt->close();
} else {
    // Handle the case where class_ID is not provided
    echo "Class ID not provided!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enroll Student</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/style.css">
    <style>
        .autocomplete-list {
        width: 180px;
        background-color: white;
        border-radius: 0 0 5px 5px;
        list-style: none;
        padding: 0;
        max-height: 450px;
        overflow-y: auto;
        position: absolute;
        z-index: 1000;
        box-shadow: 0 5px 20px #FFF5EE;
        }  
        .autocomplete-list-items {
        transition: background-color .2s ease-in-out;
        padding: 5px 20px;
        }
        .autocomplete-list-items:hover {
        background-color: #BEF4B3;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <!-- <div id="navbar-container"></div> -->
    
    <div class="container">
        <form class="form-control mt-5 p-5 bg-light" action="add-student.php?id=<?php echo $classID; ?>" method="post" autocomplete="off">
            <h1 class="text-center">Add Students</h1>
            <div class="row">
                <div class="col-md-2 mt-3">
                    <p class="label-text mb-1">STUDENT ID</p>
                    <input type="text" name="student_ID"  id="input" class="form-control input-border shadow-none" placeholder="Enter ID">

                    <ul class="autocomplete-list"></ul>

                    <!-- https://www.youtube.com/watch?v=pdyFf1ugVfk -->
                    <!-- https://www.youtube.com/watch?v=4zzTT6GQ3hA -->

                </div>
                <div class="col-md-4 mt-3">
                    <p class="label-text mb-1">FIRST NAME</p>
                    <input type="text" name="first_name" class="form-control input-border shadow-none" placeholder="Enter First Name" required>
                </div>
                <div class="col-md-4 mt-3">
                    <p class="label-text mb-1">LAST NAME</p>
                    <input type="text" name="last_name" class="form-control input-border shadow-none" placeholder="Enter Last Name" required>
                </div>
                <div class="col-md-2">
                    <p class="label-text mb-1 mt-3 invisible">ADD</p>
                    <button class="btn input-border create-class-button w-100" type="submit" value="Submit">Add</button>
                </div>
            </div>

            <!-- Enrolled Students -->
            <div class="mt-5">
                <h1 class="text-center mb-2">Enrolled Students</h1>
                <table class="table table-sm table-hover table-light">
                    <tr>
                    <th>STUDENT ID</th>
                    <th colspan="2">NAME</th>
                    </tr>
                    <?php
                    // Fetch enrolled students for the given classID
                    $enrolledQuery = "SELECT s.student_ID, s.first_name, s.last_name FROM tb_enrollment e
                  INNER JOIN tb_student s ON s.student_ID = e.student_ID
                  WHERE e.class_ID = ? AND e.is_deleted = 0 ORDER BY s.last_name ASC";
                    $enrolledStmt = $db->prepare($enrolledQuery);
                    $enrolledStmt->bind_param("i", $classID);
                    $enrolledStmt->execute();
                    $enrolledResult = $enrolledStmt->get_result();

                    // Display enrolled students
                    while ($row = $enrolledResult->fetch_assoc()) {
                        echo "<tr class='align-middle'>";
                        echo "<td>{$row['student_ID']}</td>";
                        echo "<td>{$row['first_name']} {$row['last_name']}</td>";
                        echo "<td class='text-end'>
                                <a type='button' class='btn btn-sm btn-danger  btn-rounded' href='delete_student.php?id=$classID&studentid={$row['student_ID']}' onclick=\"return confirm('Are you sure you want to remove this student?')\">Remove</a>
                            </td>";
                        echo "</tr>";
                    }
                    //<a type='button' class='btn btn-sm btn-outline-dark  btn-rounded' href='edit-student.php?id=$classID&studentid={$row['student_ID']}'>Edit</a>

                    // Close the prepared statement
                    $enrolledStmt->close();
                    ?>

                </table>
            </div>

        </form>
        <div class="d-flex justify-content-center mt-4 pb-5">
            <!-- <a href="#" type="button" class="btn btn-outline-secondary m-1" onclick="history.back();">Back</a> -->
            <a href="class.php?id=<?php echo $classID; ?>" type="button" class="btn btn-sm btn-outline-dark btn-black m-1">Back</a>
            <!-- <a type="button" class="btn btn-primary m-1" href="class.php">Save</a> -->
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
    <script>
        let names = [
        "Ayla", "Jake", "Sean", "Henry", "Brad", "Stephen", "Taylor", "Timmy", "Cathy", "John",
        "Amanda", "Amara", "Sam", "Sandy", "Danny", "Ellen", "Camille", "Chloe", "Emily", "Nadia",
        "Mitchell", "Harvey", "Lucy", "Amy", "Glen", "Peter", "Olivia", "Sophia", "Liam", "Emma",
        "Mia", "Elijah", "Aiden", "Grace", "Jackson", "Eva", "Logan", "Isabella", "Mason", "Ethan",
        "Zoe", "Natalie", "Noah", "Lily", "Avery", "Leah", "Ella", "Isaac", "Hannah", "Caleb", "Charlotte",
        "Landon", "David", "Aria", "Benjamin", "Alexa", "Gabriel", "Julia", "Lucas", "Victoria", "Sofia",
        "Max", "Luna", "Lila", "Ezra", "Samuel", "Scarlett", "Madison", "Aiden", "Aria", "Ella", "Ethan",
        "Liam", "Mila", "Grace", "Daniel", "Eleanor", "Lily", "Nolan", "Ava", "Peyton", "Zachary", "Cameron",
        "Naomi", "Mason", "Emma", "Samantha", "Oliver", "Aubrey", "Claire", "Sophie", "Julian", "Maya", "Owen",
        "Grace", "Levi", "Aaron", "Sophia", "Evelyn", "Zara", "Adam", "Nora", "Ian", "Aaliyah", "Abigail", "Carter",
        "Riley", "Ella", "Connor", "Madeline", "Mackenzie", "Jasmine", "Tristan", "Jordan", "Nathan", "Leo", "Amelia",
        "Hazel", "Julia", "Brooklyn", "Luna", "Avery", "Parker", "Skylar", "Sydney", "Natalie", "Hudson", "Aiden", "Hailey",
        "Caroline", "Cole", "Kylie", "Bella", "Savannah", "Zoe", "Lila", "Alexis", "Gabriel", "Emily", "Michael", "Liam",
        "Megan", "Leah", "Sophia", "Aaron", "Ella", "Avery", "Caleb", "Alexandra", "Elijah", "Aria", "Lucy", "Kai", "Aiden",
        "Jackson", "Eva", "Chloe", "Penelope", "Nathan", "Isaiah", "Lincoln", "Charlotte", "Zoey", "Samantha", "Grace", "Evan",
        "Scarlett", "Mila", "Jayden", "Lily", "Eva", "Olivia", "Madison", "Luke", "Liam", "Aria", "Lucas", "Owen", "Aiden", "Emma",
        "Sophie", "Aubrey", "Daniel", "Stella", "Hazel", "Logan", "Zara", "Aiden", "Mason", "Aria", "Lily", "Emma", "Liam", "Grace",
        "Charlotte", "Olivia", "Sophia", "Isabella", "Mia", "Ella", "Avery", "Scarlett", "Amelia", "Hazel", "Aria", "Lila", "Lucy", "Aubrey",
        "Chloe", "Zoe", "Luna", "Penelope", "Lily", "Eva", "Aiden", "Mason", "Liam", "Olivia", "Emma", "Sophia", "Isabella", "Avery", "Ella",
        "Grace", "Scarlett", "Amelia", "Hazel", "Aria", "Lila", "Lucy", "Aubrey", "Chloe", "Zoe", "Luna", "Penelope", "Lily", "Eva", "Aiden", "Mason",
        "Liam", "Olivia", "Emma", "Sophia", "Isabella", "Avery", "Ella", "Grace", "Scarlett", "Amelia", "Hazel", "Aria", "Lila", "Lucy", "Aubrey", "Chloe",
        "Zoe", "Luna", "Penelope", "Lily", "Eva", "Aiden", "Mason", "Liam", "Olivia", "Emma", "Sophia", "Isabella", "Avery", "Ella", "Grace", "Scarlett", "Amelia",
        "Hazel", "Aria", "Lila", "Lucy", "Aubrey", "Chloe", "Zoe", "Luna", "Penelope", "Lily", "Eva", "Aiden", "Mason", "Liam", "Olivia", "Emma", "Sophia", "Isabella", "Avery",
        "Ella", "Grace", "Scarlett", "Amelia", "Hazel", "Aria", "Lila", "Lucy", "Aubrey", "Chloe", "Zoe", "Luna", "Penelope", "Lily", "Eva", "Aiden", "Mason", "Liam", "Olivia", "Emma",
        "Sophia", "Isabella", "Avery", "Ella", "Grace", "Scarlett", "Amelia", "Hazel", "Aria", "Lila", "Lucy", "Aubrey", "Chloe", "Zoe", "Luna", "Penelope", "Lily", "Eva", "Aiden", "Mason",
        "Liam", "Olivia", "Emma", "Sophia", "Isabella", "Avery", "Ella", "Grace", "Scarlett", "Amelia", "Hazel", "Aria", "Lila", "Lucy", "Aubrey", "Chloe", "Zoe", "Luna", "Penelope", "Lily", "Eva",
        "Aiden", "Mason", "Liam", "Olivia", "Emma", "Sophia", "Isabella", "Avery", "Ella", "Grace", "Scarlett", "Amelia", "Hazel", "Aria", "Lila", "Lucy", "Aubrey", "Chloe", "Zoe", "Luna", "Penelope", "Lily",
        "Eva", "Aiden", "Mason", "Liam", "Olivia"]
        //Sort names in ascending order
        let sortedNames = names.sort();
        //reference
        let input = document.getElementById("input");

        //Execute function on keyup
        input.addEventListener("keyup", (e) => {
        //loop through above array
        //Initially remove all elements ( so if user erases a letter or adds new letter then clean previous outputs)
        removeElements();
        for (let i of sortedNames) {
            //convert input to lowercase and compare with each string
            if (
            i.toLowerCase().startsWith(input.value.toLowerCase()) &&
            input.value != ""
            ) {
            //create li element
            let listItem = document.createElement("li");
            //One common class name
            listItem.classList.add("autocomplete-list-items");
            listItem.style.cursor = "pointer";
            listItem.setAttribute("onclick", "displayNames('" + i + "')");
            //Display matched part in bold
            let word = "<b>" + i.substr(0, input.value.length) + "</b>";
            word += i.substr(input.value.length);
            //display the value in array
            listItem.innerHTML = word;
            document.querySelector(".autocomplete-list").appendChild(listItem);
            }
        }
        });
        function displayNames(value) {
        input.value = value;
        removeElements();
        }
        function removeElements() {
        //clear all the item
        let items = document.querySelectorAll(".autocomplete-list-items");
        items.forEach((item) => {
            item.remove();
        });
        }
    </script>
</body>
</html>