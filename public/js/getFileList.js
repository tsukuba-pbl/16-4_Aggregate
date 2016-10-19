$.ajax({
    type: "GET",
    url: "fileList.php",
    dataType: "json",
    success: function(data){
        var parent = $("form.content");
        for(var prop in data){
            var checkbox_el = parent.find("div.template").clone();
            console.log(checkbox_el);
            checkbox_el.find("input").attr('id', prop);
            checkbox_el.find("input").attr('value', data[prop]);
            checkbox_el.find("label").attr('for', prop);
            checkbox_el.find("label").append(data[prop]);
            checkbox_el.removeClass("template");
            parent.prepend(checkbox_el);
        }
        console.log(data);
    },
    error: function(res){
        console.log(res);
    }
})
