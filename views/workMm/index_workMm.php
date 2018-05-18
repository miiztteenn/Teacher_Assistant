<?php include('views/header/nav3.php');?>
<head>




</head>
<style>
    /* Style the form */
    #regForm {
    background-color: #ffffff;
    /*margin: 100px auto;
    padding: 40px;
    width: 70%;*/
    min-width: 300px;
    }

    /* Style the input fields */


    /* Mark input boxes that gets an error on validation: */
    input.invalid {
    background-color: #ffdddd;
    }

    /* Hide all steps by default: */
    .tab {
    display: none;
    }

    /* Make circles that indicate the steps of the form: */
    .step {
    height: 15px;
    width: 15px;
    margin: 0 2px;
    background-color: #bbbbbb;
    border: none; 
    border-radius: 50%;
    display: inline-block;
    opacity: 0.5;
    }

    /* Mark the active step: */
    .step.active {
    opacity: 1;
    }

    /* Mark the steps that are finished and valid: */
    .step.finish {
    background-color: #4CAF50;
    }
</style>
<div class="banner-sec">
    <div class="container">
    <h2>จัดการงาน</h2>
    <!-- Button to Open the Modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addWork1">
    เพิ่มงาน
    </button>
    </br></br>
    <!-- The Modal -->
    <div class="modal fade" id="addWork1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title">เพิ่มงาน</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
            <form method="POST">
                <div class="row">
                    <div class="col-6">
                        <label><span class="red">*</span>หัวข้องาน</label><input type="text" name="title" class="form-control" required>
                        <label><span class="red">*</span> รายละเอียด</label><textarea cols="20" rows="5" type="text" name="detail" class="form-control" required></textarea>
                    </div>
                    <div class="col-6">
                    <label><span class="red">*</span> ผู้สั่งงาน</label>
                    <select name="id_patron"  class="form-control">
                    <?php foreach($patronList as $patron)
                    {
                        
                        ?>
                        <option value="<?php echo $patron->get_id_member() ?>"><?php echo $patron->get_fname()." ".$patron->get_lname()?></option> 
                        <?php    
                    }
                    ?>
                    </select>
                        <label><span class="red">*</span> วันที่สร้างงาน</label><input type="date" name="time_start"  class="form-control" required>
                        <label><span class="red">*</span> วันที่งานสิ้นสุด</label><input type="date" name="time_stop"  class="form-control" required>
                    </div>
                </div>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
            <input type="hidden" name="controller" value="userMm">
            <button type="submit" name="action" value="add_workMm" class="btn btn-success btn-block">เพิ่มงาน</button>
            </form>
        </div>

        </div>
    </div>
    </div>
    <table  id="memberTable" class="table  table-bordered"> 
        <thead>
            <tr  align="center" class="table-light">
                <th>#</th>
                <th>หัวข้องาน</th>
                <th>รายละเอียด</th>
                <th>สถานะ</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            if($workList !== FALSE)
            {   
            $i = 1;
            foreach($workList as $work)
            {
                $objPatron = $work->get_objPatron();
                $objPerson = $work->get_objPerson(); 
                if($work->get_status() == 'waiting')
                {
                    $color='badge badge-pill badge-warning';
                }
                else if($work->get_status() == 'booked')
                {
                    $color='badge badge-pill badge-primary';
                }
                else
                {
                   $color='badge badge-pill badge-success';
                }
                $time=explode(":",$work->get_used_time());
                echo "<tr align='center' class='table-light'>
                        <td>$i</td>
                        <td>".$work->get_title()."</td>
                        <td>".$work->get_detail()."</td>
                        <td><h4><span class='$color'>".$work->get_status()."</span></h4></td>
                     ";
            ?>
                    <td align="center">
                        <a href="#"
                        data-id-work =  "<?php echo $work->get_id_work() ?>"
                        data-title = "<?php echo $work->get_title() ?>"
                        data-detail = "<?php echo $work->get_detail() ?>"
                        data-timestart = "<?php echo $work->get_time_start() ?>"
                        data-timestop = "<?php echo $work->get_time_stop() ?>"
                        data-status ="<?php echo $work->get_status() ?>"
                        data-id-patron ="<?php echo $objPatron->get_id_member() ?>"
                        data-id-person ="<?php echo $objPerson->get_id_member()  ?>"                       
                        data-due-date ="<?php echo $work->get_due_date() ?>"
                        data-HH ="<?php echo $time[0] ?>"
                        data-mm ="<?php echo $time[1]?>"
                        data-summary ="<?php echo $work->get_summary()?>"
                        class="btn btn-success btn-sm btn-edit-work">แก้ไขรายละเอียดงาน</a>
                        <a href="#"
                        data-id-work =  "<?php echo $work->get_id_work() ?>"
                        data-title = "<?php echo $work->get_title() ?>"
                        data-detail = "<?php echo $work->get_detail() ?>"
                        data-timestart = "<?php echo $work->get_time_start() ?>"
                        data-timestop = "<?php echo $work->get_time_stop() ?>"
                        data-status ="<?php echo $work->get_status() ?>"
                        data-id-patron ="<?php echo $objPatron->get_id_member() ?>"
                        data-id-person ="<?php echo $objPerson->get_id_member()  ?>"                       
                        data-due-date ="<?php echo $work->get_due_date() ?>"
                        data-HH ="<?php echo $time[0] ?>"
                        data-mm ="<?php echo $time[1]?>"
                        data-summary ="<?php echo $work->get_summary()?>"
                        class="btn btn-success btn-sm btn-edit-status" >แก้ไขสถานะ</a>
                        <a href="#" 
                        data-id-work = '<?php echo $work->get_id_work()?>'
                        data-title = '<?php echo $work->get_title()?>'
                        class="btn btn-danger btn-sm btn-delete">ลบ</a>
                    </td>
                    </tr>
      <?php $i++; }} ?>
        </tbody>
    </table>
    </br>


