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

    $queryInstall = "CREATE TABLE news
                     (
                         id       INT(5) not null AUTO_INCREMENT PRIMARY KEY,
                         title    VARCHAR(40) not null,
                         text     TEXT not null,
                         author   VARCHAR(15) not null,
                         email    VARCHAR(30),
                         date     DATETIME not null
                     )";

    $queryInstall1 = "CREATE TABLE comments
                      (
                          id       INT(5) not null AUTO_INCREMENT PRIMARY KEY,
                          idNews   INT(5) not null,
                          author   VARCHAR(15) not null,
                          text     TEXT not null,
                          date     DATETIME not null,
                          email    VARCHAR(30) not null
                      )";


    $queryInstall2 = "INSERT INTO news
                                  (
                                      title, 
                                      text, 
                                      author, 
                                      email, 
                                      date
                                  ) 
                                  VALUES
                                  (
                                      '".$_MESSAGES["instTitle"]."',
                                      '".$_MESSAGES["instMess"]."', 
                                      'alkz', 
                                      'alkz.0x80@gmail.com', 
                                      NOW()
                                  )";

    $queryInstall3 = "INSERT INTO sections
                                  (
                                      type,
                                      name
                                  )
                                  VALUES
                                  (
                                      1,
                                      '".BlogConf::name."'
                                  )"; 

    $queryInstall4 = "INSERT INTO modules
                                  (
                                      dir,
                                      name
                                  ) 
                                  VALUES
                                  (
                                      'blog',
                                      '".BlogConf::name."'
                                  )"; 

    $db = new JPCdb(DBInfo::host, DBInfo::name, DBInfo::user, DBInfo::pwd);
    $db->query($queryInstall);
    $db->query($queryInstall1);
    $db->query($queryInstall2);
    $db->query($queryInstall3);
    $db->query($queryInstall4);
    $db->close();

    print $_MESSAGES["blogInstall"]."<br />";
    print $_MESSAGES["wait"]."<br />";
    Functions::redirect("../../index.php", 5);

    HTMLstruct::footSimple();
?>
