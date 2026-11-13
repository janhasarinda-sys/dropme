<?php
// ===== DropMe Tours - site settings (edit these) =====
$SITE = [
    'name'     => 'DropMe Tours (Pvt) Ltd',
    'tagline'  => 'Travel Smart. Travel Safe. Travel Better.',
    'email'    => 'dropmetours@gmail.com',
    'phone'    => '+94 72 131 3114',
    'whatsapp' => '94721313114',
    'address'  => 'Wadduwa, Sri Lanka',
    'map_link' => 'https://maps.google.com/maps/search/Wadduwa%2C%20Sri%20Lanka/@6.6674,79.9352,17z?hl=en',
    'map_embed'=> 'https://maps.google.com/maps?q=6.6674,79.9352&z=15&output=embed',
    'since'    => 2018,
];

// Password for admin.php (view booking requests). CHANGE THIS.
$ADMIN_PASSWORD = 'dropme2018';

// Tour packages - edit / add freely
// 'type'     => 'round' (several days) or 'day' (one day, back the same night)
// 'stops'    => the route, in order (shown on the Tours page)
// 'featured' => true shows it on the home page (keep 4 featured)
$TOURS = [
    // ---- Round tours ----
    ['type'=>'round','featured'=>true,'icon'=>'🗺️','title'=>'Classic Sri Lanka','days'=>'9 days / 8 nights',
     'text'=>'The best-known sights in one trip: ancient cities, the hill country, two safaris and the south coast.',
     'stops'=>['Airport pickup','Pinnawala elephant orphanage','Sigiriya rock','Polonnaruwa','Minneriya safari','Dambulla cave temple','Kandy','Nuwara Eliya tea country','Ravana Falls','Yala safari','Galle Fort','Airport drop']],
    ['type'=>'round','featured'=>true,'icon'=>'🚂','title'=>'Kandy, Tea Country & Bentota','days'=>'6 days / 5 nights',
     'text'=>'A shorter trip with the Kandy to Nanu Oya train ride, a tea factory visit and two days on the beach.',
     'stops'=>['Colombo city tour','Pinnawala elephant orphanage','Temple of the Tooth, Kandy','Peradeniya botanical garden','Train from Kandy to Nanu Oya','Nuwara Eliya tea estate','St. Clair\'s and Devon waterfalls','Bentota beach','Madu river boat ride','Turtle hatchery']],
    ['type'=>'round','featured'=>true,'icon'=>'⛰️','title'=>'Hill Country & South Coast','days'=>'14 days / 13 nights',
     'text'=>'Two weeks at an easy pace: Kandy, the train to Ella, an elephant safari, then beaches and whale watching.',
     'stops'=>['Negombo fishing village','Kandy and Temple of the Tooth','Ramboda waterfalls','Nuwara Eliya','Train from Nanu Oya to Ella','Nine Arch Bridge','Little Adam\'s Peak','Udawalawe safari','Unawatuna beach','Whale watching at Mirissa','Galle Fort']],
    ['type'=>'round','featured'=>true,'icon'=>'🐆','title'=>'Leopard & Wildlife Trail','days'=>'7 days / 6 nights',
     'text'=>'For animal lovers: jeep safaris in three national parks, with early starts for the best sightings.',
     'stops'=>['Wilpattu National Park','Udawalawe National Park','Elephant Transit Home','Yala National Park','Bundala bird sanctuary']],
    ['type'=>'round','featured'=>true,'icon'=>'🛕','title'=>'Short Break: Kandy & Nuwara Eliya','days'=>'4 days / 3 nights',
     'text'=>'A quick escape to the cooler hills, then back through Colombo for shopping.',
     'stops'=>['Kandy','Temple of the Tooth','Kandyan dance show','Nuwara Eliya','Tea factory','Gregory Lake','Colombo']],

    // ---- Day tours (from Wadduwa, back the same day) ----
    ['type'=>'day','featured'=>true,'icon'=>'🐋','title'=>'Whale Watching at Mirissa','days'=>'1 day',
     'text'=>'Early boat trip off Mirissa to see blue whales and dolphins, best from November to April.',
     'stops'=>['Hotel pickup','Mirissa harbour','Boat trip (about 4–5 hours)','Galle Fort on the way back']],
    ['type'=>'day','featured'=>true,'icon'=>'🐘','title'=>'Yala Jeep Safari','days'=>'1 long day',
     'text'=>'Leave before dawn for a jeep safari in Yala, home to leopards, elephants and hundreds of birds.',
     'stops'=>['Early pickup','Yala National Park jeep safari','Lunch','Return in the evening']],
    ['type'=>'day','featured'=>true,'icon'=>'🦣','title'=>'Udawalawe Elephant Safari','days'=>'1 day',
     'text'=>'Udawalawe is the easiest park to see big herds of wild elephants.',
     'stops'=>['Pickup','Elephant Transit Home','Udawalawe jeep safari','Return']],
    ['type'=>'day','featured'=>true,'icon'=>'🏰','title'=>'Galle Day Tour','days'=>'1 day',
     'text'=>'Walk the old Dutch fort, then stop at beaches and a turtle hatchery on the coast road.',
     'stops'=>['Turtle hatchery','Galle Fort','Unawatuna beach','Return along the coast']],
    ['type'=>'day','icon'=>'🛶','title'=>'Bentota & Madu River','days'=>'Half or full day',
     'text'=>'Close to Wadduwa: a boat ride through the mangroves of the Madu river and time on Bentota beach.',
     'stops'=>['Madu river boat ride','Cinnamon island','Turtle hatchery','Bentota beach']],
    ['type'=>'day','icon'=>'🏙️','title'=>'Colombo City Tour','days'=>'1 day',
     'text'=>'Temples, markets and the seafront in Sri Lanka\'s biggest city.',
     'stops'=>['Gangaramaya Temple','Pettah market','Independence Square','Lotus Tower','Galle Face Green']],
    ['type'=>'day','icon'=>'🛕','title'=>'Kandy Day Tour','days'=>'1 long day',
     'text'=>'The hill capital: the Temple of the Tooth, the botanical garden and the lake.',
     'stops'=>['Peradeniya botanical garden','Kandy lake','Temple of the Tooth','Kandyan dance show']],
    ['type'=>'day','icon'=>'🦁','title'=>'Sigiriya & Dambulla','days'=>'1 long day',
     'text'=>'Climb Sigiriya rock and see the painted caves of Dambulla. A long drive, so many guests stay overnight.',
     'stops'=>['Sigiriya rock fortress','Dambulla cave temple','Spice garden']],
    ['type'=>'day','icon'=>'🌿','title'=>'Sinharaja Rainforest','days'=>'1 day',
     'text'=>'A guided walk in Sri Lanka\'s last big rainforest, full of birds and rare plants.',
     'stops'=>['Pickup','Guided rainforest walk','Waterfall','Return']],
    ['type'=>'day','icon'=>'🚣','title'=>'Kitulgala White-Water Rafting','days'=>'1 day',
     'text'=>'Rafting on the Kelani river, with jungle walks and swimming for those who want it.',
     'stops'=>['Kitulgala','Rafting on the Kelani river','Jungle walk','Return']],
];

