<?php

return array(
		/* We recommend using 3 digit ISO-3166 country codes, but many companies are already 
		 * locked into 2 digit codes, so you can change it to 2 digit ISO-3166 country codes 
		 * if if you really need to
		 * NOTE - you will have both the 2 and the 3 digit codes in your database, so it is 
		 * possible to use both in different queries if you need to. 
		 */
      'country_codes_length'	=> 3,
		/* The country short names are 25 characters so should be enough for most use cases. 
		 * You can change it to false to use the Long names (up to 100 characters) 
		 */
		'use_short_country_names'	=> true,
		/* Province Codes Length. You will almost always want the short code,
		 * but we also have the long code if you want it. The Short code is 
		 * 2 or 3 digits, while the long code is normally just the 2 digit 
		 * country code with a dash followed by the short code
		 */
		'use_province_short_code'	=> true,
		/* The short version of the province name is almost always sufficient
		 * (it's up to 40 characters), but if you really want the long version 
		 * (up to 100 characters), you can change it.
		 */
		'use_province_short_name'	=> true,
		/* Which value do you want for the city. The city name will always
		 * be displayed, and normally you will want the same as the value,
		 * but you can use any field in the bgcity database table IE id 
		 */
		'city_value_field'	=> 'city_name',
		/* Normally you will want to add a blank entry as the first entry
		 * of the country, province and city select
		 */
		'add_blank_to_lists'	=> true,
		
		/* Names for the database tables 
		 * Note that you need to change these BEFORE you do the migrations,
		 * and you can't change them after unless you rollback the migration first.
		 */
		'countryTable' => 'bgcountry',
		'countryLanguageTable' => 'bgcountry_lang',
		
		'provinceTable' => 'bgprovince',
		'provinceLanguageTable' => 'bgprovince_lang',
		
		'cityTable' => 'bgcity',
		'cityLanguageTable'  => 'bgcity_lang'		
		
);