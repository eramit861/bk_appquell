<?php

namespace App\Helpers;

class UtilityHelper extends Helper
{
    public static function getDetailedPropertyKeyNameForTemplate($key = null)
    {
        $arr = [
            'data_household_goods_furnishings_items' => 'Household Goods & Furnishings Items',
            'data_electronics_items' => 'Electronics Items',
            'data_collectibles_items' => 'Collectibles Items',
            'data_sports_items' => 'Sports Items',
            'data_firearms_items' => 'Firearms Items',
            'data_everyday_clothing_items' => 'Everyday Clothing Items',
            'data_everyday_and_fine_jewelry_items' => 'Everyday and Fine Jewelry Items',
        ];

        return static::returnArrValue($arr, $key);
    }

    public static function getDetailedPropertyTableColumnNameForTemplate($key = null)
    {
        $arr = [
            'household_goods_furnishings' => 'data_household_goods_furnishings_items',
            'electronics' => 'data_electronics_items',
            'collectibles' => 'data_collectibles_items',
            'sports' => 'data_sports_items',
            'everydayfinejqwl' => 'data_everyday_and_fine_jewelry_items',
            'everydayclothing' => 'data_everyday_clothing_items',
            'firearms' => 'data_firearms_items',
        ];

        return static::returnArrValue($arr, $key);
    }

    public static function getHouseholdGoodsFurnishingsItemsArray($key = null)
    {
        $arr = [
            'Living Room' => [
                ['key' => 'Sofas', 'hint' => ''],
                ['key' => 'Recliners', 'hint' => ''],
                ['key' => 'Coffee tables', 'hint' => ''],
                ['key' => 'End tables', 'hint' => ''],
                ['key' => 'TV stand', 'hint' => ''],
                ['key' => 'Lamps', 'hint' => ''],
                ['key' => 'Wall art/paintings', 'hint' => ''],
                ['key' => 'Couch', 'hint' => ''],
                ['key' => 'Loveseat(s)', 'hint' => ''],
                ['key' => 'Armchairs', 'hint' => ''],
                ['key' => 'Bookcase(s)', 'hint' => ''],
                ['key' => 'Ottoman(s)', 'hint' => ''],
            ],
            'Dining Room' => [
                ['key' => 'Dining table', 'hint' => ''],
                ['key' => 'Chairs', 'hint' => ''],
                ['key' => 'Buffet/sideboard', 'hint' => ''],
                ['key' => 'China cabinet/hutch', 'hint' => ''],
            ],
            'Kitchen' => [
                ['key' => 'Refrigerator', 'hint' => ''],
                ['key' => 'Stove/Cooking Unit', 'hint' => ''],
                ['key' => 'Microwave', 'hint' => ''],
                ['key' => 'Dishwasher', 'hint' => ''],
                ['key' => 'Coffee maker', 'hint' => ''],
                ['key' => 'Blender/food processor', 'hint' => ''],
                ['key' => 'Toaster/toaster oven', 'hint' => ''],
                ['key' => 'Cookware', 'hint' => '(pots, pans, skillets)'],
                ['key' => 'Bakeware', 'hint' => '(cookie sheets, muffin tins)'],
                ['key' => 'Utensils', 'hint' => '(spatulas, ladles, tongs)'],
                ['key' => 'Cutlery', 'hint' => '(knives, forks, spoons)'],
                ['key' => 'Dishes', 'hint' => '(plates, bowls)'],
                ['key' => 'Glassware', 'hint' => '(cups, mugs)'],
                ['key' => 'Storage containers', 'hint' => ''],
                ['key' => 'Silverware/Flatware', 'hint' => ''],
                ['key' => 'Misc. Small Kitchen Appliances', 'hint' => ''],
            ],
            'Bedrooms' => [
                ['key' => 'Queen size bed', 'hint' => ''],
                ['key' => 'Dressers', 'hint' => ''],
                ['key' => 'Nightstands', 'hint' => ''],
                ['key' => 'Wardrobes/armoires', 'hint' => ''],
                ['key' => 'Closets/shelves', 'hint' => ''],
                ['key' => 'Bedding sets', 'hint' => '(sheets, blankets, pillows)'],
                ['key' => 'Crib(s)', 'hint' => ''],
                ['key' => 'King size bed', 'hint' => ''],
                ['key' => 'Twin size bed', 'hint' => ''],
                ['key' => 'Full size bed', 'hint' => ''],
                ['key' => 'Storage bench(s)', 'hint' => ''],
            ],
            'Laundry Room' => [
                ['key' => 'Washer/Dryer', 'hint' => ''],
                ['key' => 'Misc. Laundry equipment', 'hint' => ''],
                ['key' => 'Ironing board/iron', 'hint' => ''],
                ['key' => 'Laundry baskets/hampers', 'hint' => ''],
            ],
            'Miscellaneous' => [
                ['key' => 'Portable A/C Heater', 'hint' => ''],
                ['key' => 'Fans', 'hint' => ''],
                ['key' => 'Misc. Books & picture(s)', 'hint' => ''],
                ['key' => 'Vacuum cleaner', 'hint' => ''],
                ['key' => 'Wheel Barrow', 'hint' => ''],
                ['key' => 'Misc. Home Decor', 'hint' => ''],
                ['key' => 'Utility shelve(s)', 'hint' => ''],
            ],
            'Outdoor and Garage Items' => [
                ['key' => 'Lawn furniture', 'hint' => ''],
                ['key' => 'Grills/barbecues', 'hint' => ''],
                ['key' => 'Lawn mower', 'hint' => ''],
                ['key' => 'Freezer(s)', 'hint' => ''],
                ['key' => 'Weed Eater', 'hint' => ''],
                ['key' => 'Patio furniture', 'hint' => ''],
                ['key' => 'Misc. Hand Tools', 'hint' => ''],
                ['key' => 'Misc. Holiday Decor Deep', 'hint' => ''],
            ],
            'Home Office' => [
                ['key' => 'Desk', 'hint' => ''],
                ['key' => 'Desk chair', 'hint' => ''],
                ['key' => 'Filing cabinets', 'hint' => ''],
                ['key' => 'Computers/laptops', 'hint' => ''],
                ['key' => 'Printers/scanners', 'hint' => ''],
                ['key' => 'Office supplies', 'hint' => '(paper, pens, stapler)'],
                ['key' => 'Bookshelves', 'hint' => ''],
            ]
        ];

        return static::returnArrValue($arr, $key);
    }