// Photo for each tour (files in images/tours/). Tours not listed use the beach photo.
// To use your own photo: put it in images/tours/ and change the file name here.
$TOUR_PHOTOS = [
    'Classic Sri Lanka'                 => 'sigiriya.jpg',
    'Kandy, Tea Country & Bentota'      => 'kandy.jpg',
    'Hill Country & South Coast'        => 'ella.jpg',
    'Leopard & Wildlife Trail'          => 'elephants.jpg',
    'Short Break: Kandy & Nuwara Eliya' => 'kandy.jpg',
    'Whale Watching at Mirissa'         => 'whale.jpg',
    'Yala Jeep Safari'                  => 'leopard.jpg',
    'Udawalawe Elephant Safari'         => 'elephants.jpg',
    'Galle Day Tour'                    => 'galle.jpg',
    'Bentota & Madu River'              => 'madu.jpg',
    'Kandy Day Tour'                    => 'kandy.jpg',
    'Sigiriya & Dambulla'               => 'sigiriya.jpg',
    'Colombo City Tour'                 => 'colombo.jpg',
    'Sinharaja Rainforest'              => 'sinharaja.jpg',
    'Kitulgala White-Water Rafting'     => 'rafting.jpg',
];

// Photos on the Gallery page: [file, caption]
$GALLERY = [
    ['images/hero-bg.jpg',             'Unawatuna beach at sunset'],
    ['images/tours/sigiriya.jpg',      'Sigiriya rock fortress'],
    ['images/tours/ella.jpg',          'Nine Arch Bridge, Ella'],
    ['images/tours/leopard.jpg',       'Leopard in Yala National Park'],
    ['images/tours/kandy.jpg',         'Kandy lake'],
    ['images/tours/whale.jpg',         'Blue whale off Mirissa'],
    ['images/tours/galle.jpg',         'Galle Fort from above'],
    ['images/tours/elephants.jpg',     'Young elephants at Udawalawe'],
    ['images/tours/colombo.jpg',       'Colombo skyline and Lotus Tower'],
    ['images/tours/sinharaja.jpg',     'Walking in Sinharaja rainforest'],
    ['images/tours/rafting.jpg',       'Rafting the Kelani river at Kitulgala'],
    ['images/tours/madu.jpg',          'Boat ride on the Madu river'],
    ['images/tours/colombo-sunset.jpg','Colombo at dusk'],
    ['images/van.jpg',                 'Our KDH van'],
    ['images/suv.jpg',                 'SUV for families and long trips'],
    ['images/coach.jpg',               'Mini coach for groups'],
];
// ===== Map locations =====
// Every place a tour can show on the map: 'key' => [name, latitude, longitude, short note]
// To find coordinates: right-click a place in Google Maps and click the numbers to copy them.
$PLACES = [
    'wadduwa'     => ['Wadduwa (our base)',          6.6674, 79.9352, 'Pickup from your hotel on the west coast'],
    'airport'     => ['Bandaranaike Airport',        7.1808, 79.8841, 'Meet & greet at arrivals'],
    'colombo'     => ['Colombo',                     6.9271, 79.8612, 'Temples, markets and Galle Face Green'],
    'negombo'     => ['Negombo',                     7.2083, 79.8358, 'Fishing village and lagoon'],
    'pinnawala'   => ['Pinnawala',                   7.3006, 80.3870, 'Elephant orphanage'],
    'sigiriya'    => ['Sigiriya',                    7.9570, 80.7603, 'Lion Rock fortress, UNESCO site'],
    'polonnaruwa' => ['Polonnaruwa',                 7.9403, 81.0188, 'Ancient royal city'],
    'minneriya'   => ['Minneriya',                   8.0333, 80.9000, 'Elephant gathering safari'],
    'dambulla'    => ['Dambulla',                    7.8567, 80.6492, 'Painted cave temple'],
    'kandy'       => ['Kandy',                       7.2936, 80.6413, 'Temple of the Tooth and the lake'],
    'peradeniya'  => ['Peradeniya',                  7.2690, 80.5970, 'Royal botanical garden'],
    'ramboda'     => ['Ramboda Falls',               7.0590, 80.6950, 'Waterfalls on the hill road'],
    'stclairs'    => ['St. Clair\'s Falls',          6.9790, 80.6440, 'The "little Niagara" of Sri Lanka'],
    'nuwaraeliya' => ['Nuwara Eliya',                6.9497, 80.7891, 'Tea estates and cool climate'],
    'nanuoya'     => ['Nanu Oya',                    6.9440, 80.7480, 'Train station for the hill line'],
    'ella'        => ['Ella',                        6.8667, 81.0466, 'Nine Arch Bridge, Little Adam\'s Peak'],
    'ravana'      => ['Ravana Falls',                6.8406, 81.0544, 'Waterfall near Ella'],
    'udawalawe'   => ['Udawalawe',                   6.4740, 80.8987, 'Wild elephant herds'],
    'yala'        => ['Yala',                        6.3728, 81.5016, 'Leopards and elephants'],
    'bundala'     => ['Bundala',                     6.1950, 81.2300, 'Bird sanctuary'],
    'wilpattu'    => ['Wilpattu',                    8.4500, 80.0400, 'Largest national park'],
    'mirissa'     => ['Mirissa',                     5.9483, 80.4716, 'Whale watching'],
    'unawatuna'   => ['Unawatuna',                   6.0100, 80.2490, 'Palm-fringed beach'],
    'galle'       => ['Galle Fort',                  6.0269, 80.2170, 'Dutch fort, UNESCO site'],
    'kosgoda'     => ['Kosgoda',                     6.3320, 80.0270, 'Turtle hatchery'],
    'madu'        => ['Madu River',                  6.2833, 80.0500, 'Mangrove boat ride'],
    'bentota'     => ['Bentota',                     6.4210, 79.9950, 'Beach and river'],
    'sinharaja'   => ['Sinharaja',                   6.4006, 80.4200, 'Rainforest, UNESCO site'],
    'kitulgala'   => ['Kitulgala',                   6.9906, 80.4183, 'White-water rafting'],
];

