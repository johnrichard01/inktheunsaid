$(document).ready(function(){
    $('#ReportBTN').click(function (event){
        event.preventDefault();
        let blog_id=$(this).val()
        $('#blog_id').val(blog_id);
        $('#modalReport').modal('show');
    })
})

function validateReport(event){
    let reason =document.querySelector('input[name="report_reason"]:checked');
    isvalid=true;
    if (reason === null){
        isvalid=false;
        event.preventDefault();
        document.getElementById('reportError').innerHTML="Please select the issue your are reporting."
    }if(isvalid){

    }
}
function removeError(event){
    if (event.target.checked) {
        console.log('Selected value:', event.target.value);
        document.getElementById('reportError').innerHTML=""
    }
}
$('#modalReport').on('hidden.bs.modal', function () {
    document.querySelectorAll('input[name="report_reason"]').forEach(function(radio) {
        radio.checked = false;
    });
    document.getElementById('reportError').innerHTML = "";
});
document.querySelector('input[name="report_reason"').addEventListener('change', removeError);
document.getElementById('reportSubmit').addEventListener('click', validateReport);