<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class managementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         \DB::table('management')->truncate();
        \DB::table('management')->insert([
            [
             'id'=>1,
             'name_en'=>'Mr. Khalid Jumaiyan',
             'name_ar'=>'السيد خالد الجميان',

             'organization_en'=>'Salem Al-Jumaiyan',
             'organization_ar'=>'سالم الجميان',

             'management_role_id'=>1,
             'content_en'=>'<h3>Mr. Khalid Jumaiyan Salem Al-Jumaiyan<h3><p>
Chairman of Mughal Mahal Group and formerly Minister of Social Affairs in Kuwait, is the man under whose leadership the company has witnessed further development and singular success. Fostering a culture of continuous innovation, he has led the company in its new and strengthened international expansions and its strategic directions aimed at revenue growth.</p>',

           'content_ar'=>'<h3>الاستاذ خالد الجميان سالم الجميان<h3><p>
        رئيس مجلس إدارة مجموعة موغال محل ووزير الشؤون الاجتماعية السابق في الكويت ، هو الرجل الذي شهدت الشركة تحت قيادته مزيدًا من التطور والنجاح الفريد. من خلال تعزيز ثقافة الابتكار المستمر ، قاد الشركة في توسعاتها الدولية الجديدة والمعززة وتوجهاتها الإستراتيجية التي تهدف إلى نمو الإيرادات.</p>',
              "created_at" => \Carbon\Carbon::now(),
              "updated_at" => \Carbon\Carbon::now(),

            ],
            [
             'id'=>2,
             'name_en'=>'Mr. Saad Hussain',
             'name_ar'=>'السيد سعد حسين',

             'organization_en'=>'Mubarak Al-Emelis',
             'organization_ar'=>'مبارك الامليس',

             'management_role_id'=>2,
             'content_en'=>'<h3>Mr. Saad Hussain Mubarak Al-Emelis<h3><p>Vice Chairman of Mughal Mahal Group brings his multi-disciplinary experience to provide a fresh perspective to the catering industry. He has increased focus on developing new businesses and supporting the growth of existing ones and in the process created and reinvigorated value-added and beneficial customer engagements that have helped underpin the Group ongoing success.</p>',

             'content_ar'=>'<h3>الاستاذ سعد حسين مبارك الامليس<h3><p>يقدم نائب رئيس مجلس إدارة مجموعة موغال محل خبرته متعددة التخصصات لتقديم منظور جديد لصناعة التموين. لقد زاد من تركيزه على تطوير أعمال جديدة ودعم نمو الأعمال الحالية ، وفي أثناء هذه العملية تم إنشاء وإعادة تنشيط ارتباطات العملاء ذات القيمة المضافة والمفيدة التي ساعدت في دعم نجاح المجموعة المستمر.</p>',
               "created_at" => \Carbon\Carbon::now(),
              "updated_at" => \Carbon\Carbon::now(),

            ],
            [
             'id'=>3,
             'name_en'=>'Mr. Ashok Kumar Kalra,',
             'name_ar'=>'السيد أشوك كومار كالرا',

             'organization_en'=>'MIH, U.K.',
             'organization_ar'=>'MIH ، المملكة المتحدة',

             'management_role_id'=>3,
             
             'content_en'=>'<h3>Mr. Ashok Kumar Kalra, MIH, U.K.<h3><p>A graduate from IHM â€“ Pusa, one of India’s premier hospitality management schools, Ashok Kalra is Managing Director of the Mughal Mahal Group of Restaurants. A professional hotelier with extensive experience in the hospitality industry, Mr. Kalra has served with the Taj Group of Hotels in India, as well as with the global hotel chain, Hilton International, at their properties in Tehran, London and Kuwait.</p> <p>In 1985, leveraging his vast experience in the hotel and catering industry, Mr. Kalra along with his partners, opened the first Mughal Mahal Restaurant in Kuwait. The restaurant, which began by offering authentic Indian Mughlai Cuisine, now offers various cuisines and has branches all over Kuwait and one outlet in the popular seaside resort of Sharm El-Sheikh in Egypt.</p>  <p>One of the highlights of Mr. Kalraâ€™s professional career came in 1987, when he was selected as F&B coordinator to the Second Islamic Conference hosted by Kuwait at the Bayan Palace. Supervising and coordinating a team of over 1,000 international staff, he catered to the banqueting requirements of 48 Heads of State and their entourage at the conference. He received personal commendation for his efforts from the Late Amir Sheikh Jaber Al-Ahmed Al-Jaber Al-Sabah.</p> <p>In addition to his business commitments, Mr. Kalra is a dedicated supporter of various social causes and Indian community affairs. During the last 15 years he has served on the Board of Trustees of the Indian Community School Kuwait, first as a member, then as vice-chairman and then, until the end of his tenure in mid-2014, as Chairman of the schoolâ€™s Board.</p>',

             'content_ar'=>'<h3>السيد أشوك كومار كالرا ، MIH ، المملكة المتحدة
<h3><p>تخرج أشوك كالرا من IHM - Pusa ، إحدى مدارس إدارة الضيافة الرائدة في الهند ، وهو المدير الإداري لمجموعة مطاعم موغال محل. بصفته صاحب فندق محترف يتمتع بخبرة واسعة في صناعة الضيافة ، عمل السيد كالرا مع مجموعة فنادق تاج في الهند ، وكذلك مع سلسلة الفنادق العالمية ، هيلتون إنترناشونال ، في فنادقها في طهران ولندن والكويت.
</p> <p>في عام 1985 ، مستفيدًا من خبرته الواسعة في صناعة الفنادق والمطاعم ، افتتح السيد كالرا مع شركائه أول مطعم موغال محل في الكويت. المطعم ، الذي بدأ بتقديم مأكولات مغولية هندية أصيلة ، يقدم الآن مختلف المأكولات ولديه فروع في جميع أنحاء الكويت ومنفذ واحد في منتجع شرم الشيخ الساحلي الشهير في مصر.
</p>  <p>وجاءت إحدى السمات البارزة في مسيرة السيد كلراء المهنية في عام 1987 ، عندما تم اختياره كمنسق للأطعمة والمشروبات للمؤتمر الإسلامي الثاني الذي استضافته الكويت في قصر بيان. قام بالإشراف والتنسيق لفريق يضم أكثر من 1000 موظف دولي ، وقام بتلبية متطلبات المآدب لـ 48 من رؤساء الدول والوفد المرافق لهم في المؤتمر. وتلقى إشادة شخصية لجهوده من المغفور له بإذن الله الشيخ جابر الأحمد الجابر الصباح.
</p> <p>بالإضافة إلى التزاماته التجارية ، يعتبر السيد كالرا داعمًا مخلصًا للعديد من القضايا الاجتماعية وشؤون المجتمع الهندي. خلال الخمسة عشر عامًا الماضية ، عمل في مجلس أمناء مدرسة الجالية الهندية بالكويت ، أولاً كعضو ، ثم نائبًا للرئيس ثم ، حتى نهاية فترة ولايته في منتصف عام 2014 ، كرئيس للمدرسة. ™ ق المجلس.
</p>',
               "created_at" => \Carbon\Carbon::now(),
              "updated_at" => \Carbon\Carbon::now(),

            ],
            [
             'id'=>4,
             'name_en'=>'Mr. Jatinder Suri',
             'name_ar'=>'السيد جاتيندر سوري',

             'organization_en'=>'C.F.B.E., USA',
             'organization_ar'=>'C.F.B.E. ، الولايات المتحدة الأمريكية',

             'management_role_id'=>4,
             'content_en'=>'<h3>Mr. Jatinder Suri, C.F.B.E., USA<h3><p>Young dynamic hotelier with 30 years experience in the hotel and catering industry, he has a major in Marketing of Hospitality Services and Training Techniques, from Michigan U.S.A. In 1981-83 he underwent Executive Management Training with Hilton International Worldwide and is well-versed with overall hotel operations and hospitality industry.</p>  <p>As an expert in developing new business strategies and in planning and implementing long-term company goals, he played a major role in the growth and expansion of Mughal Mahal group since its inception in 1985. He has been instrumental in shaping the companyâ€™s current organizational strategy and business development, as well as its strategic marketing and communication plans. In this role he designed and implemented several programs that focus on the companyâ€™s strengths while prioritizing and supporting various ancillary schemes. Mr. Suri, a Hotel School graduate, is today the proud owner of the 82-room luxury Hilton Hampton Hotel in Arkansas in the United States.

</p>  <p>He was instrumental in developing the brand identity including the brand proposition of the Group, and in identifying and developing strategic opportunities that contribute to the companyâ€™s growth and which continues to ensure its industry leading position in the country. During his thirty years of experience in the hotel and catering industry, he has to his credit a proven track record in the development and marketing of hospitality brands and the experience across a platform of market segments</p> <p>In addition, he is tasked with establishing Mughal Mahal chain of restaurants as the employer of choice. Focused on attracting, developing and retaining a highly talented workforce, he is responsible for developing an organizational structure that encourages diversity and provides world-class human resource related situations that adds significant value to the brand while improving dealings with its customers.</p> ',

 'content_ar'=>'<h3>السيد جاتيندر سوري ، الولايات المتحدة الأمريكية<h3><p>صاحب فندق ديناميكي شاب يتمتع بخبرة 30 عامًا في صناعة الفنادق والمطاعم ، وهو متخصص في تسويق خدمات الضيافة وتقنيات التدريب ، من ولاية ميتشجان بالولايات المتحدة الأمريكية. عمليات الفنادق وصناعة الضيافة.
</p>  <p>كخبير في تطوير استراتيجيات عمل جديدة وفي تخطيط وتنفيذ أهداف الشركة طويلة الأجل ، لعب دورًا رئيسيًا في نمو وتوسع مجموعة موغال محل منذ إنشائها في عام 1985. لقد كان له دور فعال في تشكيل الشركة الإستراتيجية التنظيمية الحالية وتطوير الأعمال ، بالإضافة إلى خططها التسويقية والاتصالات الإستراتيجية. في هذا المنصب ، قام بتصميم وتنفيذ العديد من البرامج التي تركز على نقاط القوة في الشركة مع إعطاء الأولوية للخطط الإضافية المختلفة ودعمها. السيد سوري ، خريج مدرسة فندقية ، هو اليوم المالك الفخور لفندق هيلتون هامبتون الفاخر المكون من 82 غرفة في أركنساس بالولايات المتحدة
.</p>  <p>كان له دور فعال في تطوير هوية العلامة التجارية بما في ذلك اقتراح العلامة التجارية للمجموعة ، وفي تحديد وتطوير الفرص الاستراتيجية التي تساهم في نمو الشركة والتي تستمر في ضمان مكانتها الرائدة في الصناعة في الدولة. خلال ثلاثين عامًا من الخبرة في صناعة الفنادق والمطاعم ، كان لديه سجل حافل في تطوير وتسويق العلامات التجارية للضيافة والخبرة عبر منصة قطاعات السوق
</p> <p>بالإضافة إلى ذلك ، تم تكليفه بإنشاء سلسلة مطاعم موغال محل كصاحب العمل المفضل. من خلال التركيز على جذب القوى العاملة الموهوبة وتطويرها والاحتفاظ بها ، فهو مسؤول عن تطوير هيكل تنظيمي يشجع التنوع ويوفر مواقف عالمية ذات صلة بالموارد البشرية والتي تضيف قيمة كبيرة للعلامة التجارية مع تحسين التعامل مع عملائها.
</p> ',
              "created_at" => \Carbon\Carbon::now(),
              "updated_at" => \Carbon\Carbon::now(),

            ],
            [
             'id'=>5,
             'name_en'=>'Mr. Mukesh Kumar,',
             'name_ar'=>'السيد موكيش كومار ،',

             'organization_en'=>'B.H.M.C & N',
             'organization_ar'=>'بي اتش ام سي و ان',

             'management_role_id'=>4,
             
             'content_en'=>'<h3>Mr. Mukesh Kumar, B.H.M.C & N<h3><p>Responsible for all of Mughal Mahal’s operations, including front-end and back-end operations, purchasing, supply-chain, quality and manpower development, Kumar has a vast and multi-faceted experience in the hotel and catering industry. As director of operations his job entails ensuring that the company effectively and efficiently generates revenue growth and creates value from new and current guests.</p>  <p>With singular expertise in efficiently mobilizing, training and deploying catering and culinary staff, Kumar is the force behind opening new branches for the Group as well as its exceptionally successful outside-catering events. With senior management level experience gained from working in the hotel and catering industry in India and Kuwait, including in the highly specialized field of hospital and industrial catering, Kumar has been involved in planning, executing and managing special catering events and major functions for 100 to 1,000 or more guests.

</p>  <p>His steadfast belief in empowering people through a unique approach to management has created a company culture that is based on confidence, teamwork and constantly exceeding expectations. While his primary objective is to create a professional operations team and improve performance, which is a key enabler and driver for Groupâ€™s growth, he is also responsible for the production creation process, focusing on the key areas of innovation, technology and research.

</p> <p>A Hotel-School Graduate of 1974, he has extensive experience in various F&B outlets in prestigious 5-Star hotels and was one of the key senior management team in charge of opening the Taj Mahal Hotel in New Delhi.</p> ',


            'content_ar'=>'<h3>السيد موكيش كومار ، B.H.M.C & N
<h3><p>مسؤول عن جميع عمليات موغال محل ، بما في ذلك العمليات الأمامية والخلفية والشراء وسلسلة التوريد والجودة وتطوير القوى العاملة ، يتمتع كومار بخبرة واسعة ومتعددة الأوجه في صناعة الفنادق والمطاعم. كمدير للعمليات ، فإن وظيفته تستلزم التأكد من أن الشركة تحقق نموًا في الإيرادات بشكل فعال وكفء وتخلق قيمة من الضيوف الجدد والحاليين.
</p>  <p>مع خبرة فريدة في تعبئة وتدريب ونشر طاقم تقديم الطعام والطهي بكفاءة ، كومار هو القوة وراء فتح فروع جديدة للمجموعة بالإضافة إلى أحداثها الخارجية الناجحة بشكل استثنائي. من خلال الخبرة المكتسبة على مستوى الإدارة العليا من العمل في صناعة الفنادق والمطاعم في الهند والكويت ، بما في ذلك في مجال التخصص العالي لتقديم الطعام في المستشفيات والصناعية ، شارك كومار في تخطيط وتنفيذ وإدارة أحداث التموين الخاصة والوظائف الرئيسية لـ 100 إلى 1000 ضيف أو أكثر.
</p>  <p>لقد أدى إيمانه الراسخ بتمكين الأفراد من خلال نهج فريد للإدارة إلى خلق ثقافة الشركة القائمة على الثقة والعمل الجماعي وتجاوز التوقعات باستمرار. في حين أن هدفه الأساسي هو إنشاء فريق عمليات محترف وتحسين الأداء ، وهو عامل تمكين ومحرك رئيسي لنمو المجموعة ، فهو مسؤول أيضًا عن عملية إنشاء الإنتاج ، مع التركيز على المجالات الرئيسية للابتكار والتكنولوجيا والبحث .</p> <p>تخرج من كلية الفنادق عام 1974 ، ويتمتع بخبرة واسعة في العديد من منافذ المأكولات والمشروبات في الفنادق المرموقة من فئة 5 نجوم وكان أحد فريق الإدارة العليا المسؤول عن افتتاح فندق تاج محل في نيودلهي
</p> ',
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),

            ]

        ]);
    }
} 
