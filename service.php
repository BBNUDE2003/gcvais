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
        /* Custom CSS for dropdown */
        .dropdown-content {
            display: none;
            padding: 10px; /* Adjust padding as needed */
            background-color: #f9f9f9; /* Background color of dropdown content */
            border: 1px solid #ddd; /* Border */
            margin-top: 10px; /* Margin to separate from title */
        }

        .dropdown-item h4 {
            color: black;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
        }

        .fa-chevron-down {
            margin-left: 95%;
            color: #777;
            transition: transform 0.3s ease;
        }

        .fa-chevron-down.rotate {
            transform: rotate(180deg);
        }
        
        #chat_box {
            position: relative;
        }
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
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-10px);
            }
            60% {
                transform: translateY(-5px);
            }
        }
        
         /* Flex and Style for Images inside Dropdown Content */
         .dropdown-content img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 10px 0;
        }

        /* responsive */
        @media (max-width: 768px) {
    .dropdown-content {
        padding: 5px;
        background-color: #f9f9f9;
        border: 1px solid #ddd;
        margin-top: 5px;
    }

    .dropdown-item h4 {
        font-size: 16px;
    }

    .fa-chevron-down {
        margin-left: 5px;
        font-size: 14px;
    }

    .dropdown-content img {
        width: 100%;
        height: auto;
        margin: 5px 0;
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
                        <a class="nav-link" href="./php/index.php">Home</a>
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

        <!-- service -->
        <div class="auth-buttons">
    <main>
        <section id="home">
        <h4 class="card-title" style="color: black;">Citizen's Charter</h4>
        <hr>
        <!-- First dropdown item -->
        <div class="dropdown-item">
            <h4>⚫ Animal Dispersal Application</h4>
            <i class="fa fa-chevron-down" onclick="toggleDropdown(this)"></i>
            <div class="dropdown-content">
                <p>Breeder animals are provided to interested animal raisers, subject to the availability of stock, which are payable as follows:<br>one offspring for every cattle, carabao. For goat and sheep - two female and 1 male for every packet, composed of 1 male 1 female.<br>; two female piglets for every pig and 2 offspring for every chicken dispersed pursuant to City Ordinance 2022-393.</p>
                <img src="./image/animal disperal 1.png" alt="">
                <img src="./image/animal disperal 2.png" alt="">
                <img src="./image/animal disperal 3.png" alt="">
            </div>
        </div>

        <!-- Second dropdown item -->
        <div class="dropdown-item">
            <h4>⚫ Artificial Insemination Service</h4>
            <i class="fa fa-chevron-down" onclick="toggleDropdown(this)"></i>
            <div class="dropdown-content">
                <p>This is a breeding service for cattle and carabao using semen of high quality bulls and carabulls produced by the National Artificial Breeding Center</p>
                <img src="./image/arte1.png" alt="">
            </div>
        </div>

        <!-- 3rd dropdown item -->
        <div class="dropdown-item">
            <h4>⚫Artificial Insemination Service (Hog)</h4>
            <i class="fa fa-chevron-down" onclick="toggleDropdown(this)"></i>
            <div class="dropdown-content">
                <p>This is a breeding service for pigs using semen from high quality boar. Pursuant to City Ordinance 2022-393 the client shall return to the city 1 female piglet for every<br>succesful insemination.</p>
                <img src="./image/1.3.png" alt="">
            </div>
        </div>
        <!-- 4 dropdown item -->
        <div class="dropdown-item">
            <h4>⚫Technical Assistance</h4>
            <i class="fa fa-chevron-down" onclick="toggleDropdown(this)"></i>
            <div class="dropdown-content">
                <p>Technical assistance service may be in the form of seminar on animal production, animal health and public health.</p>
                <img src="./image/1.4.png" alt="">
            </div>
        </div>
        <!-- 5 dropdown item -->
        <div class="dropdown-item">
            <h4>⚫Technical Assistance: One-On-One Coaching</h4>
            <i class="fa fa-chevron-down" onclick="toggleDropdown(this)"></i>
            <div class="dropdown-content">
                <p>One-on-one coaching conducted by technicians for farmers with technical concerns.</p>
                <img src="./image/1.5.png" alt="">
            </div>
        </div>
        <!-- 6 dropdown item -->
        <div class="dropdown-item">
            <h4>⚫Castration of Animals</h4>
            <i class="fa fa-chevron-down" onclick="toggleDropdown(this)"></i>
            <div class="dropdown-content">
                <p>Performed by technicians on male animals to prevent expression of breeding behavior. This will prevent the development of unpleasant odor in pork.<br>It will also make dogs less aggressive.</p>
                <img src="./image/cast1.png" alt="">
                <img src="./image/cast2.png" alt="">
            </div>
        </div>
        <!-- 7 dropdown item -->
        <div class="dropdown-item">
            <h4>⚫Consultation Service</h4>
            <i class="fa fa-chevron-down" onclick="toggleDropdown(this)"></i>
            <div class="dropdown-content">
                <p>This service is provided by veterinarians to determine the veterinary services needed by clients to restore, maintain or attain the optimum health<br>and productivity of animals beings raised.</p>
                <img src="./image/1.7.png" alt="">
            </div>
        </div>
        <!-- 8 dropdown item -->
        <div class="dropdown-item">
            <h4>⚫Deworming/ Treatment/ Vaccination ( Home Service)</h4>
            <i class="fa fa-chevron-down" onclick="toggleDropdown(this)"></i>
            <div class="dropdown-content">
                <p>This service is provided to prevent animal diseases. Services are provided by the Office of the City Veterinarian like vaccination against specific diseases<br>and provision of vitamin-mineral supplementation. Deworming of animal is also done to control internal parasites. This service also includes treatment of sick animals.<br>In this variant, services are delivered to the home of client.</p>
                <img src="./image/dewo1.png" alt="">
                <img src="./image/dewo2.png" alt="">
            </div>
        </div>
        <!-- 9 dropdown item -->
        <div class="dropdown-item">
            <h4>⚫Deworming/ Treatment/ Vaccination ( Walk-in)</h4>
            <i class="fa fa-chevron-down" onclick="toggleDropdown(this)"></i>
            <div class="dropdown-content">
                <p>This service is provided to prevent animal diseases. Services are provided by the Office of the City Veterinarian like vaccination against specific diseases<br>and provision of vitamin-mineral supplementation. Deworming of animal is also done to control internal parasites. This service also includes treatment of sick animals. </p>
                <img src="./image/1.9dewo1.png" alt="">
                <img src="./image/1.9dewo2.png" alt="">
            </div>
        </div>
        <!-- 10 dropdown item -->
        <div class="dropdown-item">
            <h4>⚫Examination of Laboratory Samples</h4>
            <i class="fa fa-chevron-down" onclick="toggleDropdown(this)"></i>
            <div class="dropdown-content">
                <p>A service for animal raisers to determine the presence of internal parasites in their animals. The result of which is the basis in determining the additional<br>veterinary services needed by the client.</p>
                <img src="./image/1.10.png" alt="">
            </div>
        </div>
        <!-- 11 dropdown item -->
        <div class="dropdown-item">
            <h4>⚫Issuance of Rabies Vaccination Certificate</h4>
            <i class="fa fa-chevron-down" onclick="toggleDropdown(this)"></i>
            <div class="dropdown-content">
                <p>A Rabies Vaccination Certificate is issued to clients to ascertain the status of rabies vaccination of their dogs and cats. The document is required for<br>the issuance of Animal Transport Permit by the Veterinary Quarantine Service and as a supporting document for financial assistance for animal bite victims.</p>
                <img src="./image/1.11.png" alt="">
            </div>
        </div>
        <!-- 12 dropdown item -->
        <div class="dropdown-item">
            <h4>⚫Issuance of Veterinary Health Certificate</h4>
            <i class="fa fa-chevron-down" onclick="toggleDropdown(this)"></i>
            <div class="dropdown-content">
                <p>A Veterinary Health Certificate is issued to clients who intend to transport healthy animals from Gingoog City to other locations.<br>The document is a prerequisite for the issuance of an Animal Transport Permit by the Veterinary Quarantine Service.</p>
                <img src="./image/1.12.png" alt="">
                <img src="./image/1.12.2.png" alt="">
            </div>
        </div>
        <!-- 13 dropdown item -->
        <div class="dropdown-item">
            <h4>⚫Redemption of Impounded Animals</h4>
            <i class="fa fa-chevron-down" onclick="toggleDropdown(this)"></i>
            <div class="dropdown-content">
                <p>Owners whose dogs are caught in public places and impounded at the City Pound may redeem the animals after payment of corresponding penalty.</p>
                <img src="./image/1.13.1.png" alt="">
                <img src="./image/1.13.2.png" alt="">
            </div>
        </div>
        <!-- 14 dropdown item -->
        <div class="dropdown-item">
            <h4>⚫Technical and Pesticide Assistance for Fly Control</h4>
            <i class="fa fa-chevron-down" onclick="toggleDropdown(this)"></i>
            <div class="dropdown-content">
                <p>Poultry raisers may avail of the pesticide assistance provided by the local government of to help them in the control of flies.</p>
                <img src="./image/1.14.png" alt="">
            </div>
        </div>
        <!-- 15 dropdown item -->
        <div class="dropdown-item">
            <h4>⚫Vaccination of Dogs (Home Service)</h4>
            <i class="fa fa-chevron-down" onclick="toggleDropdown(this)"></i>
            <div class="dropdown-content">
                <p>Vaccination is provided for dogs to protect them against rabies infection. In this variant, service is performed in the home of the client.</p>
                <img src="./image/1.15.1.png" alt="">
                <img src="./image/1.15.2.png" alt="">
            </div>
        </div>
        <!-- 16 dropdown item -->
        <div class="dropdown-item">
            <h4>⚫Vaccination of Dogs (Walk-in)</h4>
            <i class="fa fa-chevron-down" onclick="toggleDropdown(this)"></i>
            <div class="dropdown-content">
                <p>Vaccination is provided for dogs to protect them against rabies infection.</p>
                <img src="./image/1.16.1.png" alt="">
                <img src="./image/1.16.2.png" alt="">
            </div>
        </div>
        <!-- 17 dropdown item -->
        <div class="dropdown-item">
            <h4>⚫Voluntary Surrender of Dog</h4>
            <i class="fa fa-chevron-down" onclick="toggleDropdown(this)"></i>
            <div class="dropdown-content">
                <p>Dogs which are sick and could not be treated anymore, very old or very vicious and is already a threat to public safety can be surrendered to<br>the City Veterinary Office. </p>
                <img src="./image/1.17.png" alt="">
            </div>
        </div>
        <!-- 18 dropdown item -->
        <div class="dropdown-item">
            <h4>⚫Voluntary Impounding of Dog</h4>
            <i class="fa fa-chevron-down" onclick="toggleDropdown(this)"></i>
            <div class="dropdown-content">
                <p>Owners of dog which bit human beings mey be temporarily impounded at the City Pound for a 14-day observation period. </p>
                <img src="./image/1.18.png" alt="">
            </div>
        </div>
        </div>
    </div>
</section>
</main>
    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FontAwesome for the chevron icon -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    
    <!-- Script to handle dropdown toggling -->
    <script>
        function toggleDropdown(element) {
            const dropdownContent = element.nextElementSibling;
            if (dropdownContent.style.display === "none" || dropdownContent.style.display === "") {
                dropdownContent.style.display = "block";
                element.querySelector('.fa-chevron-down').classList.add('rotate');
            } else {
                dropdownContent.style.display = "none";
                element.querySelector('.fa-chevron-down').classList.remove('rotate');
            }
        }
    </script>
</body>
</html>