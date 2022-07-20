$(function(){
        
    mk_list(); // 책 리스트 생성

    on_event();
})

function on_event(){
    $(document).on("click",".closeBtn",function(){
    	$('.menu-pop').hide();
    })
    $(document).on("click","#bookBox .item",function(){
        b_ind = parseInt($(this).attr("data-idx")); // 아이템의 고유번호
        page = 0;

        total_page = can_arr[b_ind].length;
        $("#total_page").html(total_page);

        $("#c_page").html(page+1);

        ob_arr = can_arr[b_ind][page];
        // console.log(ob_arr, page)

        $("#edit_modal").show();
        re_draw();
    })

    $(document).on("click",".cover",function(){
        $(this).parent().hide();
        return false;
    })

    $(document).on("click","#new_btn",function(){
        page = can_arr[b_ind].length;
        can_arr[b_ind][page] = [];

        $("#c_page").html(page+1);
        $("#total_page").html(page+1);

        obj = "";
        ob_arr = can_arr[b_ind][page];
        re_draw();
    })

    $(document).on("click","#prev_btn",function(){
        if(page == 0){
            alert("첫 페이지입니다.");
        }else{
            page--;
            $("#c_page").html(page+1);

            obj = "";
            ob_arr = can_arr[b_ind][page];
            re_draw();
        }
    })

    $(document).on("click","#next_btn",function(){
        len = can_arr[b_ind].length;
        if(page == len-1){
            alert("마지막 페이지입니다.");
        }else{
            page++;
            $("#c_page").html(page+1);

            obj = "";
            ob_arr = can_arr[b_ind][page];    
            re_draw();
        }
    })

    $(document).on("click","#btn_box button",function(){
        $("#btn_box button").removeClass("active");
        $(this).addClass('active');
        mode = $(this).attr("id");

        if(mode == "txt" || mode == "img" || mode == "mov"){
            $(`#${mode}_modal`).show();
            $("#btn_box button").removeClass("active");
        }else if(mode == "del"){
            if(obj){
                ob_arr.pop();
                $(`#${obj.id}`).remove();
                obj = "";
            }else{
                alert("객체를 선택해 주세요.");
            }
            mode = "";
            $("#btn_box button").removeClass("active");
        }
    })

    $(document).on("mousedown","#can_box",function(e){
        cl_x = e.offsetX;
        cl_y = e.offsetY;

        if(mode == "line" || mode== "rect" || mode=="cir" || mode=="tri"){
            if(e.target.src){
                cl_x = Number(e.target.style.left.replace("px","")) + cl_x;
                cl_y = Number(e.target.style.top.replace("px","")) + cl_y;
                // cl_x = $(e.target).css("left").replace("px","")
            }
            move_ok = true;
            $("#tmp_can").show();
            ctx = document.getElementById('tmp_can').getContext("2d");
                ctx.clearRect(0,0,1100,600);
                ctx.beginPath();
                    ctx.moveTo(cl_x,cl_y);
                    x_arr = [cl_x];
                    y_arr = [cl_y];

        }else if(mode == "sel"){
            move_ok = true; 
            chk_point(e);
        }
    })

    $(document).on("mousemove","#can_box",function(e){
        mx = e.offsetX
        my = e.offsetY
        if(move_ok){ 
            
            if(mode != "line" && mode != "sel"){ ctx.clearRect(0,0,1100,600);  ctx.beginPath();} 

            if(mode == "line"){
                x_arr.push(mx);
                y_arr.push(my);
                ctx.lineTo(mx,my);
                ctx.stroke();
            }else if(mode == "rect"){
                wi = mx - cl_x;
                he = my - cl_y;
                ctx.rect(cl_x,cl_y,wi,he);
                ctx.stroke();       
            }else if(mode == "cir"){
                wi = Math.abs(mx - cl_x);
                ctx.arc(cl_x, cl_y, wi, 0, 2 * Math.PI);
                ctx.stroke();
            }else if(mode == "tri"){
                ctx.moveTo(cl_x,cl_y);  
                ctx.lineTo(mx,my);
                ctx.lineTo(cl_x,my-cl_y+my);
                ctx.lineTo(cl_x,cl_y);
                ctx.stroke();
            }else if(mode == "sel" && obj){ 

                if(obj.ob_type == "line"){
                    nx = mx - obj.x[0];
                    ny = my - obj.y[0];
                }else{
                    nx = mx - obj.x;
                    ny = my - obj.y;
                }
                
                if(obj.ob_type == "media" && e.target.src) { 
                    nx = mx; 
                    ny = my;
                }

                if(obj.ob_type == "line"){
                    for(i=0; i<obj.x.length; i++){
                        obj.x[i] = obj.x[i] + nx - x_gap;
                        obj.y[i] = obj.y[i] + ny - y_gap;
                    }
                }else{
                    obj.x = obj.x + nx - x_gap;
                    obj.y = obj.y + ny - y_gap;
                }
                re_draw();
            }    
        }
    })

    $(document).on("mouseleave mouseup ","#can_box",function(){
        if(move_ok){
            move_ok = false;
            if(mode == "sel"){ return false; }

            id = Date.now() + Math.round(Math.random()*10000000000000); 

            if(mode == "line"){
                tmp = {
                    'id' : id,
                    'ob_type' : 'line',
                    'txt' : "",
                    'x' : x_arr,
                    'y' : y_arr,
                    'wi' : "",
                    'he' : "",
                    'line_color' : line_color,
                    'fill_color' : fill_color,
                    'line_width' : line_width,
                    'font_size' : font_size,
                    'z_idx' : z_idx
                }       
            }else if(mode == "rect"){
                tmp = {
                    'id' : id,
                    'ob_type' : 'rect',
                    'txt' : "",
                    'x' : cl_x,
                    'y' : cl_y,
                    'wi' : wi,
                    'he' : he,
                    'line_color' : line_color,
                    'fill_color' : fill_color,
                    'line_width' : line_width,
                    'font_size' : font_size,
                    'z_idx' : z_idx
                }
            }else if(mode == "cir"){
                tmp = {
                    'id' : id,
                    'ob_type' : 'cir',
                    'txt' : "",
                    'x' : cl_x,
                    'y' : cl_y,
                    'wi' : wi,
                    'he' : "",
                    'line_color' : line_color,
                    'fill_color' : fill_color,
                    'line_width' : line_width,
                    'font_size' : font_size,
                    'z_idx' : z_idx
                }
            }else if(mode == "tri"){
                wi = mx-cl_x;
                he = my-cl_y
                tmp = {
                    'id' : id,
                    'ob_type' : 'tri',
                    'txt' : "",
                    'x' : cl_x,
                    'y' : cl_y,
                    'wi' : wi,
                    'he' : he,
                    'line_color' : line_color,
                    'fill_color' : fill_color,
                    'line_width' : line_width,
                    'font_size' : font_size,
                    'z_idx' : z_idx
                }   
            }

            z_idx++;
            ob_arr.push(tmp);
            $("#can_box").append(`<canvas width="1100" height="600" id="${id}" class="poa"></canvas>`);

            $("#tmp_can").hide();
            obj = "";
            can_sort();
        }
    })

    $(document).on("change","#line_color",function(){
        line_color = $(this).val();
    })

    $(document).on("change","#fill_color",function(){
        fill_color = $(this).val();
    })

    $(document).on("input change","#line_width",function(){
        line_width = $(this).val();
    })

    $(document).on("input change","#font_size",function(){
        font_size = $(this).val();
    })

    $(document).on("click","#txt_modal .okBtn",function(){
        x = $("#tx").val(); 
        y = $("#ty").val();
        txt = $("#in_txt").val();

        if(!txt){ alert("텍스트를 입력해 주세요."); return false;}

        id = Date.now() + Math.round(Math.random()*10000000000000); 
        tmp = { 
                'id' : id,
                'ob_type' : 'txt',
                'txt' : txt,
                'x' : x,
                'y' : y,
                'wi' : "",
                'he' : "",
                'line_color' : line_color,
                'fill_color' : fill_color,
                'line_width' : line_width,
                'font_size' : font_size,
                'z_idx' : z_idx
            }
        z_idx++;
        ob_arr.push(tmp);
        $("#can_box").append(`<canvas width="1100" height="600" id="${id}" class="poa"></canvas>`);
        obj = "";
        can_sort();
        $("#txt_modal").hide();
    })

    $(document).on("click","#img_modal .okBtn",function(){
        sel_img = $("#sel_img").val();
        id = Date.now() + Math.round(Math.random()*10000000000000); 
        tmp = {
                'id' : id,
                'ob_type' : 'media',
                'txt' : "",
                'x' : 10,
                'y' : 10,
                'wi' : 350,
                'he' : 510,
                'line_color' : line_color,
                'fill_color' : fill_color,
                'line_width' : line_width,
                'font_size' : font_size,
                'z_idx' : z_idx
            }
        z_idx++;

        ob_arr.push(tmp);   
        $("#can_box").append(`<img id="${id}" src="/data/${sel_img}" class="poa"  style="width: 350px; height:510px;">`);
        obj = "";
        can_sort();
        $("#img_modal").hide();
    })

    $(document).on("click","#mov_modal .okBtn",function(){
        sel_mov = $("#sel_mov").val();
        id = Date.now() + Math.round(Math.random()*10000000000000);

        tmp = {
                'id' : id,
                'ob_type' : 'media',
                'txt' : "",
                'x' : 10,
                'y' : 10,
                'wi' : 636,
                'he' : 360,
                'line_color' : line_color,
                'fill_color' : fill_color,
                'line_width' : line_width,
                'font_size' : font_size,
                'z_idx' : z_idx
            }
        z_idx++;

        ob_arr.push(tmp);
        $("#can_box").append(`<video id="${id}" src="/data/${sel_mov}" class="poa" width="640" height="360"></video>`);
        obj = "";
        can_sort();
        $("#mov_modal").hide();
    })

    $(document).on("click",".cancelBtn",function(){
        $(`#${mode}_modal`).hide();
    })

    // 검색
    $(document).on('click', '.searchBtn', function() {
        search();
    });


    //html download         
    $(document).on("click","#save_html",function(){
        ob_root = "http://127.0.0.1"
        $.post("/js/jquery.js",function(d){
            js = d;
            con = "";

            ob_arr.forEach(function(ele,ind){
                tp = ele.ob_type;
                if(tp == "media"){  // 이미지나 동영상일 경우.

                    ob_src = $(`#${ele.id}`).attr("src");
                    if(ob_src.search("mp4") != -1){
                        con += `<video src="${ob_root}${ob_src}" id="${ele.id}" data-ob_type="${ele.ob_type}" data-x="${ele.x}" data-y="${ele.y}" style="left:${ele.x}px; top:${ele.y}px" autoplay muted></video>`;   
                    }else{
                        con += `<img src="${ob_root}${ob_src}" id="${ele.id}" data-ob_type="${ele.ob_type}" data-x="${ele.x}" data-y="${ele.y}" alt="img" title="img" style="left:${ele.x}px; top:${ele.y}px">`;
                    }

                }else{

                    n_txt = ele.txt.replace(/\n/g,"@@@");

                    con += `<canvas width="1100" height="600" id="${ele.id}" data-ob_type="${ele.ob_type}" data-txt="${n_txt}" data-x="${ele.x}" data-y="${ele.y}" data-wi="${ele.wi}" data-he="${ele.he}" data-line_color="${ele.line_color}" data-fill_color="${ele.fill_color}" data-line_width="${ele.line_width}" data-font_size="${ele.font_size}"></canvas>`
                }
            })

            js2 = `
                $(function(){
                    obj = $("#temp").html();

                    $("canvas").each(function(ind,ele){
                        ob_id = $(this).attr("id");
                        tp = $(this).attr("data-ob_type");

                        txt = $(this).attr("data-txt");

                        if(tp == "line"){
                            x = $(this).attr("data-x");
                            y = $(this).attr("data-y");
                        }else{
                            x = Number($(this).attr("data-x"));
                            y = Number($(this).attr("data-y"));
                        }

                        wi = Number($(this).attr("data-wi"));
                        he = Number($(this).attr("data-he"));
                        
                        ctx = document.getElementById(ob_id).getContext("2d");
                        ctx.textBaseline = "top";
                        ctx.beginPath();
                        
                            ctx.strokeStyle = $(this).attr("data-line_color");
                            ctx.fillStyle = $(this).attr("data-fill_color");
                            ctx.lineWidth = $(this).attr("data-line_width");
                            ctx.font = $(this).attr("data-font_size") + "px Arial";  

                        if(tp == "txt"){
                            tt = txt.split("@@@");
                            yy = y;
                            for(i=0; i<tt.length; i++){
                                ctx.fillText(tt[i].trim(),x,yy);
                                yy += 20;
                            }
                        }else if(tp == "line"){
                            x = x.split(",");
                            y = y.split(",");
                            ctx.moveTo(x[0],y[0])
                            for(i=1; i<x.length; i++){
                                ctx.lineTo(x[i],y[i]);
                            }
                            ctx.stroke();
                        }else if(tp == "rect"){
                            ctx.rect(x,y,wi,he);
                            ctx.fill();
                            ctx.stroke();
                        }else if(tp == "cir"){
                            ctx.arc(x,y,wi,0, 2 * Math.PI);
                            ctx.fill();
                            ctx.stroke();
                        }else if(tp == "tri"){
                            xx = x + wi;
                            yy = y + he;

                            ctx.moveTo(x,y);
                            ctx.lineTo(xx,yy);
                            ctx.lineTo(x,yy-y+yy);
                            ctx.lineTo(x,y);
                            ctx.fill();
                            ctx.stroke();
                        }
                    })

                   
                })`
            
            html = `<!DOCTYPE html>
                <html>
                <head>
                    <meta charset="utf-8">
                    <title></title>
                    <style>
                        *{margin: 0; padding: 0; border:none; box-sizing: border-box; -webkit-user-drag:none; user-select:none;}
                        .wrap{width:1100px; margin:0 auto;}
                        #can_box{width:1100px; height: 600px; border:solid 2px #000; margin-top: 20px; position: relative; overflow: hidden; }
                        #can_box canvas{position: absolute; top:0; left: 0;}
                        #can_box img {position:absolute; width:350px; height: 510px;}
                        #can_box video {position:absolute; width:640px; height: 360px;} 
                    </style>
                    <script>${js}</script>
                    <script>${js2}</script>
                </head>
                <body>
                    <div class="wrap">
                        <div id="can_box">${con}</div>
                    </div>
                </body>
                </html>`;

            ob_file = new Blob([html], {type: 'text/html'});
            $(`<a href="${URL.createObjectURL(ob_file)}" download="download.html"></a>`)[0].click();
        })
    })

    $(document).on("click","#save_pdf",function(){ 
        var style = $(`<style>
            @media print {
                .screen, .pdf_hideBox { display: none; }
                #edit_modal { position: absolute !important; width: 1300px !important; }
                #edit_modal > div{  width: 1300px !important; }
                #edit_modal .itemBox {  width: 1300px !important; }
            }
            </style>`);
        $(`body`).prepend(style);

        window.print();
    })

}


