/**
 * Created by Hajay on 16/6/29.
 * Update by yoyo on 2016/7/29 - 修改日期格式将其在所有浏览器中统一
 */

/*
 * data是一个对象,包含以下参数
 * id: id位置弹出时间选择框
 * callbackFun: 回调方法
 * start_date: 增加时间间隔 如:7
 * curr_date: 此参数设置当前选中的日期 如:2016/8/9-2016/8/11 | 2016/8/9 02:00-2016/8/11 23:59
 * show_hour: true | false
 * in_id: true(弹出层直接id标签内) | false(弹出层直接body下,最外层)
 * hide_day: 默认false, true为隐藏日模块,false显示
 * hide_week: 默认false, true为隐藏周模块,false显示
 * hide_month: 默认false, true为隐藏月模块,false显示
 * hide_range: 默认false, true为隐藏月模块,false显示
 * open_after_date: 默认false, true为让当前之后的日期可选,false显示
 *
 * 返回参数
 * 对象{}
 * resultCode : 0成功 非0失败
 * date : 成功时返回的时间
 * errMsg : 失败时返回的错误
 * */

(function(){
    window.dt = function(data) {

        var d = document,
            cEl = "createElement",
            add = "appendChild",
            remove = "removeChild",
            gTag = "getElementsByTagName",
            od = "onkeydown",
            gid = "getElementById",
            ctn = "createTextNode";
        var ui = {};

        var now = new Date();                                                //当前日期
        var nowDayOfWeek = now.getDay();
        var nowDay = now.getDate();                                          //当前日
        var nowMonth = now.getMonth();                                       //当前月值（1月=0，12月=11）
        var nowMonReal = now.getMonth() + 1;                                 //当前月实际数字
        var nowYear = now.getFullYear();                                     //当前年
        //var currDate = now.toLocaleDateString();
        //var currStartDate = now.toLocaleDateString();
        //var currEndDate = now.toLocaleDateString();

        var currDate = now.dateFormat();
        var currStartDate = currDate;
        var currEndDate = currDate;
        var currStartHour = "00:00";
        var currEndHour = "23:59";

        var isShowHour = true;
        if(data.show_hour != undefined){
            isShowHour = data.show_hour;
        }

        if(data.curr_date != undefined){
            var startTimeAll = data.curr_date.split("-")[0];
            var endTimeAll = data.curr_date.split("-")[1];
            var sd = startTimeAll.split(" ")[1];
            if(sd){
                var ed = endTimeAll.split(" ")[1];
                currStartDate = new Date(Date.parse(startTimeAll.split(" ")[0])).dateFormat();
                currEndDate = new Date(Date.parse(endTimeAll.split(" ")[0])).dateFormat();
                currStartHour = sd;
                currEndHour = ed;
            }else {
                currStartDate = new Date(Date.parse(startTimeAll)).dateFormat();
                currEndDate = new Date(Date.parse(endTimeAll)).dateFormat();
            }
            //currStartDate = new Date(Date.parse(data.curr_date.split("-")[0])).dateFormat();
            //currEndDate = new Date(Date.parse(data.curr_date.split("-")[1])).dateFormat();
        }

        var itemTab = {
            day: {
                cls: "on",
                text: "日",
                hide: data.hide_day | false
            },
            week: {
                cls: "",
                text: "周",
                hide: data.hide_week | false
            },
            month: {
                cls: "",
                text: "月",
                hide: data.hide_month | false
            },
            range: {
                cls: "",
                text: "范围",
                hide: data.hide_range | false
            }
        };
        var tabLeftRight = {
            left: {
                id: "",
                text: "&lt;"
            },
            center: {
                id: "dateAareShow",
                text: ""
            },
            right: {
                id: "",
                text: "&gt;"
            }
        };
        var weekTextList = ["一", "二", "三", "四", "五", "六", "日"];
        var pastDayList = ['7', '30', '90'];
        var currDateType = itemTab.day.text;
        window.dateIsRe = false;
        var currRangeOn = ""; // 范围:所在选择开始或者结束日期input上
        var returnParams = {};

        var gd = d[gid](data.id);
        //gd.value = currStartDate + "-" + currEndDate;
//        alert(gd.offsetHeight);
        gd.onclick = function (e) {

            if(window.dateIsRe && d[gid]("dateWarp")){
                //d[gid]("dateWarp").remove();
                removeElement(d[gid]("dateWarp"));
                window.dateIsRe = false;
                return;
            }else {
                window.dateIsRe = true;
            }

            window.event ? window.event.cancelBubble = true : e.stopPropagation();

            ui.dateWarp = d[cEl]("div");
            ui.dateWarp.id = "dateWarp";
            if(currDateType == itemTab.range.text){
                ui.dateWarp.style.width = "300px";
            }
            ui.dateWarp.onclick = function (e) {
                window.event ? window.event.cancelBubble = true : e.stopPropagation();
            };
            if(data.in_id){
                gd[add](ui.dateWarp);
                d[gid]("dateWarp").style.top = "36px";
                d[gid]("dateWarp").style.left = "0px";
            }else{
                d.body[add](ui.dateWarp);
                d[gid]("dateWarp").style.top = (gd.getBoundingClientRect().top + 36) + "px";
                d[gid]("dateWarp").style.left = gd.getBoundingClientRect().left + "px";
            }
            //d[gid]("dateWarp").style.top = (gd.offsetTop + gd.offsetHeight + 50) + "px";
            //d[gid]("dateWarp").style.left = (gd.offsetLeft + 250) + "px";

            ui.itemTab = d[cEl]("table");
            ui.itemTab.className = "dateItem";
            ui.itemTab.cellpadding = 0;
            ui.itemTab.cellspacing = 0;
            ui.dateWarp[add](ui.itemTab);

            //日周月tab
            ui.itemTr_1 = d[cEl]("tr");
            ui.itemTab[add](ui.itemTr_1);
            for (var i in itemTab) {
                if(itemTab[i].hide){
                    continue;
                }
                ui["itemTh_" + i] = d[cEl]("th");
                if (itemTab[i].text == currDateType) {
                    ui["itemTh_" + i].className = "on";
                }
                ui["itemTh_" + i].innerHTML = itemTab[i].text;
                ui["itemTh_" + i].onclick = function (e) {
//                    window.event? window.event.cancelBubble = true : e.stopPropagation();
                    var _this = this.parentNode.children;
                    for (var j = 0; j < _this.length; j++) {
                        _this[j].className = "";
                    }
                    this.className = "on";
                    switch (this.innerHTML) {
                        case itemTab.day.text :
                            removeTab(this.innerHTML);
                            break;
                        case itemTab.week.text :
                            removeTab(this.innerHTML);
                            break;
                        case itemTab.month.text :
                            removeTab(this.innerHTML);
                            break;
                        case itemTab.range.text :
                            ui.dateWarp.style.width = "300px";
                            if(ui.pastDayUl){
                                removeElement(ui.pastDayUl);
                                removeElement(ui.dateRangeTab.div);
                                removeElement(ui.changeMonthTab);
                                removeElement(ui.sureBtn.div);
                            }
                            //removeElement(ui.itemTr_2);
                            //removeElement(ui.dayOrHour);
                            currDateType = this.innerHTML;
                            if(currRangeOn == ""){
                                currRangeOn = "start";
                            }
                            rangeTab(this.innerHTML);
                            break;
                        default :
                            alert("错误");
                            break;

                    }
                    function removeTab(text){
                        ui.dateWarp.style.width = "240px";
                        if(ui.pastDayUl){
                            removeElement(ui.pastDayUl);
                            removeElement(ui.dateRangeTab.div);
                            removeElement(ui.changeMonthTab);
                            removeElement(ui.sureBtn.div);
                        }
                        removeElement(ui.itemTr_2);
                        removeElement(ui.dayOrHour);
                        currDateType = text;
                        changeMonthTab(text);
                        day(nowMonth, text);
                    }
                };
                ui.itemTr_1[add](ui["itemTh_" + i]);
            }

            if(currDateType == itemTab.range.text){
                rangeTab(itemTab.range.text);
            }else {
                changeMonthTab(currDateType);
                day(nowMonth, currDateType);
            }



            function tab(dateType) {
                //左右切换年月份区域
                ui.itemTr_2 = d[cEl]("tr");
                ui.itemTr_2.className = "tab";
                ui.itemTab[add](ui.itemTr_2);
                for (var i in tabLeftRight) {
                    ui["tabTd_" + i] = d[cEl]("td");
                    ui["tabTd_" + i].id = tabLeftRight[i].id;
                    ui["tabTd_" + i].innerHTML = tabLeftRight[i].text;
                    if (i == "left") {
                        ui["tabTd_" + i].onclick = function () {
                            removeElement(ui.dayTab);
                            chargeMonth("subtract", dateType);
                        }
                    } else if (i == "right") {
                        ui["tabTd_" + i].onclick = function () {
                            removeElement(ui.dayTab);
                            chargeMonth("add", dateType);
                        }
                    } else if(i == "center") {
                        ui["tabTd_" + i].setAttribute("colspan",2);
                    }
                    ui.itemTr_2[add](ui["tabTd_" + i]);
                }
            }

            function changeMonthTab(dateType){
                ui.changeMonthTab = d[cEl]("table");
                ui.changeMonthTab.className = "dateItem";
                ui.dateWarp[add](ui.changeMonthTab);

                ui.itemTr_2 = d[cEl]("tr");
                ui.itemTr_2.className = "tab";
                ui.changeMonthTab[add](ui.itemTr_2);
                for (var i in tabLeftRight) {
                    ui["tabTd_" + i] = d[cEl]("td");
                    ui["tabTd_" + i].id = tabLeftRight[i].id;
                    ui["tabTd_" + i].innerHTML = tabLeftRight[i].text;
                    if (i == "left") {
                        ui["tabTd_" + i].onclick = function () {
                            changeMonthFun("subtract");
                        }
                    } else if (i == "right") {
                        ui["tabTd_" + i].onclick = function () {
                            changeMonthFun("add");
                        }
                    }
                    ui.itemTr_2[add](ui["tabTd_" + i]);
                }

                function changeMonthFun(type){
                    removeElement(ui.dayOrHour);
                    if(ui.sureBtn){
                        removeElement(ui.sureBtn.div);
                    }
                    chargeMonth(type, dateType);
                }
            }

            function rangeTab(){
                ui.pastDayUl = d[cEl]("ul");
                ui.pastDayUl.className = "pastDayList";
                ui.dateWarp[add](ui.pastDayUl);
                ui.pastDayLi = [];
                for(var i=0; i<pastDayList.length; i++){
                    ui.pastDayLi[i] = d[cEl]("li");
                    ui.pastDayLi[i].innerHTML = "过去" + pastDayList[i] + "天";
                    ui.pastDayLi[i].setAttribute("data-day", pastDayList[i]);
                    ui.pastDayLi[i].onclick = function(){
                        var _thisDay = this.getAttribute("data-day");
                        var nowDay = new Date();
                        currStartDate = new Date(nowDay.getFullYear(), nowDay.getMonth(), (nowDay.getDate() - _thisDay)).dateFormat();
                        currEndDate = nowDay.dateFormat();
                        currStartHour = "00:00";
                        currEndHour = "23:59";
                        returnFun();
                    };
                    ui.pastDayUl[add](ui.pastDayLi[i]);
                }
                //日期范围div
                ui.dateRangeTab = {};
                ui.dateRangeTab.div = d[cEl]("div");
                ui.dateRangeTab.div.className = "dateRangeTab";
                ui.dateWarp[add](ui.dateRangeTab.div);
                //h4
                ui.dateRangeTab.h4 = d[cEl]("h4");
                ui.dateRangeTab.h4.innerHTML = "自定义范围";
                ui.dateRangeTab.div[add](ui.dateRangeTab.h4);
                //input
                ui.dateRangeTab.startIpt = d[cEl]("input");
                ui.dateRangeTab.startIpt.id = "startDateInput";
                ui.dateRangeTab.startIpt.setAttribute("readOnly","true");
                ui.dateRangeTab.startIpt.value = isShowHour ? (currStartDate + " " + currStartHour + ":00") : currStartDate;
                ui.dateRangeTab.startIpt.onclick = function(){
                    changeStartEndInputFun("start");
                };
                ui.dateRangeTab.div[add](ui.dateRangeTab.startIpt);

                ui.dateRangeTab.connect = d[cEl]("i");
                ui.dateRangeTab.connect.id = "start_connect_end";
                ui.dateRangeTab.div[add](ui.dateRangeTab.connect);

                ui.dateRangeTab.endIpt = d[cEl]("input");
                ui.dateRangeTab.endIpt.id = "endDateInput";
                ui.dateRangeTab.endIpt.setAttribute("readOnly","true");
                ui.dateRangeTab.endIpt.value = isShowHour ? (currEndDate + " " + currEndHour + ":59") : currEndDate;
                ui.dateRangeTab.endIpt.onclick = function(){
                    changeStartEndInputFun("end");
                };
                ui.dateRangeTab.div[add](ui.dateRangeTab.endIpt);
                currRangeOn == "start" ? ui.dateRangeTab.startIpt.className = "on" : ui.dateRangeTab.endIpt.className = "on";
                changeStartEndInputFun(currRangeOn);

                function changeStartEndInputFun(startOrEnd){
                    currRangeOn = startOrEnd;
                    if(startOrEnd == "start"){
                        ui.dateRangeTab.startIpt.className = "on";
                        ui.dateRangeTab.endIpt.className = "";
                    }else {
                        ui.dateRangeTab.startIpt.className = "";
                        ui.dateRangeTab.endIpt.className = "on";
                    }
                    //删除重新绘制
                    removeElement(ui.changeMonthTab);
                    removeElement(ui.itemTr_2);
                    removeElement(ui.dayOrHour);
                    if(ui.sureBtn){
                        removeElement(ui.sureBtn.div);
                    }
                    changeMonthTab(itemTab.range.text);
                    day(nowMonth, itemTab.range.text);
                    sureBtnDiv();
                }
            }

            //日
            function day(nowMonth, dateType) {
                ui.dayOrHour = d[cEl]("div");
                ui.dayOrHour.className = "dayOrHour";
                ui.dateWarp[add](ui.dayOrHour);
                if(dateType == itemTab.range.text && isShowHour){
                    ui.hour = d[cEl]("div");
                    ui.hour.className = "hourWarp";
                    ui.dayOrHour[add](ui.hour);
                    ui.hourSpan = {};
                    for(var i=0; i<24; i++){
                        ui.hourSpan["hourList_" + i] = d[cEl]("span");
                        var iTime = "";
                        if(i < 10){
                            iTime = "0" + i + (currRangeOn == "start" ? ":00" : ":59");
                        }else{
                            iTime = i + (currRangeOn == "start" ? ":00" : ":59");
                        }
                        ui.hourSpan["hourList_" + i].innerHTML = iTime;
                        if(iTime == (currRangeOn == "start" ? currStartHour : currEndHour)){
                            ui.hourSpan["hourList_" + i].className = "on";
                        }
                        ui.hourSpan["hourList_" + i].onclick = function(){

                            if(currRangeOn == "start"){
                                //if(new Date(currStartDate + " " + this.innerHTML + ":00").getTime() > new Date(currEndDate + " " + currEndHour + ":59").getTime()){
                                //    alert("开始时间不可大于结束时间!");
                                //    return;
                                //}
                                ui.dateRangeTab.startIpt.value = currStartDate + " " + this.innerHTML + ":00";
                                currStartHour = this.innerHTML;
                            }else {
                                //if(new Date(currStartDate + " " + currStartHour + ":00").getTime() > new Date(currEndDate + " " + this.innerHTML + ":59").getTime()){
                                //    alert("结束时间不可小于开始时间!");
                                //    return;
                                //}
                                ui.dateRangeTab.endIpt.value = currEndDate + " " + this.innerHTML + ":59";
                                currEndHour = this.innerHTML;
                            }
                            //选中状态
                            var _this = this.parentNode.children;
                            for(var i=0; i<_this.length; i++){
                                _this[i].className = "";
                            }
                            this.className = "on";
                        };
                        ui.hour[add](ui.hourSpan["hourList_" + i]);
                    }
                }

                ui.dayTab = d[cEl]("table");
                ui.dayTab.className = "dateDay";
                ui.dayTab.cellpadding = 0;
                ui.dayTab.cellspacing = 0;
                if(dateType == itemTab.range.text && !isShowHour){
                    ui.dayTab.style.width = "100%";
                }
                ui.dayOrHour[add](ui.dayTab);

                if (dateType != itemTab.month.text) {
                    getDateList(nowMonth, dateType);
                } else {
                    getMonthList();
                }
            }

            function sureBtnDiv(){
                ui.sureBtn = {};
                ui.sureBtn.div = d[cEl]("div");
                ui.sureBtn.div.className = "sureBtn";
                ui.dateWarp[add](ui.sureBtn.div);
                ui.sureBtn.btn = d[cEl]("button");
                ui.sureBtn.btn.innerHTML = "确定";
                ui.sureBtn.btn.onclick = function(){
                    if(new Date(currStartDate + " " + currStartHour + ":00").getTime() > new Date(currEndDate + " " + currEndHour + ":59").getTime()){
                        returnParams.resultCode = 1;
                        returnParams.errMsg = "开始时间不可大于结束时间!";
                        data.callbackFun(returnParams);
                        return;
                    }else {
                        returnFun();
                    }

                };
                ui.sureBtn.div[add](ui.sureBtn.btn);
            }

            function returnFun(){
                if(currDateType != itemTab.range.text){
                    currStartHour = "00:00";
                    currEndHour = "23:59";
                }
                removeElement(d[gid]("dateWarp"));
                returnParams.resultCode = 0;
                if(currDateType == itemTab.range.text && isShowHour){
                    returnParams.date = currStartDate + " " + currStartHour + "-" + currEndDate + " " + currEndHour;
                }else{
                    returnParams.date = currStartDate + "-" + currEndDate;
                }
                data.callbackFun(returnParams);
            }

            function getMonthList() {
                var monthFirstDay = new Date(nowYear, nowMonth, 1); //当月第一天
                var monthLastDay = new Date(nowYear, nowMonth + 1, 0); //当月最后一天
                document.getElementById("dateAareShow").innerHTML = nowYear + "年";

                var m = 0;
//                ui["monthListTr_"+m] = d[cEl]("tr");
//                ui.dayTab[add](ui["monthListTr_"+m]);
                for (var i = 0; i < 12; i++) {
                    if (i % 3 == 0) {
                        ui["monthListTr_" + m] = d[cEl]("tr");
                        ui.dayTab[add](ui["monthListTr_" + m]);
                        m++;
                    }
                    ui["monthListTd_" + i] = d[cEl]("td");
                    ui["monthListTd_" + i].innerHTML = (i + 1) + itemTab.month.text;

                    if(now.getTime() >= new Date(nowYear, i, 1).getTime()){
                        //选中状态
                        if (new Date(nowYear, i, 1).dateFormat() == currStartDate && new Date(nowYear, i + 1, 0).dateFormat() == currEndDate) {
                            ui["monthListTd_" + i].className = "on";
                        }
                        ui["monthListTd_" + i].onclick = function () {
                            currStartDate = new Date(nowYear, parseInt(this.innerHTML.replace(itemTab.month.text, "")) - 1, 1).dateFormat();
                            currEndDate = new Date(nowYear, parseInt(this.innerHTML.replace(itemTab.month.text, "")), 0).dateFormat();
                            //gd.value = currStartDate + "-" + currEndDate;
                            var _this = this.parentNode.parentNode.childNodes;
                            for (var j = 0; j < _this.length; j++) {
                                for (var x = 0; x < _this[j].childNodes.length; x++) {
                                    _this[j].childNodes[x].className = _this[j].childNodes[x].className.replace("on", "");
                                }
                            }
                            this.className = "on";
                            //d[gid]("dateWarp").remove();
                            returnFun();
                        };
                    }else{
                        ui["monthListTd_" + i].className = "no";
                    }
                    ui["monthListTr_" + Math.floor(i / 3)][add](ui["monthListTd_" + i]);
                }
            }

            function getDateList(nowMonth, dateType) {
                var monthFirstDay = new Date(nowYear, nowMonth, 1); //当月第一天
                var monthLastDay = new Date(nowYear, nowMonth + 1, 0); //当月最后一天
                var monthFirstWeek = monthFirstDay.getDay() == 0 ? 6 : (monthFirstDay.getDay()-1);

                document.getElementById("dateAareShow").innerHTML = nowYear + "年" + (nowMonth + 1) + "月";
//                if(dateType != itemTab.month.text){
//                    document.getElementById("dateAareShow").innerHTML = nowYear + "年" + (nowMonth+1) + "月";
//                }else{
//                    document.getElementById("dateAareShow").innerHTML = nowYear + "年";
//                }


                ui.weekTextListTr = d[cEl]("tr");
                ui.dayTab[add](ui.weekTextListTr);
                for (var i = 0; i < weekTextList.length; i++) {
                    ui.weekTextListTh = d[cEl]("th");
                    ui.weekTextListTh.innerHTML = weekTextList[i];
                    ui.weekTextListTr[add](ui.weekTextListTh);
                }

                var dateListTr = 1;
                ui["dateListTab"] = {};
                ui["dateListTab"]["dateListTr_" + dateListTr] = d[cEl]("tr");
                if (dateType == itemTab.week.text) {
                    ui["dateListTab"]["dateListTr_" + dateListTr].className = "week";
                    //第一排周开始时间大于今天不可选
                    if(now.getTime() >= new Date(nowYear, nowMonth, 1 - monthFirstWeek).getTime()){
                        if (new Date(nowYear, nowMonth, 1 - monthFirstWeek).dateFormat() == currStartDate && new Date(nowYear, nowMonth, 1 + (6 - monthFirstWeek)).dateFormat() == currEndDate) {
                            ui["dateListTab"]["dateListTr_" + dateListTr].className = "week on";
                        }
                        ui["dateListTab"]["dateListTr_" + dateListTr].onclick = function () {
                            currStartDate = new Date(nowYear, nowMonth, 1 - monthFirstWeek).dateFormat();
                            currEndDate = new Date(nowYear, nowMonth, 1 + (6 - monthFirstWeek)).dateFormat();
                            //gd.value = currStartDate + "-" + currEndDate;
                            var _this = this.parentNode.childNodes;
                            for (var j = 0; j < _this.length; j++) {
                                _this[j].className = _this[j].className.replace("on", "");
                            }
                            this.className = this.className + " on";
                            //d[gid]("dateWarp").remove();
                            returnFun();
                        }
                    }

                }
                ui.dayTab[add](ui["dateListTab"]["dateListTr_" + dateListTr]);
                //当月前几天
                for (var i = 0; i < monthFirstWeek; i++) {
                    ui["dateListTab"]["dateListTd_" + i] = d[cEl]("td");
                    ui["dateListTab"]["dateListTd_" + i].innerHTML = new Date(nowYear, nowMonth, 1 - monthFirstWeek + i).getDate();
                    ui["dateListTab"]["dateListTd_" + i].className = "no";
                    ui["dateListTab"]["dateListTr_" + dateListTr][add](ui["dateListTab"]["dateListTd_" + i]);
                }

                for (var i = 0; i < monthLastDay.getDate(); i++) {
                    //刚好换行到第二个tr的情况
                    if (i > 0 && new Date(nowYear, nowMonth, 1 + i).getDay() == 1) {
                        dateListTr++;
                        ui["dateListTab"]["dateListTr_" + dateListTr] = d[cEl]("tr");
                        if (dateType == itemTab.week.text) {
                            ui["dateListTab"]["dateListTr_" + dateListTr].className = "week";
                            if (new Date(nowYear, nowMonth, 1 + i).dateFormat() == currStartDate && new Date(nowYear, nowMonth, 1 + i + 6).dateFormat() == currEndDate) {
                                ui["dateListTab"]["dateListTr_" + dateListTr].className = "week on";
                            }
                            ui["dateListTab"]["dateListTr_" + dateListTr].onclick = function () {

                                if(now.getTime() >= new Date(nowYear, nowMonth, this.firstChild.innerHTML)){
                                    currStartDate = new Date(nowYear, nowMonth, this.firstChild.innerHTML).dateFormat();
                                    currEndDate = new Date(nowYear, nowMonth, parseInt(this.firstChild.innerHTML) + 6).dateFormat();
                                    //gd.value = currStartDate + "-" + currEndDate;
                                    var _this = this.parentNode.childNodes;
                                    for (var j = 0; j < _this.length; j++) {
                                        _this[j].className = _this[j].className.replace("on", "");
                                    }
                                    this.className = this.className + " on";
                                    //d[gid]("dateWarp").remove();
                                    returnFun();
                                }
                            }
                        }
                        ui.dayTab[add](ui["dateListTab"]["dateListTr_" + dateListTr]);
                    }
                    var exponentiation = Math.ceil((new Date(nowYear, nowMonth, 1 + i).getDate() + (new Date(nowYear, nowMonth, 1).getDay() == 0 ? 6 : new Date(nowYear, nowMonth, 1).getDay() - 1)) / 7); //向上取整
                    ui["dateListTab"]["dateListTd_a" + i] = d[cEl]("td");
                    ui["dateListTab"]["dateListTd_a" + i].innerHTML = new Date(nowYear, nowMonth, 1 + i).getDate();
                    //超过当天日之后的日期不可选
                    if(now.getTime() < new Date(nowYear, nowMonth, 1 + i).getTime()){
                        /**
                         * 今天之后的日期是否可选开关处 : open_after_date
                         */
                        if(!!data.open_after_date){
                            //选中状态
                            selectedDate(i);
                        }else{
                            ui["dateListTab"]["dateListTd_a" + i].className = "no";
                        }
                    }else{
                        if(data && data.start_date && new Date(now.getFullYear(), now.getMonth(), now.getDate() - data.start_date + 1).getTime() > new Date(nowYear, nowMonth, 1 + i).getTime()){
                            ui["dateListTab"]["dateListTd_a" + i].className = "no";
                        }else{
                            if (dateType == itemTab.day.text) {
                                //选中状态
                                selectedDate(i);
                            }
                            if (dateType == itemTab.range.text) {
                                //console.log(currStartDate);
                                //选中状态
                                if (new Date(nowYear, nowMonth, 1 + i).dateFormat() == (currRangeOn == "start" ? currStartDate : currEndDate)) {
                                    ui["dateListTab"]["dateListTd_a" + i].className = "on";
                                }
                                ui["dateListTab"]["dateListTd_a" + i].onclick = function () {
                                    //var t;
                                    if(currRangeOn == "start"){

                                        //t = new Date(nowYear + "/" + (nowMonth+1) + "/" + this.innerHTML + " " + currStartHour + ":00");
                                        //console.log(t);
                                        //console.log(t.getTime());
                                        //console.log(new Date(currEndDate + " " + currEndHour + ":59"));
                                        //console.log(new Date(currEndDate + " " + currEndHour + ":59").getTime());
                                        //if(t.getTime() > new Date(currEndDate + " " + currEndHour + ":59").getTime()){
                                        //    alert("开始时间不可大于结束时间!");
                                        //    return;
                                        //}
                                        currStartDate = new Date(nowYear, nowMonth, this.innerHTML).dateFormat();
                                    }else{
                                        //t = new Date(nowYear + "/" + (nowMonth+1) + "/" + this.innerHTML + " " + currEndHour + ":59");
                                        //if(t.getTime() < new Date(currStartDate + " " + currStartHour + ":00").getTime()){
                                        //    alert("结束时间不可小于开始时间!");
                                        //    return;
                                        //}
                                        currEndDate = new Date(nowYear, nowMonth, this.innerHTML).dateFormat();
                                    }
                                    //currRangeOn == "start" ? currStartDate = new Date(nowYear, nowMonth, this.innerHTML).dateFormat() : currEndDate = new Date(nowYear, nowMonth, this.innerHTML).dateFormat();
                                    var _this = this.parentNode.parentNode.childNodes;
                                    for (var j = 0; j < _this.length; j++) {
                                        for (var x = 0; x < _this[j].childNodes.length; x++) {
                                            _this[j].childNodes[x].className = _this[j].childNodes[x].className.replace("on", "");
                                        }
                                    }
                                    this.className = "on";
                                    currRangeOn == "start" ? (ui.dateRangeTab.startIpt.value = isShowHour ? (currStartDate + " " + currStartHour + ":00") : currStartDate) : (ui.dateRangeTab.endIpt.value = isShowHour ? (currEndDate + " " + currEndHour + ":59") : currEndDate);
                                    //removeElement(d[gid]("dateWarp"));
                                    //data.callbackFun(currStartDate + "-" + currEndDate);
                                };
                            }
                        }
                    }

                    ui["dateListTab"]["dateListTr_" + exponentiation][add](ui["dateListTab"]["dateListTd_a" + i]);
                }

                //当月之后的几天
                for (var i = 0; i < (monthLastDay.getDay() == 0 ? 0 : (7 - monthLastDay.getDay())); i++) {
                    ui["dateListTab"]["dateListTd_b" + i] = d[cEl]("td");
                    ui["dateListTab"]["dateListTd_b" + i].innerHTML = new Date(nowYear, nowMonth, 1 + i).getDate();
                    ui["dateListTab"]["dateListTd_b" + i].className = "no";
                    ui["dateListTab"]["dateListTr_" + dateListTr][add](ui["dateListTab"]["dateListTd_b" + i]);
                }
            }

            /**
             * 选中状态及拼接日期td
             * @param i
             */
            function selectedDate(i){
                if (new Date(nowYear, nowMonth, 1 + i).dateFormat() == currStartDate && new Date(nowYear, nowMonth, 1 + i).dateFormat() == currEndDate) {
                    ui["dateListTab"]["dateListTd_a" + i].className = "on";
                }
                ui["dateListTab"]["dateListTd_a" + i].onclick = function () {
                    currStartDate = currEndDate = new Date(nowYear, nowMonth, this.innerHTML).dateFormat();
                    var _this = this.parentNode.parentNode.childNodes;
                    for (var j = 0; j < _this.length; j++) {
                        for (var x = 0; x < _this[j].childNodes.length; x++) {
                            _this[j].childNodes[x].className = _this[j].childNodes[x].className.replace("on", "");
                        }
                    }
                    this.className = "on";
                    returnFun();
                };
            }

            function chargeMonth(chargeType, dateType) {
                if (chargeType == "add") {
                    if (dateType != itemTab.month.text) {
                        nowMonth += 1;
                    } else {
                        nowYear += 1;
                    }

                } else if (chargeType == "subtract") {
                    if (dateType != itemTab.month.text) {
                        nowMonth -= 1;
                    } else {
                        nowYear -= 1;
                    }
                }
                var d = new Date(nowYear, nowMonth, 1);
                nowMonth = d.getMonth();
                nowYear = d.getFullYear();
                day(nowMonth, dateType);

                if(dateType == itemTab.range.text){
                    sureBtnDiv();
                }
            }

        };

        window.onresize = function(){
            var gd = d[gid](data.id);
            var dw = d[gid]("dateWarp");
            if(dw){
                d[gid]("dateWarp").style.top = (gd.getBoundingClientRect().top + 36) + "px";
                d[gid]("dateWarp").style.left = gd.getBoundingClientRect().left + "px";
            }

        };

        document.onclick = function () {
            var dw = d[gid]("dateWarp");
            if (dw) {
                //dw.remove();
                //document.body.removeChild(dw);
                removeElement(dw);
            }
        };

        function removeElement(_element){
            var _parentElement = _element.parentNode;
            if(_parentElement){
                _parentElement.removeChild(_element);
            }
        }

        function dateFormat(date){
            var dateYear = date.getFullYear();
            if(isNaN(dateYear)){
                throw error("无效的日期");
                return;
            }
            var dateMonth = date.getMonth() + 1;
            var dateDay = date.getDate();
            var dateWeek = date.getDay();
            var dateString = dateYear + "/" + dateMonth + "/" + dateDay;
            return dateString;
        }

    }
    Date.prototype.dateFormat = function(format){
        var dateYear = this.getFullYear();
        if(isNaN(dateYear)){
            throw error("无效的日期");
            return;
        }
        var dateMonth = this.getMonth() + 1;
        var dateDay = this.getDate();
        var dateWeek = this.getDay();
        var dateString = dateYear + "/" + dateMonth + "/" + dateDay;
        return dateString;
    }
})();

