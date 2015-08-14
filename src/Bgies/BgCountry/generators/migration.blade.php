<?php echo '<?php' ?>

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class BgcountrySetupTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create country table
        Schema::create('{{ $countryTable }}', function (Blueprint $table) {
      		$table->increments('id');
  	 	   	$table->tinyInteger('cty_active')->default(1);
            $table->string('continent_code', 2);
            $table->string('continent_name', 20);
    			$table->string('cty_code_2', 2)->unique();
  	    		$table->string('cty_code_3', 3)->unique();
            $table->string('cty_short_name', 25)->unique();
            $table->string('cty_long_name', 100)->unique();
            
            $table->timestamps();
        });
 

        // Create country language table
        Schema::create('{{ $countryLanguageTable }}', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cty_id')->unsigned();
            $table->tinyInteger('ctl_active')->default(1);
            $table->string('ctl_language', 6)->default(1);
            $table->string('ctl_short_name', 25)->unique();
            $table->string('ctl_long_name', 100)->unique();
            $table->timestamps();
        });


        // Create province table
        Schema::create('{{ $provinceTable }}', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cty_id')->unsigned();
            $table->string('cty_code_2', 2);
            $table->string('cty_code_3', 3);
            
            $table->string('prov_long_code', 6)->unique();
            $table->string('prov_short_code', 3);
            $table->string('prov_short_name', 40);
            $table->string('prov_long_name', 100);


            $table->foreign('cty_id')->references('id')->on('{{ $countryTable }}');
            $table->foreign('cty_code_2')->references('cty_code_2')->on('{{ $countryTable }}');
            $table->foreign('cty_code_3')->references('cty_code_3')->on('{{ $countryTable }}');    

            $table->index(['cty_id']);
            $table->index(['cty_code_2']);
            $table->index(['cty_code_3']);
        });

 
        // Create province language table
        Schema::create('{{ $provinceLanguageTable }}', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('prov_id')->unsigned();
            
            $table->string('prl_language', 6);
            $table->string('prl_short_name', 40);
            $table->string('prl_long_name', 100);

            $table->foreign('prov_id')->references('id')->on('{{ $provinceTable }}');

            $table->index(['prov_id', 'prl_language']);
            $table->index(['prov_id']);
        });


        // Create table for cities
        Schema::create('{{ $cityTable }}', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('cty_id')->unsigned();
            $table->string('cty_code_2', 2);
            $table->string('cty_code_3', 3);
            
            $table->integer('prov_id')->unsigned();
            $table->string('prov_long_code', 6);
            $table->string('prov_short_code', 3);

            $table->string('city_name', 100);

            $table->string('city_metaphone', 60)->nullable();
            $table->string('pear_time_zone', 30)->nullable();
            $table->integer('utc_time_zone_offset')->nullable();
            $table->decimal('latitude', 8, 5)->nullable();
            $table->decimal('longitude', 8, 5)->nullable();

            $table->index(['cty_id', 'prov_id']);
            $table->index(['cty_code_2', 'prov_short_code']);
            $table->index(['cty_code_3', 'prov_short_code']);
            
            $table->timestamps();
            
            $table->foreign('cty_id')->references('id')->on('{{ $countryTable }}');
            $table->foreign('cty_code_2')->references('cty_code_2')->on('{{ $countryTable }}');
            $table->foreign('cty_code_3')->references('cty_code_3')->on('{{ $countryTable }}');

            $table->foreign('prov_id')->references('id')->on('{{ $provinceTable }}');
            $table->foreign('prov_long_code')->references('prov_long_code')->on('{{ $provinceTable }}');
                        
        });


 
        // Create table for city languages
        Schema::create('{{ $cityLanguageTable }}', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('city_id')->unsigned();

            $table->string('city_language', 6);
            $table->string('city_name', 100);

            $table->foreign('city_id')->references('id')->on('{{ $cityTable }}');

            $table->index(['city_id', 'city_language', 'city_name']);
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      if (Schema::hasTable('{{ $cityLanguageTable }}')) {
        Schema::drop('{{ $cityLanguageTable }}');
      }
      if (Schema::hasTable('{{ $cityTable }}')) {
        Schema::drop('{{ $cityTable }}');
      }
      if (Schema::hasTable('{{ $provinceLanguageTable }}')) {
        Schema::drop('{{ $provinceLanguageTable }}');
      }
      if (Schema::hasTable('{{ $provinceTable }}')) {  
        Schema::drop('{{ $provinceTable }}');
      }
      if (Schema::hasTable('{{ $countryLanguageTable }}')) {  
        Schema::drop('{{ $countryLanguageTable }}');
      }
      if (Schema::hasTable('{{ $countryTable }}')) {              
        Schema::drop('{{ $countryTable }}');
      }
    }
}
