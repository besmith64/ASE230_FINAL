<?php
// Load all of the php scripts
require_once('settings/settings.php');
require_once('classes/c_project.php');
require_once('classes/c_contractors.php');
require_once('classes/c_materials.php');
require_once('classes/c_user.php');

if (!count($_SESSION) > 0 && !is_numeric($_SESSION['ID'])) {
    header('location: index.php');
    die();
}

$logged = 0;

if (count($_SESSION) > 0 && is_numeric($_SESSION['ID'])) {
    $logged = 1;

    // Load Classes
    $project = new Project();
    $contractors = new Contractor();
    $materials = new Materials();
    $user = new User();

    // Get Data
    $projectArray = $project->get_project($connection, $_GET['ID']);
    $projectMaterialsArray = $project->get_proj_materials($connection, $_GET['ID']);
    $get_user = $user->get_users_by_id($connection, $projectArray['Created_By']);
    $get_contractor = $contractors->get_contractor_by_id($connection, $projectArray['Contractor_ID']);
    $materialsArray = $materials->get_materials($connection);
}
// Add project material
if (isset($_POST['submitProjMat'])) {
    try {
        $values = array(
            $_GET['ID'],
            $_POST['matSelect'],
            $_POST['inputProjectQty'],
            $_POST['inputProjectCost']
        );
        $project->create_proj_material($connection, $values);
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
}

?>

<!DOCTYPE html>
<html style="font-size: 14px" lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="utf-8" />
    <title>Mr. Fixit! Project Details</title>
    <link rel="icon" type="image/x-icon" href="settings/favicon.ico" />
    <link rel="stylesheet" href="css/nicepage.css" media="screen" />
    <link rel="stylesheet" href="css/login.css" media="screen" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/057979aec3.js" crossorigin="anonymous"></script>
    <script class="u-script" type="text/javascript" src="js/jquery.js" defer=""></script>
    <script class="u-script" type="text/javascript" src="js/nicepage.js" defer=""></script>
    <meta name="generator" content="Nicepage 4.19.3, nicepage.com" />
    <link id="u-theme-google-font" rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i" />

    <meta name="theme-color" content="#478ac9" />
    <meta property="og:title" content="Sign Up" />
    <meta property="og:type" content="website" />
</head>

<body class="u-body u-xl-mode" data-lang="en" style="
      background-image: url('settings/background.jpg');
      background-size: cover;
    ">
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
    <div class="container rounded-3 shadow" style="
        padding-top: 50px;
        padding-bottom: 10px;
        background-color: rgb(208, 220, 251);
      ">
        <div class="d-flex align-items-start" style="padding-top: 30px;padding-bottom: 10px;">
            <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <button class="nav-link active" id="v-pills-1-tab" data-bs-toggle="pill" data-bs-target="#v-pills-1"
                    type="button" role="tab" aria-controls="v-pills-1" aria-selected="true">Overview</button>
                <button class="nav-link" id="v-pills-2-tab" data-bs-toggle="pill" data-bs-target="#v-pills-2"
                    type="button" role="tab" aria-controls="v-pills-2" aria-selected="false">Project Finances</button>
                <button class="nav-link" id="v-pills-3-tab" data-bs-toggle="pill" data-bs-target="#v-pills-3"
                    type="button" role="tab" aria-controls="v-pills-3" aria-selected="false">Add Project
                    Materials</button>
            </div>
            <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel" aria-labelledby="v-pills-1-tab"
                    tabindex="0">
                    <!-- Project Information -->
                    <h4>Project Details</h4>
                    <div class="row">
                        <div class="col-4">
                            <p class="text-left"><strong>Project Name:</strong></p>
                        </div>
                        <div class="col-8">
                            <p class="text-left"><?= $projectArray['Project_Name'] ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <p class="text-left"><strong>Description:</strong></p>
                        </div>
                        <div class="col-8">
                            <p class="text-left"><?= $projectArray['Project_Description'] ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <p class="text-left"><strong>Project Manager:</strong></p>
                        </div>
                        <div class="col-8">
                            <p class="text-left"><?= $get_user['firstname'] . ' ' . $get_user['lastname'] ?></p>
                        </div>
                    </div>
                    <!-- Contractor Information -->
                    <div class="row">
                        <div class="col-4">
                            <p class="text-left"><strong>Contractor:</strong></p>
                        </div>
                        <div class="col-8">
                            <p class="text-left"><?= $get_contractor['Contractor_Name'] ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <p class="text-left"><strong>Project Location:</strong></p>
                        </div>
                        <div class="col-8">
                            <address class="text-left">
                                <?= $projectArray['Address'] . '</br>' .
                                    $projectArray['City'] . ', ' .
                                    $projectArray['State'] . ' ' .
                                    $projectArray['ZipCode'] ?>
                            </address>
                        </div>
                    </div>
                </div>
                <!-- Project Financials -->
                <div class="tab-pane fade" id="v-pills-2" role="tabpanel" aria-labelledby="v-pills-2-tab" tabindex="0">
                    <table class="table table-hover table-responsive">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Material Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Material Cost</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Project Cost</th>
                                <th scope="col">Quantity Used</th>
                                <th scope="col">Paid Amount</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($projectMaterialsArray as $key => $val) : ?>
                            <tr>
                                <th scope="row"><?= $val['PMID'] ?></th>
                                <td><?= Materials::get_materials_by_ID($connection, $val['Material_ID'])['Material_Name'] ?>
                                </td>
                                <td><?= Materials::get_materials_by_ID($connection, $val['Material_ID'])['Material_Description'] ?>
                                </td>
                                <td><?= '$' . Materials::get_materials_by_ID($connection, $val['Material_ID'])['Material_Cost'] ?>
                                </td>
                                <td><?= $val['Quantity'] ?></td>
                                <td><?= '$' . $val['Project_Cost'] ?></td>
                                <td><?= $val['Quantity_Used'] ?></td>
                                <td><?= '$' . $val['Paid_Amount'] ?>
                                </td>
                                <td>
                                    <button type="button" id="editProject" data-bs-target="#EditModal"
                                        title="Edit Project" data-bs-toggle="modal" class="btn btn-warning btn-small">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                </td>
                                <td>
                                    <button type="button" data-bs-target="#DeletePMIDModal" title="Delete Project"
                                        data-bs-toggle="modal" data-bs-whatever="<?= $_GET['ID']; ?>"
                                        data-bs-whatever-2="<?= $val['PMID']; ?>" class="btn btn-danger btn-small">
                                        <i class="fa-solid fa-trash "></i>
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!-- Add Project Materials Form -->
                <div class="tab-pane fade " id="v-pills-3" role="tabpanel" aria-labelledby="v-pills-3-tab" tabindex="0">
                    <h4>Add Project Materials</h4>
                    <form class="row" method="POST">
                        <div class="col-md text-center">
                            <div class="form-floating" style="padding-bottom: 10px;">
                                <select class="form-select" id="matSelect" name="matSelect">
                                    <option selected="true" disabled>Choose Material...</option>
                                    <?php foreach ($materialsArray as $key => $val) : ?>
                                    <option value="<?= $val['Material_ID'] ?>"><?= $val['Material_Name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <label for="matSelect">Material:</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <label for="inputQty" class="form-label">Quantity:</label>
                                <input id="inputProjectQty" name="inputProjectQty" type="text" class="form-control"
                                    placeholder="0.00" aria-label="Quantity" style="width: 250px;">
                            </div>
                            <div class="col-4">
                                <label for="inputProjectCost" class="form-label">Project Cost:</label>
                                <input id="inputProjectCost" name="inputProjectCost" type="text" class="form-control"
                                    placeholder="0.00" aria-label="projCost" style="width: 250px;">
                            </div>
                        </div>
                        <div class="col-12" style="padding-top: 10px;">
                            <button name="submitProjMat" type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Modal -->
    <div class="modal fade" id="DeletePMIDModal" tabindex="-1" aria-labelledby="deletePMIDModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deletePMIDModalLabel">Delete Project material</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure?</br>Once this is done the material cannot be restored.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" name="deletePMIDModalSubmit">Submit</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Modal -->
    <div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="editMatModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editMatModalLabel">Edit Material</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Add Form -->
                    <form class="row">
                        <div class="col-12" style="padding-bottom: 10px;">
                            <label for="inputMaterial" class="form-label">Material Name:</label>
                            <input type="text" class="form-control" id="inputMaterial" placeholder="Test" disabled
                                readonly>
                        </div>
                        <div class="row" style="padding-bottom: 10px;">
                            <div class="col-md-6">
                                <label for="inputMatCost" class="form-label">Cost:</label>
                                <input type="text" class="form-control" id="inputMatCost" placeholder="0.00">
                            </div>
                            <div class="col-md-2">
                                <label for="inputMatQty" class="form-label">Qty.:</label>
                                <input type="text" class="form-control" id="inputMatQty" placeholder="0.00">
                            </div>
                            <div class="col-md-4">
                                <label for="inputMatPaid" class="form-label">Paid Amount:</label>
                                <input type="text" class="form-control" id="inputMatPaid" placeholder="0.00">
                            </div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
    <script src="js/proj_js.js"></script>
</body>

</html>