<script>
    $(document).ready(function(){
        $('.btn-edit-work').click(function(){
        // get data from edit btn
        var id_work = $(this).attr('data-id-work');
        var title = $(this).attr('data-title');
        var detail = $(this).attr('data-detail');
        var time_start = $(this).attr('data-timestart');
        var time_stop = $(this).attr('data-timestop');
        var status = $(this).attr('data-status');
        var id_patron = $(this).attr('data-id-patron');   
        var id_person = $(this).attr('data-id-person');        
        var due_date = $(this).attr('data-due-date');   
        var HH = $(this).attr('data-HH');   
        var mm = $(this).attr('data-mm');   
        var summary = $(this).attr('data-summary');    

        // set value to modal
        
        $("#id_work").val(id_work);
        $("#title").val(title);
        $("#detail").val(detail);
        $("#time_start").val(time_start);
        $("#time_stop").val(time_stop);
        $("#status").val(status);
        $("#id_patron").val(id_patron);
        if(status == 'waiting')
        {
          $(".waiting").hide();  
          $(".booked").hide(); 
          $("#chkstatus").removeClass();
          $("#chkstatus").addClass("badge badge-pill badge-warning"); 
          $("#chkstatus").empty();
          $("#chkstatus").append(status);
        }
        else if(status == 'booked')
        {
            $(".waiting").hide();  
            $(".booked").show();
            $("#chkstatus").removeClass();
            $("#chkstatus").addClass("badge badge-pill badge-primary");
            $("#chkstatus").empty();  
            $("#chkstatus").append(status);  
            $("#id_person").val(id_person);       
        }
        else
        {
            $(".waiting").show();  
            $(".booked").show();
            $("#chkstatus").removeClass();
            $("#chkstatus").addClass("badge badge-pill badge-success"); 
            $("#chkstatus").empty();
            $("#chkstatus").append(status);
            $("#id_person").val(id_person);
            $("#due_date").val(due_date);       
            $("#HH").val(HH);
            $("#mm").val(mm);
            $("#summary").val(summary);
        }
       

        $("#edit-work").modal('show');
        });
    });
</script>
<script>
    $(document).ready(function(){
        $('.btn-delete').click(function(){
        // get data from edit btn
        var id_work = $(this).attr('data-id-work');
        document.getElementById("data-title-delete").innerHTML = $(this).attr('data-title');
        // set value to modal
        $("#data-id-work-delete").val(id_work);
        $("#delete").modal('show');
        });
    });
</script>


