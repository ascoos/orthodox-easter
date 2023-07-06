<?php 
/**
 *   __ _  ___  ___ ___   ___   ___     ____ _ __ ___   ___
 *  / _` |/  / / __/ _ \ / _ \ /  /    / __/| '_ ` _ \ /  /
 * | (_| |\  \| (_| (_) | (_) |\  \   | (__ | | | | | |\  \
 *  \__,_|/__/ \___\___/ \___/ /__/    \___\|_| |_| |_|/__/
 * 
 */
require_once('..\kernel\coreEaster.php');

$objEaster = new \ASCOOS\CMS\KERNEL\CORE\Dates\Easter\TEasterHandler();

$yearStart = 2024;
$yearEnd = 2050;
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
    <div><?php echo '<p><strong>Orthodox Easter of current year :</strong> '.$objEaster->getDateEasters().'</p>'; ?></div> 
    <div><?php echo '<p><strong>Orthodox Easter of year '.$yearStart.':</strong> '.$objEaster->getDateEasters($yearStart).'</p>'; ?></div>   
    <div><?php echo '<br><br><p><strong>Orthodox Easter of years '.$yearStart.' - '.$yearEnd.':</strong></p>'.$objEaster->getDateEasters($yearStart, $yearEnd); ?></div>    
  </body>
</html>
