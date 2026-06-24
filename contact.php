<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Kenia" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<style>
    html,
    body {
        position: relative;
        height: 100%;
        background-color: bisque;

    }
     .icon {
        font-size: 16px;
        align-items: center;
        border: 2px solid green;
        border-radius: 50%;
        padding: 1%;
        color: green;
    }
    
    .navbar .nav-link {
        color: rgb(4, 72, 4);
        font-weight: bold;
        text-decoration: underline;
        text-decoration-color: rgb(4, 72, 4);

    }
    .navbar-brand
    {
        color: green;
    }
    .custom-p {
        line-height: 50px;
        font-family: 'kenia', cursive;

    }

    .text-start {
        text-align: center !important;
    }

    .navbar .nav-link:hover {
        color: green;

    }

    .navbar {
        background-color: bisque;
    }

    input {
        width: 500px;
    }
    .my-5{
        margin-top: 5rem;
    }
    .form-control:focus
    {
        border: 2px solid green;
        box-shadow: 0 0 5px green;
    }
    .container{
        border-color: green;
        border-style: dotted;
        border-width: 5px;
        border-radius: 10px;
    }
    .send{
        border: 2px solid green;
        border-radius: 5px;
        width: 50%;
        margin-left: 25%;
    }
</style>

<body>
    <nav class="navbar navbar-expand-lg bg-bisque fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" style="font-family: lobster;"><u>Feathers</u>.</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item mx-5">
                        <a class="nav-link active" aria-current="page" href="home.php">Home</a>
                    </li>

                    <li class="nav-item dropdown mx-5">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Shop
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="brain.php?type=formal">Formal wear</a></li>
                            <li><a class="dropdown-item" href="brain.php?type=casual">Casual wear</a></li>
                            <li><a class="dropdown-item" href="brain.php?type=traditional">Traditional wear</a></li>
                        </ul>
                    </li>
                    <li class="nav-item mx-5">
                        <a class="nav-link" href="contact.php">Contact Us</a>
                    </li>

                </ul>
                <form class="d-flex w-50" action="brain.php" method="GET" role="search">
                    <input name="search" class="form-control me-2" type="search" placeholder="Search" aria-label="Search"
                    value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                    <button class="btn btn-outline-success " type="submit"><a href="cart.php" style="color: white; text-decoration: none;">Cart</a></button>
                </form>
            </div>
        </div>
    </nav>
    <!-- contact us page -->
    <h1 class="text-start mt-5 mb-4">Contact Us</h1>
    <div class="container my-5 p-5">
        <form class="row g-3">
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Email</label>
                <input type="email" class="form-control" id="inputEmail4">
            </div>
            <div class="col-6">
                <label for="inputAddress" class="form-label">Address</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
            </div>
            <div class="col-6">
                <label for="inputAddress2" class="form-label">Address 2</label>
                <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
            </div>
            <div class="col-md-6">
                <label for="inputCity" class="form-label">City</label>
                <input type="text" class="form-control" id="inputCity">
            </div>
            <div class="col-12">
                <label for="messageText" class="form-label">Message</label>
                <textarea id="messageText" class="form-control" style="height:100px;" placeholder="Write your opinion"></textarea>
            </div>
            <div class="d-flex flex-wrap gap-3">
                <a class="icon" href="https://www.instagram.com/alone_prodipta/"><i class="fa fa-instagram"></i></a>
                <a class="icon" href="mailto:nayebprodipta@gmail.com"><i class="bi bi-envelope-fill"></i></a>
                <a class="icon" href="https://tinyurl.com/Prodipta-chat"><i class="bi bi-whatsapp"></i></a>
            </div>
            <button class="bg-success text-white py-2 px-4 send" type="submit">Send</button>
        </form>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js"></script>
</body>

</html>