// The route each tour follows on the map, in order (keys from $PLACES above)
$TOUR_MAPS = [
    'Classic Sri Lanka'                 => ['airport','pinnawala','sigiriya','polonnaruwa','minneriya','dambulla','kandy','nuwaraeliya','ravana','yala','galle','airport'],
    'Kandy, Tea Country & Bentota'      => ['colombo','pinnawala','kandy','peradeniya','nanuoya','nuwaraeliya','stclairs','bentota','madu','kosgoda'],
    'Hill Country & South Coast'        => ['negombo','kandy','ramboda','nuwaraeliya','nanuoya','ella','udawalawe','unawatuna','mirissa','galle'],
    'Leopard & Wildlife Trail'          => ['wilpattu','udawalawe','yala','bundala'],
    'Short Break: Kandy & Nuwara Eliya' => ['kandy','nuwaraeliya','colombo'],
    'Whale Watching at Mirissa'         => ['wadduwa','mirissa','galle','wadduwa'],
    'Yala Jeep Safari'                  => ['wadduwa','yala','wadduwa'],
    'Udawalawe Elephant Safari'         => ['wadduwa','udawalawe','wadduwa'],
    'Galle Day Tour'                    => ['wadduwa','kosgoda','galle','unawatuna','wadduwa'],
    'Bentota & Madu River'              => ['wadduwa','madu','kosgoda','bentota','wadduwa'],
    'Colombo City Tour'                 => ['wadduwa','colombo','wadduwa'],
    'Kandy Day Tour'                    => ['wadduwa','peradeniya','kandy','wadduwa'],
    'Sigiriya & Dambulla'               => ['wadduwa','sigiriya','dambulla','wadduwa'],
    'Sinharaja Rainforest'              => ['wadduwa','sinharaja','wadduwa'],
    'Kitulgala White-Water Rafting'     => ['wadduwa','kitulgala','wadduwa'],
];

