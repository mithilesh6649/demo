<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PagesSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	*/
	public function run() {
		\DB::table('pages')->truncate();
		\DB::table('pages')->insert([
			[
				'title_en' => 'About Us',

				'title_ar' => 'معلومات عنا',

				'content_en' => "Opening of the first Mughal Mahal restaurant in Kuwait, way back in 1985, led to a paradigm shift in perceptions about Indian fine-dining among people in the country. In 1991, following the liberation of Kuwait, we were once again instrumental in transforming Kuwait's dining culture by promoting dining-out as an acceptable and desirable social norm among families.



					Since then, with new restaurants opening across the country, citizens and expatriates have had the opportunity to explore and experience a plethora of innovative and exotic cuisines from around the world. Despite this profusion of dining options, each new opening of a Mughal Mahal branch has been longingly awaited and enthusiastically greeted by good-food lovers in Kuwait.



					We are extremely proud that for the past thirty three years no restaurant chain has come anywhere close to consistently delivering the total dining-in experience characteristic of Mughal Mahal. No restaurant chain in the country has been able to emulate the superb food quality, impeccable service and relaxing ambiance for which our restaurant branches are the byword.



					They say it is always lonely at the top, but we do not mind. Reaching a pinnacle is no easy accomplishment but consistently retaining that pole-position is what makes our work so interesting.



					The fact that we have remained on the top podium all these years is a tribute to the consummate efforts and expertise of our closely integrated team of staff and management, and their commitment to continuously achieving incremental improvements in every step we take.



					Every member of the Mughal Mahal team, from the people who cook to the ones who clean, from the people who serve to the ones who manage, is dedicated to our credo of ensuring guests are always treated as royalty. Our logo of a Mughal emperor silhouetted in green is a constant reminder of this commitment to our guests.",

					'content_ar' => "أدى افتتاح أول مطعم موغال محل في الكويت ، في عام 1985 ، إلى تحول نموذجي في التصورات حول الأكل الهندي الفاخر بين الناس في البلاد. في عام 1991 ، بعد تحرير الكويت ، لعبنا دورًا فعالًا مرة أخرى في تغيير ثقافة تناول الطعام في الكويت من خلال الترويج لتناول الطعام في الخارج كقاعدة اجتماعية مقبولة ومرغوبة بين العائلات.

						منذ ذلك الحين ، مع افتتاح مطاعم جديدة في جميع أنحاء البلاد ، أتيحت الفرصة للمواطنين والمغتربين لاستكشاف وتجربة عدد كبير من المأكولات المبتكرة والغريبة من جميع أنحاء العالم. على الرغم من هذا الكم الهائل من خيارات تناول الطعام ، فإن كل افتتاح جديد لفرع موغال محل كان ينتظر طويلاً ويتم الترحيب به بحماس من قبل عشاق الطعام الجيد في الكويت.

						نحن فخورون للغاية بأنه على مدى السنوات الثلاث والثلاثين الماضية ، لم تقترب أي سلسلة مطاعم من تقديم تجربة تناول الطعام الكاملة التي تتميز بها موغال محل باستمرار. لم تتمكن أي سلسلة مطاعم في الدولة من محاكاة جودة الطعام الرائعة والخدمة الممتازة والأجواء المريحة التي تعتبر فروع مطاعمنا هي المثل.

						يقولون إنه دائمًا ما يكون وحيدًا في القمة ، لكننا لا نمانع. الوصول إلى القمة ليس إنجازًا سهلاً ، لكن الاحتفاظ بهذا المركز الأول باستمرار هو ما يجعل عملنا ممتعًا للغاية.

						إن حقيقة بقائنا على قمة المنصة طوال هذه السنوات هي تقدير للجهود والخبرة البارعة لفريقنا المتكامل عن كثب من الموظفين والإدارة ، والتزامهم بتحقيق تحسينات تدريجية باستمرار في كل خطوة نتخذها.

						كل عضو في فريق موغال محل ، من الأشخاص الذين يطبخون إلى أولئك الذين ينظفون ، من الأشخاص الذين يخدمون إلى أولئك الذين يديرون ، مكرس لعقيدتنا المتمثلة في ضمان معاملة الضيوف دائمًا على أنهم ملوك. شعارنا للإمبراطور المغولي المظلل باللون الأخضر هو تذكير دائم بهذا الالتزام تجاه ضيوفنا.",

				'section' => 'about_us',
				'device_type' => 'web',
				'added_by_id' => 1,
				'updated_by_id' => 1,
                "created_at" => \Carbon\Carbon::now(),
                "last_updated_at" => \Carbon\Carbon::now(),
			],

			[
				'title_en' => 'Fragrance that gets you hungry, taste that makes you smile.',
				'title_ar' => 'البنود و الظروف',

				'content_en' => '<h3 class="my-0">13+ Outlets Across Kuwait</h3>
									<p class="mb-0">Six Governorates Delivery &amp; Dine-in<br />
									The Taste of the Mughal Era</p>
									',

				'content_ar' => "<h3 class='my-0'>أكثر من 13 منفذًا في جميع أنحاء الكويت</h3>

								<p class='mb-0'>ست محافظات تسليم و أمبير. تناول الطعام في<br />
								طعم عصر المغول</p>
								",
				'section' => 'features_one',
				'device_type' => 'web',
				'added_by_id' => 1,
				'updated_by_id' => 1,
                "created_at" => \Carbon\Carbon::now(),
                "last_updated_at" => \Carbon\Carbon::now(),
			],
			[
				'title_en' => 'Fragrance that gets you hungry, taste that makes you smile.',
				'title_ar' => 'البنود و الظروف',

				'content_en' => '<h3 class="my-0">Always Fresh</h3>
								<p class="mb-0">Made with your choice of spices level<br />
									Every order will be delivered with a guarantee of quality</p>
								',

					'content_ar' => "<h3 class='my-0'>دائما منعش</h3>

								<p class='mb-0'>مصنوع من اختيارك لمستوى البهارات<br />
								سيتم تسليم كل طلب مع ضمان الجودة</p>
								",


				'section' => 'features_two',
				'device_type' => 'web',
				'added_by_id' => 1,
				'updated_by_id' => 1,
                "created_at" => \Carbon\Carbon::now(),
                "last_updated_at" => \Carbon\Carbon::now(),
			],
			[
				'title_en' => 'Fragrance that gets you hungry, taste that makes you smile.',
				'title_ar' => 'البنود و الظروف',

				'content_en' => '<h3 class="my-0">4.5 Rating</h3>

									<p class="mb-0">Delivery , Packaging , Quality , value<br />
									Bigger Portions, Better Prices!</p>
									',

				'content_ar' => "<h3 class='my-0'>4.5 التقييم</h3>

								<p class='mb-0'>التسليم والتعبئة والجودة والقيمة<br />
								كميات أكبر ، أسعار أفضل!</p>
								",


				'section' => 'features_three',
				'device_type' => 'web',
				'added_by_id' => 1,
				'updated_by_id' => 1,
                "created_at" => \Carbon\Carbon::now(),
                "last_updated_at" => \Carbon\Carbon::now(),
			],
			[
				'title_en' => 'Fragrance that gets you hungry, taste that makes you smile.',
				'title_ar' => 'البنود و الظروف',

				'content_en' => '<h3 class="my-0">50L + Guests across country</h3>
									<p class="mb-0">Love Mughal Mahal Biryani<br />
									The Essence of Delicious Mughal India</p>
								 ',

				'content_ar' => "<h3 class='my-0'>50 لترًا + ضيوف في جميع أنحاء البلاد</h3>

								<p class='mb-0'>أحب موغال محل برياني<br />
								جوهر الهند المغولية اللذيذة</p>
								",
				'section' => 'features_four',
				'device_type' => 'web',
				'added_by_id' => 1,
				'updated_by_id' => 1,
                "created_at" => \Carbon\Carbon::now(),
                "last_updated_at" => \Carbon\Carbon::now(),
			],
		   [
				'title_en' => 'Our Vision & Mission',

				'title_ar' => 'رؤيتنا ورسالتنا',

				'content_en' => "Our objective is to be among the top restaurants in the nation by continually meeting and surpassing guests expectations.

					Our mission is to create restaurants with an exciting ambiance, great food, and impeccable service and, in the process, turn a profit.

					Our goal is to build a great restaurant where people like going to dine while also offering a safe, engaging, and fulfilling work environment for our staff.

					Our ideals are founded on the age-old Indian cultural tradition of 'Atithi Devo Bhava,' which translates to 'Be the one for whom the Guest is God.'

					Every choice we make and every action we take in our company is influenced by this fundamental principle.

					As a result, it's no surprise that our principles revolve on an unwavering commitment to the quality of our cuisine, the service we deliver, and achieving 100% customer pleasure at every touch-point.",

					'content_ar' => "هدفنا هو أن نكون من بين أفضل المطاعم في الدولة من خلال تلبية توقعات الضيوف وتجاوزها باستمرار.

						مهمتنا هي إنشاء مطاعم ذات أجواء مثيرة ، وطعام رائع ، وخدمة لا تشوبها شائبة ، وفي هذه العملية ، جني الأرباح.

						هدفنا هو بناء مطعم رائع حيث يحب الناس الذهاب لتناول العشاء مع توفير بيئة عمل آمنة وجذابة ومرضية لموظفينا.

						تأسست مُثُلنا على التقاليد الثقافية الهندية القديمة 'Atithi Devo Bhava' ، والتي تُترجم إلى 'كن الشخص الذي يكون الضيف هو الله بالنسبة له'.

						كل خيار نتخذه وكل إجراء نتخذه في شركتنا يتأثر بهذا المبدأ الأساسي.

						نتيجة لذلك ، ليس من المستغرب أن ترتكز مبادئنا على التزام ثابت بجودة مطبخنا ، والخدمة التي نقدمها ، وتحقيق 100٪ من إسعاد العملاء في كل نقطة اتصال.",

				'section' => 'our_vision_&_mission',
				'device_type' => 'web',
				'added_by_id' => 1,
				'updated_by_id' => 1,
                "created_at" => \Carbon\Carbon::now(),
                "last_updated_at" => \Carbon\Carbon::now(),
			],

               [
				'title_en' => 'Get started with the mobile app!',

				'title_ar' => 'ابدأ مع تطبيق الهاتف المحمول!',

				'content_en' =>'Coming Soon',

					'content_ar' =>'قريبا',

				'section' => 'get_started_with',
				'device_type' => 'web',
				'added_by_id' => 1,
				'updated_by_id' => 1,
                "created_at" => \Carbon\Carbon::now(),
                "last_updated_at" => \Carbon\Carbon::now(),
			],

               [
				'title_en' => 'Mughal Mahal Catering/Celebrations',

				'title_ar' => 'موغال محل تقديم الطعام / الاحتفالات',

				'content_en' =>"YOUR ‘ONE –STOP’ TO A WORRY AND STRESS-FREE RECEPTION OR SPECIAL EVENT
					WE ARE COMMITTED TO HOSTING AND MAKING YOUR EVENT A TOTAL SUCCESS FROM THE MOMENT YOU BOOK.

					Dear Guest!
					We've got you covered with a wide variety of Multi Cuisine & Live Stations
					to indulge in! Gatherings, Pre Weddings, Corporate & Media events.
					Fill in you information or give us a call (Catering - 99067576 / Banquet - 97644421)
					1) Items can be changed dish to dish from same category
					2) Any items added from the tentative set menu will be charged extra
					3) For Tables-Chairs & Other Setups please discuss with our Catering Head
					4)Live Counters will be charged extra depends on Pax you have confirmed
					5)Choose your Options from the below tentative set menus provided for your ready references
					6) Dishes Can be selected from Menu",

					'content_ar' =>"لديك 'محطة توقف' إلى حفل استقبال أو حدث خاص يبعث على القلق والخالية من الإجهاد
				نحن ملتزمون بالاستضافة وجعل الحدث الخاص بك نجاحًا كاملاً منذ اللحظة التي تحجز فيها.

				عزيزي الضيف!
				لقد قمنا بتغطيتك بمجموعة متنوعة من المأكولات المتعددة والمحطات الحية
				للانغماس في! التجمعات وحفلات الزفاف والفعاليات الإعلامية.
				املأ معلوماتك أو اتصل بنا هاتفيًا (تموين - 99067576 / مأدبة - 97644421)
				1) يمكن تغيير الأصناف من طبق إلى طبق من نفس الفئة
				2) سيتم فرض رسوم إضافية على أي عناصر مضافة من قائمة المجموعة المؤقتة
				3) بالنسبة للطاولات والكراسي والتجهيزات الأخرى ، يرجى مناقشة الأمر مع رئيس قسم تقديم الطعام لدينا
				4) سيتم فرض رسوم إضافية على العدادات الحية بناءً على Pax الذي أكدته
				5) اختر خياراتك من القوائم المحددة أدناه المقدمة لمراجعك الجاهزة
				6) يمكن اختيار الأطباق من القائمة",

				'section' => 'mughal_mahal_catering',
				'device_type' => 'web',
				'added_by_id' => 1,
				'updated_by_id' => 1,
                "created_at" => \Carbon\Carbon::now(),
                "last_updated_at" => \Carbon\Carbon::now(),
			],

			[
				'title_en' => 'Contact Us',
				'title_ar' => 'اتصل بنا',

				'content_en' => '
				              <h5>Ask how we can help you:</h5>
				              <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
				              ',

				'content_ar' => '
				              <h5>Ask how we can help you:</h5>
				              <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
				              ',

				'section' => 'contact_us',
				
				'device_type' => 'web',
				'added_by_id' => 1,
				'updated_by_id' => 1,
                "created_at" => \Carbon\Carbon::now(),
                "last_updated_at" => \Carbon\Carbon::now(),
			],

			[
				'title_en' => 'Join Us',

				'title_ar' => 'انضم إلينا',

				'content_en' =>'<ul class="mb-0 ps-0">
			              <li><h6 class="mb-2">Now! Hiring <br> Dumdaar People For Dumdaar Career</h6></li>
			              <li class="mb-3">JOIN the fastest growing F&B consumer company in India. BBK is soon launching in other countries and we pride ourselves in putting employees and customers first. With this high pace growth, we are always on the lookout for talent - for every area of the company. Join us in an organized environment where your career possibilities are endless.</li>
			              <li>We believe in our people, and always encourage new ideas and initiatives. Along with training and leadership guidance, there is no end to the potential for a successful career within Biryani By Kilo.</li>
			            </ul>
			             <h5>Please fill the below form. We are interested in getting to know you.</h5>',

				'content_ar' => '<ul class="mb-0 ps-0">
			              <li><h6 class="mb-2">حاليا! توظيف <br>الناس دومدار لمهنة دمدار</h6></li>
			              <li class="mb-3">انضم إلى الشركة الاستهلاكية الأسرع نموًا في مجال الأغذية والمشروبات في الهند. سيتم إطلاق بنك البحرين والكويت قريبًا في بلدان أخرى ، ونحن نفخر بأنفسنا في وضع الموظفين والعملاء في المرتبة الأولى. مع هذا النمو السريع ، نحن نبحث دائمًا عن المواهب - في كل مجال من مجالات الشركة. انضم إلينا في بيئة منظمة حيث إمكانيات حياتك المهنية لا حصر لها.</li>
			              <li>نحن نؤمن بموظفينا ، ونشجع دائمًا الأفكار والمبادرات الجديدة. جنبًا إلى جنب مع التوجيهات التدريبية والقيادية ، ليس هناك حد لإمكانية النجاح في مهنة برياني بالكيلو.</li>
			            </ul>
			             <h5>يرجى ملء النموذج أدناه. نحن مهتمون بالتعرف عليك.</h5>',

				'section' => 'join_us',
				'device_type' => 'web',
				'added_by_id' => 1,
				'updated_by_id' => 1,
                "created_at" => \Carbon\Carbon::now(),
                "last_updated_at" => \Carbon\Carbon::now(),
			],


			[
				'title_en' => 'Thank you page for Catering',

				'title_ar' => 'صفحة الشكر على تقديم الطعام',

			'content_en' =>'<h2 class="mb-4" data="default" style="color:#009641;">Thank You ):</h2>
						 <p >Your request has been submitted. Thank you for your interest in our catering services</p>',

				'content_ar' => '<h2 class="mb-4" data="default" style="color:#009641;">شكرا لك ):</h2>
						 <p >تم تقديم طلبك. شكرا لك على اهتمامك بخدمات المطاعم لدينا</p>',

				'section' => 'catering_thank_you',
				'device_type' => 'web',
				'added_by_id' => 1,
				'updated_by_id' => 1,
                "created_at" => \Carbon\Carbon::now(),
                "last_updated_at" => \Carbon\Carbon::now(),
			],
			[
				'title_en' => 'Thank you page for contact us',

				'title_ar' => 'صفحة شكرا على الاتصال بنا',

			'content_en' =>'<h2 class="mb-4" data="default" style="color:#009641;">Thank You ):</h2>
						 <p >Thankyou for contacting....</p>',

				'content_ar' => '<h2 class="mb-4" data="default" style="color:#009641;">شكرا لك ):</h2>
						 <p >شكرا على التواصل....</p>',

				'section' => 'contact_us_thank_you',
				'device_type' => 'web',
				'added_by_id' => 1,
				'updated_by_id' => 1,
                "created_at" => \Carbon\Carbon::now(),
                "last_updated_at" => \Carbon\Carbon::now(),
			],

			[
				'title_en' => 'Thank you page for join us',

				'title_ar' => 'صفحة شكرا لانضمامك',

			'content_en' =>'<h2 class="mb-4" data="default" style="color:#009641;">Thank You ):</h2>
						 <p >Your submission has been received</p>',

				'content_ar' => '<h2 class="mb-4" data="default" style="color:#009641;">شكرا لك ):</h2>
						 <p >تم استلام تقريركم</p>',

				'section' => 'join_us_thank_you',
				'device_type' => 'web',
				'added_by_id' => 1,
				'updated_by_id' => 1,
                "created_at" => \Carbon\Carbon::now(),
                "last_updated_at" => \Carbon\Carbon::now(),
			],

            [
				'title_en' => 'Thank you page for Unsubscribe',

				'title_ar' => 'شكرا لك صفحة إلغاء الاشتراك',

			'content_en' =>'<h2 class="mb-4" data="default" style="color:#009641;">Thank You ):</h2>
						 <p >You are now successfully unsubscribed</p>',

				'content_ar' => '<h2 class="mb-4" data="default" style="color:#009641;">شكرا لك ):</h2>
						 <p >أنت الآن غير مشترك بنجاح</p>',

				'section' => 'unsubscribe_thank_you',
				'device_type' => 'web',
				'added_by_id' => 1,
				'updated_by_id' => 1,
                "created_at" => \Carbon\Carbon::now(),
                "last_updated_at" => \Carbon\Carbon::now(),
			],
			 [
				'title_en' => 'Thank you page for subscribe',

				'title_ar' => 'شكرا لك صفحة للاشتراك',

			'content_en' =>'<h2 class="mb-4" data="default" style="color:#009641;">Thank you for subscribing ):</h2>
						 <p >We will notify you regarding Exciting Offers and Newsletter</p>',

				'content_ar' => '<h2 class="mb-4" data="default" style="color:#009641;">شكرا لك على الاشتراك ):</h2>
						 <p >سنخطرك فيما يتعلق بالعروض الرائعة والنشرة الإخبارية</p>',

				'section' => 'subscribe_thank_you',
				'device_type' => 'web',
				'added_by_id' => 1,
				'updated_by_id' => 1,
                "created_at" => \Carbon\Carbon::now(),
                "last_updated_at" => \Carbon\Carbon::now(),
			],
			 [
				'title_en' => 'Copy Right',

				'title_ar' => 'حقوق النشر',

			'content_en' =>'Copyright'.date('Y').'© mugalmahal | All Rights Reserved',

				'content_ar' => 'حقوق النشر'.date('Y').' © mugalmahal | كل الحقوق محفوظة',

				'section' => 'copy_right',
				'device_type' => 'web',
				'added_by_id' => 1,
				'updated_by_id' => 1,
                "created_at" => \Carbon\Carbon::now(),
                "last_updated_at" => \Carbon\Carbon::now(),
			],


			[
				'title_en' => 'Mughal Mahal Store List',

				'title_ar' => 'Mughal Mahal Store List',

			     'content_en' =>null,

				'content_ar' =>null,

				'section' => 'outlets_content',
				'device_type' => 'web',
				'added_by_id' => 1,
				'updated_by_id' => 1,
                "created_at" => \Carbon\Carbon::now(),
                "last_updated_at" => \Carbon\Carbon::now(),
			],
			[
				'title_en' => "Whats In It For You?",

				'title_ar' => "Whats In It For You?",

			    'content_en' =>null,

				'content_ar' =>null,

				'section' => 'loyalty_title',
				'device_type' => 'web',
				'added_by_id' => 1,
				'updated_by_id' => 1,
                "created_at" => \Carbon\Carbon::now(),
                "last_updated_at" => \Carbon\Carbon::now(),
			],
            [
				'title_en' => "Our Management",

				'title_ar' => "إدارتنا",

			    'content_en' =>null,

				'content_ar' =>null,

				'section' => 'our_management',
				'device_type' => 'web',
				'added_by_id' => 1,
				'updated_by_id' => 1,
                "created_at" => \Carbon\Carbon::now(),
                "last_updated_at" => \Carbon\Carbon::now(),
			],
            [
				'title_en' => "Our Brands",

				'title_ar' => "علاماتنا التجارية",

			    'content_en' =>null,

				'content_ar' =>null,

				'section' => 'our_brands',
				'device_type' => 'web',
				'added_by_id' => 1,
				'updated_by_id' => 1,
                "created_at" => \Carbon\Carbon::now(),
                "last_updated_at" => \Carbon\Carbon::now(),
			],
            [
				'title_en' => "Subsidiaries",

				'title_ar' => "الشركات التابعة",

			    'content_en' =>null,

				'content_ar' =>null,

				'section' => 'subsidiaries',
				'device_type' => 'web',
				'added_by_id' => 1,
				'updated_by_id' => 1,
                "created_at" => \Carbon\Carbon::now(),
                "last_updated_at" => \Carbon\Carbon::now(),
			],
            [
				'title_en' => "SignUp/ Login",

				'title_ar' => "تسجيل الدخول",

			    'content_en' =>'If you are coming first time then set your new password. If you are existing user enter your password.',

				'content_ar' =>'إذا كنت قادمًا لأول مرة ، فقم بتعيين كلمة المرور الجديدة. إذا كنت مستخدمًا حاليًا ، أدخل كلمة المرور الخاصة بك.',

				'section' => 'signup_login',
				'device_type' => 'web',
				'added_by_id' => 1,
				'updated_by_id' => 1,
                "created_at" => \Carbon\Carbon::now(),
                "last_updated_at" => \Carbon\Carbon::now(),
			],




		]);
	}
}
