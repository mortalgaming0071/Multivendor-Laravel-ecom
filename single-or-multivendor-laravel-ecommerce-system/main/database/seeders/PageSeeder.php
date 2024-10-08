<?php

namespace Database\Seeders;

use Botble\Base\Models\MetaBox as MetaBoxModel;
use Botble\Base\Supports\BaseSeeder;
use Botble\Language\Models\LanguageMeta;
use Botble\Page\Models\Page;
use Botble\Slug\Models\Slug;
use Html;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use SlugHelper;

class PageSeeder extends BaseSeeder
{
    public function run(): void
    {
        $faker = fake();

        $pages = [
            [
                'name' => 'Home',
                'content' =>
                    Html::tag('div', '[simple-slider key="home-slider" is_autoplay="yes" autoplay_speed="5000" ads="VC2C8Q1UGCBG" background="general/slider-bg.jpg"][/simple-slider]') .
                    Html::tag('div', '[featured-product-categories title="Browse by Category"][/featured-product-categories]') .
                    Html::tag('div', '[featured-brands title="Featured Brands"][/featured-brands]') .
                    Html::tag('div', '[flash-sale title="Top Saver Today" flash_sale_id="1"][/flash-sale]') .
                    Html::tag('div', '[product-category-products title="Just Landing" category_id="23"][/product-category-products]') .
                    Html::tag('div', '[theme-ads key_1="IZ6WU8KUALYD" key_2="ILSFJVYFGCPZ" key_3="ZDOZUZZIU7FT"][/theme-ads]') .
                    Html::tag('div', '[featured-products title="Featured products"][/featured-products]') .
                    Html::tag('div', '[product-collections title="Essential Products"][/product-collections]') .
                    Html::tag('div', '[product-category-products category_id="18"][/product-category-products]') .
                    Html::tag('div', '[featured-posts title="Health Daily" background="general/blog-bg.jpg"
                        app_enabled="1"
                        app_title="Shop faster with Farmart App"
                        app_description="Available on both iOS & Android"
                        app_bg="general/app-bg-2.png"
                        app_android_img="general/app-android.png"
                        app_android_link="#"
                        app_ios_img="general/app-ios-2.png"
                        app_ios_link="#"][/featured-posts]')
                ,
                'template' => 'homepage',
            ],
            [
                'name' => 'About us',
            ],
            [
                'name' => 'Terms Of Use',
            ],
            [
                'name' => 'Terms & Conditions',
            ],
            [
                'name' => 'Refund Policy',
            ],
            [
                'name' => 'Blog',
                'content' => Html::tag('p', '---'),
                'template' => 'full-width',
            ],
            [
                'name' => 'FAQs',
                'content' => Html::tag('div', '[faq title="Frequently Asked Questions"][/faq]'),
            ],
            [
                'name' => 'Contact',
                'content' => Html::tag('div', '[google-map]502 New Street, Brighton VIC, Australia[/google-map]') .
                    Html::tag(
                        'div',
                        '[contact-info-boxes title="Contact Info" subtitle="Location" ' .
                        'name_1="Store" ' .
                        'address_1="68 Atlantic Ave St, Brooklyn, NY 90002, USA" ' .
                        'phone_1="(+005) 5896 72 78 79" ' .
                        'email_1="onlineecommerce0701@gmail.com" ' .
                        'name_2="Warehouse" ' .
                        'address_2="172 Richmond Hill Ave St, Stamford, NY 90002, USA" ' .
                        'phone_2="(+005) 5896 03 04 05" ' .
                        'show_contact_form="1" ' .
                        '][/contact-info-boxes]'
                    ),
            ],
            [
                'name' => 'Cookie Policy',
                'content' => Html::tag('h3', 'EU Cookie Consent') .
                    Html::tag(
                        'p',
                        'To use this Website we are using Cookies and collecting some Data. To be compliant with the EU GDPR we give you to choose if you allow us to use certain Cookies and to collect some Data.'
                    ) .
                    Html::tag('h4', 'Essential Data') .
                    Html::tag(
                        'p',
                        'The Essential Data is needed to run the Site you are visiting technically. You can not deactivate them.'
                    ) .
                    Html::tag(
                        'p',
                        '- Session Cookie: PHP uses a Cookie to identify user sessions. Without this Cookie the Website is not working.'
                    ) .
                    Html::tag(
                        'p',
                        '- XSRF-Token Cookie: Laravel automatically generates a CSRF "token" for each active user session managed by the application. This token is used to verify that the authenticated user is the one actually making the requests to the application.'
                    ),
            ],
            [
                'name' => 'Affiliate',
            ],
            [
                'name' => 'Career',
            ],
            [
                'name' => 'Coming soon',
                'content' => Html::tag(
                    'div',
                    '[coming-soon time="2022-07-15" title="We’re coming soon." subtitle="Currently we’re working on our brand new website and will be
launching soon." social_title="Connect us on social networks" image="general/coming-soon.jpg"][/coming-soon]'
                ),
                'template' => 'coming-soon',
            ],
        ];

        Page::query()->truncate();
        DB::table('pages_translations')->truncate();
        Slug::query()->where('reference_type', Page::class)->delete();
        MetaBoxModel::query()->where('reference_type', Page::class)->delete();
        LanguageMeta::query()->where('reference_type', Page::class)->delete();

        foreach ($pages as $item) {
            $item['user_id'] = 1;

            if (! isset($item['template'])) {
                $item['template'] = 'default';
            }

            if (! isset($item['content'])) {
                $item['content'] = Html::tag('p', $faker->realText(500)) . Html::tag('p', $faker->realText(500)) .
                    Html::tag('p', $faker->realText(500)) . Html::tag('p', $faker->realText(500));
            }

            $page = Page::query()->create($item);

            Slug::query()->create([
                'reference_type' => Page::class,
                'reference_id' => $page->id,
                'key' => Str::slug($page->name),
                'prefix' => SlugHelper::getPrefix(Page::class),
            ]);
        }

        $translations = [
            [
                'name' => 'Trang chủ',
                'content' =>
                    Html::tag('div', '[simple-slider key="home-slider" is_autoplay="yes" autoplay_speed="5000" ads="VC2C8Q1UGCBG" background="general/slider-bg.jpg"][/simple-slider]') .
                    Html::tag('div', '[featured-product-categories title="Tìm kiếm bằng danh mục"][/featured-product-categories]') .
                    Html::tag('div', '[featured-brands title="Thương hiệu nổi bật"][/featured-brands]') .
                    Html::tag('div', '[flash-sale title="Top Saver Today" flash_sale_id="1"][/flash-sale]') .
                    Html::tag('div', '[product-category-products title="Just Landing" category_id="23"][/product-category-products]') .
                    Html::tag('div', '[theme-ads key_1="IZ6WU8KUALYD" key_2="ILSFJVYFGCPZ" key_3="ZDOZUZZIU7FT"][/theme-ads]') .
                    Html::tag('div', '[featured-products title="Featured products"][/featured-products]') .
                    Html::tag('div', '[product-collections title="Essential Products"][/product-collections]') .
                    Html::tag('div', '[product-category-products category_id="18"][/product-category-products]')
                ,
            ],
            [
                'name' => 'Về chúng tôi',
            ],
            [
                'name' => 'Điều khoản sử dụng',
            ],
            [
                'name' => 'Điều khoản và điều kiện',
            ],
            [
                'name' => 'Điều kiện hoàn hàng',
            ],
            [
                'name' => 'Tin tức',
                'content' => Html::tag('p', '---'),
            ],
            [
                'name' => 'Câu hỏi thường gặp',
                'content' => Html::tag('div', '[faq title="Các câu hỏi thường gặp"][/faq]'),
            ],
            [
                'name' => 'Liên hệ',
                'content' => Html::tag('div', '[google-map]502 New Street, Brighton VIC, Australia[/google-map]') .
                    Html::tag(
                        'div',
                        '[contact-info-boxes title="Liên hệ với chúng tôi nếu bạn có thắc mắc"][/contact-info-boxes]'
                    ) .
                    Html::tag('div', '[contact-form][/contact-form]')
                ,
            ],
            [
                'name' => 'Chính sách cookie',
                'content' => Html::tag('h3', 'EU Cookie Consent') .
                    Html::tag(
                        'p',
                        'To use this website we are using Cookies and collecting some data. To be compliant with the EU GDPR we give you to choose if you allow us to use certain Cookies and to collect some Data.'
                    ) .
                    Html::tag('h4', 'Essential Data') .
                    Html::tag(
                        'p',
                        'The Essential Data is needed to run the Site you are visiting technically. You can not deactivate them.'
                    ) .
                    Html::tag(
                        'p',
                        '- Session Cookie: PHP uses a Cookie to identify user sessions. Without this Cookie the Website is not working.'
                    ) .
                    Html::tag(
                        'p',
                        '- XSRF-Token Cookie: Laravel automatically generates a CSRF "token" for each active user session managed by the application. This token is used to verify that the authenticated user is the one actually making the requests to the application.'
                    ),
            ],
            [
                'name' => 'Tiếp thị liên kết',
            ],
            [
                'name' => 'Tuyển dụng',
            ],
            [
                'name' => 'Sắp ra mắt',
                'content' => Html::tag(
                    'p',
                    'Condimentum ipsum a adipiscing hac dolor set consectetur urna commodo elit parturient <br/>molestie ut nisl partu convallier ullamcorpe.'
                ) .
                    Html::tag(
                        'div',
                        '[coming-soon time="December 30, 2021 15:37:25" image="general/coming-soon.jpg"][/coming-soon]'
                    ),
            ],
        ];

        foreach ($translations as $index => $item) {
            $item['lang_code'] = 'vi';
            $item['pages_id'] = $index + 1;

            DB::table('pages_translations')->insert($item);
        }
    }
}
