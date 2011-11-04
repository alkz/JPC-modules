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

    // module's headers
    require_once("config.inc.php");
    require_once("langs/".BlogConf::language.".inc.php");

    if(!isset($_POST["title"]) || !isset($_POST["author"]) || !isset($_POST["text"]) ||
       !isset($_POST["email"]) || $_POST["title"] == "" || $_POST["author"] == "" || 
       $_POST["text"] == "" || $_POST["email"] == "")
    {
        Functions::redirect("formNews.php?op=m", 5); 
        die($_ERRORS["notFill"]);

    } 
    else
    {
        $ftitle = Functions::format($_POST["title"]);
        $fauthor = Functions::format($_POST["author"]); 
        $ftext =  addslashes(stripslashes($_POST["text"])); 
        $ftext = trim($ftext);
        $femail = Functions::format($_POST["email"]);

        $db = new JPCdb(DBInfo::host, DBInfo::name, DBInfo::user, DBInfo::pwd);
        $queryInsert = "INSERT INTO news(title, author, text, date, email) VALUES('$ftitle', '$fauthor', '$ftext', NOW(), '$femail')";  

        $db->query($queryInsert);
        $db->close();

        print $_MESSAGES["inNews"]."<br />";
        print $_MESSAGES["wait"]."<br />"; 
        Functions::redirect("formNews.php?op=m", 5); 
    } 

    HTMLstruct::footSimple();

?>