<!-- The Modal -->
<div class="modal fade" id="edit-work">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">แก้ไขงาน <span id="chkstatus"></span></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->   
      <div class="modal-body">
            <form method="POST">
            <input id="id_work" type="text" name="id_work" class="form-control" hidden>
                <div class="row">
                    <div class="col-6">
                        <label><span class="red">*</span> หัวข้องาน</label><input type="text" name="title" id="title" class="form-control" required>                       
                        <label><span class="red">*</span> วันที่สร้างงาน</label><input type="date" name="time_start" id="time_start" class="form-control" required>
                        <label><span class="red">*</span> วันที่งานสิ้นสุด</label><input type="date" name="time_stop" id="time_stop"  class="form-control" required>
                        <label>รายละเอียด</label><textarea cols="20" rows="5" type="text" name="detail" id="detail" class="form-control" ></textarea>
                        
                    </div>
                    <div class="col-6">
                    <label><span class="red">*</span> ผู้สั่งงาน</label>
                    <select name="id_patron" id="id_patron" class="form-control">
                    <?php foreach($patronList as $patron)
                    {
                        
                        ?>
                        <option value="<?php echo $patron->get_id_member() ?>"><?php echo $patron->get_fname()." ".$patron->get_lname()?></option> 
                        <?php    
                    }
                    ?>
                    </select>
                    <input type="hidden" name="status" id="status" value="">
                 
                    <div class="booked">
                    <label><span class="red">*</span> ผู้รับงาน</label>
                    <select name="id_person" id="id_person" class="form-control">
                    <?php foreach($personList as $person)
                    {
                        
                        ?>
                        <option value="<?php echo $person->get_id_member() ?>"><?php echo $person->get_fname()." ".$person->get_lname()?></option> 
                        <?php    
                    }
                    ?>
                    </select>
                    </div>
                    <div class="waiting">
                    <label><span class="red">*</span> วันเวลาที่ทำงานเสร็จ</label><input type="date" name="due_date" id="due_date"  class="form-control" >                
                    <label><span class="red">*</span> จำนวนเวลาที่ทำงาน </label>
                            <div  class="row">
                                <div class="col-3">
                                <input type="number" id="HH" name="HH"   class="form-control" value="0" min=0 required>
                                </div>
                                <div class="col-3">
                                <label style="padding-top:7px">ชั่วโมง</label>  
                                </div>
                                <div class="col-3">
                                <input type="number" id="mm" name="mm"   class="form-control" value="0" min=0  required> 
                                </div>
                                <div class="col-3">
                                <label style="padding-top:7px">นาที</label>                                        
                                </div>
                            </div>
                    <label>รายละเอียดการส่ง</label><textarea cols="20" rows="5" type="text" name="summary" id="summary" class="form-control" ></textarea>
                    </div>    
                    </div>
                </div>
        </div>

      <!-- Modal footer -->
      <div class="modal-footer">
      <input type="hidden" name="controller" value="userMm">
        <button id="btn-submit" type="submit" name="action" value="edit_workMm" class="btn btn-success btn-block">ยืนยันการแก้ไข</button></form>
      </div>

    </div>
  </div>
</div>
<div class="modal fade" id="delete">
<div class="modal-dialog modal-lg">
    <div class="modal-content">

    <!-- Modal Header -->
    <div class="modal-header">
        <h4 class="modal-title">ต้องการลบงาน</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>

    <!-- Modal body -->
    <div class="modal-body">
        <form method="POST">
        <input id="data-id-work-delete" type="text" name="id_work" class="form-control" hidden>
            <div class="row">   
                <div class="col-6">
                    <label id="data-title-delete"></label> 
                 </div>             
            </div>
            <input type="hidden" name="controller" value="userMm">
            
        
    </div>

    <!-- Modal footer -->
    <div class="modal-footer">

    <div style="width :50%">
        <button type="submit" class="btn btn-danger btn-block" name="action" value="delete_workMm">ลบ</button>
    </div>
    <div style="width :50%">    
        <button type="button" class="btn btn-light btn-block" data-dismiss="modal">ยกเลิก</button>
    </div> 
 
        </form>
    </div>

    </div>
</div>
</div>


<!-- แก้ไขสถานะงาน -->
<div class="modal fade" id="edit-work-status">
<div class="modal-dialog">
    <div class="modal-content">

    <!-- Modal Header -->
    <div class="modal-header">
        <h4 class="modal-title">ยืนยันการลบงาน</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>

    <!-- Modal body -->
    <div class="modal-body">
        <form id="regForm" action="" currentTab="0">
            <h1>Register:</h1>
            
            <!-- One "tab" for each step in the form: -->
            <div class="tab">Name:
            <p><input placeholder="First name..." oninput="this.className = ''"></p>
            <p><input placeholder="Last name..." oninput="this.className = ''"></p>
            </div>
            
            <div class="tab">Contact Info:
            <p><input placeholder="E-mail..." oninput="this.className = ''"></p>
            <p><input placeholder="Phone..." oninput="this.className = ''"></p>
            </div>
            
            <div class="tab">Birthday:
            <p><input placeholder="dd" oninput="this.className = ''"></p>
            <p><input placeholder="mm" oninput="this.className = ''"></p>
            <p><input placeholder="yyyy" oninput="this.className = ''"></p>
            </div>
            
            <div class="tab">Login Info:
            <p><input placeholder="Username..." oninput="this.className = ''"></p>
            <p><input placeholder="Password..." oninput="this.className = ''"></p>
            </div>
            
            <div style="overflow:auto;">
            <div style="float:right;">
                <button type="button" class="btn btn-primary" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                <button type="button" class="btn btn-success" id="nextBtn" onclick="nextPrev(1)">Next</button>
            </div>
            </div>
            
            <!-- Circles which indicates the steps of the form: -->
            <div style="text-align:center;margin-top:40px;">
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
            </div> 
        </form>
    </div>

    <!-- Modal footer -->
    <div class="modal-footer">

    </div>

    </div>