    public static function getElectronicsItemsArray($key = null)
    {
        $arr = [
            'Personal Electronics' => [
                ['key' => 'iPhone(s)', 'hint' => ''],
                ['key' => 'Smartwatches', 'hint' => '(Apple Watch, Samsung Galaxy Watch, etc.)'],
                ['key' => 'E-readers', 'hint' => '(e.g., Kindle, Nook, etc.)'],
                ['key' => 'Fitness trackers', 'hint' => '(Fitbit, Garmin, etc.)'],
                ['key' => 'Headphones/earbuds', 'hint' => '(AirPods, Beats, etc.)'],
                ['key' => 'Android smart phone(s)', 'hint' => ''],
                ['key' => 'iPads', 'hint' => '(Apple)'],
                ['key' => 'Tablets', 'hint' => '(Android)'],
            ],
            'Televisions & Entertainment Systems' => [
                ['key' => 'Television(s)', 'hint' => ''],
                ['key' => 'Home theater system(s)', 'hint' => ''],
                ['key' => 'Surround sound system(s)', 'hint' => ''],
                ['key' => 'Blu-ray', 'hint' => ''],
                ['key' => 'DVD player(s)', 'hint' => ''],
                ['key' => 'Streaming devices', 'hint' => '(Roku, Apple TV, Chromecast, etc.)'],
                ['key' => 'PlayStation Console', 'hint' => ''],
                ['key' => 'Nintendo consoles', 'hint' => '(XBox, Nintendo Switch, etc.)'],
            ],
            'Computers & Accessories' => [
                ['key' => 'Desktop computer(s)', 'hint' => ''],
                ['key' => 'Laptops', 'hint' => '(MacBooks, Chromebooks, etc.)'],
                ['key' => 'Webcam(s)', 'hint' => ''],
                ['key' => 'Printer(s)', 'hint' => ''],
                ['key' => 'Scanner(s)', 'hint' => ''],
                ['key' => 'Monitors', 'hint' => ''],
                ['key' => 'Copy Machine', 'hint' => ''],
                ['key' => 'Fax Machine', 'hint' => ''],
            ],
            'Audio Equipment' => [
                ['key' => 'Speakers', 'hint' => ''],
                ['key' => 'Sound system(s)', 'hint' => ''],
                ['key' => 'Turntables', 'hint' => ''],
                ['key' => 'Record players', 'hint' => ''],
                ['key' => 'Amplifiers', 'hint' => ''],
                ['key' => 'Receivers', 'hint' => ''],
                ['key' => 'Karaoke machine', 'hint' => ''],
                ['key' => 'Headphone(s)', 'hint' => ''],
            ],
            'Cameras & Photography Equipment' => [
                ['key' => 'Digital cameras', 'hint' => '(DSLR or mirrorless)'],
                ['key' => 'Video cameras', 'hint' => ''],
                ['key' => 'Camcorders', 'hint' => ''],
                ['key' => 'Lenses and tripods', 'hint' => ''],
            ]
        ];

        return static::returnArrValue($arr, $key);
    }


