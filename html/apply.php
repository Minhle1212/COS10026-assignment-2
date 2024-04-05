<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" >
    <meta name="description" content="" >
    <meta name="keywords" content="" >
    <meta name="author" content="">
    <link rel="stylesheet" href="../style/index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://kit.fontawesome.com/142309adca.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&family=Open+Sans:wght@600&family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
   <title>Application Form</title>
</head>

<body id="apply-background">

<div id="form-align">
    <form  method="post" action="processEOI.php" novalidate = "novalidate">
    <fieldset class="form-all">
    
    <div class="form-font" id="header">
        <h1>Job Application Form</h1>
        <p>Please fill out all sections</p><hr>
    </div>

    
    <fieldset class="spacing">
        <p><label for="job_num" class="form-font" >Job Reference Number</label>
            <input type="text" name="job_num" id="job_num" pattern="[A-Za-z0-9]{5}" maxlength="5" required="required" >  
        </p>
            
        <p><label for="fname" id="fname2" class="form-font">First Name</label>  
            <input type="text" name="fname" id="fname" required="required" pattern="^[a-zA-Z ]+$" maxlength="20">
           
        </p>
       
        <p><label for="lname" id="lname2" class="form-font">Last Name</label>
            <input type="text" name="lname" id="lname" required="required" pattern="^[a-zA-Z ]+$" maxlength="20" >
        </p>

        <p><label for="birthday" id="birthday2" class="form-font" >Date of birth</label>
        <input name="birthday" id="birthday" type="text" placeholder="dd/mm/yyyy" 
        pattern="\d{1,2}/\d{1,2}/\d{4}" maxlength="10" size="15" required="required">
        </p>
        
    
    </fieldset>

    <fieldset class="spacing">
       <legend>Gender</legend>
        <input type="radio" name="gender" value="male" id="male" class="radio" required="required">
        <label for="male" class="form-font radio_name choice1" >Male</label>
        <input type="radio" name="gender" class="radio" value="female" id="female" >
        <label for="female" class="form-font radio_name choice2">Female</label>
       
    </fieldset>
    
    <fieldset class="spacing">
        <legend>Current Address</legend>
        
        <p><label for="street" class="form-font">Street Address</label>
        <input type="text" name="street" id="street" required="required" maxlength="40" size="40">
        </p>
        
        <p><label for="town" class="form-font">Suburb/town</label>
        <input type="text" name="town" id="town" required="required" maxlength="40" size="40">
        </p>
        
        <p><label for="tutor" class="form-font">State</label>
            <select required="required" name="tutor" class="state_choice" id="tutor">
            <option class= "state_choice" value="" disabled hidden selected>Please select a choice</option>
            <option class="state_choice" value="VIC">VIC</option>
            <option class="state_choice" value="NSW">NSW</option>
            <option class="state_choice" value="QLD">QLD</option>
            <option class="state_choice" value="NT">NT</option>
            <option class="state_choice" value="WA">WA</option>
            <option class="state_choice" value="SA">SA</option>
            <option class="state_choice" value="TAS">TAS</option>
            <option class="state_choice" value="ACT">ACT</option>
            </select>
        </p>

        <p><label for="pcode" class="form-font">Post Code</label>
            <input type="text" name="pcode" id="pcode" pattern="[0-9]{4}$" maxlength="4" required="required"  size="15" >
        </p>

    </fieldset>
    
    <fieldset class="spacing">
        <legend>Contact Info</legend>

        <p><label for="mail" class="form-font" >Email</label>
            <input type="email" id="mail" name="mail" required="required">
            

        </p>

        <p><label for="phone" id="phone2" class="form-font">Phone number</label>
            <input id="phone" name="phone" pattern="^[0-9 ]{8,12}$" required="required"> 
        </p>

    </fieldset>
    
    <fieldset class="spacing">
        <legend>Skill Lists</legend>  
       
        <p> 
            <label class="checkbox_name form-font" for="HTML">HTML
            <input type="checkbox" name="tech[]" value="HTML" checked id="HTML">
            <span class="tick"></span>
            </label>
        
            
            <label class="checkbox_name form-font" for="CSS">CSS
            <input type="checkbox" name="tech[]" value="CSS" id="CSS">
            <span class="tick"></span>
            </label>

            <label class="checkbox_name form-font" for="Javascript">Javascript
            <input type="checkbox" name="tech[]" value="Javascript" id="Javascript">
            <span class="tick"></span>
            </label>

            <label class="checkbox_name form-font" for="PHP">PHP
            <input type="checkbox" name="tech[]" value="PHP" id="PHP">
            <span class="tick"></span>
            </label>

            <label class="checkbox_name form-font" for="MySQL">MySQL
            <input type="checkbox" name="tech[]" value="MySQL" id="MySQL">
            <span class="tick"></span>
            </label>

            <label class="checkbox_name form-font" for="Other">Other skills
            <input type="checkbox" name="tech[]" value="Other" id="Other">
            <span class="tick"></span>
            </label>
        
        </p>
        
        <p><label class="form-font">Other skills<br>
            <textarea id="other_skills" name="other_skills" rows="18" cols="60" placeholder="Write description of your other skills here..."></textarea>
            </label>
        </p>

    </fieldset>

    <div class="button">  
        <input type= "submit" value="Apply" class="button1">
        <input type= "reset" value="Reset" class="button2">
    </div> 


    </fieldset>
 
</form> 
</div>

    <form action="jobs.php">
        <button class="back_button" type="submit" >Back to Job Lists</button>
    </form>
</body>


</html>