function chk_point(e){
    obj = "";
    chk = false;
    for(i=ob_arr.length-1; i>=0; i--){
        temp = ob_arr[i];
        if(temp.ob_type == "media"){
            if(e.target.src){
                if(e.target.id == temp.id){
                   chk = true; 
                }      
            }else{
                x_end = temp.x + temp.wi;
                y_end = temp.y + temp.he;
                if((cl_x >= temp.x && cl_x <= x_end) && (cl_y >= temp.y && cl_y <= y_end)){
                    chk = true;
                }
            }
        } else{
            ctx = document.getElementById(temp.id).getContext("2d");
            d = ctx.getImageData(cl_x, cl_y,1,1);

            if(d.data[3] != 0){ 
                chk = true;  
            }
        }

        if(chk){
            obj = temp;
            obj.z_idx = z_idx;
            z_idx++;

            x_gap = cl_x - obj.x; 
            y_gap = cl_y - obj.y;
            
            if(obj.ob_type == "media" && e.target.src){
                x_gap = cl_x;
                y_gap = cl_y;
            }else if(obj.ob_type == "line"){
                x_gap = cl_x - obj.x[0];
                y_gap = cl_y - obj.y[0];
            }

            break;
        }   
    }
    can_sort();
}

function can_sort(){
    ob_arr.sort(function (a,b){
        return a.z_idx > b.z_idx ? 1 : -1;  
    });

    ob_arr.forEach(function (ele,ind){
        $(`#${ele.id}`).css({'z-index':ele.z_idx});
    });
    re_draw(); 
}