    public static function getCollectiblesItemsArray($key = null)
    {
        $arr = [
            'Artwork' => [
                ['key' => 'Paintings', 'hint' => ''],
                ['key' => 'Sculptures', 'hint' => ''],
                ['key' => 'Drawings', 'hint' => ''],
                ['key' => 'Photographs', 'hint' => ''],
                ['key' => 'Lithographs/prints', 'hint' => ''],
                ['key' => 'Antique art objects', 'hint' => ''],
            ],
            'Coins & Stamps' => [
                ['key' => 'Coin collection', 'hint' => ''],
                ['key' => 'Foreign currency', 'hint' => ''],
                ['key' => 'Commemorative coins', 'hint' => ''],
                ['key' => 'Bullion', 'hint' => ''],
                ['key' => 'Rare stamps', 'hint' => ''],
                ['key' => 'Vintage stamps', 'hint' => ''],
            ],
            'Sports Memorabilia' => [
                ['key' => 'Autographed items', 'hint' => '(balls, jerseys, etc.)'],
                ['key' => 'Trading cards', 'hint' => '(baseball, basketball cards, etc.)'],
                ['key' => 'Game-worn items', 'hint' => ''],
                ['key' => 'Tickets from significant events', 'hint' => ''],
            ],
            'Antiques' => [
                ['key' => 'Antique furniture', 'hint' => ''],
                ['key' => 'Antique kitchenware', 'hint' => '(pots, pans, utensils)'],
                ['key' => 'Antique clocks', 'hint' => ''],
                ['key' => 'Historic documents or books', 'hint' => ''],
                ['key' => 'Vintage clothing', 'hint' => ''],
            ],
            'Books, Manuscripts, & Maps' => [
                ['key' => 'Rare/first-edition books', 'hint' => ''],
                ['key' => 'Autographed books', 'hint' => ''],
                ['key' => 'Antique manuscripts', 'hint' => ''],
                ['key' => 'Vintage or antique maps', 'hint' => ''],
                ['key' => 'Comic book collections', 'hint' => ''],
                ['key' => 'Rare/first-edition comic books', 'hint' => ''],
            ],
            'Toys & Action Figures' => [
                ['key' => 'Vintage or collectible toys', 'hint' => '(e.g., Barbie dolls, G.I. Joe)'],
                ['key' => 'Action figures', 'hint' => '(especially limited editions or rare items)'],
                ['key' => 'Model trains, cars, and planes', 'hint' => ''],
                ['key' => 'Record players', 'hint' => ''],
            ],
        ];

        return static::returnArrValue($arr, $key);
    }


