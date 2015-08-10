<?php namespace Bgies\BgCountry;

use App\Http\Controllers\Controller;
use Illuminate\Config\Repository;
use Illuminate\Database\DatabaseManager as DB;

class BgCountryController extends Controller {

   /**
    * Config repository.
    *
    * @var \Illuminate\Config\Repository
    */
   protected $configRepository;

   /**
    * Current locale
    *
    * @var string
    */
   protected $currentLocale = null;
   protected $defaultLocale = false; 
   protected $topdirectory = ''; 
   protected $db = null;
   protected $country_codes_length = 3;
   protected $use_short_country_names = true;
   protected $use_province_short_code = true;
   protected $use_province_short_name = true;
   protected $add_blank_to_lists = true;
   
   
   public function __construct(Db $db)
   {
   	$this->db = $db;
      $this->app = app();
      
      $this->currentLocale = $this->app->getLocale(); 

      $this->configRepository = $this->app[ 'config' ];
      $this->defaultLocale = $this->configRepository->get('app.fallback_locale');
      $this->country_codes_length = $this->configRepository->get('bgcountry.country_codes_length');
      $this->use_short_country_names = $this->configRepository->get('bgcountry.use_short_country_names');
      $this->use_province_short_code = $this->configRepository->get('bgcountry.use_province_short_code');
      $this->use_province_short_name = $this->configRepository->get('bgcountry.use_province_short_name');
      $this->add_blank_to_lists = $this->configRepository->get('bgcountry.add_blank_to_lists');
  }

	private function getDefaultCountryList() {
  		$countryCodes = ($this->country_codes_length == 3 ? \Cache::get('bgcountry_country_3') : \Cache::get('bgcountry_country_2'));
  		if (!$countryCodes) {
  			$countryCodes = $this->db->table('bgcountry')->lists(
  				($this->use_short_country_names ? 'cty_long_name' : 'cty_short_name'),
  				($this->country_codes_length != 3 ? 'cty_code_2' : 'cty_code_3')
  			);
           			
  			($this->country_codes_length == 3 ? \Cache::forever('bgcountry_country_3', $countryCodes) : \Cache::forever('bgcountry_country_2', $countryCodes));
  			
  		};
  	 	return $countryCodes;
	}
  
  	private function getDefaultProvinceList($country_code) {
  		$provinceCodes = ($this->use_province_short_code ? \Cache::get('bgcountry_province_' . $country_code . 'short') : \Cache::get('bgcountry_province_' . $country_code . 'long'));
  		if (!$provinceCodes) {
  			$provinceCodes = $this->db->table('bgprovince')
  				->where( (strlen($country_code) == 2 ? 'cty_code_2' : 'cty_code_3'), '=', $country_code)
  				->lists(
  					($this->use_province_short_name ? 'prov_short_name' : 'prov_long_name'),
  					($this->use_province_short_code ? 'prov_short_code' : 'prov_long_code')
  			);
  				
  			($this->use_province_short_code ? \Cache::forever('bgcountry_province_' . $country_code . 'short', $provinceCodes) : \Cache::forever('bgcountry_province_' . $country_code . 'long', $provinceCodes));
  				
  		};
  		return $provinceCodes;
  	}
  	
  	
  	private function getDefaultCityList($country_code, $province_code) {
  		$cityCodes = \Cache::get('bgcountry_city_' . $country_code . '_' . $province_code);
  		if (!$cityCodes) {
  			$cityCodes = $this->db->table('bgcity')
  				->where( (strlen($country_code) == 2 ? 'cty_code_2' : 'cty_code_3'), '=', $country_code)
  				->where( (strlen($province_code) < 4 ? 'prov_short_code' : 'prov_long_code'), '=', $province_code)
  				->lists('city_name', 'id');
  	
  			\Cache::forever('bgcountry_city_' . $country_code . '_' . $province_code, $cityCodes);

  	
  		};
  		return $cityCodes;
  	}
  	 

  	/* Most of the following functions was lifted directly from the Laravel 4 HTML Form Builder
  	 * code. Thanks Laravel (and Taylor). 
  	 */
  	protected function getSelectedValue($value, $selected)
  	{
  		if (is_array($selected))
  		{
  			return in_array($value, $selected) ? 'selected' : null;
  		}
  	
  		return ((string) $value == (string) $selected) ? 'selected="selected"' : null;
  	}
  	 
  	 protected function optionGroup($list, $label, $selected)
  	 {
  	 	$html = array();
  	 
  	 	foreach ($list as $value => $display)
  	 	{
  	 		$html[] = $this->option($display, $value, $selected);
  	 	}
  	 
  	 	return '<optgroup label="'.e($label).'">'.implode('', $html).'</optgroup>';
  	 }
  	 
  	 protected function option($display, $value, $selected)
  	 {
  	 	$selected = $this->getSelectedValue($value, $selected);
  	 
  	 	return '<option value="' . e($value) .'" ' . $selected . '>'.e($display).'</option>';
  	 }
  	 
  	private function getSelectOption($display, $value, $selected) {
  		if (is_array($display))
  		{
  			return $this->optionGroup($display, $value, $selected);
  		}
  	
  		return $this->option($display, $value, $selected);
  	}
  	 
  	
  	private function getSelectList($list, $selected) {
  		$html = array();  		
  		foreach ($list as $value => $display)
  		{
  			$html[] = $this->getSelectOption($display, $value, $selected);
  		}
  		
		return $html;  		
  		
  	}
  
	public function getDefaultForm($country_code = '', $province_code = '', $city = '') {
  		$countryCodes = $this->getDefaultCountryList();
  		$provinceCodes = array();
  		$cities = array();
  		if (isset($country_code) && $country_code != '') {
			$provinceCodes = $this->getDefaultProvinceList($country_code);
			if (isset($province_code) && $province_code != '') {
  				$cities = $this->getDefaultCityList($country_code, $province_code);
			}
  		}
  		// add blank to beginning and convert to string
		$countryOptions = '<option value=""></option>' . implode('', $this->getSelectList($countryCodes, $country_code));
		$provinceOptions = '<option value=""></option>' . implode('', $this->getSelectList($provinceCodes, $province_code));
		$cityOptions = '<option value=""></option>' . implode('', $this->getSelectList($cities, $city));
		
  		return view('bgcountry::country')
  			->with('countrycodes', $countryOptions)
  			->with('country_code', $country_code)
  			->with('provincecodes', $provinceOptions)
  			->with('province_code', $province_code)
  			->with('citycodes', $cityOptions)
  			->with('city', $city);  	
  }
  
  public function getMultiLanguageForm($country_code, $province_code, $city) {
  	
  	
  }
  
  
  public function getAdmin() {
  	  	$country_languages =	$this->db->table('bgcountry_language');  	
  	
  	
  		return view('bgcountry::admin');
  	
  	
  }
  
  public function createMigration() {
  	
  	
  	  \Artisan::call('bgcountry:migration');
  	  
  	  
  	  
  	
  }
  
  	public function getCountries() {
  		$countries = $this->getDefaultCountryList();
  		$countryOptions = '<option value=""></option>' . implode('', $this->getSelectList($countries, ''));  		
		return $countryOptions;  		
  	}
}