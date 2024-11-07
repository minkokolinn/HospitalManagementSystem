<?php
$time = strtotime('10:00');
$startTime = date("H:i", strtotime('-30 minutes', $time));
$endTime = date("H:i", strtotime('+30 minutes', $time));
echo $startTime . "<br>";
echo $endTime . "<br>";
?>

<?php
$dates = array('16:30:20', '10:00:40', '10:00:30', '14:20:00', '11:30:20');    //compare end time of appointment
echo "Latest Date: " . max($dates) . "\n";
echo "Earliest Date: " . min($dates) . "\n";
if (isset($_POST['btnTest'])) {
    $valTime = $_POST['tfTime'];
    echo $valTime;

    $dayofAppt=strtolower(date('D',strtotime($_POST['tfDate'])));
    echo "<script>alert('$dayofAppt')</script>";
}
?>

<?php
$time1="10:25:00";
$time2="11:32:23";
if ($time2>$time1) {
    echo "yes";
}else{
    echo "no ";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
</head>
<script>
    $(document).ready(function() {
        $("#PhoneField>option").filter(function() {
            $(this).hide();
        });

        var selected=0
        $("#BrandField").on('change', function() {
            
            var valBrand = $(this).val();
            $("#PhoneField>option").filter(function() {
                if (valBrand==$(this).attr("id")) {
                    $(this).show();
                }else{
                    $(this).hide();
                }
            });
            if(selected==1){
                $("#PhoneField").val("");
            }
            
        });
        $("#PhoneField").on("change",function(){
            selected=1;
        });
    });
</script>

<body>
    <form action="" method="post">
        <input type="time" name="tfTime" id="">
        <input id="date1" size="60" name="tfDate" type="date" format="MM/DD/YYYY" placeholder="MM/DD/YYYY" />
        <input type="submit" value="" name="btnTest">
    </form>
    <p id="myInfo">Name</p>
    <p id="myInfo">Age</p>
    <p id="myInfo">Education</p>
    <p id="myInfo">Address</p>
    <p id="myInfo">Address</p>
    <br>
    <form action="">
        <select name="" id="BrandField">
            <option value="">Select Brand</option>
            <option value="Samsung">Samsung</option>
            <option value="Mi">Mi</option>
            <option value="Apple">Apple</option>
        </select>
        <select name="" id="PhoneField">
            <option value="" id="">Select Phone</option>
            <option value="" id="Samsung">S9 Plus</option>
            <option value="" id="Samsung">S10</option>
            <option value="" id="Samsung">Aplus</option>
            <option value="" id="Mi">Mi 9</option>
            <option value="" id="Mi">Mi 10</option>
            <option value="" id="Apple">Iphone 12</option>
            <option value="" id="Apple">Iphone 13 Pro</option>
        </select>
    </form>
</body>
<script>
    const picker = document.getElementById('date1');
    picker.addEventListener('input', function(e) {
        var day = new Date(this.value).getUTCDay();
        if ([0,1, 2, 3, 4, 5].includes(day)) {
            e.preventDefault();
            this.value = '';
            alert('Weekends not allowed');
        }
    });
    document.querySelectorAll('#myInfo').forEach(element => {
        element.style.display = 'none';
    });
</script>

</html>