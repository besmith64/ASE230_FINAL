<?php
// Load all of the php scripts
require_once('settings/settings.php');
require_once('classes/c_project.php');

if (!count($_SESSION) > 0 && !is_numeric($_SESSION['ID'])) {
    header('location: index.php');
    die();
}

$logged = 0;
// print_r($_COOKIE['user']);
if (count($_SESSION) > 0 && is_numeric($_SESSION['ID'])) {
    $logged = 1;
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
                        <div class="col-2">
                            <p class="text-left"><strong>Project Name:</strong></p>
                        </div>
                        <div class="col-10">
                            <p class="text-left">Test Project 1</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2">
                            <p class="text-left"><strong>Description:</strong></p>
                        </div>
                        <div class="col-10">
                            <p class="text-left">Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi
                                aliquam sunt, sapiente exercitationem nemo tempore rem. Perferendis soluta fuga
                                veritatis.</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2">
                            <p class="text-left"><strong>Project Manager:</strong></p>
                        </div>
                        <div class="col-10">
                            <p class="text-left">Benjamin Smith</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2">
                            <p class="text-left"><strong>Address:</strong></p>
                        </div>
                        <div class="col-10">
                            <address class="text-left">
                                123 Main St.</br>
                                Cincinnati, OH 45248
                            </address>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="v-pills-2" role="tabpanel" aria-labelledby="v-pills-2-tab" tabindex="0">
                    <table class="table table-hover table-responsive">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Material Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Cost</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Paid Amount</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Pipe 1</td>
                                <td>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Veniam, cupiditate.</td>
                                <td>$1500.00</td>
                                <td>12</td>
                                <td>$15000.00</td>
                                <td>
                                    <button type="button" id="editProject" data-bs-target="#EditModal"
                                        title="Edit Project" data-bs-toggle="modal" class="btn btn-warning btn-small">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                </td>
                                <td>
                                    <button type="button" id="deleteProject" data-bs-target="#DeleteModal"
                                        title="Delete Project" data-bs-toggle="modal" class="btn btn-danger btn-small">
                                        <i class="fa-solid fa-trash "></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Pipe 2</td>
                                <td>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Veniam, cupiditate.</td>
                                <td>$2000.00</td>
                                <td>3</td>
                                <td>$6000.00</td>
                                <td>
                                    <button type="button" id="editProject" data-bs-target="#EditModal"
                                        title="Edit Project" data-bs-toggle="modal" class="btn btn-warning btn-small">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                </td>
                                <td>
                                    <button type="button" id="deleteProject" data-bs-target="#DeleteModal"
                                        title="Delete Project" data-bs-toggle="modal" class="btn btn-danger btn-small">
                                        <i class="fa-solid fa-trash "></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Pipe 3</td>
                                <td>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Veniam, cupiditate.</td>
                                <td>$100.00</td>
                                <td>15</td>
                                <td>$1500.00</td>
                                <td>
                                    <button type="button" id="editProject" data-bs-target="#EditModal"
                                        title="Edit Project" data-bs-toggle="modal" class="btn btn-warning btn-small">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                </td>
                                <td>
                                    <button type="button" id="deleteProject" data-bs-target="#DeleteModal"
                                        title="Delete Project" data-bs-toggle="modal" class="btn btn-danger btn-small">
                                        <i class="fa-solid fa-trash "></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade " id="v-pills-3" role="tabpanel" aria-labelledby="v-pills-3-tab" tabindex="0">
                    <h4>Add Project Materials</h4>
                    <form class="row">
                        <div class="col-md text-center">
                            <div class="form-floating" style="padding-bottom: 10px;">
                                <select class="form-select" id="matSelect">
                                    <option selected="true" disabled>Choose Material...</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                                <label for="matSelect">Material:</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <label for="inputQty" class="form-label">Quantity:</label>
                                <input id="inputQty" type="text" class="form-control" placeholder="0.00"
                                    aria-label="Quantity" style="width: 250px;">
                            </div>
                            <div class="col-4">
                                <label for="inputProjectCost" class="form-label">Project Cost:</label>
                                <input id="inputProjectCost" type="text" class="form-control" placeholder="0.00"
                                    aria-label="projCost" style="width: 250px;">
                            </div>
                        </div>
                        <div class="col-12" style="padding-top: 10px;">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
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
    <script src="js/js.js"></script>
</body>

</html>