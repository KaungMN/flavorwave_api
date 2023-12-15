<?php

namespace App\Http\Controllers;

use App\Models\DamageReturnProduct;
use App\Models\ManufacturedProduct;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function getProductSellCount($id)
    {
        $totalSellCount = 0;

        $orderedProducts = Order::where('product_id', $id)->where('status', 'completed')->get();
        foreach ($orderedProducts as $p) {
            $totalSellCount += explode('_', $p->box_pcs)[0];
        }

        return response()->json($totalSellCount);
    }

    public function getProductTotalCount(Request $request){
        $totalCount = 0;
        $products = ManufacturedProduct::where('product_id',$request->product_id)->get();
        //target year
        foreach($products as $p){
            $totalCount += $p->total_quantity;

        }
        return response()->json(["products"=>$products,"totalCount"=>$totalCount]);

    }

    public function getDamageAndReturnCount($id){
        $totalDamageCount = 0;
        $totalReturnCount = 0;
        $getDamage = DamageReturnProduct::where('product_id',$id)->where('stage','damage')->get();
        $getReturn = DamageReturnProduct::where('product_id',$id)->where('stage','sale_return')->get();

        foreach($getDamage as $pD){
            $totalDamageCount += $pD->quantity;
        }

        foreach($getReturn as $pR){
            $totalReturnCount += $pD->quantity;
        }


        return response()->json(['total_damage_count'=>$totalDamageCount,'total_saleReturn_count'=>$totalReturnCount]);
    }

    public function getProductPricesChanges(Request $request){
        $requiredProduct = ManufacturedProduct::where('product_id',$request->product_id)->get();
        //where('released_date',$request->year)->


        return response()->json($requiredProduct);
    }

    public function productsSellCount(){
       return $sellCounts = [
            "2019"=>[
                [
                    "product"=>'Burmese Bliss',
                    "sell count"=>'10000'
                ],
                [
                    "product"=>'Golden Sunshine Tea',
                    "sell count"=>'8000'
                ],
                [
                    "product"=>'Mango Tango Delight',
                    "sell count"=>'7500'
                ],
                [
                    "product"=>'Rangoon Rosewater Elixir',
                    "sell count"=>'12000'
                ],
                [
                    "product"=>' Emerald Green Chai',
                    "sell count"=>'85000'
                ],
                [
                    "product"=>' Citrus Fusion Fizz',
                    "sell count"=>'10300'
                ],
                [
                    "product"=>'Coconut Cream Dream',
                    "sell count"=>'6000'
                ],
                [
                    "product"=>'Jasmine Serenade Soda',
                    "sell count"=>'9800'
                ],
                [
                    "product"=>'Papaya Paradise Punch ',
                    "sell count"=>'3000'
                ],
                [
                    "product"=>' Lychee Lullaby',
                    "sell count"=>'8020'
                ],
                [
                    "product"=>'Tropical Twilight Nectar',
                    "sell count"=>'15000'
                ],
                [
                    "product"=>' Orchid Oasis Euphoria',
                    "sell count"=>'7000'
                ],
                [
                    "product"=>'Starfruit Sparkling Sorbet',
                    "sell count"=>'20000'
                ],
                [
                    "product"=>'Ginger Zing Zest',
                    "sell count"=>'11900'
                ],
                [
                    "product"=>' Lush Lemongrass Infusion',
                    "sell count"=>'8800'
                ],
                [
                    "product"=>' Ruby Red Guava Gusto ',
                    "sell count"=>'35000'
                ],
                [
                    "product"=>'Blueberry Burst Breeze',
                    "sell count"=>'19000'
                ],
                [
                    "product"=>'Pineapple Pizzazz Quencher',
                    "sell count"=>'45000'
                ],
                [
                    "product"=>'Passionfruit Pomegranate Bliss',
                    "sell count"=>'14000'
                ],
                [
                    "product"=>'Exotic Cucumber Limeade',
                    "sell count"=>'34500'
                ]

                ],
            "2020"=>[
                [
                    "product"=>'Burmese Bliss',
                    "sell count"=>'40000'
                ],
                [
                    "product"=>'Golden Sunshine Tea',
                    "sell count"=>'28000'
                ],
                [
                    "product"=>'Mango Tango Delight',
                    "sell count"=>'10500'
                ],
                [
                    "product"=>'Rangoon Rosewater Elixir',
                    "sell count"=>'20000'
                ],
                [
                    "product"=>' Emerald Green Chai',
                    "sell count"=>'100000'
                ],
                [
                    "product"=>' Citrus Fusion Fizz',
                    "sell count"=>'4300'
                ],
                [
                    "product"=>'Coconut Cream Dream',
                    "sell count"=>'2000'
                ],
                [
                    "product"=>'Jasmine Serenade Soda',
                    "sell count"=>'15000'
                ],
                [
                    "product"=>'Papaya Paradise Punch ',
                    "sell count"=>'15600'
                ],
                [
                    "product"=>' Lychee Lullaby',
                    "sell count"=>'20000'
                ],
                [
                    "product"=>'Tropical Twilight Nectar',
                    "sell count"=>'45000'
                ],
                [
                    "product"=>' Orchid Oasis Euphoria',
                    "sell count"=>'10300'
                ],
                [
                    "product"=>'Starfruit Sparkling Sorbet',
                    "sell count"=>'14000'
                ],
                [
                    "product"=>'Ginger Zing Zest',
                    "sell count"=>'12900'
                ],
                [
                    "product"=>' Lush Lemongrass Infusion',
                    "sell count"=>'5800'
                ],
                [
                    "product"=>' Ruby Red Guava Gusto ',
                    "sell count"=>'25000'
                ],
                [
                    "product"=>'Blueberry Burst Breeze',
                    "sell count"=>'50000'
                ],
                [
                    "product"=>'Pineapple Pizzazz Quencher',
                    "sell count"=>'90000'
                ],
                [
                    "product"=>'Passionfruit Pomegranate Bliss',
                    "sell count"=>'25090'
                ],
                [
                    "product"=>'Exotic Cucumber Limeade',
                    "sell count"=>'33500'
                ]

                ],
                "2021"=>[
                    [
                        "product"=>'Burmese Bliss',
                        "sell count"=>'60000'
                    ],
                    [
                        "product"=>'Golden Sunshine Tea',
                        "sell count"=>'35000'
                    ],
                    [
                        "product"=>'Mango Tango Delight',
                        "sell count"=>'9500'
                    ],
                    [
                        "product"=>'Rangoon Rosewater Elixir',
                        "sell count"=>'19000'
                    ],
                    [
                        "product"=>' Emerald Green Chai',
                        "sell count"=>'70000'
                    ],
                    [
                        "product"=>' Citrus Fusion Fizz',
                        "sell count"=>'20300'
                    ],
                    [
                        "product"=>'Coconut Cream Dream',
                        "sell count"=>'5000'
                    ],
                    [
                        "product"=>'Jasmine Serenade Soda',
                        "sell count"=>'11100'
                    ],
                    [
                        "product"=>'Papaya Paradise Punch ',
                        "sell count"=>'9000'
                    ],
                    [
                        "product"=>' Lychee Lullaby',
                        "sell count"=>'38100'
                    ],
                    [
                        "product"=>'Tropical Twilight Nectar',
                        "sell count"=>'20000'
                    ],
                    [
                        "product"=>' Orchid Oasis Euphoria',
                        "sell count"=>'19000'
                    ],
                    [
                        "product"=>'Starfruit Sparkling Sorbet',
                        "sell count"=>'20500'
                    ],
                    [
                        "product"=>'Ginger Zing Zest',
                        "sell count"=>'6900'
                    ],
                    [
                        "product"=>' Lush Lemongrass Infusion',
                        "sell count"=>'40000'
                    ],
                    [
                        "product"=>' Ruby Red Guava Gusto ',
                        "sell count"=>'55000'
                    ],
                    [
                        "product"=>'Blueberry Burst Breeze',
                        "sell count"=>'49000'
                    ],
                    [
                        "product"=>'Pineapple Pizzazz Quencher',
                        "sell count"=>'75000'
                    ],
                    [
                        "product"=>'Passionfruit Pomegranate Bliss',
                        "sell count"=>'6000'
                    ],
                    [
                        "product"=>'Exotic Cucumber Limeade',
                        "sell count"=>'14500'
                    ]

                    ],
                    "2022"=>[
                        [
                            "product"=>'Burmese Bliss',
                            "sell count"=>'90000'
                        ],
                        [
                            "product"=>'Golden Sunshine Tea',
                            "sell count"=>'11000'
                        ],
                        [
                            "product"=>'Mango Tango Delight',
                            "sell count"=>'3500'
                        ],
                        [
                            "product"=>'Rangoon Rosewater Elixir',
                            "sell count"=>'52000'
                        ],
                        [
                            "product"=>' Emerald Green Chai',
                            "sell count"=>'6603'
                        ],
                        [
                            "product"=>' Citrus Fusion Fizz',
                            "sell count"=>'70300'
                        ],
                        [
                            "product"=>'Coconut Cream Dream',
                            "sell count"=>'10400'
                        ],
                        [
                            "product"=>'Jasmine Serenade Soda',
                            "sell count"=>'10800'
                        ],
                        [
                            "product"=>'Papaya Paradise Punch ',
                            "sell count"=>'7000'
                        ],
                        [
                            "product"=>' Lychee Lullaby',
                            "sell count"=>'50020'
                        ],
                        [
                            "product"=>'Tropical Twilight Nectar',
                            "sell count"=>'45000'
                        ],
                        [
                            "product"=>' Orchid Oasis Euphoria',
                            "sell count"=>'17000'
                        ],
                        [
                            "product"=>'Starfruit Sparkling Sorbet',
                            "sell count"=>'30000'
                        ],
                        [
                            "product"=>'Ginger Zing Zest',
                            "sell count"=>'4900'
                        ],
                        [
                            "product"=>' Lush Lemongrass Infusion',
                            "sell count"=>'9800'
                        ],
                        [
                            "product"=>' Ruby Red Guava Gusto ',
                            "sell count"=>'35700'
                        ],
                        [
                            "product"=>'Blueberry Burst Breeze',
                            "sell count"=>'15000'
                        ],
                        [
                            "product"=>'Pineapple Pizzazz Quencher',
                            "sell count"=>'85000'
                        ],
                        [
                            "product"=>'Passionfruit Pomegranate Bliss',
                            "sell count"=>'19800'
                        ],
                        [
                            "product"=>'Exotic Cucumber Limeade',
                            "sell count"=>'32500'
                        ]

                        ],
                        "2023"=>[
                            [
                                "product"=>'Burmese Bliss',
                                "sell count"=>'100000'
                            ],
                            [
                                "product"=>'Golden Sunshine Tea',
                                "sell count"=>'9000'
                            ],
                            [
                                "product"=>'Mango Tango Delight',
                                "sell count"=>'13000'
                            ],
                            [
                                "product"=>'Rangoon Rosewater Elixir',
                                "sell count"=>'46000'
                            ],
                            [
                                "product"=>' Emerald Green Chai',
                                "sell count"=>'75000'
                            ],
                            [
                                "product"=>' Citrus Fusion Fizz',
                                "sell count"=>'9300'
                            ],
                            [
                                "product"=>'Coconut Cream Dream',
                                "sell count"=>'7000'
                            ],
                            [
                                "product"=>'Jasmine Serenade Soda',
                                "sell count"=>'14500'
                            ],
                            [
                                "product"=>'Papaya Paradise Punch ',
                                "sell count"=>'17000'
                            ],
                            [
                                "product"=>' Lychee Lullaby',
                                "sell count"=>'10020'
                            ],
                            [
                                "product"=>'Tropical Twilight Nectar',
                                "sell count"=>'35000'
                            ],
                            [
                                "product"=>' Orchid Oasis Euphoria',
                                "sell count"=>'5000'
                            ],
                            [
                                "product"=>'Starfruit Sparkling Sorbet',
                                "sell count"=>'37000'
                            ],
                            [
                                "product"=>'Ginger Zing Zest',
                                "sell count"=>'9900'
                            ],
                            [
                                "product"=>' Lush Lemongrass Infusion',
                                "sell count"=>'25800'
                            ],
                            [
                                "product"=>' Ruby Red Guava Gusto ',
                                "sell count"=>'20500'
                            ],
                            [
                                "product"=>'Blueberry Burst Breeze',
                                "sell count"=>'36000'
                            ],
                            [
                                "product"=>'Pineapple Pizzazz Quencher',
                                "sell count"=>'55000'
                            ],
                            [
                                "product"=>'Passionfruit Pomegranate Bliss',
                                "sell count"=>'9400'
                            ],
                            [
                                "product"=>'Exotic Cucumber Limeade',
                                "sell count"=>'4000'
                            ]

                            ],


    ];
    }
}