    public static function getSportsItemsArray($key = null)
    {
        $arr = [
            'Sports Equipment' => [],
            'Outdoor Sports' => [
                ['key' => 'Bicycle(s)', 'hint' => '(road bikes, mountain bikes, electric bikes, etc.)'],
                ['key' => 'Skateboards/longboards', 'hint' => ''],
                ['key' => 'Scooters', 'hint' => '(manual or electric)'],
                ['key' => 'Rollerblades/inline skates', 'hint' => ''],
                ['key' => 'Surfboards', 'hint' => '(shortboards, longboards)'],
                ['key' => 'Skis/snowboards', 'hint' => ''],
                ['key' => 'Golf clubs and bags', 'hint' => ''],
                ['key' => 'Fishing gear', 'hint' => '(rods, reels, tackle boxes)'],
                ['key' => 'Kayaks and canoes', 'hint' => ''],
                ['key' => 'Paddleboard(s)', 'hint' => ''],
                ['key' => 'Camping gear', 'hint' => '(tents, sleeping bags, camp stoves)'],
                ['key' => 'Soccer equipment', 'hint' => '(balls, nets, cleats, shin guards)'],
                ['key' => 'Baseball/softball gear', 'hint' => '(bats, gloves, balls, helmets)'],
                ['key' => 'Football gear', 'hint' => '(footballs, pads, helmets)'],
                ['key' => 'Basketball equipment', 'hint' => '(basketballs, hoops)'],
                ['key' => 'Volleyball gear', 'hint' => '(balls, nets)'],
                ['key' => 'Hockey equipment', 'hint' => '(sticks, skates, pucks, pads)'],
            ],
            'Indoor Sports' => [
                ['key' => 'Weightlifting equipment', 'hint' => '(dumbbells, barbells, weight plates)'],
                ['key' => 'Exercise machines', 'hint' => '(treadmills, stationary bikes, ellipticals)'],
                ['key' => 'Resistance bands', 'hint' => ''],
                ['key' => 'Yoga mats and blocks', 'hint' => ''],
                ['key' => 'Exercise balls', 'hint' => ''],
                ['key' => 'Punching bags', 'hint' => '(boxing gloves, wraps)'],
                ['key' => 'Rowing machines', 'hint' => ''],
                ['key' => 'Ping pong tables and paddles', 'hint' => ''],
                ['key' => 'Pool tables', 'hint' => '(billiards, cues, balls)'],
                ['key' => 'Foosball tables', 'hint' => ''],
                ['key' => 'Darts and dartboards', 'hint' => ''],
            ],
            'Hobby Equipment' => [],
            'Musical Instruments' => [
                ['key' => 'Guitars', 'hint' => '(electric, acoustic, bass)'],
                ['key' => 'Pianos and keyboards', 'hint' => ''],
                ['key' => 'Drum sets', 'hint' => '(acoustic and electronic)'],
                ['key' => 'Violins, cellos, and other string instruments', 'hint' => ''],
                ['key' => 'Flutes, clarinets, and woodwind instruments', 'hint' => ''],
                ['key' => 'Trumpets, trombones, and brass instruments', 'hint' => ''],
                ['key' => 'Microphones', 'hint' => '(recording and performance mics)'],
                ['key' => 'Amplifiers and audio gear', 'hint' => '(speakers, mixers, soundboards)'],
            ],
            'Crafting and DIY Tools' => [
                ['key' => 'Sewing machines', 'hint' => ''],
                ['key' => 'Knitting and crochet supplies', 'hint' => '(needles, yarn)'],
                ['key' => 'Scrapbooking supplies', 'hint' => '(paper, stamps, embellishments)'],
                ['key' => 'Painting supplies', 'hint' => '(easels, canvases, paints, brushes)'],
                ['key' => 'Pottery equipment', 'hint' => '(wheels, kilns)'],
                ['key' => 'Woodworking tools', 'hint' => '(saws, chisels, drills)'],
                ['key' => 'Model kits', 'hint' => '(cars, planes, ships)'],
                ['key' => 'Jewelry-making tools', 'hint' => '(pliers, beads, string)'],
                ['key' => 'Leatherworking tools', 'hint' => '(stamps, cutters, thread)'],
            ],
            'Photography and Videography' => [
                ['key' => 'Cameras', 'hint' => '(DSLR, mirrorless, point-and-shoot)'],
                ['key' => 'Lenses', 'hint' => '(wide-angle, telephoto, zoom)'],
                ['key' => 'Tripods and stabilizers', 'hint' => ''],
                ['key' => 'Lighting kits', 'hint' => '(softboxes, ring lights)'],
                ['key' => 'Drones', 'hint' => '(with cameras for aerial photography)'],
                ['key' => 'Editing software', 'hint' => '(Photoshop, Lightroom)'],
            ],
            'Hobby Games and Collections' => [
                ['key' => 'Board games', 'hint' => '(strategy games, classic games)'],
                ['key' => 'Card games', 'hint' => '(playing cards, collectible trading cards like Magic: The Gathering, Pokémon)'],
                ['key' => 'Tabletop gaming supplies', 'hint' => '(miniatures, dice, rulebooks)'],
                ['key' => 'Model train sets', 'hint' => '(tracks, trains, scenery)'],
                ['key' => 'RC vehicles', 'hint' => '(remote-controlled cars, drones, boats)'],
            ],
            'Other Hobbies' => [
                ['key' => 'Metal detectors', 'hint' => ''],
                ['key' => 'Kites', 'hint' => ''],
                ['key' => 'Boating equipment', 'hint' => '(life vests, oars, anchors)'],
                ['key' => 'Aquarium supplies', 'hint' => '(tanks, filters, decor)'],
                ['key' => 'RC airplanes and helicopters', 'hint' => ''],
                ['key' => 'Model rockets', 'hint' => ''],
            ],
        ];

        return static::returnArrValue($arr, $key);
    }


