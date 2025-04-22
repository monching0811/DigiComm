<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay 173 - DigiComm | <?= __('about_us') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        /* Custom styles to override Bootstrap or add specific elements */
        body {
            font-family: Arial, sans-serif;
        }

        header {
            background-color: #2E7D32;
            color: white;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }

        .hero {
            background: url('back.jpg') no-repeat center center/cover;
            height: 400px;
            position: relative;
            color: white;
            text-align: center;
            padding-top: 80px;
            overflow: hidden;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .highlight {
            color: #E65100;
        }

        .event-item img {
            width: 100%;
            height: auto;
            border-radius: 5px;
            transition: transform 0.3s ease-out;
        }

        .event-item img:hover {
            transform: scale(1.05);
        }

        .contact {
            background: #f4f4f4;
            padding: 20px;
            text-align: center;
        }
        
        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.5s ease-in-out, transform 0.5s ease-in-out;
        }

        .fade-in.active {
            opacity: 1;
            transform: translateY(0);
        }

        /* Staggered transition for buttons and title */
        .nav-link.fade-in {
            transition-delay: 0.1s;
        }

        .nav-link.fade-in:nth-child(2) {
            transition-delay: 0.2s;
        }

        .nav-link.fade-in:nth-child(3) {
            transition-delay: 0.3s;
        }

        .nav-link.fade-in:nth-child(4) {
            transition-delay: 0.4s;
        }
        .nav-link.fade-in:nth-child(5) {
            transition-delay: 0.5s;
        }

        .btn-register-red.fade-in {
            transition-delay: 0.5s;
        }

        h1.fade-in {
            transition-delay: 0.6s;
        }

        h2.fade-in {
            transition-delay: 0.7s;
        }

        h2.text-center.fade-in {
            transition-delay: 0.8s;
        }

        h2.active.fade-in {
            transition-delay: 0.9s;
        }

        /* Footer styles */
        footer {
            background-color: #f8f9fa;
            padding: 20px 0;
            text-align: center;
            font-size: 0.8rem;
        }

        footer a {
            color: #007bff;
            text-decoration: none;
            margin: 0 10px;
        }

        footer a:hover {
            text-decoration: underline;
        }

        footer span {
            margin: 0 10px;
        }

        .navbar-nav li:hover {
            background-color: darkred;
        }

        /* Mission and Vision Styles */
        .mission-vision {
            background-color: #f9f9f9;
            padding: 40px 0;
            text-align: center;
        }

        .mission-vision h2 {
            color: #2E7D32;
            margin-bottom: 20px;
        }

        .mission-vision p {
            font-size: 1.1em;
            color: #555;
            line-height: 1.6;
        }

        /* Organizational Chart Styles with Photos */
        .org-chart {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            text-align: center;
        }

        .org-chart h2 {
            color: #2E7D32;
            margin-bottom: 20px;
        }

        .org-chart-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .org-chart-level {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .org-chart-node {
            display: flex;
            flex-direction: column;
            align-items: center;
            border: 1px solid #ddd;
            padding: 10px 20px;
            margin: 10px;
            border-radius: 5px;
            width: 180px;
            box-sizing: border-box;
        }

        .org-chart-node img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        /* Responsive Styles */
        @media (max-width: 992px) {
            .hero {
                height: 300px;
                padding-top: 60px;
            }

            .about .col-md-4 {
                margin-bottom: 20px;
            }

            .vertical-line {
                display: none;
            }
        }

        @media (max-width: 768px) {
            .hero {
                height: 250px;
                padding-top: 50px;
            }

            .hero h1 {
                font-size: 2em;
            }

            .hero p {
                font-size: 0.9em;
            }

            .org-chart-node {
                width: 150px;
                margin: 5px;
            }
        }

        @media (max-width: 576px) {
            .hero {
                height: 200px;
                padding-top: 40px;
            }

            .hero h1 {
                font-size: 1.5em;
            }

            .hero p {
                font-size: 0.8em;
            }

            .org-chart-node {
                width: 100%;
                margin: 10px 0;
            }

            .contact iframe {
                width: 100%;
                height: 300px;
            }
        }

        /* Responsive iframe */
        .contact iframe {
            width: 100%;
            height: 450px;
            border: 0;
        }
    </style>
</head>

<body>
    <?php
    $language = isset($_COOKIE['language']) ? $_COOKIE['language'] : 'en';

    $translations = [
        'en' => [
            'home' => 'Home',
            'about_us' => 'About Us',
            'events' => 'Events',
            'digicomm' => 'DIGICOMM',
            'tagline' => '"Extends our Community Services in digital and modernized approached"',
            'register' => 'Register',
            'welcome' => 'Welcome to DigiComm, your new online platform connecting residents of Barangay 173-Congress...',
            'about_history_title' => 'Our History',
            'about_history_content' => 'Barangay 173 was established on [Year]...',
            'digicomm_vision_title' => 'The Vision Behind DigiComm',
            'digicomm_vision_content' => 'DigiComm was created with the goal of...',
            'our_mission_vision_title' => 'Our Mission & Vision',
            'mission_title' => 'Mission',
            'mission_content' => 'To foster a safe, progressive...',
            'vision_title' => 'Vision',
            'vision_content' => 'Barangay 173 is envisioned to be a model community...',
            'meet_the_team_title' => 'Meet the Barangay Officials',
            'barangay_captain' => 'Barangay Captain',
            'captain_name' => '[Captain\'s Name]',
            'captain_bio' => '...',
            'sangguniang_member' => 'Sangguniang Member',
            'member_name_1' => '[Member 1 Name]',
            'member_bio_1' => '...',
            'member_name_2' => '[Member 2 Name]',
            'member_bio_2' => '...',
            'core_values_title' => 'Our Core Values',
            'value_transparency' => 'Transparency',
            'value_efficiency' => 'Efficiency',
            'community_focus_title' => 'Our Commitment to the Community',
            'community_focus_content' => 'We are deeply committed to serving the residents...',
            'contact_us' => 'Contact Us',
            'copyright' => '© 2025',
            'terms' => 'Terms and Conditions',
            'privacy' => 'Privacy Policy',
            // ... other translations
        ],
        'tl' => [
            'home' => 'Tahanan',
            'about_us' => 'Tungkol sa Amin',
            'events' => 'Mga Kaganapan',
            'digicomm' => 'DIGICOMM',
            'tagline' => '"Pinalawak ang Ating mga Serbisyo sa Komunidad sa digital at makabagong pamamaraan"',
            'register' => 'Magrehistro',
            'welcome' => 'Maligayang pagdating sa DigiComm, ang iyong bagong online platform na nag-uugnay sa mga residente ng Barangay 173-Congress...',
            'about_history_title' => 'Ang Aming Kasaysayan',
            'about_history_content' => 'Ang Barangay 173 ay itinatag noong [Taon]...',
            'digicomm_vision_title' => 'Ang Bisyon sa Likod ng DigiComm',
            'digicomm_vision_content' => 'Ang DigiComm ay nilikha sa layuning...',
            'our_mission_vision_title' => 'Ang Aming Misyon at Bisyon',
            'mission_title' => 'Misyon',
            'mission_content' => 'Upang itaguyod ang isang ligtas, progresibo...',
            'vision_title' => 'Bisyon',
            'vision_content' => 'Ang Barangay 173 ay pinapangarap na maging isang huwarang komunidad...',
            'meet_the_team_title' => 'Kilalanin ang mga Opisyal ng Barangay',
            'barangay_captain' => 'Kapitan ng Barangay',
            'captain_name' => '[Pangalan ng Kapitan]',
            'captain_bio' => '...',
            'sangguniang_member' => 'Miyembro ng Sangguniang Barangay',
            'member_name_1' => '[Pangalan ng Miyembro 1]',
            'member_bio_1' => '...',
            'member_name_2' => '[Pangalan ng Miyembro 2]',
            'member_bio_2' => '...',
            'core_values_title' => 'Ang Aming Pangunahing Halaga',
            'value_transparency' => ' transparency',
            'value_efficiency' => 'Kahusayan',
            'community_focus_title' => 'Ang Aming Dedikasyon sa Komunidad',
            'community_focus_content' => 'Kami ayLubos na nakatuon sa paglilingkod sa mga residente...',
            'contact_us' => 'Makipag-ugnayan sa Amin',
            'copyright' => '© 2025',
            'terms' => 'Mga Tuntunin at Kundisyon',
            'privacy' => 'Patakaran sa Pagkapribado',
            // ... other translations
        ],
    ];

    function __($key)
    {
        global $language, $translations;
        return isset($translations[$language][$key]) ? $translations[$language][$key] : $key;
    }
    ?>

    <header class="p-3 fade-in">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <img src="logo.jpg" alt="Barangay Logo" class="me-2" style="height: 40px;">
                <span>BARANGAY 173 - SANGGUNIANG BARANGAY COUNCIL</span>
            </div>
            <nav class="navbar navbar-expand-lg navbar-dark">
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link btn btn-danger fade-in" style="background-color: transparent;"
                                   href="index.php"><?= __('home') ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn btn-danger fade-in" style="background-color: transparent;"
                                   href="about.php"><?= __('about_us') ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn btn-danger fade-in" style="background-color: transparent;"
                                   href="index.php#events"><?= __('events') ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn btn-danger fade-in" style="background-color: transparent;"
                                   href="#contact"><?= __('Contact Us:') ?></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <main class="container py-5 mt-5">
        <section id="introduction" class="about-section fade-in">
            <h2><?= __('about_history_title') ?></h2>
            <p><?= __('about_history_content') ?></p>
        </section>

        <section id="digicomm-vision" class="about-section fade-in">
            <h2><?= __('digicomm_vision_title') ?></h2>
            <p><?= __('digicomm_vision_content') ?></p>
        </section>

        <section id="mission-vision" class="about-section fade-in">
            <h2><?= __('our_mission_vision_title') ?></h2>
            <h3><?= __('mission_title') ?></h3>
            <p><?= __('mission_content') ?></p>
            <h3><?= __('vision_title') ?></h3>
            <p><?= __('vision_content') ?></p>
        </section>

        <section class="org-chart py-5 fade-in">
            <div class="container">
                <h2 class="text-center fade-in">Barangay Organizational Chart</h2>
                <div class="org-chart-container">
                    <div class="org-chart-level">
                        <div class="org-chart-node">
                            <img src="placeholder_captain.png" alt="Barangay Captain">
                            Barangay Captain
                        </div>
                    </div>
                    <div class="org-chart-level">
                        <div class="org-chart-node">
                            <img src="placeholder_member.png" alt="Sangguniang Member 1">
                            Sangguniang Member 1
                        </div>
                        <div class="org-chart-node">
                            <img src="placeholder_member.png" alt="Sangguniang Member 2">
                            Sangguniang Member 2
                        </div>
                        <div class="org-chart-node">
                            <img src="placeholder_member.png" alt="Sangguniang Member 3">
                            Sangguniang Member 3
                        </div>
                    </div>
                    <div class="org-chart-level">
                        <div class="org-chart-node">
                            <img src="placeholder_secretary.png" alt="Barangay Secretary">
                            Barangay Secretary
                        </div>
                        <div class="org-chart-node">
                            <img src="placeholder_treasurer.png" alt="Barangay Treasurer">
                            Barangay Treasurer
                        </div>
                    </div>
                    <div class="org-chart-level">
                        <div class="org-chart-node">
                            <img src="placeholder_committee.png" alt="Peace and Order Committee">
                            Peace and Order
                        </div>
                        <div class="org-chart-node">
                            <img src="placeholder_committee.png" alt="Infrastructure Committee">
                            Infrastructure
                        </div>
                        <div class="org-chart-node">
                            <img src="placeholder_committee.png" alt="Health Committee">
                            Health
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="core-values" class="about-section fade-in">
            <h2><?= __('core_values_title') ?></h2>
            <ul>
                <li><?= __('value_transparency') ?></li>
                <li><?= __('value_efficiency') ?></li>
            </ul>
        </section>

        <section id="community-focus" class="about-section fade-in">
            <h2><?= __('community_focus_title') ?></h2>
            <p><?= __('community_focus_content') ?></p>
        </section>

        <section class="contact py-5 fade-in" id="contact">
            <div class="container text-center">
                <h2 class="active fade-in"><?= __('contact_us') ?></h2>
                <div class="row justify-content-center gap-3 mt-4">
                    <div class="col-md-4 col-lg-3">
                        <p><a href="mailto:congressbarangay173@gmail.com"><span>📧</span></a></p>
                    </div>
                    <div class="col-md-4 col-lg-3">
                        <p><span>📞</span> 0953-594-3117</p>
                    </div>
                    <div class="col-md-4 col-lg-3">
                        <p><a href="https://www.facebook.com/profile.php?id=61553444116460&rdid=iz2LR21czyfS3SjT&share_url=https%3A%2F%2Fwww.facebook.com" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-facebook"></i></a></p>
                    </div>
                </div>

                <h2 class="active fade-in mt-5"><?= __('or visit us') ?></h2>
                <p>Barangay 173-Congress Hall ( PUNONG BARANGAY OFFICE)</p>
                <div class="mt-4">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2707.8745450071874!2d121.03064480864678!3d14.749614673355639!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b13770b364fb%3A0xbb0c893e3f8c970d!2sBarangay%20173-Congress%20Hall%20(%20PUNONG%20BARANGAY%20OFFICE)!5e1!3m2!1sen!2sph!4v1745331112568!5m2!1sen!2sph" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Map of Barangay 173 Hall" aria-label="Map showing the location of Barangay 173 Hall"></iframe>
                </div>
            </div>
        </section>
    </main>

    <footer class="mt-5">
        <div class="container">
            <span><?= __('copyright') ?></span>
            <a href="about.php"><?= __('about_us') ?></a>
            <a href="accessibility.php">Accessibility</a>
            <a href="term&condition.php"><?= __('terms') ?></a>
            <a href="policy.php"><?= __('privacy') ?></a>
            <a href="cookie.php">Cookie Policy</a>
            <a href="copy.php">Copyright Policy</a>
            <a href="guidelines.php">Community Guidelines</a>
            <a href="lang.php">Language</a>
        </div>
    </footer>

    <script>
        window.addEventListener('load', () => {
            const fadeElements = document.querySelectorAll('.fade-in');
            fadeElements.forEach(element => {
                element.classList.add('active');
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>