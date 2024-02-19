//for newsletter form validation
function isValidEmail(email) {
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}
function validateNewsletter(event){
    let email = document.getElementById('newsLetterEmail').value;
    if (isValidEmail(email)){

     }else{
        event.preventDefault();
        document.getElementById("newsLetterEmail").value="Please enter a valid email.";
        document.getElementById("newsLetterEmail").style.color="red";
        document.getElementById("newsField").classList.add("newsletter-error");
     }
}
document.getElementById('subscribeBtn').addEventListener('click', validateNewsletter);
document.getElementById('newsLetterEmail').addEventListener('click', function(){
        if (document.getElementById("newsField").classList.contains('newsletter-error')){
            document.getElementById("newsLetterEmail").value="";
            document.getElementById("newsLetterEmail").style.color="black";
            document.getElementById("newsField").classList.remove("newsletter-error");
        }else{
            return;
        }
});
document.getElementById('newsLetterEmail').addEventListener('click', function(){
    if (document.getElementById("newsField").classList.contains('newsletter-success')){
        document.getElementById("newsLetterEmail").value="";
        document.getElementById("newsLetterEmail").style.color="black";
        document.getElementById("newsField").classList.remove("newsletter-success");
    }else{
        return;
    }
});