foreach ($TOURS as &$t) {
    $t['img'] = isset($TOUR_PHOTOS[$t['title']]) ? 'images/tours/' . $TOUR_PHOTOS[$t['title']] : 'images/hero-bg.jpg';
    $t['slug'] = trim(preg_replace('/[^a-z0-9]+/', '-', strtolower($t['title'])), '-');
    $t['points'] = [];
    foreach ($TOUR_MAPS[$t['title']] ?? [] as $key) {
        if (isset($PLACES[$key])) {
            [$n, $lat, $lng, $note] = $PLACES[$key];
            $t['points'][] = ['key' => $key, 'name' => $n, 'lat' => $lat, 'lng' => $lng, 'note' => $note];
        }
    }
}
unset($t);

// Data for the JavaScript maps
function tours_map_json($tours) {
    $out = [];
    foreach ($tours as $t) {
        if (!$t['points']) continue;
        $out[] = ['slug' => $t['slug'], 'title' => $t['title'], 'days' => $t['days'], 'type' => $t['type'],
                  'img' => $t['img'], 'text' => $t['text'], 'points' => $t['points']];
    }
    return json_encode($out, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP);
}

// Photo credits. The licences of these photos require the photographer's name
// to appear on the site, so they are listed at the bottom of the Gallery page.
// If you replace a photo with your own, delete its line here.
$CREDITS = [
    ['Unawatuna beach', 'Samal Nadeeshan', 'CC BY-SA 4.0', 'https://commons.wikimedia.org/wiki/File:Wijaya_beach_Unawatuna_Sri_Lanka.jpg'],
    ['Nine Arch Bridge, Ella', 'Dr.S.Rajivraja', 'CC BY-SA 4.0', 'https://commons.wikimedia.org/wiki/File:Nine_Arch_Bridge,_Demodara_Ella.jpg'],
    ['Galle Fort lighthouse', 'Rovin Shanila', 'CC BY-SA 4.0', 'https://commons.wikimedia.org/wiki/File:Galle_Fort_Lighthouse.jpg'],
    ['Leopard, Yala', 'Byrdyak', 'CC BY-SA 4.0', 'https://commons.wikimedia.org/wiki/File:Leopard_on_stone_in_Yala_National_Park.jpg'],
    ['Udawalawe elephants', 'Z thomas', 'CC BY-SA 4.0', 'https://commons.wikimedia.org/wiki/File:Udawalawe_Elephant_Transit_Home_2017-10-27_(13).jpg'],
    ['Blue whale', 'Peter van der Sluijs', 'CC BY-SA 3.0', 'https://commons.wikimedia.org/wiki/File:Blue_whale_tale_Sri_Lanka.jpg'],
    ['Madu Ganga', 'briandemel', 'CC BY-SA 4.0', 'https://commons.wikimedia.org/wiki/File:Madu_Ganga,_Sri_Lanka.jpg'],
    ['Sinharaja rainforest', 'Ruwan Illeperuma', 'CC BY-SA 4.0', 'https://commons.wikimedia.org/wiki/File:Ginat_Liana_hanging_on_giant_trees_in_Sinharaja_Rain_forest_of_Sri_Lanka.jpg'],
    ['Kelani river rafting', 'Pol van den Scheetek', 'CC BY 3.0', 'https://commons.wikimedia.org/wiki/File:Kelani_Ganga_Rafting_-_panoramio.jpg'],
];