function re_draw(){
    $("#can_box canvas, #can_box img, #can_box video").hide();
   
    ob_arr.forEach(function(ele,ind){
        tp = ele.ob_type;
        id = ele.id;

        if(tp != "media"){
            ctx = document.getElementById(ele.id).getContext('2d');
            ctx.clearRect(0,0,1100,600);
            ctx.textBaseline = "top";
            ctx.beginPath();
            
                ctx.strokeStyle = ele.line_color;
                ctx.fillStyle = ele.fill_color;
                ctx.lineWidth = ele.line_width;
                ctx.font = `${ele.font_size}px Arial`;  
        }

        if(tp == "txt"){
            tt = ele.txt.split("\n");
            yy = ele.y;
            for(i=0; i<tt.length; i++){
                if(obj.id == id){
                    ctx.lineWidth = 1;
                    ctx.strokeStyle="red"; 
                    ctx.strokeText(tt[i].trim(),ele.x,yy); 
                }
                ctx.fillText(tt[i].trim(),ele.x,yy);
                yy += 20;
            }
            ctx.closePath();
        }else if(tp == "line"){
            if(obj.id == id){
                ctx.strokeStyle="red";
                ctx.lineWidth = Number(ele.line_width) + 4;
                ctx.moveTo(ele.x[0],ele.y[0])
                
                for(i=1; i<ele.x.length; i++){
                    ctx.lineTo(ele.x[i],ele.y[i]);
                }
                ctx.stroke();
            }
            ctx.strokeStyle= ele.line_color;
            ctx.lineWidth = ele.line_width;
            ctx.moveTo(ele.x[0],ele.y[0])
            for(i=1; i<ele.x.length; i++){
                ctx.lineTo(ele.x[i],ele.y[i]);
            }
            ctx.stroke();
        }else if(tp == "rect"){
            if(obj.id == id){
                ctx.lineWidth = Number(ele.line_width) + 4;
                ctx.strokeStyle = "red";
                ctx.rect(ele.x,ele.y,ele.wi,ele.he);
                ctx.fill();
                ctx.stroke();
            }
            ctx.lineWidth = ele.line_width;
            ctx.strokeStyle = ele.line_color;
            ctx.rect(ele.x,ele.y,ele.wi,ele.he);
            ctx.fill();
            ctx.stroke();
        }else if(tp == "cir"){
            if(obj.id == id){
                ctx.lineWidth = Number(ele.line_width) + 4;
                ctx.strokeStyle = "red";
                ctx.arc(ele.x,ele.y,ele.wi,0, 2 * Math.PI);
                ctx.fill();
                ctx.stroke();
            }
            ctx.lineWidth = ele.line_width;
            ctx.strokeStyle = ele.line_color;
            ctx.arc(ele.x,ele.y,ele.wi,0, 2 * Math.PI);
            ctx.fill();
            ctx.stroke();
        }else if(tp == "tri"){
            xx = ele.x+ele.wi;
            yy = ele.y+ele.he;
            
            if(obj.id == id){
                ctx.lineWidth = Number(ele.line_width) + 4;
                ctx.strokeStyle = "red";
                ctx.moveTo(ele.x,ele.y);
                ctx.lineTo(xx,yy);
                ctx.lineTo(ele.x,yy-ele.y+yy);
                ctx.lineTo(ele.x,ele.y);
                ctx.fill();
                ctx.stroke();
            }
            ctx.lineWidth = ele.line_width;
            ctx.strokeStyle = ele.line_color;
            ctx.moveTo(ele.x,ele.y);
            ctx.lineTo(xx,yy);
            ctx.lineTo(ele.x,yy-ele.y+yy);
            ctx.lineTo(ele.x,ele.y);
            ctx.fill();
            ctx.stroke();
        }else if(tp == "media"){ 

            $(`#${id}`).css("left",ele.x+"px");
            $(`#${id}`).css("top",ele.y+"px");

            if(obj.id == id){
                $(`#${id}`).css("outline","solid 2px red");
            }else{
                $(`#${id}`).css("outline","none")
            }
        }
        $(`#${id}`).show();
    })

}


