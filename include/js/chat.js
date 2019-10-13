$(document).ready(function(){
    $('.msg_head').click(function(){        
        var chatbox = $('.msg_box').attr("rel") ;
        $('[rel="'+chatbox+'"] .msg_wrap').slideToggle('slow');
        return false;
    });
});



$(document).ready(function(){
    showchat();



$('.msg_submit').click(function(){
        var chat = $('#chat').val();
        if (chat != '') {
            $.ajax({
                url: 'home/editchat?chat=' + chat,
                method: 'get',
                data: '',
                async: false,
                dataType: 'json',
                success: function(adddata){
                   $('#chat').val('');

                setInterval(function() {
                    $('#chat_sms').text( showchat);
                }, 1000);
                }
                });
            }
})


// Show Chat

function showchat() { 
    var empid = $('#user_emp_id').val();
        $.ajax({
            type: 'ajax',
            url: 'home/getchatByJason',
            async: false,
            data: '',
            dataType: 'json',
        }).success(function(getchat) {
            var html = '';
            var i;
            for (i=0; i<getchat.length; i++) {
                if (getchat[i].emp_id != empid) {
                    html += '<div class="msg-left" id="chat_sms" title="'+ new Date(getchat[i].timestamp)+'">'+
                                '<img id="chat_img" class="chat_img" style="padding-right:8px;" title="'+getchat[i].ename+'" width="40px" height="40px" src="'+getchat[i].img_url+'">'
                            +getchat[i].chat+
                            '</div>';
                        }else{
                            html +='<div class="msg-right" id="chat_sms" title="'+getchat[i].name+' '+ new Date(getchat[i].timestamp)+'" id="chat_me">'
                                    +getchat[i].chat+
                                    '</div>';
                        }}
            $('.msg_body').html(html);

        });
    }
    });
