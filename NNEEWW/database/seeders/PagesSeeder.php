<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('pages')->truncate();
        \DB::table('pages')->insert([
            [
                'title' => 'Home',
                'section' => 'home_page',
                'device_type' => 'web',
                'content' => '<h1 class="text-white heading_align mb-4 animated slideInDown">Lorem Ipsum is simply dummy text of the printing and typesetting.</h1>

                <p class="text-white animated slideInDown">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy</p>

                <div><!-- Button trigger modal --><a class="btn btn-primary-gradient py-sm-3 px-4 mt-3 px-sm-5 rounded-pill me-3 animated slideInLeft" data-bs-target="#exampleModal" data-bs-toggle="modal" href="#">Contact Us</a> <!-- Modal --> <a class="btn py-sm-3 px-4 px-sm-5 rounded-pill mt-3 know-btn animated slideInLeft" href="https://server3.rvtechnologies.in/Gena-HealthX/web/public/know-more">Know More</a></div>

                <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>
                <a href="#" target="_blank" class="market-btn apple-btn" role="button">
                <span class="market-button-title">App Store</span>
                </a>


                <a href="#" target="_blank" class="market-btn google-btn" role="button">
                <span class="market-button-title">Google Play</span>
                </a>

                <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>

                <h5 class="text-primary-gradient fw-medium">Why Gena HealthX?</h5>

                <h1 class="mb-4 mt-2 text-header">An integrated personalized health ecosystem</h1>
                <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>
                <h3>Genetic Tests</h3>
                <p>Genetic testing is a type of medical test that identifies changes in genes, chromosomes, or
                proteins.
                The results of a genetic test can confirm or rule out a suspected genetic condition or help
                determine a person’s chance of developing or
                passing on a genetic disorder.<br><br>
                Genetic testing involves looking for changes in:
                </p>
                <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>
                <h5 class="mt-2">Genes</h5>
                <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>
                <h5 class="mt-2">Chromosomes</h5>
                <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>
                <h5 class="mt-2">Proteins</h5>
                <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>
                <a href="https://server3.rvtechnologies.in/Gena-HealthX/web/public/services#section1"
                class="btn btn-primary-gradient py-sm-3 px-4 px-sm-5 rounded-pill me-3 animated slideInLeft">Explore
                DNA tests</a>

                <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>
                <h3>Biochemical Testing</h3>
                <p>
                We look at 60+ blood markers to assess your heart health, sugar response, and kidney health,
                inflammation and many more to optimise your
                overall health and prevent disease.<br><br>This lab should help give you the background
                information and techniques you will need to
                successfully perform general biochemical tests in order to help identify unknown bacterial
                samples.
                </p>
                <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>
                <p>
                Patient Safety is a health care discipline that emerged with the evolving complexity in health
                care systems and the resulting rise of patient
                harm in health care facilities. It aims to prevent and reduce risks, errors and harm that occur
                to patients during provision of health care.
                A cornerstone of the discipline is continuous improvement based on learning from errors and
                adverse events.<br><br>Patient safety is
                fundamental to delivering quality essential health services.
                </p>
                <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>
                <h3>Our App</h3>
                <p>
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                the industrys standard dummy text ever
                since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type
                specimen book.<br><br>It has survived
                not only five centuries, but also the leap into electronic typesetting, remaining essentially
                unchanged.
                </p>
                <a href="https://server3.rvtechnologies.in/Gena-HealthX/web/public/app-download"
                class="btn btn-primary-gradient py-sm-3 px-4 px-sm-5 rounded-pill me-3 animated slideInLeft">Explore
                the App</a>
                <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>
                <h5 class="text-primary-gradient fw-medium">How can Gena HealthX help me?</h5>
                <h1 class="mb-4 mt-2 text-header">Lorem Ipsum</h1>
                ',
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            ],


            [
                'title' => 'About Us',
                'section' => 'about_us_page',
                'device_type' => 'web',
                'content' => ' <h1 class="text-dark mt-5 mb-4 animated slideInDown">We are Gena HealthX</h1>
                <p class="text-dark main-text animated slideInDown">we are a healthcare company that help people get health, live<br> healthier and happier</p>
                <a href="https://server3.rvtechnologies.in/Gena-HealthX/web/public/services" class="btn btn-primary-gradient mt-3 py-sm-3 px-4 px-sm-5 rounded-pill me-3 animated slideInLeft">Select a plan</a>
                <a href="#" class="btn know-btn py-sm-3 px-4 mt-3 px-sm-5 rounded-pill me-3 animated slideInLeft" data-bs-toggle="modal" data-bs-target="#exampleModal">Contact Us</a>
                <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>

                <h2 class="content_heading">Gena HealthX uses the latest in proven behavioral science to empower<br> people to take
                control of their health for good.</h2>
                <p>Through a combination of psychology, technology, and human coaching, our platform has helped
                millions of our users meet their personal health and wellness goals.<br>
                While we started with weight management, now were working to expand our behavior change
                platform to help people with chronic and non-chronic conditions,<br> such as stress and anxiety,
                hypertension, and diabetes, and build a healthier world for all.
                </p>

                <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>
                <h2>Our technology</h2>
                <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>
                <h2>How does Gena Healthx work?</h2>
                <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>


                ',
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            ],

            [
                'title' => 'Our Services',
                'section' => 'our_services_page',
                'device_type' => 'web',
                'content' => '
                <h5 class="text-primary-gradient fw-medium">Select a Diet Plan</h5>
                <h1 class="mb-2 mt-2 text-header">Let\'s change your life!</h1>
                <p class="para-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem fugit quaerat similique accusantium nesciunt repellendus necessitatibus aperiam laboriosam, 
                voluptates quasi inventore accusamus excepturi provident sed laborum architecto vero voluptatibus ipsam!
                </p>
                <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>

                <h5 class="text-primary-gradient fw-medium">Select a Genetic Tests</h5>
                <h1 class="mb-4 mt-2 text-header">Lorem Ipsum!</h1>
                <p class="para-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem fugit quaerat similique accusantium nesciunt repellendus necessitatibus aperiam laboriosam, 
                voluptates quasi inventore accusamus excepturi provident sed laborum architecto vero voluptatibus ipsam!
                </p>
                <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>

                <h5 class="text-primary-gradient fw-medium">Select a Specialzed Diet Plan</h5>
                <h1 class="mb-2 mt-2 text-header">Lorem ipsum</h1>
                <p class="para-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem fugit quaerat similique accusantium nesciunt repellendus necessitatibus aperiam laboriosam, 
                voluptates quasi inventore accusamus excepturi provident sed laborum architecto vero voluptatibus ipsam!
                </p>
                <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>


                <h5 class="text-primary-gradient fw-medium">Consultations / Partner labs </h5>
                <h1 class="mb-4 mt-2 text-header">Book a consultation session!</h1>
                <p class="para-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem fugit quaerat similique accusantium nesciunt repellendus necessitatibus aperiam laboriosam, 
                voluptates quasi inventore accusamus excepturi provident sed laborum architecto vero voluptatibus ipsam!
                </p>



                <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>
                <p> Every day from 12:00 PM to 10:00 PM</p>
                <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>
                <p>+91 9100347489 </p>
                <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>
                <h5 class="text-primary-gradient fw-medium">Our Testimonial</h5>
                <h1 class="mb-4 mt-2 text-header">What Say Our Clients!</h1>                  
                ',
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            ],


            [
                'title' => 'Our App',
                'section' => 'our_app_page',
                'device_type' => 'web',
                'content' => '
                <h5 class="text-primary-gradient fw-medium">Download App</h5>
                <h1 class="mb-4 mt-2 text-header">Lorem Ipsum is simply dummy text of
                the printing</h1>
                <p class="mb-4 para-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                has been the industrys standard dummy text ever since the 1500s, when an unknown printer
                took a galley of type and scrambled it to make a type specimen book. when an unknown printer
                took a galley of type and scrambled it to make a type specimen book.<br><br>

                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                has been the industrys standard dummy text ever since the 1500s, when an unknown printer
                took a galley of type and scrambled it to make a type specimen book.</p>
                <div class="row g-4">
                <div class="col-sm-6 wow fadeIn" data-wow-delay="0.5s">
                <a href="#" class="d-flex bg-primary-gradient download-anchor">
                <i class="fab fa-apple fa-3x text-white flex-shrink-0"></i>
                <div class="ms-3">
                <p class="text-white mb-0">Available On</p>
                <h5 class="text-white download-btn mb-0">App Store</h5>
                </div>
                </a>
                </div>
                <div class="col-sm-6 wow fadeIn" data-wow-delay="0.7s">
                <a href="#" class="d-flex bg-secondary-gradient download-anchor">
                <i class="fab fa-android fa-3x text-white flex-shrink-0"></i>
                <div class="ms-3">
                <p class="text-white mb-0">Available On</p>
                <h5 class="text-white download-btn mb-0">Play Store</h5>
                </div>
                </a>
                </div>
                </div>
                <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>
                <h5 class="text-primary-gradient fw-medium">Gena HealthX</h5>
                <h1 class="mb-4 mt-2 text-header">Download the app so you can</h1>
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
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            ],


            


            [
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
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            ],

            [
                'title' => 'Our Team',
                'section' => 'our_teams_page',
                'device_type' => 'web',
                'content' => ' 
                <h5 class="text-primary-gradient fw-medium">Our Team</h5>
                <h1 class="mb-4 mt-2 text-header">Lorem Ipsum</h1>
                ',
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            ],


            [
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
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            ],
            [
                'title' => 'Science',
                'section' => 'science',
                'device_type' => 'web',
                'content' => ' <h5 class="text-primary-gradient fw-medium">Science</h5>
                <h1 class="mb-4 mt-2 text-header">The Science of connection</h1>
                <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>',
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            ],
            [
                'title' => 'Clinicians',
                'section' => 'clinicians',
                'device_type' => 'web',
                'content' => '<h2>We help you integrate genetic testing into clinical care</h2>
                <p>Submit your details and one of our expert will get in touch with you</p>
                <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>
                ',
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            ],

            [
                'title' => 'Partner labs',
                'section' => 'partner_labs',
                'device_type' => 'web',
                'content' => '            
                <h1 class="mb-2 mt-2 text-header">Choose our partner labs for reliable clinical tests</h1>
                <p class="para-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem fugit quaerat similique accusantium nesciunt repellendus necessitatibus aperiam laboriosam, 
                voluptates quasi inventore accusamus excepturi provident sed laborum architecto vero voluptatibus ipsam!
                </p>
                <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>',
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            ],

            [
                'title' => 'Careers',
                'section' => 'careers',
                'device_type' => 'web',
                'content' => '  <h5 class="text-primary-gradient fw-medium">Careers</h5>
                <h1 class="mb-4 mt-2 text-header">Lorem Ipsum</h1>
                
                <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>

                <p class="category">We are <br><span>Hiring</span> <br>for all positions!</p>

                <p><a class="CTA" href="#">Apply at careers@genahealthx.com</a></p>
                <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>
                
                <h4>Work at Gena HealthX</h4>

                <p>Interested in working with us? Check out the openings and see if you\'ve go what it takes to become a part of a fun loving, hard working team!</p>
                <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>
                VIEW OPENINGS
                <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>
                
                <h5 class="text-primary-gradient fw-medium">Our Values</h5>

                <h1>Lorem Ipsum</h1>


                <!-- <h5 class="text-primary-gradient fw-medium">Our Values</h5>
                <h1 class="mb-4 mt-2 text-header">Lorem Ipsum</h1> -->

                </div>
                <div class="row g-4">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
                <div class="values-item text-center p-4">
                <!-- <div class="d-inline-flex align-items-center justify-content-center bg-primary-gradient rounded-circle mb-3" style="width: 60px; height: 60px;">
                <img src="https://server3.rvtechnologies.in/Gena-HealthX/web/public/front/img/Mission.svg" class="mission_icons">
                </div> -->
                <h5 class="mb-0 service-heading">Mission First</h5>
                </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
                <div class="values-item text-center p-4">
                <!-- <div class="d-inline-flex align-items-center justify-content-center bg-primary-gradient rounded-circle mb-3" style="width: 60px; height: 60px;">
                <img src="https://server3.rvtechnologies.in/Gena-HealthX/web/public/front/img/owner.svg" class="owner_icons">
                </div> -->
                <h5 class="mb-0 service-heading">Act Like An Owner</h5>
                </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
                <div class="values-item text-center p-4">
                <!-- <div class="d-inline-flex align-items-center justify-content-center bg-primary-gradient rounded-circle mb-3" style="width: 60px; height: 60px;">
                <img src="https://server3.rvtechnologies.in/Gena-HealthX/web/public/front/img/impossible.svg" class="impossible_icons">
                </div> -->
                <h5 class="mb-0 service-heading">DO The Impossible</h5>
                </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
                <div class="values-item text-center p-4">
                <!-- <div class="d-inline-flex align-items-center justify-content-center bg-primary-gradient rounded-circle mb-3" style="width: 60px; height: 60px;">
                <img src="https://server3.rvtechnologies.in/Gena-HealthX/web/public/front/img/focus.svg" class="focus_icons">
                </div> -->
                <h5 class="mb-0 service-heading">Customer Focused</h5>
                </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
                <div class="values-item text-center p-4">
                <!-- <div class="d-inline-flex align-items-center justify-content-center bg-primary-gradient rounded-circle mb-3" style="width: 60px; height: 60px;">
                <img src="https://server3.rvtechnologies.in/Gena-HealthX/web/public/front/img/right.svg" class="right_icons">
                </div> -->
                <h5 class="mb-0 service-heading">Do The Right Thing</h5>
                </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
                <div class="values-item text-center p-4">
                <!-- <div class="d-inline-flex align-items-center justify-content-center bg-primary-gradient rounded-circle mb-3" style="width: 60px; height: 60px;">
                <img src="https://server3.rvtechnologies.in/Gena-HealthX/web/public/front/img/standard.svg" class="standard_icons">
                </div> -->
                <h5 class="mb-0 service-heading">High Standards</h5>
                </div>
                </div>
                </div>
                <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>

                <h5 class="text-primary-gradient fw-medium">Our Perks</h5>
                <h1 class="mb-0 mt-2 text-header">Lorem Ipsum</h1>

                
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
                <h4 class="mb-0 mt-2 text-header"><b>Send your resume at</b> contact@genahealthx.com</h4>
                

                ',
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            ],
            [
                'title' => 'Privacy Policy',
                'section' => 'privacy_policy',
                'device_type' => 'web',
                'content' => " 
                <strong>Privacy Policy</strong>
                <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
                when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap 
                into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum 
                passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

                <strong>Information Collection and Use</strong>
                <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
                when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap 
                into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum 
                passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

                <strong>Log Data</strong>
                <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
                when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap 
                into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum 
                passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

                <strong>Cookies</strong>
                <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
                when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap 
                into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum 
                passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                
                <strong>Service Providers</strong>
                <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
                when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap 
                into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum 
                passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

                <strong>Security</strong>
                <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
                when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap 
                into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum 
                passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

                <strong>Links to Other Sites</strong>
                <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
                when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap 
                into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum 
                passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

                <strong>Children’s Privacy</strong>
                <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
                when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap 
                into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum 
                passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

                <strong>Changes to This Privacy Policy</strong>
                <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
                when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap 
                into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum 
                passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

                <strong>Contact Us</strong>
                <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
                when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap 
                into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum 
                passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

                ",
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            ],
            [
               'title' => 'Terms & Conditions',
               'section' => 'terms_and_conditions',
               'device_type' => 'web',
               'content' =>' 
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


               </div>'
               ,
               "created_at" => \Carbon\Carbon::now(),
               "updated_at" => \Carbon\Carbon::now(),
           ],
           [
            'title' => 'FAQ',
            'section' => 'faq',
            'device_type' => 'web',
            'content' => "",
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
        ],



        [
            'title' => 'Footer',
            'section' => 'footer',
            'device_type' => 'web',
            'content' => ' <p class="para-text mt-3">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum 
            has been the industrys standard dummy text ever since the 1500s, when an unknown printer. </p>
            <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>

            <p class="mb-0">123 Street, New York,USA<br>
            gena@gmail.com<br>
            +012 345 67890<br></p>
            <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>
            <p class="mb-0">123 Street, New York,USA<br>
            gena@gmail.com<br>
            +012 345 67890<br></p>
            <div class="countent_from_admin_separator" style="display:none">&nbsp;</div>
            <div class="row">
            <div class="col-sm-12 footer-bottom text-center p-4">
            <p class="m-0">Copyright © 2021 all rights reserved GenaHealthX</p>
            </div>
            </div>


            ',
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
        ],

        [
            'title' => 'Privacy Policy',
            'section' => 'privacy_policy',
            'device_type' => 'mobile',
            'content' => " 
            <strong>Privacy Policy</strong>
            <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
            when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap 
            into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum 
            passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

            <strong>Information Collection and Use</strong>
            <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
            when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap 
            into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum 
            passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

            <strong>Log Data</strong>
            <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
            when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap 
            into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum 
            passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

            <strong>Cookies</strong>
            <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
            when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap 
            into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum 
            passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
            
            <strong>Service Providers</strong>
            <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
            when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap 
            into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum 
            passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

            <strong>Security</strong>
            <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
            when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap 
            into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum 
            passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

            <strong>Links to Other Sites</strong>
            <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
            when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap 
            into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum 
            passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

            <strong>Children’s Privacy</strong>
            <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
            when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap 
            into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum 
            passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

            <strong>Changes to This Privacy Policy</strong>
            <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
            when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap 
            into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum 
            passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

            <strong>Contact Us</strong>
            <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
            when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap 
            into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum 
            passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

            ",
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
        ],
        [
           'title' => 'Terms & Conditions',
           'section' => 'terms_and_conditions',
           'device_type' => 'mobile',
           'content' =>' 
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


           </div>'
           ,
           "created_at" => \Carbon\Carbon::now(),
           "updated_at" => \Carbon\Carbon::now(),
       ],


       [
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
        "created_at" => \Carbon\Carbon::now(),
        "updated_at" => \Carbon\Carbon::now(),
    ],




]);
}
}