function mk_list(){
    $.getJSON('/data/book.json', function(res){
        
        book_data = res;
        html = "";

        obj = "";
        mode = "";
        z_idx = 0;
        move_ok = false;
        line_color = $("#line_color").val();
        fill_color = $("#fill_color").val();
        line_width = $("#line_width").val();
        font_size = $("#font_size").val();

        can_arr = [];  

        res.forEach(function (ele,ind){

            page = 0;

            html += `<div class="item cu m-4" style="min-height: 200px; height: 550px; width: 350px;" data-idx="${ind}">
                          <div class=" col-12 h-100 m-2 boxsh d-flex justify-content-between align-items-end por bg-white" style="min-height: 200px;">
                            <div class="card-img-top col-12 ov cu d-flex fl-cc" style="height: 300px; ">
                                <img class="h-100 hv_sc12" src="/data/${ele.image}" alt="Card image cap">
                            </div>
                            <div class="card-body col-12 p-2">
                              <h5 class="card-title font-weight-bold cu><i class="fa fa fa-bookmark-o ml-2 mr-2"></i>책 제목: ${ele.name}</h5>
                              <p class="card-text cu><i class="fa fa fa-tag ml-2 mr-2"></i>장르: <span class="searchTarget" data-type="category">${ele.category}</span></p>
                            </div>
                            <div class="card-footer col-12 p-3 bg-light d-flex justify-content-between align-items-center">
                                <div class=""><span class="badge badge-warning fc1 p-1 ml-1 mr-1">작가</span><span class="searchTarget" data-type="writer">${ele.writer}</span></div>
                                <div class=""><span class="badge badge-warning fc1 p-1 ml-1 mr-1">출판사</span>${ele.company}</div>
                            </div>
                          </div>
                      </div>`;


            can_arr[ind] = []; 

            can_arr[ind][page] = []; 

            id = Date.now() + Math.round(Math.random()*10000000000000); 

            img_ind = ind + 1;

            tmp = {
                    'id' : id,
                    'ob_type' : 'media',
                    'txt' : "",
                    'x' : 10,
                    'y' : 10,
                    'wi' : 350,
                    'he' : 510,
                    'line_color' : line_color,
                    'fill_color' : fill_color,
                    'line_width' : line_width,
                    'font_size' : font_size,
                    'z_idx' : z_idx
                }

            can_arr[ind][page].push(tmp);
            
            $("#can_box").append(`<img id="${id}" src="/data/${img_ind}.jpg" class="poa" style="width: 350px; height:510px;">`);

            page++;
            can_arr[ind][page] = [];

            id = Date.now() + Math.round(Math.random()*10000000000000);
            txt =  `2020전주독서대전
                    What is Lorem Ipsum?
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
                    when an unknown printer took a galley of type and scrambled it to make a type specimen book. 
                    It has survived not only five centuries, but also the leap into electronic typesetting, 
                    remaining essentially unchanged. 
                    It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum 
                    passages, and more recently with desktop publishing software like Aldus PageMaker including 
                    versions of Lorem Ipsum.
                    
                    Why do we use it?
                    It is a long established fact that a reader will be distracted by the readable content of a 
                    page when looking at its layout. 
                    The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters,
                     as opposed to using 'Content here, content here', making it look like readable English. 
                    Many desktop publishing packages and web page editors now use Lorem Ipsum as their default 
                    model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. 
                    Various versions have evolved over the years, sometimes by accident, sometimes on purpose 
                    (injected humour and the like).`;

            tmp = {
                    'id' : id,
                    'ob_type' : 'txt',
                    'txt' : txt,
                    'x' : 10,
                    'y' : 10,
                    'wi' : "",
                    'he' : "",
                    'line_color' : line_color,
                    'fill_color' : fill_color,
                    'line_width' : line_width,
                    'font_size' : font_size,
                    'z_idx' : z_idx
                }

            can_arr[ind][page].push(tmp);
            $("#can_box").append(`<canvas width="1100" height="600" id="${id}" class="poa"></canvas>`);

            page++;
            can_arr[ind][page] = [];

            id = Date.now() + Math.round(Math.random()*10000000000000);

            tmp = {
                    'id' : id,
                    'ob_type' : 'media',
                    'txt' : "",
                    'x' : 10,
                    'y' : 10,
                    'wi' : 640,
                    'he' : 360,
                    'line_color' : line_color,
                    'fill_color' : fill_color,
                    'line_width' : line_width,
                    'font_size' : font_size,
                    'z_idx' : z_idx
                }

            can_arr[ind][page].push(tmp);
            $("#can_box").append(`<video id="${id}" src="/data/ex.mp4" class="poa" width="640" height="360"></video>`);

        }) // end forEach

        $("#listBox").html(html);
    })
}



