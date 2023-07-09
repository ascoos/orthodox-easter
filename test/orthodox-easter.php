<?php 
/**
 *   __ _  ___  ___ ___   ___   ___     ____ _ __ ___   ___
 *  / _` |/  / / __/ _ \ / _ \ /  /    / __/| '_ ` _ \ /  /
 * | (_| |\  \| (_| (_) | (_) |\  \   | (__ | | | | | |\  \
 *  \__,_|/__/ \___\___/ \___/ /__/    \___\|_| |_| |_|/__/
 * 
  *************************************************************************************
 * @ASCOOS-NAME        : ASCOOS CMS 24'                                              *
 * @ASCOOS-VERSION     : 24.0.0                                                      *
 * @ASCOOS-CATEGORY    : Kernel (Frontend and Administration Side)                   *
 * @ASCOOS-CREATOR     : Drogidis Christos                                           *
 * @ASCOOS-SITE        : www.ascoos.com                                              *
 * @ASCOOS-LICENSE     : [Commercial] http://docs.ascoos.com/lics/ascoos/AGL-F.html  *
 * @ASCOOS-COPYRIGHT   : Copyright (c) 2007 - 2023, AlexSoft Software.               *
 *************************************************************************************
 *
 * @package            : ASCOOS CMS - Orthodox Easter
 * @subpackage         : Example for Orthodox Easter
 * @source             : /OrthodoxEaster/src/test/orthodox-easter.php
 * @version            : **** - $release: 1.0 - $revision: 1 - $build: ****
 * @created            : 2023-07-07 07:00:00 UTC+3
 * @updated            : 2023-07-09 01:00:00 UTC+3
 * @author             : Drogidis Christos
 * @authorSite         : www.alexsoft.gr
 * 
 * @since 1.0.1
 */

define('ALEXSOFT_RUN_CMS', true);

$cms_path = str_replace('/OrthodoxEaster/test', '',str_replace('\\', '/', __DIR__));

require_once($cms_path."/OrthodoxEaster/src/kernel/coreEaster.php");



$yearStart = 2024;
$yearEnd = 2050;

$params = [
  'class="default"', 
  'data-role="easters"'
];

$objEaster = new \ASCOOS\CMS\KERNEL\CORE\Dates\Easter\TEasterHandler($yearStart, $yearEnd);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>ASCOOS - Test Orthodox Easter</title>
    
    <link rel="icon" href="favicon.ico" />
  </head>

  <body>
    <!-- Orthodox Easter of current year -->
    <div>
      <p><b><?php echo 'Orthodox Easter of current year :</b> '.$objEaster->getDateEasters(); ?></p>
    </div> 
    <hr>    
    <!-- Orthodox Easter of year... -->
    <div>
      <p><b>Orthodox Easter of year <?php echo $yearStart; ?>:</b> <?php echo $objEaster->getDateEasters($yearStart); ?></p>
    </div>   
    <hr>    
    
    <!-- Orthodox Easter HTML Select list -->
    <div>
      <form>
        <label for="easters"><b>Choose a Orthodox Easter:</b></label>
        <?php 
          echo $objEaster->getHtmlSelect('easters', $params); 
          ?>
      </form>
    </div>
    <hr>
    <!-- Orthodox Easter in a period of years -->
    <div>
      <p><b><?php echo 'Orthodox Easter of years '.$yearStart.' - '.$yearEnd; ?>: </b></p>
      <?php echo $objEaster->getDateEasters($yearStart, $yearEnd); ?>
    </div>

  </body>
</html>
