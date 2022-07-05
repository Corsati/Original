<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Course\Create;
use App\Models\Category;
use App\Models\User;
use App\Models\Course;
use App\Models\Comment;
use App\Notifications\SystemNotification;
use App\Repositories\Interfaces\ICategory;
use App\Repositories\Interfaces\ICourseBenefit;
use App\Repositories\Interfaces\ICourseCertificate;
use App\Repositories\Interfaces\ICourseContent;
use App\Repositories\Interfaces\ICourseLecture;
use App\Repositories\Interfaces\IUser;
use App\Repositories\Interfaces\ICourseRequirement;
use App\Repositories\Interfaces\ICourseLectureFile;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\ICourse;
use Notification;

class CourseController extends Controller
{

    protected  $courseRepo;
    protected  $categoryRepo;
    protected  $courseBenefit;
    protected  $active;
    protected  $pending;
    protected  $in_review;

    public function __construct( ICourse $course , IUser $user , ICategory $category , ICourseBenefit $courseBenefit
        , ICourseCertificate $courseCertificate , ICourseContent $courseContent
        , ICourseLecture $courseLecture , ICourseRequirement $ICourseRequirement, ICourseLectureFile $courseLectureFile )
    {
        $this->courseRepo         = $course;
        $this->userRepo           = $user;
        $this->categoryRepo       = $category;
        $this->courseBenefit      = $courseBenefit;
        $this->courseCertificate  = $courseCertificate;
        $this->courseContent      = $courseContent;
        $this->courseLecture      = $courseLecture;
        $this->ICourseRequirement = $ICourseRequirement;
        $this->courseLectureFile  = $courseLectureFile;
        $this->active             = $this->courseRepo->get();
        $this->pending            = $this->courseRepo->getCourses(Course::PENDING);
        $this->in_review          = $this->courseRepo->getCourses(Course::IN_REVIEW);
        app()->setLocale(session()->get('language') ??'ar');

    }

    /***************************  get all countries  **************************/
    public function index()
    {
        $objects                  = $this->courseRepo->get();
        $pending                  = $this->pending;
        $in_review                = $this->in_review;
        $active                   = $this->active;
        $categories               = $this->categoryRepo->get();
        return view('admin.courses.index', compact('objects','pending','in_review','active','categories'));
    }

    public function show($id){
        $objects                  = $this->courseRepo->getCoursesByCategory($id);
        $pending                  = $this->pending;
        $in_review                = $this->in_review;
        $active                   = $this->active;
        return view('admin.courses.index', compact('objects','pending','in_review','active'));
    }
    public function pending()
    {
        $objects                  = $this->courseRepo->getCourses(Course::PENDING);
        $pending                  = $this->pending;
        $in_review                = $this->in_review;
        $active                   = $this->active;
        return view('admin.courses.index', compact('objects','pending','in_review','active'));
    }

    public function inReview()
    {
        $objects                  = $this->courseRepo->getCourses(Course::IN_REVIEW);
        $pending                  = $this->pending;
        $in_review                = $this->in_review;
        $active                   = $this->active;
        return view('admin.courses.index', compact('objects','pending','in_review','active'));
    }

    public function active()
    {
        $objects                  = $this->courseRepo->getCourses(Course::ACTIVE);

        $pending                  = $this->pending;
        $in_review                = $this->in_review;
        $active                   = $this->active;
        return view('admin.courses.index', compact('objects','pending','in_review','active'));
    }

    public function add(){
        $instructors              = $this->userRepo->users(User::INSTRUCTOR);
        $categories               = $this->categoryRepo->get();
        return view('admin.courses.add',compact('categories','instructors'));
    }

    /***************************  store admin **************************/
    public function store(Create $request)
    {
         $data                    = $request->all();
         $this->courseRepo->store($data);
         return redirect()->back()->with('success', 'added successfully');
    }

    /***************************  show admin **************************/
    public function display($id)
    {
         $object                  = $this->courseRepo->findOrFail($id);
         $categories              = $this->categoryRepo->get();
         $instructors             = $this->userRepo->users(User::INSTRUCTOR);
         return view('admin.courses.details',compact('object', 'categories', 'instructors'));
    }

