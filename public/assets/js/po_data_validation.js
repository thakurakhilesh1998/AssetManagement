$(document).ready(function()
{
     // Validation function start
     $('#addAsset').submit(function(event)
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
    let propertyName=$('#nameofproperty').val();
    let owner=$('#owner').val();
    let type=$('#type').val();
    let area_type=$('#area_type').val();
    let use_of_building=$('#use_of_building').val();
    let along_highway=$('#along_highway').val();
    let area_land=$('#area_land').val();
    let areaofbuilding=$('#areaofbuilding').val();
    let gps=$('#gps').val();
    let current_income=$('#current_income').val();
    // let jamabandifile=$('#jamabandi').val();
    // Validate Financial Year
    if(propertyName==='' || propertyName.length<4)
    {
        isValid=false;
        $('#nameofproperty').next(".error").remove();
        $("#nameofproperty").after("<span class='error '>Please enter proper Property Name</span>");
    }
    else
    {   
        $("#nameofproperty").next(".error").remove();
    }

    if(owner==="-1")
    {
        isValid=false;
        $("#owner").next(".error").remove();
        $("#owner").after("<span class='error '>Please select Owner of the Building</span>");
    }
    else
    {
        $("#owner").next(".error").remove();
    }

    if(type=="-1")
    {
        isValid=false;
        $("#type").next(".error").remove();
        $("#type").after("<span class='error '>Please select Type of the Building</span>");
    }
    else
    {
        $("#type").next(".error").remove();
    }

    if(area_type==-1)
    {
        isValid=false;
        $("#area_type").next(".error").remove();
        $("#area_type").after("<span class='error '>Please select Type of the Building</span>");
    }
    else
    {
        $("#area_type").next(".error").remove();
    }

    if(use_of_building==-1)
    {
        isValid=false;
        $("#use_of_building").next(".error").remove();
        $("#use_of_building").after("<span class='error '>Please select Use Building</span>");
    }
    else
    {
        $("#use_of_building").next(".error").remove();
    }

    if(along_highway==-1)
    {
        isValid=false;
        $("#along_highway").next(".error").remove();
        $("#along_highway").after("<span class='error '>Please select if along with highway.</span>");
    }
    else
    {
        $("#along_highway").next(".error").remove();
    }
    
    let areaCheck=/^\d+(\.\d*)?$/.test(area_land);
    if(!areaCheck||area_land==='')
    {
        isValid=false;
        $('#area_land').next(".error").remove();
        $('#area_land').after("<span class='error'>Please enter valid area.</span>");
    }
    else
    {
        $("#area_land").next(".error").remove();
    }

    let areaofbuildingCheck=/^\d+(\.\d*)?$/.test(areaofbuilding);
    if(!areaofbuildingCheck|| areaofbuilding==='')
    {
        isValid=false;
        $('#areaofbuilding').next(".error").remove();
        $('#areaofbuilding').after("<span class='error'>Please enter valid area of Building</span>");
    }
    else
    {
        $("#areaofbuilding").next(".error").remove();
    }

    let gpsCheck= /^-?\d{2}\.\d{6},-?\d{2}\.\d{6}$/.test(gps);
    if(!gpsCheck || gps==='')
    {
        isValid=false;
        $('#gps').next(".error").remove();
        $('#gps').after("<span class='error'>Please enter valid GPS coordinates. The GPS coordinates should be in format(e.g. 12.987654,23.123456)</span>");
    }
    else
    {
        $("#gps").next(".error").remove();
    }

    var incomeCheck = /^\d+(\.\d{1,2})?$/.test(current_income);
    if(!incomeCheck ||current_income=='')
    {
        isValid=false;
        $('#current_income').next(".error").remove();
        $('#current_income').after("<span class='error'>Please enter valid amount </span>");
    }
    else
    {
        $("#current_income").next(".error").remove();
    }  
     // File input validation
     let jamabandiFile = $('#jamabandi')[0].files[0]; // Get the selected file
     if (!jamabandiFile) { // Check if a file is selected
         isValid = false;
         $('#jamabandi').next(".error").remove();
         $("#jamabandi").after("<span class='error'>Please select a PDF file</span>");
     } else {
         // Check file extension
         let fileName = jamabandiFile.name;
         let fileExtension = fileName.split('.').pop().toLowerCase();
         if (fileExtension !== 'pdf') {
             isValid = false;
             $('#jamabandi').next(".error").remove();
             $("#jamabandi").after("<span class='error'>Please select a PDF file</span>");
         } else {
             $("#jamabandi").next(".error").remove();
         }
         // Check file size
         let fileSize = jamabandiFile.size; // in bytes
         if (fileSize > 1048576) { // 1 MB in bytes
             isValid = false;
             $('#jamabandi').next(".error").remove();
             $("#jamabandi").after("<span class='error'>File size should be up to 1 MB</span>");
         } else {
             $("#jamabandi").next(".error").remove();
         }
     }
    return isValid;
}