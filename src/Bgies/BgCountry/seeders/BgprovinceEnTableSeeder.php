<?php

use Illuminate\Database\Seeder;

class BgprovinceTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('bgprovince')->delete();
        
		\DB::table('bgprovince')->insert(array (
			111 => 
			array (
				'id' => 612,
				'cty_id' => 40,
				'cty_code_2' => 'CA',
				'cty_code_3' => 'CAN',
				'prov_long_code' => 'CA-AB',
				'prov_short_code' => 'AB',
				'prov_short_name' => 'Alberta',
				'prov_long_name' => 'Alberta',
			),
			112 => 
			array (
				'id' => 613,
				'cty_id' => 40,
				'cty_code_2' => 'CA',
				'cty_code_3' => 'CAN',
				'prov_long_code' => 'CA-BC',
				'prov_short_code' => 'BC',
				'prov_short_name' => 'British Columbia',
				'prov_long_name' => 'British Columbia',
			),
			113 => 
			array (
				'id' => 614,
				'cty_id' => 40,
				'cty_code_2' => 'CA',
				'cty_code_3' => 'CAN',
				'prov_long_code' => 'CA-MB',
				'prov_short_code' => 'MB',
				'prov_short_name' => 'Manitoba',
				'prov_long_name' => 'Manitoba',
			),
			114 => 
			array (
				'id' => 615,
				'cty_id' => 40,
				'cty_code_2' => 'CA',
				'cty_code_3' => 'CAN',
				'prov_long_code' => 'CA-NB',
				'prov_short_code' => 'NB',
				'prov_short_name' => 'New Brunswick',
				'prov_long_name' => 'New Brunswick',
			),
			115 => 
			array (
				'id' => 616,
				'cty_id' => 40,
				'cty_code_2' => 'CA',
				'cty_code_3' => 'CAN',
				'prov_long_code' => 'CA-NL',
				'prov_short_code' => 'NL',
				'prov_short_name' => 'Newfoundland and Labrador',
				'prov_long_name' => 'Newfoundland and Labrador',
			),
			116 => 
			array (
				'id' => 617,
				'cty_id' => 40,
				'cty_code_2' => 'CA',
				'cty_code_3' => 'CAN',
				'prov_long_code' => 'CA-NT',
				'prov_short_code' => 'NT',
				'prov_short_name' => 'Northwest Territories',
				'prov_long_name' => 'Northwest Territories',
			),
			117 => 
			array (
				'id' => 618,
				'cty_id' => 40,
				'cty_code_2' => 'CA',
				'cty_code_3' => 'CAN',
				'prov_long_code' => 'CA-NS',
				'prov_short_code' => 'NS',
				'prov_short_name' => 'Nova Scotia',
				'prov_long_name' => 'Nova Scotia',
			),
			118 => 
			array (
				'id' => 619,
				'cty_id' => 40,
				'cty_code_2' => 'CA',
				'cty_code_3' => 'CAN',
				'prov_long_code' => 'CA-NU',
				'prov_short_code' => 'NU',
				'prov_short_name' => 'Nunavut',
				'prov_long_name' => 'Nunavut',
			),
			119 => 
			array (
				'id' => 620,
				'cty_id' => 40,
				'cty_code_2' => 'CA',
				'cty_code_3' => 'CAN',
				'prov_long_code' => 'CA-ON',
				'prov_short_code' => 'ON',
				'prov_short_name' => 'Ontario',
				'prov_long_name' => 'Ontario',
			),
			120 => 
			array (
				'id' => 621,
				'cty_id' => 40,
				'cty_code_2' => 'CA',
				'cty_code_3' => 'CAN',
				'prov_long_code' => 'CA-PE',
				'prov_short_code' => 'PE',
				'prov_short_name' => 'Prince Edward Island',
				'prov_long_name' => 'Prince Edward Island',
			),
			121 => 
			array (
				'id' => 622,
				'cty_id' => 40,
				'cty_code_2' => 'CA',
				'cty_code_3' => 'CAN',
				'prov_long_code' => 'CA-QC',
				'prov_short_code' => 'QC',
				'prov_short_name' => 'Quebec',
				'prov_long_name' => 'Quebec',
			),
			122 => 
			array (
				'id' => 623,
				'cty_id' => 40,
				'cty_code_2' => 'CA',
				'cty_code_3' => 'CAN',
				'prov_long_code' => 'CA-SK',
				'prov_short_code' => 'SK',
				'prov_short_name' => 'Saskatchewan',
				'prov_long_name' => 'Saskatchewan',
			),
			123 => 
			array (
				'id' => 624,
				'cty_id' => 40,
				'cty_code_2' => 'CA',
				'cty_code_3' => 'CAN',
				'prov_long_code' => 'CA-YT',
				'prov_short_code' => 'YT',
				'prov_short_name' => 'Yukon Territory',
				'prov_long_name' => 'Yukon Territory',
			),
		));
	}

}
