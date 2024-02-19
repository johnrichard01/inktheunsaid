function space(input) {
    return /^\s*$/.test(input);
}

function onlyLetters(input) {
    return /^[a-zA-Z ]+$/.test(input);
}
function isValidPassword(password) {
    var passwordRegex = /^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;
    return passwordRegex.test(password);
}
function passwordsMatch(password, confirmPassword) {
    
    return password === confirmPassword;

}
function isValidEmail(email) {
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
 }
function validateSignup(event){
    let username, email, password, confirmPassword;
    username=document.getElementById('username').value;
    email=document.getElementById('email').value;
    password=document.getElementById('password').value;
    confirmPassword=document.getElementById('password_confirmation').value;

    let unameerror, emailerror, passworderror, cpassworderror;
    unameerror=document.getElementById('usernameError');
    emailerror=document.getElementById('emailError');
    passworderror=document.getElementById('passwordError');
    cpassworderror=document.getElementById('cpasswordError');

    isValid= true;

    if(space(username)){
        isValid=false;
        event.preventDefault();
        unameerror.innerHTML="*Please enter a username*"
    }if(username === ""){
        isValid=false;
        event.preventDefault();
        unameerror.innerHTML="*Please enter a username*"
    }if(!isValidEmail(email)){
        isValid=false;
        event.preventDefault();
        emailerror.innerHTML="*Please enter a valid email*"
    }if(space(email)){
        isValid=false;
        event.preventDefault();
        emailerror.innerHTML="*Please enter a email*"
    }if(email === ""){
        isValid=false;
        event.preventDefault();
        emailerror.innerHTML="*Please enter a email*"
    }if(!isValidPassword(password)){
        isValid=false;
        event.preventDefault();
        passworderror.innerHTML="*Password must be at least 8 characters, contain at least one capital letter, and have at least one special character*"
    }if(password===""){
        isValid=false;
        event.preventDefault();
        passworderror.innerHTML="*Please enter a password*";
    }if (!passwordsMatch(password, confirmPassword)){
        isValid=false;
        event.preventDefault();
    }if(isValid){

    }
}
document.getElementById('password_confirmation').addEventListener('input', function(){
    let password, confirmPassword, passworderror, cpassworderror;
    password=document.getElementById('password').value;
    confirmPassword=document.getElementById('password_confirmation').value;
    passworderror=document.getElementById('passwordError');
    cpassworderror=document.getElementById('cpasswordError');

    if(password ==="" && confirmPassword === ""){
        passworderror.innerHTML="";
        cpassworderror.innerHTML="";
    }else{
        if(!passwordsMatch(password, confirmPassword)){
            cpassworderror.innerHTML="*Password does not match*"
            cpassworderror.style.color='red';
        }else{
            cpassworderror.innerHTML="*Password match*"
            cpassworderror.style.color='green';
        }
    }
})
document.getElementById('password').addEventListener('input', function(){
    let password, confirmPassword, passworderror, cpassworderror;
    password=document.getElementById('password').value;
    confirmPassword=document.getElementById('password_confirmation').value;
    passworderror=document.getElementById('passwordError');
    cpassworderror=document.getElementById('cpasswordError');

    if(confirmPassword === ""){
        passworderror.innerHTML="";
        cpassworderror.innerHTML="";
    }else{
        if(!passwordsMatch(password, confirmPassword)){
            cpassworderror.innerHTML="*Password does not match*"
            cpassworderror.style.color='red';
        }else{
            cpassworderror.innerHTML="*Password match*"
            cpassworderror.style.color='green';
        }
    }
})
document.getElementById('username').addEventListener("input", function(){
    document.getElementById('usernameError').innerHTML="";
});
document.getElementById('email').addEventListener("input", function(){
    document.getElementById('emailError').innerHTML="";
});
document.getElementById('password').addEventListener("input", function(){
    document.getElementById('passwordError').innerHTML="";
});
document.getElementById('signupButton').addEventListener('click', validateSignup);