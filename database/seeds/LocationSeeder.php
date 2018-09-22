<?php

use Illuminate\Database\Seeder;
use App\Location;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $location_array=[
        	['name'=>"Banlung",'zh'=>"邦隆"],
        	['name'=>"Banteay Meanchey",'zh'=>"卜迭棉芷"],
        	['name'=>"Battambang","zh"=>"马德望"],
        	['name'=>"Bavet","zh"=>"巴域"],
        	['name'=>"Kampong Cham",'zh'=>"磅湛"],
        	['name'=>"Kampong Chhnang",'zh'=>"磅清扬"],
        	['name'=>"Kampong Speu",'zh'=>"实居"],
        	['name'=>"Kampong Thom",'zh'=>"磅通"],
        	['name'=>"Kampot",'zh'=>"贡布"],
        	['name'=>"Kandal","zh"=>"干拉"],
        	['name'=>"Kep",'zh'=>"白马"],
        	['name'=>"Koh Kong",'zh'=>"国公"],
        	['name'=>"Kratie",'zh'=>"桔井"],
        	['name'=>"Mondulkiri",'zh'=>"蒙多基里"],
        	['name'=>"Oddor Meanchey",'zh'=>"奥多棉芷"],
        	['name'=>"Pailin",'zh'=>"拜林"],
        	['name'=>"Phnom Penh",'zh'=>"金边"],
        	['name'=>"Poipet",'zh'=>"波贝"],
        	['name'=>"Preah Sihanouk",'zh'=>"西哈努克"],
        	['name'=>"Preah Vihear",'zh'=>"柏威夏"],
        	['name'=>"Prey Veng",'zh'=>"波萝勉"],
        	['name'=>"Provinces",'zh'=>"省份"],
        	['name'=>"Pursat",'zh'=>"菩萨"],
        	['name'=>"Rattanakiri",'zh'=>"拉达那基里"],
        	['name'=>"Siem Reap","zh"=>"暹粒"],
        	['name'=>"Sre Ambel",'zh'=>"盐田"],
        	['name'=>"Stung Treng",'zh'=>"上丁"],
        	['name'=>"Svay Rieng",'zh'=>"柴桢"],
        	['name'=>"Takeo",'zh'=>"茶胶"],
        	['name'=>"Takhmao",'zh'=>"大金欧"],
        	['name'=>"Tboung Khmum",'zh'=>"特本克蒙"]
        ];
        foreach ($location_array as $key => $value) {
        	$location=new Location();
        	$location->l_en_name=$value['name'];
        	$location->l_zh_name=$value['zh'];
        	$location->save();
        	$location->l_slug=$location->id.'-'.str_slug($value['name']);
        	$location->save();
        }
    }
}
