<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DBU clinic</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/svg+xml" href="../Clinic_MS/include/a/assetscare2.jpeg " />
    <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
</head>
<body>
    <?php
        include("include/header.php");
        include("include/connection.php");

        // Fetch doctors from the database
        $stmt = $conn->prepare("SELECT uname, email, phonenumber FROM doctors WHERE status = 'approved'");
        $stmt->execute();
        $result = $stmt->get_result();
        $doctors = $result->fetch_all(MYSQLI_ASSOC);

         // Fetch pharmacists from the database
         $stmt = $conn->prepare("SELECT fullname, email, phonenumber FROM pharmacist WHERE status = 'approved'");
         $stmt->execute();
         $result = $stmt->get_result();
         $pharmacy = $result->fetch_all(MYSQLI_ASSOC);

        // Fetch admin phone numbers from the database
        $stmt = $conn->prepare("SELECT phonenumber FROM admin");
        $stmt->execute();
        $result = $stmt->get_result();
        $admin_phone_numbers = $result->fetch_all(MYSQLI_ASSOC);

        // Fetch admin emails from the database
        $stmt = $conn->prepare("SELECT email FROM admin");
        $stmt->execute();
        $result = $stmt->get_result();
        $admin_emails = $result->fetch_all(MYSQLI_ASSOC);
    ?>

