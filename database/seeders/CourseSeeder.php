<?php

namespace Database\Seeders;

use App\Models\AcademicLevel;
use App\Models\Category;
use App\Models\Course;
use App\Models\CourseBenefit;
use App\Models\CourseCategory;
use App\Models\CourseCertificate;
use App\Models\CourseContent;
use App\Models\CourseLecture;
use App\Models\CourseLectureFile;
use App\Models\CourseRequirement;
use App\Models\Duration;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            $faker                = Faker::create('ar_SA');
            $titlesArr            = ['The Ultimate Drawing Course - Beginner to Advanced','The Art & Science of Drawing / BASIC SKILLS' , 'React - The Complete Guide (incl Hooks, React Router, Redux)',
                'The Complete Digital Marketing Course - 12 Courses' , 'Microsoft Power BI Desktop for Business Intelligence','Laravel 6 PHP Framework for Just Beginners' , 'Project with laravel: pizza ordering web application' ,
                'Laravel 6 Starter Course' , 'The Web Developer Bootcamp 2021','The Complete Web Developer Course 2.0','The Advanced Web Developer Bootcamp' ,
                'Microsoft Excel - Excel from Beginner to Advanced' , 'Microsoft Excel - Data Analysis with Excel Pivot Tables' , 'Excel Essentials: The Complete Excel Series - Level 1, 2 & 3','
                2021 Complete Python Bootcamp From Zero to Hero in Python' , ' API and Web Service Introduction ' ,
                ' APIs with Postman for Absolute Beginners ',' Learn JMETER from Scratch on Live Apps -Performance Testing ',' Postman: The Complete Guide - REST API Testing ',' Top 150+ QA Automation Interview Questions & Resume Tips '];

            $descriptionsArr      = [' Job oriented Interview preparation course on Selenium, API testing, Testng, SQL, cucumber & Java programs with solutions ' ,' Automation Architect - Selenium WebDriver with 7 Live Projects (Learn Indepth Framework implementation on Live Projects) ',' Learn Industry Standard Automation Framework with Top Coding Design Patterns & Seamless Integration to Latest tech tools ',' Advanced Tutorial to Learn essential skills needed to transform your career from QA Engineer to SDET/Test Architect ',' Automation Architect - Selenium WebDriver with 7 Live Projects (Learn Indepth Framework implementation on Live Projects) '];
            $dummy                = ['1.jpeg','2.jpeg','3.jpeg','4.jpeg','5.jpeg','6.jpeg','7.jpeg','8.jpeg','9.jpeg','10.jpeg','11.jpeg','12.jpeg','13.jpeg','14.jpeg','15.jpeg','16.jpg','17.jpg','18.jpg','19.jpg','20.jpg'];
            $benefits             = ['Clear concept of Behavior-driven development','Continuous Integration and testing','Design of Modular-Driver Framework','Integration with java and selenium wbedriver','Design of Data-Driver Framework','Write test case using gherkin language'];
            $lectures             = ['Introduction','Enviroment Setup','Behavior-driven development','Cucumber Hooks','Dependency Injection','Data Table','Scenario Outline','Locating Techniques','Relative Xpath using Axes View','Selenium Webdriver Setup','Selenium Webdriver Architecture','Selenium Webdriver Browser Function','WebElement Interface','Handling Web UI Components','Custom Browser Configuration','Synchronization and Waits','Working with IFrames','Testng Framework','Apache Maven','Screenshot','Sharing Test Data'];
            $lecturesFiles        = ['Introduction','Course Content','Setting up Jdk','Setting up Eclipse','Setting up Maven','Setting up Testng',' Cucumber Plugin','Adding Dependencies','Generating the Step Dfn','Passing the Parameter
','Data Table'];

            $contents             = ['18 hours on-demand video','1 article','7 downloadable resources','Full lifetime access','Access on mobile and TV','Certificate of completion'];
            DB::transaction(function () use ($faker,$titlesArr,$descriptionsArr,$dummy,$benefits,$lectures,$lecturesFiles,$contents) {
                $x = 0;
                $y = 0;
                for ($i    =   1;  $i < 20; $i++) {
                    $course = Course::create([
                        'title'                => $titlesArr[array_rand($titlesArr)] ,
                        'image'                => url('dummy/'. $dummy[$i]),
                        'promotional_video_id' => 'uCVc-7z-toE',
                        'description'          => $descriptionsArr[array_rand($descriptionsArr)] ,
                        'price'                => rand(111,999),
                        'discount'             => rand(11,55),
                        'language'             => 'en',
                        'status'               => 'active',
                        'level'                => AcademicLevel::inRandomOrder()->first()->id,
                        'total_hours'          => Duration::inRandomOrder()->first()->id,
                        'steps'                => 'three',
                        'user_id'              => User::where('user_type', 3)->inRandomOrder()->first()->id,
                        'category_id'          => Category::inRandomOrder()->first()->id
                    ]);


                    for ($x ; $x < 5; $x++) {
                        CourseRequirement::create([
                            'name'                => $benefits[array_rand($benefits)] ,
                            'course_id'           => $course->id
                        ]);

                        CourseCategory::create([
                            'category_id'          => Category::inRandomOrder()->first()->id,
                            'course_id'            => $course->id
                        ]);

                        for ($y ; $y < 5; $y++) {
                            $lecture = CourseLecture::create([
                                'name'             => $lectures[array_rand($lectures)] ,
                                'course_id'        => $course->id
                            ]);

                            CourseLectureFile::create([
                                'name'              => $course->language == 'ar' ? ['en' => "", 'ar' => $lecturesFiles[array_rand($lecturesFiles)] ] : ['ar' => "", 'en' => $lecturesFiles[array_rand($lecturesFiles)] ],
                                'file'              => 'https://www.youtube.com/watch?v=GO0yGHgrglg&t=1s',
                                'content_file_type' => 'video',
                                'video_id'          => 'uCVc-7z-toE',
                                'video_time'        => '5:37:59',
                                'course_lecture_id' => $lecture->id
                            ]);
                            CourseLectureFile::create([
                                'name'              => $course->language == 'ar' ? ['en' => "", 'ar' => $lecturesFiles[array_rand($lecturesFiles)] ] : ['ar' => "", 'en' => $lecturesFiles[array_rand($lecturesFiles)] ],
                                'file'              => 'https://www.youtube.com/watch?v=GO0yGHgrglg&t=1s',
                                'content_file_type' => 'video',
                                'video_id'          => 'uCVc-7z-toE',
                                'video_time'        => '5:37:59',
                                'course_lecture_id' => $lecture->id
                            ]);

                        }


                        CourseBenefit::create([
                            'name'                  => $benefits[array_rand($benefits)] ,
                            'course_id'             => $course->id
                        ]);

                        CourseContent::create([
                            'name'                  => $contents[array_rand($contents)] ,
                            'course_id'             => $course->id
                        ]);

                    }

                    CourseCertificate::create(
                        [
                            'title'      => $course->language == 'ar' ? ['en' => " ", 'ar' => $faker->word] : ['ar' => " ", 'en' => $faker->word],
                            'details'    => $course->language == 'ar' ? ['en' => " ", 'ar' => $faker->word] : ['ar' => " ", 'en' => $faker->word],
                            'course_id'  => $course->id,
                            'file'       => 'default.pdf',
                            'file_type'  => 'pdf'
                        ]
                    );
                    $x = 0;
                    $y = 0;
                }
            });
    }
}
