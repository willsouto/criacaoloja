<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'name' => 'Sofas',
                'id' => '177',
            ],
            [
                'name' => 'Guarda-roupas',
                'id' => '201',
            ],
            [
                'name' => 'Racks',
                'id' => '2322',
            ],
            [
            'name' => 'Paineis',
            'id' => '2323',
            ]

        ]);
        DB::table('product_caracteristics')->insert([
            [
                'color' => 'Preto',
            ],
            [
                'color' => 'Branco',
            ],
            [
                'color' => 'Marrom',
            ]

        ]);
        DB::table('category_product')->insert([
            [
                'category_id' => '2322',
                'product_id' => '232713'
            ],
            [
                'category_id' => '2323',
                'product_id' => '232713'
            ],
            [
                'category_id' => '2322',
                'product_id' => '395335'
            ],
            [
                'category_id' => '2322',
                'product_id' => '232717'
            ],
            [
                'category_id' => '2323',
                'product_id' => '232717'
            ],
            [
                'category_id' => '2322',
                'product_id' => '2327170'
            ],
            [
                'category_id' => '2323',
                'product_id' => '2327170'
            ],
            [
                'category_id' => '201',
                'product_id' => '450138'
            ],
            [
                'category_id' => '201',
                'product_id' => '301617'
            ],
            [
                'category_id' => '201',
                'product_id' => '544769'
            ],
            [
                'category_id' => '177',
                'product_id' => '181802'
            ],
            [
                'category_id' => '177',
                'product_id' => '289682'
            ],
            [
                'category_id' => '177',
                'product_id' => '331567'
            ],
        ]);
        DB::table('products')->insert([
            [
                'id' => '232713',
                'name'=>'Painel para TV 50 Polegadas Zeus Natural e Off White 184 cm',
                'stock'=>'40',
                'anchor_price'=>'729.99',
                'final_price'=>'5096.99',
                'image'=>'Mobly-Painel-para-TV-50-Polegadas-Zeus-Natural-e-Off-White-184-cm-8175-518722-1-zoom.jpg',
                'color_id'=>'1'
            ],
            [
                'id' => '395335',
                'name'=>'Rack Retrô Goslar Fosco Preto 162 cm',
                'stock'=>'20',
                'anchor_price'=>'409.99',
                'final_price'=>'269.99',
                'image'=>'Mobly-Rack-RetrC3B4-Goslar-Fosco-Preto-162-cm-0255-451714-1-zoom.jpg',
                'color_id'=>'3'
            ],
            [
                'id' => '232717',
                'name'=>'Painel para TV 60 Polegadas Zeus Natural e Off White 220 cm',
                'stock'=>'2',
                'anchor_price'=>'899.99',
                'final_price'=>'599.99',
                'image'=>'/Mobly-Painel-para-TV-40-Polegadas-Zeus-Natural-e-Off-White-120-cm-8175-118722-1-zoom.jpg',
                'color_id'=>'1'
            ],
            [
                'id' => '2327170',
                'name'=>'Painel para TV 60 Polegadas Zeus Natural e Off White 220 cm',
                'stock'=>'0',
                'anchor_price'=>'899.99',
                'final_price'=>'599.99',
                'image'=>'/Mobly-Painel-para-TV-40-Polegadas-Zeus-Natural-e-Off-White-120-cm-8175-118722-1-zoom.jpg',
                'color_id'=>'2'
            ],
            [
                'id' => '450138',
                'name'=>'Guarda-Roupa Closet Modulado Barcelona Demolição',
                'stock'=>'7',
                'anchor_price'=>'579.99',
                'final_price'=>'351.99',
                'image'=>'Artefamol-Guarda-Roupa-Closet-Modulado-Barcelona-DemoliC3A7C3A3o-8175-429174-1-zoom.jpg',
                'color_id'=>'2'
            ],
            [
                'id' => '301617',
                'name'=>'Guarda-Roupa Casal com Espelho Scarpa 3PT 4GV Branco',
                'stock'=>'17',
                'anchor_price'=>'1949.99',
                'final_price'=>'1375.99',
                'image'=>'Novo-Horizonte-Guarda-Roupa-Casal-com-Espelho-Scarpa-3PT-4GV-Branco-3411-830992-1-zoom.jpg',
                'color_id'=>'3'
            ],
            [
                'id' => '544769',
                'name'=>'Guarda-Roupa Casal com Espelho Scarpa 3PT 4GV Branco',
                'stock'=>'17',
                'anchor_price'=>'1199.99',
                'final_price'=>'699.99',
                'image'=>'Mobly-Guarda-Roupa-Casal-com-Espelho-Bahia-III-3-PT-Branco-8550-526665-1-zoom.jpg',
                'color_id'=>'1'

            ],
            [
                'id' => '181802',
                'name'=>'Sofá 3 Lugares Kivik Capitonê Cinza',
                'stock'=>'37',
                'anchor_price'=>'2699.99',
                'final_price'=>'1847.99',
                'image'=>'Mobly-SofC3A1-3-Lugares-Kivik-CapitonC3AA-Cinza-9230-972871-1-zoom.jpg',
                'color_id'=>'1'
            ],
            [
                'id' => '289682',
                'name'=>'Sofá 3 Lugares Retrátil Kennedy Suede Chumbo',
                'stock'=>'6',
                'anchor_price'=>'999.99',
                'final_price'=>'699.99',
                'image'=>'Mobly-SofC3A1-3-Lugares-RetrC3A1til-Kennedy-Suede-Chumbo-8175-515782-1-zoom.jpg',
                'color_id'=>'2'

            ],
            [
                'id' => '331567',
                 'name'=>'Sofá 3 Lugares Retrátil e Reclinável Plaza Suede Cinza',
                'stock'=>'14',
                'anchor_price'=>'1299.99',
                'final_price'=>'887.00',
                'image'=>'Mobly-SofC3A1-3-Lugares-RetrC3A1til-e-ReclinC3A1vel-Plaza-Suede-Cinza-8175-058233-1-zoom.jpg',
                'color_id'=>'3'

            ],
        ]);
    }
}
