<?php 
/**
 *   __ _  ___  ___ ___   ___   ___     ____ _ __ ___   ___
 *  / _` |/  / / __/ _ \ / _ \ /  /    / __/| '_ ` _ \ /  /
 * | (_| |\  \| (_| (_) | (_) |\  \   | (__ | | | | | |\  \
 *  \__,_|/__/ \___\___/ \___/ /__/    \___\|_| |_| |_|/__/
 * 
 * 
 ***********************************************************************************
 * @ASCOOS-NAME        : ASCOOS CMS 24'                                            *
 * @ASCOOS-VERSION     : 24.0.0                                                    *
 * @ASCOOS-CATEGORY    : Kernel (Frontend and Administration Side)                 *
 * @ASCOOS-CREATOR     : Drogidis Christos                                         *
 * @ASCOOS-SITE        : www.ascoos.com                                            *
 * @ASCOOS-LICENSE     : [Commercial] http://docs.ascoos.com/lics/ascoos/AGL.html  *
 * @ASCOOS-COPYRIGHT   : Copyright (c) 2007 - 2023, AlexSoft Software.             *
 ***********************************************************************************
 *
 * @package            : Ascoos Timezones Handler
 * @subpackage         : Core Class - Easter Handler file
 * @source             : /kernel/coreEaster.php
 * @version            : ** - $release: 1.0 - $revision: 0 - $build: ****
 * @created            : 2023-07-06 01:00:00 UTC+3
 * @updated            : 
 * @author             : Drogidis Christos
 * @authorSite         : www.alexsoft.gr
 */

namespace ASCOOS\CMS\KERNEL\CORE\Dates\Easter;

class TEasterHandler {

	/**
	 * We get the month and day of the Orthodox Easter for the years we ask.
	 * 
	 * @param	?int	$startyear 	It contains the initial calculation year. Four-digit number. Default = NULL
	 * @param	?int	$endyear	It contains the final year of calculation. Four-digit number. Default = NULL
	 * 
	 * @return	array	Returns a array containing in subarrays of years the month and day of Orthodox Easter.
	 */
	public final function getOrthodoxEasters(?int $startyear = null, ?int $endyear = null ): array
	{
		// If we do not give a calculation year, then we automatically select the current year.
		$startyear = (is_null($startyear)) ? (int) date('Y') : (int) $startyear;
		$endyear = (is_null($endyear)) ? $startyear : (int) $endyear;
		
		$years = $endyear - $startyear;
		
		$arr = array();
		
		for ($i=0; $i <= $years; $i++)
		{
			
			$year = $startyear + $i;
			
			// We calculate Orthodox Easter
			$easter = (19*($year%19)+16)%30+(2*($year%4)+4*($year%7)+6*((19*($year%19)+16)%30))%7+3;

			
			$arr[$year] = array();
			
			
			if ($easter > 30) {
				$arr[$year]['month'] = 5;
				$arr[$year]['day'] = $easter - 30;
			} else {
				$arr[$year]['month'] = 4;
				$arr[$year]['day'] = $easter;
			}
		}
		return $arr;
	}




    /**
     * We get the month and day of the Orthodox Easter for the year we ask.
     * 
     * @param ?int $year    It contains the calculation year. Four-digit number. Default = NULL
     * @return array        Returns a array containing in subarrays of years the month and day of Orthodox Easter.
     */
	public final function getOrthodoxEaster(?int $year = null): array
	{
		$year = (is_null($year)) ? (int) date('Y') : (int) $year;

		$nowyear = $this->getOrthodoxEasters($year);
		$arr = array();
		$arr['month'] = $nowyear[$year]['month'];
		$arr['day']   = $nowyear[$year]['day'];		
		return $arr;	
	}



	/**
	 * We get the month and day of the Orthodox Easter for the years we ask.
	 * 
	 * @param	?int	$startyear 	It contains the initial calculation year. Four-digit number. Default = NULL
	 * @param	?int	$endyear	It contains the final year of calculation. Four-digit number. Default = NULL
	 * 
	 * @return	string	Returns a string containing the date
	 */
	public function getDateEasters(?int $startyear = null, ?int $endyear = null): string {
		// If we do not give a calculation year, then we automatically select the current year.
		$startyear = (is_null($startyear)) ? (int) date('Y') : (int) $startyear;

		$text = '';
		
		if (is_null($endyear)) {
			$arr = $this->getOrthodoxEaster($startyear);
			$text .= $startyear.'/'.$arr['month'].'/'.$arr['day'];
		} else {
			$arr = $this->getOrthodoxEasters($startyear, $endyear);
			
			foreach ($arr as $k => $v) {
				$text .= '<p>'.$k.'/'.$arr[$k]['month'].'/'.$arr[$k]['day'].'</p>';
			}
		}
		return $text;
	}
}
?>
