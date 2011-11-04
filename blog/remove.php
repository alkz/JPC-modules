<?php

 /********************************************************************  
 *                 JPC(Jargon PHP CMS) - blog module                 * 
 *********************************************************************
 *                                                                   *
 *     copyleft alkz                                                 * 
 *                                                                   *
 *                          PUBLIC LICENSE                           * 
 *                         Date: 2010/01/12                          *
 *                                                                   * 
 *              See http://www.gnu.org/licenses/gpl.html             *
 *                                                                   *
 ********************************************************************/

?>

<?php
    
    require_once("../../include/config.inc.php");
    require_once("../../include/struct.inc.php");
    HTMLstruct::top();
    require_once("../../langs/".Conf::language.".inc.php");
    require_once("../../system/functions.php");
    require_once("../../system/db.php");

    require_once("config.inc.php");
    require_once("langs/".BlogConf::language.".inc.php");

    $db = new JPCdb(DBInfo::host, DBInfo::name, DBInfo::user, DBInfo::pwd);
    $queryRemoveModule = "DELETE FROM modules WHERE name = 'blog'";
    $queryRemoveSection = "DELETE FROM sections WHERE name = '".BlogConf::name."'";
    $queryRemove = "DROP TABLE news, comments";

    $db->query($queryRemoveModule);
    $db->query($queryRemoveSection);
    $db->query($queryRemove);
    $db->close();

    print $_MESSAGES["blogRemove"]."<br />";
    Functions::redirect("../../index.php", 5);
    
    HTMLstruct::foot();
?>
