<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Webpatser\Uuid\Uuid;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrayProducts = [
            [
                'uuid' => 'fcce115b-4dd8-4a8f-82eb-3269be968b2a',
                'article_number' => '6549225',
                'price' => 782000, // 78.20 грн - умножение на 10 тысяч
                'quantity' => 20,
                'category_id' => 1,
                'user_own_id' => 1,
                'slug' => 'Produkt-Nomer-Odin',
                'title_ru' => 'Продукт номер один',
                'description_ru' => 'Описание продукта номер один, довольно коротко и много воды, но тем не менее описание.',
                'meta_keywords' => 'продукт номер один, №1, product number one, very good product',
                'meta_description' => 'Такое же пустое описание но уже для роботов поисковиков.',
            ],
            [
                'uuid' => '57e72b99-19fe-49f3-8c78-aa65a5297541',
                'article_number' => '5646567',
                'price' => 1450000, // умножение на 10 тысяч
                'quantity' => 14,
                'category_id' => 1,
                'user_own_id' => 1,
                'slug' => 'Tovar-19',
                'title_ru' => 'Товар 19',
                'description_ru' => 'Немного об этом замечательном товаре писать не будем, есть куча других вещей по проекту.',
                'meta_keywords' => 'слова, слово, словосочетание',
                'meta_description' => 'Товар вроде как и не продукт, но продукт, так как продует есть товар.',
            ],
            [
                'uuid' => '2e9e14e3-9ccc-4cda-bee6-bfa7aedb2d23',
                'article_number' => '716546',
                'price' => 20990000, // 78.20 грн - умножение на 10 тысяч
                'quantity' => 14,
                'category_id' => 1,
                'user_own_id' => 1,
                'slug' => 'Besprovodnoj-gejmpad-PlayStation-5-Dualsense',
                'title_ru' => 'Беспроводной геймпад PlayStation 5 Dualsense',
                'description_ru' => 'Беспроводной контроллер DualSense™
Почувствуйте невероятное погружение в игровую реальность
1 благодаря новому контроллеру PS5™ с инновационными функциями.

Новый уровень ощущений
Беспроводной контроллер DualSense для PS5 оснащен реалистичной тактильной отдачей
2, динамическими адаптивными триггерами
5 и встроенным микрофоном в сочетании с оригинальным дизайном.',
                'meta_keywords' => 'Беспроводной, DualSense, контроллер',
                'meta_description' => 'Беспроводной контроллер DualSense™',
            ],
            [
                'uuid' => '5444d150-7c21-11eb-9cc2-bd3919e9feef',
                'article_number' => '9684962',
                'price' => 148190000, // 78.20 грн - умножение на 10 тысяч
                'quantity' => 253,
                'category_id' => 1,
                'user_own_id' => 1,
                'slug' => 'Processor_Intel_Core_i9-9900K_3.6GHz_8GT_s_16MB_(BX80684I99900K)_s1151_BOX',
                'title_ru' => 'Процессор Intel Core i9-9900K 3.6GHz/8GT/s/16MB (BX80684I99900K) s1151 BOX',
                'description_ru' => 'Новый процессор Intel Core i9-9900K 9-го поколения, с кодовым названием микроархитектуры Coffee Lake. Предназначен для настольной платформы Intel LGA 1151. Принадлежит к семейству высокопроизводительных процессоров Core i9.

Intel Core i9-9900K производится по стандарту 14-нм техпроцесса, имеет 8 ядер, которые работают в 16 потоков со штатной тактовой частотой 3.6 ГГц, 5.0 ГГц в режиме Turbo Boost. Объем кэш-памяти 3 уровня равен 16 МБ. Имеет 2-х канальный контроллер памяти DDR4.

Особенности:

Встроенное графическое ядро нового поколения Intel UHD Graphics
Ultra HD 4K – наслаждайтесь удивительным и динамичным видео на ваших Ultra HD и 4K дисплеях (разрешение до 4096 х 2304)
Intel Quick Sync Video дает отличную возможность видеоконференций, быстрого преобразования, редактирования и авторизации видео, а также онлайн обмена
OpenCL – теперь программисты могут легко воспользоваться вычислительными мощностями графического ядра
Встроенный DirectX 12 API обеспечит наилучшие впечатление от игр и графики

Технологии защиты:

Intel Advanced Encryption Standard Instructions
Intel Secure Key
Intel OS Guard
Intel Identity Protection Technology',
                'meta_keywords' => 'Процессор, Intel, Intel Core, i9-9900K',
                'meta_description' => 'Новый процессор Intel Core i9-9900K 9-го поколения для материнских плат на Z390/Z370/H310/H370/B360/Q370',
            ],
            [
                'uuid' => 'ba4e0e20-7c29-11eb-bfe1-31f78429e044',
                'article_number' => '841842',
                'price' => 12110000, // 78.20 грн - умножение на 10 тысяч
                'quantity' => 118,
                'category_id' => 1,
                'user_own_id' => 1,
                'slug' => 'Nakopitel_HDD_SATA_1.0TB_WD_Blue_7200rpm_64MB_WD10EZEX',
                'title_ru' => 'Накопитель HDD SATA 1.0TB WD Blue 7200rpm 64MB (WD10EZEX)',
                'description_ru' => 'Надежные конструктивные решения Накопители WD Blue, соответствующие самым высоким требованиям WD в части качества и надежности, обладают вполне достаточной функциональностью и емкостью для решения повседневных задач в системах начального уровня. Современная классика Модели WD Blue разработаны и произведены по технологии знаменитых оригинальных накопителей WD для настольных и мобильных компьютеров. WD Blue — яркий пример того, какими должны быть накопители для повседневных задач. Вот уже шесть поколений их быстродействие неуклонно растет, а качество и надежность остаются традиционно высокими. Преимущества WD Прежде чем выпустить в производство любое новое изделие, компания Western Digital тщательно проверяет сохранность его функциональных характеристик в своей тестовой лаборатории. Это тестирование позволяет убедиться в том, что наши изделия соответствуют самым высоким нормам качества и надежности продукции. Также у компании имеется обширная база знаний, насчитывающая более 1000 статей, и библиотека полезных программ.',
                'meta_keywords' => 'Накопитель, WD10EZEX, HDD, SATA, 1.0TB, 1TB, 1024MB, 7200rpm, 64MB',
                'meta_description' => 'Накопитель WD Blue, соответствующие самым высоким требованиям WD в части качества и надежности',
            ],
        ];

        if( count($arrayProducts) > 0 ){
            foreach ($arrayProducts as $product) {
                $productFound = DB::table('products')
                    ->where('uuid', '=', $product['uuid'])->first();

                if( !$productFound ) {
                    $productNew = new Product();

                    $productNew['uuid'] = $product['uuid']; // \Webpatser\Uuid\Uuid::generate()->string

                    $productNew['article_number'] = $product['article_number'];
                    $productNew['price'] = $product['price'];

                    $productNew['quantity'] = $product['quantity'];
                    $productNew['category_id'] = $product['category_id'];
                    $productNew['user_own_id'] = $product['user_own_id'];
                    $productNew['slug'] = $product['slug'];

                    $productNew['title'] = !empty($product['title']) ? $product['title'] : '';
                    $productNew['title_ua'] = !empty($product['title_ua']) ? $product['title_ua'] : '';
                    $productNew['title_ru'] = !empty($product['title_ru']) ? $product['title_ru'] : '';
                    $productNew['description'] = !empty($product['description']) ? $product['description'] : '';
                    $productNew['description_ua'] = !empty($product['description_ua']) ? $product['description_ua'] : '';
                    $productNew['description_ru'] = !empty($product['description_ru']) ? $product['description_ru'] : '';

                    $productNew['meta_keywords'] = !empty($product['meta_keywords']) ? $product['meta_keywords'] : '';
                    $productNew['meta_description'] = !empty($product['meta_description']) ? $product['meta_description'] : '';

                    $productNew->save();
                }
            }
        }
    }
}
