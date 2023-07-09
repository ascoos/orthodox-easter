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
 * @package            : Ascoos  - Orthodox Easter
 * @subpackage         : Core Class - Easter Handler file
 * @source             : /OrthodoxEaster/src/kernel/coreEaster.php
 * @version            : ** - $release: 1.0 - $revision: 0 - $build: ****
 * @created            : 2023-07-06 01:00:00 UTC+3
 * @updated            : 2023-07-09 01:00:00 UTC+3
 * @author             : Drogidis Christos
 * @authorSite         : www.alexsoft.gr
 * 
 * @since >= PHP 8.1
 */

namespace ASCOOS\CMS\KERNEL\CORE\Dates\Easter;

/**
 * @class TEasterHandler extends TObjects
 * @requires	PHP >= 8.1
 * @since 1.0.1
 *   
 * @property 		array 	$easterDates			It property contains the aaray with easter dates
 * @property int 	$startYear						contains the First Year
 * @property int 	$endYear						ontains the End Year
 * 
 * @method public	void  	__construct()
 * @method private	array  	getOrthodoxEasters()	We get the month and day of the Orthodox Easter for the years we ask.
 * @method private	array  	getOrthodoxEaster()		We get the month and day of the Orthodox Easter for the year we ask.
 * @method public	string 	getDateEasters()		We get the month and day of the Orthodox Easter for the years we ask.
 * @method public	string 	getHtmlSelect()			This function creates an dropdown select for easters.
 * @method private	void 	setEasterArray()		Set array with Easter dates celebrates
 * 
 */
class TEasterHandler {

	/**
	 * contains the array with easter dates
	 * @since 1.0.1 
	 */
	private array 	$easterDates = [];
	
	/**
	 * contains the First Year
	 * @since 1.0.1 
	 */
	private int		$startYear;
	
	/**
	 * ontains the Last Year
	 * @since 1.0.1 
	 */
	private	int		$endYear;


	/**
	 * 
     * @access  public
	 * 
	 * @since 1.0.1
	 */
	public function __construct(?int $startyear = null, ?int $endyear = null) {
		// If we do not give a calculation year, then we automatically select the current year.
		$this->startYear = (is_null($startyear)) ? (int) date('Y') : (int) $startyear;
		$this->endYear  = (is_null($endyear)) ? $this->startYear : (int) $endyear;

		// Input easter dates in internal array easterDates.
		$this->setEasterArray();
	}



	/**
	 * We get the month and day of the Orthodox Easter for the years we ask.
	 * 
	 * @access	private
	 * 
	 * @param	?int	$startyear 	It contains the initial calculation year. Four-digit number. Default = NULL
	 * @param	?int	$endyear	It contains the final year of calculation. Four-digit number. Default = NULL
	 * 
	 * @return	array	Returns a array containing in subarrays of years the month and day of Orthodox Easter.
	 * 
	 * @since 1.0.0
	 */
	private function getOrthodoxEasters(?int $startyear = null, ?int $endyear = null ): array
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
	 * @access	private
     * 
     * @param ?int $year    It contains the calculation year. Four-digit number. Default = NULL
     * @return array        Returns a array containing in subarrays of years the month and day of Orthodox Easter.
	 * 
	 * @since 1.0.0
     */
	private function getOrthodoxEaster(?int $year = null): array
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
	 * @final
     * @access  public
	 * 
	 * @param	?int	$startyear 	It contains the initial calculation year. Four-digit number. Default = NULL
	 * @param	?int	$endyear	It contains the final year of calculation. Four-digit number. Default = NULL
	 * 
	 * @return	string	Returns a string containing the date
	 * 
	 * @since 1.0.0
	 */
	public final function getDateEasters(?int $startyear = null, ?int $endyear = null): string {
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



    /**
     * This function creates an dropdown select for easters.
     * 
	 * @final
     * @access  public
	 * 
     * @param   string  $selectID   Contains the ID of the Select List.
     * @param   ?array  $params     This array contains several additional parameters such as the name of the CSS class, etc.
     * @param   ?string $selected   The default easter date.
     * 
     * @return string  	Returns an HTML dropdown Select, which implements the orthodox easter selection. 
	 * 					The price of each option is in the form of e.g. 2023/4/16
	 * @since 1.0.1
     */
    public final function getHtmlSelect(?string $selectID = null, ?array $params = null, ?string $selected = null): string 
    {        
        if (is_null($selectID)) $selectID = 'easter-select';
        
		/**
		 * If parameters have been set, such as a css class, a data-role etc, 
		 * then we pass them as a string to the select tag via the $extra temporary variable.
		 */
        $extra = (!is_null($params) && is_array($params)) ? ' '.implode(' ', $params) : '';
        
        $default = (is_null($selected)) ? date('Y'): $selected;

        $text = '<select id="'.$selectID.'"'.$extra.'>';
        unset($extra);

        //
        foreach ($this->easterDates as $key => $value) {
            $seltxt = ($default === $value) ? ' selected' : '';
            $text .= '<option value="'.$value.'"'.$seltxt.'>'.$value.'</option>';
        }
        $text .= '</select>'.PHP_EOL;
        
        // We free memory from variables that are no longer needed.
        unset($default);
        unset($seltxt);
        
        return $text;        
    } 	



	/**
	 * Set array with Easter dates celebrates
	 * 
	 * @since 1.0.1
	 */
	private function setEasterArray() {
		$arr = $this->getOrthodoxEasters($this->startYear, $this->endYear);
			
		foreach ($arr as $k => $v) {
			$date = strtotime($k.'-'.$arr[$k]['month'].'-'.$arr[$k]['day']);
			$this->easterDates[$date] = $k.'-'.$arr[$k]['month'].'-'.$arr[$k]['day'];
		}
	}	
}
?>
