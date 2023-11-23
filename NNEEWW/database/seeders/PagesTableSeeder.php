<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('pages')->delete();
        
        \DB::table('pages')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'Home',
                'section' => 'home_page',
                'device_type' => 'web',
                'content' => '<h1 class="text-white heading_align mb-4 animated slideInDown">DECODE YOUR DNA, EXCEL YOUR HEALTH</h1>

                <p class="text-white animated slideInDown" style="text-align: justify;"><span style="font-size:22px;">Empowering you towards a healthier future through genomics-based &amp; clinically-supported precision healthcare</span></p>

                <div><!-- Button trigger modal --><a class="btn btn-primary-gradient py-sm-3 px-4 mt-3 px-sm-5 rounded-pill me-3 animated slideInLeft" data-bs-target="#exampleModal" data-bs-toggle="modal" href="#">Contact Us</a> <!-- Modal --> <a class="btn py-sm-3 px-4 px-sm-5 rounded-pill mt-3 know-btn animated slideInLeft" href="https://genahealthx.com/know-more">Know More</a></div>

                <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>

                <p><a class="market-btn apple-btn" href="#" role="button" target="_blank"><span class="market-button-title">App Store</span> </a> <a class="market-btn google-btn" href="#" role="button" target="_blank"> <span class="market-button-title">Google Play</span> </a></p>

                <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>

                <h5 class="text-primary-gradient fw-medium">Why Gena HealthX?</h5>

                <h1 class="mb-4 mt-2 text-header">An integrated personalized health ecosystem</h1>

                <p style="margin-bottom: 11px; text-align: justify;"><span style="font-size:20px;"><span class="para-texts" style="text-align:justify;">Experience the transformative power of genomics with Gena HealthX at the forefront. Revolutionizing the future of personalized healthcare, our innovative platform integrates the latest in genomic science with clinical expertise. We bring you a new level of precision in chronic disease prevention, diagnosis, and management.</span></span></p>

                <p><span style="color:#e74c3c;"><strong><span style="font-size:20px;">Embrace the Innovations of Tomorrow&#39;s Healthcare Today</span></strong></span></p>

                <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>

                <h3>Your DNA-Your Health Story</h3>

                <p class="para-texts" style="text-align: justify;"><span style="font-size:20px;">Your DNA is just as UNIQUE as YOU are. A genetic test can reveal the cause or likelyhood of developing a genetic disorder. Yet conventional medical and nutritional practices frequently fail to account for this crucial factor. Ignoring genetic influence in healthcare can result in ineffective treatments. We are here to change that.</span></p>

                <p class="para-texts" style="text-align: justify;"><span style="font-size:20px;">Our expert team of Indian and German scientists decode your DNA and identify potential risk.&nbsp;We help you understand your DNA and what it tells about YOUR body. Following this, we assist you in utilizing this knowledge to personalize your nutrition, medicine, exercise regimen, and overall lifestyle to suit YOUR unique biological makeup.&nbsp;</span></p>

                <p class="para-texts" style="text-align: justify;"><span style="font-size:20px;">Whether you&#39;re looking to lose weight, prevent a disease, manage a health condition, or simply improve your overall health, we&#39;re here to help.</span></p>

                <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>

                <h5 class="mt-2"><em><span style="font-size:20px;"><span style="line-height:107%"><span style="font-family:Calibri,sans-serif"><span style="color:#e74c3c;"><strong>Prediction</strong></span>: Accurately diagnose disease</span></span></span></em></h5>

                <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>

                <h5 class="mt-2"><em><span style="font-size:20px;"><span style="line-height:107%;"><span style="font-family:Calibri,sans-serif;"><span style="color:#e74c3c;"><strong>Prevention</strong></span>: Identify risks prior to disease onset or progression</span></span></span></em></h5>

                <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>

                <h5 class="mt-2"><em><span style="font-size:20px;"><span style="line-height:107%;"><span style="font-family:Calibri,sans-serif;"><span style="color:#e74c3c;"><strong>Precision</strong></span>: Optimal diet, drug and therapy personalized to your unique genetic makeup</span></span></span></em></h5>

                <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>

                <p><a class="btn btn-primary-gradient py-sm-3 px-4 px-sm-5 rounded-pill me-3 animated slideInLeft" href="https://genahealthx.com/services#section1">Explore DNA tests</a></p>

                <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>

                <h3>Genetic Testing + Blood Marker Analysis equals to 360-Degree Personalized Health Insight</h3>

                <p style="text-align:justify;"><span style="font-size:20px;">Our comprehensive approach to health and wellness combines the power of genetic testing with advanced biochemical analysis.<font face="Calibri, sans-serif"><i>&nbsp;</i></font>We examine over 80+ critical blood markers that cover everything from heart health, sugar response, kidney function, to inflammation levels.</span></p>

                <p style="text-align:justify;"><span style="font-size:20px;">We are dedicated to helping you proactively prevent disease and manage chronic conditions for a healthier, happier life.</span></p>

                <p class="para-texts" style="text-align: justify;"><span style="color:#16a085;"><span style="font-size:20px;">Don&#39;t settle for anything less than optimal health - discover your full potential with Gena HealthX today.</span></span></p>

                <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>

                <h3>Getting it right, on the first try, NO hit and trial</h3>

                <p class="para-texts" style="text-align: justify;"><span style="font-size:20px;">We don&#39;t just give you your DNA test reports and leave you confused. We guide you through understanding what they mean. We compare your health data against thousands of independent scientific research reports to deliver 100% customized recommendations. </span></p>

                <p class="para-texts" style="text-align: justify;"><span style="font-size:20px;">Your personalized plan is created specifically for you based on your<span style="color:#16a085;"> genetic data, biochemical test results</span>, taking into account your individual <span style="color:#16a085;">dietary preferences, lifestyle and health goals</span>. Out team of <span style="color:#16a085;">doctors, scientists</span> and <span style="color:#16a085;">clinical nutritionists</span> counsel you in every step of your health journey.</span></p>

                <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>

                <h3 style="text-align: justify;"><br />
                All-in-one App</h3>

                <p class="para-texts" style="text-align: justify;"><span style="font-size:20px;">We understand that modern life can be hectic, so your health should be as easy to manage as possible. That is why we&#39;ve developed an intuitive app that makes it easy to track your health data and get expert guidance. </span></p>

                <p class="para-texts" style="text-align: justify;"><span style="font-size:20px;">We are FIRST in India to provide an integrated app, bringing together your genetic and blood testing results, personalized nutrition, medicine plans, expert coaching and tracking tools all in one convenient place.&nbsp;</span></p>

                <p class="para-texts" style="text-align: justify;"><span style="color:#16a085;"><strong><span style="font-size:20px;">Take charge of your health and wellness right at your fingertips.</span></strong></span></p>

                <p><a class="btn btn-primary-gradient py-sm-3 px-4 px-sm-5 rounded-pill me-3 animated slideInLeft" href="https://genahealthx.com/app-download">Explore the App</a></p>

                <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>

                <h5 class="text-primary-gradient fw-medium">How can Gena HealthX help me?</h5>

                <h1 class="mb-4 mt-2 text-header">Predict-Prevent-Diagnose-Treat. Together we beat chronic diseases!</h1>',
                'status' => 1,
                'deleted_at' => NULL,
                'created_at' => '2023-02-16 17:44:27',
                'updated_at' => '2023-05-06 02:30:15',
            ),
