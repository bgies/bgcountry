<?php namespace Bgies\BgCountry;


interface BgCountryInterface {

   public function getForm($elementWrapper, $country_code = '', $province_code = '', $city);
   
}