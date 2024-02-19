function countCharacters(){
    let title= document.getElementById('title');
    let counter = document.getElementById('charCount');
    counter.classList.add('counter-show');
    counter.innerHTML= 50-title.value.length;
}
document.getElementById('title').addEventListener('input', countCharacters);

function validateBlogs(event){
    let title= document.getElementById('title').value;
    let category= document.getElementById('category').value;
    let description= document.getElementById('your_summernote').value;
    let about = document.getElementById('about').value;
    let error1=document.getElementById('titleError');
    let error2=document.getElementById('categoryError');
    let error3=document.getElementById('descError');
    let error4=document.getElementById('aboutError');
    let isvalid= true;

    if(title === ""){
        isvalid= false;
        error1.innerHTML='Please add a title';
        event.preventDefault();
    }if(title === " "){
        isvalid= false;
        error1.innerHTML='Please add a title';
        event.preventDefault();
    }if(category === '0'){
        isvalid= false;
        error2.innerHTML='Please select a category';
        event.preventDefault();
    }if(description === " "){
        isvalid= false;
        error3.innerHTML='Please write a content';
        event.preventDefault();
    }if(description === ""){
        isvalid= false;
        error3.innerHTML='Please write a content';
        event.preventDefault();
    }if(about === ""){
        isvalid= false;
        error4.innerHTML='Please write a description for your blog';
        event.preventDefault();
    }if(about === " "){
        isvalid= false;
        error4.innerHTML='Please write a description for your blog';
        event.preventDefault();
    }if (isvalid){

    }
}
document.getElementById('title').addEventListener('input', function(){
    document.getElementById('titleError').innerHTML='';
})
document.getElementById('category').addEventListener('click', function(){
    document.getElementById('categoryError').innerHTML='';
})
document.getElementById('your_summernote').addEventListener('click', function(){
    document.getElementById('descError').innerHTML='';
})
document.getElementById('about').addEventListener('input', function(){
    document.getElementById('aboutError').innerHTML='';
})
document.getElementById('postSubmit').addEventListener('click', validateBlogs);