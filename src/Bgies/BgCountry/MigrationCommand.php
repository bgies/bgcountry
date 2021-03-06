<?php namespace Bgies\BgCountry;

/**
 * This file is part of BgCountry,
 * a package designed to make it easy to provide country, province and city dropdowns for Laravel.
 *
 * @license MIT
 * @package Bgies\BgCountry
 */

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\ Filesystem\Filesystem as fileSystem;

class MigrationCommand extends Command
{
	
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'bgcountry:migration';	
	
	
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'bgcountry:migration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a migration and seeders for BgCountry';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
    	$this->line('');
    	$this->info( "BgCountry MigrationCommand" );    	
    	
    	// this is called from a command so we need to add our namespace (to the src directory)
      $this->laravel->view->addNamespace('bgcountry', substr(__DIR__, 0) );

      $countryTable         =  'bgcountry';
      $countryLanguageTable = 'bgcountry_lang';
        
      $provinceTable         = 'bgprovince';
      $provinceLanguageTable = 'bgprovince_lang';
        
      $cityTable          = 'bgcity';
      $cityLanguageTable  = 'bgcity_lang';
 
      $this->line('');
      $this->info( "Tables: $countryTable, $countryLanguageTable, $provinceTable, $provinceLanguageTable, $cityTable, $cityLanguageTable" );

      $message = "A migration that creates '$countryTable', '$countryLanguageTable', '$provinceTable', '$provinceLanguageTable', '$cityTable', '$cityLanguageTable'".
        " tables will be created in database/migrations directory";

      $this->comment($message);
      $this->line('');

      $defaultLocale = $this->choice('Enter the number of the default locale (<enter> for en) : ', ['de', 'en', 'es', 'fr', 'ja', 'pt-br', 'ru', 'zh-cn'], 1, 3, false);
      $this->line('');
      if (!$this->confirm("You have chosen " . $defaultLocale . ". Proceed with the migration creation? [Yes|no]", "Yes")) {
      	$this->line('');
      	$this->info('User aborted migration... ');
      	return;
      }
      
      $this->info("Creating migration...");
          
      if ($this->createMigration($defaultLocale, $countryTable, $countryLanguageTable, $provinceTable, $provinceLanguageTable, $cityTable, $cityLanguageTable)) {
         $this->info("Migration successfully created!");
         
      } else {
         $this->error(
           "Couldn't create migration.\n Check the write permissions".
           " within the database/migrations directory."
         );
      }

      $this->line('');
    }

    /**
     * Create the migration.
     *
     * @param string $name
     *
     * @return bool
     */
    protected function createMigration($defaultLocale, $countryTable, $countryLanguageTable, $provinceTable, $provinceLanguageTable, $cityTable, $cityLanguageTable)
    {
        $migrationFile = base_path("/database/migrations")."/".date('Y_m_d_His')."_bgcountry_setup_tables.php";

        $data = [
        		'defaultLocale' => $defaultLocale,
        		'countryTable' => $countryTable,
        		'countryLanguageTable' => $countryLanguageTable,
        		'provinceTable' => $provinceTable,
        		'provinceLanguageTable' => $provinceLanguageTable,
        		'cityTable' => $cityTable,
        		'cityLanguageTable' => $cityLanguageTable
        ];
        // Generate the Migration
        $output = $this->laravel->view->make('bgcountry::generators.migration')->with($data)->render();
        
        if (!file_exists($migrationFile) && $fs = fopen($migrationFile, 'x')) {
            fwrite($fs, $output);
            fclose($fs);
            
            // publish the default locale Country Seeder
            $seederPath = __DIR__.'/seeders/Bgcountry' . studly_case($defaultLocale) . 'TableSeeder.php';
            $seederOutput = \File::get($seederPath);
            $seederFile = base_path("/database/seeds")."/BgcountryTableSeeder.php";
            if (!file_exists($seederFile) && $fs = fopen($seederFile, 'x')) {
            	fwrite($fs, $output);
            	fclose($fs);
            	$this->line('');
            	$this->info("Seed file " . $seederFile . " created in database/seeds directory. ");
            	return true;
            }
            
            $this->info("Seed file " . $seederFile . " exists. Cannot overwrite...");
            return false;
        }

		  $this->info("Migration File " . $$migrationFile . " exists. Cannot overwrite...");            		
        return false;
    }
}
