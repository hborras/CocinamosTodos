$(document).ready(function(){
    $(document).on('click','.ajax-url',function(){
        var url =  $(this).data('url');
        //ajax_replace_content(stateId,'GET',true,url,'article',false,null);
        pushState('GET',true,url,'article',false,null);
    });

    $(document).on('click','.ajax-post',function(){
        var field = $('button[type=submit]');
        var url =  field.data('url');
        var slug = $('.slug');
        if (slug.val() == ""){
            var field2 = $('.name');
            var url2 = field2.data('url') + field2.val();
            ajax_replace_content('GET',false,url2,'.slug',true,null)
        }
        pushState('POST',true,url,'article',false,$('form').serialize());
    });

    $(document).on('keyup','.name',function(){
        var url = $(this).data('url') + $(this).val();
        ajax_replace_content('GET',true,url,'.slug',true,null)
    });

    $(document).on('submit','form',function(){
        return false;
    })

    History.Adapter.bind(window,'statechange',function(){ // Note: We are using statechange instead of popstate
        var s = History.getState(); // Note: We are using History.getState() instead of event.state
        ajax_replace_content(s.data.type, s.data.async, s.data.url, s.data.content, s.data.is_val, s.data.data);
    });

    $(document).on('click','.remove-dialog',function(){
        var content = $(this);
        var url = content.data('url');
        var text = content.data('text');
        var title = content.data('title');
        var id = content.data('id');
        create_dialog(url, title,text, '#category_' + id);
    });
});

function ajax_replace_content(type, async, url, content,is_val,data){
    $.ajax({
        type:  type,
        async: async,
        data:  data,
        url:   url,
        success:function(data){
            if(is_val==false){
                if ($(content) != ""){
                    $(content).fadeOut(400,function(){
                        $(content).empty();
                        $(content).fadeIn(200,function(){
                            $(content).append(data);
                        });
                    });
                } else {
                    $(content).fadeIn(200,function(){
                        $(content).append(data);
                    });
                }
            } else {
                $(content).val(data);
            }
        },
        error:function(error){
            console.log(error);
        }
    });
}

function ajax_remove_content(url, obj){
    $.ajax({
        url:    url,
        success:function(data){
            if(data.result == "OK"){
                $(obj).hide(400);
            } else {
                console.log(data);
            }
        },
        error:function(error){
            console.log(error);
        }
    });
}

function pushState(type,async,url,content,is_val,data){
    if(url!=window.location){
        if(url.indexOf("create") == -1 && url.indexOf("update") == -1) {
            History.pushState({
                    type: type,
                    async: async,
                    url: url,
                    content: content,
                    is_val: is_val,
                    data: data
                },
                '',
                url);
        } else {
            ajax_replace_content(type, async,url,content,is_val,data);
        }
    }
}

function create_dialog(url,title,text,content){
    return $("<div class='dialog' title='" + title + "'><p>" + text + "</p></div>")
        .dialog({
            resizable: false,
            height:250,
            width: 500,
            show: {
                effect: "blind",
                duration: 500
            },
            modal: true,
            buttons: [
                {
                    text: "Yes",
                    "class": 'yes-dialog-button btn btn-lg btn-success',
                    click: function(){
                        ajax_remove_content(url,content);
                        $( this ).dialog( "close" );
                    }
                },
                {
                    text: "Cancel",
                    "class": 'cancel-dialog-button btn btn-lg btn-danger',
                    click: function(){
                        $( this ).dialog( "close" );
                    }
                }
            ]
        });
}