$(document).ready(function()
{
    $('#addMeeting').submit(function(event)
    {
        if(!validateForm())
        {
            event.preventDefault();
        }
    });
});

function validateForm()
{
    let isValid=true;
    let month=$('#month').val();
    let isMeetingConvened=$('#meeting_convened').val();
    let meeting_date=$('#meeting_date').val();
    let subject=$('#subject').val();
    let proceedings=$('#proceedings').val();
    if(month==='-1')
    {
        isValid=false;
        $('#month').next('error').remove();
        $("#month").after("<span class='error '>Please Select month of meeting</span>");
    }
    else
    {
        $('#month').next('error').remove();
    }

    if(isMeetingConvened==='-1')
    {
        isValid=false;
        $('#isMeetingConvened').next('error').remove();
        $('#isMeetingConvened').after('<span class="error">Please Select whether meeting is convened?</span>');
    }
}