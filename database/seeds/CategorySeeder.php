<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category_array=[
        	["name"=>"Phones & Tablets",'zh'=>"手机和平板电脑"],
        	["name"=>"Phone Accessories",'zh'=>"手机配件"],
        	["name"=>"Phone Numbers",'zh'=>"电话号码"],
        	["name"=>"Computers",'zh'=>"电脑"],
        	['name'=>'Computer accessories','zh'=>'电脑配件'],
        	['name'=>'Softwares','zh'=>'软件'],
        	['name'=>'Electronics & Appliances','zh'=>'电子电器'],
        	['name'=>'Cars for Sale','zh'=>'汽车出售'],
        	['name'=>'Motorcycles for Sale','zh'=>"摩托车出售"],
        	['name'=>'Vehicles for Rent','zh'=>"汽车出租"],
        	['name'=>"Car Maintenance and Repair",'zh'=>'汽车修护及保养'],
        	['name'=>'Lorries and Vans','zh'=>'卡车和货车'],
        	['name'=>'Financing and Insurance','zh'=>'金融及保险'],
        	['name'=>'Car Parts and Accessories','zh'=>'汽车配件及相关产品'],
        	['name'=>'House and Lands','zh'=>'房子和土地'],
        	['name'=>'Job Recruiter','zh'=>'招聘人员'],
        	['name'=>'Job Seeker','zh'=>'求职者'],
        	['name'=>'Jewelry and watches','zh'=>'珠宝和手表'],
        	['name'=>'Clothing and accessories','zh'=>'服饰'],
        	['name'=>'Beauty and Healthcare','zh'=>'美容及保健'],
        	['name'=>'Books, Sports and Hobbies','zh'=>'体育和爱好'],
        	['name'=>'Furniture and Décor','zh'=>'家具与装饰'],
		];
		foreach ($category_array as $key => $value) {
			$category=new Category();
			$category->cate_en_name=$value['name'];
			$category->cate_zh_name=$value['zh'];
			$category->save();
			$category->cate_slug=$category->id.'-'.str_slug($value['name']);
			$category->save();
		}
    }
}
