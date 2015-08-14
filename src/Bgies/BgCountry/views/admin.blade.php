<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Bgies BgCountry</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
    
  </head>
   <body style="max-width: 1200px; min-width: 600px; margin: 5px auto; border: 1px solid #cccccc">
      <div class="container">
         <div style="text-align: center">
            <h2>Bg Country Admin</h2>
         </div>
         <div class="row">
            <div class="col-xs-6 col-sm-3">
               <h4>Installed Languages</h4>
               <ul class="list-unstyled">
                  @foreach ($installedlanguage as $language)
                  
                  
                  @endforeach   
               
               
               
               </ul>
            </div>
            <div class="col-xs-6 col-sm-3">
               <div class="">Enabled Languages</div>
            
            </div>         
         
         
         
         </div>
         <div class="row">
            <div class="col-xs-6 col-sm-3">
               <h4>Enable/Disable Countries</h4>
               <table class="table table-hover table-bordered">
                  <thead>
                     <tr>
                        <td>Enabled</td>
                        <td>Country</td>
                        <td>View Provinces</td>
                     </tr>
                     <tr>
                        <td><input id="country-toggle-all" type="checkbox" /></td>
                        <td><button id="country-save-button" type="button" class="btn btn-primary">Save</button></td>
                        
                     </tr>
                 </thead>
               @foreach($countries as $country)
                  <tr class="{!! ($country->cty_active == 1 ? 'success' : 'warning')  !!}">
                     <td><input name="county_{!! $country->id !!}" class="country-enable"  type="checkbox" {!! ($country->cty_active == 1 ? 'checked="checked"' : '')  !!} /></td>
                     <td>{!! $country->cty_short_name !!}</td>
                     <td><input class="view-province-button" data-url="{!! route('bgprovince.locale', array( )) !!} " data-country="{!! ($country_codes_length == 3 ? $country->cty_code_3 : $country->cty_code_2) !!}" type="button" value="View" /></td>
                                  
               
                  </tr>
               
               @endforeach
               
               </table>
               
         
            </div>
            <div class="col-xs-1 col-sm-1"></div>
            <div class="col-xs-1 col-sm-1">
               <h4>Provinces</h4>
            
            
            
            </div>
         
         
         </div>
      
      
      
      
      </div>
      
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
      
   <script type="text/javascript">
      $( document ).ready(function() {
            
         jQuery('.country-enable').off('click').on('click', function(ev) {
        	   var enabled = jQuery(this).prop('checked'); 
            if (enabled) {
                
               jQuery( this ).parent().parent().removeClass("warning" ).addClass("success" ); 
            } else {
               jQuery( this ).parent().parent().addClass("warning" ).removeClass("success" );
            }
         });   

         jQuery('#country-toggle-all').off('click').on('click', function(ev) {
            var enabled = jQuery(this).prop('checked');
            jQuery('.country-enable').each(function(index) {
            	jQuery(this).prop('checked', enabled);
               if (enabled) {
            	   jQuery( this ).parent().parent().removeClass("warning" ).addClass("success" ); 
               } else {
                  jQuery( this ).parent().parent().addClass("warning" ).removeClass("success" );
               }
               
            });
         });

         
         jQuery('#country-save-button').off('click').on('click', function(ev) {
            alert('save checked'); 
             
         });

         jQuery('.view-province-button').off('click').on('click', function(ev) {
             var selCountry = jQuery(this).attr('data-country');
             
             alert('save checked'); 
              
          });

         
            
      });   
   </script>
         
      
      
   </body>
</html>