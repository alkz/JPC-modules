<?php

 /********************************************************************  
 *                        JPC(Jargon PHP CMS)                        * 
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

    require_once("../include/struct.inc.php");
    HTMLstruct::top();

    require_once("../modules/blog/config.inc.php");
    require_once("../modules/blog/langs/".BlogConf::language.".inc.php");

    ?>

    <a href="../modules/blog/formNews.php?op=m"><?php print $_MENU["post"] ?></a>

    <?php

    HTMLstruct::footSimple();
?>



