<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DemoCategoryAndItemSeeder extends Seeder
{
    /**
     * 検証用のカテゴリと商品データを作成する。
     *
     * @return void
     */
    private $unCategorizedItems = [
        [
            'code'               => 1,
            'name'               => '新作ケーキA',
            'receipt_name'       => '新作ケーキA',
            'description'        => 'これは新作ケーキAです。',
            'price'              => 650,
            'tax'                => 48,
            'tax_excluded_price' => 602,
            'sort_order'         => 0,
        ],
        [
            'code'               => 2,
            'name'               => '新作ケーキB',
            'receipt_name'       => '新作ケーキB',
            'description'        => 'これは新作ケーキBです。',
            'price'              => 550,
            'tax'                => 40,
            'tax_excluded_price' => 510,
            'sort_order'         => 0,
        ],
    ];

    private $petitGateau = [
        [
            'code'               => 100,
            'img_url'            => 'images/100.jpg',
            'name'               => 'オペラ',
            'receipt_name'       => 'オペラ',
            'description'        => '層になったガナッシュやクリームの濃厚な味わいと、しっとりとした食感が特長のチョコレートケーキです',
            'price'              => 650,
            'tax'                => 48,
            'tax_excluded_price' => 602,
            'sort_order'         => 0,
        ],
        [
            'code'               => 101,
            'img_url'            => 'images/101.jpg',
            'name'               => 'ドゥーブルショコラ',
            'receipt_name'       => 'ドゥーブルショコラ',
            'description'        => 'なめらかな口どけのビターチョコレートと、ふわふわのチョコレートスポンジを組み合わせた贅沢なケーキです',
            'price'              => 650,
            'tax'                => 48,
            'tax_excluded_price' => 602,
            'sort_order'         => 1,
        ],
        [
            'code'               => 102,
            'img_url'            => 'images/102.jpg',
            'name'               => 'ペルルノワール',
            'receipt_name'       => 'ペルルノワール',
            'description'        => 'オレンジマーマレードをヘーゼルナッツムースでくるみ、チョコレートでコーティングしました',
            'price'              => 650,
            'tax'                => 48,
            'tax_excluded_price' => 602,
            'sort_order'         => 2,
        ],
        [
            'code'               => 103,
            'img_url'            => 'images/103.jpg',
            'name'               => 'ミルフィーユフレーズ',
            'receipt_name'       => 'ミルフィーユフレーズ',
            'description'        => 'サクサクのパイ生地に、甘酸っぱいいちごとバニラの香り漂うカスタードクリームをサンドしました',
            'price'              => 550,
            'tax'                => 40,
            'tax_excluded_price' => 510,
            'sort_order'         => 3,
        ],
        [
            'code'               => 104,
            'img_url'            => 'images/104.jpg',
            'name'               => 'ムースオフレーズ',
            'receipt_name'       => 'ムースオフレーズ',
            'description'        => 'たっぷりのいちごを使用し濃厚な味わいに仕上げたムース。ピスタチオクリームがアクセントです',
            'price'              => 550,
            'tax'                => 40,
            'tax_excluded_price' => 510,
            'sort_order'         => 4,
        ],
        [
            'code'               => 105,
            'img_url'            => 'images/105.jpg',
            'name'               => 'フロマージュブラン',
            'receipt_name'       => 'フロマージュブラン',
            'description'        => 'フランス産のチーズのみを使用した、クリーミーでコクのある味わいです',
            'price'              => 550,
            'tax'                => 40,
            'tax_excluded_price' => 510,
            'sort_order'         => 5,
        ],
        [
            'code'               => 106,
            'img_url'            => 'images/106.jpg',
            'name'               => 'シューアラクレーム',
            'receipt_name'       => 'シューアラクレーム',
            'description'        => 'マダガスカル産バニラをきかせたカスタードクリームと生クリームをたっぷり詰めたサクサク食感のシューです',
            'price'              => 550,
            'tax'                => 40,
            'tax_excluded_price' => 510,
            'sort_order'         => 6,
        ],
        [
            'code'               => 107,
            'img_url'            => 'images/107.jpg',
            'name'               => 'モンブラン',
            'receipt_name'       => 'モンブラン',
            'description'        => 'コクのあるマロングラッセをメレンゲで包み、柔らかなマロンクリームで覆った上品なケーキです',
            'price'              => 550,
            'tax'                => 40,
            'tax_excluded_price' => 510,
            'sort_order'         => 7,
        ],
        [
            'code'               => 108,
            'img_url'            => 'images/108.jpg',
            'name'               => 'マングーココ',
            'receipt_name'       => 'マングーココ',
            'description'        => 'ココナッツ風味のなめらかなムースに、宮崎県産マンゴーの果肉を贅沢にトッピングしました',
            'price'              => 650,
            'tax'                => 48,
            'tax_excluded_price' => 602,
            'sort_order'         => 8,
        ],
        [
            'code'               => 109,
            'img_url'            => 'images/109.jpg',
            'name'               => '抹茶シフォン',
            'receipt_name'       => '抹茶シフォン',
            'description'        => '香り豊かな宇治抹茶を使用し、甘さ控えめに仕上げた当店自慢のふわふわシフォンケーキです',
            'price'              => 500,
            'tax'                => 37,
            'tax_excluded_price' => 463,
            'sort_order'         => 9,
        ],
    ];
    private $grandGateau = [
        [
            'code'               => 200,
            'img_url'            => 'images/200.jpg',
            'name'               => 'モンクール',
            'receipt_name'       => 'モンクール',
            'description'        => 'ギフトBOXを模したショコラにボンボンショコラのアソートを詰めたチョコ好きのためのデセールです',
            'price'              => 3000,
            'tax'                => 223,
            'tax_excluded_price' => 2777,
            'sort_order'         => 0,
        ],
        [
            'code'               => 201,
            'img_url'            => 'images/201.jpg',
            'name'               => 'ザッハトルテノエル',
            'receipt_name'       => 'ザッハトルテノエル',
            'description'        => '濃厚なチョコレートにアプリコットジャムの酸味をきかせた、ウィーン発祥のケーキです',
            'price'              => 3000,
            'tax'                => 223,
            'tax_excluded_price' => 2777,
            'sort_order'         => 1,
        ],
        [
            'code'               => 202,
            'img_url'            => 'images/202.jpg',
            'name'               => 'ベリーベリーショコラ',
            'receipt_name'       => 'ベリーベリーショコラ',
            'description'        => 'ミックスベリーのフィリングをはさんだ、ふわふわ食感のチョコレートケーキです',
            'price'              => 3000,
            'tax'                => 223,
            'tax_excluded_price' => 2777,
            'sort_order'         => 2,
        ],
        [
            'code'               => 203,
            'img_url'            => 'images/203.jpg',
            'name'               => 'フレジエ',
            'receipt_name'       => 'フレジエ',
            'description'        => 'アーモンドプードル入りのスポンジを北海道産ミルクのクリームで包み、いちごを贅沢に並べました',
            'price'              => 2500,
            'tax'                => 186,
            'tax_excluded_price' => 2314,
            'sort_order'         => 3,
        ],
        [
            'code'               => 204,
            'img_url'            => 'images/204.jpg',
            'name'               => 'ガレットデロワ',
            'receipt_name'       => 'ガレットデロワ',
            'description'        => 'フランス語で「王様のお菓子」という意味の、アーモンドクリームのパイです。フェーヴ入り',
            'price'              => 2500,
            'tax'                => 186,
            'tax_excluded_price' => 2314,
            'sort_order'         => 4,
        ],
        [
            'code'               => 205,
            'img_url'            => 'images/205.jpg',
            'name'               => 'タルトオポム',
            'receipt_name'       => 'タルトオポム',
            'description'        => '大きめにカットしたりんごをシナモンシュガーで煮詰め、エシレバターを練り込んだ生地と合わせたパイです',
            'price'              => 2500,
            'tax'                => 186,
            'tax_excluded_price' => 2314,
            'sort_order'         => 5,
        ],
        [
            'code'               => 206,
            'img_url'            => 'images/206.jpg',
            'name'               => 'モンブランノエル',
            'receipt_name'       => 'モンブランノエル',
            'description'        => '当店自慢のモンブランのクリスマススペシャルバージョン。ごろっと大きなマロングラッセをのせました',
            'price'              => 2000,
            'tax'                => 149,
            'tax_excluded_price' => 1851,
            'sort_order'         => 6,
        ],
        [
            'code'               => 207,
            'img_url'            => 'images/207.jpg',
            'name'               => 'タルトフリュイ',
            'receipt_name'       => 'タルトフリュイ',
            'description'        => 'フランス産のフレッシュバターを練り込んで焼き上げたタルト生地を、旬のフルーツで彩りました',
            'price'              => 2000,
            'tax'                => 149,
            'tax_excluded_price' => 1851,
            'sort_order'         => 7,
        ],
        [
            'code'               => 208,
            'img_url'            => 'images/208.jpg',
            'name'               => 'ブッシュドノエル',
            'receipt_name'       => 'ブッシュドノエル',
            'description'        => 'フランス伝統のクリスマスケーキ。ショコラ風味のスポンジに、雪景色のようなクリームをまとわせました',
            'price'              => 2000,
            'tax'                => 149,
            'tax_excluded_price' => 1851,
            'sort_order'         => 8,
        ],
    ];
    private $bread = [
        [
            'code'               => 300,
            'img_url'            => 'images/300.jpg',
            'name'               => 'バゲット',
            'receipt_name'       => 'バゲット',
            'description'        => '上質な小麦粉、塩、水、イーストで作った、フランスの伝統的なパンです',
            'price'              => 300,
            'tax'                => 23,
            'tax_excluded_price' => 277,
            'sort_order'         => 0,
        ],
        [
            'code'               => 301,
            'img_url'            => 'images/301.jpg',
            'name'               => 'クロワッサン',
            'receipt_name'       => 'クロワッサン',
            'description'        => '風味豊かなフランス産バターを生地に折り込み、何層にも重ねてサクサクに仕上げました',
            'price'              => 300,
            'tax'                => 23,
            'tax_excluded_price' => 277,
            'sort_order'         => 1,
        ],
        [
            'code'               => 302,
            'img_url'            => 'images/302.jpg',
            'name'               => 'カンパーニュ',
            'receipt_name'       => 'カンパーニュ',
            'description'        => 'フランスの田舎風のパンです。ライ麦粉と全粒粉を使用した、素朴で奥深い味わいです',
            'price'              => 300,
            'tax'                => 23,
            'tax_excluded_price' => 277,
            'sort_order'         => 2,
        ],
        [
            'code'               => 303,
            'img_url'            => 'images/303.jpg',
            'name'               => 'シャンピニオン',
            'receipt_name'       => 'シャンピニオン',
            'description'        => 'フランス語で「きのこ」という意味のパンです。カリッとした食感と香ばしさが楽しめます',
            'price'              => 250,
            'tax'                => 19,
            'tax_excluded_price' => 231,
            'sort_order'         => 3,
        ],
        [
            'code'               => 304,
            'img_url'            => 'images/304.jpg',
            'name'               => 'フォカッチャ',
            'receipt_name'       => 'フォカッチャ',
            'description'        => '古代ローマにルーツを持つパンです。シチリア産のオリーブオイルを贅沢に使用し、ローズマリーをのせました',
            'price'              => 250,
            'tax'                => 19,
            'tax_excluded_price' => 231,
            'sort_order'         => 4,
        ],
        [
            'code'               => 305,
            'img_url'            => 'images/305.jpg',
            'name'               => 'ベーグル',
            'receipt_name'       => 'ベーグル',
            'description'        => '素材本来の風味を活かし、丁寧に作っています。トーストしても、そのままでも美味しく召し上がれます',
            'price'              => 250,
            'tax'                => 19,
            'tax_excluded_price' => 231,
            'sort_order'         => 5,
        ],
        [
            'code'               => 306,
            'img_url'            => 'images/306.jpg',
            'name'               => 'プレッツェル',
            'receipt_name'       => 'プレッツェル',
            'description'        => '結び目の形が特徴の、ドイツ発祥のパンです。外側はカリッと香ばしく、中はふわふわの食感を楽しめます',
            'price'              => 250,
            'tax'                => 19,
            'tax_excluded_price' => 231,
            'sort_order'         => 6,
        ],
    ];
    private $pastry = [
        [
            'code'               => 400,
            'img_url'            => 'images/400.jpg',
            'name'               => 'カヌレ',
            'receipt_name'       => 'カヌレ',
            'description'        => 'マダガスカル産のバニラとラム酒の香りをきかせ、外はカリッと、中はモチモチの食感に仕上げました',
            'price'              => 350,
            'tax'                => 26,
            'tax_excluded_price' => 324,
            'sort_order'         => 0,
        ],
        [
            'code'               => 401,
            'img_url'            => 'images/401.jpg',
            'name'               => 'マドレーヌ',
            'receipt_name'       => 'マドレーヌ',
            'description'        => '新鮮な卵とバターを使用した、しっとりリッチな味わいです',
            'price'              => 350,
            'tax'                => 26,
            'tax_excluded_price' => 324,
            'sort_order'         => 1,
        ],
        [
            'code'               => 402,
            'img_url'            => 'images/402.jpg',
            'name'               => 'マフィン',
            'receipt_name'       => 'マフィン',
            'description'        => '厳選した国産小麦を使用し、ふっくらと焼き上げたマフィンです。朝食やおやつにどうぞ',
            'price'              => 350,
            'tax'                => 26,
            'tax_excluded_price' => 324,
            'sort_order'         => 2,
        ],
        [
            'code'               => 403,
            'img_url'            => 'images/403.jpg',
            'name'               => '本日のクッキー',
            'receipt_name'       => '本日のクッキー',
            'description'        => '季節の素材を使った日替わりクッキーです',
            'price'              => 250,
            'tax'                => 19,
            'tax_excluded_price' => 231,
            'sort_order'         => 3,
        ],
        [
            'code'               => 404,
            'img_url'            => 'images/404.jpg',
            'name'               => 'ラングドシャ',
            'receipt_name'       => 'ラングドシャ',
            'description'        => 'フランス語で「猫の舌」という意味の焼き菓子です。繊細な生地にクリームをサンドしました',
            'price'              => 250,
            'tax'                => 19,
            'tax_excluded_price' => 231,
            'sort_order'         => 4,
        ],
        [
            'code'               => 405,
            'img_url'            => 'images/405.jpg',
            'name'               => 'チョコチップスコーン',
            'receipt_name'       => 'チョコチップスコーン',
            'description'        => '上質なバターと小麦にほんのり塩をきかせ、チョコチップを混ぜ込みました',
            'price'              => 250,
            'tax'                => 19,
            'tax_excluded_price' => 231,
            'sort_order'         => 5,
        ],
    ];
    private $chocolate = [
        [
            'code'               => 500,
            'img_url'            => 'images/500.jpg',
            'name'               => 'カレ',
            'receipt_name'       => 'カレ',
            'description'        => 'ミルクチョコレートのまろやかさを極限まで引き出したガナッシュです',
            'price'              => 250,
            'tax'                => 19,
            'tax_excluded_price' => 231,
            'sort_order'         => 0,
        ],
        [
            'code'               => 501,
            'img_url'            => 'images/501.jpg',
            'name'               => 'キャラメルカレ',
            'receipt_name'       => 'キャラメルカレ',
            'description'        => '香ばしいキャラメルクリームを、ほんのり塩をきかせたキャラメルチョコレートで包みました',
            'price'              => 250,
            'tax'                => 19,
            'tax_excluded_price' => 231,
            'sort_order'         => 1,
        ],
        [
            'code'               => 502,
            'img_url'            => 'images/502.jpg',
            'name'               => 'バトン',
            'receipt_name'       => 'バトン',
            'description'        => 'ココアクリームをサクサクのウエハースでサンドし、ダークチョコレートでコーティングしました',
            'price'              => 250,
            'tax'                => 19,
            'tax_excluded_price' => 231,
            'sort_order'         => 2,
        ],
        [
            'code'               => 503,
            'img_url'            => 'images/503.jpg',
            'name'               => 'ノワール',
            'receipt_name'       => 'ノワール',
            'description'        => '厳選したカカオで作ったビターチョコレートのガナッシュです',
            'price'              => 250,
            'tax'                => 19,
            'tax_excluded_price' => 231,
            'sort_order'         => 3,
        ],
        [
            'code'               => 504,
            'img_url'            => 'images/504.jpg',
            'name'               => 'プラリネ',
            'receipt_name'       => 'プラリネ',
            'description'        => '香り豊かなジャンドゥーヤをダークチョコレートで包みました',
            'price'              => 250,
            'tax'                => 19,
            'tax_excluded_price' => 231,
            'sort_order'         => 4,
        ],
        [
            'code'               => 505,
            'img_url'            => 'images/505.jpg',
            'name'               => 'トリュフ',
            'receipt_name'       => 'トリュフ',
            'description'        => '上質のカカオとミルクを使用し、とろける食感となめらかな口どけを楽しめます',
            'price'              => 250,
            'tax'                => 19,
            'tax_excluded_price' => 231,
            'sort_order'         => 5,
        ],
        [
            'code'               => 506,
            'img_url'            => 'images/506.jpg',
            'name'               => 'ロッシェ',
            'receipt_name'       => 'ロッシェ',
            'description'        => 'フランス語で「岩」という意味の、ナッツを贅沢に使用したチョコレート。ザクザク食感が特徴です',
            'price'              => 250,
            'tax'                => 19,
            'tax_excluded_price' => 231,
            'sort_order'         => 6,
        ],
        [
            'code'               => 507,
            'img_url'            => 'images/507.jpg',
            'name'               => 'ロゼ',
            'receipt_name'       => 'ロゼ',
            'description'        => 'なめらかなホワイトチョコレートに、甘酸っぱいフランボワーズを練り込みました',
            'price'              => 250,
            'tax'                => 19,
            'tax_excluded_price' => 231,
            'sort_order'         => 7,
        ],
    ];
    private $macarons = [
        [
            'code'               => 600,
            'img_url'            => 'images/600.jpg',
            'name'               => 'ブラッドオレンジ',
            'receipt_name'       => 'ブラッドオレンジ',
            'description'        => 'シチリア産のブラッドオレンジを使用した爽やかな風味のマカロンです',
            'price'              => 350,
            'tax'                => 26,
            'tax_excluded_price' => 324,
            'sort_order'         => 0,
        ],
        [
            'code'               => 601,
            'img_url'            => 'images/601.jpg',
            'name'               => 'フランボワーズ',
            'receipt_name'       => 'フランボワーズ',
            'description'        => 'フランボワーズのコンフィチュールを挟んだマカロンです',
            'price'              => 350,
            'tax'                => 26,
            'tax_excluded_price' => 324,
            'sort_order'         => 1,
        ],
        [
            'code'               => 602,
            'img_url'            => 'images/602.jpg',
            'name'               => 'ロゼ',
            'receipt_name'       => 'ロゼ',
            'description'        => '香り高いバラの花を使用した、贅沢な味わいのマカロンです',
            'price'              => 350,
            'tax'                => 26,
            'tax_excluded_price' => 324,
            'sort_order'         => 2,
        ],
        [
            'code'               => 603,
            'img_url'            => 'images/603.jpg',
            'name'               => 'キャラメル',
            'receipt_name'       => 'キャラメル',
            'description'        => 'とろけるような甘さのキャラメルとバタークリームが好相性のマカロンです',
            'price'              => 350,
            'tax'                => 26,
            'tax_excluded_price' => 324,
            'sort_order'         => 3,
        ],
        [
            'code'               => 604,
            'img_url'            => 'images/604.jpg',
            'name'               => 'ヴァニーユ',
            'receipt_name'       => 'ヴァニーユ',
            'description'        => 'マダガスカル産のバニラを贅沢に使用した、芳醇な風味のマカロンです',
            'price'              => 350,
            'tax'                => 26,
            'tax_excluded_price' => 324,
            'sort_order'         => 4,
        ],
        [
            'code'               => 605,
            'img_url'            => 'images/605.jpg',
            'name'               => 'シトロン',
            'receipt_name'       => 'シトロン',
            'description'        => 'シチリア産のレモンの爽やかな風味を活かしたマカロンです',
            'price'              => 350,
            'tax'                => 26,
            'tax_excluded_price' => 324,
            'sort_order'         => 5,
        ],
        [
            'code'               => 606,
            'img_url'            => 'images/606.jpg',
            'name'               => 'マングー',
            'receipt_name'       => 'マングー',
            'description'        => '宮崎県産マンゴーの甘さが際立つマカロンです',
            'price'              => 350,
            'tax'                => 26,
            'tax_excluded_price' => 324,
            'sort_order'         => 6,
        ],
        [
            'code'               => 607,
            'img_url'            => 'images/607.jpg',
            'name'               => 'ミント',
            'receipt_name'       => 'ミント',
            'description'        => 'フレッシュなミントを使用し、すっきり爽やかな味わいに仕上げました',
            'price'              => 350,
            'tax'                => 26,
            'tax_excluded_price' => 324,
            'sort_order'         => 7,
        ],
        [
            'code'               => 608,
            'img_url'            => 'images/608.jpg',
            'name'               => 'ヴィオレッテ',
            'receipt_name'       => 'ヴィオレッテ',
            'description'        => 'オーストリアのお菓子「すみれの砂糖漬け」から着想を得た、華やかな甘さのマカロンです',
            'price'              => 350,
            'tax'                => 26,
            'tax_excluded_price' => 324,
            'sort_order'         => 8,
        ],
    ];
    private $gift = [
        [
            'code'               => 700,
            'img_url'            => 'images/700.jpg',
            'name'               => 'クッキーアソート',
            'receipt_name'       => 'クッキーアソート',
            'description'        => 'ギフトにぴったりの、缶入りのクッキー40枚入りです。種類は日替わりです',
            'price'              => 8000,
            'tax'                => 593,
            'tax_excluded_price' => 7407,
            'sort_order'         => 0,
        ],
        [
            'code'               => 701,
            'img_url'            => 'images/701.jpg',
            'name'               => 'マカロンアソート',
            'receipt_name'       => 'マカロンアソート',
            'description'        => '30個入りのマカロンが入ったおしゃれなBOXです。種類は日替わりです',
            'price'              => 8500,
            'tax'                => 630,
            'tax_excluded_price' => 7870,
            'sort_order'         => 1,
        ],
        [
            'code'               => 702,
            'img_url'            => 'images/702.jpg',
            'name'               => '焼き菓子のアソート',
            'receipt_name'       => '焼き菓子のアソート',
            'description'        => '30個入りの焼き菓子のアソートです。種類は日替わりです',
            'price'              => 9000,
            'tax'                => 667,
            'tax_excluded_price' => 8333,
            'sort_order'         => 2,
        ],
        [
            'code'               => 703,
            'img_url'            => 'images/703.jpg',
            'name'               => 'ショコラアソート',
            'receipt_name'       => 'ショコラアソート',
            'description'        => '24個入りのショコラのアソートです。種類は日替わりです。特別な人への贈り物におすすめです',
            'price'              => 5000,
            'tax'                => 371,
            'tax_excluded_price' => 4629,
            'sort_order'         => 3,
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // テーブルをクリア
        Model::unguard();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('category_item')->truncate();
        DB::table('orders')->truncate();
        DB::table('receipts')->truncate();
        Item::truncate();
        Category::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        Model::reguard();

        // 未分類商品
        foreach ($this->unCategorizedItems as $data) {
            $item = Item::factory($data)->create();
        }

        $category = Category::factory()->create([
            'name'       => 'プチガトー',
            'img_url'    => '/images/100.jpg',
            'sort_order' => 0,
        ]);
        foreach ($this->petitGateau as $data) {
            $item = Item::factory($data)->create();
            $category->items()->save($item);
        }

        $category = Category::factory()->create([
            'name'       => 'グランガトー',
            'img_url'    => '/images/200.jpg',
            'sort_order' => 1,
        ]);
        foreach ($this->grandGateau as $data) {
            $item = Item::factory($data)->create();
            $category->items()->save($item);
        }

        $category = Category::factory()->create([
            'name'       => 'パン',
            'img_url'    => '/images/300.jpg',
            'sort_order' => 2,
        ]);
        foreach ($this->bread as $data) {
            $item = Item::factory($data)->create();
            $category->items()->save($item);
        }

        $category = Category::factory()->create([
            'name'       => '焼き菓子',
            'img_url'    => '/images/400.jpg',
            'sort_order' => 3,
        ]);
        foreach ($this->pastry as $data) {
            $item = Item::factory($data)->create();
            $category->items()->save($item);
        }

        $category = Category::factory()->create([
            'name'       => 'ショコラ',
            'img_url'    => '/images/500.jpg',
            'sort_order' => 4,
        ]);
        foreach ($this->chocolate as $data) {
            $item = Item::factory($data)->create();
            $category->items()->save($item);
        }

        $category = Category::factory()->create([
            'name'       => 'マカロン',
            'img_url'    => '/images/600.jpg',
            'sort_order' => 5,
        ]);
        foreach ($this->macarons as $data) {
            $item = Item::factory($data)->create();
            $category->items()->save($item);
        }

        $category = Category::factory()->create([
            'name'       => '詰合せギフト',
            'img_url'    => '/images/700.jpg',
            'sort_order' => 6,
        ]);
        foreach ($this->gift as $data) {
            $item = Item::factory($data)->create();
            $category->items()->save($item);
        }
    }
}
