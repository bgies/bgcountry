<?php namespace Bgies\BgCountry;

class BgCountryFacade extends \Illuminate\Support\Facades\Facade
{
   /**
    * Get the registered name of the component.
    *
    * @return string
    */
   protected static function getFacadeAccessor()
   {
      return 'Bgies\BgCountry\BgCountryController';
   }
}