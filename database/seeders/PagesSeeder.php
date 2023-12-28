<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class PagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Page::create([
            'name' => [
                'en' => 'About Us',
                'ar' => 'معلومات عنا'
             ],
            'slug' => 'about',
            'sort'=>'1',
            'status'=>'active',
            'header_style'=>'white',
            'meta_description'=>'About Us',
            'meta_title'=>'About Us',
            'meta_keywords'=>'About Us',
                        'created_by' => 1,

        ]);
        \App\Models\Page::create([
            'name' => [
                'en' => 'Contact Us',
                'ar' => 'تواصل معنا'
             ],
            'slug' => 'contact',
            'sort'=>'1',
            'status'=>'active',
            'header_style'=>'white',
            'meta_description'=>'Contact Us',
            'meta_title'=>'Contact Us',
            'meta_keywords'=>'Contact Us',
            'created_by' => 1,

        ]);


        \App\Models\Page::create([
            'name' => [
                'en' => 'home',
                'ar' => 'الرئيسيه'
             ],
            'slug' => 'home',
            'sort'=>'1',
            'status'=>'active',
            'header_style'=>'transparent',
            'meta_description'=>'home',
            'meta_title'=>'home',
            'meta_keywords'=>'home',
                        'created_by' => 1,

        ]);
        \App\Models\Page::create([
            'name' => [
                'en' => 'Medical Network',
                'ar' => 'الشبكه الطبيه'
             ],
            'slug' => 'medical_network',
            'sort'=>'1',
            'status'=>'active',
            'header_style'=>'transparent',
            'meta_description'=>'Medical Network',
            'meta_title'=>'Medical Network',
            'meta_keywords'=>'Medical Network',
                        'created_by' => 1,

        ]);
        \App\Models\Page::create([
            'name' => [
                'en' => 'Complaints And Suggestions',
                'ar' => 'الشكاوي والاقتراحات'
             ],
            'slug' => 'complaints_and_suggestions',
            'sort'=>'1',
            'status'=>'active',
            'header_style'=>'white',
            'meta_description'=>'Complaints And Suggestions',
            'meta_title'=>'Complaints And Suggestions',
            'meta_keywords'=>'Complaints And Suggestions',
                        'created_by' => 1,

        ]);
        \App\Models\Page::create([
            'name' => [
                'en' => 'Request Medical',
                'ar' => 'طلب موافقة طبية'
             ],
            'slug' => 'request_medical',
            'sort'=>'1',
            'status'=>'active',
            'header_style'=>'white',
            'meta_description'=>'Request Medical',
            'meta_title'=>'Request Medical',
            'meta_keywords'=>'Request Medical',
                        'created_by' => 1,

        ]);
        \App\Models\Page::create([
            'name' => [
                'en' => 'Our Services',
                'ar' => 'خدماتنا'
             ],
            'slug' => 'services',
            'sort'=>'1',
            'status'=>'active',
            'header_style'=>'transparent',
            'meta_description'=>'Our Services',
            'meta_title'=>'Our Services',
            'meta_keywords'=>'Our Services',
                        'created_by' => 1,

        ]);
        \App\Models\Page::create([
            'name' => [
                'en' => 'Our Careers',
                'ar' => 'الوظائف'
             ],
            'slug' => 'careers',
            'sort'=>'1',
            'status'=>'active',
            'header_style'=>'white',
            'meta_description'=>'Our Careers',
            'meta_title'=>'Our Careers',
            'meta_keywords'=>'Our Careers',
                        'created_by' => 1,

        ]);
        \App\Models\Page::create([
            'name' => [
                'en' => 'Faqs',
                'ar' => 'الاسالة الشائعة و المتكررة'
             ],
            'slug' => 'faqs',
            'sort'=>'1',
            'status'=>'active',
            'header_style'=>'white',
            'meta_description'=>'Faqs',
            'meta_title'=>'Faqs',
            'meta_keywords'=>'Faqs',
                        'created_by' => 1,

        ]);
        \App\Models\Page::create([
            'name' => [
                'en' => 'Provider Survey',
                'ar' => 'تقييم مقدمي الخدمات'
             ],
            'slug' => 'provider_servey',
            'sort'=>'1',
            'status'=>'active',
            'header_style'=>'white',
            'meta_description'=>'Provider Servey',
            'meta_title'=>'Provider Servey',
            'meta_keywords'=>'Provider Servey',
                        'created_by' => 1,

        ]);
        \App\Models\Page::create([
            'name' => [
                'en' => 'Hr Survey',
                'ar' => 'تقييم مسؤل الموارد البشريه'
             ],
            'slug' => 'hr_servey',
            'sort'=>'1',
            'status'=>'active',
            'header_style'=>'white',
            'meta_description'=>'Hr Servey',
            'meta_title'=>'Hr Servey',
            'meta_keywords'=>'Hr Servey',
                        'created_by' => 1,

        ]);
        \App\Models\Page::create([
            'name' => [
                'en' => 'Membership Survey',
                'ar' => 'تقييم الأعضاء'
             ],
            'slug' => 'membership_servey',
            'sort'=>'1',
            'status'=>'active',
            'header_style'=>'white',
            'meta_description'=>'Membership Servey',
            'meta_title'=>'Membership Servey',
            'meta_keywords'=>'Membership Servey',
                        'created_by' => 1,

        ]);

        \App\Models\Page::create([
            'name' => [
                'en' => 'Wellness Programs',
                'ar' => 'برنامج صحتي'
             ],
            'slug' => 'wellness_programs',
            'sort'=>'1',
            'status'=>'active',
            'header_style'=>'white',
            'meta_description'=>'Wellness Programs',
            'meta_title'=>'Wellness Programs',
            'meta_keywords'=>'Wellness Programs',
                        'created_by' => 1,

        ]);



        \App\Models\Page::create([
            'name' => [
                'en' => 'Provider Addition',
                'ar' => 'الانضمام لشبكة ميدرايت'
             ],
            'slug' => 'provider_addition',
            'sort'=>'1',
            'status'=>'active',
            'header_style'=>'white',
            'meta_description'=>'Provider Addition',
            'meta_title'=>'Provider Addition',
            'meta_keywords'=>'Provider Addition',
                        'created_by' => 1,

        ]);
        \App\Models\Page::create([
            'name' => [
                'en' => 'Request For Qoutation',
                'ar' => 'احصل علي عرض سعر'
             ],
            'slug' => 'request_for_qoutation',
            'sort'=>'1',
            'status'=>'active',
            'header_style'=>'white',
            'meta_description'=>'Request For Qoutation',
            'meta_title'=>'Request For Qoutation',
            'meta_keywords'=>'Request For Qoutation',
                        'created_by' => 1,

        ]);
        \App\Models\Page::create([
            'name' => [
                'en' => 'Rate Us',
                'ar' => 'قيمنا'
             ],
            'slug' => 'rate',
            'sort'=>'1',
            'status'=>'active',
            'header_style'=>'transparent',
            'meta_description'=>'Rate Us',
            'meta_title'=>'Rate Us',
            'meta_keywords'=>'Rate Us',
                        'created_by' => 1,

        ]);
        \App\Models\Page::create([
            'name' => [
                'en' => 'User Guide',
                'ar' => 'دليل المستخدم'
             ],
            'slug' => 'user_guide',
            'sort'=>'1',
            'status'=>'active',
            'header_style'=>'white',
            'meta_description'=>'User Guide',
            'meta_title'=>'User Guide',
            'meta_keywords'=>'User Guide',
                        'created_by' => 1,

        ]);


        \App\Models\Page::create([
            'name' => [
                'en' => 'Membership Club',
                'ar' => 'منطقه الاعضاء'
             ],
            'slug' => 'membership_club',
            'sort'=>'1',
            'status'=>'active',
            'header_style'=>'white',
            'meta_description'=>'Membership Club',
            'meta_title'=>'Membership Club',
            'meta_keywords'=>'Membership Club',
                        'created_by' => 1,

        ]);

        \App\Models\Page::create([
            'name' => [
                'en' => 'table',
                'ar' => 'الجدول'
             ],
            'slug' => 'table',
            'sort'=>'1',
            'status'=>'active',
            'header_style'=>'white',
            'meta_description'=>'table',
            'meta_title'=>'table',
            'meta_keywords'=>'table',
                        'created_by' => 1,

        ]);

        \App\Models\Page::create([
            'name' => [
                'en' => 'Mobile App',
                'ar' => 'تطبيقات الهاتف'
             ],
            'slug' => 'mobile_app',
            'sort'=>'1',
            'status'=>'active',
            'header_style'=>'white',
            'meta_description'=>'Mobile App',
            'meta_title'=>'Mobile App',
            'meta_keywords'=>'Mobile App',
                        'created_by' => 1,

        ]);
        \App\Models\Page::create([
            'name' => [
                'en' => 'My Medright',
                'ar' => 'ميدرايت'
             ],
            'slug' => 'my_medright',
            'sort'=>'1',
            'status'=>'active',
            'header_style'=>'white',
            'meta_description'=>'my_medright',
            'meta_title'=>'my_medright',
            'meta_keywords'=>'my_medright',
                        'created_by' => 1,

        ]);

        \App\Models\Page::create([
            'name' => [
                'en' => 'Discount Cards',
                'ar' => 'كروت الخصم المباشر'
             ],
            'slug' => 'discount_cards',
            'sort'=>'1',
            'status'=>'active',
            'header_style'=>'transparent',
            'meta_description'=>'Discount Cards',
            'meta_title'=>'Discount Cards',
            'meta_keywords'=>'Discount Cards',
                        'created_by' => 1,

        ]);
        \App\Models\Page::create([
            'name' => [
                'en' => 'Checkups Clients',
                'ar' => 'الفحوصات و ادارة العيادات'
             ],
            'slug' => 'checkups_clients',
            'sort'=>'1',
            'status'=>'active',
            'header_style'=>'transparent',
            'meta_description'=>'Checkups Clients',
            'meta_title'=>'Checkups Clients',
            'meta_keywords'=>'Checkups Clients',
                        'created_by' => 1,

        ]);



        \App\Models\Page::create([
            'name' => [
                'en' => 'Medical Coverage',
                'ar' => 'التغطيه الطبيه'
             ],
            'slug' => 'medical_coverage',
            'sort'=>'1',
            'status'=>'active',
            'header_style'=>'transparent',
            'meta_description'=>'Medical Coverage',
            'meta_title'=>'Medical Coverage',
            'meta_keywords'=>'Medical Coverage',
                        'created_by' => 1,

        ]);
        \App\Models\Page::create([
            'name' => [
                'en' => 'Our Story',
                'ar' => 'اكتشف قصتنا'
             ],
            'slug' => 'our_story',
            'sort'=>'1',
            'status'=>'active',
            'header_style'=>'white',
            'meta_description'=>'Our Story',
            'meta_title'=>'Our Story',
            'meta_keywords'=>'Our Story',
                        'created_by' => 1,

        ]);


    }
}
