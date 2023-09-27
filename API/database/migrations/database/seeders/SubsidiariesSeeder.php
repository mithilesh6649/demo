<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SubsidiariesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
              \DB::table('subsidiaries')->truncate();
        \DB::table('subsidiaries')->insert([
            [
            'title_en'=>"Mughal Mahal General Trading & Contracting Company, W.L.L.",
            'title_ar'=>" شركة مغل محل للتجارة العامة والمقاولات ، ذ.م.م.",
            'description_en'=>'This division is the authorized distributor of Indian Basmati rice, Parboiled rice, Spices and food stuffs from various reputed manufacturers in India, including the Indianna brand of spices and food stuff.',
             'description_ar'=>'هذا القسم هو الموزع المعتمد لأرز البسمتي الهندي والأرز المسلوق والتوابل والمواد الغذائية من مختلف الشركات المصنعة الشهيرة في الهند ، بما في ذلك علامة  Indianna  إنديانا  التجارية من البهارات والمواد الغذائية.', 
            'status'=> "1",
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
            ],

            [
            'title_en'=>"Mughal Mahal Investment",
            'title_ar'=>"مغل محل للاستثمار",
            'description_en'=>'This division is the investment arm of our Group responsible for handling franchising and other investment opportunities. We offer management consultancy for existing restaurants as well as provide new restaurant entrepreneurs with every aspect of running a restaurant business. From conceptualizing to commissioning we present the client a package that includes planning, designing, organizing and implementing restaurants of any size and kind.',
             'description_ar'=>'هذا القسم هو الذراع الاستثماري لمجموعتنا المسؤول عن التعامل مع الامتيازات وفرص الاستثمار الأخرى. نحن نقدم الاستشارات الإدارية للمطاعم القائمة ، فضلاً عن توفير رواد أعمال جدد للمطاعم مع كل جانب من جوانب إدارة أعمال المطاعم. من التصور إلى التكليف ، نقدم للعميل حزمة تتضمن تخطيط وتصميم وتنظيم وتنفيذ المطاعم من أي حجم ونوع ..', 
            'status'=> "1",
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
            ],

         


    ]);

    }
}
