$(document).ready(function() {
    $('#addMeeting').submit(function(event) {
        if (!validateForm()) {
            event.preventDefault();
        }
    });
});

function validateForm() {
    let isValid = true;
    let month = $('#month').val();
    let isMeetingConvened = $('#meeting_convened').val();
    let meeting_date = $('#meeting_date').val();
    let subject = $('#subject').val();
    let proceedings = $('#proceedings')[0].files[0]; // Access the file object

    // Clear previous error messages
    $('.error').remove();

    // Validate month selection
    if (month === '-1') {
        isValid = false;
        $('#month').after("<span class='error'>Please select month of meeting</span>");
    }

    // Validate whether the meeting is convened
    if (isMeetingConvened === '-1') {
        isValid = false;
        $('#meeting_convened').after('<span class="error">Please select whether meeting is convened?</span>');
    }

    // If meeting is convened, validate the meeting details
    if (isMeetingConvened === 'Yes') {
        // Validate subject
        if (subject === '') {
            isValid = false;
            $('#subject').after('<span class="error">Please enter subject of meeting</span>');
        }

        // Validating meeting date
        if (meeting_date === '') {
            isValid = false;
            $('#meeting_date').after('<span class="error">Please select meeting date</span>');
        } else {
            // Perform date range validation
            let minDate = $('#meeting_date').attr('min');  // Get min date from the field's attribute
            let maxDate = $('#meeting_date').attr('max');  // Get max date from the field's attribute

            if (meeting_date < minDate || meeting_date > maxDate) {
                isValid = false;
                $('#meeting_date').after('<span class="error">Please select meeting date within selected month of meeting.</span>');
            }
        }

        // Validating input file
        if (!proceedings) {
            isValid = false;
            $('#proceedings').after('<span class="error">Please select proceeding file.</span>');
        } else {
            // Validate file type (should be PDF)
            let fileType = proceedings.type;
            if (fileType !== 'application/pdf') {
                isValid = false;
                $('#proceedings').after('<span class="error">Please select only PDF file.</span>');
            }

            // Validate file size (should be less than 1MB)
            let fileSize = proceedings.size;
            let maxSize = 1 * 1024 * 1024; // 1MB in bytes
            if (fileSize > maxSize) {
                isValid = false;
                $('#proceedings').after('<span class="error">File size should be less than 1MB.</span>');
            }
        }
    }
    return isValid;
}
