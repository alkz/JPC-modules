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
 
    require_once("../include/config.inc.php");
    require_once("../include/struct.inc.php");
    HTMLstruct::top();
    require_once("../langs/".Conf::language.".inc.php");
    require_once("../system/functions.php");
    require_once("../system/db.php");

    require_once("../modules/blog/config.inc.php");
    require_once("../modules/blog/langs/".BlogConf::language.".inc.php");

    if(!isset($_GET["id"]) || !isset($_POST["title"]) || !isset($_POST["author"]) || 
        !isset($_POST["text"]) || !isset($_POST["email"]) || $_POST["title"] == "" ||
        $_POST["author"] == "" || $_POST["text"] == "" || $_POST["email"] == "")
    {
        Functions::redirect("../modules/blog/formNews.php?op=e&id=".$_GET["id"], 5);
        die($_ERRORS["notFill"]);
    }  
    else
    {
        $ftitle = Functions::format($_POST["title"]);
        $fauthor = Functions::format($_POST["author"]); 
        $ftext = trim($ftext);
        $ftext =  addslashes(stripslashes($ftext));
        $femail = Functions::format($_POST["email"]);

        $db = new JPCdb(DBInfo::host, DBInfo::name, DBInfo::user, DBInfo::pwd);
        $queryUpdate = "UPDATE news SET title = '$ftitle', author = '$fauthor', text = '$text', email = '$femail' WHERE id = '".$_GET["id"]."'";

        $db->query($queryUpdate);
        $db->close();

        print $_MESSAGES["edNews"]."<br />";
        print $_MESSAGES["wait"]."<br />";
        Functions::redirect("../modules/blog/home.php", 5);
    }


    HTMLstruct::footSimple();
   
?>