1 => 
array (
    'id' => 2,
    'title' => 'About Us',
    'section' => 'about_us_page',
    'device_type' => 'web',
    'content' => '<h1 class="text-dark mt-5 mb-4 animated slideInDown">Embrace Tomorrow&#39;s Healthcare Innovations Today</h1>

    <p class="text-dark main-text animated slideInDown" style="text-align: justify;"><span style="font-size:20px;">Don&#39;t settele for anything less than optimal health: discover your full potential with Gena HealthX</span></p>

    <p><a class="btn btn-primary-gradient mt-3 py-sm-3 px-4 px-sm-5 rounded-pill me-3 animated slideInLeft" href="https://genahealthx.com/services">Select a plan</a> <a class="btn know-btn py-sm-3 px-4 mt-3 px-sm-5 rounded-pill me-3 animated slideInLeft" data-bs-target="#exampleModal" data-bs-toggle="modal" href="#">Contact Us</a></p>

    <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>

    <h2 class="content_heading">Unlock Your Health Potential With Gena HealthX- Where Cutting-Edge Genomics Meets Evidence-Based Clinical Solutions To Empower YOU</h2>

    <p style="text-align: justify;"><span style="font-size:20px;">Innovating the future of healthcare, we offer a complete well-being solution for chronic disease prevention, diagnosis and management.We help people lose weight, reduce risks of cardiovascular diseases, renal disorders, PCOS, diabetes, hypertension, cancers and many more. We ensure that you are receiving the most advanced and effective personalized plans, so that you can focus on life.</span></p>

    <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>

    <h2>Our technology</h2>

    <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>

    <h2>How does Gena Healthx work?</h2>

    <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>',
    'status' => 1,
    'deleted_at' => NULL,
    'created_at' => '2023-02-16 17:44:27',
    'updated_at' => '2023-05-06 02:29:22',
),
2 => 
array (
    'id' => 3,
    'title' => 'Our Services',
    'section' => 'our_services_page',
    'device_type' => 'web',
    'content' => '<h5 class="text-primary-gradient fw-medium">Select a Diet Plan</h5>

    <h1 class="mb-2 mt-2 text-header">Don&#39;t settle for anything less that optimal health- discover the power of clinically and genetics based nutritional guidance</h1>

    <p class="para-text" style="text-align: justify;"><span style="color:#000000;"><span style="font-size:20px;">Our mission is to help people live longer, healthier and happier. Unlocking the power of personalized nutrition with cutting-edge nutrigenomics and nutrigenetics - that&#39;s how we lead the way! Access to thousands of nutritious meals that are approved by nutritionists, assistance with monitoring caloric intake and output, and a range of other services are available through our team of expert geneticists, doctors, and clinical nutritionists. </span></span></p>

    <p style="margin-bottom: 11px;"><span style="font-size:20px;"><span class="para-text"><span style="color: rgb(204, 0, 0);">✓</span><font color="#27ae60">&nbsp;</font>Exactly which foods to eat and avoid</span></span></p>

    <p style="margin-bottom: 11px;"><span style="font-size:20px;"><span class="para-text"><span style="color:#cc0000;">✓&nbsp;</span>Which nutritional supplement to take</span></span></p>

    <p style="margin-bottom: 11px;"><span style="font-size:20px;"><span class="para-text"><span style="color:#cc0000;">✓&nbsp;</span>What medicines suits you and which ones may have side effects</span></span></p>

    <p><span style="font-size:20px;"><span class="para-text"><span style="color:#cc0000;">✓&nbsp;</span>Is Keto diet or intermittent fasting right for you?</span></span></p>

    <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>

    <h5 class="text-primary-gradient fw-medium">Select a Genetic Tests</h5>

    <h1 class="mb-4 mt-2 text-header">Stay ahead of game: Predict and Prevent complications before they occur!</h1>

    <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>

    <h4 class="priceing_heading text-center pt-md-4 wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">Preventive genetic tests</h4>

    <p class="para-text" style="text-align: justify;"><span style="color:#000000;"><span style="font-size:20px;">Our genetic tests mark a breakthrough in disease management, affording us the opportunity to detect, prevent, manage, and possibly even reverse prevalent afflictions such as diabetes, hypertension, heart disorders, PCOS, food sensitivities, and numerous other conditions.</span></span></p>

    <p class="para-text" style="text-align: justify;"><span style="color:#000000;"><span style="font-size:20px;">We provides personalized insights into your unique health needs and potential genetic risks. Unlike other DNA tests, we offer comprehensive 360&deg; care for your organ health throughout your life, including tailored nutrition, exercise, lifestyle, and behavior guidance. With our help, you can avoid trial and error in medication and clinical investigations and unlock your full potential for optimal health and wellness.</span></span></p>

    <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>

    <h4 class="priceing_heading text-center pt-md-4 wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">Diagnostic and PGx genetic tests</h4>

    <p class="para-text text-center" style="text-align: justify;"><span style="color:#000000;"><span style="font-size:20px;"><span class="para-text text-center">If you&#39;re struggling with a severe form of cancer, we understand how overwhelming it can be. Our expertise can guide you and your practitioner in identifying the optimal therapy for your condition. Despite receiving initial treatment and having the cancer removed, many individuals experience a recurrence of the disease. Shockingly, around 30% of individuals with breast cancer who have undergone initial local treatment will have a recurrence. For brain cancers like Glioblastoma, this number increases to 100%. </span></span></span></p>

    <p style="text-align: justify;"><span style="font-size:20px;"><span class="para-text text-center">Our approach to cancer treatment is tailored to your unique genetic report, offering targeted precision therapies, advanced treatments, and clinical trials options. With our expertise, you can make informed decisions and take charge of your health, preventing cancer recurrence and maximizing your well-being. </span></span></p>

    <p style="text-align: justify;"><span style="font-size:20px;"><span class="para-text text-center">We specialize in analysing your unique genetic response to medication to identify the treatment plan that will best address your individual needs.&nbsp;</span></span><span style="font-size:20px;"><span class="para-text text-center">Trust us to empower you with the knowledge and tools you need to safeguard your health and well-being.</span></span></p>

    <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>

    <h5 class="text-primary-gradient fw-medium">Select a Specialzed Diet Plan</h5>

    <h1 class="mb-2 mt-2 text-header">Jumpstart Your Health: Specialized Short-Term Diet Plans</h1>

    <p class="para-text" style="text-align: justify;"><span style="font-size:16px;">Embark on your journey towards better health today with our Specialized Short-Term Diet Plans. If you&#39;re curious about optimizing your health but want to test the waters before committing to genetic testing, our expertly curated diet plans are the perfect solution.&nbsp;With our professional guidance, you&#39;ll have the tools to make informed choices about your nutrition, paving the way for improved health and well-being. Our plans are carefully crafted, easy to follow, and designed for maximum effectiveness.&nbsp;Take the first step towards unlocking the power of personalized nutrition, and when you&#39;re ready, consider our genetic testing services for a comprehensive approach to optimizing your wellness.</span></p>

    <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>

    <h5 class="text-primary-gradient fw-medium">Consultations / Partner labs</h5>

    <h1 class="mb-4 mt-2 text-header">Book a consultation session!</h1>

    <p class="para-text" style="text-align: justify;"><span style="font-size:20px;"><span style="color:#000000;">Don&#39;t wait to prioritize your health - book a consultation with us today to discover personalized healthcare solutions tailored to your unique needs. Our team of experts, including top-rated doctors, leading scientists, clinical nutritionists, and partner labs, is committed to empowering you on your journey towards better health.</span></span></p>

    <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>

    <p>Every day from 08:00 to 20:00&nbsp;</p>

    <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>

    <p>+91 0000000000</p>

    <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>

    <h5 class="text-primary-gradient fw-medium">Our Testimonial</h5>

    <h1 class="mb-4 mt-2 text-header">What Our Clients Say!</h1>',
    'status' => 1,
    'deleted_at' => NULL,
    'created_at' => '2023-02-16 17:44:27',
    'updated_at' => '2023-05-06 03:01:38',
),
3 => 
array (
    'id' => 4,
    'title' => 'Our App',
    'section' => 'our_app_page',
    'device_type' => 'web',
    'content' => '<h5 class="text-primary-gradient fw-medium">Download App</h5>

    <h1 class="mb-4 mt-2 text-header">All-in-One App: take charge of your health and wellness right at your fingertips</h1>

    <p class="para-texts" style="text-align: justify;"><span style="font-size:16px;">Access precision insights, tracking, expert guidance, and cutting-edge technology in a single, easy-to-use platform. With access to doctor consultation services, unlimited clinical nutritionist consultations, and nutritionist-approved meals, you can monitor your nutrition intake and output seamlessly through our user-friendly app.</span></p>

    <p class="para-texts" style="text-align: justify;"><span style="font-size:16px;">Achieve sustainable and long-lasting results with the help of measurable data, real-time insights, and professional coaching. With our app&#39;s comprehensive and advanced technology, you can trust that you are receiving accurate and personalized information that can help you make informed decisions about your health.</span></p> 

    <div class="row g-4">
    <div class="col-sm-6 wow fadeIn" data-wow-delay="0.5s">
    <div class="ms-3">
    <p class="text-white mb-0"><a class="d-flex bg-primary-gradient download-anchor" href="#">Available On</a></p>

    <h5 class="text-white download-btn mb-0"><a class="d-flex bg-primary-gradient download-anchor" href="#">App Store</a></h5>
    </div>
    </div>

    <div class="col-sm-6 wow fadeIn" data-wow-delay="0.7s">
    <div class="ms-3">
    <p class="text-white mb-0"><a class="d-flex bg-secondary-gradient download-anchor" href="#">Available On</a></p>

    <h5 class="text-white download-btn mb-0"><a class="d-flex bg-secondary-gradient download-anchor" href="#">Play Store</a></h5>
    </div>
    </div>
    </div>

    <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>

    <h5 class="text-primary-gradient fw-medium">Gena HealthX</h5>

    <h1 class="mb-4 mt-2 text-header">Download the app and start your PRECISION health revolution</h1>

    <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>

    <h2 class="second_heading">1</h2>

    <h3>DNA Predisposition Report</h3>

    <ul>
    <li style="margin-left: 8px; text-align: justify;"><span style="font-size:11pt"><span style="line-height:107%"><span style="font-family:Calibri,sans-serif">Access the most comprehensive genetic report available in India, covering Health, Nutrition, Fitness, Wellness, and Chronic Disease insights</span></span></span></li>
    <li style="margin-left: 8px; text-align: justify;"><span style="font-size:11pt"><span style="line-height:107%"><span style="font-family:Calibri,sans-serif">Discover your risk of experiencing specific health issues with the help of a cutting-edge disease risk analyser that uses your DNA to provide accurate scores</span></span></span></li>
    <li style="margin-left: 8px; text-align: justify;"><span style="font-size:11pt"><span style="line-height:107%"><span style="font-family:Calibri,sans-serif">Receive DNA health reports that analyse over 300 issues and conditions to help you better understand your genetic predispositions</span></span></span></li>
    <li style="margin-left: 8px; text-align: justify;"><span style="font-size:11pt"><span style="line-height:107%"><span style="font-family:Calibri,sans-serif">Receive personalized, 30-minute interpretation from internationally certified genetic scientists from Germany </span></span></span></li>
    <li style="margin-left: 8px; text-align: justify;"><span style="font-size:11pt"><span style="line-height:107%"><span style="font-family:Calibri,sans-serif">Avail easy-to-understand genetic counseling services to help you make informed decisions about your health</span></span></span></li>
    <li style="margin-bottom: 11px; margin-left: 8px; text-align: justify;"><span style="font-size:11pt"><span style="line-height:107%"><span style="font-family:Calibri,sans-serif">Get complete action plan on adapting your lifestyle, nutrition, and medicine to optimize your health based on your genetic results</span></span></span></li>
    </ul>

    <p><br />
    &nbsp;</p>

    <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>

    <h2 class="second_heading">2</h2>

    <h3>Metabolic Marker Analysis and Tracking</h3>

    <ul>
    <li style="margin-left: 32px; text-align: justify;"><span style="font-size:11pt"><span style="line-height:107%"><span style="font-family:Calibri,sans-serif">DNA offers valuable insight, but it tells part of the story. Unlock a complete health picture with personalized biochemical markers analysis and tracking. </span></span></span></li>
    <li style="margin-left:32px; text-align:justify"><span style="font-size:11pt"><span style="line-height:107%"><span style="font-family:Calibri,sans-serif">Store and access all your medical reports anytime, anywhere with our app&#39;s secure cloud network</span></span></span></li>
    <li style="margin-left:32px; text-align:justify"><span style="font-size:11pt"><span style="line-height:107%"><span style="font-family:Calibri,sans-serif">Know if your levels of biochemical markers are low, normal, optimal, or high by uploading your lab report</span></span></span></li>
    <li style="margin-left:32px; text-align:justify"><span style="font-size:11pt"><span style="line-height:107%"><span style="font-family:Calibri,sans-serif">Track your &lsquo;Organs Health&rsquo; progress over time with our app&#39;s graphical representation of your biochemical markers. </span></span></span></li>
    <li style="margin-left:32px;text-align:justify;"><span style="font-size:11pt;"><span style="line-height:107%;"><span style="font-family:Calibri,sans-serif;">Get personalized advice and track your markers visually to see positive changes over time</span></span></span></li>
    <li style="margin-left:32px;text-align:justify;"><span style="font-size:11pt;"><span style="line-height:107%;"><span style="font-family:Calibri,sans-serif;">Log and track 100+ parameters including pulse, body measurements, BMI, blood pressure, blood sugar, HbA1C, serum creatinine and many more</span></span></span></li>
    </ul>

    <p>&nbsp;</p>

    <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>

    <h2 class="second_heading">3</h2>

    <h3>Precision Diet Plans</h3>

    <ul>
    <li style="text-align:justify; margin-left:8px"><span style="font-size:11pt"><span style="line-height:107%"><span style="font-family:Calibri,sans-serif">Benefit from expert actionable guidance on chronic disease or preventive dietary management with unlimited consultation calls from our exceptional clinical nutritionists</span></span></span></li>
    <li style="text-align:justify; margin-left:8px"><span style="font-size:11pt"><span style="line-height:107%"><span style="font-family:Calibri,sans-serif">Achieve optimal nutrition with comprehensive breakdowns of macro and micronutrients customized by our clinical nutritionists to fit your body&#39;s requirements</span></span></span></li>
    <li style="text-align:justify; margin-left:8px"><span style="font-size:11pt"><span style="line-height:107%"><span style="font-family:Calibri,sans-serif">Receive a meal plan with recipes, ingredients and cooking instructions</span></span></span></li>
    <li style="text-align:justify; margin-left:8px"><span style="font-size:11pt"><span style="line-height:107%"><span style="font-family:Calibri,sans-serif">Learn what vitamins, minerals and superfood your body needs most</span></span></span></li>
    <li style="text-align:justify; margin-bottom:11px; margin-left:8px"><span style="font-size:11pt"><span style="line-height:107%"><span style="font-family:Calibri,sans-serif">Get personalized medicine and supplement recommendations tailored to your DNA</span></span></span></li>
    </ul>

    <p>&nbsp;</p>

    <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>

    <h2 class="second_heading">4</h2>

    <h3>Complete Health Companion&nbsp;</h3>

    <ul>
    <li style="text-align:justify; margin-left:8px"><span style="font-size:11pt"><span style="line-height:107%"><span style="font-family:Calibri,sans-serif">Healthy living is more than just counting calories. It&#39;s about feeling great, thriving, and living longer! For this you need Gena HelathX&rsquo;s &nbsp;&lsquo;Total Health Tracker&rsquo; </span></span></span></li>
    <li style="text-align:justify; margin-left:8px"><span style="font-size:11pt"><span style="line-height:107%"><span style="font-family:Calibri,sans-serif">Set goals and track your progress with few clicks</span></span></span></li>
    <li style="text-align:justify; margin-left:8px"><span style="font-size:11pt"><span style="line-height:107%"><span style="font-family:Calibri,sans-serif">Track the food and water you consume, and monitor your daily calorie expenditure</span></span></span></li>
    <li style="text-align:justify; margin-left:8px"><span style="font-size:11pt"><span style="line-height:107%"><span style="font-family:Calibri,sans-serif">Set reminders for medicine and water intake</span></span></span></li>
    <li style="text-align:justify; margin-left:8px"><span style="font-size:11pt"><span style="line-height:107%"><span style="font-family:Calibri,sans-serif">Get access to thousands of healthy recipes</span></span></span></li>
    <li style="text-align:justify; margin-bottom:11px; margin-left:8px"><span style="font-size:11pt"><span style="line-height:107%"><span style="font-family:Calibri,sans-serif">Get all your health queries cleared by talking to experts</span></span></span></li>
    <li style="margin-left:8px;text-align:justify;"><strong><span style="color:#e74c3c;"><span style="font-size:16px;"><em>Live life to the fullest, with us by your side! Forever your health companion</em></span></span></strong></li>
    </ul>

    <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>',
    'status' => 1,
    'deleted_at' => NULL,
    'created_at' => '2023-02-16 17:44:27',
    'updated_at' => '2023-04-18 00:26:56',
),
4 => 
array (
    'id' => 5,
    'title' => 'Contact Us',
    'section' => 'contact_us_page',
    'device_type' => 'web',
    'content' => '
    <h1 > WEIGHT LOSS AND DISEASE </h1>
    <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>
    <h2 style="font-size:30px;font-weight: 600 !important;"> MANAGEMENT FOR A HEALTHIER YOU </h2>
    <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>
    <h5 >
    Fill the form below to Consult  a certified Nutritionist and fix your Weight gain / Thyroid / PCOS / Diabetes with a Personalised Indian Diet Plan
    </h5>

    ',
    'status' => 1,
    'deleted_at' => NULL,
    'created_at' => '2023-02-16 17:44:27',
    'updated_at' => '2023-02-16 17:44:27',
),
5 => 
array (
    'id' => 6,
    'title' => 'Our Team',
    'section' => 'our_teams_page',
    'device_type' => 'web',
    'content' => '<h5 class="text-primary-gradient fw-medium">Our Team</h5>

    <h1 class="mb-4 mt-2 text-header">Pillars of Excellence, Our Team Stands Tall</h1>',
    'status' => 1,
    'deleted_at' => NULL,
    'created_at' => '2023-02-16 17:44:27',
    'updated_at' => '2023-04-14 00:32:11',
),
6 => 
array (
    'id' => 7,
    'title' => 'Our Recipes',
    'section' => 'our_recipes_page',
    'device_type' => 'web',
    'content' => ' 
    <h5 class="text-primary-gradient fw-medium">Our Recipes</h5>
    <h1 class="mb-4 mt-2 text-header">Health Requires Healthy Food</h1>
    <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>
    <p class="text-center para-text w-50 m-auto mb-4">Our team of professional chefs and nutritionists know how to make healthy eating delicious. Check out
    these healthy recipes to spice up your meals!
    </p>
    ',
    'status' => 1,
    'deleted_at' => NULL,
    'created_at' => '2023-02-16 17:44:27',
    'updated_at' => '2023-02-16 17:44:27',
),
7 => 
array (
    'id' => 8,
    'title' => 'Science',
    'section' => 'science',
    'device_type' => 'web',
    'content' => ' <h5 class="text-primary-gradient fw-medium">Science</h5>
    <h1 class="mb-4 mt-2 text-header">The Science of connection</h1>
    <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>',
    'status' => 1,
    'deleted_at' => NULL,
    'created_at' => '2023-02-16 17:44:27',
    'updated_at' => '2023-02-16 17:44:27',
),
8 => 
array (
    'id' => 9,
    'title' => 'Clinicians',
    'section' => 'clinicians',
    'device_type' => 'web',
    'content' => '<h2>We help you integrate genetic testing into clinical care</h2>
    <p>Submit your details and one of our expert will get in touch with you</p>
    <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>
    ',
    'status' => 1,
    'deleted_at' => NULL,
    'created_at' => '2023-02-16 17:44:27',
    'updated_at' => '2023-02-16 17:44:27',
),
9 => 
array (
    'id' => 10,
    'title' => 'Partner labs',
    'section' => 'partner_labs',
    'device_type' => 'web',
    'content' => '            
    <h1 class="mb-2 mt-2 text-header">Choose our partner labs for reliable clinical tests</h1>
    <p class="para-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem fugit quaerat similique accusantium nesciunt repellendus necessitatibus aperiam laboriosam, 
    voluptates quasi inventore accusamus excepturi provident sed laborum architecto vero voluptatibus ipsam!
    </p>
    <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>',
    'status' => 1,
    'deleted_at' => NULL,
    'created_at' => '2023-02-16 17:44:27',
    'updated_at' => '2023-02-16 17:44:27',
),
10 => 
array (
    'id' => 11,
    'title' => 'Careers',
    'section' => 'careers',
    'device_type' => 'web',
    'content' => '<h5 class="text-primary-gradient fw-medium">Careers</h5>

    <h1 class="mb-4 mt-2 text-header">Empowering people to create positive change across the globe</h1>

    <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>

    <p class="category">We are<br />
    <span>Hiring</span><br />
    for all positions!</p>

    <p><a class="CTA" href="#">Apply at contact@genahealthx.com</a></p>

    <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>

    <h4>Work at Gena HealthX</h4>

    <p>Are you ready to join our dynamic team of hardworking, fun-loving individuals? Browse our current job openings and discover if you have what it takes to be part of something truly special. We&#39;re looking for talented, passionate individuals to help us make a difference in people&#39;s lives. Are you up for the challenge?</p>

    <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>

    <p>VIEW OPENINGS</p>

    <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>

    <h5 class="text-primary-gradient fw-medium">Our Values</h5>

    <h1>Guided by integrity and driven by impact!</h1>
    <!-- <h5 class="text-primary-gradient fw-medium">Our Values</h5>
    <h1 class="mb-4 mt-2 text-header">Lorem Ipsum</h1> -->

    <div class="row g-4">
    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
    <div class="values-item text-center p-4"><!-- <div class="d-inline-flex align-items-center justify-content-center bg-primary-gradient rounded-circle mb-3" style="width: 60px; height: 60px;">
    <img src="https://server3.rvtechnologies.in/Gena-HealthX/web/public/front/img/Mission.svg" class="mission_icons">
    </div> -->
    <h5 class="mb-0 service-heading">Mission First</h5>
    </div>
    </div>

    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
    <div class="values-item text-center p-4"><!-- <div class="d-inline-flex align-items-center justify-content-center bg-primary-gradient rounded-circle mb-3" style="width: 60px; height: 60px;">
    <img src="https://server3.rvtechnologies.in/Gena-HealthX/web/public/front/img/owner.svg" class="owner_icons">
    </div> -->
    <h5 class="mb-0 service-heading">Act Like An Owner</h5>
    </div>
    </div>

    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
    <div class="values-item text-center p-4"><!-- <div class="d-inline-flex align-items-center justify-content-center bg-primary-gradient rounded-circle mb-3" style="width: 60px; height: 60px;">
    <img src="https://server3.rvtechnologies.in/Gena-HealthX/web/public/front/img/impossible.svg" class="impossible_icons">
    </div> -->
    <h5 class="mb-0 service-heading">DO The Impossible</h5>
    </div>
    </div>

    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
    <div class="values-item text-center p-4"><!-- <div class="d-inline-flex align-items-center justify-content-center bg-primary-gradient rounded-circle mb-3" style="width: 60px; height: 60px;">
    <img src="https://server3.rvtechnologies.in/Gena-HealthX/web/public/front/img/focus.svg" class="focus_icons">
    </div> -->
    <h5 class="mb-0 service-heading">Customer Focused</h5>
    </div>
    </div>

    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
    <div class="values-item text-center p-4"><!-- <div class="d-inline-flex align-items-center justify-content-center bg-primary-gradient rounded-circle mb-3" style="width: 60px; height: 60px;">
    <img src="https://server3.rvtechnologies.in/Gena-HealthX/web/public/front/img/right.svg" class="right_icons">
    </div> -->
    <h5 class="mb-0 service-heading">Do The Right Thing</h5>
    </div>
    </div>

    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
    <div class="values-item text-center p-4"><!-- <div class="d-inline-flex align-items-center justify-content-center bg-primary-gradient rounded-circle mb-3" style="width: 60px; height: 60px;">
    <img src="https://server3.rvtechnologies.in/Gena-HealthX/web/public/front/img/standard.svg" class="standard_icons">
    </div> -->
    <h5 class="mb-0 service-heading">High Standards</h5>
    </div>
    </div>
    </div>

    <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>

    <h5 class="text-primary-gradient fw-medium">Our Perks</h5>

    <h1 class="mb-0 mt-2 text-header">Rewards that match your passion and dedication</h1>

    <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>

    <h5 class="mb-2 service-heading">Competitive salary</h5>

    <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>

    <h5 class="mb-2 service-heading">Internal mobility</h5>

    <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>

    <h5 class="mb-2 service-heading">Friendly policies</h5>

    <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>

    <h5 class="mb-2 service-heading">Work life balance</h5>

    <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>

    <h5 class="mb-2 service-heading">Flexible leave policy</h5>

    <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>

    <h5 class="mb-2 service-heading">Training and development</h5>

    <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>

    <h5 class="text-primary-gradient fw-medium">Current openings</h5>

    <h4 class="mb-0 mt-2 text-header"><b>Send your resume at</b> contact@genahealthx.com</h4>',
    'status' => 1,
    'deleted_at' => NULL,
    'created_at' => '2023-02-16 17:44:27',
    'updated_at' => '2023-04-02 23:11:01',
),
11 => 
array (
    'id' => 12,
    'title' => 'Privacy Policy',
    'section' => 'privacy_policy',
    'device_type' => 'web',
    'content' => ' 
    <strong>Privacy Policy</strong>
    <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, 
    when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap 
    into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum 
    passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

    <strong>Information Collection and Use</strong>
    <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, 
    when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap 
    into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum 
    passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

    <strong>Log Data</strong>
    <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, 
    when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap 
    into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum 
    passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

    <strong>Cookies</strong>
    <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, 
    when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap 
    into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum 
    passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

    <strong>Service Providers</strong>
    <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, 
    when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap 
    into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum 
    passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

    <strong>Security</strong>
    <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, 
    when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap 
    into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum 
    passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

    <strong>Links to Other Sites</strong>
    <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, 
    when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap 
    into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum 
    passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

    <strong>Children’s Privacy</strong>
    <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, 
    when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap 
    into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum 
    passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

    <strong>Changes to This Privacy Policy</strong>
    <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, 
    when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap 
    into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum 
    passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

    <strong>Contact Us</strong>
    <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, 
    when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap 
    into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum 
    passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

    ',
    'status' => 1,
    'deleted_at' => NULL,
    'created_at' => '2023-02-16 17:44:27',
    'updated_at' => '2023-02-16 17:44:27',
),
12 => 
array (
    'id' => 13,
    'title' => 'Terms & Conditions',
    'section' => 'terms_and_conditions',
    'device_type' => 'web',
    'content' => ' 
    <strong>Accepting The Terms</strong>
    <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.</p>
    <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cum sociis natoque
    penatibus et magnis dis parturient montes, nascetur ridiculus mus. Etiam porta sem malesuada magna mollis
    euismod. Nulla vitae elit libero, a pharetra augue. Nullam id dolor id nibh ultricies vehicula ut id elit. Donec
    ullamcorper nulla non metus auctor fringilla. Maecenas sed diam eget risus varius blandit sit amet non magna.
    </p>
    <p>Nullam quis risus eget urna mollis ornare vel eu leo. Donec id elit non mi porta gravida at eget metus. Donec
    sed odio dui. Donec sed odio dui. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Integer
    posuere erat a ante venenatis dapibus posuere velit aliquet. Donec ullamcorper nulla non metus auctor fringilla.
    Cras mattis consectetur purus sit amet fermentum. Curabitur blandit tempus porttitor. Lorem ipsum dolor sit
    amet, consectetur adipiscing elit.</p>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam id dolor id nibh ultricies vehicula ut id elit.
    Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit sit amet non
    magna.</p>
    <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cum sociis natoque
    penatibus et magnis dis parturient montes, nascetur ridiculus mus. Etiam porta sem malesuada magna mollis
    euismod. Nulla vitae elit libero, a pharetra augue. Nullam id dolor id nibh ultricies vehicula ut id elit. Donec
    ullamcorper nulla non metus auctor fringilla. Maecenas sed diam eget risus varius blandit sit amet non magna.
    </p>
    <p>Nullam quis risus eget urna mollis ornare vel eu leo. Donec id elit non mi porta gravida at eget metus. Donec
    sed odio dui. Donec sed odio dui. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Integer
    posuere erat a ante venenatis dapibus posuere velit aliquet. Donec ullamcorper nulla non metus auctor fringilla.
    Cras mattis consectetur purus sit amet fermentum. Curabitur blandit tempus porttitor. Lorem ipsum dolor sit
    amet, consectetur adipiscing elit.</p>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam id dolor id nibh ultricies vehicula ut id elit.
    Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit sit amet non
    magna.</p>
    <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cum sociis natoque
    penatibus et magnis dis parturient montes, nascetur ridiculus mus. Etiam porta sem malesuada magna mollis
    euismod. Nulla vitae elit libero, a pharetra augue. Nullam id dolor id nibh ultricies vehicula ut id elit. Donec
    ullamcorper nulla non metus auctor fringilla. Maecenas sed diam eget risus varius blandit sit amet non magna.
    </p>
    <p>Nullam quis risus eget urna mollis ornare vel eu leo. Donec id elit non mi porta gravida at eget metus. Donec
    sed odio dui. Donec sed odio dui. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Integer
    posuere erat a ante venenatis dapibus posuere velit aliquet. Donec ullamcorper nulla non metus auctor fringilla.
    Cras mattis consectetur purus sit amet fermentum. Curabitur blandit tempus porttitor. Lorem ipsum dolor sit
    amet, consectetur adipiscing elit.</p>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam id dolor id nibh ultricies vehicula ut id elit.
    Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit sit amet non
    magna.</p>
    <div id="privacy-notice">
    <strong>Privacy Notice</strong>
    <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.</p>
    <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cum sociis natoque
    penatibus et magnis dis parturient montes, nascetur ridiculus mus. Etiam porta sem malesuada magna mollis
    euismod. Nulla vitae elit libero, a pharetra augue. Nullam id dolor id nibh ultricies vehicula ut id elit.
    Donec ullamcorper nulla non metus auctor fringilla. Maecenas sed diam eget risus varius blandit sit amet non
    magna.</p>
    <p>Nullam quis risus eget urna mollis ornare vel eu leo. Donec id elit non mi porta gravida at eget metus. Donec
    sed odio dui. Donec sed odio dui. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.
    Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Donec ullamcorper nulla non metus auctor
    fringilla. Cras mattis consectetur purus sit amet fermentum. Curabitur blandit tempus porttitor. Lorem ipsum
    dolor sit amet, consectetur adipiscing elit.</p>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam id dolor id nibh ultricies vehicula ut id
    elit. Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit sit amet
    non magna.</p>
    <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cum sociis natoque
    penatibus et magnis dis parturient montes, nascetur ridiculus mus. Etiam porta sem malesuada magna mollis
    euismod. Nulla vitae elit libero, a pharetra augue. Nullam id dolor id nibh ultricies vehicula ut id elit.
    Donec ullamcorper nulla non metus auctor fringilla. Maecenas sed diam eget risus varius blandit sit amet non
    magna.</p>
    <p>Nullam quis risus eget urna mollis ornare vel eu leo. Donec id elit non mi porta gravida at eget metus. Donec
    sed odio dui. Donec sed odio dui. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.
    Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Donec ullamcorper nulla non metus auctor
    fringilla. Cras mattis consectetur purus sit amet fermentum. Curabitur blandit tempus porttitor. Lorem ipsum
    dolor sit amet, consectetur adipiscing elit.</p>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam id dolor id nibh ultricies vehicula ut id
    elit. Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit sit amet
    non magna.</p>
    <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cum sociis natoque
    penatibus et magnis dis parturient montes, nascetur ridiculus mus. Etiam porta sem malesuada magna mollis
    euismod. Nulla vitae elit libero, a pharetra augue. Nullam id dolor id nibh ultricies vehicula ut id elit.
    Donec ullamcorper nulla non metus auctor fringilla. Maecenas sed diam eget risus varius blandit sit amet non
    magna.</p>
    <p>Nullam quis risus eget urna mollis ornare vel eu leo. Donec id elit non mi porta gravida at eget metus. Donec
    sed odio dui. Donec sed odio dui. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.
    Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Donec ullamcorper nulla non metus auctor
    fringilla. Cras mattis consectetur purus sit amet fermentum. Curabitur blandit tempus porttitor. Lorem ipsum
    dolor sit amet, consectetur adipiscing elit.</p>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam id dolor id nibh ultricies vehicula ut id
    elit. Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit sit amet
    non magna.</p>


    </div>',
    'status' => 1,
    'deleted_at' => NULL,
    'created_at' => '2023-02-16 17:44:27',
    'updated_at' => '2023-02-16 17:44:27',
),
13 => 
array (
    'id' => 14,
    'title' => 'FAQ',
    'section' => 'faq',
    'device_type' => 'web',
    'content' => '',
    'status' => 1,
    'deleted_at' => NULL,
    'created_at' => '2023-02-16 17:44:27',
    'updated_at' => '2023-02-16 17:44:27',
),
14 => 
array (
    'id' => 15,
    'title' => 'Footer',
    'section' => 'footer',
    'device_type' => 'web',
    'content' => '<p class="para-text mt-3"><span style="color:#000000;">DECODE YOUR DNA, EXCEL YOUR HEALTH.&nbsp;</span></p>

    <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>

    <p class="mb-0">&nbsp;</p>

    <p class="mb-0">Gopalapatnam, Visakhapatnam, AP, INDIA<br />
    contact@genahealthx.com</p>

    <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>

    <p class="mb-0">Rudolf-Diesel-Strasse 11, Heidelberg, GERMANY<br />
    contact@genahealthx.com<br />
    Office: +49 6221648404</p>

    <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>

    <div class="row">
    <div class="col-sm-12 footer-bottom text-center p-4">
    <p class="m-0">Copyright &copy; 2022 all rights reserved GenaHealthX</p>
    </div>
    </div>',
    'status' => 1,
    'deleted_at' => NULL,
    'created_at' => '2023-02-16 17:44:27',
    'updated_at' => '2023-03-20 03:32:17',
),
15 => 
array (
    'id' => 16,
    'title' => 'Privacy Policy',
    'section' => 'privacy_policy',
    'device_type' => 'mobile',
    'content' => ' 
    <strong>Privacy Policy</strong>
    <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, 
    when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap 
    into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum 
    passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

    <strong>Information Collection and Use</strong>
    <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, 
    when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap 
    into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum 
    passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

    <strong>Log Data</strong>
    <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, 
    when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap 
    into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum 
    passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

    <strong>Cookies</strong>
    <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, 
    when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap 
    into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum 
    passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

    <strong>Service Providers</strong>
    <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, 
    when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap 
    into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum 
    passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

    <strong>Security</strong>
    <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, 
    when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap 
    into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum 
    passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

    <strong>Links to Other Sites</strong>
    <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, 
    when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap 
    into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum 
    passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

    <strong>Children’s Privacy</strong>
    <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, 
    when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap 
    into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum 
    passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

    <strong>Changes to This Privacy Policy</strong>
    <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, 
    when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap 
    into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum 
    passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

    <strong>Contact Us</strong>
    <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, 
    when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap 
    into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum 
    passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

    ',
    'status' => 1,
    'deleted_at' => NULL,
    'created_at' => '2023-02-16 17:44:27',
    'updated_at' => '2023-02-16 17:44:27',
),
16 => 
array (
    'id' => 17,
    'title' => 'Terms & Conditions',
    'section' => 'terms_and_conditions',
    'device_type' => 'mobile',
    'content' => ' 
    <strong>Accepting The Terms</strong>
    <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.</p>
    <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cum sociis natoque
    penatibus et magnis dis parturient montes, nascetur ridiculus mus. Etiam porta sem malesuada magna mollis
    euismod. Nulla vitae elit libero, a pharetra augue. Nullam id dolor id nibh ultricies vehicula ut id elit. Donec
    ullamcorper nulla non metus auctor fringilla. Maecenas sed diam eget risus varius blandit sit amet non magna.
    </p>
    <p>Nullam quis risus eget urna mollis ornare vel eu leo. Donec id elit non mi porta gravida at eget metus. Donec
    sed odio dui. Donec sed odio dui. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Integer
    posuere erat a ante venenatis dapibus posuere velit aliquet. Donec ullamcorper nulla non metus auctor fringilla.
    Cras mattis consectetur purus sit amet fermentum. Curabitur blandit tempus porttitor. Lorem ipsum dolor sit
    amet, consectetur adipiscing elit.</p>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam id dolor id nibh ultricies vehicula ut id elit.
    Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit sit amet non
    magna.</p>
    <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cum sociis natoque
    penatibus et magnis dis parturient montes, nascetur ridiculus mus. Etiam porta sem malesuada magna mollis
    euismod. Nulla vitae elit libero, a pharetra augue. Nullam id dolor id nibh ultricies vehicula ut id elit. Donec
    ullamcorper nulla non metus auctor fringilla. Maecenas sed diam eget risus varius blandit sit amet non magna.
    </p>
    <p>Nullam quis risus eget urna mollis ornare vel eu leo. Donec id elit non mi porta gravida at eget metus. Donec
    sed odio dui. Donec sed odio dui. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Integer
    posuere erat a ante venenatis dapibus posuere velit aliquet. Donec ullamcorper nulla non metus auctor fringilla.
    Cras mattis consectetur purus sit amet fermentum. Curabitur blandit tempus porttitor. Lorem ipsum dolor sit
    amet, consectetur adipiscing elit.</p>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam id dolor id nibh ultricies vehicula ut id elit.
    Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit sit amet non
    magna.</p>
    <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cum sociis natoque
    penatibus et magnis dis parturient montes, nascetur ridiculus mus. Etiam porta sem malesuada magna mollis
    euismod. Nulla vitae elit libero, a pharetra augue. Nullam id dolor id nibh ultricies vehicula ut id elit. Donec
    ullamcorper nulla non metus auctor fringilla. Maecenas sed diam eget risus varius blandit sit amet non magna.
    </p>
    <p>Nullam quis risus eget urna mollis ornare vel eu leo. Donec id elit non mi porta gravida at eget metus. Donec
    sed odio dui. Donec sed odio dui. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Integer
    posuere erat a ante venenatis dapibus posuere velit aliquet. Donec ullamcorper nulla non metus auctor fringilla.
    Cras mattis consectetur purus sit amet fermentum. Curabitur blandit tempus porttitor. Lorem ipsum dolor sit
    amet, consectetur adipiscing elit.</p>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam id dolor id nibh ultricies vehicula ut id elit.
    Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit sit amet non
    magna.</p>
    <div id="privacy-notice">
    <strong>Privacy Notice</strong>
    <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.</p>
    <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cum sociis natoque
    penatibus et magnis dis parturient montes, nascetur ridiculus mus. Etiam porta sem malesuada magna mollis
    euismod. Nulla vitae elit libero, a pharetra augue. Nullam id dolor id nibh ultricies vehicula ut id elit.
    Donec ullamcorper nulla non metus auctor fringilla. Maecenas sed diam eget risus varius blandit sit amet non
    magna.</p>
    <p>Nullam quis risus eget urna mollis ornare vel eu leo. Donec id elit non mi porta gravida at eget metus. Donec
    sed odio dui. Donec sed odio dui. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.
    Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Donec ullamcorper nulla non metus auctor
    fringilla. Cras mattis consectetur purus sit amet fermentum. Curabitur blandit tempus porttitor. Lorem ipsum
    dolor sit amet, consectetur adipiscing elit.</p>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam id dolor id nibh ultricies vehicula ut id
    elit. Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit sit amet
    non magna.</p>
    <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cum sociis natoque
    penatibus et magnis dis parturient montes, nascetur ridiculus mus. Etiam porta sem malesuada magna mollis
    euismod. Nulla vitae elit libero, a pharetra augue. Nullam id dolor id nibh ultricies vehicula ut id elit.
    Donec ullamcorper nulla non metus auctor fringilla. Maecenas sed diam eget risus varius blandit sit amet non
    magna.</p>
    <p>Nullam quis risus eget urna mollis ornare vel eu leo. Donec id elit non mi porta gravida at eget metus. Donec
    sed odio dui. Donec sed odio dui. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.
    Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Donec ullamcorper nulla non metus auctor
    fringilla. Cras mattis consectetur purus sit amet fermentum. Curabitur blandit tempus porttitor. Lorem ipsum
    dolor sit amet, consectetur adipiscing elit.</p>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam id dolor id nibh ultricies vehicula ut id
    elit. Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit sit amet
    non magna.</p>
    <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cum sociis natoque
    penatibus et magnis dis parturient montes, nascetur ridiculus mus. Etiam porta sem malesuada magna mollis
    euismod. Nulla vitae elit libero, a pharetra augue. Nullam id dolor id nibh ultricies vehicula ut id elit.
    Donec ullamcorper nulla non metus auctor fringilla. Maecenas sed diam eget risus varius blandit sit amet non
    magna.</p>
    <p>Nullam quis risus eget urna mollis ornare vel eu leo. Donec id elit non mi porta gravida at eget metus. Donec
    sed odio dui. Donec sed odio dui. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.
    Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Donec ullamcorper nulla non metus auctor
    fringilla. Cras mattis consectetur purus sit amet fermentum. Curabitur blandit tempus porttitor. Lorem ipsum
    dolor sit amet, consectetur adipiscing elit.</p>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam id dolor id nibh ultricies vehicula ut id
    elit. Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit sit amet
    non magna.</p>


    </div>',
    'status' => 1,
    'deleted_at' => NULL,
    'created_at' => '2023-02-16 17:44:27',
    'updated_at' => '2023-02-16 17:44:27',
),
17 => 
array (
    'id' => 18,
    'title' => 'Know More',
    'section' => 'know_more',
    'device_type' => 'web',
    'content' => '

    <h1 class="mb-4 mt-2 text-header">Lorem Ipsum is simply dummy text of
    the printing</h1>
    <p class="mb-4 para-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
    has been the industrys standard dummy text ever since the 1500s, when an unknown printer
    took a galley of type and scrambled it to make a type specimen book. when an unknown printer
    took a galley of type and scrambled it to make a type specimen book.<br><br>

    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
    has been the industrys standard dummy text ever since the 1500s, when an unknown printer
    took a galley of type and scrambled it to make a type specimen book.</p>

    <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>
    <h5 class="text-primary-gradient fw-medium">Gena HealthX</h5>
    <h1 class="mb-4 mt-2 text-header">standard dummy text ever since the 1500s</h1>
    <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>

    <h2 class="second_heading">1</h2>
    <h3>Lorem Ipsum</h3>
    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
    has been the industrys standard dummy text ever since the 1500s, when an unknown printer
    took a galley of type and scrambled it to make a type specimen book.<br><br> when an unknown printer
    took a galley of type and scrambled it to make a type specimen book.</p>


    <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>

    <h2 class="second_heading">2</h2>
    <h3>Lorem Ipsum</h3>
    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
    has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer
    took a galley of type and scrambled it to make a type specimen book.<br><br> when an unknown printer
    took a galley of type and scrambled it to make a type specimen book.</p>

    <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>

    <h2 class="second_heading">3</h2>
    <h3>Lorem Ipsum</h3>
    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
    has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer
    took a galley of type and scrambled it to make a type specimen book.<br><br> when an unknown printer
    took a galley of type and scrambled it to make a type specimen book.</p>

    <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>

    <h2 class="second_heading">4</h2>
    <h3>Lorem Ipsum</h3>
    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
    has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer
    took a galley of type and scrambled it to make a type specimen book.<br><br> when an unknown printer
    took a galley of type and scrambled it to make a type specimen book.</p>

    <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>


    ',
    'status' => 1,
    'deleted_at' => NULL,
    'created_at' => '2023-02-16 17:44:27',
    'updated_at' => '2023-02-16 17:44:27',
),
18 => 
array (
    'id' => 19,
    'title' => 'Subscribe Now',
    'section' => 'subscribe_now',
    'device_type' => 'web',
    'content' => 'Join our community to know more about why precision health is the future. We will keep you updated with the emerging evidences on health, fitness and wellness, and send you actionable tips on how to achieve better he',
    'status' => 1,
    'deleted_at' => NULL,
    'created_at' => '2023-02-16 17:44:27',
    'updated_at' => '2023-02-16 17:44:27',
),
));


}
}