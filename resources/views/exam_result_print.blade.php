<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam Result</title>
    <style>
        @page {
            size: 8.3in 11.7in;
        }

        @page {
            size: A4;
        }

        .margin-bottom {
            margin-bottom: 10px;
        }

        @media print {
            @page {
                margin: 0px;
                margin-left: 20px;
                margin-right: 20px;
            }
        }

        .table-bordered {
            border-collapse: collapse !important;
            width: 100%;
            font-size: 15px;
            text-align: center !important;
        }

        .th {
            border: 1px solid black;
            padding: 10px;
        }

        .td {
            border: 1px solid black;
            padding: 10px;
        }
    </style>
</head>

<body>
    <div id="page" style="">
        <table style="width: 100%; display: flex; justify-content: center">
            <tr>
                <th style="width: 15%; border: 1px solid lightgrey"><img width="80px" height="80px" src="https://cdn-icons-png.flaticon.com/512/3177/3177440.png" alt=""></th>
                <th align="left" style="width: 85%;">
                    <h1 style="margin-left: 15px">Civil Services Preparatory <br>School (CSPs)</h1>
                </th>
            </tr>
        </table>
        <br>
        <hr>
        <table style="width: 100%;">
            <tr>
                <th style="width: 5%;"></th>
                <th style="width: 70%;">
                    <table class="margin-bottom" style="width: 100%">
                        <tbody>
                            <tr>
                                <td align="left" style="width: 27%;">Student Name :</td>
                                <td align="left" style="border-bottom: 1px solid; width: 100%"> {{$student->name}}</td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="margin-bottom" style="width: 100%">
                        <tbody>
                            <tr>
                                <td align="left" style="width: 23%;">Admission No : </td>
                                <td align="left" style="border-bottom: 1px solid; width: 100%"> {{$student->admission_number}}</td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="margin-bottom" style="width: 100%">
                        <tbody>
                            <tr>
                                <td align="left" style="width: 27%;">Roll Number : </td>
                                <td align="left" style="border-bottom: 1px solid; width: 100%"> {{$student->roll_number}}</td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="margin-bottom" style="width: 100%">
                        <tbody>
                            <tr>
                                <td align="left" style="width: 23%;">Class Name : </td>
                                <td align="left" style="border-bottom: 1px solid; width: 100%"> {{$student->class?->name}}</td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="margin-bottom" style="width: 100%">
                        <tbody>
                            <tr>
                                <td align="left" style="width: 28%;">Academic Session : </td>
                                <td align="left" style="border-bottom: 1px solid; width: 20%"> {{\Carbon\Carbon::parse($student->class?->created_at)->format('Y')}}</td>
                                <td align="left" style="width: 11%;">Terms: </td>
                                <td align="left" style="border-bottom: 1px solid; width: 80%"> {{$exams->name}}</td>
                            </tr>
                        </tbody>
                    </table>
                </th>
                <th style="width: 5%;"></th>
                <th style="width: 20%;" valign="top">
                    <img src="https://cdn-icons-png.flaticon.com/512/3177/3177440.png" alt="" style="border: 1px solid lightgrey; height: 100px; width: 100px">
                    Student
                </th>
            </tr>
        </table>
        <br><br>
        <div class="res-tabs">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th class="th">Subject Name</th>
                        <th class="th">Class work</th>
                        <th class="th">Home work</th>
                        <th class="th">Test work</th>
                        <th class="th">Exam work</th>
                        <th class="th">Full marks</th>
                        <th class="th">Passing marks</th>
                        <th class="th">Obtained marks</th>
                        <th class="th">Result</th>
                    </tr>
                </thead>

                <tbody>
                    @php 
                        $totalMarks = 0;
                        $status = 'PASS';
                    @endphp
                    @foreach ($examMarks as $subject)
                    <tr>
                        <td class="td">{{$subject['subject_name']}}</td>
                        <td class="td">{{$subject['class_work']}}</td>
                        <td class="td">{{$subject['home_work']}}</td>
                        <td class="td">{{$subject['test_work']}}</td>
                        <td class="td">{{$subject['exam_work']}}</td>
                        <td class="td">{{$subject['full_marks']}}</td>
                        <td class="td">{{$subject['passing_marks']}}</td>
                        <td class="td">
                            @php
                            $totalObtainedMarks = $subject['class_work'] + $subject['home_work'] + $subject['test_work'] + $subject['exam_work'];
                            @endphp
                            {{$totalObtainedMarks}}
                        </td>
                        <td class="td">
                            @if ($totalObtainedMarks >= $subject['passing_marks'])
                            <span class="badge badge-success p-2 text-md">PASS</span>
                            @else
                            @php 
                                $status = 'FAIL';
                            @endphp
                            <span class="badge badge-danger p-2 text-md">FAIL</span>
                            @endif
                        </td>
                    </tr>
                    @php
                    $totalMarks += $subject['full_marks']; 
                    @endphp
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th align="center" class="th" colspan="3">Grand Total: {{$totalObtainedMarks}} / {{$totalMarks}}</th>
                        <th align="center" class="th" colspan="3">Percentage: {{($totalObtainedMarks/$totalMarks)*100}}%</th>
                        <th align="center" class="th" colspan="3">Status: {{$status}}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <br><br>
        <p>
            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Et cumque nobis repellat debitis accusantium incidunt quibusdam ut. Assumenda pariatur ipsam fugiat dolorem sint saepe labore, dicta, enim doloremque laboriosam officiis.
        </p>
        <br><br>
        <table class="margin-bottom" style="width: 100%">
            <tbody>
                <tr>
                    <td align="right" style="width: 10%;">Signature/Stamp: </td>
                    <td align="right" style="border-bottom: 1px solid; width: 5%"></td>
                </tr>
            </tbody>
        </table>
    </div>
    <script>
        window.print();
    </script>
</body>

</html>