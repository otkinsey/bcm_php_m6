getXml = () => {
    console.log('getXmls');
    var urlTest = window.location.search;
    /* print xml as default or if url includes 'xml'  */ 
    if(urlTest.includes('xml') || (!urlTest.includes('format') && urlTest.includes('action'))){
        const fileExtension = 'xml';
        if(window.location.search.includes('students')){
            var fileName = 'students';
        }else{
            var fileName = 'courses';
        }
        $.ajax({
            url: fileName+'.'+fileExtension,
            method:'GET',
            dataType:'text',
            async: true,
            success: (data, status, xhr)=>{
                console.log(data);                
                $('.mainContent').text(data);
            }
        });
    }
    else{
        return;
    }

}

getXml();