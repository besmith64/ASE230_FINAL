<?php
// Load all of the php scripts
require_once('settings/settings.php');
require_once('authentication/auth.php');
require_once('classes/c_contractors.php');
require_once('classes/c_materials.php');
require_once('classes/c_project.php');
require_once('classes/c_user.php');

$logged = 0;
// print_r($_COOKIE['user']);
if (count($_SESSION) > 0 && is_numeric($_SESSION['ID'])) {
    $logged = 1;
}

$project = new Project();
$projectArray = $project->get_project_by_user($connection, $_SESSION['ID']);

// Load Admin Data
if ($logged == 1 && $_SESSION['GID'] == 1) {
    $user = new User();
    $contractors = new Contractor();
    $materials = new Materials();

    $userArray = $user->get_users($connection);
    $contractorsArray = $contractors->get_contractor($connection);
    $materialsArray = $materials->get_materials($connection);
    $projectArrayAll = $project->get_projects_all($connection);

    //Add New Material
    if (isset($_POST['matSubmit'])) {
        try {
            $values = array(
                $_POST['inputNewMat'],
                $_POST['inputNewMatDesc'],
                $_POST['inputNewMatCost']
            );
            $materials->create_material($connection, $values);
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
}

?>

<!DOCTYPE html>
<html style="font-size: 16px" lang="en">
<!-- You can submit a link to the public GITHub repository or a ZIP file. The submission must contain:

    A document (max 10 pages/slides) describing  what the project does and including relevant screenshots of the website (the document can consist of a number of screenshots and a brief paragraph for each screenshot); The document should also describe what to do in order to make it work on a different environment (e.g., set the base tag, change configuration settings);
    A picture of the database diagram representing the last version of the database
    The SQL export of the database, including relevant data for navigating the website (i.e., dummy data), if needed.
    The project code.
    Instructions for setting up the database and running the code.

Your code should:

    -work as expected: please, make sure that there are no errors due to incorrect settings or missing files and folders (10 points)
     be published on GitHub (10 points)
    -make use of AJAX (2 points)

The code shoud not:

    crash or contain errors or code smell https://en.wikipedia.org/wiki/Code_smell (Links to an external site.) (e.g., print_r statements...) (-5 points)
    be prone to SQL injections (-5 points);
    be entirely copied from somewhere else (-39 points)  -->

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="utf-8" />
    <title>Mr. Fixit!</title>
    <link rel="icon" type="image/x-icon" href="settings/favicon.ico">
    <link rel="stylesheet" href="css/nicepage.css" media="screen" />
    <link rel="stylesheet" href="css/login.css" media="screen" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
    <script src="https://kit.fontawesome.com/057979aec3.js" crossorigin="anonymous"></script>
    <script class="u-script" type="text/javascript" src="js/jquery.js" defer=""></script>
    <script class="u-script" type="text/javascript" src="js/nicepage.js" defer=""></script>
    <meta name="generator" content="Nicepage 4.19.3, nicepage.com" />
    <link id="u-theme-google-font" rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i" />

    <meta name="theme-color" content="#478ac9" />
</head>

<body class="u-body u-xl-mode" data-lang="en"
    style="background-image: url('settings/background.jpg'); background-size: cover;">
    <header>
        <nav class="navbar bg-light fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php"><i class="fa-solid fa-wrench"></i> Mr. Fixit!</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                    aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">
                            <i class="fa-solid fa-wrench"></i> Mr. Fixit!
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                            </li>
                            <?php if ($logged == 0) : ?>
                            <li class="nav-item">
                                <a class="nav-link" href="authentication/signin.php">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="authentication/signup.php">Signup</a>
                            </li>
                            <?php else : ?>
                            <li class="nav-item">
                                <?php echo 'Welcome, ' . $_SESSION['firstname'] ?>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="authentication/signout.php">Sign Out</a>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <!-- Main Body -->
    <div class="container rounded-3 shadow"
        style="padding-top: 50px; padding-bottom: 10px; background-color: rgb(208, 220, 251);">
        <!-- Main Nav Tabs -->
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane"
                    type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Home</button>
            </li>
            <?php if ($logged == 1) : ?>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="project-tab" data-bs-toggle="tab" data-bs-target="#project-tab-pane"
                    type="button" role="tab" aria-controls="project-tab-pane" aria-selected="false">Project</button>
            </li>
            <?php endif; ?>
            <?php if ($logged == 1 && $_SESSION['GID'] == 1) : ?>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="admin-tab" data-bs-toggle="tab" data-bs-target="#admin-tab-pane"
                    type="button" role="tab" aria-controls="admin-tab-pane" aria-selected="false">Admin</button>
            </li>
            <?php endif; ?>
        </ul>
        <div class="tab-content" id="myTabContent">
            <!-- Landing Page -->
            <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab"
                tabindex="0">
                <h4 class="text-center">Welcome to Mr. Fixit!</h4>
                <h6 class="text-center"><i>A website dedicated to project management, allowing engineers to create and
                        manage projects.</i></h6>
                <hr class="border border-primary border-1 opacity-75">
                <p style="font-size: 12px;">When using Mr. Fixit you can track materials used, location of the project,
                    as well as monitor the total cost of the project and how much has been spent so far. Managing a
                    project can be complicated and overwhelming and Mr. Fixit is here to make things easier for
                    you.</br></br>To start working on a project simply sign up and start building your future projects!
                </p>
            </div>
            <!-- Project Tab -->
            <div class="tab-pane fade" id="project-tab-pane" role="tabpanel" aria-labelledby="project-tab" tabindex="0">
                <div class="d-grid gap-2 col-4 mx-auto" style="padding-top: 10px; padding-bottom: 10px;">
                    <!-- <a href="https://www.google.com" type="button" class="btn btn-primary btn-lg">Create a New Project</a> -->
                    <!-- Create a new project -->
                    <button type="button" id="createProj" data-bs-target="#CreateProjModal" title="Create Project"
                        data-bs-toggle="modal" class="btn btn-primary btn-lg">
                        <i class="fa-solid fa-square-plus"></i> Create a New Project
                    </button>
                </div>
                <!-- List of users Projects -->
                <table class="table table-hover table-responsive">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Project Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Address</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($projectArray as $key => $val) : ?>
                        <tr onclick="document.location = `<?= 'project.php?ID=' . $val['Project_ID']; ?>`;">
                            <th scope="row"><?= $val['Project_ID']; ?></th>
                            <td><?= $val['Project_Name']; ?></td>
                            <td><?= $val['Project_Description']; ?></td>
                            <td><?= $val['Address'] . ' ' . $val['City'] . ', ' . $val['State'] . ' ' . $val['ZipCode']; ?>
                            </td>
                            <td>
                                <button type="button" id="deleteProject" data-bs-target="#DeleteModal"
                                    title="Delete Project" data-bs-toggle="modal" class="btn btn-danger btn-small">
                                    <i class="fa-solid fa-trash "></i>
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- Admin Nav Tab -->
            <!-- <div id="div1"><h2>Let jQuery AJAX Change This Text</h2></div> -->
            <div class="tab-pane fade" id="admin-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
                <div class="d-flex align-items-start">
                    <!-- Admin Nav Tabs -->
                    <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist"
                        aria-orientation="vertical">
                        <button class="nav-link active" id="v-pills-1-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-1" type="button" role="tab" aria-controls="v-pills-1"
                            aria-selected="true">User Management</button>
                        <button class="nav-link" id="v-pills-2-tab" data-bs-toggle="pill" data-bs-target="#v-pills-2"
                            type="button" role="tab" aria-controls="v-pills-2" aria-selected="false">Add
                            Contractor</button>
                        <button class="nav-link" id="v-pills-3-tab" data-bs-toggle="pill" data-bs-target="#v-pills-3"
                            type="button" role="tab" aria-controls="v-pills-3" aria-selected="false">Add
                            Material</button>
                        <button class="nav-link" id="v-pills-4-tab" data-bs-toggle="pill" data-bs-target="#v-pills-4"
                            type="button" role="tab" aria-controls="v-pills-4" aria-selected="false">All
                            Projects</button>
                        <button class="nav-link" id="v-pills-5-tab" data-bs-toggle="pill" data-bs-target="#v-pills-5"
                            type="button" role="tab" aria-controls="v-pills-5" aria-selected="false">All
                            Contractors</button>
                        <button class="nav-link" id="v-pills-6-tab" data-bs-toggle="pill" data-bs-target="#v-pills-6"
                            type="button" role="tab" aria-controls="v-pills-6" aria-selected="false">All
                            Materials</button>
                    </div>
                    <div class="tab-content" id="v-pills-tabContent">
                        <!-- User Management Tab -->
                        <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel"
                            aria-labelledby="v-pills-1-tab" tabindex="0">
                            <table class="table table-hover table-responsive">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Group</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Full Name</th>
                                        <th scope="col">Edit</th>
                                        <th scope="col">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($userArray as $key => $val) : ?>
                                    <tr>
                                        <th scope="row"><?= $val['UID']; ?></th>
                                        <td><?= ($val['GID'] == 1) ? 'Admin' : 'User'; ?></td>
                                        <td><?= $val['email']; ?></td>
                                        <td><?= $val['firstname'] . ' ' . $val['lastname']; ?></td>
                                        <td>
                                            <button type="button" id="editUser" data-bs-target="#EditUserModal"
                                                title="Edit User" data-bs-toggle="modal"
                                                class="btn btn-warning btn-small">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                        </td>
                                        <td>
                                            <button type="button" id="deleteUser" data-bs-target="#DeleteUserModal"
                                                title="Delete User" data-bs-toggle="modal"
                                                class="btn btn-danger btn-small">
                                                <i class="fa-solid fa-trash "></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <!--Add Contractor Tab -->
                        <div class="tab-pane fade" id="v-pills-2" role="tabpanel" aria-labelledby="v-pills-2-tab"
                            tabindex="0">
                            <form class="row g-3">
                                <div class="col-12">
                                    <label for="inputContractor" class="form-label">Contractor:</label>
                                    <input type="text" class="form-control" id="inputContractor"
                                        placeholder="Enter a new contractor name">
                                </div>
                                <div class="col-12">
                                    <label for="inputNewContDesc" class="form-label">Description:</label>
                                    <textarea class="form-control" placeholder="Enter a description..."
                                        id="inputNewContDesc" style="height: 100px"></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Create</button>
                                </div>
                            </form>
                        </div>
                        <!-- Add Material Tab -->
                        <div class="tab-pane fade" id="v-pills-3" role="tabpanel" aria-labelledby="v-pills-3-tab"
                            tabindex="0">
                            <form class="row g-3" method="POST">
                                <div class="col-12">
                                    <label for="inputNewMat" class="form-label">Material:</label>
                                    <input type="text" class="form-control" id="inputNewMat" name="inputNewMat"
                                        placeholder="Enter a new material name">
                                </div>
                                <div class="col-12">
                                    <label for="inputNewMatDesc" class="form-label">Description:</label>
                                    <textarea class="form-control" placeholder="Enter a description..."
                                        id="inputNewMatDesc" name="inputNewMatDesc" style="height: 100px"></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputNewMatCost" class="form-label">Cost:</label>
                                    <input type="text" class="form-control" id="inputNewMatCost" name="inputNewMatCost"
                                        placeholder="0.00">
                                </div>
                                <div class="col-12">
                                    <button type="submit" name="matSubmit" class="btn btn-primary">Create</button>
                                </div>
                            </form>
                        </div>
                        <!-- All Projects Tab -->
                        <div class="tab-pane fade" id="v-pills-4" role="tabpanel" aria-labelledby="v-pills-4-tab"
                            tabindex="0">
                            <table class="table table-hover table-responsive">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Project Name</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($projectArrayAll as $key => $val) : ?>
                                    <tr onclick="document.location = `<?= 'project.php?ID=' . $val['Project_ID']; ?>`;">
                                        <th scope="row"><?= $val['Project_ID']; ?></th>
                                        <td><?= $val['Project_Name']; ?></td>
                                        <td><?= $val['Project_Description']; ?></td>
                                        <td><?= $val['Address'] . ' ' . $val['City'] . ', ' . $val['State'] . ' ' . $val['ZipCode']; ?>
                                        </td>
                                        <td>
                                            <button type="button" id="deleteProject" data-bs-target="#DeleteModal"
                                                title="Delete Project" data-bs-toggle="modal"
                                                class="btn btn-danger btn-small">
                                                <i class="fa-solid fa-trash "></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- Contractor List Tab -->
                        <div class="tab-pane fade" id="v-pills-5" role="tabpanel" aria-labelledby="v-pills-5-tab"
                            tabindex="0">
                            <table class="table table-hover table-responsive">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Contractor Name</th>
                                        <th scope="col">Contractor Description</th>
                                        <th scope="col">Edit</th>
                                        <th scope="col">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($contractorsArray as $key => $val) : ?>
                                    <tr>
                                        <th scope="row"><?= $val['Contractor_ID']; ?></th>
                                        <td><?= $val['Contractor_Name']; ?></td>
                                        <td><?= $val['Contractor_Description']; ?></td>
                                        <td>
                                            <button type="button" id="editContractor"
                                                data-bs-target="#EditContractorModal" title="Edit Contractor"
                                                data-bs-toggle="modal" class="btn btn-warning btn-small">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                        </td>
                                        <td>
                                            <button type="button" id="deleteContractor"
                                                data-bs-target="#DeleteContractorModal" title="Delete Contractor"
                                                data-bs-toggle="modal" class="btn btn-danger btn-small">
                                                <i class="fa-solid fa-trash "></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- Material List Tab -->
                        <div class="tab-pane fade" id="v-pills-6" role="tabpanel" aria-labelledby="v-pills-6-tab"
                            tabindex="0">
                            <table class="table table-hover table-responsive">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Material Name</th>
                                        <th scope="col">Material Description</th>
                                        <th scope="col">Cost</th>
                                        <th scope="col">Edit</th>
                                        <th scope="col">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($materialsArray as $key => $val) : ?>
                                    <tr>
                                        <th scope="row"><?= $val['Material_ID']; ?></th>
                                        <td><?= $val['Material_Name']; ?></td>
                                        <td><?= $val['Material_Description']; ?></td>
                                        <td><?= $val['Material_Cost']; ?></td>
                                        <td>
                                            <button type="button" id="editMat" data-bs-target="#EditMatModal"
                                                title="Edit Material" data-bs-toggle="modal"
                                                class="btn btn-warning btn-small">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                        </td>
                                        <td>
                                            <button type="button" id="deleteMat" data-bs-target="#DeleteMatModal"
                                                title="Delete Material" data-bs-toggle="modal"
                                                class="btn btn-danger btn-small">
                                                <i class="fa-solid fa-trash "></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="DeleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteModalLabel">Delete Project</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure?</br>Once this is done the project cannot be restored.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger">Submit</button>
                    <!-- <button type="button" class="btn btn-danger" onclick="foo()">Submit</button> -->
                </div>
            </div>
        </div>
    </div>
    <!-- Delete User Modal -->
    <div class="modal fade" id="DeleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteUserModalLabel">Delete User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure?</br>Once this is done the user cannot be restored.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger">Submit</button>
                    <!-- <button type="button" class="btn btn-danger" onclick="foo()">Submit</button> -->
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Contractor Modal -->
    <div class="modal fade" id="DeleteContractorModal" tabindex="-1" aria-labelledby="deleteContractorModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteContractorModalLabel">Delete Contractor</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure?</br>Once this is done the contractor cannot be restored.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger">Submit</button>
                    <!-- <button type="button" class="btn btn-danger" onclick="foo()">Submit</button> -->
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Material Modal -->
    <div class="modal fade" id="DeleteMatModal" tabindex="-1" aria-labelledby="deleteMatModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteMatModalLabel">Delete Material</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure?</br>Once this is done the material cannot be restored.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger">Submit</button>
                    <!-- <button type="button" class="btn btn-danger" onclick="foo()">Submit</button> -->
                </div>
            </div>
        </div>
    </div>
    <!-- Edit User Modal -->
    <div class="modal fade" id="EditUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editUserModalLabel">Edit User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Edit Form -->
                    <form class="row">
                        <div class="col-12" style="padding-bottom: 10px;">
                            <label for="inputEmail" class="form-label">Email Address:</label>
                            <input type="email" class="form-control" id="inputEmail" placeholder="Test@gmail.com"
                                disabled readonly>
                        </div>
                        <div class="row" style="padding-bottom: 10px;">
                            <div class="col-md-6">
                                <label for="inputFName" class="form-label">First Name:</label>
                                <input type="text" class="form-control" id="inputFName" placeholder="">
                            </div>
                            <div class="col-md-6">
                                <label for="inputLName" class="form-label">Last Name.:</label>
                                <input type="text" class="form-control" id="inputLName" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6" style="padding-bottom: 10px;">
                            <label for="inputGroup" class="form-label">Group:</label>
                            <select id="inputGroup" class="form-select" name="group">
                                <option selected="true">User</option>
                                <option>Admin</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Contractor Modal -->
    <div class="modal fade" id="EditContractorModal" tabindex="-1" aria-labelledby="editContractorModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editContractorModalLabel">Edit Contractor</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Edit Form -->
                    <form class="row">
                        <div class="col-12" style="padding-bottom: 10px;">
                            <label for="inputEdtContractor" class="form-label">Contractor Name:</label>
                            <input type="email" class="form-control" id="inputEdtContractor">
                        </div>
                        <div class="col-12" style="padding-bottom: 10px;">
                            <label for="inputEdtContractorDesc" class="form-label">Description:</label>
                            <textarea class="form-control" placeholder="Enter a description..."
                                id="inputEdtContractorDesc" style="height: 100px"></textarea>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Material Modal -->
    <div class="modal fade" id="EditMatModal" tabindex="-1" aria-labelledby="editMatModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editMatModalLabel">Edit Material</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Edit Form -->
                    <form class="row">
                        <div class="col-12" style="padding-bottom: 10px;">
                            <label for="inputEdtMat" class="form-label">Material Name:</label>
                            <input type="email" class="form-control" id="inputEdtMat">
                        </div>
                        <div class="col-12">
                            <label for="inputEdtMatDesc" class="form-label">Description:</label>
                            <textarea class="form-control" placeholder="Enter a description..." id="inputEdtMatDesc"
                                style="height: 100px"></textarea>
                        </div>
                        <div class="col-md-6" style="padding-bottom: 10px;">
                            <label for="inputEdtMatCost" class="form-label">Cost:</label>
                            <input type="text" class="form-control" id="inputEdtMatCost" placeholder="0.00">
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Create Project Modal -->
    <div class="modal fade" id="CreateProjModal" tabindex="-1" aria-labelledby="createProjModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createProjModalLabel">Create Project</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Add Form -->
                    <form class="row g-3">
                        <div class="col-12">
                            <label for="inputProject" class="form-label">Project Name:</label>
                            <input type="text" class="form-control" id="inputProject"
                                placeholder="Enter a new project name">
                        </div>
                        <div class="col-12">
                            <textarea class="form-control" placeholder="Enter a description..." id="floatingTextarea"
                                style="height: 100px"></textarea>
                        </div>
                        <div class="col-12">
                            <label for="inputAddress" class="form-label">Address</label>
                            <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                        </div>
                        <div class="col-md-6">
                            <label for="inputCity" class="form-label">City</label>
                            <input type="text" class="form-control" id="inputCity">
                        </div>
                        <div class="col-md-4">
                            <label for="inputState" class="form-label">State</label>
                            <select id="inputState" class="form-select" name="state">
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="inputZip" class="form-label">Zip</label>
                            <input type="text" class="form-control" id="inputZip">
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
    <script src="js/js.js"></script>
</body>

</html>