    public static function getEverydayAndFineJewelryItemsArray($key = null)
    {
        $arr = [
            'Everyday Jewelry' => [
                ['key' => 'Rings', 'hint' => '(Normal rings worn everyday, with no significant value)'],
                ['key' => 'Necklaces', 'hint' => ''],
                ['key' => 'Bracelets', 'hint' => ''],
                ['key' => 'Earrings', 'hint' => ''],
                ['key' => 'Anklets', 'hint' => ''],
                ['key' => 'Pendants', 'hint' => ''],
                ['key' => 'Vintage costume jewelry', 'hint' => ''],
                ['key' => 'Piercings', 'hint' => '(nose rings, belly button, etc.)'],
            ],
            'Womens Jewelry' => [
                ['key' => 'Womens Wedding ring ', 'hint' => ''],
                ['key' => 'Engagement Ring', 'hint' => ''],
                ['key' => 'Brooch', 'hint' => ''],
                ['key' => 'Chokers', 'hint' => ''],
            ],
            'Mens Jewelry' => [
                ['key' => 'Mens Wedding ring', 'hint' => ''],
                ['key' => 'Cuff Links', 'hint' => ''],
                ['key' => 'Tie Bars', 'hint' => ''],
                ['key' => 'Everyday Watch', 'hint' => ''],
            ],
            'Watches' => [
                ['key' => 'Rolex Watch', 'hint' => ''],
                ['key' => "Everyday Women's watch", 'hint' => '(e.g., Timex, Fossil)'],
                ['key' => 'Cartier Watch', 'hint' => ''],
                ['key' => 'Patek Philippe Watch', 'hint' => ''],
            ],
            'Hair Ornaments' => [
                ['key' => 'Crowns', 'hint' => ''],
                ['key' => 'Headband', 'hint' => ''],
                ['key' => 'Hairclip', 'hint' => ''],
            ],
            'Misc. Jewelry' => [
                ['key' => 'Championship ring', 'hint' => ''],
                ['key' => 'Belly chain', 'hint' => ''],
                ['key' => 'Chatelaine', 'hint' => ''],
                ['key' => 'Locket', 'hint' => ''],
            ],
        ];

        return static::returnArrValue($arr, $key);
    }


