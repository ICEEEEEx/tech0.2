<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Document</title>
</head>

<body>

    <nav id="navbar">
        <div class="brand"id="brand"><a href="#section0"> DT</a></div>
        <div class="brand" id="page-name">PAGRINDINIS</div>
        <div class="brand-button-div">
            <div class="nav-buttons">
                    <div class="dropdown">
                        <button class="dropdown-button">Navigacija</button>
                        <div class="dropdown-content">
                            <a href="#section1">Igudziai</a>
                            <a href="#section2">Post'ai</a>
                            <a href="#section3">Pomegiai</a>
                            <br>
                            <a href="login.php" style="color: green;">Admin</a>
                        </div>
                    </div>
            </div>
        </div>
    </nav>
    <div class="container">

        <div class="frontpage" id="section0">
            <div class="cover-photo"></div>
            <div class="content-wrapper">
                <div class="box1">
                    <h1>Donatas Tadaravičius</h1>
                    <p>Aš esu talentingas dvyliktokas iš Kauno. Man yra 18 metų ir esu Kauno Informacinių Technologijų Mokyklojos mokinys. Gimęs Kaune, esu susijęs su šiuo miestu ir visada stengiuosi prisidėti prie jo vystymo.
                    <br> <br>
                    Esu tikras technologijų entuziastas, kuris ne tik domisi elektronika, bet ir mėgsta išsamiai tyrinėti automobilius bei sekti naujausias sporto tendencijas. Mano aktyvus požiūris į gyvenimą leidžia man būti nuolat informuotam apie pasaulio naujienas ir įvykius.</p>
                </div>  
                <div class="box2">
                    <img src="images/portrait.png" alt="Portrait of Donatas Tadaravičius" id="personal-photo">
                </div>
            </div>               
        </div>

        <div class="content-container">

            <div class="skill-section" id="section1">
                <div class="s-container">
                    <div class="text-container">
                        <h2>Apie mano įgudžius</h2>
                        <p>Esu įgijęs išsamią svetainės kūrimo patirtį ir esu stiprus HTML, CSS, JavaScript ir PHP įgūdžių srityse. Mano žinios apima visas pagrindines svetainių kūrimo kalbas, kurios leidžia man kurti funkcionalias ir vizualiai patrauklias interneto svetaines.
                        <br>
                        Įrankiai:
                        <br>
                        Turiu patirties naudojant įvairias programavimo priemones, tačiau ypač išmanau naudotis Visual Studio Code ("VSCode"). Tai puikus kūrimo įrankis, kurį naudoju kiekvieną dieną, kai kuriu ir redaguoju savo svetainių projektus. VSCode suteikia man efektyvumą ir lankstumą, ji man suteikia galimybę greitai ir efektyviai kurti kodą bei testuoti svetainės funkcionalumą.</p>
                    </div>
                    <div class="skills-container">
                        <h2>Įgudžiai</h2> 
                    <div class="skills">
                        <div class="skill">
                            <img src="icons/html.png" alt="HTML Icon" class="skill-icon">
                            <h3>HTML</h3>
                            <p>Įgudęs</p>
                        </div>
                        <div class="skill">
                            <img src="icons/css-3.png" alt="CSS Icon" class="skill-icon">
                            <h3>CSS</h3>
                            <p>Pažengęs</p>
                        </div>
                        <div class="skill">
                            <img src="icons/java-script.png" alt="JavaScript Icon" class="skill-icon">
                            <h3>JavaScript</h3>
                            <p>Pradinukas/Pažengęs</p>
                        </div>
                        <div class="skill">
                            <img src="icons/python.png" alt="Python Icon" class="skill-icon">
                            <h3>Python</h3>
                            <p>Pradinukas</p>
                        </div>
                        <div class="skill">
                            <img src="icons/php.png" alt="UI/UX Design Icon" class="skill-icon">
                            <h3>PHP</h3>
                            <p>Pažengęs/Įgudęs</p>
                        </div>
                        <div class="skill">
                            <img src="icons/design.png" alt="Responsive Design Icon" class="skill-icon">
                            <h3>Reaguojantis Dizainas</h3>
                            <p>Įgudęs</p>
                         </div>
                    </div>
                    </div>
                </div>
            </div>    

            <div class="postsz-container" id="section2">
                <h1>Žinutės</h1>
                <div class="posts-container" id="postContainer">
                    <?php
                    // Paimti "post'us" iš JSON file'o
                    $posts = json_decode(file_get_contents('Jsons/posts.json'), true);
    
                    // Reverse the order of posts (newest to oldest)
                    $postrev = array_reverse($posts);

                    foreach ($posts as $post) {

                    }
                    ?>
                </div>
                <div class="">
                    <button class="posts-button" id="moreBtn">Rodyti Daugiau</button>
                    <button class="posts-button" id="hideBtn" style="display: none;">Paslėpti</button>
                </div>
            </div>

            <div class="hobbiez-container" id="section3">
                <h1>Pomėgiai</h1>
                <div class="card-hobbies-container">
                    <?php
                    // hobby korteles is JSON file'o
                    $hobbies = json_decode(file_get_contents('Jsons/hobbies.json'), true);
                    
                    // Display each hobby card
                    foreach ($hobbies as $hobby) {
                        echo '<div class="hobby-card">';
                        echo '<div class="img-container">';
                        echo '<img src="' . $hobby['backgroundImage'] . '" alt="Background Image" class="background-image">';
                        echo '<img src="' . $hobby['coolerImage'] . '" alt="Cooler Image" class="cooler-image">';
                        echo '</div>';
                        echo '<div class="card-content">';
                        echo '<h2 class="hobby-name">' . $hobby['hobbyName'] . '</h2>';
                        echo '<p>' . $hobby['description'] . '</p>';
                        echo '</div>';
                        echo '</div>';
                    } 
                    ?>
                </div>
            </div>



        </div>
        <footer>
            <div class="footer-content">
                <div class="footer-date-div">
                    <p>&copy; <?php echo date("Y"); ?> DT.</p>
                </div>
                <div class="footer-links-div"> 
                    <ul class="footer-links">
                        
                        <!-- <li><a href="https://outlook.office.com/mail/">El-Paštas:</a> Donatas.Tadaravicius@stud.kitm.lt</li> -->
                        <!-- <h2>Kontaktai</h2> -->
                        <li>*Donatas.Tadaravicius@stud.kitm.lt</li>
                        <li><a href="https://linktr.ee/DonatasT889">*Socialiniai Tinklai</a></li>
                        <li>*+370 603 39831</li>
 
                        
                        
                        <br>
                        <li><a href="https://kitm.lt/">KITM</a></li>
                        <li><a href="#"></a></li>
                    </ul>
                </div>

            </div>
        </footer>

    
    </div>


    <script src="script.js"></script>
    <script src="script-posts.js"></script>
</body>
</html>