// Driving times (approximate, edit freely)
$ROUTES = [
    ['to'=>'Bandaranaike Airport (CMB)', 'time'=>'1 h 15 min'],
    ['to'=>'Colombo',                    'time'=>'50 min'],
    ['to'=>'Bentota',                    'time'=>'45 min'],
    ['to'=>'Galle',                      'time'=>'1 h 20 min'],
    ['to'=>'Kandy',                      'time'=>'3 h 30 min'],
    ['to'=>'Sigiriya',                   'time'=>'4 h 30 min'],
    ['to'=>'Nuwara Eliya',               'time'=>'5 h'],
    ['to'=>'Ella',                       'time'=>'5 h 30 min'],
    ['to'=>'Yala',                       'time'=>'4 h'],
];

// Vehicles for hire (with driver) and rent-a-car (self drive)
// 'rate' => text shown on the card. Leave '' to show "Call for rates".
$VEHICLES = [
// 'img' => photo in the images folder (replace with your own vehicle photos any time, same file name)
    ['icon'=>'🚗','img'=>'images/car.jpg','type'=>'Car','models'=>'Toyota Axio / Prius / Aqua','seats'=>'1–3','bags'=>'2','ac'=>true,'self'=>true,'rate'=>''],
    ['icon'=>'🚙','img'=>'images/suv.jpg','type'=>'SUV','models'=>'Toyota Prado / Mitsubishi Montero','seats'=>'1–5','bags'=>'4','ac'=>true,'self'=>true,'rate'=>''],
    ['icon'=>'🚐','img'=>'images/van.jpg','type'=>'Van','models'=>'Toyota KDH High Roof','seats'=>'4–9','bags'=>'8','ac'=>true,'self'=>false,'rate'=>''],
    ['icon'=>'🚌','img'=>'images/coach.jpg','type'=>'Mini Coach','models'=>'Toyota Coaster / Rosa','seats'=>'10–25','bags'=>'20','ac'=>true,'self'=>false,'rate'=>''],
];
