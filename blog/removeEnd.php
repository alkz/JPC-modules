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

    // Not directly open
    $selfpart = split("/", $_SERVER["PHP_SELF"]);
    $file = ereg_replace("\\\\", "/", __FILE__);
    $filepart = split("/", $file);

    if($selfpart[count($selfpart) - 1] ==
        $filepart[count($filepart) - 1])
        die("Forbidden Access.");


    
    require_once("../include/config.inc.php");
    require_once("../include/struct.inc.php");
    HTMLstruct::top();
    require_once("../langs/".Conf::language.".inc.php");
    require_once("../system/functions.php");
    require_once("../system/db.php");

    require_once("../modules/blog/config.inc.php");
    require_once("../modules/blog/langs/".BlogConf::language.".inc.php");

    $db = new JPCdb(DBInfo::host, DBInfo::name, DBInfo::user, DBInfo::pwd);
    $queryRemoveModule = "DELETE FROM modules WHERE name = 'blog'";
    $queryRemoveSection = "DELETE FROM sections WHERE name = '".BlogConf::name."'";
    $queryRemove = "DROP TABLE news, comments";

    $db->query($queryRemoveModule);
    $db->query($queryRemoveSection);
    $db->query($queryRemove);

    print $_MESSAGES["blogRemove"];

    HTMLstruct::footSimple();
?>
