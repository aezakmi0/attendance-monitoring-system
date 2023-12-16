
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class Code</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <!-- Navbar -->
    <!-- <div id="navbar-container"></div> -->
    
    <div class="container">
        <form class="form-control mt-5 p-5">
            <h1 class="text-center">Add Students</h1>
            <div class="row">
                <div class="col-md-2 mt-3">
                    <p class="label-text mb-1">STUDENT ID</p>
                    <input type="text" class="form-control" placeholder="Enter ID" required>
                </div>
                <div class="col-md-4 mt-3">
                    <p class="label-text mb-1">LAST NAME</p>
                    <input type="text" class="form-control" placeholder="Enter Last Name" required>
                </div>
                <div class="col-md-4 mt-3">
                    <p class="label-text mb-1">FIRST NAME</p>
                    <input type="text" class="form-control" placeholder="Enter Class Code" required>
                </div>
                <div class="col-md-2">
                    <p class="label-text mb-1 mt-3 invisible">ADD</p>
                    <button class="btn btn-primary w-100">Add</button>
                </div>
            </div>

            <div class="mt-5">
                <h1 class="text-center mb-2">Enrolled Students</h1>
                <table class="table table-hover">
                    <tr>
                    <th>STUDENT ID</th>
                    <th colspan="2">NAME</th>
                    </tr>
                    <tr class="align-middle">
                    <td>Alfreds Futterkiste</td>
                    <td>Maria Anders</td>
                    <td class="text-end"><a type="button" class="btn btn-sm btn-outline-secondary">Edit</a>
                        <a type="button" class="btn btn-sm btn-danger">Remove</a></td>
                    </tr>
                    <tr class="align-middle">
                    <td>Alfreds Futterkiste</td>
                    <td>Maria Anders</td>
                    <td class="text-end"><a type="button" class="btn btn-sm btn-outline-secondary">Edit</a>
                        <a type="button" class="btn btn-sm btn-danger">Remove</a></td>
                    </tr>
                    <tr class="align-middle">
                    <td>Alfreds Futterkiste</td>
                    <td>Maria Anders</td>
                    <td class="text-end"><a type="button" class="btn btn-sm btn-outline-secondary">Edit</a>
                        <a type="button" class="btn btn-sm btn-danger">Remove</a></td>
                    </tr>
                    <tr class="align-middle">
                    <td>Alfreds Futterkiste</td>
                    <td>Maria Anders</td>
                    <td class="text-end"><a type="button" class="btn btn-sm btn-outline-secondary">Edit</a>
                        <a type="button" class="btn btn-sm btn-danger">Remove</a></td>
                    </tr>
                    <tr class="align-middle">
                    <td>Alfreds Futterkiste</td>
                    <td>Maria Anders</td>
                    <td class="text-end"><a type="button" class="btn btn-sm btn-outline-secondary">Edit</a>
                        <a type="button" class="btn btn-sm btn-danger">Remove</a></td>
                    </tr>
                    <tr class="align-middle">
                    <td>Alfreds Futterkiste</td>
                    <td>Maria Anders</td>
                    <td class="text-end"><a type="button" class="btn btn-sm btn-outline-secondary">Edit</a>
                        <a type="button" class="btn btn-sm btn-danger">Remove</a></td>
                    </tr>
                    <tr class="align-middle">
                    <td>Alfreds Futterkiste</td>
                    <td>Maria Anders</td>
                    <td class="text-end"><a type="button" class="btn btn-sm btn-outline-secondary">Edit</a>
                        <a type="button" class="btn btn-sm btn-danger">Remove</a></td>
                    </tr>
                </table>
            </div>
        </form>
        <div class="d-flex justify-content-center mt-4">
            <a href="#" type="button" class="btn btn-outline-secondary m-1" value="Cancel" onclick="history.back();">Cancel</a>
            <a type="button" class="btn btn-primary m-1" href="class.php">Save</a>
        </div>
    </div>
    <script src="assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>
</html>