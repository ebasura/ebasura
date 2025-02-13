<?php

include_once "init.php";

if (isset($_GET["ref"])) {
    Session::unsetSession("tfaChallenge");
    Session::unsetSession("uid");
}

if (isset($_GET["ref_"])) {
    Cookie::clear("remember_me");
    Cookie::clear("uid");
}

if ($login->isLoggedIn()) {
    header("Location: index.php");
    die();
}

if ($login->isTfaLoggedIn()) {
    header("Location: challenge.php");
}

if ($login->isRememberSet()) {
    $user = new User();
    $user_id = Cookie::get("uid");
    $uid = Others::decryptData($user_id, ENCRYPTION_KEY);
    $row = $user->getUserData($uid);

    if(empty($row)){
        Cookie::clear("remember_me");
        Cookie::clear("uid");
    }
}
?>

<?php

include_once "init.php";

if (isset($_GET["ref"])) {
    Session::unsetSession("tfaChallenge");
    Session::unsetSession("uid");
}

if (isset($_GET["ref_"])) {
    Cookie::clear("remember_me");
    Cookie::clear("uid");
}

if ($login->isLoggedIn()) {
    header("Location: index.php");
    die();
}

if ($login->isTfaLoggedIn()) {
    header("Location: challenge.php");
}

if ($login->isRememberSet()) {
    $user = new User();
    $user_id = Cookie::get("uid");
    $uid = Others::decryptData($user_id, ENCRYPTION_KEY);
    $row = $user->getUserData($uid);

    if(empty($row)){
        Cookie::clear("remember_me");
        Cookie::clear("uid");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/index.css">

</head>
<body>
    
    <section id="home"></section>
  

    <nav>
    <a href="login2.php"><i class="fas fa-sign-in-alt" data-tooltip="Login"></i></a>
    <a href="#home"><i class="fas fa-home" data-tooltip="Home"></i></a>
    <a href="#system"><i class="fas fa-desktop" data-tooltip="Sytem"></i></a>
    <a href="#about"><i class="fas fa-recycle" data-tooltip="Waste Management"></i></a>
    <a href="#systemfunc"><i class="fas fa-exclamation-triangle" data-tooltip="System Functions"></i></a>
    <a href="#members"><i class="fas fa-users" data-tooltip="Members"></i></a>
</nav>


        
    
    <div class="slider-container">
        <div class="slider">
            <div class="slide">
                <img src="https://rukminim2.flixcart.com/image/850/1000/xif0q/poster/w/k/2/medium-anime-scenery-beautiful-nature-dreamworld-anime-aesthetic-original-imagkzhgvydgucxs.jpeg?q=90&crop=false" alt="">
            </div>
            <div class="slide">
                <img src="https://i.pinimg.com/originals/4c/19/97/4c19971180d8fbbc522bfe3315fa168b.jpg" alt="">
            </div>
            <div class="slide">
                <img src="https://image.cdn2.seaart.me/2024-01-25/cmpd3qte878c73bs6umg/0d95cd2ca968586ad4f05875076a6504d308575c_high.webp" alt="">
            </div>
            <div class="slide">
                <img src="https://cdnb.artstation.com/p/assets/images/images/056/614/903/large/deep-voyage-stunning-anime-landscape.jpg?1669693899" alt="">
            </div>
            <div class="slide">
                <img src="https://img.freepik.com/premium-photo/anime-scenery-city-with-view-city-city-background_902639-39489.jpg" alt="">
            </div>
        </div>
    </div>
    <section id="about"></section>
    <h2>♻️ WASTE MANAGEMENT OF THE SCHOOL</h2>
<section class="container">
    <div class="content">
        
        <!-- Card Wrapper -->
        <div class="card-wrapper">
            <!-- Card 1 -->
            <div class="waste-card">
            <i class="fas fa-broom"></i>
                <h3>Clean As You Go</h3>
                <p> (CLAYGO) encourages everyone to clean up after themselves, reducing littering and keeping the campus clean. By taking responsibility for their own waste, individuals contribute to a tidier environment, promoting a sense of community and respect among students and staff.</p>
            </div>

            <!-- Card 2 -->
            <div class="waste-card">
            <i class="fas fa-trash"></i>
                <h3>Dispose Waste Responsibly</h3>
                <p>Always use designated trash bins to dispose of your waste. Keeping the campus clean creates a healthier and more pleasant environment for everyone. Let's take responsibility for maintaining a beautiful school.</p>
            </div>

            <!-- Card 3 -->
            <div class="waste-card">
            <i class="fas fa-recycle"></i>
                <h3>Smart Waste Segregation</h3>
                <p>Separate recyclables (using scrapify) from non-recyclables to support the school's waste management efforts. Proper segregation makes recycling more efficient and helps reduce landfill waste. Together, we can build a greener campus.</p>
            </div>

            <!-- Card 4 -->
            <div class="waste-card">
            <i class="fas fa-tree"></i>
                <h3>Keep Campus Clean</h3>
                <p>Keep the campus clean by avoiding littering at all times. Carry your trash until you find a proper bin and encourage others to do the same. A clean school is a happy and welcoming place for learning!</p>
            </div>
        </div>
    </div>
</section>

<div class="video-container">
    <a href="https://youtu.be/IK3KqfwHCqQ?si=OdNSQdbxYeRDN3xa" class="video-button" target="_blank">
        <i class="fas fa-play-circle"></i> Watch Video
    </a>
</div>

<section id="systemfunc"></section>
<h2 style="margin-top: 90px;">E-BASURA: IOT BASED  <br> WASTE SEGREGATION SYSTEM </h2>
<section class="scope-limitation">
    <div class="scope">
        <p>E-Basura is an IoT-based waste segregation system that uses image processing to classify school-related waste into recyclable and non-recyclable categories. The system was tested at Ilocos Sur Polytechnic State College—Tagudin Campus and resulted in a working prototype.</p>
    </div>

    <div class="center-icon">
        <div class="outer-circle">
            <div class="inner-circle">
                ⚠️
            </div>
        </div>
    </div>

    <div class="limitation">
        <ul>
            <li>Recognizes only a few types of waste, making it less effective for other materials.</li>
            <li>Ultrasonic sensors can give inaccurate readings due to temperature and humidity.</li>
            <li>Infrared sensors struggle to detect small or transparent objects.</li>
            <li>Response time delays affect real-time monitoring.</li>
            <li>Can only sort one type of waste at a time.</li>
        </ul>
    </div>
</section>


    
    <section id="members">
    <div class="card-container">
    <h2>E-BASURA <br> DEVELOPERS</h2>
        <!-- Card 1 -->
        <div class="card">
            <div class="card-inner">
                <div class="card-front">
                    <img src="jl.png" alt="">
                </div>
                <div class="card-back">
                    <h2>John Lloyd Andaya</h2>
                    <p>Contact Info:</p>
                </div>
            </div>
        </div>
        
        <!-- Card 2 -->
        <div class="card">
            <div class="card-inner">
                <div class="card-front">
                    <img src="alcel.jpg" alt="">
                </div>
                <div class="card-back">
                    <h2>Alcel Marie Obaña</h2>
                    <p>Contact Info:</p>
                </div>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="card">
            <div class="card-inner">
                <div class="card-front">
                    <img src="cyanne.png" alt="">
                </div>
                <div class="card-back">
                    <h2>Cyanne Justin Vega</h2>
                    <p>Contact Info:</p>
                </div>
            </div>
        </div>

        <!-- Card 4 -->
        <div class="card">
            <div class="card-inner">
                <div class="card-front">
                    <img src="jade.jpg" alt="">
                </div>
                <div class="card-back">
                    <h2>Jade Pablo</h2>
                    <p>Contact Info:</p>
                </div>
            </div>
        </div>

        <!-- Card 5 -->
        <div class="card">
            <div class="card-inner">
                <div class="card-front">
                    <img src="francis.jpeg" alt="">
                </div>
                <div class="card-back">
                    <h2>Francis Xavier Ramos</h2>
                    <p>Contact Info:</p>
                </div>
            </div>
        </div>
    </div>
    </section>

    <script>
        const slider = document.querySelector('.slider');
        let index = 0;
        const slides = document.querySelectorAll('.slide');
        const totalSlides = slides.length;

        function nextSlide() {
            index++;
            if (index >= totalSlides) {
                index = 0;
            }
            slider.style.transform = `translateX(${-index * 100}%)`;
        }

        setInterval(nextSlide, 3000); // Change slide every 5 seconds
    </script>



</body>
</html>