    public function changeStatus($id){
        $object                   = $this->courseRepo->findOrFail($id);

        if($object->status        == Course::PENDING) {
            $this->courseRepo->update($object, ['status' => Course::IN_REVIEW]);
        }elseif($object->status   == Course::IN_REVIEW) {
            $details = [
                'subject'         => __('web.course_accepted'),
                'greeting'        => __('web.Hi') . ' ' . $object->user->first_name,
                'body'            => __('web.course_accepted_msg',['name' => $object->title]),
                'thanks'          => __('web.thanksToUse'),
                'actionText'      => __('web.visitUs'),
                'actionURL'       => url('/'),
                'course_id'       => $object->id,
                'room_id'         => null,
                'type'            =>'course',
            ];

            Notification::send($object->user, new SystemNotification($details));
            $this->courseRepo->update($object, ['status' => Course::ACTIVE]);
        }else {
            $this->courseRepo->update($object, ['status' => Course::PENDING]);
        }
        return back();
    }

    public function courseBenefitDelete($id){
        $this->courseBenefit->findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Deleted successfully');
    }

    public function courseCertificateDelete($id){
        $this->courseCertificate->findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Deleted successfully');
    }

    public function courseContentDelete($id){
        $this->courseContent->findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Deleted successfully');
    }

    public function courseLectureDelete($id){
        $this->courseLecture->findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Deleted successfully');
    }
    public function courseRequirementDelete($id){
        $this->ICourseRequirement->findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Deleted successfully');
    }

    public function courseCommentDelete($id){
        Comment::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Deleted successfully');
    }
    public function courseLectureFileDelete($id){
        $this->courseLectureFile->findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Deleted successfully');
    }
    public function video($id){
        $objects                 = $this->courseLecture->find($id);
        return view('admin.courses.videos',compact('objects','id'));
    }

    public function addLectureFile(Request $request){
        $data                    = $request->all();
        $this->courseLectureFile->store($data);
        return redirect()->back()->with('success', 'Added successfully');
    }

    public function update(Request $request, $id)
    {
        $course   = $this->courseRepo->findOrFail($id);
        $this->courseRepo->update($course,array_filter($request->all()));
        return redirect()->back()->with('success', 'updated successfully');
    }
    public function update_req(Request $request, $id){
        $requirement   = $this->ICourseRequirement->findOrFail($id);
        $this->ICourseRequirement->update($requirement,array_filter($request->all()));
        return redirect()->back()->with('success', 'updated successfully');

    }

    public function update_lecture_files(Request $request, $id)
    {
        $file   = $this->courseLectureFile->findOrFail($id);
        $this->courseLectureFile->update($file,array_filter($request->all()));
        return redirect()->back()->with('success', 'updated successfully');
    }

    public function update_benefit(Request $request, $id)
    {
        $benefit   = $this->courseBenefit->findOrFail($id);
        $this->courseBenefit->update($benefit,array_filter($request->all()));
        return redirect()->back()->with('success', 'updated successfully');
    }

    /***************************  delete admin  **************************/
    public function destroy($id)
    {
        $role = $this->courseRepo->findOrFail($id);
        $this->courseRepo->softDelete($role);
        return redirect()->back()->with('success', 'Deleted successfully');
    }



    /***************************** Update lectures ***********************/
    public function update_lec(Request $request, $id){
        $lecture   = $this->courseLecture->findOrFail($id);
        $this->courseLecture->update($lecture,array_filter($request->all()));
        return redirect()->back()->with('success', 'updated successfully');
    }
    public function update_content(Request $request, $id){
        $content  = $this->courseContent->findOrFail($id);
        $this->courseContent->update($content,array_filter($request->all()));
        return redirect()->back()->with('success', 'updated successfully');
    }
    public function update_certificate(Request $request, $id){
        $certificate  = $this->courseCertificate->findOrFail($id);
        $this->courseCertificate->update($certificate,array_filter($request->all()));
        return redirect()->back()->with('success', 'updated successfully');
    }


}
