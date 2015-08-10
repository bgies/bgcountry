

<link href="{{ URL::asset('css/bgcountry.css') }}" rel="stylesheet">  




<div class="bgc-row">
     <div class="form-group col-sm-12 bgc-text-right">
         <label class="col-sm-4" for="country_code">Country</label>
         <div class="col-sm-8">
            <select name="country_code" data-url="http://extension.local:8000/lookups/country/countrycodes.selectoptions.txt" class="form-control input-sm bgc-country-sel">
               {!! $countrycodes !!}
            </select>
            <input type="text" name="country_text" class="form-control input-sm bgc-country-text bgc-no-display">
         </div>
     </div>

     <div class="form-group col-sm-12 ">
        <div class="bgc-text-right">
           <label class="col-sm-4" for="province_code">State</label>
        </div>
        <div class="col-sm-8">
           <select name="province_code" data-url="http://extension.local:8000/lookups/province/province.select.{bgc-country}.txt" class="form-control input-sm bgc-province-sel">
               {!! $provincecodes !!}
           </select>
           <input type="text" name="province_text" class="form-control input-sm bgc-province-text bgc-no-display">
           <div id="city-text-instructions" class="bgc-no-display">Please type the name of the province/state</div>           
           
        </div>
     </div>

     <div class="form-group  col-sm-12">
        <div class="bgc-text-right">
           <label class="col-sm-4" for="city">City</label>
        </div>
        <div class="col-sm-8">
           <select name="city" class="form-control input-sm bgc-city-sel" data-url="http://extension.local:8000/lookups/provincecity/city.select.{bgc-country}.{bgc-province}.txt">
               {!! $citycodes !!}
           </select>
           <input type="text" name="city_text" id="city_text" class="form-control input-sm bgc-city-text bgc-no-display">
           <div id="city-text-instructions" class="bgc-no-display">Please type the name of the city</div>
        </div>
     </div>

</div>