</div>
</div>
<!-- แก้ไขสถานะงาน -->
<script>
    //var currentTab = $("#regForm").attr('currentTab'); // Current tab is set to be the first tab (0)
    //showTab(0); // Display the current tab
    function showTab(n) {
        // This function will display the specified tab of the form ...
        var x = document.getElementsByClassName("tab");
        x[n].style.display = "block";
        // ... and fix the Previous/Next buttons:
        if (n == 0) {
            document.getElementById("prevBtn").style.display = "none";
        } else {
            document.getElementById("prevBtn").style.display = "inline";
        }
        if (n == (x.length - 1)) {
            document.getElementById("nextBtn").innerHTML = "Submit";
        } else {
            document.getElementById("nextBtn").innerHTML = "Next";
        }
        // ... and run a function that displays the correct step indicator:
        fixStepIndicator(n)
    }

    function nextPrev(n) {
        // This function will figure out which tab to display
        var x = document.getElementsByClassName("tab");
        var currentTab = (Number)($("#regForm").attr('currentTab'));
        
        // Exit the function if any field in the current tab is invalid:
        if (n == 1 && !validateForm()) return false;
        // Hide the current tab:
        x[currentTab].style.display = "none";
        // Increase or decrease the current tab by 1:
        currentTab = currentTab + n;
        $("#regForm").attr('currentTab',currentTab);
        console.log(currentTab);
        // if you have reached the end of the form... :
        if (currentTab >= x.length) {
            //...the form gets submitted:
            document.getElementById("regForm").submit();
            return false;
        }
        // Otherwise, display the correct tab:
        showTab(currentTab);
    }

    function validateForm() {
        // This function deals with validation of the form fields
        var x, y, i, valid = true;
        var currentTab = (Number)($("#regForm").attr('currentTab'));
        x = document.getElementsByClassName("tab");
        y = x[currentTab].getElementsByTagName("input");
        // A loop that checks every input field in the current tab:
        for (i = 0; i < y.length; i++) {
            // If a field is empty...
            if (y[i].value == "") {
            // add an "invalid" class to the field:
            y[i].className += " invalid";
            // and set the current valid status to false:
            valid = false;
            }
        }
        // If the valid status is true, mark the step as finished and valid:
        if (valid) {
            document.getElementsByClassName("step")[currentTab].className += " finish";
        }
        return valid; // return the valid status
    }

    function fixStepIndicator(n) {
        // This function removes the "active" class of all steps...
        var i, x = document.getElementsByClassName("step");
        if(n == 0)
        {
            for (i = 0; i < x.length; i++) {
                x[i].className = x[i].className.replace(" finish", "");
            }
        }
        for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" active", "");
        }
        //... and adds the "active" class to the current step:
        x[n].className += " active";
    }
    function clearinput()
    {
        $(".tab").css("display", "none");
        $("input").val('');
    }
    $(document).ready(function(){
        $('.btn-edit-status').click(function(){
            // get data from edit btn
            /*var id_work = $(this).attr('data-id-work');
            document.getElementById("data-title-delete").innerHTML = "คุณต้องการลบงาน " +$(this).attr('data-title') + " ใช่หรือไม่";
            // set value to modal
            $("#data-id-work-delete").val(id_work);*/
            clearinput();
            $("#regForm").attr('currentTab',0);
            showTab(0);
            $("#edit-work-status").modal('show');
        });
    });
</script>

<!-- ตาราง DataTable -->
<script>
    $(document).ready(function() {
    $('#memberTable').DataTable({
        "language": {
            "lengthMenu": "แสดง _MENU_ แถวต่อหน้า",
            "zeroRecords": "Nothing found - sorry",
            "info": "Showing page _PAGE_ of _PAGES_",
            "infoEmpty": "No records available",
            "infoFiltered": "(filtered from _MAX_ total records)",
            "search":"ค้นหา:",
            "paginate": {
            "first":      "หน้าแรก",
            "last":       "หน้าสุดท้าย",
            "next":       "ต่อไป",
            "previous":   "ก่อนหน้า"
            },
            "info":"แสดงแถว _START_ ถึง _END_ จากทั้งหมด _TOTAL_ แถว",
        }
    });
} );
</script>