<section class="about" id="about" style="background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(75,14,154,1) 35%, rgba(0,212,255,1) 100%);">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <img src="include/a/assets/stillalive.jpeg" class="w-100 mb-5 mb-md-0" alt="About Us">
                </div>
                <div class="col-md-6">
                    <span style="font-size: 15px;">About Us</span>
                    <h3 style="font-size: 25px;">True Healthcare For our Students</h3>
                    <p style="font-size: 15px;font-family:'Times New Roman', Times, serif">Our university offers a comprehensive range of healthcare services, including surgeries, imaging, laboratory tests, rehabilitation, and preventive care, addressing diverse medical needs. Hospitals operate round the clock, providing continuous medical care and emergency services, offering support and treatment whenever needed.</p>
                    <a href="sign-inp.php" class="link-btn">Make appointment</a>
                </div>
            </div>
        </div>
    </section>

    <section class="doctors" id="doctors">
        <h1 class="heading">University clinic's Doctors</h1>
        <div class="box-container container">
            <?php foreach ($doctors as $doctor): ?>
                <div class="box" style="background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(75,14,154,1) 35%, rgba(0,212,255,1) 100%);">
                    DR. <h3 style="color: #000;"><?= htmlspecialchars($doctor['uname']) ?></h3>
                    <p class="doctorsp" style="color: #fff;"><?= htmlspecialchars($doctor['email']) ?><br><?= htmlspecialchars($doctor['phonenumber']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="services" id="services" style="background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(75,14,154,1) 35%, rgba(0,212,255,1) 100%);">
        <h1 class="heading">University clinic's Services</h1>
        <div class="box-container container">
            <div class="box">
                <i class="fa-solid fa-stethoscope fa-2xl servicesicon"></i>
                <h3>Anesthesiologists</h3>
                <p>These doctors give you drugs to numb your pain or to put you under during surgery, childbirth, or other procedures. They monitor your vital signs while you’re under anesthesia.</p>
            </div>
            <div class="box">
                <i class="fa-solid fa-microscope fa-2xl servicesicon"></i>
                <h3>Cardiologists</h3>
                <p>They’re experts on the heart and blood vessels. You might see them for heart failure, a heart attack, high blood pressure, or an irregular heartbeat.</p>
            </div>
            <div class="box">
                <i class="fa-solid fa-capsules fa-2xl servicesicon"></i>
                <h3>Emergency Medicine Specialists</h3>
                <p>These doctors make life-or-death decisions for sick and injured people, usually in an emergency room. Their job is to save lives and to avoid or lower the chances of disability.</p>
            </div>
            <div class="box">
                <i class="fa-solid fa-lungs fa-2xl servicesicon"></i>
                <h3>Neurologists</h3>
                <p>These are specialists in the nervous system, which includes the brain, spinal cord, and nerves. They treat strokes, brain and spinal tumors, epilepsy, Parkinson's disease, and Alzheimer's disease.</p>
            </div>
            <div class="box">
                <i class="fa-solid fa-kit-medical fa-2xl servicesicon"></i>
                <h3>student's Physician</h3>
                <p>Family practice physicians are primary care providers who see patients of all ages and provide basic care for a variety of common ailments.</p>
            </div>
            <div class="box">
                <i class="fa-solid fa-syringe fa-2xl servicesicon"></i>
                <h3>Orthopedist</h3>
                <p>An orthopedist or orthopedic surgeon is a doctor who specializes in conditions of the musculoskeletal system, including the bones, muscles, joints, and connective tissues.</p>
            </div>
        </div>
    </section>

    <section class="doctors" id="doctors">
        <h1 class="heading">University clinic's pharmacists</h1>
        <div class="box-container container">
            <?php foreach ($pharmacy as $pharmacy): ?>
                <div class="box" style="background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(75,14,154,1) 35%, rgba(0,212,255,1) 100%);">
                    PHARMACIST <h3 style="color: #000;"><?= htmlspecialchars($pharmacy['fullname']) ?></h3>
                    <p class="doctorsp" style="color: #fff;"><?= htmlspecialchars($pharmacy['email']) ?><br><?= htmlspecialchars($pharmacy['phonenumber']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="contact" id="contact" style="background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(75,14,154,1) 35%, rgba(0,212,255,1) 100%);">
        <h1 class="heading">Contact Us</h1>
        <form>
            <label for="name">Your Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter your name" class="box" required>

            <label for="email">Your Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" class="box" required>

            <label for="contact">Your Number:</label>
            <input type="tel" id="contact" name="contact" placeholder="Enter your number" class="box" required>

            <label for="message">Your Message:</label>
            <textarea id="message" name="message" placeholder="Enter your message"></textarea>

            <a href="sign-inp.php"><input type="submit" value="Submit" class="link-btn"></a>
        </form>
    </section>
    <section class="home" id="home">
        <div class="container">
            <div class="row min-vh-100 align-items-center">
                <div class="content text-center text-md-left" style="width:75% ;">
                    <img src="include/a/assets/care2.jpeg" class="w-100 mb-5 mb-md-0" alt="Care">
                </div>

            </div>
        </div>

    </section>

    <footer class="footer" style="background: linear-gradient(90deg, rgba(30,50,36,10) 0%, rgba(75,14,154,1) 35%, rgba(0,212,255,1) 100%);">
        <div class="box-container container">
            <div class="box">
                <i class="fas fa-phone" style="color: aqua;"></i>
                <h3 style="color: aqua;">Phone Number</h3>
                <?php foreach ($admin_phone_numbers as $phone): ?>
                    <p style="color: #000;"><?= htmlspecialchars($phone['phonenumber']) ?></p>
                <?php endforeach; ?>
            </div>
            <div class="box">
                <i class="fas fa-map-marker-alt" style="color: aqua;"></i>
                <h3 style="color: aqua;">Our Address</h3>
                <p style="color: #000;">Debire brehan, Ethiopia</p>
            </div>
            <div class="box">
                <i class="fas fa-clock" style="color: aqua;"></i>
                <h3 style="color: aqua;">Opening Hours</h3>
                <p style="color: #000;">24 hour open</p>
            </div>
            <div class="box">
                <i class="fas fa-envelope" style="color: aqua;"></i>
                <h3 style="color: aqua;">Email Address</h3>
                <?php foreach ($admin_emails as $email): ?>
                    <p style="color: #000;"><?= htmlspecialchars($email['email']) ?></p>
                <?php endforeach; ?>
            </div>
        </div>
        
        <div class="credit">
            <span style="color:rgb(66, 0, 0);">We try our best to keep our student's health</span><br>
            <span id="team" style="color: #626A06;">©2024Debire berhan university</span>
        </div>
    </footer>
</body>
</html>