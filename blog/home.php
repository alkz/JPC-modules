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

    include_once("../../include/config.inc.php");
    include_once("../../include/struct.inc.php");
    HTMLstruct::top();
    include_once("../../../langs/".Conf::language.".inc.php");
    include_once("../../system/functions.php");
    include_once("../../system/db.php");

    // module's headers
    include_once("../modules/blog/config.inc.php");
    include_once("../modules/blog/langs/".BlogConf::language.".inc.php");

    include_once("config.inc.php");
    include_once("langs/".BlogConf::language.".inc.php");
 

    if(isset($_GET["start"]) || $_GET["start"] < 0)
        $start = $_GET["start"];
    else 
        $start = 0;

    $db = new JPCdb(DBInfo::host, DBInfo::name, DBInfo::user, DBInfo::pwd);

    $query = "SELECT * FROM news ORDER BY date DESC LIMIT $start, ".BlogConf::posts;

    $res = $db->query($query);
    while(($row = mysql_fetch_assoc($res)) != null)
    {
        $queryCountComments = "SELECT count(*) AS number FROM comments WHERE idNews = '".$row[id]."'";
        $resComm = $db->query($queryCountComments);
        $comm = mysql_fetch_assoc($resComm);
        ?>
        <div id="news">
            <div id="important"><?php print $row[title] ?></div><br /><br />
            <?php print $row["text"] ?><br /><br />
            <?php print $_NEWS["comments"] ?>(<a href="../modules/blog/showComments.php?id=<?php print $row[id] ?>"><?php print $comm[number] ?></a>)
            <br /><br />
            <div id="underNews">
                <?php print "| ".$_NEWS["author"].'<a href="mailto:'.$row["email"].'">'.$row[author].'</a>' ?>
                <?php print " | ".$_NEWS["date"].$row["date"]." |" ?> 
            </div>
            <br /><hr /><br />
        </div>
        <?php
    }
    
    $queryContNews = "SELECT count(*) AS number FROM news";
    $resCount = $db->query($queryContNews);
    $news = mysql_fetch_assoc($resCount);

    if($start > 0)
    {
        $start -= BlogConf::posts;
        ?>
        <a href="home.php?start=<?php print $start ?>"><?php print$_NEWS["prev"]." ".BlogConf::posts ?></a>
        <br />
        <?php
    }

    if($start + BlogConf::posts < $news[number])
    {
        $start += BlogConf::posts;
        ?>
        <a href="../modules/blog/home.php?start=<?php print $start ?>"><?php print$_NEWS["next"]." ".BlogConf::posts ?></a> <br />
        <?php
    }

    $pages = intval(($news[number]-1) / BlogConf::posts) + 1;
    for($i = 0; $i < $pages; $i++)
    {
        $start = $i * $pages;
        ?>
        <a href="../modules/blog/home.php?start=<?php print $start ?>"><?php print $i+1 ?></a> 
        <?php
    }

    HTMLstruct::footSimple();
?>