    public static function getEverydayClothingArray($key = null)
    {
        $arr = [
            "Women's Clothing" => [
                ['key' => "Women's Suits", 'hint' => ''],
                ['key' => 'Dresses & Skirts', 'hint' => ''],
                ['key' => 'Blouses', 'hint' => ''],
                ['key' => "Women's Pants", 'hint' => ''],
                ['key' => "Women's Shorts", 'hint' => ''],
                ['key' => 'Coats', 'hint' => ''],
                ['key' => 'Hosiery', 'hint' => ''],
            ],
            "Men's Clothing" => [
                ['key' => "Men's Suits", 'hint' => ''],
                ['key' => "Men's Slacks", 'hint' => ''],
                ['key' => "Men's Jackets", 'hint' => ''],
                ['key' => "Men's Shirts", 'hint' => ''],
                ['key' => "Men's Shorts", 'hint' => ''],
                ['key' => 'Jeans', 'hint' => ''],
                ['key' => 'Ties', 'hint' => ''],
            ],
            "Children's Clothing" => [
                ['key' => "Children's Suits", 'hint' => ''],
                ['key' => "Children's Slacks", 'hint' => ''],
                ['key' => "Children's Jackets", 'hint' => ''],
                ['key' => "Children's Shirts", 'hint' => ''],
                ['key' => "Children's Shorts", 'hint' => ''],
                ['key' => "Children's Pants", 'hint' => ''],
                ['key' => 'Hoodies', 'hint' => ''],
            ],
            'Additional Clothing' => [
                ['key' => 'Work Uniforms', 'hint' => ''],
                ['key' => 'Athletic wear', 'hint' => '(e.g., workout clothes, sports uniforms)'],
                ['key' => 'Formalwear', 'hint' => '(e.g., tuxedos, evening gowns)'],
                ['key' => 'Boots', 'hint' => ''],
                ['key' => 'Womens Shoes', 'hint' => ''],
                ['key' => 'Hiking or outdoor gear', 'hint' => ''],
                ['key' => 'Athletic shoes', 'hint' => ''],
                ['key' => 'Tennis Shoes', 'hint' => ''],
            ],
            'Accessories' => [
                ['key' => 'Handbags', 'hint' => ''],
                ['key' => 'Belts', 'hint' => ''],
                ['key' => 'Gloves and mittens', 'hint' => ''],
                ['key' => 'Lingerie', 'hint' => ''],
                ['key' => 'Scarves', 'hint' => ''],
                ['key' => 'Designer Handbags', 'hint' => ''],
                ['key' => 'Undergarments', 'hint' => ''],
                ['key' => 'Swimwear', 'hint' => ''],
            ],
            'Seasonal or Special Purpose Clothing' => [
                ['key' => 'Snow gear', 'hint' => '(e.g., ski pants, snow boots, gloves)'],
                ['key' => 'Rain gear', 'hint' => '(e.g., waterproof jackets, ponchos)'],
            ],
            'Specialty Footwear' => [
                ['key' => 'Dance shoes', 'hint' => '(e.g., ballet shoes, tap shoes)'],
                ['key' => 'Work-specific shoes', 'hint' => '(e.g., steel-toe boots, non-slip shoes)'],
            ],
            'Misc. Clothing' => [
                ['key' => 'Baby clothes', 'hint' => '(onesies, baby shoes, etc.)'],
                ['key' => "Scrubs", 'hint' => ''],
                ['key' => 'School uniforms', 'hint' => ''],
                ['key' => 'Backpacks', 'hint' => ''],
            ],
        ];

        return static::returnArrValue($arr, $key);
    }


