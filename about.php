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
    /* inside main */

main {
    padding: 20px;
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

#home h2 {
    text-align: center;
    color: #333;
}

#home p {
    color: #555;
    line-height: 1.6;
}

#home img {
    display: block;
    max-width: 100%;
    height: auto;
    margin: 20px auto;
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
                        <a class="nav-link" href="./index.php">Home</a>
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
        <div class="container">
            <div class="row">
                <div class="col-lg-6 ab1">
                    <div class="ab2">
                        <div class="ab3">
                            <div class="ab4">
                                <h1 class="text-center">Gingoog City Veterinary Appointment And Information System</h1>
                                <p class="text-center" style="text-align: justify;
    text-justify: inter-word;">Thank you for choosing the Gingoog City Veterinary Appointment and Information System. We're here to assist you with all your pet care needs. Whether you have questions about scheduling an appointment or need more information, please don't hesitate to reach out. We're devoted to providing the best care for your furry friends!</p>                            
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 info1">
                    <div class="info2">
                        <h2 class="text-center">About Us</h2>
                        <p class="text-center">The Gingoog City Veterinary Appointment and Information System is committed to enhancing the health and well-being of your pets through accessible and efficient veterinary services. Our dedicated team ensures compassionate care and professional service to every pet we treat.</p>
                        <p class="text-center">For more information or to schedule an appointment, contact us today!</p>
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
            </button>
        </div>
    </div>
    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>