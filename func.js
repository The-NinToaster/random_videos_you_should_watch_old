
$(document).ready(function(){

    refresh();

    $("form").submit(function (event) {
        var formData = 
        {
            link: $("#link").val(),
            title: $("#title").val(),
            channel: $("#channel").val(),
            name: $("#name").val()
        };

        $.ajax({
        type: "POST",
        url: "suggest.php",
        data: formData,
        dataType: "json",
        encode: true,
        }).done(function (data) {
            console.log(data);
            if (!data.success)
            {
                if(data.errors.link)
                {
                    $("#formresponse").append(
                        "<p>"+ data.errors.link +"</p>"
                    )
                }
                if(data.errors.connection)
                {
                    $("#formresponse").append(
                        "<p>"+ data.errors.connection +"</p>"
                    )
                }
            }
            else
            {
                $("#formresponse").append(
                    "<p>Your suggestion has been added!</p>"
                )
            }
        });
        event.preventDefault();
    });

});

function replace(id,content) 
{
    var container = document.getElementById(id);
    container.innerHTML = content;
};


function refresh()
{
    $.ajax({
        method: 'GET',
        url: "video.php",
    }).done(function(data){
        var response = JSON.parse(data);
        replace("video", response.video);
        replace("video_title", response.title);
        replace("video_channel", response.channel);
        replace("video_suggested", response.suggested);
        console.log(response);

    })};




