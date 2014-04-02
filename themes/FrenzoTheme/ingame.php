<!DOCTYPE html>
<html>
    <head>
        <title><?php //echo $info['title']." | ".$info['link']->title; ?></title>
        <link href="themes/FrenzoTheme/css/ingame.css" rel="stylesheet" />
        <link href="themes/FrenzoTheme/js/tabs/template5/tabcontent.css" rel="stylesheet" />
        <script src="files/js/jquery.min.js"></script>
        <script src="files/js/jquery-ui.min.js"></script>
        <script src="themes/FrenzoTheme/js/tabs/tabcontent.js"></script>
    </head>
    <body>
        <div id="header">
            <div id="logo"></div>
            <div id="status">
                <table>
                    <tr>
                        <td width="35%" class="first">Leven</td>
                        <td>
                            <div class="bar">
                                <div class="bar" style="width: 70%; background: #dd5252;">
                                    50%
                                </div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td class="first">power</td>
                        <td>
                            <div class="bar">
                                <div class="bar" style="width: 50%; background: #0097a9;">
                                    50%
                                </div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td class="first">Rank</td>
                        <td>Groentje</td>
                    </tr>

                    <tr>
                        <td class="first">Land</td>
                        <td>New York</td>
                    </tr>
                </table>
            </div>
        </div>

        <div id="faux">

            <div class="menus" style="float: left;">
                <ul class="menu">
                    <h1>Persoonlijk</h1> <img src="themes/FrenzoTheme/images/icons/1391648113_administrator.png" class="menu-icon" />

                    <li><a href="#">Startpagina</a></li>
                    <li><a href="#">Profiel beheren</a></li>
                    <li><a href="#">Mijn logs</a></li>
                    <li><a href="#">Kladblok</a></li>
                    <li><a href="#">Vrienden & vijanden</a></li>
                    <li><a href="#">Respect</a></li>
                    <li style="border: 0;"><a href="#">Uitloggen</a></li>
                </ul>

                <ul class="menu">
                    <h1>Call Credits</h1> <img src="themes/FrenzoTheme/images/icons/1391731203_bookmark_toolbar.png" class="menu-icon" />

                    <li><a href="#">Call credits uitgeven</a></li>
                    <li style="border: 0;"><a href="#">Credits kopen</a></li>
                </ul>

                <ul class="menu">
                    <h1>Familie</h1> <img src="themes/FrenzoTheme/images/icons/1391731263_family.png" class="menu-icon" />

                    <li><a href="#">Familie's</a></li>
                    <li><a href="#">Nieuwe familie</a></li>
                    <li><a href="#">Familie: geen</a></li>
                    <li style="border: 0;"><a href="#">Aanmelden bij familie</a></li>
                </ul>

                <ul class="menu">
                    <h1>Overige</h1> <img src="themes/FrenzoTheme/images/icons/1391731349_search.png" class="menu-icon" />

                    <li><a href="#">Dodenlijst</a></li>
                    <li><a href="#">Ledenlijst</a></li>
                    <li><a href="#">Verhaal</a></li>
                    <li><a href="#">Contact</a></li>
                    <li><a href="#">Crew</a></li>
                    <li style="border: 0;"><a href="#">Zoeken</a></li>
                </ul>
            </div>

            <div id="content">
                <div class="content-titel">Content titel</div>

                    <div style="margin-left: 8px;">
                    <ul class="tabs" id="tab">
                        <li><a href="#tabellen-opmaak">Tabellen opmaak</a></li>
                        <li><a href="#input">Inputs</a></li>
                        <li><a href="#tab3">Tab3</a></li>
                    </ul>
                    </div>

                    <div class="content-inhoud" class="inhoud">
                        <div id="tabellen-opmaak">
                            <strong>Tabellen opmaak</strong><br />
                            <table>
                                <tr>
                                    <td width="40%">Gebruikersnaam</td>
                                    <td width="16px;"><img src="themes/FrenzoTheme/images/icons/status_online.png" border="0" alt="0" /></td>
                                    <td>Frenzo</td>
                                </tr>

                                <tr>
                                    <td>Rank</td>
                                    <td><img src="http://test.web-mobiel.nl/osbanditi/themes/FrenzoTheme/images/icons_gif/lightning.gif" border="0" alt="0" /></td>
                                    <td>Groentje</td>
                                </tr>

                                <tr>
                                    <td>Stad</td>
                                    <td><img src="http://test.web-mobiel.nl/osbanditi/themes/FrenzoTheme/images/icons_gif/world.gif" border="0" alt="0" /></td>
                                    <td>Las Vegas</td>
                                </tr>
                            </table>
                        </div>

                        <div id="input">
                        <strong>Input velden</strong><br />
                            <table>
                                <tr>
                                    <td width="40%">Tekst/pass</td>
                                    <td width="16px;"><img src="themes/FrenzoTheme/images/icons/status_online.png" border="0" alt="0" /></td>
                                    <td><input type="text" /></td>
                                </tr>

                                <tr>
                                    <td>Submit</td>
                                    <td><img src="http://test.web-mobiel.nl/osbanditi/themes/FrenzoTheme/images/icons_gif/lightning.gif" border="0" alt="0" /></td>
                                    <td><input type="submit" /></td>
                                </tr>

                                <tr>
                                    <td>Tekst area</td>
                                    <td><img src="http://test.web-mobiel.nl/osbanditi/themes/FrenzoTheme/images/icons_gif/world.gif" border="0" alt="0" /></td>
                                    <td><textarea></textarea></td>
                                </tr>
                            </table>

                        </div>

                        <div id="tab3">tab3</div>

                    </div>
                <div class="content-footer"></div>

                <div class="content-titel">Content titel</div>
                <div class="content-inhoud">

                </div>
                <div class="content-footer"></div>

            </div>

            <div class="menus" style="float: right;">
                <ul class="menu">
                    <h1>Criminaliteit</h1> <img src="themes/FrenzoTheme/images/icons/1391731384_Police_officer.png" class="menu-icon" />

                    <li><a href="#">Misdaden</a></li>
                    <li><a href="#">Georganiseerde misdaad</a></li>
                    <li><a href="#">Route 66</a></li>
                    <li><a href="#">Drugs</a></li>
                    <li><a href="#">Voertuigen</a></li>
                    <li style="border: 0;"><a href="#">Werken</a></li>
                </ul>

                <ul class="menu">
                    <h1>Locaties</h1> <img src="themes/FrenzoTheme/images/icons/1391731369_push_pin.png" class="menu-icon" />

                    <li><a href="#">Gevangenis</a></li>
                    <li><a href="#">Woningen</a></li>
                    <li><a href="#">Ziekenhuis</a></li>
                    <li><a href="#">Bank</a></li>
                    <li><a href="#">Shop</a></li>
                    <li style="border: 0;"><a href="#">Reizen</a></li>
                </ul>

                <ul class="menu">
                    <h1>Casino</h1> <img src="themes/FrenzoTheme/images/icons/1391731460_Game-casino.png" class="menu-icon" />

                    <li style="border: 0;"><a href="#">Loterij</a></li>
                </ul>

                <ul class="menu">
                    <h1>Statistieken</h1> <img src="themes/FrenzoTheme/images/icons/1391731439_web-space-px-png.png" class="menu-icon" />

                    <li><a href="#">Server tijd: 18:50:55</a></li>
                    <li><a href="#">Gangsters: 19</a></li>
                    <li><a href="#">Ziekenhuis</a></li>
                    <li><a href="#">Online: 1</a></li>
                    <li style="border: 0;"><a href="#">Meer statistieken</a></li>
                </ul>
            </div>

        </div>

        <div id="footer">

        </div>

    </body>
</html>