    public static function getFirearmsArray($key = null)
    {
        $arr = [
            'Firearms' => [
                ['key' => '9mm Pistol', 'hint' => ''],
                ['key' => 'Rifles', 'hint' => '(bolt-action, semi-automatic, lever-action, etc.)'],
                ['key' => 'Shotguns', 'hint' => '(pump-action, semi-automatic, etc.)'],
                ['key' => '38 Cal. Pistol', 'hint' => ''],
                ['key' => '22 LR Pistol', 'hint' => ''],
                ['key' => '38 Cal. Pistol', 'hint' => ''],
                ['key' => '375 Mag Pistol', 'hint' => ''],
                ['key' => '44 Mag Pistol', 'hint' => ''],
            ],
            'Ammunition' => [
                ['key' => 'Ammo for guns', 'hint' => '(all calibers)'],
                ['key' => 'Shotgun shells', 'hint' => ''],
                ['key' => 'Magazines or clips for ammunition', 'hint' => ''],
                ['key' => 'Ammunition storage cases or containers', 'hint' => ''],
            ],
            'Accessories and Attachments' => [
                ['key' => 'Scopes/Sights', 'hint' => '(e.g., red dot, night vision scopes)'],
                ['key' => 'Barrel attachments', 'hint' => '(suppressors etc.)'],
                ['key' => 'Slings', 'hint' => '(where legal)'],
                ['key' => 'Stocks', 'hint' => ''],
            ],
            'Holsters and Cases' => [
                ['key' => 'Handgun holsters', 'hint' => '(belt, shoulder, ankle holsters, etc.)'],
                ['key' => 'Rifle or shotgun cases', 'hint' => '(hard or soft cases)'],
                ['key' => 'Range bags or gear bags', 'hint' => ''],
                ['key' => 'Gun safes or lockboxes', 'hint' => ''],
            ],
            'Hunting and Shooting Equipment' => [
                ['key' => 'Binoculars or rangefinders', 'hint' => ''],
                ['key' => 'Shooting targets', 'hint' => '(paper, steel, reactive targets)'],
                ['key' => 'Hunting - Clothing and footwear', 'hint' => ''],
                ['key' => 'Shooting mats', 'hint' => ''],
                ['key' => 'Gun cleaning kits', 'hint' => '(brushes, oils, patches)'],
                ['key' => 'Ear protection', 'hint' => '(e.g., earmuffs, earplugs)'],
                ['key' => 'Eye protection', 'hint' => '(shooting glasses or goggles)'],
                ['key' => 'Decoys and calls', 'hint' => ''],
            ],
            'Archery Equipment' => [
                ['key' => 'Bows', 'hint' => '(compound bows, recurve bows, longbows)'],
                ['key' => 'Crossbows', 'hint' => ''],
                ['key' => 'Arrows, bolts, and broadheads', 'hint' => ''],
                ['key' => 'Quivers and arrow storage', 'hint' => ''],
            ],
            'Tactical Gear' => [
                ['key' => 'Protective gear', 'hint' => '(helmets, ear protection, and padding)'],
                ['key' => 'Body armor', 'hint' => ''],
                ['key' => 'Ammunition belts or bandoliers', 'hint' => ''],
                ['key' => 'Shooting gloves', 'hint' => ''],
            ],
            'Range and Safety Equipment' => [
                ['key' => 'Shooting benches or rests', 'hint' => ''],
                ['key' => 'Sandbags for shooting stabilization', 'hint' => ''],
                ['key' => 'Magazine Loader', 'hint' => ''],
                ['key' => 'Firearm lock mechanisms or trigger locks', 'hint' => ''],
            ],
            'Collectible or Antique Weapons' => [
                ['key' => 'Historical or vintage firearms', 'hint' => ''],
                ['key' => 'Commemorative or special edition guns', 'hint' => ''],
                ['key' => 'Display cases for collectible firearms', 'hint' => ''],
            ],
        ];

        return static::returnArrValue($arr, $key);
    }


    public static function checkTabName($type)
    {
        switch ($type) {
            case 'basic':
                return (request()->routeIs('client_dashboard') || request()->routeIs('client_basic_info_step1') || request()->routeIs('client_basic_info_step2')) ? 'active' : '';
                break;
            case 'property':
                return (request()->routeIs('property_information') || request()->routeIs('client_property_step1') || request()->routeIs('client_property_step2') || request()->routeIs('client_property_step3') || request()->routeIs('client_property_step4_continue') || request()->routeIs('client_property_step4') || request()->routeIs('client_property_step4') || request()->routeIs('client_property_step5')) ? 'active' : '';
                break;
            case 'debt':
                return (request()->routeIs('client_debts_step2_unsecured') || request()->routeIs('client_debts_step2_back_tax') || request()->routeIs('client_debts_step2_domestic') || request()->routeIs('client_debts_step2_additional')) ? 'active' : '';
                break;
            case 'income':
                return (request()->routeIs('client_income') || request()->routeIs('client_income_step2') || request()->routeIs('client_income_step1') || request()->routeIs('client_income_step3')) ? 'active' : '';
                break;
            case 'expense':
                return (request()->routeIs('client_expenses') || request()->routeIs('client_spouse_expenses')) ? 'active' : '';
                break;

            case 'sofa':
                return (request()->routeIs('client_financial_affairs') || request()->routeIs('client_financial_affairs2') || request()->routeIs('client_financial_affairs3')) ? 'active' : '';
                break;
            default:
                return false;
                break;
        }

        return;
    }
}
