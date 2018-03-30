<?php

$json = file_get_contents("obj_pass.json");//to fetch the json data
$json_array = (array)(json_decode($json));//json decode
$key_array = array_keys($json_array);//to fetch array keys -- ExamFee, ApplicationFee

$all_course_arr = ['Medical','Dental','Ayurveda'];//array of all courses
$all_level_arr = ['UG','UG-DIPLOMA','PG','Ph.D'];//array of all levels

//After type of fees is selected
if (isset($_REQUEST['type'])) {
    $fee_type = $_REQUEST['type'];
    $json_array = $_REQUEST['json_array'];
    $json_array = (array)(json_decode($json));
    $nat_arr = array();
    foreach ($json_array[$fee_type] as $key => $value) {
        array_push($nat_arr, $key);
    }
}

//After Nationality is Selected
if (isset($_REQUEST['nat_type'])) {
    $nat_arr = $_REQUEST['nat_arr'];
    $fee_type = $_REQUEST['fee_type'];
    $nat_type = $_REQUEST['nat_type'];
    $json_array = $_REQUEST['json_array'];
    $json_array = (array)(json_decode($json));
    $course_arr = array();
    foreach ($json_array[$fee_type] as $key => $value) {
        if($key == $nat_type){
            $course_arr = json_decode(json_encode($value), True);
            $course_arr = array_keys($course_arr);
            break;
        }
    }
}

//After course type is selected
if (isset($_REQUEST['course_type'])) {
    $nat_arr = $_REQUEST['nat_arr'];
    $course_arr = $_REQUEST['course_arr'];
    if(isset($_REQUEST['course_type_all'])){
        $course_type_all = $_REQUEST['course_type_all'];
    }
    $fee_type = $_REQUEST['fee_type'];
    $nat_type = $_REQUEST['nat_type'];
    $course_type = $_REQUEST['course_type'];
    $json_array = $_REQUEST['json_array'];
    $json_array = (array)(json_decode($json));
    $course_arrary_val = array();
    $levell_arr = array();
    $levell_arr_keys = array();
    foreach ($json_array[$fee_type] as $key => $value) {
        if($key == $nat_type){
            $course_arrary_val = json_decode(json_encode($value), True);
            foreach ($course_arrary_val as $key1 => $value1) {
                if($key1 == $course_type){
                    $levell_arr = json_decode(json_encode($value1), True);
                    $levell_arr_keys = array_keys($levell_arr);
                    break;
                }
            }
        }
    }
}

//After submit button is clicked
if(isset($_REQUEST['level_arr'])){
        $nat_arr = $_REQUEST['nat_arr'];
        $course_arr = $_REQUEST['course_arr'];
        if(isset($_REQUEST['course_type_all'])){
            $course_type_all = $_REQUEST['course_type_all'];
        }
        if(isset($_REQUEST['level_arr_all'])){
             $level_arr_all = $_REQUEST['level_arr_all'];
        }
        $levell_arr_keys = $_REQUEST['level_keys'];
      $level_array = $_REQUEST['level_arr'];
        $fee_type = $_REQUEST['fee_type'];
        $nat_type = $_REQUEST['nat_type'];
        $course_type = $_REQUEST['course_type'];
        $json_array = $_REQUEST['json_array'];
        $json_array = (array)(json_decode($json));
        $course_arrary_val = array();
        $levell_arr = array();
        $total_fees = 0;
        foreach ($json_array[$fee_type] as $key => $value) {
            if($key == $nat_type){
                $course_arrary_val = json_decode(json_encode($value), True);
                foreach ($course_arrary_val as $key1 => $value1) {
                    if($key1 == $course_type){
                        $levell_arr = json_decode(json_encode($value1), True);
                        foreach ($levell_arr as $key2 => $value2) {
                        	  if($key2 == $level_array){
                              	     $total_fees = $total_fees + $value2['amount'];
                                }
                        
                        }
                        break;
                    }
                }
            }
        }
 }

?>
<html>
    <head>
        <title>
        </title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<style>
    .main_nat_type{
        margin-top: 5%;
    }
    .main_fee_type{
        margin-top: 3%;
    }
    .panel {
    background-color: #ffffff;
    margin-bottom: 25px;
    box-shadow: 0px 0px 4px 0px rgba(0, 0, 0, 0.04);
    border-width: 0;
    border-radius: 3px;
    border-color: #ddd;
    }
    .reset_level_type{
    	align-content: center;
    	text-align: center;
    }
