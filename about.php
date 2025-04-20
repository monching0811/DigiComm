<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay 173 - DigiComm | <?= __('about_us') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* You can include specific styles for aboutUs.php here or in a separate CSS file */
        body {
            font-family: Arial, sans-serif;
        }

        .about-section {
            padding: 40px 0;
        }

        .team-member {
            text-align: center;
            margin-bottom: 20px;
        }

        .team-member img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
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
            'login' => 'Login',
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
            'contact_us_title' => 'Contact Us',
            // ... other translations
        ],
        'tl' => [
            'home' => 'Tahanan',
            'about_us' => 'Tungkol sa Amin',
            'events' => 'Mga Kaganapan',
            'login' => 'Mag-login',
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
            'contact_us_title' => 'Makipag-ugnayan sa Amin',
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
                                    href="landing.php"><?= __('home') ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn btn-danger fade-in" style="background-color: transparent;"
                                    href="about.php"><?= __('about_us') ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn btn-danger fade-in" style="background-color: transparent;"
                                    href="#events"><?= __('events') ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn btn-danger fade-in" href="login.php"><?= __('login') ?></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <main class="container py-5">
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

        <section id="team" class="about-section fade-in">
            <h2><?= __('meet_the_team_title') ?></h2>
            <div class="row">
                <div class="col-md-4 team-member">
                    <img src="placeholder_captain.png" alt="<?= __('barangay_captain') ?>">
                    <h5><?= __('barangay_captain') ?></h5>
                    <p class="mb-0"><?= __('captain_name') ?></p>
                    <small class="text-muted"><?= __('captain_bio') ?></small>
                </div>
                <div class="col-md-4 team-member">
                    <img src="placeholder_member.png" alt="<?= __('sangguniang_member') ?> 1">
                    <h5><?= __('sangguniang_member') ?></h5>
                    <p class="mb-0"><?= __('member_name_1') ?></p>
                    <small class="text-muted"><?= __('member_bio_1') ?></small>
                </div>
                <div class="col-md-4 team-member">
                    <img src="placeholder_member.png" alt="<?= __('sangguniang_member') ?> 2">
                    <h5><?= __('sangguniang_member') ?></h5>
                    <p class="mb-0"><?= __('member_name_2') ?></p>
                    <small class="text-muted"><?= __('member_bio_2') ?></small>
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

        <section id="contact" class="about-section fade-in">
            <h2><?= __('contact_us_title') ?></h2>
            <p>Email: <a href="mailto:congressbarangay173@gmail.com">congressbarangay173@gmail.com</a></p>
            <p>Phone: 0953 594 3117</p>
            <p><a href="https://www.facebook.com/profile.php?id=61553444116460&rdid=xJsza173FOV0wvmT&share_url=https%3A%2F%2Fwww.facebook.com%2Fshare%2F1AZKgCjTGb%2F#">FaceBook Account</a></p>
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