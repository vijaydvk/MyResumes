<html>
<body>

<form  align="left" id='contactus' action='attach_mailer_example.php' method='post' enctype="multipart/form-data" accept-charset='UTF-8'>

<fieldset>
<legend>Sune-soft</legend>

<input type='hidden' name='submitted' id='submitted' value='1'/>

<div class='short_explanation'>Fill Your Information</div>

<div><span class='error'></span></div>
<div class='container'>
    <label for='name' >Your Full Name*: </label><br/>
    <input type='text' name='name' id='name' maxlength="50" /><br/>
    <span id='contactus_name_errorloc' class='error'></span>
</div>
<div class='container'>
    <label for='email' >Email Address*:</label><br/>
    <input type='text' name='email' id='email'  maxlength="50" /><br/>
    <span id='contactus_email_errorloc' class='error'></span>
</div>
<div class='container'>
    <label for='message' >Message:</label><br/>
    <span id='contactus_message_errorloc' class='error'></span>
    <textarea rows="10" cols="50" name='message' id='message'></textarea>
</div>
<div class='container'>
    <label for='photo' >Upload your Resume:</label><br/>
    <input type="file" name='resume' id='resume' /><br/>
    <span id='contactus_photo_errorloc' class='error'>Upload .doc (or) .pdf Files</span>
</div>


<div class='container'>
    <input type='submit' name='Submit' value='Submit' />
</div>

</fieldset>
</form>
</body>
</html>