</style>
    </head>
    <body style="background: #EEEEEE;">
        <div class="row" style="padding: 10%;margin-right: auto;margin-left: auto;">
            <div class="col-md-3"> </div>
        <!-- Fee Selection -->
 <div class="col-md-6 col-sm-12 panel">       
            <div class="main_fee_type ">
            <div class="row">
                <div class="col-md-4">
                     <label class="label-type">
                        Fee Type
                    </label>
                </div>
            <?php if (isset($key_array)){ ?>
            <form action="
<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" name="form-horizontal-half" id="form-horizontal-half">
                <?php  for ($i=0;$i<count($key_array);$i++){  ?>
                <div class="fee_type_radio col-md-4">
                    <input type="radio" name="type" id="fee_type_
<?php echo $i;?>" value=
                    <?php echo $key_array[$i];?> <?php if(isset($fee_type)) { echo ($fee_type==$key_array[$i]) ? 'checked' : '';  }  ?> >
                    <label for="fee_type_
<?php echo $i;?>" class="label-btn" style="font-weight:normal;">
                        <?php echo $key_array[$i];?>
                    </label>
                </div>
                <?php 
                                                           }?>
                <input type="hidden" name="json_array" value="
<?php echo $json; ?>"/>
            </form>
            <?php }  ?>
           </div>
        </div>

        <!-- Nationality Selection -->
        <div class="main_nat_type">
            <?php if (isset($nat_arr)){?>
             <div class="row">
<div class="col-md-4">
                     <label class="label-type" >
                        Nationality Type
                    </label>
                </div>
                <div class="col-md-8">
            <form action="
<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" name="form-horizontal" id="form-horizontal">
                <?php  for ($i=0;$i<count($nat_arr);$i++){ ?>
                <div>
                    <input type="radio" name="nat_type" id="nat_type_
<?php echo $i;?>" value=
                    <?php echo $nat_arr[$i];?> <?php if(isset($nat_type)) { echo ($nat_type==$nat_arr[$i]) ? 'checked' : '';  }  ?> >
                    <label for="nat_type_
<?php echo $i;?>" class="label-btn" style="font-weight:normal;">
                        <?php echo $nat_arr[$i];?>
                    </label>
                </div>
                <?php 
                                                         }?>
                <input type="hidden" name="json_array" value="
<?php echo $json; ?>"/>
                <?php if(isset($fee_type)){
    echo '<input type="hidden" name="fee_type" value="'.$fee_type.'"/>';
}?>
                <?php if(isset($nat_arr)){
    foreach($nat_arr as $value)
    {
        echo '<input type="hidden" name="nat_arr[]" value="'.$value.'"/>';
    }
}?>
            </form>
           
        </div>
        </div>
         <?php }  ?>
    </div>
        <!-- Course Selection -->
        <div class="main_course_type">
            <?php if (isset($course_arr)){ ?>
<div class="row">
<div class="col-md-4">
                     <label class="label-type">
                        Course Type
                    </label>
                </div>
                <div class="col-md-8">
            
            <form action="
<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" name="form-horizontal-course" id="form-horizontal-course">
                <?php //check if course is "ALL_COURSES"
                                          if(count($course_arr)==1){
                                              if($course_arr[0] == "ALL_COURSES​"){
                                                //if true show all courses array
                                                  for ($i=0;$i<count($all_course_arr);$i++){ 
                ?>
                <div>
                    <input type="radio" name="course_type_all" id="course_type_
<?php echo $i;?>" value=
                    <?php echo $all_course_arr[$i];?> <?php if(isset($course_type_all)) { echo ($course_type_all==$all_course_arr[$i]) ? 'checked' : '';  }  ?> >
                    <label for="nat_type_
<?php echo $i;?>" class="label-btn" style="font-weight:normal;">
                        <?php echo $all_course_arr[$i];?>
                    </label>
                </div>
                <?php 
                                                  }
                                              }else{
                                                  echo $course_arr[0];
                                              }
                                               echo '<input type="hidden" name="course_type" value="'.$course_arr[0].'"/>';
                                          }else{
                                            //else display courses
                                              for ($i=0;$i<count($course_arr);$i++){ ?>
                <div>
                    <input type="radio" name="course_type" id="course_type_
<?php echo $i;?>" value=
                    <?php echo $course_arr[$i];?> <?php if(isset($course_type)) { echo ($course_type==$course_arr[$i]) ? 'checked' : '';  }  ?> >
                    <label for="course_type_
<?php echo $i;?>" class="label-btn" style="font-weight:normal;">
                        <?php echo $course_arr[$i];?>
                    </label>
                </div>
                <?php 
                                                                                   }
                                          }?>
                <input type="hidden" name="json_array" value="
<?php echo $json; ?>"/>
                <?php if(isset($fee_type)){
                                              echo '<input type="hidden" name="fee_type" value="'.$fee_type.'"/>';
                                          }?>
                <?php if(isset($nat_type)){
                                              echo '<input type="hidden" name="nat_type" value="'.$nat_type.'"/>';
                                          }?>
                <?php if(isset($nat_arr)){
                                              foreach($nat_arr as $value)
                                              {
                                                  echo '<input type="hidden" name="nat_arr[]" value="'.$value.'"/>';
                                              }
                                          }?>
                <?php if(isset($course_arr)){
                                              foreach($course_arr as $value)
                                              {
                                                  echo '<input type="hidden" name="course_arr[]" value="'.$value.'"/>';
                                              }
                                          }?>
            </form>
          
        </div>
          <?php }  ?>
        </div>
        <div class="main_level_type">
              <?php if(isset($levell_arr_keys)){?>
           <div class="row">
<div class="col-md-4">
                     <label class="label-type">
                        Level Type
                    </label>
                </div>
                <div class="col-md-8">
            <form action="
<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" name="form-horizontal-level" id="form-horizontal-level">
                <?php  //check if level is "ALL_LEVELS" 
                                              if(count($levell_arr_keys)==1){
                                                  if($levell_arr_keys[0] == "ALL_LEVEL​"){
                                                    //if true is proceed, show all levels
                                                      for ($i=0;$i<count($all_level_arr);$i++){ ?>
                <div>
                    <input type="radio" name="level_arr_all" id="level_type_
<?php echo $i;?>" value=
                    <?php echo $all_level_arr[$i];?> <?php if(isset($level_arr_all)) {  echo ($level_arr_all==$all_level_arr[$i]) ? 'checked' : '';} ?> >
                    <label for="level_type_
<?php echo $i;?>" class="label-btn" style="font-weight:normal;">
                        <?php echo $all_level_arr[$i];?>
                    </label>
                </div>
                <?php 
                                                                                              }
                                                  }else{
                                                      echo $$levell_arr_keys[0];
                                                  }
                                                  echo '<input type="hidden" name="level_arr" value="'.$levell_arr_keys[0].'"/>';
                                              }else{
                                                //else display all levels
                                                  for ($i=0;$i<count($levell_arr_keys);$i++){ ?>
                <div>
                    <input type="radio" name="level_arr" id="level_type_
<?php echo $i;?>" value=
                    <?php echo $levell_arr_keys[$i];?> <?php if(isset($level_array)) { echo ($level_array==$levell_arr_keys[$i]) ? 'checked' : '';  }  ?> >
                    <label for="level_type_
<?php echo $i;?>" class="label-btn" style="font-weight:normal;">
                        <?php echo $levell_arr_keys[$i];?>
                    </label>
                </div>
                <?php 
                                                                                            }}
                ?>             
                <input type="hidden" name="json_array" value="
<?php echo $json; ?>"/>
                <?php if(isset($fee_type)){
                    echo '<input type="hidden" name="fee_type" value="'.$fee_type.'"/>';
                }?>
                <?php if(isset($nat_type)){
                    echo '<input type="hidden" name="nat_type" value="'.$nat_type.'"/>';
                }?>
                <?php if(isset($course_type)){
                    echo '<input type="hidden" name="course_type" value="'.$course_type.'"/>';
                }?>
                <?php if(isset($nat_arr)){
                    foreach($nat_arr as $value)
                    {
                        echo '<input type="hidden" name="nat_arr[]" value="'.$value.'"/>';
                    }
                }?>
                <?php if(isset($course_arr)){
                    foreach($course_arr as $value)
                    {
                        echo '<input type="hidden" name="course_arr[]" value="'.$value.'"/>';
                    }
                }?>
                <?php if(isset($levell_arr_keys)){
                    foreach($levell_arr_keys as $value)
                    {
                        echo '<input type="hidden" name="level_keys[]" value="'.$value.'"/>';
                    }
                }?>
                 <?php if(isset($course_type_all)){
                    echo '<input type="hidden" name="course_type_all" value="'.$course_type_all.'"/>';
                }?>
                </form>
           
        </div>
    </div>
     <?php } ?>
        </div>
        <div class="reset_level_type" >
     
        <?php 
if(isset($total_fees)){
    echo "Total fees to be paid is <b>".$total_fees."</b>.";
}
        ?>
       
        </div>
        <div class="col-md-3"> </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script>
            $('input[type=radio]').on('change', function() {
                var formName = $(this).closest('form').attr('name')

                $(this).closest("form").submit();
            }
                                     );
           

        </script>
    </body>
</html>
