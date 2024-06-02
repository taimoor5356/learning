<?php

namespace App\Http\Controllers;

use App\Models\ClassSubject;
use App\Models\ClassTeacher;
use App\Models\Examination;
use App\Models\ExamSchedule;
use App\Models\SchoolClass;
use App\Models\SubjectMark;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PharIo\Manifest\Author;

class ExaminationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data['header_title'] = 'Exams List';
        $data['records'] = Examination::getExams()->paginate(25);
        return view('admin.examination.exams.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $data['header_title'] = 'Create Exams';
        return view('admin.examination.exams.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $exam = new Examination();
        $exam->name = $request->name;
        $exam->note = $request->note;
        $exam->created_by = Auth::user()->id;
        $exam->save(); //remove all save
        return redirect('admin/examinations/exams-list')->with('success', 'Exam successfully registered');
    }

    /**
     * Display the specified resource.
     */
    public function show(Examination $examination)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $data['header_title'] = 'Edit Exams';
        $data['record'] = Examination::getSingleExam($id);
        if (isset($data['record'])) {
            return view('admin.examination.exams.edit', $data);
        } else {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $exam = Examination::getSingleExam($id);
        if (isset($exam)) {
            $exam->name = $request->name;
            $exam->note = $request->note;
            $exam->save(); //remove all save
            return redirect('admin/examinations/exams-list')->with('success', 'Exam successfully updated');
        } else {
            abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $exam = Examination::getSingleExam($id);
        if (isset($exam)) {
            $exam->delete();
            return redirect('admin/examinations/exams-list')->with('success', 'Exam successfully deleted');
        } else {
            abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function trashed()
    {
        //
        $data['header_title'] = 'Exams List';
        $data['records'] = Examination::getTrashedExams()->paginate(25);
        return view('admin.examination.exams.trashed', $data);
    }

    public function examSchedule(Request $request)
    {
        $data['header_title'] = 'Exams Schedule';
        $data['classes'] = SchoolClass::getClasses()->get();
        $data['exams'] = Examination::getExams()->get();
        $result = [];
        if (!empty($request->get('exam_id')) && !empty($request->get('class_id'))) {
            $getSubjects = ClassSubject::getSingleClassSubjects($request->get('class_id'))->get();
            foreach ($getSubjects as $subject) {
                $subjectData = [];
                $subjectData['subject_id'] = $subject->subject_id;
                $subjectData['class_id'] = $subject->class_id;
                $subjectData['subject_name'] = $subject->subject?->name;
                $subjectData['subject_type'] = $subject->subject?->type;
                $examSchedule = ExamSchedule::getSingleExamClassSubjectSchedule($request->get('exam_id'), $request->get('class_id'), $subject->subject_id)->first();
                if (isset($examSchedule)) {
                    $subjectData['exam_date'] = $examSchedule->exam_date;
                    $subjectData['start_time'] = $examSchedule->start_time;
                    $subjectData['end_time'] = $examSchedule->end_time;
                    $subjectData['room_number'] = $examSchedule->room_number;
                    $subjectData['full_marks'] = $examSchedule->full_marks;
                    $subjectData['passing_marks'] = $examSchedule->passing_marks;
                } else {
                    $subjectData['exam_date'] = '';
                    $subjectData['start_time'] = '';
                    $subjectData['end_time'] = '';
                    $subjectData['room_number'] = '';
                    $subjectData['full_marks'] = '';
                    $subjectData['passing_marks'] = '';
                }
                $result[] = $subjectData;
            }
        }
        $data['records'] = $result;
        return view('admin.examination.exams.scheduled', $data);
    }

    public function storeExamSchedule(Request $request)
    {
        if (!empty($request->schedule)) {
            $examSchedule = ExamSchedule::getSingleExamClassSchedule($request->get('exam_id'), $request->get('class_id'));
            if (isset($examSchedule)) {
                $examSchedule->delete();
            }
            foreach ($request->schedule as $schedule) {
                if ((!empty($schedule['subject_id'])) && (!empty($schedule['exam_date'])) && (!empty($schedule['start_time'])) && (!empty($schedule['end_time'])) && (!empty($schedule['room_number'])) && (!empty($schedule['full_marks'])) && (!empty($schedule['passing_marks']))) {
                    $examSchedule = new ExamSchedule();
                    $examSchedule->exam_id = $request->get('exam_id');
                    $examSchedule->batch_id = $request->get('class_id');
                    $examSchedule->class_id = $request->get('class_id');
                    $examSchedule->subject_id = $schedule['subject_id'];
                    $examSchedule->exam_date = $schedule['exam_date'];
                    $examSchedule->start_time = $schedule['start_time'];
                    $examSchedule->end_time = $schedule['end_time'];
                    $examSchedule->room_number = $schedule['room_number'];
                    $examSchedule->full_marks = $schedule['full_marks'];
                    $examSchedule->passing_marks = $schedule['passing_marks'];
                    $examSchedule->created_by = Auth::user()->id;
                    $examSchedule->save(); //remove all save
                }
            }
            return redirect()->back()->with('success', 'Exam schedule successfully saved');
        } else {
            return redirect('admin/examinations/scheduled-exams')->with('error', 'Something went wrong');
        }
    }

    public function studentExamSchedule(Request $request)
    {
        $data['header_title'] = 'My Exams Schedule';
        $classId = Auth::user()->class_id;
        $getExamSchedule = ExamSchedule::getSingleClassSchedule($classId)->get();
        $result = [];
        foreach ($getExamSchedule as $examSchedule) {
            $examData = [];
            $examData['exam_name'] = $examSchedule->exam?->name;
            $classExamSchedule = ExamSchedule::getSingleExamClassSchedule($examSchedule->exam?->id, $classId)->get();
            $subjectResult = [];
            foreach ($classExamSchedule as $key => $classExamScheduleSubject) {
                $subjectData = [];
                $subjectData['subject_id'] = $classExamScheduleSubject->subject_id;
                $subjectData['class_id'] = $classExamScheduleSubject->class_id;
                $subjectData['subject_name'] = $classExamScheduleSubject->subject?->name;
                $subjectData['subject_type'] = $classExamScheduleSubject->subject?->type;
                $subjectData['exam_date'] = $classExamScheduleSubject->exam_date;
                $subjectData['start_time'] = Carbon::parse($classExamScheduleSubject->start_time)->format('h:i a');
                $subjectData['end_time'] = Carbon::parse($classExamScheduleSubject->end_time)->format('h:i a');
                $subjectData['room_number'] = $classExamScheduleSubject->room_number;
                $subjectData['full_marks'] = $classExamScheduleSubject->full_marks;
                $subjectData['passing_marks'] = $classExamScheduleSubject->passing_marks;
                $subjectResult[] = $subjectData;
            }
            $examData['exam'] = $subjectResult;
            $result[] = $examData;
        }
        $data['records'] = $result;
        return view('student.examination.exams.scheduled', $data);
    }

    public function teacherExamSchedule(Request $request)
    {
        $data['header_title'] = 'My Exams Schedule';
        $getClasses = ClassTeacher::myClassTeacherSubjectsGroup(Auth::user()->id)->get();
        $result = [];
        foreach ($getClasses as $key => $class) {
            $classData = [];
            $classData['class_name'] = $class->class?->name;
            $getExams = ExamSchedule::getSingleClassSchedule($class->class_id)->get();
            $examArray = [];
            foreach ($getExams as $exam) {
                $examData = [];
                $examData['exam_name'] = $exam->exam?->name;
                $getExamScheduleData = ExamSchedule::getSingleExamClassSchedule($exam->exam?->id, $class->class_id)->get();
                $subjectResult = [];
                foreach ($getExamScheduleData as $key => $classExamScheduleSubject) {
                    $subjectData = [];
                    $subjectData['subject_id'] = $classExamScheduleSubject->subject_id;
                    $subjectData['class_id'] = $classExamScheduleSubject->class_id;
                    $subjectData['subject_name'] = $classExamScheduleSubject->subject?->name;
                    $subjectData['subject_type'] = $classExamScheduleSubject->subject?->type;
                    $subjectData['exam_date'] = $classExamScheduleSubject->exam_date;
                    $subjectData['start_time'] = Carbon::parse($classExamScheduleSubject->start_time)->format('h:i a');
                    $subjectData['end_time'] = Carbon::parse($classExamScheduleSubject->end_time)->format('h:i a');
                    $subjectData['room_number'] = $classExamScheduleSubject->room_number;
                    $subjectData['full_marks'] = $classExamScheduleSubject->full_marks;
                    $subjectData['passing_marks'] = $classExamScheduleSubject->passing_marks;
                    $subjectResult[] = $subjectData;
                }
                $examData['subjects'] = $subjectResult;
                $examArray[] = $examData;
            }
            $classData['exam'] = $examArray;
            $result[] = $classData;
        }
        $data['records'] = $result;
        return view('teacher.examination.exams.scheduled', $data);
    }

    // Admin Side
    public function SubjectMarks(Request $request)
    {
        $data['classes'] = SchoolClass::getClasses()->get();
        $data['exams'] = Examination::getExams()->get();
        if (!empty($request->get('exam_id')) && !empty($request->get('class_id'))) {
            $data['subjects'] = ExamSchedule::getSingleExamClassSchedule($request->get('exam_id'), $request->get('class_id'))->get();
            $data['students'] = User::getStudentClass($request->get('class_id'))->get();
        }
        $data['header_title'] = 'Subject Results/Marks';
        return view('admin.examination.subject_marks', $data);
    }

    public function storeSubjectMarks(Request $request)
    {
        try {
            $validation = 0;
            if (!empty($request->marks)) {
                foreach ($request->marks as $mark) {
                    $getExamSchedule = ExamSchedule::getSingleSchedule($mark['id'])->first();
                    $fullMarks = 0;
                    $getExamSchedule = ExamSchedule::getSingleSchedule($mark['id'])->first();
                    if (isset($getExamSchedule)) {
                        $fullMarks = $getExamSchedule->full_marks;
                    }
                    $classWork = !empty($mark['class_work']) ? $mark['class_work'] : 0;
                    $homeWork = !empty($mark['home_work']) ? $mark['home_work'] : 0;
                    $testWork = !empty($mark['test_work']) ? $mark['test_work'] : 0;
                    $examWork = !empty($mark['exam_work']) ? $mark['exam_work'] : 0;

                    $getFullMarks = !empty($mark['full_marks']) ? $mark['full_marks'] : 0;
                    $getPassingMarks = !empty($mark['passing_marks']) ? $mark['passing_marks'] : 0;

                    $totalMarks = $classWork + $homeWork + $testWork + $examWork;

                    if ($fullMarks >= $totalMarks) {
                        $alreadyRegistered = SubjectMark::getSingleRegisteredMark($request->student_id, $request->exam_id, $request->class_id, $mark['subject_id'])->first();
                        if (isset($alreadyRegistered)) {
                            $subjectMarks             = $alreadyRegistered;
                        } else {
                            $subjectMarks             = new SubjectMark();
                        }
                        $subjectMarks->student_id = $request->student_id;
                        $subjectMarks->batch_id   = $request->class_id;
                        $subjectMarks->class_id   = $request->class_id;
                        $subjectMarks->exam_id    = $request->exam_id;

                        $subjectMarks->subject_id = $mark['subject_id'];
                        $subjectMarks->class_work = $classWork;
                        $subjectMarks->home_work  = $homeWork;
                        $subjectMarks->test_work  = $testWork;
                        $subjectMarks->exam_work  = $examWork;

                        $subjectMarks->full_marks  = $getFullMarks;
                        $subjectMarks->passing_marks  = $getPassingMarks;
                        $subjectMarks->created_by = Auth::user()->id;

                        $subjectMarks->save(); //remove all save
                    } else {
                        $validation = 1;
                    }
                }
            }
            if ($validation == 0) {
                return response()->json([
                    'status' => true,
                    'msg' => 'Marks added successfully'
                ]);
            } else {
                return response()->json([
                    'status' => true,
                    'msg' => 'Check total'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'msg' => 'Something went wrong'
            ]);
        }
    }

    public function storeSingleSubjectMarks(Request $request)
    {
        try {
            $scheduleId = $request->schedule_id;
            $fullMarks = 0;
            $passingMarks = 0;
            $getExamSchedule = ExamSchedule::getSingleSchedule($scheduleId)->first();
            if (isset($getExamSchedule)) {
                $fullMarks = $getExamSchedule->full_marks;
                $passingMarks = $getExamSchedule->passing_marks;
            }

            $classWork = !empty($request->class_work) ? $request->class_work : 0;
            $homeWork = !empty($request->home_work) ? $request->home_work : 0;
            $testWork = !empty($request->test_work) ? $request->test_work : 0;
            $examWork = !empty($request->exam_work) ? $request->exam_work : 0;

            $totalMarks = $classWork + $homeWork + $testWork + $examWork;
            if ($fullMarks >= $totalMarks) {

                $alreadyRegistered = SubjectMark::getSingleRegisteredMark($request->student_id, $request->exam_id, $request->class_id, $request->subject_id)->first();
                if (isset($alreadyRegistered)) {
                    $subjectMarks             = $alreadyRegistered;
                } else {
                    $subjectMarks             = new SubjectMark();
                }
                $subjectMarks->student_id = $request->student_id;
                $subjectMarks->batch_id   = $request->class_id;
                $subjectMarks->class_id   = $request->class_id;
                $subjectMarks->exam_id    = $request->exam_id;

                $subjectMarks->subject_id = $request->subject_id;
                $subjectMarks->class_work = $classWork;
                $subjectMarks->home_work  = $homeWork;
                $subjectMarks->test_work  = $testWork;
                $subjectMarks->exam_work  = $examWork;

                $subjectMarks->full_marks  = $fullMarks;
                $subjectMarks->passing_marks  = $passingMarks;

                $subjectMarks->created_by = Auth::user()->id;

                $subjectMarks->save(); //remove all save

                return response()->json([
                    'status' => true,
                    'msg' => 'Marks added successfully'
                ]);
            } else {
                return response()->json([
                    'status' => true,
                    'msg' => 'Total marks cannot be greater than full marks'
                ]);
            }
        } catch (\Exception $e) {
            dd($e);
            return response()->json([
                'status' => false,
                'msg' => 'Something went wrong'
            ]);
        }
    }

    // Teacher Side
    public function teacherSubjectMarks(Request $request)
    {
        $data['classes'] = ClassTeacher::myClassTeacherSubjectsGroup(Auth::user()->id)->get();
        $data['exams'] = ExamSchedule::getTeacherExams(Auth::user()->id)->get();
        if (!empty($request->get('exam_id')) && !empty($request->get('class_id'))) {
            $data['subjects'] = ExamSchedule::getSingleExamClassSchedule($request->get('exam_id'), $request->get('class_id'))->get();
            $data['students'] = User::getStudentClass($request->get('class_id'))->get();
        }
        $data['header_title'] = 'Subject Results/Marks';
        return view('teacher.examination.subject_marks', $data);
    }

    public function teacherStoreSubjectMarks(Request $request)
    {
        try {
            $validation = 0;
            if (!empty($request->marks)) {
                foreach ($request->marks as $mark) {
                    $getExamSchedule = ExamSchedule::getSingleSchedule($mark['id'])->first();
                    $fullMarks = 0;
                    $getExamSchedule = ExamSchedule::getSingleSchedule($mark['id'])->first();
                    if (isset($getExamSchedule)) {
                        $fullMarks = $getExamSchedule->full_marks;
                    }
                    $classWork = !empty($mark['class_work']) ? $mark['class_work'] : 0;
                    $homeWork = !empty($mark['home_work']) ? $mark['home_work'] : 0;
                    $testWork = !empty($mark['test_work']) ? $mark['test_work'] : 0;
                    $examWork = !empty($mark['exam_work']) ? $mark['exam_work'] : 0;

                    $getFullMarks = !empty($mark['full_marks']) ? $mark['full_marks'] : 0;
                    $getPassingMarks = !empty($mark['passing_marks']) ? $mark['passing_marks'] : 0;

                    $totalMarks = $classWork + $homeWork + $testWork + $examWork;

                    if ($fullMarks >= $totalMarks) {
                        $alreadyRegistered = SubjectMark::getSingleRegisteredMark($request->student_id, $request->exam_id, $request->class_id, $mark['subject_id'])->first();
                        if (isset($alreadyRegistered)) {
                            $subjectMarks             = $alreadyRegistered;
                        } else {
                            $subjectMarks             = new SubjectMark();
                        }
                        $subjectMarks->student_id = $request->student_id;
                        $subjectMarks->class_id   = $request->class_id;
                        $subjectMarks->exam_id    = $request->exam_id;

                        $subjectMarks->subject_id = $mark['subject_id'];
                        $subjectMarks->class_work = $classWork;
                        $subjectMarks->home_work  = $homeWork;
                        $subjectMarks->test_work  = $testWork;
                        $subjectMarks->exam_work  = $examWork;

                        $subjectMarks->full_marks  = $getFullMarks;
                        $subjectMarks->passing_marks  = $getPassingMarks;
                        $subjectMarks->created_by = Auth::user()->id;

                        $subjectMarks->save(); //remove all save
                    } else {
                        $validation = 1;
                    }
                }
            }
            if ($validation == 0) {
                return response()->json([
                    'status' => true,
                    'msg' => 'Marks added successfully'
                ]);
            } else {
                return response()->json([
                    'status' => true,
                    'msg' => 'Check total'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'msg' => 'Something went wrong'
            ]);
        }
    }

    public function teacherStoreSingleSubjectMarks(Request $request)
    {
        try {
            $scheduleId = $request->schedule_id;
            $fullMarks = 0;
            $passingMarks = 0;
            $getExamSchedule = ExamSchedule::getSingleSchedule($scheduleId)->first();
            if (isset($getExamSchedule)) {
                $fullMarks = $getExamSchedule->full_marks;
                $passingMarks = $getExamSchedule->passing_marks;
            }

            $classWork = !empty($request->class_work) ? $request->class_work : 0;
            $homeWork = !empty($request->home_work) ? $request->home_work : 0;
            $testWork = !empty($request->test_work) ? $request->test_work : 0;
            $examWork = !empty($request->exam_work) ? $request->exam_work : 0;

            $totalMarks = $classWork + $homeWork + $testWork + $examWork;
            if ($fullMarks >= $totalMarks) {

                $alreadyRegistered = SubjectMark::getSingleRegisteredMark($request->student_id, $request->exam_id, $request->class_id, $request->subject_id)->first();
                if (isset($alreadyRegistered)) {
                    $subjectMarks             = $alreadyRegistered;
                } else {
                    $subjectMarks             = new SubjectMark();
                }
                $subjectMarks->student_id = $request->student_id;
                $subjectMarks->class_id   = $request->class_id;
                $subjectMarks->exam_id    = $request->exam_id;

                $subjectMarks->subject_id = $request->subject_id;
                $subjectMarks->class_work = $classWork;
                $subjectMarks->home_work  = $homeWork;
                $subjectMarks->test_work  = $testWork;
                $subjectMarks->exam_work  = $examWork;

                $subjectMarks->full_marks  = $fullMarks;
                $subjectMarks->passing_marks  = $passingMarks;

                $subjectMarks->created_by = Auth::user()->id;

                $subjectMarks->save(); //remove all save

                return response()->json([
                    'status' => true,
                    'msg' => 'Marks added successfully'
                ]);
            } else {
                return response()->json([
                    'status' => true,
                    'msg' => 'Total marks cannot be greater than full marks'
                ]);
            }
        } catch (\Exception $e) {
            dd($e);
            return response()->json([
                'status' => false,
                'msg' => 'Something went wrong'
            ]);
        }
    }

    // Student Side
    public function studentSubjectMarks(Request $request)
    {
        // $data['classes'] = ClassTeacher::myClassTeacherSubjectsGroup(Auth::user()->id)->get();
        $results = [];
        $studentExams = SubjectMark::getStudentExams(Auth::user()->id)->get();
        foreach ($studentExams as $key => $studentExam) {
            $dataExam = [];
            $dataExam['exam_name'] = $studentExam->exam?->name;
            $dataExam['exam_id'] = $studentExam->exam_id;
            $getStudentExamSubjects = SubjectMark::getStudentExamSubjects($studentExam->exam_id, Auth::user()->id)->get();
            $subjectsData = [];
            foreach ($getStudentExamSubjects as $key => $studentExamSubject) {
                $dataSubject = [];
                $dataSubject['subject_name'] = $studentExamSubject->subject?->name;
                $dataSubject['class_work'] = $studentExamSubject->class_work;
                $dataSubject['home_work'] = $studentExamSubject->home_work;
                $dataSubject['test_work'] = $studentExamSubject->test_work;
                $dataSubject['exam_work'] = $studentExamSubject->exam_work;
                $dataSubject['full_marks'] = $studentExamSubject->full_marks;
                $dataSubject['passing_marks'] = $studentExamSubject->passing_marks;
                $subjectsData[] = $dataSubject;
            }
            $dataExam['subjects'] = $subjectsData;
            $results[] = $dataExam;
        }
        $data['records'] = $results;
        $data['header_title'] = 'Subject Results/Marks';
        return view('student.examination.subject_marks', $data);
    }

    public function studentStoreSubjectMarks(Request $request)
    {
        try {
            $validation = 0;
            if (!empty($request->marks)) {
                foreach ($request->marks as $mark) {
                    $getExamSchedule = ExamSchedule::getSingleSchedule($mark['id'])->first();
                    $fullMarks = 0;
                    $getExamSchedule = ExamSchedule::getSingleSchedule($mark['id'])->first();
                    if (isset($getExamSchedule)) {
                        $fullMarks = $getExamSchedule->full_marks;
                    }
                    $classWork = !empty($mark['class_work']) ? $mark['class_work'] : 0;
                    $homeWork = !empty($mark['home_work']) ? $mark['home_work'] : 0;
                    $testWork = !empty($mark['test_work']) ? $mark['test_work'] : 0;
                    $examWork = !empty($mark['exam_work']) ? $mark['exam_work'] : 0;

                    $totalMarks = $classWork + $homeWork + $testWork + $examWork;

                    if ($fullMarks >= $totalMarks) {
                        $alreadyRegistered = SubjectMark::getSingleRegisteredMark($request->student_id, $request->exam_id, $request->class_id, $mark['subject_id'])->first();
                        if (isset($alreadyRegistered)) {
                            $subjectMarks             = $alreadyRegistered;
                        } else {
                            $subjectMarks             = new SubjectMark();
                        }
                        $subjectMarks->student_id = $request->student_id;
                        $subjectMarks->class_id   = $request->class_id;
                        $subjectMarks->exam_id    = $request->exam_id;

                        $subjectMarks->subject_id = $mark['subject_id'];
                        $subjectMarks->class_work = $classWork;
                        $subjectMarks->home_work  = $homeWork;
                        $subjectMarks->test_work  = $testWork;
                        $subjectMarks->exam_work  = $examWork;
                        $subjectMarks->created_by = Auth::user()->id;

                        $subjectMarks->save(); //remove all save
                    } else {
                        $validation = 1;
                    }
                }
            }
            if ($validation == 0) {
                return response()->json([
                    'status' => true,
                    'msg' => 'Marks added successfully'
                ]);
            } else {
                return response()->json([
                    'status' => true,
                    'msg' => 'Check total'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'msg' => 'Something went wrong'
            ]);
        }
    }

    public function studentStoreSingleSubjectMarks(Request $request)
    {
        try {
            $scheduleId = $request->schedule_id;
            $fullMarks = 0;
            $getExamSchedule = ExamSchedule::getSingleSchedule($scheduleId)->first();
            if (isset($getExamSchedule)) {
                $fullMarks = $getExamSchedule->full_marks;
            }

            $classWork = !empty($request->class_work) ? $request->class_work : 0;
            $homeWork = !empty($request->home_work) ? $request->home_work : 0;
            $testWork = !empty($request->test_work) ? $request->test_work : 0;
            $examWork = !empty($request->exam_work) ? $request->exam_work : 0;

            $totalMarks = $classWork + $homeWork + $testWork + $examWork;
            if ($fullMarks >= $totalMarks) {

                $alreadyRegistered = SubjectMark::getSingleRegisteredMark($request->student_id, $request->exam_id, $request->class_id, $request->subject_id)->first();
                if (isset($alreadyRegistered)) {
                    $subjectMarks             = $alreadyRegistered;
                } else {
                    $subjectMarks             = new SubjectMark();
                }
                $subjectMarks->student_id = $request->student_id;
                $subjectMarks->class_id   = $request->class_id;
                $subjectMarks->exam_id    = $request->exam_id;

                $subjectMarks->subject_id = $request->subject_id;
                $subjectMarks->class_work = $classWork;
                $subjectMarks->home_work  = $homeWork;
                $subjectMarks->test_work  = $testWork;
                $subjectMarks->exam_work  = $examWork;
                $subjectMarks->created_by = Auth::user()->id;

                $subjectMarks->save(); //remove all save

                return response()->json([
                    'status' => true,
                    'msg' => 'Marks added successfully'
                ]);
            } else {
                return response()->json([
                    'status' => true,
                    'msg' => 'Total marks cannot be greater than full marks'
                ]);
            }
        } catch (\Exception $e) {
            dd($e);
            return response()->json([
                'status' => false,
                'msg' => 'Something went wrong'
            ]);
        }
    }

    public function studentPrintExamResult(Request $request)
    {
        $examId = $request->exam_id;
        $studentId = $request->student_id;
        $getStudentExamSubjects = SubjectMark::getStudentExamSubjects($examId, $studentId)->get();
        $data['exams'] = Examination::getSingleExam($examId);
        $data['student'] = User::getSingleUser($studentId)->first();
        $subjectsData = [];
        foreach ($getStudentExamSubjects as $key => $studentExamSubject) {
            $totalMarksObtained = $studentExamSubject->class_work + $studentExamSubject->test_work + $studentExamSubject->home_work + $studentExamSubject->exam_work;
            $dataSubject = [];
            $dataSubject['subject_name'] = $studentExamSubject->subject?->name;
            $dataSubject['class_work'] = $studentExamSubject->class_work;
            $dataSubject['home_work'] = $studentExamSubject->home_work;
            $dataSubject['test_work'] = $studentExamSubject->test_work;
            $dataSubject['exam_work'] = $studentExamSubject->exam_work;
            $dataSubject['full_marks'] = $studentExamSubject->full_marks;
            $dataSubject['passing_marks'] = $studentExamSubject->passing_marks;
            $dataSubject['totalMarksObtained'] = $totalMarksObtained;
            $subjectsData[] = $dataSubject;
        }
        $data['examMarks'] = $subjectsData;
        return view('exam_result_print', $data);
    }
}
