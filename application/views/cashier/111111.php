<!-- Content area -->
    <div class="row justify-content-md-center" style="margin-top: 10px;">
        <div class="col-md-11">
            <h4 id="heading" class="display-4"><?php echo $heading; ?></h4>
        </div>
    </div>

    <div class="row justify-content-md-center" style="margin-top: 10px;">
        <div class="col-md-11" id="contents">
            
            <form name="form_seed_course_student" method="POST" action="<?php echo base_url('index.php/Academic/seed_course_student') ?>">
            
            <div class="row">
                <div class="col-md-6">
                    
                    <h4 id="sub-heading">Available Courses</h4>
                    <b>S</b> - Total number of Students
                    <div style="border: 1px solid #222; overflow-y: scroll; height: 500px; margin-top: 161px;">
                        <table class='table table-hover'>
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Course Name (Code)</th>
                                    <th>Credits (L+T+P)</th>
                                    <th>S</th>
                                </tr>
                            </thead>

                            <tbody id="course-area">

                            </tbody>
                        </table>
                    </div>
                </div>
                
           


    
                <div class="col-md-6">
                    <h4 id="sub-heading">Students</h4>
                    
                    <!-- search options on students side -->
                    <div class="row justify-content-md-center">
                        <div class="col-md-11">
                            
                                
                                <label>Programme : </label>
                                <select id="student_prog" class="form-control">
                                    <option value="All">All</option>
<?php
                                        for($i=0; $i < count($prog); $i++) {
                                            echo "<option value='".$prog[$i]->prog_code."'>".$prog[$i]->prog_name."</option>";
                                        }
?>
                                </select><br />
                                <label>Semester : </label>
                                <select id="student_sem" class="form-control">
                                    <option value="All">All</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                </select>
                                
                    <div style="margin-top: 23px; border: 1px solid #222; overflow-y: scroll; height: 500px;">
                        <table class='table table-hover'>
                            <thead>
                                <tr>
                                    <th><input class="form-control student-checkboxes" type="checkbox" name="selectedStudents[]" id="selectAll-Students" style="width: 15px; height: 15px;"></th>
                                    <th>Student Name</th>
                                    <th>Roll number</th>
                                </tr>
                            </thead>

                            <tbody id="student-area">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <br/>
            <p>
        </div>
    </div>   
            <input type="submit" class="btn btn-lg btn-outline-primary" value="Save">
            <br><br><br>
</form>


    <script>
        $("document").ready(function(){
            if($("#heading").text() == "Seed Course-Student") {
                getCoursescs();
                //getStudentscs();
            } else {
                getCourses();
                getFaculties();
            }
            
        });
        
        $("#course_dept").on('change', function(){
            getCourses();
        });
        
        $("#faculty_dept").on('change', function(){
            getFaculties();
        });
        
        $("#course_prog").on('change', function(){
            getCourses();
        });
        
        $("#student_dept").on('change', function(){
            getStudentscs();
        });
        
        $("#student_prog").on('change', function(){
            getStudentscs();
        });
        
        $("#student_sem").on('change', function(){
            getStudentscs();
        });
       
        function getCourses() {
            $("#course-area").html('');
            $.ajax({
                type: "POST",
                data: { dept_code: $("#course_dept").val(), prog_code: $("#course_prog").val() },
                url: "<?php echo base_url('index.php/Academic/getCoursesCF/') ?>",
                success: function(result){
                    var obj = JSON.parse(result);
                    $.each(obj, function(key, val){
                        $("#course-area").append("<tr>" +
                                                "<td><input class='form-control course-checkboxes' type='checkbox' name='selectedCourses[]' style='width: 15px; height: 15px;' value='"+val.course_code+"'></td>" +
                                                "<td>" + val.course_name + " (" + val.course_code + ")</td>"+ 
                                                "<td>" + val.credit_distribution + "</td>"+
                                            "</tr>");             
                    });
                }
            });
        }   
        
        $("#selectAll-Courses").click(function(){
            $(".course-checkboxes").prop('checked', $(this).prop('checked'));
        });
        
        
        function getFaculties() {
            $("#faculty-area").html('');
            $.ajax({
                type: "POST",
                data: { dept_code: $("#faculty_dept").val() },
                url: "<?php echo base_url('index.php/Academic/getFacultiesOnSeedPage/') ?>",
                success: function(result){
                    var obj = JSON.parse(result);
                    $.each(obj, function(key, val){
                        $("#faculty-area").append("<tr>" +
                                                  "<td><input class='form-control' type='radio' name='selectedFaculty' style='width: 15px; height: 15px;' value='"+val.f_id+"'></td>" +
                                                  "<td>" + val.name + "</td>"+ 
                                                  "<td>" + val.num_of_courses + "</td>" +
                                                  "<td>" + val.total_credits + "</td>"+
                                                  "<td>" + val.total_credit_hours + "</td>"+
                                               "</tr>"); 
                              //var obj = JSON.parse(result);            
                    });
                }
            });
        }
          
        function getCoursescs() {
            $("#course-area").html('');
            
            $.ajax({
                type: "POST",
               // data: { dept_code: $("#student_dept").val(), prog_code: $("#student_prog").val() },
                url: "<?php echo base_url('index.php/Academic/getCoursescs/') ?>",
                success: function(result){
                    var obj = JSON.parse(result);
                    $.each(obj, function(key, val){
                        $("#course-area").append("<tr>" +
                                                  "<td><input class='form-control selectedCourseCS' type='radio' name='selectedCourse' style='width: 15px; height: 15px;' value='" + val.course_code + "' onchange='getStudentscs();'></td>" +
                                                  "<td>" + val.course_name + " (" + val.course_code + ")</td>"+ 
                                                  "<td>" + val.credit_distribution + "</td>"+
                                                  "<td>" + val.total_students + "</td>"+
                                               "</tr>");           
                    });
                }
            });
        }   
        
        
        
        function getStudentscs() {
            if($(".selectedCourseCS:checked").val() != "undefined"){
                var course_id = $(".selectedCourseCS:checked").val();
            } else {
                var course_id = '';
            }
            $("#student-area").html('');
            $.ajax({
                type: "POST",
                data: { prog_code: $("#student_prog").val(), sem: $("#student_sem").val(), course_code: course_id },
                url: "<?php echo base_url('index.php/Academic/getStudentsOnSeedingPage/') ?>",
                success: function(result){
                    
                    var obj = JSON.parse(result);
                    $.each(obj, function(key, val){
                        if(val.taking_notTaking){
                            if(val.taking_notTaking == "Taking") {
                                var taking = "<td><input class='form-control student-checkboxes' type='checkbox' name='selectedStudents[]' style='width: 15px; height: 15px;' value='"+val.roll_no+"' checked></td>";
                            } else {
                                var taking = "<td><input class='form-control student-checkboxes' type='checkbox' name='selectedStudents[]' style='width: 15px; height: 15px;' value='"+val.roll_no+"'></td>";
                            } 
                        } else {
                            var taking = "<td><input class='form-control student-checkboxes' type='checkbox' name='selectedStudents[]' style='width: 15px; height: 15px;' value='"+val.roll_no+"'></td>";
                        }
                        $("#student-area").append("<tr>" +
                                                  taking +
                                                  "<td>" + val.stud_name + "</td>"+ 
                                                  "<td>" + val.roll_no+ "</td>" +
                                               "</tr>");            
                    });
                }
            });
        }
        
        $("#selectAll-Students").click(function(){
            $(".student-checkboxes").prop('checked', $(this).prop('checked'));
        });
        
        
    </script>
    
    </body>
</html>