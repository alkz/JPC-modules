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

    if($_GET["op"] == 'm')
    {
        ?>
        <form action="insertNews.php" method="POST" name="formNews">
            <?php print $_FORM["newsTitle"] ?>:<br />
            <input type="text" size="40" id="title" name="title" /><br />
            <?php print $_FORM["newsAuth"] ?>:<br />
            <input type="text" size="15" id="author" name="author" /><br />
            <?php print $_FORM["newsEmail"] ?>:<br />
            <input type="text" size="30" id="email" name="email" /><br />
            <?php print $_FORM["newsText"] ?>:<br />
            <textarea rows="20" cols="40" id="text" name="text"></textarea><br /><br />
            <input type="submit" value="<?php print $_FORM["butNews"] ?>" />
        </form>
        <?php
    }
    else if($_GET["op"] == 'e')
    {
        if(!isset($_GET["id"]))
            die($_ERRORS["access"]);
        else
        {
            $db = new JPCdb(DBInfo::host, DBInfo::name, DBInfo::user, DBInfo::pwd);
            $query = "SELECT * FROM news WHERE id='".$_GET["id"]."'";
            $row = mysql_fetch_assoc($db->query($query)); 
            
            ?>
        <form action="editNews.php?id=<?php print $_GET["id"] ?>" method="POST" name="formNews">
            <?php print $_FORM["newsTitle"] ?>:<br />
            <input type="text" size="40" id="title" name="title" value="<?php print $row["title"] ?>" /><br />
            <?php print $_FORM["newsAuth"] ?>:<br />
            <input type="text" size="15" id="author" name="author" value="<?php print $row["author"] ?>" /><br />
            <?php print $_FORM["newsEmail"] ?>:<br />
            <input type="text" size="30" id="email" name="email" value="<?php print $row["email"] ?>" /><br />
            <?php print $_FORM["newsText"] ?>:<br />
            <textarea rows="20" cols="40" id="text" name="text"><?php print $row["text"] ?></textarea><br /><br />
            <input type="submit" value="<?php print $_FORM["butENews"] ?>" />
        </form>
            <?php
            $db->close();
        }      
    }
    else
        die($_ERRORS["access"]);
    
    HTMLstruct::footSimple();

?>
