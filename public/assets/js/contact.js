//for newsletter form validation
function isValidEmail(email) {
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}
//test for only spaces
function space(input) {
    return /^\s*$/.test(input);
}
//only letters
function onlyLetters(input) {
    return /^[a-zA-Z ]+$/.test(input);
}
function validateContact(event){
    let fname, lname, email, message;
    fname=document.getElementById('firstName');
    lname=document.getElementById('lastName');
    email=document.getElementById('email');
    message=document.getElementById('message');
    isvalid=true;

    if(!onlyLetters(fname.value)){
        isvalid=false;
        event.preventDefault();
        fname.classList.add('contact-error');
        document.getElementById('fname-error').classList.add('error-show');
        document.getElementById('fname-error').innerHTML="only letters";
    }if (fname.value===""){
        isvalid=false;
        event.preventDefault();
        fname.classList.add('contact-error');
        document.getElementById('fname-error').classList.add('error-show');
        document.getElementById('fname-error').innerHTML="Please enter your first name";
    }if (space(fname.value)){
        isvalid=false;
        event.preventDefault();
        fname.classList.add('contact-error');
        document.getElementById('fname-error').classList.add('error-show');
        document.getElementById('fname-error').innerHTML="Please enter your first name";
    } if(!onlyLetters(lname.value)){
        isvalid=false;
        event.preventDefault();
        lname.classList.add('contact-error');
        document.getElementById('lname-error').classList.add('error-show');
        document.getElementById('lname-error').innerHTML="only letters";
    }if (lname.value===""){
        isvalid=false;
        event.preventDefault();
        lname.classList.add('contact-error');
        document.getElementById('lname-error').classList.add('error-show');
        document.getElementById('lname-error').innerHTML="Please enter your last name";
    }if (space(lname.value)){
        isvalid=false;
        event.preventDefault();
        lname.classList.add('contact-error');
        document.getElementById('lname-error').classList.add('error-show');
        document.getElementById('lname-error').innerHTML="Please enter your last name";
    }if(!isValidEmail(email.value)){
        isvalid=false;
        event.preventDefault();
        email.classList.add('contact-error');
        document.getElementById('email-error').classList.add('error-show');
        document.getElementById('email-error').innerHTML="Please enter a valid email";
    }if (email.value===""){
        
    }if(message.value===""){
        isvalid=false;
        event.preventDefault();
        message.classList.add('contact-error');
        document.getElementById('message-error').classList.add('error-show');
        document.getElementById('message-error').innerHTML="Please enter a message";
    }if(space(message.value)){
        isvalid=false;
        event.preventDefault();
        message.classList.add('contact-error');
        document.getElementById('message-error').classList.add('error-show');
        document.getElementById('message-error').innerHTML="Please enter a message";
    }
}
document.getElementById('firstName').addEventListener('input', function(){
        document.getElementById('firstName').classList.remove('contact-error');
        document.getElementById('fname-error').classList.remove('error-show');
        document.getElementById('fname-error').innerHTML="";
});
document.getElementById('lastName').addEventListener('input', function(){
    document.getElementById('lastName').classList.remove('contact-error');
    document.getElementById('lname-error').classList.remove('error-show');
    document.getElementById('lname-error').innerHTML="";
});
document.getElementById('email').addEventListener('input', function(){
    document.getElementById('email').classList.remove('contact-error');
    document.getElementById('email-error').classList.remove('error-show');
    document.getElementById('email-error').innerHTML="";
});
document.getElementById('message').addEventListener('input', function(){
    document.getElementById('message').classList.remove('contact-error');
    document.getElementById('message-error').classList.remove('error-show');
    document.getElementById('message-error').innerHTML="";
});
document.getElementById('contactSubmit').addEventListener('click', validateContact)