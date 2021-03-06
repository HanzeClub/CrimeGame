<?php
/**
 * initialize.php
 *
 * This initialize class is used to load a template file
 * and checks if user has permission to view it.
 */

/**
 * osFighter_autoloader
 *
 * Custom function to load classes
 * @param $class name
 */
function osFighter_autoloader($class) {
    if (file_exists('core/'.strtolower($class).'.php')) {
        require 'core/'.strtolower($class).'.php';
    } else if (file_exists('core/controllers/'.strtolower($class).'.php')) {
        require 'core/controllers/'.strtolower($class).'.php';
    } else {
        //die("The server is missing a class file, script could not continue.");
    }
}

require __DIR__. '/vendor/autoload.php';

spl_autoload_register('osFighter_autoloader'); // Register function
$database    = new Database;
$mailer      = new Mailer;
$error       = new Error;
$session     = new Session;
$form        = new Form;
$user        = new User;
$admin       = new Admin;
$settings    = new Settings;
$casino      = new Casino;
$payclass    = new PayClass;
$useractions = new UserActions;
$forum       = new Forum;
$validator   = new Validator;

class initialize
{
    private $url;
    private $home_dir;
    private $link_info;
    private $base;
    public  $info = array();

    /**
     * Class constructor
     */
    public function __construct($infoSets) {
        $this->url      = $infoSets['url'];
        $this->home_dir = $infoSets['path'];
        $this->base     = $infoSets['base'];
        $this->initialize();
    }

    /**
     * Check if the given url exists and the user has permission to see it.
     */
    private function initialize() {
        global $database;

        if ($this->ipBanned($_SERVER['REMOTE_ADDR'])) {
            $this->info = array(
                'file_to_load' => 'files/http/403_banned.php',
                'mail'         => $database->getConfigs()['EMAIL_FROM_ADDR']
            );
        } else if (is_object($this->link_info = $this->pageExists())) {
            if ($this->hasPermissions($this->link_info->groups)) {
                $this->info = $this->getInfoArray();

                $this->info['file_to_load'] = 'views/'.$this->info['theme'].'/'.$this->info['file'];

                $this->checkInAir();
                $this->checkJail();
            } else {
                $this->info['file_to_load'] =  'files/http/403.php';
            }
        } else {
            $this->info['file_to_load'] =  'files/http/404.php';
        }
    }

    /**
     * Functions to check if page exists
     * @return bool|object
     */
    private function pageExists() {
        global $database;

        if (substr($this->url, -1) == "/") {
            $this->url = substr($this->url, 0, -1);
        }

        $items = array(':url' => $this->url);
        $link = $database
            ->query("SELECT pages.*, menus.menu FROM ".TBL_PAGES." INNER JOIN menus ON menus.pid = pages.id WHERE pages.link = :url", $items)
            ->fetchObject();

        if (is_object($link) && $this->checkFileExists($link->menu, $link->file)) return $link;

        return false;
    }

    /**
     * Function to check if user has permissions to watch the page
     * @param $groups serialized array of groups
     * @return bool
     */
    private function hasPermissions($groups) {
        global $session;

        $groupsArray = unserialize($groups);

        if (empty($groupsArray)) return true;

        foreach($groupsArray as $groupID) {
            if ($session->isUserGroup($groupID)) return true;
        }

        return false;
    }

    /**
     * Function to check if file exists in files system
     * @param $category category where file needs to be checked
     * @param $path path to file which need to be checked
     * @return bool
     */
    private function checkFileExists($category, $path) {
        global $session;

        if ($session->logged_in && file_exists("files/ingame/".$category."/".$path)) {
            return true;
        } else if (file_exists("files/outgame/".$path)) {
            return true;
        } else if (!$session->logged_in && file_exists("files/ingame/".$category."/".$path)) {
            return true;
        }

        return false;
    }

    /**
     * Function that return theme file by user loggin_in status
     * @return string
     */
    private function getThemeFile() {
        global $session;

        if ($session->logged_in) return "ingame.php";

        return "outgame.php";
    }

    /**
     * Function that returns all menu items from the database
     * and checks if user has permissions to get on the page
     * that menu link goes to
     * @return array
     */
    private function getMenus() {
        global $database;

        $menuItems = array();
        $query = $database->query("SELECT * FROM ".TBL_MENUS." ORDER BY weight");

        foreach($query as $menuItem) {
            $items = array('pid' => $menuItem['pid']);
            $page = $database->query("SELECT groups, title, link FROM ".TBL_PAGES." WHERE id = :pid", $items);

            if ($page->rowCount() == 0) continue;

            $pageInfo = $page->fetch();

            if ($menuItem['display'] == 0) continue;
            if (!$this->hasPermissions($pageInfo['groups'])) continue;

            $menuItems[$menuItem['menu']][] = $pageInfo;
        }

        return $menuItems;
    }

    /**
     * Function that returns all page info needed for rendering a page
     * @return array with (page) info
     */
    private function getInfoArray() {
        global $database;
        $configs = $database->getConfigs();

        return array(
            'link'     => $this->link_info,
            'theme'    => $configs['ACTIVE_THEME'],
            'title'    => $configs['SITE_NAME'],
            'ranks'    => unserialize($configs['RANKS']),
            'cities'   => unserialize($configs['CITIES']),
            'file'     => $this->getThemeFile(),
            'menu'     => $this->getMenus(),
            'base'     => $this->base,
            'currency' => $configs['CURRENCY']
        );
    }

    private function checkJail() {
        global $user;

        if ($user->in_jail && (int)$this->info['link']->jail) {
            $this->info['link']->file = "in_jail.php";
            $this->info['link']->menu = "locations";
        }
    }

    private function checkInAir() {
        global $user;

        if ($user->in_air) {
            $this->info['link']->file = "in_air.php";
            $this->info['link']->menu = "locations";
        }
    }

    private function ipBanned($ip) {
        global $database;

        $query = $database->query("SELECT * FROM " . TBL_BANNED_IP . " WHERE ip = :ip", array(':ip' => $ip));

        return ($query->rowCount() == 0) ? false : true;
    }
}

$initialize = new initialize($init);

/* Create info array for template */
$info = $initialize->info;
include($info['file_to_load']);