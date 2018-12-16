
/**/
if(window.location.href.substring(0,8)!="file:///" && window.location.href.substring(0,17)!="http://localhost/" && window.location.href.substring(0,17)!="http://127.0.0.1/"){

    /**/
    //var Ip_script = document.createElement("script");
    //Ip_script.src ="http://whois.pconline.com.cn/ipJson.jsp?callback=ttkefuIpJson&ip=";
    //document.getElementsByTagName("HEAD")[0].appendChild(new_script);
    /*强制留名*/
    var ttkefu_isleave_name="False";
    /**/
    var ttkefu_limitwbsite="",ttkefu_pageurl="",ttkefu_pageurl1="",ttkefu_pagetitle="",ttkefu_pagetitle1="",ttkefu_Ut="",ttkefu_minipagetitle="";

    function setCookie(name,value,time)
    {
        var strsec = getsec(time);
        var exp = new Date();
        exp.setTime(exp.getTime() + strsec*1);
        document.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString();
    };
    function getsec(str)
    {
        var str1=str.substring(1,str.length)*1;
        var str2=str.substring(0,1);
        if (str2=="s")
        {
            return str1*1000;
        }
        else if (str2=="h")
        {
            return str1*60*60*1000;
        }
        else if (str2=="d")
        {
            return str1*24*60*60*1000;
        };
    };
    function getCookie(name)
    {
        var offset = document.cookie.indexOf(name + "=");
        if (offset != -1)
        {
            offset += name.length + 1;
            var end = document.cookie.indexOf(";", offset);
            if (end == -1)
            {
                end = document.cookie.length;
            }
            return document.cookie.substring(offset, end);
        }
        else
        {
            return "";
        };
    };

    function getlailu(){
        var url=document.referrer;
        var reg=new RegExp("http://","g");
        url=url.replace(reg,"");
        var righturl=url.split("/");
        return righturl[0]
    }
    function getQueryString(url,name){
        if(url==undefined || url==null || url.length<3)return null;
        var pt="?"+name+"=";
        var index;
        index=url.indexOf(pt);
        if(index<0){
            pt="&"+name+"=";
            index=url.indexOf(pt);
            if(index<0)return null
        }
        var url1=url.substring(index+pt.length);
        index=url1.indexOf("&");
        var temp=index<0?url1:url1.substring(0,index);
        return temp
    }
    function getKeyword(){
        var url=document.referrer,reg=new RegExp("http://","g"),keyword="";
        url=url.replace(reg,"");
        var keywordsname = {s0:"word",s1:"q",s2:"p",s3:"w",s4:"query",s5:"name",s6:"_searchkey",s7:"wd",s8:"bs"};
        for(var one in keywordsname){
            keyword=getQueryString(url,keywordsname[one])
            if(keyword!=null&&keyword!="") return keyword
        }
        if(keyword="") return null
    }
    var src1,sjs,ttmp,lailu,guanjianzi;
    lailu=getlailu();
    guanjianzi=getKeyword();
    if(typeof(guanjianzi)=="undefined")guanjianzi="";
    if (getCookie("kfltjs")=="") {
        sjs=161012437292;
        setCookie("kfltjs",sjs,"d3000");
    } else{
        sjs=""+getCookie("kfltjs")+"";
    };
    var ttkefu_city="";
    if (getCookie("mmaain")==document.domain&&getCookie("kuse")=="24446"){
        mmaain=document.domain;
        setCookie("mmaain",mmaain,"s20");
        setCookie("kuse","24446","d1");
        src1="";
    }else{
        mmaain=document.domain;
        setCookie("mmaain",mmaain,"s20");
        setCookie("kuse","24446","d1");
        var Mreferrer=document.referrer;
        if(Mreferrer.length>200){
            Mreferrer=Mreferrer.substring(0,200)+"...";
        }
        src1="http://w1.ttkefu.com/online.jsp?k=25253&lailu="+Mreferrer+"&urll="+encodeURIComponent(document.location.href)+"&tS4wJ7="+sjs+"&t5Ys2R=24446&fid=9575&guanjianzi="+guanjianzi;

    }
    function ttkefuIpJson(MsgData){


    }


    document.write("<iframe id='ttkefu_by' name='by' xyz='0' style='display:none;' frameborder='0' width='0' height='0' src='"+src1+"'  ></iframe>");
    /*获取浏览器版本*/
    function ttkefu_getBrowserInfo(){
        var Sys = {};
        if(!!window.ActiveXObject || "ActiveXObject" in window)
        {
            Sys.browser ="msie";
            Sys.ver ="11";
        }else{
            var ua = navigator.userAgent.toLowerCase();
            var re =/(msie|firefox|chrome|opera|version).*?([\d.]+)/;
            var m = ua.match(re);
            Sys.browser = m[1].replace(/version/, "'safari");
            Sys.ver = m[2];
        }

        return Sys;
    }


    function tana(dkfs){




        window.open("http://w1.ttkefu.com/conversationormessage/ourcustomerservice/customerlist/app/chatClient_xuanze.jsp?u=9575&tS4wJ7="+sjs+"&kfid=25253&fgid=9575&s2N6eL=24446&isshowstyle=1&dkfs="+dkfs+"&Purl="+ttkefu_pageurl+"&Pt="+ttkefu_pagetitle,"24446","top=0,left=100,width=700,height=539,scrollbars=no,resizable=yes,status=no,z-look=yes,alwaysRaised=yes,location=no,depended=no,center:yes")

    }
    function randtantel(){
        var iLeft = (window.screen.availWidth-330)/2;

        window.open("http://w1.ttkefu.com/conversationormessage/ourcustomerservice/customerlist/randtel.jsp?u=9575&tS4wJ7="+sjs+"&kfid=25253&fgid=9575&s2N6eL=24446&isshowstyle=1&dkfs=tel","24446","top=200,left="+iLeft+",width=320,height=450,scrollbars=no,resizable=yes,status=no,z-look=yes,alwaysRaised=yes,location=no,depended=no,center:yes")
    }

    function ttkefu_randtantel(){
        var iLeft = (window.screen.availWidth-330)/2;

        window.open("http://w1.ttkefu.com/conversationormessage/ourcustomerservice/customerlist/randtel.jsp?u=9575&tS4wJ7="+sjs+"&kfid=25253&fgid=9575&s2N6eL=24446&isshowstyle=1&dkfs=tel","24446","top=200,left="+iLeft+",width=320,height=450,scrollbars=no,resizable=yes,status=no,z-look=yes,alwaysRaised=yes,location=no,depended=no,center:yes")
    }

    function listtana(weburl,nicheng){
        var str=weburl;

        /*新窗口*/
        if(str.substr(str.indexOf("=")+1,str.indexOf("&")-str.indexOf("=")-1)==mini_dialog.zhidingkefu)
        {
            /*新窗口客服与迷你窗口客服相同则关闭迷你窗口*/
            mini_dialog.isfirst=-1;
            mini_dialog.closewindow();
        }
        window.open(weburl,"24446","top=0,left=100,width=700,height=539,scrollbars=no,resizable=yes,status=no,z-look=yes,alwaysRaised=yes,location=no,depended=no,center:yes")


    }

    function tanb(kuid,use,dkfs,nicheng){



        try{
            var win=window.open('http://w1.ttkefu.com/conversationormessage/ourcustomerservice/customerlist/app/chatClient_chatbox.jsp?R5s6eT='+kuid+'&t5Ys2R=24446&fgid=9575&s2N6eL='+use+'&tS4wJ7='+sjs+'&dkfs='+dkfs+"&Purl="+ttkefu_pageurl+"&Pt="+ttkefu_pagetitle,'','top=120,left=200,width=700,height=539,scrollbars=no,resizable=yes,status=no,z-look=yes,alwaysRaised=yes,location=no,depended=no,center:yes');
            if(win==null){
                window.location.href='http://w1.ttkefu.com/conversationormessage/ourcustomerservice/customerlist/app/chatClient_chatbox.jsp?R5s6eT='+kuid+'&t5Ys2R=24446&fgid=9575&s2N6eL='+use+'&tS4wJ7='+sjs+'&dkfs='+dkfs+"&Purl="+ttkefu_pageurl+"&Pt="+ttkefu_pagetitle;
            }
        }catch(e){
            window.location.href='http://w1.ttkefu.com/conversationormessage/ourcustomerservice/customerlist/app/chatClient_chatbox.jsp?R5s6eT='+kuid+'&t5Ys2R=24446&fgid=9575&s2N6eL='+use+'&tS4wJ7='+sjs+'&dkfs='+dkfs+"&Purl="+ttkefu_pageurl+"&Pt="+ttkefu_pagetitle;
        }


    }

    function tanac(str,dkfs){

        window.open("http://w1.ttkefu.com/conversationormessage/ourcustomerservice/customerlist/app/chatClient_xuanze.jsp?u=9575&tS4wJ7="+sjs+"&kfid=25253&zixun="+encodeURIComponent(str)+"&fgid=9575&s2N6eL=24446&dkfs="+dkfs+"&Purl="+ttkefu_pageurl+"&Pt="+ttkefu_pagetitle,"24446","top=0,left=100,width=700,height=539,scrollbars=no,resizable=yes,status=no,z-look=yes,alwaysRaised=yes,location=no,depended=no,center:yes")

    }

    function tanbc(kuid,use,str,dkfs){

        try{
            var win=window.open('http://w1.ttkefu.com/conversationormessage/ourcustomerservice/customerlist/app/chatClient_chatbox.jsp?R5s6eT='+kuid+'&t5Ys2R=24446&zixun='+encodeURIComponent(str)+'&fgid=9575&s2N6eL='+use+'&tS4wJ7='+sjs+'&dkfs='+dkfs+"&Purl="+ttkefu_pageurl+"&Pt="+ttkefu_pagetitle,'24446','top=120,left=200,width=700,height=539,scrollbars=no,resizable=yes,status=no,z-look=yes,alwaysRaised=yes,location=no,depended=no,center:yes');
            if(win==null){
                window.location.href='http://w1.ttkefu.com/conversationormessage/ourcustomerservice/customerlist/app/chatClient_chatbox.jsp?R5s6eT='+kuid+'&t5Ys2R=24446&zixun='+encodeURIComponent(str)+'&fgid=9575&s2N6eL='+use+'&tS4wJ7='+sjs+'&dkfs='+dkfs+"&Purl="+ttkefu_pageurl+"&Pt="+ttkefu_pagetitle;
            }
        }catch(e){
            window.location.href='http://w1.ttkefu.com/conversationormessage/ourcustomerservice/customerlist/app/chatClient_chatbox.jsp?R5s6eT='+kuid+'&t5Ys2R=24446&zixun='+encodeURIComponent(str)+'&fgid=9575&s2N6eL='+use+'&tS4wJ7='+sjs+'&dkfs='+dkfs+"&Purl="+ttkefu_pageurl+"&Pt="+ttkefu_pagetitle;
        }

    }

    function tantel(s,dkfs){
        var iLeft = (window.screen.availWidth-330)/2;
        window.open(s+"&fgid=9575&dkfs="+dkfs,"_blank","top=200,left="+iLeft+",width=320,height=450,align=center,crollbars=no,resizable=yes,status=yes,z-look=yes,alwaysRaised=yes,location=no,depended=no,center:yes");
    }

    var isfrist="",mini_cytime,timerkkff,times2;
    function onner(){
        var ycurl="http://w1.ttkefu.com/yc.jsp?k=24446&j="+sjs+"&f=9575&r="+encodeURIComponent(document.location.href)+"&s="+Math.random();
        if(isfrist==""){
            var Onner_Referrer=document.referrer;
            if(Onner_Referrer.length>200){
                Onner_Referrer=Onner_Referrer.substring(0,200)+"...";
            }
            if(Onner_Referrer.indexOf("https://www.baidu.com")>=0){
                Onner_Referrer="https://www.baidu.com";
            }

            ycurl="http://w1.ttkefu.com/yc.jsp?k=24446&t="+encodeURIComponent(document.title)+"&j="+sjs+"&f=9575&r="+encodeURIComponent(document.location.href)+"&g="+guanjianzi+"&s="+Math.random()+"&l="+Onner_Referrer;
            isfrist="1";
        }

        mmaain=document.domain;
        setCookie("mmaain",mmaain,"s20");
        var new_script = document.createElement("script");
        new_script.src = ycurl;
        document.getElementsByTagName("HEAD")[0].appendChild(new_script);

        setTimeout("onner()",18000);

    }
    function ttkefu_hide(str){
        document.getElementById(str).style.display='none'
    }
    function TTclosedivname(str)
    {
        if(document.getElementById(str)!=null){
            document.getElementById(str).style.display="none";
        }
    }
///
    var ttkefu_flashVideoPlayer;
//连接
    function ttkefu_connection_s(url){
        var ie = navigator.appName.indexOf("ttkefu_Microsoft") != -1;
        ttkefu_flashVideoPlayer = (ie) ? window['ttkefu_Mchannel_Fid'] : document['ttkefu_Mchannel_Fid'];
        ttkefu_flashVideoPlayer.ttkefu_connection_s(url);
    }
//调用flash
    function ttkefu_sendMessage(){
        ttkefu_flashVideoPlayer.ttkefu_sendMessage("PRIV|"+ttkefu_Mchannel.lguseid+"|"+ttkefu_Mchannel.receivers+"|"+ttkefu_Mchannel.txt+"|");
    }
//flash调用
    function ttkefu_send2JS(mymsg){

        if(mymsg=="ttkefu_flash_connection_s_ok"){
            ttkefu_flashVideoPlayer.ttkefu_sendMessage("flash请求连接服务器");
        }else if(mymsg=="ttkefu_flash_connection_s_fail" || mymsg=="ttkefu_flash_send_error"){
            //3秒后重连
            ttkefu_Mchannel.ResetLink({err:"833",tishi:"连接失败"});
        }else{
            //已经与服务器建立了连接
            if(mymsg=="$ttkefu_flash_link_ok$"){
                //账号登陆
                ttkefu_Mchannel.LgServer();
            }else if(mymsg=="login=ok"){
                document.getElementById("ttkefu_mini_tishi_parent").style.display='none';
                //对话建立提醒
                ttkefu_Mchannel.lg=true;
                document.getElementById("sendMsgTxt_chat").removeAttribute("readonly");
                ttkefu_Mchannel.Send("shengchengduihua");
                ttkefu_Mchannel.TT_shengcheng=ttkefu_Mchannel.TT_shengcheng+1;
            }else if(mymsg.indexOf("ttkefu_kaiqiyuzhi")>=0){
                ttkefu_Mchannel.pme=true;
            }else if(mymsg.indexOf("ttkefu_guanbiyuzhi")>=0){
                ttkefu_Mchannel.pme=false;
            }else if(mymsg.indexOf("ttkefu_kaiqiLisWriting")>=0){
                ttkefu_Mchannel.LisWriting=true;
            }else if(mymsg.indexOf("ttkefu_guanbiLisWriting")>=0){
                ttkefu_Mchannel.LisWriting=false;

            }else if(mymsg.indexOf("you_jieshuduihua_hao")>=0){
                ttkekfu_yhAutoCloseTalkTs();

            }else if(mymsg.indexOf("ttkefu_xiaoxiyuzhi")>=0){
                //访客正在输入提示
                document.getElementById("ttkefu_minit0").style.display='none';
                document.getElementById("ttkefu_minit1").style.display='';

                if(mymsg!="Fangkechats=ttkefu_xiaoxiyuzhi"){
                    mini_dialog.getmsg({HH:"910"});
                }
            }else if(mymsg.indexOf("ttkefu_blur")>=0){
                //访客正在输入关闭
                document.getElementById("ttkefu_minit0").style.display='';
                document.getElementById("ttkefu_minit1").style.display='none';

                if(mymsg!="Fangkechats=ttkefu_blur"){
                    mini_dialog.getmsg({HH:"918"});
                }
            }else if(mymsg.length>1){
                mini_dialog.getmsg({HH:"921"});
            }

        }
        ttkefu_Mchannel.SendXTiaoTime1=new Date();
        document.getElementById("ttkefusocketdiv").innerHTML=mymsg;
    }
    var ttkefu_ws,ttkefu_xmlHttp;
    var ttkefu_Mchannel={
        types:0,
        firstload:0,
        firststr:"",
        ws:null,
        reset_i:0,
        rec_mode:168,
        senders:"",
        receivers:"",
        lguseid:"",
        txt:"",
        isrun:false,
        device:0,
        pushtype:0,
        pushi:0,
        pushlist:new Array(),
        pushsound:1,
        pme:false,
        /*客服是否有预知操作*/
        socyz:"",
        dhpush:false,
        uid:0,
        apns:"",
        Plink:"http://47.105.108.112:8010",
        ipp:"47.105.108.112",
        Ci:"",
        Si:"",
        lg:false,
        nowtime:new Date(),
        zxtime:new Date(),
        LisWriting:false,
        IsSendWriting:false,
        TT_shengcheng:0,
        XinTiaoTime:0,
        SendXTiaoTime0:new Date(),
        SendXTiaoTime1:new Date(),
        ResetLinkTime:0,
        /*是否执行了退出操作*/
        ExitState:0,
        /*是否处于对话提示中*/
        TalkTs:0,



        initialize:function(lguseid,receivers,rec_mode){
            //消息预知是否开启

            //初始化
            this.lguseid=lguseid;
            this.receivers=receivers;
            this.rec_mode=rec_mode;
            this.isrun=true;

            this.ExitState=0;
            this.TalkTs=0;
            /*输入框设为只读*/
            document.getElementById("sendMsgTxt_chat").removeAttribute("readonly");


            if(window.WebSocket){
                this.SendXTiaoTime0=new Date();
                this.types=1;
                ttkefu_ToggleConnectionClicked();
            }else{
                var fls=this.flashChecker();
                if(fls.f){
                    if(fls.v<9){
                        document.getElementById("ttkefu_mini_tishi_parent").style.display='none';
                    }else{
                        this.SendXTiaoTime0=new Date();
                        this.types=2;
                        setTimeout(function(){ttkefu_connection_s(ttkefu_Mchannel.ipp)},100)
                    }
                }
            }
        },
        LgServer:function(){
            //已经与服务器建立了连接
            ttkefu_Mchannel.SendXTiaoTime1=new Date();
            //登录
            if(this.types==1){
                ttkefu_ws.send("CONN|"+ttkefu_Mchannel.lguseid+"|0|");
            }else if(this.types==2){
                ttkefu_flashVideoPlayer.ttkefu_sendMessage("CONN|"+ttkefu_Mchannel.lguseid+"|0|");
            }

            //对话建立
            if(!ttkefu_Mchannel.dhpush && ttkefu_Mchannel.pushtype==2){
                var dd=new Date();
                var pushtxt=dd.getHours()+":"+dd.getMinutes()+"分,访客给您发送了新对话.";
                ttkefu_Mchannel.PushTxt("5",ttkefu_Mchannel.uid,ttkefu_Mchannel.pushsound,pushtxt);
                ttkefu_Mchannel.dhpush=true;
            }

            //心跳发送
            ttkefu_Mchannel.XinTiaoTime=setTimeout(function(){ ttkefu_Mchannel.SendXinTiao(); },50);
        },
        flashChecker:function(){
            var hasFlash = 0;
            var flashVersion = 0;
            try{
                if (document.all) {
                    var swf = new ActiveXObject('ShockwaveFlash.ShockwaveFlash');
                    if (swf) {
                        hasFlash = 1;
                        VSwf = swf.GetVariable("$version");
                        flashVersion = parseInt(VSwf.split(" ")[1].split(",")[0]);
                    }

                } else {
                    if (navigator.plugins && navigator.plugins.length > 0) {
                        var swf = navigator.plugins["Shockwave Flash"];
                        if (swf) {
                            hasFlash = 1;
                            var words = swf.description.split(" ");
                            for (var i = 0; i < words.length; ++i) {
                                if (isNaN(parseInt(words[i]))) continue;
                                flashVersion = parseInt(words[i]);
                            }
                        }
                    }
                }
            }
            catch(e){

            }
            return { f: hasFlash, v: flashVersion };
        },
        ResetLink:function(MsgData){
            if(mini_dialog.state=="0"){
                //退出检测
                if(this.ExitState==1){
                    return false;
                }
                //与服务器连接断开,重连接中
                ttkefu_Mchannel.lg=false;
                document.getElementById("sendMsgTxt_chat").setAttribute("readonly","true");
                document.getElementById("ttkefu_mini_tishi").innerHTML="连接断开,重连接中["+MsgData.tishi+"]";
                document.getElementById("ttkefu_mini_tishi_parent").style.display='';

                //重连10次失败后，执行轮询
                ttkefu_Mchannel.reset_i=ttkefu_Mchannel.reset_i+1;
                if(ttkefu_Mchannel.reset_i>11){
                    ttkefu_Mchannel.lg=true;
                    document.getElementById("sendMsgTxt_chat").removeAttribute("readonly");
                    ttkefu_Mchannel.types=0;
                    mini_dialog.getmsg({HH:"1035"});
                }else{
                    //与服务器连接断开,3秒后重连
                    clearTimeout(ttkefu_Mchannel.ResetLinkTime);
                    ttkefu_Mchannel.ResetLinkTime=setTimeout(function(){
                        ttkefu_Mchannel.initialize(mini_dialog.chatid,mini_dialog.kfid,ttkefu_Mchannel.rec_mode);
                    },3000)
                }

            }
        },
        /*心跳包发送*/
        SendXinTiao:function(){
            clearTimeout(ttkefu_Mchannel.XinTiaoTime);

            //仅在连接成功后执行
            if(ttkefu_Mchannel.lg){
                //退出检测
                if(this.ExitState==1){
                    return false;
                }
                //心跳检测
                var XTiaoTimeCha=ttkefu_Mchannel.SendXTiaoTime1.getTime()-ttkefu_Mchannel.SendXTiaoTime0.getTime();
                if(Math.floor(XTiaoTimeCha/1000)>120){
                    ttkefu_Mchannel.ResetLink({err:"1076",tishi:"长时间未响应"});
                    return false;
                }
                //心跳发送
                ttkefu_Mchannel.SendXTiaoTime0=new Date();
                if(ttkefu_Mchannel.types==1){
                    ttkefu_ws.send("xintiao|"+ttkefu_Mchannel.lguseid+"|");
                }else if(ttkefu_Mchannel.types==2){
                    ttkefu_flashVideoPlayer.ttkefu_sendMessage("xintiao|"+ttkefu_Mchannel.lguseid+"|");
                }
                /*回调*/
                ttkefu_Mchannel.XinTiaoTime=setTimeout(function(){ ttkefu_Mchannel.SendXinTiao(); },60000);
                //在线访客状态
                mini_dialog.getmsg({HH:"1086"});


            }
        },
        Send:function(txt){
            try{
                this.txt=txt;
                if(this.types==1){
                    ttkefu_ws.send("PRIV|"+this.lguseid+"|"+this.receivers+"|"+txt+"|");
                }else if(this.types==2){
                    ttkefu_sendMessage();
                }else if(this.types==0 && this.device!=1){

                    if(this.receivers==""){
                        this.receivers=mini_dialog.kfid;
                    }


                    var new_script = document.createElement("script");
                    new_script.src ="http://"+ttkefu_Mchannel.ipp+":8009/pumsg.jsp?Myttkefu_fangke=dh_tishi&r="+this.receivers+"&m=fkxiaoxi&x="+Math.random();
                    document.getElementsByTagName("HEAD")[0].appendChild(new_script);

                }
            }
            catch(e){
                setTimeout(function(){
                    if(ttkefu_Mchannel.lg){
                        ttkefu_Mchannel.Send(txt)
                    }
                },500);
            }

        },
        Push:function(MsgType,MsgId){
            if(this.pushtype==2){
                //
                var msg_script = document.createElement("script");
                msg_script.id="msg_script";
                msg_script.src ="http://w1.ttkefu.com/push1.aspx?act="+MsgType+"&d="+MsgId+"&x="+Math.random();
                document.getElementsByTagName("HEAD")[0].appendChild(msg_script);

            }else if(this.pushtype==1){


            }

        },

        PushTxt:function(type,id,sd,txt){
            if(this.pushtype==2 && txt!="undefined" && mini_dialog.imlixian==0){
                txt=this.Ubb2Txt(txt);
                if(txt.length>45){
                    txt=txt.substring(0,45)+"...";
                }
                txt=encodeURI(txt);

                var pmsg_script = document.createElement("script");
                pmsg_script.id="pmsg_script";
                pmsg_script.src =this.Plink+"/Myttkefu_fangke=push&r="+this.apns+"&m="+txt+"&t="+type+"&i="+id+"&s="+sd+"&x="+Math.random();
                document.getElementsByTagName("HEAD")[0].appendChild(pmsg_script);
            }
        },
        YPost:function(url,parameter,callback){
            this.createXMLHttpRequest();
            //ttkefu_xmlHttp.onreadystatechange = callback;
            ttkefu_xmlHttp.open("POST",url,true);
            ttkefu_xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded;");
            ttkefu_xmlHttp.send(parameter);
        },
        createXMLHttpRequest:function(){
            //Mozilla 浏览器（将XMLHttpRequest对象作为本地浏览器对象来创建）
            if(window.XMLHttpRequest){ //Mozilla 浏览器
                ttkefu_xmlHttp = new XMLHttpRequest();
            }else if(window.ActiveXObject) { //IE浏览器
                //IE浏览器（将XMLHttpRequest对象作为ActiveX对象来创建）
                try{
                    ttkefu_xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
                }catch(e){
                    try {
                        ttkefu_xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }catch(e){}
                }
            }
            if(ttkefu_xmlHttp == null){
                //alert("不能创建XMLHttpRequest对象");
                return false;
            }
        },
        /*消息提示:访客等待超时0|访客无回复1|自动断开2*/
        TsId:0,
        InsertTs:function(MsgData){
            try{
                var m=document.createElement("div");
                m.style.margin="0px";
                m.style.padding="0px";
                m.style.width="98%";

                /*消息ID*/
                this.TsId=this.TsId+1;
                /*消息类型*/
                var inserttxt="";
                switch(MsgData.type){

                    case 0:
                        inserttxt="<div align='center' style='overflow:hidden; margin:0px; padding:0px;'><p style='line-height:20px; font-size:12px; color:#889298;text-align:left; margin:8px; display:inline-block; *display:inline; *zoom:1;  padding:8px 16px; background:#e5eaed;'>"+MsgData.TiShi+"</p></div>";
                        break;

                    case 1:
                        inserttxt=mini_dialog.kfhtmlheader+MsgData.TiShi+mini_dialog.kfhtmlfooter+"<div class='ttkefu_jg' style='height:10px;padding:0px; margin:0px;font-size: 9pt; margin: 0px 0px 0px 0px;overflow: hidden; clear:both; '></div>"
                        break;

                    case 2:
                        inserttxt="<div align='center' style='overflow:hidden; margin:0px; padding:0px;'><p style='line-height:20px; font-size:12px; color:#889298;text-align:left; margin:8px; display:inline-block; *display:inline; *zoom:1;  padding:8px 16px; background:#e5eaed;'>"+MsgData.TiShi+"<span style='color:#4e97b9; padding:0px; margin:0px;'>本次对话将在<span id='DJS"+this.TsId+"'>110</span>秒后结束，回复消息将继续对话</span></p></div>";
                        break;
                }
                m.innerHTML=inserttxt;

                document.getElementById("ttkefucontainer").appendChild(m);
                document.getElementById("ttkefucontainer_wrapper").scrollTop=document.getElementById("ttkefucontainer_wrapper").scrollHeight;
                /*状态提示*/
                mini_dialog.clear(timerkkff);
                timerkkff = mini_dialog.show('新消息');
                window.focus();

            }catch(ex){
                //alert(ex.message);
            }

        },
        Ubb2Txt:function(txt){
            //表情替换
            txt=txt.replace(/\[emo\](.+?)\[\/emo\]/ig,'[表情]');
            //图片替换
            txt=txt.replace(/\[img\](.+?)\[\/img\]/ig,'[图片]');
            //超链接替换
            txt=txt.replace(/\[url href='(.+?)'\](.+?)\[\/url\]/ig,'$1');
            //文件替换
            txt=txt.replace(/\[file\](.+?)\[\/file\]/ig,'[文件]');

            return txt;
        },
        IWriting:function(){
            if(this.LisWriting && !this.IsSendWriting){
                ttkefu_Mchannel.Send('ttkefu_xiaoxiyuzhi');
                this.IsSendWriting=true;
            }
        },
        CloseWriting:function(){
            if(this.LisWriting){
                setTimeout(function(){
                    ttkefu_Mchannel.Send('ttkefu_blur');
                    ttkefu_Mchannel.IsSendWriting=false;
                },500);
            }
        },
        Exit:function(){
            this.isrun=false;
            if(this.types>0){
                try{
                    this.Send("tuichu");
                    if(this.types==1){
                        ttkefu_ws.send("EXIT|"+this.lguseid+"|");
                    }else if(this.types==2){
                        ttkefu_flashVideoPlayer.ttkefu_sendMessage("EXIT|"+this.lguseid+"|");
                    }
                }catch(ex){

                }
            }
            /*输入框设为只读*/
            document.getElementById("sendMsgTxt_chat").setAttribute("readonly","true");
            /*标记连接已断开*/
            this.lg=false;
            /*标记已退出*/
            this.ExitState=1;
        }
    }

    function ttkefu_ToggleConnectionClicked(){

        ttkefu_ws = new WebSocket("ws://"+ttkefu_Mchannel.ipp+":8009");//连接服务器
        ttkefu_ws.onopen = function(event){
            //账号登陆
            ttkefu_Mchannel.LgServer();
        };
        ttkefu_ws.onmessage = function(event){
            //获得消息

            if(event.data=="login=ok"){
                //对话建立提醒
                ttkefu_Mchannel.lg=true;
                document.getElementById("sendMsgTxt_chat").removeAttribute("readonly");
                document.getElementById("ttkefu_mini_tishi_parent").style.display='none';
                ttkefu_ws.send("PRIV|"+ttkefu_Mchannel.lguseid+"|"+ttkefu_Mchannel.receivers+"|shengchengduihua|");
                ttkefu_Mchannel.TT_shengcheng=ttkefu_Mchannel.TT_shengcheng+1;
            }else if(event.data.length>1){

                if(event.data.indexOf("ttkefu_kaiqiyuzhi")>=0){
                    ttkefu_Mchannel.pme=true;
                }else if(event.data.indexOf("ttkefu_guanbiyuzhi")>=0){
                    ttkefu_Mchannel.pme=false;
                }else if(event.data.indexOf("ttkefu_kaiqiLisWriting")>=0){
                    ttkefu_Mchannel.LisWriting=true;
                }else if(event.data.indexOf("ttkefu_guanbiLisWriting")>=0){
                    ttkefu_Mchannel.LisWriting=false;
                }else if(event.data.indexOf("you_jieshuduihua_hao")>=0){
                    ttkekfu_yhAutoCloseTalkTs();

                }else if(event.data.indexOf("ttkefu_xiaoxiyuzhi")>=0){
                    //访客正在输入提示
                    document.getElementById("ttkefu_minit0").style.display='none';
                    document.getElementById("ttkefu_minit1").style.display='';

                    if(event.data!="Fangkechats=ttkefu_xiaoxiyuzhi"){
                        mini_dialog.getmsg({HH:"1245"});
                    }
                }else if(event.data.indexOf("ttkefu_blur")>=0){
                    //访客正在输入关闭
                    document.getElementById("ttkefu_minit0").style.display='';
                    document.getElementById("ttkefu_minit1").style.display='none';

                    if(event.data!="Fangkechats=ttkefu_blur"){
                        mini_dialog.getmsg({HH:"1253"});
                    }
                }else{
                    mini_dialog.getmsg({HH:"1256"});
                }


            }
            ttkefu_Mchannel.SendXTiaoTime1=new Date();
            document.getElementById("ttkefusocketdiv").innerHTML=event.data;
        };
        ttkefu_ws.onclose = function(event){
            if(mini_dialog.chatid>0){
                //重连
                ttkefu_Mchannel.ResetLink({err:"1268",tishi:"客户端异常断开"});
            }
        };

    }

    var ttkefu_d=new Date();

//系统消息状态配置
    var ttkefu_fkleavestate="True",ttkefu_fkstaytime=300000*6,ttkefu_fknoreplystate="False",ttkefu_fknoreplytime="300",ttkefu_fkwaitstate="False",ttkefu_fkwaittime="180";
//FkSendTime:访客发送消息时间,FkTimeOut:等待超时延迟函数
    var ttkefu_FkSendTime=new Date(),ttkefu_leavetime=new Date(),ttkefu_FkTimeOut=0;
//KfSendTime:客服回复消息时间,KfTimeOut:等待超时延迟函数
    var ttkefu_KfSendTime=new Date(),ttkefu_KfTimeOut=0;



//访客状态0空闲1对话
    var ttkefu_fk_state=0;
    var mini_dialog={
        display:0,
        chatid:0,
        kfid:0,
        kfname:"",
        khid:0,
        imlixian:0,
        imlixian1:0,
        Timer:'',
        use:'',
        i:0,
        issend:0,
        /*true:对话结束false:对话中*/
        dialog:true,
        ycurl:"",
        yz:0,
        AutoClose_Ok:0,
        isfirst:0,
        iszhuanjie:0,
        windowstate:0,
        exiturl:'',
        zhidingkefu:0,
        state:'0',
        p:'0',
        waitno:'0',
        getmsg_i:0,
        location:'',
        kup:0,
        n:'0',
        id:0,
        mini_zs:'0',
        /*接待访客设置*/
        duihuaxuanze:1,
        statemsg:'<div id="ttkefu_closetsdiv" class="ttkefu_closetsdiv" style="padding:0px; margin:0 auto; text-align:center; overflow:hidden;background:#e5eaed; font-size:9pt; height:32px; line-height:32px; color:#ff0000;width:200px; border-radius:4px;">当前对话已结束！</div>',
        title:document.title,
        titlebg:'#6BC1FA',
        fontcolor:'#FFFFFF',
        jstime:'2018-12-16 10:53:42',
        tshtmlheader:'<div style=" width:85%; float:left; padding:; margin:0px;font-size: 9pt;overflow: hidden; "><div id="tt_kefdiv" style="padding:0px; margin:0px;float: left;margin-left: 5px; padding:1px 0px 0px 0px; max-width: 100%; min-height: 22px;min-width: 60px;"><div style="position: relative;padding:0px; margin:0px;"><div style="padding:0px; margin:0px;background-color: #FFF69B; border: 1px solid #c0ad20;border-radius: 5px 5px 5px 5px;box-shadow: 0 1px 0 #DBDBDB; "><div style="padding:0px; margin:0px;background-color: #fff69b;border-radius: 5px 5px 5px 5px; color: #030303;  min-height: 20px; min-width: 37px;overflow: hidden;padding:4px 3px 4px 7px;text-align: left; word-break: break-all; word-wrap: break-word;">',
        tshtmlfooter:'</div></div><div style="padding:0px; margin:0px;background: url(http://w1.ttkefu.com/images/yellow_arrow.png) no-repeat;height: 24px;left: -3px;position: absolute; top: 11px; width: 13px;"></div></div></div></div>',
        fkhtmlheader:"<div style='width:85%; float:right;padding:0px; margin:0px;font-size: 9pt;overflow: hidden; '><div id='tt_fkdiv' style='padding:0px; margin:0px;float: right;margin-right: 8px;max-width: 100%;min-height: 22px;min-width: 60px;'><div style='position: relative; padding:0px; margin:0px;'><div style='padding:0px; margin:0px;background-color: #6bc1fa;border: 1px solid #6bc1fa;border-radius: 5px 5px 5px 5px;box-shadow: 0 1px 0 #D5D5D5;margin-left: 18px;'><div style='padding:0px; margin:0px;background-color: #6bc1fa; border-radius: 4px 4px 4px 4px; color: #000000; min-width: 37px; overflow: hidden; padding:3px 3px 4px 7px;text-shadow: none; vertical-align: top;word-break: break-all;word-wrap: break-word;'>",
        fkhtmlfooter:"</div></div><div style='padding:0px; margin:0px;background: url(http://w1.ttkefu.com/images/gray_arrow_1.png) no-repeat;height: 24px;position: absolute; right: -10px;top: 11px;width: 13px;'></div></div></div></div>",
        kfhtmlheader:"<div style='width:85%; float:left;padding:0px; margin:0px;font-size: 9pt;overflow: hidden;'><div id='tt_kefdiv' style='padding:0px; margin:0px;float: left;margin-left: 5px;padding:1px 0px 0px 0px; max-width: 100%; min-height: 22px;min-width: 60px;'><div style='position: relative; padding:0px; margin:0px;'><div style='padding:0px; margin:0px; border: 1px solid #dddddd;border-radius: 5px 5px 5px 5px;box-shadow: 0 1px 0 #DBDBDB;'><div style='padding:0px; margin:0px;border-radius: 5px 5px 5px 5px;color: #030303;  min-height: 20px; min-width: 37px;overflow: hidden;padding:4px 3px 4px 7px;text-align: left; word-break: break-all; word-wrap: break-word;'>",
        kfhtmlfooter:"</div></div><div style='padding:0px; margin:0px;background:#ffffff url(http://w1.ttkefu.com/images/green_arrow_1.png) no-repeat;height:8px;left: -4px;position: absolute; top: 11px; width: 11px;'></div></div></div></div>",
        first_to_msg:'',
        lastid:'',
        sendtime:new Date(),
        getCSS:function(obj,style){
            if(window.getComputedStyle){
                return getComputedStyle(obj)[style];
            }
            return obj.currentStyle[style];
        },
        /*删除客服列表*/
        clearKflb:function(){
            if(document.getElementById("ttkefu_KfList_div")){
                var miniP=document.getElementById("ttkefu_KfList_div").parentNode;
                miniP.removeChild(document.getElementById("ttkefu_KfList_div"));
            }
        },
        /*迷你邀请*/
        yaoqing:function(){

            //删除结束对话提示
            var Divlist=document.getElementById("ttkefucontainer").getElementsByTagName("div");
            for(var i=0;i<Divlist.length;i++){
                if(Divlist[i].className=="ttkefu_closetsdiv"){
                    document.getElementById("ttkefucontainer").removeChild(Divlist[i]);
                }
            }

            //去除输入框的只读
            document.getElementById("sendMsgTxt_chat").removeAttribute("readonly");
            //重置对话状态
            mini_dialog.state='0';
            //显示迷你窗口
            document.getElementById('minidialog').style.display='';

        },
        /*生成聊天记录*/
        CreateChats:function(){
            //变量信息
            mini_dialog.state='0';
            //产品信息-产生对话后显示
            setTimeout(function(){ mini_dialog.ShowPrInfo();},1000)
        },
        /*产品信息*/
        ShowPrInfo:function(){
            if("0"=="1" && ttkefu_Curl_limit==1){
                var PJstr='<div align="center"  style="overflow:hidden; margin:0px 0px 8px 0px;padding:5px 8px;" >';
                PJstr=PJstr+'<div  style="background:#ffffff; border:1px #D8DEE2 solid; line-height:20px; font-size:12px; color:#889298;text-align:left;  display:inline-block; *display:inline; *zoom:1; ">';
                PJstr=PJstr+'<table style="height:auto; border:none;" width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td align="left" valign="top" style="padding:10px 8px 0px 8px;"><img src="http://w1.ttkefu.com/images/WxFace.png" width="40" height="40" ></td><td  style="padding:10px 0px 0px 0px;word-wrap: break-word; overflow: hidden; word-break: break-all;" id="ttkefu_ProInfo_span" data="【页面信息】：'+ttkefu_Ut+'" valign="top" ><div style="display:block;white-space:nowrap; overflow:hidden; text-overflow:ellipsis; width:112px;">'+ttkefu_pagetitle+'</div><div style="display:block;white-space:nowrap; overflow:hidden; text-overflow:ellipsis; width:112px;">'+ttkefu_minipagetitle+'</div></td></tr><td colspan="2" align="center" style="padding:5px 0px 10px 0px;"><span  onclick="mini_dialog.fbb()" class="Djsblue" style="cursor:pointer; border:1px #8e664d solid; padding:3px 18px; color:#936045; border-radius:30px;">发送</span></td></table>';

                PJstr=PJstr+'</div>';
                PJstr=PJstr+'</div>';


                var m_Pstr=document.createElement("div");
                m_Pstr.style.margin="0px";
                m_Pstr.style.padding="0px";
                m_Pstr.style.width="98%";

                /*消息类型*/
                m_Pstr.innerHTML=PJstr;

                document.getElementById("ttkefucontainer").appendChild(m_Pstr);
                document.getElementById("ttkefucontainer_wrapper").scrollTop=document.getElementById("ttkefucontainer_wrapper").scrollHeight;
            }
        },
        shakeMove:function(json){
            //声明要进行抖动的元素
            var obj = json.obj;
            //声明元素抖动的最远距离
            var target = json.target;
            //默认值为20
            target = Number(target) || 20;
            //声明元素的变化样式
            var attr = json.attr;
            //默认为'left'
            attr = attr || 'left';
            //声明元素的起始抖动方向
            var dir = json.dir;
            //默认为'1'，表示开始先向右抖动
            dir = Number(dir) || '1';
            //声明元素每次抖动的变化幅度
            var stepValue = json.stepValue;
            stepValue = Number(stepValue) || 2;
            //声明回调函数
            var fn = json.fn;
            //声明步长step
            var step = 0;
            //保存样式初始值
            var attrValue = parseFloat(this.getCSS(obj,attr));
            //声明参照值value
            var value;
            //清除定时器
            if(obj.timer){return;}
            //开启定时器
            obj.timer = setInterval(function(){
                //抖动核心代码
                value = dir*(target - step);
                //当步长值大于等于最大距离值target时
                if(step >= target){
                    step = target
                }
                //更新样式值
                obj.style[attr] = attrValue + value + 'px';
                //当元素到达起始点时，停止定时器
                if(step == target){
                    clearInterval(obj.timer);
                    obj.timer = 0;
                    //设置回调函数
                    fn && fn.call(obj);
                }
                //如果此时为反向运动，则步长值变化
                if(dir === -1){
                    step = step + stepValue;
                }
                //改变方向
                dir = -dir;

            },50);

        },
        fbb:function(){
            document.getElementById("sendMsgTxt_chat").value=document.getElementById("ttkefu_ProInfo_span").getAttribute("data");
            this.sendmsg();
        },
        tohtml:function(str){

            str=str.replace(/\[url/g,"<a target='_blank' href");
            str=str.replace(/\[\/url/g,"</a");

            str=str.replace(/\]/g,">");
            return str;

        },
        /*强制留名检测*/
        qzlm:function(){

            var ttkefu_qzlm_name=document.getElementById("ttkefu_qzlm_name").value;
            if(ttkefu_qzlm_name.length<2 || ttkefu_qzlm_name.length>20){
                return "格式错误,姓名应在2-20个字符之间";
            }


            var ttkefu_qzlm_qq=document.getElementById("ttkefu_qzlm_qq").value;
            if(! /^[0-9]*$/.test(ttkefu_qzlm_qq)){
                return "QQ格式错误";
            }

            var ttkefu_qzlm_phone=document.getElementById("ttkefu_qzlm_phone").value;
            if(! /1[0-9]{10}/.test(ttkefu_qzlm_phone)){
                return "手机格式错误";
            }

            /**/
            ttkefu_isleave_name="False";
            document.getElementById("ttkefu_qzlmDIv").style.display='none';
            document.getElementById("sendMsgTxt_chat").style.display='';

            return "留名："+ttkefu_qzlm_name+"，手机："+ttkefu_qzlm_phone+"，QQ："+ttkefu_qzlm_qq;
        },
        sendmsg:function(){

            /*强制留名检测*/
            if(ttkefu_isleave_name=="True"){

                var qzlmstr=this.qzlm();
                if(qzlmstr.indexOf("格式错误")>0){
                    alert(qzlmstr);
                    return false;
                }
                document.getElementById("sendMsgTxt_chat").value=qzlmstr;
            }

            var sendminitxtmsg=document.getElementById("sendMsgTxt_chat").value;
            sendminitxtmsg=sendminitxtmsg.replace(/\s+/g,'');
            if(sendminitxtmsg==''){
                return false;
            }
            if(this.duihuaxuanze==0 && this.zhidingkefu==0){
                /*生成客服列表*/
                if(document.getElementById("ttkefu_KfList_div")){
                    return false;
                }else{
                    document.getElementById("sendMsgTxt_chat").setAttribute("readonly","true");
                    var new_script = document.createElement("script");
                    //act:err:82
                    new_script.src = "http://w1.ttkefu.com/minimsg.jsp?f=0&zhidingkefu=0&fgid=9575&act=x";
                    new_script.charset="utf-8";
                    document.getElementsByTagName("HEAD")[0].appendChild(new_script);
                    return false;
                }
            }
            //
            clearTimeout(times2);
            var nnntime = new Date();
            var minsec = Date.parse(nnntime) - Date.parse(mini_dialog.sendtime);

            if(minsec<1000&&mini_dialog.i<31 ){
                mini_dialog.i=mini_dialog.i+1;
            }else if(mini_dialog.i>30){
                mini_dialog.i=30;
            }else if(mini_dialog.i>=1){
                mini_dialog.i=mini_dialog.i-1;
            }else{
                mini_dialog.i=0;
            }

            mini_dialog.sendtime=nnntime;
            if(mini_dialog.i>0 ){

                document.getElementById("ttkefu_mini_tishi").innerHTML="操作太过频繁,请"+mini_dialog.i+"秒后再试";
                document.getElementById("ttkefu_mini_tishi_parent").style.display='';
                document.getElementById("sendMsgTxt_chat").setAttribute("readonly","true");
                times2=setTimeout('mini_dialog.sendmsg()',1000)
            } else {
                document.getElementById("ttkefu_mini_tishi_parent").style.display='none';
                document.getElementById("sendMsgTxt_chat").removeAttribute("readonly");

                if(mini_dialog.state=="1"){
                    /*对话已结束*/
                    var m=document.createElement("div");
                    m.id="ttkefu_closetsdiv";
                    m.className="ttkefu_closetsdiv";
                    m.innerHTML=mini_dialog.tshtmlheader+"当前对话已结束！"+mini_dialog.tshtmlfooter+"<div style='height:10px;padding:0px; margin:0px;font-size: 9pt;line-height: 19px;margin: 0px 0px 0px 0px;overflow: hidden; clear:both; ' class='ttkefu_jg'></div>";
                    document.getElementById("ttkefucontainer").appendChild(m);
                    document.getElementById("ttkefucontainer_wrapper").scrollTop=document.getElementById("ttkefucontainer_wrapper").scrollHeight;
                    document.getElementById("sendMsgTxt_chat").value="";
                }else if(document.getElementById("sendMsgTxt_chat").value.length>300){
                    /*聊天文字不能大于300字*/
                    var m=document.createElement("div");
                    m.innerHTML="<div style='padding:0px; margin:0px; text-align:center; overflow:hidden;background:#e5eaed; font-size:9pt; height:28px; line-height:28px; color:#ff0000;'>聊天文字不能大于300字!</div>";
                    document.getElementById("ttkefucontainer").appendChild(m);
                    document.getElementById("ttkefucontainer_wrapper").scrollTop=document.getElementById("ttkefucontainer_wrapper").scrollHeight;
                }else if(document.getElementById("sendMsgTxt_chat").value==""){
                    /*聊天文字不能为空*/
                    var m=document.createElement("div");
                    m.innerHTML="<div style='padding:0px; margin:0px; text-align:center; overflow:hidden;background:#e5eaed; font-size:9pt; height:28px; line-height:28px; color:#ff0000;'>聊天文字不能为空!</div>";
                    document.getElementById("ttkefucontainer").appendChild(m);
                    document.getElementById("ttkefucontainer_wrapper").scrollTop=document.getElementById("ttkefucontainer_wrapper").scrollHeight;
                }else if(document.getElementById("sendMsgTxt_chat").value==""){
                    /*接待访客模式*/

                }else{
                    /*消息发送*/

                    var txtttt=document.getElementById("sendMsgTxt_chat").value;
                    txtttt=txtttt.replace("[emo]","<img alt='表情' src='http://w1.ttkefu.com/images/face/qq/");
                    txtttt=txtttt.replace("[/emo]",".gif' />");
                    var sendtxt="<span>"+txtttt+"</span>";
                    sendtxt=sendtxt.replace(/\r\n/ig,"<br/>") ;
                    sendtxt=sendtxt.replace(/\n/ig,"<br/>") ;
                    //sendtxt=sendtxt.replace(" ","&nbsp;");
                    sendtxt=mini_dialog.tohtml(sendtxt);

                    mini_dialog.id=mini_dialog.id+1;
                    var jsonstr="{\"datalist\":[{\"type\":\"1\",\"msg\":\""+sendtxt+"\",\"id\":\""+mini_dialog.id+"\",\"reffer\":\"0\"}]}";
                    mini_dialog.issend=1;
                    /*form*/

                    /*END---form*/
                    if(document.getElementById("sendMsgTxt_chat").value!=""){
                        var dd=new Date();
                        var sendtxtp=dd.getHours()+":"+dd.getMinutes()+"分,访客:"+document.getElementById("sendMsgTxt_chat").value;                	ttkefu_Mchannel.PushTxt("2",ttkefu_Mchannel.lguseid,ttkefu_Mchannel.pushsound,sendtxtp);
                    }

                    mini_dialog.addtimes();
                    mini_dialog.insertmsg(jsonstr);

                    mini_dialog.getmsg({HH:"1431"});

                    ttkefu_Mchannel.CloseWriting();
                    if(mini_dialog.getmsg_i>0){
                        //连接成功后执行
                    }else{
                        mini_dialog.first_to_msg="{\"datalist\":[{\"type\":\"1\",\"msg\":\""+sendtxt+"\"}]}";
                    }


                }
            }

        },
        getmsg:function(MsgData){
            /*发消息*/
            var sendmsgtxt="",ttkefu_posturl="";
            if(mini_dialog.issend==1 || (false && document.getElementById("sendMsgTxt_chat").value!="")){

                sendmsgtxt=document.getElementById("sendMsgTxt_chat").value;
                sendmsgtxt=sendmsgtxt.replace(/\r\n/ig,"<br/>") ;
                sendmsgtxt=sendmsgtxt.replace(/\n/ig,"<br/>") ;
                // sendmsgtxt=sendmsgtxt.replace(" ","&nbsp;");
                //sendmsgtxt=sendmsgtxt.replace(/\%/g,"%25");

                //仅当点击发送时获取发送内容
                if(mini_dialog.issend==1)
                {
                    ttkefu_posturl="&txt="+escape(sendmsgtxt)+"&txti="+mini_dialog.id;
                }
                if(false && document.getElementById("sendMsgTxt_chat").value!="")
                {
                    ttkefu_posturl=ttkefu_posturl+"&v="+escape(sendmsgtxt);
                }

                //仅当点击发送时清空输入框内容
                if(mini_dialog.issend==1)
                {
                    document.getElementById("sendMsgTxt_chat").value="";
                }

                if(mini_dialog.dialog){
                    mini_dialog.dialog=false;
                    mini_dialog.iarsfirst=2;
                }
            }

            /*首次应先产生对话连接,再发送消息，因发消息post提交，无法更新当前对话状态*/


            if(mini_dialog.chatid>0){
                mini_dialog.getmsg_i=mini_dialog.getmsg_i+1;
                mini_dialog.ycurl="http://w1.ttkefu.com/minimsg.jsp?c="+mini_dialog.chatid+"&f="+mini_dialog.isfirst+"&fgid=9575&ki="+mini_dialog.kfid+"&ku=24446&m=0&minikhid="+mini_dialog.khid+"&w=0&z="+mini_dialog.iszhuanjie+"&zhidingkefu="+mini_dialog.zhidingkefu+"&p="+mini_dialog.p+"&dkfs=5&wp="+mini_dialog.waitno+"&mp="+mini_dialog.n+"&tS4wJ7="+sjs+"&pst="+mini_dialog.issend+ttkefu_posturl+"&l="+ttkefu_Mchannel.types+"&Gl="+MsgData.HH+"&Timer="+mini_dialog.Timer;

            }else{

                mini_dialog.ycurl="http://w1.ttkefu.com/minimsg.jsp?f="+mini_dialog.isfirst+"&tS4wJ7="+sjs+"&kfid=25253&fgid=9575&ki="+mini_dialog.kfid+"&z="+mini_dialog.iszhuanjie+"&zhidingkefu="+mini_dialog.zhidingkefu+"&p="+mini_dialog.p+"&dkfs=5&wp="+mini_dialog.waitno+"&mp="+mini_dialog.n+"&pst="+mini_dialog.issend+"&minikhid="+mini_dialog.khid+ttkefu_posturl+"&Gl="+MsgData.HH;
                mini_dialog.isfirst=2;

            }

            mini_dialog.p='1';
            var new_script = document.createElement("script");
            new_script.src = mini_dialog.ycurl;
            new_script.charset="utf-8";
            document.getElementsByTagName("HEAD")[0].appendChild(new_script);
            mini_dialog.yz=0;
            //重置发送,因post快于连接提交，在连接中用该参数确认为post后的链接提交
            mini_dialog.issend=0;
            clearTimeout(mini_cytime);
            if(ttkefu_Mchannel.types==0){
                mini_cytime=setTimeout("mini_dialog.getmsg({HH:'1501'})",5000);
            }
            //自动断开
            ttkekfu_AutoCloseTalkTs();
        },
        tishifk:function(){
            //客服上线提示imlixian:服务器端更新imlixian1访客端更新
            if(mini_dialog.imlixian1==1 && mini_dialog.imlixian==0){
                var fk_tishimsg='{"datalist":[{"type":"3","msg":"<span style=color:#ff0000;>"+mini_dialog.kfname+"上线了</span>"}]}';
                mini_dialog.insertmsg(fk_tishimsg);

                mini_dialog.imlixian1=0;
            }

        },
        yuzhimsg:function(){

            if(false && mini_dialog.chatid>0 && ttkefu_Mchannel.lguseid!='' && ttkefu_Mchannel.pme ){
                mini_dialog.kup=1;
                ttkefu_Mchannel.Send("ttkefu_xiaoxiyuzhi"+document.getElementById("sendMsgTxt_chat").value);
                mini_dialog.kup=0;
                ttkefu_Mchannel.IsSendWriting=true;
            }
            //发送正在输入
            var sendminitxtmsg=document.getElementById("sendMsgTxt_chat").value;
            sendminitxtmsg=sendminitxtmsg.replace(/\s+/g,'');
            if(sendminitxtmsg!=''){
                ttkefu_Mchannel.IWriting();
            }


        },
        miniwindow:function(){
            if(mini_dialog.windowstate==0)
            {
                document.getElementById("minidialog").style.height="39px";
                document.getElementById("minidialog").style.width="215px";

                document.getElementById("ttkefuminidialogtitle").style.height="44px";
                document.getElementById("ttkefuminidialogtitle").style.lineHeight="34px";
                document.getElementById("ttkefutitle").style.height="39px";
                document.getElementById("ttkefutitle").style.lineHeight="34px";


                document.getElementById("ttkefu_minwindow_min").style.display="none";
                //document.getElementById("ttkefu_minwindow_max").style.background="url(http://w1.ttkefu.com/images/maxmize.gif)  no-repeat";
                document.getElementById("ttkefu_minwindow_max").style.margin="17px 10px 0px 0px";

                document.getElementById("ttkefu_minwindow_close").style.display="none";

                document.getElementById("chat_div_main").style.display="none";
                document.getElementById("cinv_dialogtool").style.display="none";

                setCookie("miniwindowstate","1","d1");
                setTimeout(function(){mini_dialog.windowstate=1;},500);


            }
        },
        insertmsg:function(data){
            if(data!="")
            {
                var json=eval("("+data+")");
                var m=document.createElement("div");
                m.style.margin="0px";
                m.style.padding="0px";
                m.style.width="98%";
                var htmlstr="";
                var TTKfMsg="";
                var KfMsg_ls="";
                //仅针对首次发送消息产生
                for(ji=0;ji<json.datalist.length;ji++)
                {
                    if(json.datalist[ji].type=="1")
                    {
                        if(json.datalist[ji].sendtime)
                        {
                            htmlstr=htmlstr+"<div style='color: #999;font-size: 12px; width:100%; display:block; margin:0px; text-align: center;'>"+json.datalist[ji].sendtime+"</div>";
                        }
                        htmlstr=htmlstr+mini_dialog.fkhtmlheader;
                        if(json.datalist[ji].id){
                            htmlstr=htmlstr+"<div id='ttkefu_d"+json.datalist[ji].id+"' style='position:absolute;left:0px; top:6px; padding:0px; margin:0px; width:16px; height:16px;background:url(http://w1.ttkefu.com/images/loading2.gif);'></div>";
                        }
                        htmlstr=htmlstr+json.datalist[ji].msg+mini_dialog.fkhtmlfooter+"<div class='ttkefu_jg' style='height:10px;padding:0px; margin:0px;font-size: 9pt; margin: 0px 0px 0px 0px;overflow: hidden; clear:both; '></div>";

                    }
                    if(json.datalist[ji].type=="2")
                    {
                        if(json.datalist[ji].sendtime)
                        {
                            htmlstr=htmlstr+"<div style='color: #999;font-size: 12px; width:100%; display:block; margin:0px; text-align: center;'>"+json.datalist[ji].sendtime+"</div>";
                        }

                        KfMsg_ls=json.datalist[ji].msg;
                        if(KfMsg_ls=="<shake1q1w>" ){
                            if(json.datalist.length==1){
                                var ox=document.getElementById("minidialog");
                                mini_dialog.shakeMove({obj:ox,attr:'right'});
                            }
                            KfMsg_ls="发送了一个震动";
                        }
                        htmlstr=htmlstr+mini_dialog.kfhtmlheader+KfMsg_ls+mini_dialog.kfhtmlfooter+"<div class='ttkefu_jg' style='height:10px;padding:0px; margin:0px;font-size: 9pt; margin: 0px 0px 0px 0px;overflow: hidden; clear:both; '></div>";
                    }
                    if(json.datalist[ji].type=="3")
                    {
                        if(document.getElementById("ttkefucontainer").lastChild.innerHTML.indexOf(json.datalist[ji].msg)<0)
                        {
                            htmlstr=htmlstr+"<div style='width:200px; border-radius:4px;padding:0px; margin:5px auto 0px auto; text-align:center; overflow:hidden;background:#e5eaed; font-size:9pt; height:32px; line-height:32px; color:#ff0000;'>"+json.datalist[ji].msg+"</div><div class='ttkefu_jg' style='height:10px;padding:0px; margin:0px;font-size: 9pt; margin: 0px 0px 0px 0px;overflow: hidden; clear:both; '></div>";
                        }
                    }
                    if(json.datalist[ji].type=="4")
                    {
                        htmlstr=htmlstr+"<div  style='color: #999;font-size: 12px;width:100%; display:block; margin-bottom:10px; text-align: center;clear:both;'>"+json.datalist[ji].msg+"</div>";
                    }

                    if(json.datalist[ji].type=="5")
                    {
                        /*--*/
                        while(document.getElementById("ttkefu_pd")){
                            var objdiv=document.getElementById("ttkefu_pd");
                            objdiv.parentNode.removeChild(objdiv);
                        }
                        m.id="ttkefu_pd";
                        htmlstr=htmlstr+"<div style=' border-radius:4px;padding:0px; margin:5px auto 0px auto; text-align:left; overflow:hidden;background:#e5eaed; font-size:9pt; line-height:18px; color:#ff0000;'>"+json.datalist[ji].msg+"</div><div class='ttkefu_jg' style='height:10px;padding:0px; margin:0px;font-size: 9pt; margin: 0px 0px 0px 0px;overflow: hidden; clear:both; '></div>";
                    }

                    if(json.datalist[ji].type=="6")
                    {
                        m.id="ttkefu_KfList_div";
                        htmlstr=htmlstr+"<div style=' border-radius:4px;padding:0px; margin:5px auto 0px auto; text-align:left; overflow:hidden;background:#ffffff; font-size:9pt; line-height:18px; color:#ff0000;' id='ttkefu_KfList'><font style='width:100%;float:left;text-indent:0px; border-bottom:1px #cccccc solid; margin:0px 0px 2px 0px;'>请选择客服</font></div><div class='ttkefu_jg' style='height:10px;padding:0px; margin:0px;font-size: 9pt; margin: 0px 0px 0px 0px;overflow: hidden; clear:both; '></div>";
                        m.innerHTML=htmlstr;
                        document.getElementById("ttkefucontainer").appendChild(m);
                        TTKfMsg=json.datalist[ji].msg;
                        var ttkefuii_zxs=0;
                        for(var ttkefuii=0; ttkefuii<TTKfMsg.length; ttkefuii++){
                            TTKfMsg[ttkefuii].Bh=ttkefuii+1;
                            mini_dialog.CreateKfList(TTKfMsg[ttkefuii]);
                            ttkefuii_zxs=ttkefuii_zxs+1;
                            if(ttkefuii_zxs>0 && ttkefuii_zxs<TTKfMsg.length){
                                mini_dialog.CreateKfList({a:0});
                            }

                        }
                        document.getElementById("ttkefucontainer_wrapper").scrollTop=document.getElementById("ttkefucontainer_wrapper").scrollHeight;
                        return false;
                    }

                    /*reffer:存在临时插入不存在reffer参数.服务器反馈成功 */
                    if(json.datalist[ji].reffer){
                        /*--访客发送消息等成功有时结束不掉，结束倒计时--*/
                        ttkefu_noleave();
                    }else{
                        /*更新离开时间*/
                        ttkefu_noleave();
                    }


                }
                if(htmlstr!="")
                {
                    m.innerHTML=htmlstr;
                    document.getElementById("ttkefucontainer").appendChild(m);
                }
                document.getElementById("ttkefucontainer_wrapper").scrollTop=document.getElementById("ttkefucontainer_wrapper").scrollHeight;
            }
        },
        CreateKfList:function(MsgData){
            var ttkefu_font=document.createElement("font");

            if(MsgData.a>0){
                ttkefu_font.id="ttkefu_font"+MsgData.a;
                ttkefu_font.style.color="#000000";
                ttkefu_font.style.margin="5px 0px 0px 0px";
                ttkefu_font.style.textAlign="center";
                ttkefu_font.style.padding="5px 0px";
                ttkefu_font.style.cursor="pointer";

                ttkefu_font.setAttribute("kf",MsgData.a);
                ttkefu_font.setAttribute("zt",MsgData.c);
                ttkefu_font.setAttribute("nc",MsgData.b);
                ttkefu_font.setAttribute("gh",MsgData.e);

                var ttkefu_font_glbh=MsgData.b,ttkefu_font_zxbz=MsgData.c,ttkefu_font_bm=MsgData.d;
                var ttkefu_font_glbhshow=ttkefu_font_glbh;
                if(ttkefu_font_glbh.length>6){
                    ttkefu_font_glbhshow=ttkefu_font_glbh.substring(0,6)+"...";
                }
                var ttkefu_font_bmshow=ttkefu_font_bm;
                if(ttkefu_font_bm.length>6){
                    ttkefu_font_bmshow=ttkefu_font_bm.substring(0,6)+"...";
                }

                ttkefu_font.innerHTML=ttkefu_font_glbhshow+" <font style='color:#666666;'>["+ttkefu_font_bmshow+"]</font>";

                ttkefu_font.onclick=function(){
                    if(this.getAttribute("zt")=="离线"){
                        listtana('http://w1.ttkefu.com/conversationormessage/ourcustomerservice/customerlist/app/Givemessage.jsp?R5s6eT="+this.getAttribute("kf")+"&t5Ys2R=24446&s2N6eL=this.getAttribute("gh")&fgid=9575&tS4wJ7='+sjs,this.getAttribute("nc"));

                    }else{
                        mini_dialog.zhidingkefu=this.getAttribute("kf");
                        mini_dialog.kfid=mini_dialog.zhidingkefu;
                        //ie不支持remove
                        //document.getElementById("ttkefu_KfList_div").remove(0);

                        var miniP=document.getElementById("ttkefu_KfList_div").parentNode;
                        miniP.removeChild(document.getElementById("ttkefu_KfList_div"));

                        document.getElementById("sendMsgTxt_chat").removeAttribute("readonly");
                        if(document.getElementById("sendMsgTxt_chat").value!=""){
                            document.getElementById("ttkefuMiniSendbtn").click();
                        }else{
                            mini_dialog.getmsg({HH:"1980"});
                        }
                    }

                }

                ttkefu_font.onmouseover=function(){
                    if(this.getAttribute("zt")!="离线"){
                        ttkefu_minwindow_Over(ttkefu_font);
                    }
                }

                ttkefu_font.onmouseout=function(){
                    if(this.getAttribute("zt")!="离线"){
                        ttkefu_minwindow_Out(ttkefu_font);
                    }
                }
            }else{
                //竖线
                ttkefu_font.style.margin="5px 0px 0px 0px";
                ttkefu_font.style.color="#cccccc";
                ttkefu_font.style.textAlign="center";
                ttkefu_font.style.padding="5px 0px";
                ttkefu_font.style.cursor="pointer";
                ttkefu_font.innerHTML=" | ";
            }

            document.getElementById("ttkefu_KfList").appendChild(ttkefu_font);

        },
        maxwindow:function(){
            if(mini_dialog.windowstate==1)
            {
                document.getElementById("minidialog").style.height="auto";
                document.getElementById("minidialog").style.width="236px";


                document.getElementById("ttkefuminidialogtitle").style.height="31px";
                document.getElementById("ttkefuminidialogtitle").style.lineHeight="22px";
                document.getElementById("ttkefutitle").style.height="26px";
                document.getElementById("ttkefutitle").style.lineHeight="22px";

                document.getElementById("ttkefu_minwindow_max").style.margin="10px 0px 0px 0px";



                document.getElementById("ttkefu_minwindow_min").style.display="";
                //document.getElementById("ttkefu_minwindow_max").style.background="url(http://w1.ttkefu.com/images/yxjreply0.gif)  no-repeat";


                document.getElementById("ttkefu_minwindow_close").style.display="";

                document.getElementById("chat_div_main").style.display="";
                document.getElementById("cinv_dialogtool").style.display="";
                mini_dialog.windowstate=0;
                document.getElementById("ttkefucontainer_wrapper").scrollTop=document.getElementById("ttkefucontainer_wrapper").scrollHeight;
                setCookie("miniwindowstate","0","d1");
            }
            else
            {

                /*关闭当前循环以及迷你窗口*/
                document.getElementById('minidialog').style.display='none';
                clearTimeout(mini_cytime);
                /*弹出新窗口*/
                if(mini_dialog.dialog&&mini_dialog.zhidingkefu==0)
                {
                    /*tana('2');*/
                    window.open("http://w1.ttkefu.com/conversationormessage/ourcustomerservice/customerlist/chatClient_xuanze.jsp?u=9575&tS4wJ7="+sjs+"&kfid=25253&fgid=9575&s2N6eL=24446&isshowstyle=1&dkfs=6&Purl="+ttkefu_pageurl+"&Pt="+ttkefu_pagetitle,"24446","top=0,left=100,width=700,height=539,scrollbars=no,resizable=yes,status=no,z-look=yes,alwaysRaised=yes,location=no,depended=no,center:yes")
                }
                else
                {
                    var weburl="http://w1.ttkefu.com/conversationormessage/ourcustomerservice/customerlist/chatClient_chatbox.jsp?R5s6eT="+mini_dialog.zhidingkefu+"&t5Ys2R=24446&s2N6eL="+mini_dialog.use+"&fgid=9575&tS4wJ7="+sjs+"&dkfs=6&Purl="+ttkefu_pageurl+"&Pt="+ttkefu_pagetitle;
                    window.open(weburl,"24446","top=0,left=100,width=700,height=539,scrollbars=no,resizable=yes,status=no,z-look=yes,alwaysRaised=yes,location=no,depended=no,center:yes");
                }


            }
        },
        closetishi:function(){

            if(mini_dialog.isfirst>0)
            {
                document.getElementById("ttkefuminitishiwrapperdiv").style.height="151px";
                document.getElementById("ttkefuminitishi_txt").innerHTML="是否关闭该对话？请您对我的服务给予评价！";
                document.getElementById('ttkefuminitishi').style.display='';
                document.getElementById('ttkefuminitishiwrapper').style.display='';

                document.getElementById('ttkefuminiqueding').onclick=function(){mini_dialog.pingfen();}


            }
            else
            {
                document.getElementById("ttkefuminitishiwrapperdiv").style.height="128px";
                document.getElementById("ttkefuminitishi_txt").innerHTML="结束对话？";
                document.getElementById('ttkefuminitishi').style.display='';
                document.getElementById('ttkefuminitishiwrapper').style.display='';
                document.getElementById('ttkefuminiqueding').onclick=function(){mini_dialog.closewindow();}
            }
        },
        pingfen:function(){

            document.getElementById('ttkefuminitishi').style.display='none';
            document.getElementById('ttkefuminitishiwrapper').style.display='none';

            document.getElementById("ttkefuminitishiwrapperdiv").style.height="238px";
            document.getElementById('minittkefutitletxt').innerHTML='请为客服人员评分！';
            document.getElementById('ttkefuminitishi_close').style.display='none';
            /*document.getElementById('ttkefuminitishi_title').style.fontWeight="normal";*/

            document.getElementById('ttkefuminitxtlimit').style.display='';
            document.getElementById('ttkefuminitishi_txt').innerHTML='<input type="radio" name="ttkefuminirad" checked="checked" value="1" />满意 <input type="radio" name="ttkefuminirad" value="2" />较好 <input type="radio" name="ttkefuminirad" value="3" />一般 <br /><input type="radio" name="ttkefuminirad" value="4" />较差 <input type="radio" name="ttkefuminirad" value="5" />恶劣<br />您的建议<br /><textarea name="ttkefuminitxt" id="ttkefuminitxt" style="height:71px;" cols="20"></textarea>';
            document.getElementById('ttkefuminitishi_txt').style.padding="5px 0px 5px 10px";
            document.getElementById('ttkefuminiquxiao').style.display="none";

            document.getElementById('ttkefuminiqueding').onclick=function(){mini_dialog.tijiaopingfen();}
            document.getElementById('ttkefuminitishi').style.display='';
            document.getElementById('ttkefuminitishiwrapper').style.display='';
        },
        tijiaopingfen:function(){
            document.getElementById('ttkefuminitishi').style.display='none';
            document.getElementById('ttkefuminitishiwrapper').style.display='none';
            /*关闭循环*/
            if(mini_dialog.isfirst>0)
            {
                mini_dialog.stoploop();
            }

            /*数据验证*/
            var ttkefuminipftxt=document.getElementById('ttkefuminitxt').value;
            if(ttkefuminipftxt.length>150)
            {
                document.getElementById("ttkefuminitxtlimit").style.color="#ff0000";
                return;
            }
            else
            {
                document.getElementById("ttkefuminitxtlimit").style.color="#555555";
            }
            var mypingfen=0;
            for(var i=0;i<document.getElementsByName("ttkefuminirad").length;i++)
            {
                if(document.getElementsByName("ttkefuminirad").item(i).checked)
                {
                    mypingfen=document.getElementsByName("ttkefuminirad").item(i).value;
                }
            }
            /*评分数据*/
            var new_script = document.createElement("script");
            new_script.src ="http://w1.ttkefu.com/conversationormessage/ourcustomerservice/customerlist/pingfenyemian.jsp?act=exit&pf="+mypingfen+"&jy="+encodeURIComponent(ttkefuminipftxt)+"&id="+mini_dialog.chatid;
            new_script.charset="utf-8";
            //document.getElementsByTagName("HEAD")[0].appendChild(new_script);


            /*显示窗口*/

            document.getElementById("ttkefuminitishiwrapperdiv").style.height="128px";
            document.getElementById('minittkefutitletxt').innerHTML="提示";
            document.getElementById('ttkefuminitishi_close').style.display='';
            document.getElementById('ttkefuminitishi_txt').style.padding="15px 10px 10px 20px";
            document.getElementById('ttkefuminitishi_txt').innerHTML="提交成功，谢谢";
            document.getElementById('ttkefuminiqueding').onclick=function(){mini_dialog.closewindow();}
            document.getElementById('ttkefuminiquxiao').style.display="none";
            document.getElementById('ttkefuminitxtlimit').style.display="none";
            document.getElementById('ttkefuminitishi').style.display='';
            document.getElementById('ttkefuminitishiwrapper').style.display='';


        },
        shoucang:function(){
            /*关闭循环*/
            if(mini_dialog.isfirst>0)
            {
                mini_dialog.stoploop();
            }
            /*		if(document.all)
                    {window.external.AddFavorite('','');}
                    else if(window.sidebar)
                    {window.sidebar.addPanel('','','')};*/

        },
        closetishisign:function(){
            if(document.getElementById('ttkefuminitishi_close').style.backgroundColor=="")
            {
                document.getElementById('ttkefuminitishi_close').style.backgroundColor="#CC0000";
                document.getElementById('ttkefuminitishi_close').style.color="#ffffff";
            }
            else
            {
                document.getElementById('ttkefuminitishi_close').style.backgroundColor="";
                document.getElementById('ttkefuminitishi_close').style.color="#555555";
            }
        },
        closetishiwindow:function(){
            document.getElementById('ttkefuminitishi').style.display='none';
            document.getElementById('ttkefuminitishiwrapper').style.display='none';
        },
        closewindow:function(){
            if(mini_dialog.isfirst>0)
            {
                mini_dialog.exiturl="http://w1.ttkefu.com/minimsg.jsp?act=exit&ki="+mini_dialog.kfid+"&minikhid="+mini_dialog.khid+"&fgid=9575&dkfs=&c="+mini_dialog.chatid;
                var new_script = document.createElement("script");
                new_script.src = mini_dialog.exiturl;
                document.getElementsByTagName("HEAD")[0].appendChild(new_script);
            }
            document.getElementById('minidialog').style.display='none';
            document.getElementById('ttkefuminitishi').style.display='none';
            document.getElementById('ttkefuminitishiwrapper').style.display='none';

            clearTimeout(mini_cytime);
            mini_dialog.clear(timerkkff);
            var Jsinv_text="您好请问有什么可以帮您的？";
            document.getElementById("ttkefucontainer").innerHTML='<div style="padding:0px; margin:0px;font-size: 9pt;height: auto;line-height: 19px;margin:0px 0px 10px 0px;overflow: hidden;position: relative; "><div style="padding:4px 10px 4px 10px; border-radius:5px; font-size: 9pt;height: auto;line-height: 19px; margin: 0px 0px 10px 4px;overflow: hidden; border:1px solid #dddddd; color:#000000; ">ttkefu是一款免费的网页即时聊天、微信即时聊天的客服软件,免费申请网址:<a href="http://www.ttkefu.com"  style="text-decoration: none; color:#000;" target="_blank">http://www.ttkefu.com</a></div><div style="padding:0px; margin:0px;background:#ffffff url(http://w1.ttkefu.com/images/green_arrow_1.png) no-repeat;height:8px;left:0px;position: absolute; top: 11px; width: 11px;"></div></div>'+mini_dialog.kfhtmlheader+Jsinv_text+mini_dialog.kfhtmlfooter+"<div class='ttkefu_jg' style='height:10px;padding:0px; margin:0px;font-size: 9pt; margin: 0px 0px 0px 0px;overflow: hidden; clear:both; '></div>";
            mini_dialog.chatid=0;
            mini_dialog.kfid=0;
            mini_dialog.khid=0;
            mini_dialog.use='';
            mini_dialog.i=0;
            mini_dialog.dialog=true;
            mini_dialog.isfirst=0;
            mini_dialog.iszhuanjie=0;
            mini_dialog.zhidingkefu=0;
            mini_dialog.state='0';
            mini_dialog.p='0';
            document.getElementById("ttkefuminitishi_txt").innerHTML="是否关闭该对话？请您对我的服务给予评价！";


        },
        stoploop:function(){
            if(mini_dialog.isfirst>0)
            {
                mini_dialog.exiturl="http://w1.ttkefu.com/minimsg.jsp?act=exit&ki="+mini_dialog.kfid+"&minikhid="+mini_dialog.khid+"&fgid=9575&dkfs=&c="+mini_dialog.chatid;
                var new_script = document.createElement("script");
                new_script.src = mini_dialog.exiturl;
                document.getElementsByTagName("HEAD")[0].appendChild(new_script);
                clearTimeout(mini_cytime);
                mini_dialog.clear(timerkkff);
            }
            clearTimeout(mini_cytime);
            mini_dialog.clear(timerkkff);
            var Jsinv_text="您好请问有什么可以帮您的？";
            document.getElementById("ttkefucontainer").innerHTML='<div style="padding:0px; margin:0px;font-size: 9pt;height: auto;line-height: 19px;margin:0px 0px 10px 0px;overflow: hidden;position: relative; "><div style="padding:4px 10px 4px 10px; border-radius:5px; font-size: 9pt;height: auto;line-height: 19px; margin: 0px 0px 10px 4px;overflow: hidden; border:1px solid #dddddd; color:#000000; ">ttkefu是一款免费的网页即时聊天、微信即时聊天的客服软件,免费申请网址:<a href="http://www.ttkefu.com"  style="text-decoration: none; color:#000;" target="_blank">http://www.ttkefu.com</a></div><div style="padding:0px; margin:0px;background:#ffffff url(http://w1.ttkefu.com/images/green_arrow_1.png) no-repeat;height:8px;left:0px;position: absolute; top: 11px; width: 11px;"></div></div>'+mini_dialog.kfhtmlheader+Jsinv_text+mini_dialog.kfhtmlfooter+'<div style="height:10px;padding:0px; margin:0px;font-size: 9pt;line-height: 19px;margin: 0px 0px 0px 0px;overflow: hidden; clear:both; " class="ttkefu_jg"></div>';
            mini_dialog.chatid=0;
            mini_dialog.kfid=0;
            mini_dialog.khid=0;
            mini_dialog.use='';
            mini_dialog.i=0;
            mini_dialog.dialog=true;
            mini_dialog.isfirst=0;
            mini_dialog.iszhuanjie=0;
            mini_dialog.zhidingkefu=0;
            mini_dialog.state='0';
            mini_dialog.p='0';
        },
        exit:function(){
            if(mini_dialog.isfirst>0)
            {
                mini_dialog.exiturl="http://w1.ttkefu.com/minimsg.jsp?act=exit&ki="+mini_dialog.kfid+"&minikhid="+mini_dialog.khid+"&fgid=9575&dkfs=&c="+mini_dialog.chatid;
                var new_script = document.createElement("script");
                new_script.src = mini_dialog.exiturl;
                document.getElementsByTagName("HEAD")[0].appendChild(new_script);
            }
            clearTimeout(mini_cytime);
            mini_dialog.clear(timerkkff);
            var Jsinv_text="您好请问有什么可以帮您的？";
            document.getElementById("ttkefucontainer").innerHTML='<div style="padding:0px; margin:0px;font-size: 9pt;height: auto;line-height: 19px;margin:0px 0px 10px 0px;overflow: hidden;position: relative; "><div style="padding:4px 10px 4px 10px; border-radius:5px; font-size: 9pt;height: auto;line-height: 19px; margin: 0px 0px 10px 4px;overflow: hidden; border:1px solid #dddddd; color:#000000; ">ttkefu是一款免费的网页即时聊天、微信即时聊天的客服软件,免费申请网址:<a href="http://www.ttkefu.com"  style="text-decoration: none; color:#000;" target="_blank">http://www.ttkefu.com</a></div><div style="padding:0px; margin:0px;background:#ffffff url(http://w1.ttkefu.com/images/green_arrow_1.png) no-repeat;height:8px;left:0px;position: absolute; top: 11px; width: 11px;"></div></div>'+mini_dialog.kfhtmlheader+Jsinv_text+mini_dialog.kfhtmlfooter+'<div class="ttkefu_jg" style="height:10px;padding:0px; margin:0px;font-size: 9pt;line-height: 19px;margin: 0px 0px 0px 0px;overflow: hidden; clear:both; "></div>';
            mini_dialog.chatid=0;
            mini_dialog.kfid=0;
            mini_dialog.khid=0;
            mini_dialog.use='';
            mini_dialog.i=0;
            mini_dialog.dialog=true;
            mini_dialog.isfirst=0;
            mini_dialog.iszhuanjie=0;
            mini_dialog.zhidingkefu=0;
            mini_dialog.state='0';
            mini_dialog.p='0';
            document.getElementById("sendMsgTxt_chat").setAttribute("readonly","true");
            document.getElementById("ttkefutitle").innerHTML="在线客服";
            document.getElementById("ttkefuonlineKefuName").innerHTML="";

        },
        AutoDkexit:function(){
            if(mini_dialog.isfirst>0)
            {
                mini_dialog.exiturl="http://w1.ttkefu.com/minimsg.jsp?act=exit&ki="+mini_dialog.kfid+"&minikhid="+mini_dialog.khid+"&fgid=9575&dkfs=&c="+mini_dialog.chatid;
                var new_script = document.createElement("script");
                new_script.src = mini_dialog.exiturl;
                document.getElementsByTagName("HEAD")[0].appendChild(new_script);
            }
            clearTimeout(mini_cytime);
            mini_dialog.clear(timerkkff);
            mini_dialog.chatid=0;
            mini_dialog.kfid=0;
            mini_dialog.khid=0;
            mini_dialog.use='';
            mini_dialog.i=0;
            mini_dialog.dialog=true;
            mini_dialog.isfirst=0;
            mini_dialog.iszhuanjie=0;
            mini_dialog.zhidingkefu=0;
            mini_dialog.state='0';
            mini_dialog.p='0';
            document.getElementById("sendMsgTxt_chat").setAttribute("readonly","true");
            document.getElementById("ttkefutitle").innerHTML="在线客服";
            document.getElementById("ttkefuonlineKefuName").innerHTML="";

        },
        sendtxtfoucs:function(){
            mini_dialog.clear(timerkkff);
            document.getElementById("uploadFileBox1").style.display="none";

        },
        sendtxtblur:function(){
            ttkefu_Mchannel.CloseWriting();
        },
        show:function(msgtype)
        {
            /*标题栏闪烁提示*/
            var step=0,
                _title =mini_dialog.title;
            var timer = setInterval(function(){
                step++;
                if (step==3) {step=1}
                if (step==1) {
                    document.title="【　　　】"+_title;
                    document.getElementById("ttkefutitle").style.color="#FF0000";
                    document.getElementById("ttkefuonlineKefuName").style.color="#FF0000";
                    document.getElementById("ttkefuminidialogtitle").style.background="#FFFF00  url(http://w1.ttkefu.com/images/kf.png) no-repeat 10px center";
                }
                if (step==2) {
                    document.title="【"+msgtype+"】"+_title;
                    document.getElementById("ttkefutitle").style.color=mini_dialog.fontcolor;
                    document.getElementById("ttkefuonlineKefuName").style.color=mini_dialog.fontcolor;
                    document.getElementById("ttkefuminidialogtitle").style.background=mini_dialog.titlebg+"  url(http://w1.ttkefu.com/images/kf.png) no-repeat 10px center";}
            }, 500);

            /*声音提示*/
            document.getElementById('soundMsg').setAttribute('src','http://w1.ttkefu.com/sound/type.mp3');
            /*如果窗口没有最大化则最大化*/
            if(mini_dialog.windowstate==1){
                mini_dialog.maxwindow()
            }

            document.getElementById("sendMsgTxt_chat").focus();
            return [timer, _title];
        },
        clear : function(timerArr) {
            if(timerArr) {
                clearInterval(timerArr[0]);
                setTimeout(function(){document.title = timerArr[1]},500);
                document.getElementById("ttkefuminidialogtitle").style.background=mini_dialog.titlebg+"  url(http://w1.ttkefu.com/images/kf.png) no-repeat 10px center";
                document.getElementById("ttkefutitle").style.color=mini_dialog.fontcolor;
                document.getElementById("ttkefuonlineKefuName").style.color=mini_dialog.fontcolor;

            }
        },
        addtimes:function(){
            var mynowtime=new Date();
            mynowtime=mynowtime.getFullYear()+"-"+(mynowtime.getMonth()+1)+"-"+(mynowtime.getDate()+1)+" "+(mynowtime.getHours()+1)+":"+(mynowtime.getMinutes()+1)+":"+(mynowtime.getSeconds()+1);
            /*1分钟添加一次时间*/
            if(mini_dialog.GetDateDiff(mini_dialog.jstime,mynowtime,"minute")>=1)
            {
                mini_dialog.jstime=mynowtime;
                var nowday=new Date();
                var m=document.createElement("div");
                m.style.margin="0px";
                m.style.padding="0px";
                m.innerHTML="<div style='margin:0px;padding:0px;color: #999;font-size: 12px; text-align: center;'>"+nowday.getHours()+":"+nowday.getMinutes()+":"+nowday.getSeconds()+"</div>";
                document.getElementById("ttkefucontainer").appendChild(m);
                document.getElementById('ttkefucontainer').scrollTop=document.getElementById('ttkefucontainer').scrollHeight;
            }
        },
        GetDateDiff:function(startTime, endTime, diffType) {
            /*将xxxx-xx-xx的时间格式，转换为 xxxx/xx/xx的格式*/
            startTime = startTime.replace(/\-/g, "/");
            endTime = endTime.replace(/\-/g, "/");
            /*将计算间隔类性字符转换为小写*/
            diffType = diffType.toLowerCase();
            var sTime = new Date(startTime); //开始时间
            var eTime = new Date(endTime); //结束时间
            /*作为除数的数字 */
            var divNum = 1;
            switch (diffType) {
                case "second":
                    divNum = 1000;
                    break;
                case "minute":
                    divNum = 1000 * 60;
                    break;
                case "hour":
                    divNum = 1000 * 3600;
                    break;
                case "day":
                    divNum = 1000 * 3600 * 24;
                    break;
                default:
                    break;
            }
            return parseInt((eTime.getTime() - sTime.getTime()) / parseInt(divNum));
        },
        importhtml:function(){
            //获取当前页面部分内容
            var txt="<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html><head></head><body>";
            var tongjiwrapper=document.getElementById("ttkefucontainer").innerHTML;
            txt=txt+tongjiwrapper+"</body></html>";
            var mynowtime=new Date();
            mynowtime=mynowtime.getFullYear()+"-"+(mynowtime.getMonth()+1)+"-"+(mynowtime.getDate()+1);

            var htmlname="聊天记录-"+mynowtime;
            ttkefuimport.document.location="about:blank";
            ttkefuimport.document.open("text/html","utf-8");
            ttkefuimport.document.write(txt);
            ttkefuimport.document.execCommand("SaveAs", true, htmlname+'.htm');
            ttkefuimport.close();
        }

    }

    function ttkefu_hide(str){
        document.getElementById(str).style.display='none'
    }

    /*访客等待超时提示：以访客发送消息成功为起始点*/
    function ttkefu_FkWaitOvTime(){
        //访客聊天状态设置vip是否开启
        if(mini_dialog.AutoClose_Ok==0){
            return false;
        }

        //客服是否在线
        if(mini_dialog.imlixian==1){
            return false;
        }
        //是否处于对话结束提示中
        if(ttkefu_Mchannel.TalkTs==1){
            return false;
        }

        //是否正处于对话中
        if(!ttkefu_Mchannel.lg){
            return false;
        }

        //是否开启
        if(ttkefu_fkwaitstate!="True"){
            return false;
        }

        //是否超时
        var Ntime=new Date();
        var OvTime_Cha=(Ntime.getTime()-ttkefu_FkSendTime.getTime())/1000;
        if(parseInt(OvTime_Cha)<parseInt(ttkefu_fkwaittime)){
            return false;
        }

        //插入消息提示
        ttkefu_Mchannel.InsertTs({TiShi:'\u6211\u6B63\u5728\u4E3A\u60A8\u67E5\u8BE2\u8D44\u6599\uFF0C\u8BF7\u7A0D\u5019\uFF01',type:0});
    }

//访客无回复超时提示:已客服发送消息为起始点
    function ttkefu_KfWaitOvTime(){
        //访客聊天状态设置vip是否开启
        if(mini_dialog.AutoClose_Ok==0){
            return false;
        }
        //客服是否在线
        if(mini_dialog.imlixian==1){
            return false;
        }

        //是否处于对话结束提示中
        if(ttkefu_Mchannel.TalkTs==1){
            return false;
        }

        //是否正处于对话中
        if(!ttkefu_Mchannel.lg){
            return false;
        }

        //是否开启
        if(ttkefu_fknoreplystate!="True"){
            return false;
        }

        //是否超时
        var Ntime=new Date();
        var OvTime_Cha=(Ntime.getTime()-ttkefu_KfSendTime.getTime())/1000;
        if(parseInt(OvTime_Cha)<parseInt(ttkefu_fknoreplytime)){
            return false;
        }
        //插入消息提示
        ttkefu_Mchannel.InsertTs({TiShi:'已经很久没有收到您的讯息，您还有其他需要我服务的么？',type:1});
    }

//访客无操作,自动结束对话提示-以访客，客服消息发送成功为判断时间点
    function ttkekfu_AutoCloseTalkTs(){
        //客服是否在线
        if(mini_dialog.imlixian==1){
            return false;
        }
        //是否处于对话结束提示中
        if(ttkefu_Mchannel.TalkTs==1){
            return false;
        }
        //是否正处于对话中
        if(!ttkefu_Mchannel.lg){
            return false;
        }
        //是否超时,单位分钟
        var Ntime=new Date();
        var OvTime_Cha=Ntime.getTime()-ttkefu_leavetime.getTime();
        if(parseInt(OvTime_Cha)<parseInt(ttkefu_fkstaytime)){
            return false;
        }

        //是否开启-关闭自动结束对话且vip功能可以使用
        if(ttkefu_fkleavestate!="True" && mini_dialog.AutoClose_Ok==1){
            return false;
        }
        //插入消息提示
        ttkefu_Mchannel.TalkTs=1;
        ttkefu_Mchannel.InsertTs({TiShi:'如无其它问题，系统将倒计时结束本次对话。再次咨询请重新发起，祝您愉快，再见！',type:2});
        //倒计时开始
        ttkekfu_QZCloseTalk(110);
    }

//友好结束对话
    function ttkekfu_yhAutoCloseTalkTs(){

        //访客聊天状态设置vip是否开启
        if(mini_dialog.AutoClose_Ok==0){
            return false;
        }
        //插入消息提示
        ttkefu_Mchannel.TalkTs=1;
        ttkefu_Mchannel.InsertTs({TiShi:'如无其它问题，系统将倒计时结束本次对话。再次咨询请重新发起，祝您愉快，再见！',type:2});
        //倒计时开始
        ttkekfu_QZCloseTalk(110);
    }
//强制结束对话
    var ttkefu_leavetimes=0;
    function ttkekfu_QZCloseTalk(i){
        i--;
        clearTimeout(ttkefu_leavetimes);
        if(i==0){
            /*强制结束对话*/
            mini_dialog.AutoDkexit();
        }else{
            document.getElementById("DJS"+ttkefu_Mchannel.TsId).innerHTML=i;
            clearTimeout(ttkefu_leavetimes);
            ttkefu_leavetimes=setTimeout("ttkekfu_QZCloseTalk("+i+")",1000);
        }
    }
    /*取消倒计时,更新自动结束对话倒计时*/
    function ttkefu_noleave(){
        ttkefu_leavetime=new Date();
        clearTimeout(ttkefu_leavetimes);
        ttkefu_Mchannel.TalkTs=0;
    }
    onner();


    /*document.write('<div id="sj_ttkefuyaoqing" style="display:none;margin:0px; padding:0px;border-radius: 4px;overflow: hidden; z-index: 500; width:auto; height: auto; box-shadow: silver 0px 0px 1px 1px; position:fixed; top:86px; background:#f3f4f6;  z-index:999999999999999; ">');
    document.write('<div style="display: block;width:244px;height: auto;overflow: hidden;border-radius: 4px;background:#f3f4f6;z-index: 500100;"  id="kf_yaoqing">');
    document.write('<div style="margin:0px; padding:0px;" id="QYKFYQKC">');
    document.write('<div style="background:none;font-size: 13px;height:60px; line-height:22px;" >');
    document.write('<div style=" text-align:left; font-weight:normal;padding-left: 12px;" >');
    document.write('<p style="margin:20px 3px 0px 0px; font-size:14px; color:#000000; padding:0px;font-family:微软雅黑;" id="invtexttd">\u60A8\u597D,\u8BF7\u95EE\u6709\u4EC0\u4E48\u53EF\u4EE5\u5E2E\u52A9\u5230\u60A8\u7684\u5417?</p>');
    document.write('</div>');
    document.write('</div>');
    document.write('<a href="javascript:ttkefuyaoqing.hide()"><div style="background:rgb(188, 188, 188);float: left;font-size: 14px; font-family:微软雅黑; font-weight: bold; height:31px;line-height:30px;text-align: center;width:122px; color:#000000;cursor:pointer;" > 取消</div></a>');
    document.write('<a  href="javascript:ttkefuyaoqing.startchats()"><div style="background:rgb(224, 224, 224); color:red;float: left;font-size: 14px;font-weight: bold;height:31px;line-height:30px;text-align: center;width:122px;cursor:pointer;font-family:微软雅黑;"  > \u54A8\u8BE2</div></a>');
    document.write('</div>');
    document.write('</div>');
    document.write('</div>');

    document.getElementById("sj_ttkefuyaoqing").style.left=(window.innerWidth-244)/2+"px";
    document.getElementById("sj_ttkefuyaoqing").style.top=(window.innerHeight-111)/2+"px";*/

    /*var ttkefuyaoqing={
        kfid:0,kgid:0,kfnicheng:'',
        show:function(strtext,kfid,kgid,nicheng){
            if(kfid){this.kfid=kfid}if(kgid){this.kgid=kgid}
            document.getElementById("sj_ttkefuyaoqing").style.display="block";
            if(typeof(strtext)!="undefined" && strtext.length>1){
                document.getElementById("invtexttd").innerHTML=strtext;
            }
        },
        showtishi:function(strtext,ycolor,kfid,kgid,nicheng){
            ttkefuyaoqing.show(strtext,kfid,kgid,nicheng)
        },
        showyxjtishi:function(strtext,kfid,kgid,nicheng){
            ttkefuyaoqing.show(strtext,kfid,kgid,nicheng)
        },
        showbtmtishi:function(strtext,kfid,kgid,nicheng){
            ttkefuyaoqing.show(strtext,kfid,kgid,nicheng)
        },
        hide:function(){
            document.getElementById("sj_ttkefuyaoqing").style.display="none";
        },
        startchats:function(){
            //document.getElementById("sj_ttkefuyaoqing").style.display="none";
            if(this.kfid==0){
                tana('0');
            }else{
                tanb(this.kfid,this.kgid,'0',this.kfnicheng);
            }
        }
    };*/


    /*setTimeout('ttkefuyaoqing.show()',5*1000);
    if("0"=="1")
    {
        setInterval('ttkefuyaoqing.show()',30*1000);
    }*/

    document.write('<a href="javascript:tana(2);" ><div id="ttkefuico"  style="width:25px; height:85px; border-top-right-radius:4px;border-bottom-right-radius:4px; padding:8px 0px 0px 0px; padding-left:5px;  background:#006633; line-height:18px; position:fixed; color:#ffffff; left:0px; top:140px;cursor:pointer; font-size:15px; text-align:left; z-index:999999999999999;" >在线客服</div></a>');

    /*----*/
    if(document.getElementById("sj_ttkefu_ico")){
        var Sjscan_ttkefu=ttkefu_getBrowserInfo();

        for(var i=0;i<document.getElementById("sj_ttkefu_ico").childNodes.length-1;i++)
        {

            document.getElementById("sj_ttkefu_ico").childNodes.item(i).onmouseover=function(){
                if(Sjscan_ttkefu.browser=="msie"){
                    //this.style.filter="alpha(opacity=80)";}else{this.style.opacity="0.8";}

                }
                this.style.background="#cccccc";
            }

            document.getElementById("sj_ttkefu_ico").childNodes.item(i).onmouseout=function(){
                if(Sjscan_ttkefu.browser=="msie"){
                    //this.style.filter="alpha(opacity=100)";}else{this.style.opacity="1"; }

                }
                if(this.id=="sj_ttkefu_ico_close"){
                    this.style.background="#E2EEE8";
                }else{
                    this.style.background="#006633";
                }
            }

        }
    }
    /*二维码放大*/
    var ttkefu_ErWeiMa;
    function ttkefu_ErWeiMa_over(){
        clearTimeout(ttkefu_ErWeiMa);
        if(document.getElementById("ttkefuqrcode0")){
            document.getElementById("ttkefuqrcode1").style.display="";
            document.getElementById("ttkefuqrcode2").style.display="";
        }
    }

    function ttkefu_ErWeiMa_out(event){
        if(document.getElementById("ttkefuqrcode0")){
            document.getElementById("ttkefuqrcode1").style.display="none";
            document.getElementById("ttkefuqrcode2").style.display="none";
            //

            //非IE
            event.stopPropagation();
        }
    }
    /*关闭按钮*/
    function ttkefu_ErWeiMa_close(){
        if(document.getElementById("sj_ttkefu_ico")){
            document.getElementById("sj_ttkefu_ico").style.display="none";
        }
    }


    lastScrollY = 0;
    function ttkefuheartBeat(){
        var diffY;
        if (document.documentElement && document.documentElement.scrollTop){
            diffY = document.documentElement.scrollTop;
        }else if (document.body){
            diffY = document.body.scrollTop
        }else{
            /*Netscape stuff*/
        }
        percent=.1*(diffY-lastScrollY);
        if(percent>0)percent=Math.ceil(percent);
        else percent=Math.floor(percent);
        if(document.getElementById("ttkefulist"))
        {
            document.getElementById("ttkefulist").style.top = parseInt(document.getElementById("ttkefulist").style.top)+percent+"px";
        }
        if(document.getElementById("ttkefuico"))
        {
            document.getElementById("ttkefuico").style.top = parseInt(document.getElementById("ttkefuico").style.top)+percent+"px";
        }

        if(document.getElementById("ttkefutel"))
        {
            document.getElementById("ttkefutel").style.top = parseInt(document.getElementById("ttkefutel").style.top)+percent+"px";
        }
        if(document.getElementById("ttkefuyaoqing"))
        {
            document.getElementById("ttkefuyaoqing").style.top = parseInt(document.getElementById("ttkefuyaoqing").style.top)+percent+"px";
        }
        if(document.getElementById("ttkefuqqstyle"))
        {
            document.getElementById("ttkefuqqstyle").style.top=parseInt(document.getElementById("ttkefuqqstyle").style.top)+percent+"px";
        }
        if(document.getElementById("minidialog"))
        {
            document.getElementById("minidialog").style.top=parseInt(document.documentElement.clientHeight-316)+document.documentElement.scrollTop+"px";
        }
        if(document.getElementById("yxjwrapper"))
        {
            document.getElementById("yxjwrapper").style.top=parseInt(document.documentElement.clientHeight-75)+document.documentElement.scrollTop+"px";
        }
        if(document.getElementById("btmtishi"))
        {
            document.getElementById("btmtishi").style.top=parseInt(document.documentElement.clientHeight-90)+document.documentElement.scrollTop+"px";
        }


        var tempobj1=document.getElementById("ttkefutishi")
        if(tempobj1)tempobj1.style.top=parseInt(diffY+window.screen.availHeight/4)+"px";
        lastScrollY=lastScrollY+percent;
    }

    var ua=window.navigator.userAgent.toLowerCase();
    if(ua.indexOf("msie")>0)
    {
        var start=ua.indexOf("msie");
        if(ua.substr(start,8)=="msie 6.0" || document.compatMode =="BackCompat")
        {
            window.setInterval("ttkefuheartBeat()",1);
        }
    }


    var ttkefuobj='',ttkefuleixing="left";
    document.onmouseup=MUp;
    document.onmousemove=MMove;

    function ttkefuqqdown(i)
    {
        ttkefuleixing=i;
        MDown('ttkefuqqstyle')
    }
    function ttkefuyqdown(i)
    {
        ttkefuleixing=i;
        MDown('ttkefuyaoqing')
    }

    function ttkefudown(i,j)
    {
        ttkefuleixing=i;
        MDown(j)
    }
    var pX,pY;
    function MDown(str){
        ttkefuobj=document.getElementById(str);
        ttkefuobj.setCapture();
        if(ttkefuleixing=="left")
        {
            pX=event.x-ttkefuobj.style.pixelLeft;
        }
        else
        {
            pX=event.x+ttkefuobj.style.pixelRight;
        }

        pY=event.y-ttkefuobj.style.pixelTop;

    }
    function MMove(){
        if(ttkefuobj!='')
        {
            var maxL = document.documentElement.clientWidth - ttkefuobj.offsetWidth;
            var maxT = document.documentElement.clientHeight - ttkefuobj.offsetHeight;


            if(ttkefuleixing=="left")
            {
                ttkefuobj.style.left=event.x-pX;
            }
            else
            {
                ttkefuobj.style.right=pX-event.x;
            }

            ttkefuobj.style.top=event.y-pY;
        }
    }
    function MUp(){
        if(ttkefuobj!=''){

            ttkefuobj.releaseCapture();
            ttkefuobj='';
        }
    }

}