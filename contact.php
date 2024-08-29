<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./partial/assets/style.css">
    <link rel="shortcut icon" href="./image/new1.png" type="image/x-icon">
    <title>Gingoog City Web-based Veterinary Appointment And Information System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- gogle icon link -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <!-- link icon w3schools -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            padding: 0;
            margin: 0;
            background-image: url('./image/citizine.png'); /* Update image path as necessary */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
#home {
    background-color: white;
    /* Optional: Add a background color to the section */
    border: 2px solid #043765;
    padding: 20px;
    margin: 20px;
    border-radius: 10px;
    /* Optional: Add rounded corners */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    /* Optional: Add a shadow for depth */
}
        /* 3 logos */

#logos {
    display: flex;
    justify-content: center;
    align-items: center;
    border: 2px solid #043765;
    padding: 20px;
    margin: 20px;
    border-radius: 10px;
    background-color: white;
    /* Optional: Add a background color */
}

#logos img {
    height: 100px;
    /* Adjust based on your image size */
    margin-right: 90px;
}
@media (max-width: 768px) {
    .modal-body .btn-primary {
        margin-left: 70%;
        margin-top: 1px;
    }
    .modal{
        margin-top: 20px;
    }
    #logos {
        width: 90%;
    }
    #logos img {
        height: 60px;
        /* Adjust based on your image size */
        margin-right: 10px;
    }
    .mb-3 i{
        margin-left: -13em;
    }
    
}
/* css form */
        /* General CSS Reset */


        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            max-width: 400px;
            margin: auto;
        }

        h4 {
            color: black;
            margin-bottom: 20px;
        }

        .mb-3 {
            margin-bottom: 15px;
        }

        .form-label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }

        i{
            margin-left: -18em;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .btn-primary {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="./image/new1.png" alt="Logo" style="width: 50px;">
                <span class="ms-2">GCVAIS</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href=" ./index.php ">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./service.php">Citizen Charter</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./about.php">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./contact.php">Contact Us</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Main Content -->
    <div class="container">
        <h1>Welcome to Gingoog City Veterinary Appointment And Information System</h1>
        <p>Your pet's health is our priority. Book an appointment, get information, and more!</p>

        <!-- Register and Login Buttons -->
        <div class="auth-buttons">
     <!-- main -->
<main>
        <section id="home">
        <div class="col-12">
        <div class="row my-5">
            <div class="col-md-5">
                <div class="card-body rounded-0">
                    <h1 class="text-center" style="    text-align: justify;
    text-justify: inter-word;">Gingoog City Veterinary Appointment And Information System</h1>
                    <p class="text-center">Thank you for choosing the Gingoog City Veterinary Appointment and Information System. We're here to assist you with all your pet care needs. Whether you have questions about scheduling an appointment or need more information, please don't hesitate to reach out. We're devoted to providing the best care for your furry friends!</p>
                </div>
            </div>
            <div class="col-md-7">
                <div>
                <form action="./php/sendEmail.php" method="post">
                    <h4>Get more Information?</h4>
                    <div class="mb-3">
                        <label for="name" class="form-label">
                            <i class="fa fa-user me-2"></i>Name
                        </label>
                        <input type="text" id="name" name="name" class="form-control" required placeholder="Ex. Jay Mols">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">
                            <i class="fa fa-envelope me-2"></i>Email
                        </label>
                        <input type="email" id="email" name="email" class="form-control" required placeholder="Ex. Veterenary@gmail.com">
                    </div>
                    <div class="mb-3">
                        <label for="contact" class="form-label">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <i class="fa fa-phone me-2"></i>Contact #
                        </label>
                        <input type="number" id="contact" name="contact" class="form-control" required placeholder="Ex. 09xxxxxxxxx">
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">
                        &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;<i class="fa fa-comment me-2"></i>Message
                        </label>
                        <textarea id="message" name="message" rows="4" class="form-control" required placeholder="Please leave us a message here, and we'll respond promptly. We look forward to hearing from you!"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send</button>
                </form>



                </div>
            </div>
        </div>
    </div>

        </section>
        <section id="logos">
            <img src="./image/logogc.png" alt="Logo 1">
            <img src="./image/new1.png" alt="Logo 2">
            <img src="./image/egclogo.png" alt="Logo 3">
        </section>
</main>
        </div>
    </div>
    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>