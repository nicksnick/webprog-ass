<?php

$conn = mysqli_connect("localhost", "root", "admin123", "resume");

if(isset($_POST["submit"])){
    $favanimal="";
    $fname= $_POST["fname"];
    $phone= $_POST["phone"];
    $email= $_POST["email"];
    $age= $_POST["age"];
    $gender= $_POST["gender"];
    $reason= $_POST["reason"];
    $checkbox= $_POST["favanimal"];
    $temp="";
    foreach($checkbox as $temp){
        $favanimal .= $temp.", ";
    }
    $sql = "INSERT INTO skill VALUES ('$fname', '$phone', '$email', '$age', '$gender', '$reason', '$favanimal')";

    $result = $conn->query($sql);

    if($result){
        echo "<script>alert('Successfully Submitted Resume');</script>";
    }
}

?>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <title>Zookeeper Form</title>
    </head>

    <body>

        <h1>
            Zoo Keeper Application Form
        </h1>
        <form method="post">
            <fieldset style="max-width:400px">
                <legend>CONTACT DETAILS</legend>
                <table>
                    <tr>
                        <td style="width:100px">
                            <labelfor="">Name
                                <span style="color:red">*</span></labelfor=>
                        </td>
                        <td><input type="text" name="fname" id="fname" required="required"/></td>
                    </tr>
                    <tr>
                        <td style="width:100px">
                            <label for="phone">Telephone</label>
                        </td>
                        <td><input type="text" name="phone" id="phone"/></td>
                    </tr>
                    <tr>
                        <td style="width:100px">
                            <label for="email">Email
                                <span style="color:red">*</span>
                            </label>
                        </td>
                        <td><input type="email" name="email" id="email" required="required"/></td>
                    </tr>
                </table>
            </fieldset>
            <fieldset style="max-width:400px">
                <legend>PERSONAL INFORMATION</legend>
                <table>
                    <tr>
                        <td style="width:100px">
                            <label for="age">
                                <span style="color:red">*</span>Age
                            </label>
                        </td>
                        <td><input type="text" name="age" id="age" required="required"/></td>
                    </tr>
                    <tr>
                        <td style="width:100px">
                            <label for="gender">Gender</label>
                        </td>
                        <td>
                            <select style="width:177px" name="gender" id="gender">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td style="width:100px">
                            <label for="when">When did you first know you wanted to be a zoo-keeper?
                            </label>
                        </td>
                        <td><input type="textbox" name="reason" id="reason"/></td>
                    </tr>
                </table>
            </fieldset>
            <fieldset style="max-width:400px">
                <legend>PICK YOUR FAVOURITE ANIMALS</legend>
                <table>
                    <tr>
                        <td>
                            <input type="checkbox" id="animal1" name="favanimal[]" value="zebra"/>
                            <label for="animal1">Zebra</label>
                        </td>
                        <td>
                            <input type="checkbox" id="animal2" name="favanimal[]" value="cat"/>
                            <label for="animal2">Cat</label>
                        </td>
                        <td>
                            <input type="checkbox" id="animal3" name="favanimal[]" value="anaconda"/>
                            <label for="animal3">Anaconda</label>
                        </td>
                        <td>
                            <input type="checkbox" id="animal4" name="favanimal[]" value="human"/>
                            <label for="animal4">Human</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" id="animal5" name="favanimal[]" value="elephant"/>
                            <label for="animal5">Elephant</label>
                        </td>
                        <td>
                            <input type="checkbox" id="animal6" name="favanimal[]" value="wildebeest"/>
                            <label for="animal6">Wildebeest</label>
                        </td>
                        <td>
                            <input type="checkbox" id="animal7" name="favanimal[]" value="pigeon"/>
                            <label for="animal7">Pigeon</label>
                        </td>
                        <td>
                            <input type="checkbox" id="animal8" name="favanimal[]" value="crab"/>
                            <label for="animal8">Crab</label>
                        </td>
                    </tr>
                </table>
            </fieldset>
            <br>
            <input type="submit" name="submit" value="Submit Application"/>
        </form>
    </body>
</html>