//검색
function search() {
    var choArr = function() {
        return ["ㄱ","ㄲ","ㄴ","ㄷ","ㄸ","ㄹ","ㅁ","ㅂ","ㅃ","ㅅ","ㅆ","ㅇ","ㅈ", "ㅉ", "ㅊ","ㅋ","ㅌ","ㅍ","ㅎ"];
    }
    var choHan = function(str) {
        var result = "";
        var cho = choArr();
        for(var i=0; i<str.length; i++) {
            code = str.charCodeAt(i) - 44032;
            if(code > -1 && code < 11172) {
                result += cho[Math.floor(code/588)];
            }
        }
        return result;
    }
    var keyword = $('.searchInput').val();
    $('#bookBox .item').show().filter(function(){
        var str = [];
        var obj = $(this).find('.searchTarget');
        if(!obj.length) return false;
        obj.filter(function(e) {

            $(this).text( $(this).text().replace(/mark/, "$1") );

            var type = $('#s_type').val();
            var s_type = $(this).attr('data-type');

            if(type != s_type && type) { 
                return false;
            } 

            var text = $(this).text(); 
            for(var i=0; i<text.length; i++) { 
                var word = text.substr(i, keyword.length);
                var tempWord = [];
                if(keyword != word) {
                    for(var j=0; j<word.length; j++) {
                        var chk = true;
                        if($.inArray(keyword[j], choArr()) == -1) {
                            chk = false;
                        } else if(keyword[j] != choHan(word[j])) {
                            chk = false;
                        }
                        if(chk || keyword[j] == word[j]) {
                            tempWord.push(word[j]);
                        }
                    }
                    var tempWordJoin = tempWord.join("");
                    if(tempWordJoin.length == keyword.length) {
                        str.push(tempWordJoin);
                    }
                } else {
                    str.push(word);
                }
            }
            var strJoin = str.join("|");
            var re = new RegExp('('+strJoin+')', 'gi');
            var mark = text.replace(re, "<mark>$1</mark>");
            $(this).html(mark); 
        })
        if(!str.length) {
            $(this).hide();
        }
    })

}













