
//获取非行间属性值
function getStyle(obj, attr) {
    if (obj.currentStyle) {
        return obj.currentStyle[attr];
    } else {
        return getComputedStyle(obj, false)[attr];
    }
}

//完美运动框架
function stratMove(obj, json, fnEnd) {

    clearInterval(obj.timer);
    obj.timer = setInterval(function () {
        var bstop=true; 
        for (var attr in json) {

            var value = 0;

            if (attr == 'opacity') {
                value = Math.round(parseFloat(getStyle(obj, attr)) * 100);
            } else {
                value = parseInt(getStyle(obj, attr));
            }

            var speed = (json[attr]- value) / 10;
            speed = speed > 0 ? Math.ceil(speed) : Math.floor(speed);

            if(value!=json[attr])
                bstop=false;

                if (attr == 'opacity') 
                {
                    obj.style.filter = 'alpha(opacity=' + (value + speed) + ')';
                    obj.style.opacity = (value + speed) / 100;
                }
                else
                {
                    obj.style[attr] = value + speed + 'px';
                }
            }

            if(bstop)
            {
                clearInterval(obj.timer);

                if(fnEnd) fnEnd();
            }
    }, 30);
}

//获取鼠标鼠标新的的位置
function newPos(ev) {
    var scollTop = document.documentElement.scrollTop || document.body.scrollTop;
    var scollLeft = document.documentElement.scrollLeft || document.body.scrollLeft;
    return {
        x: ev.clientX + scollLeft,
        y: ev.clientY + scollTop
    };
}

//窗口拖拽方法
function Draft(obj) {
    var oXpos = 0;
    var oYpos = 0;
    obj.onmousedown = function (ev) {
        var oEv = ev || event;
        var oPos = newPos(ev);
        oXpos = oPos.x - obj.offsetLeft;
        oYpos = oPos.y - obj.offsetTop;
        document.onmousemove = function (ev) {
            var oEv = ev || event;
            var oPos = newPos(ev);
            var oYpos2 = oPos.y - oYpos;
            var oXpos2 = oPos.x - oXpos;
            if (oYpos2 < 50) //下面的if else是用来判断是否超过可视区的位置
            {
                oYpos2 = 0;
            } else if (oYpos2 > document.documentElement.clientHeight - obj.offsetHeight) {
                oYpos2 = document.documentElement.clientHeight - obj.offsetHeight;
            }
            if (oXpos2 < 50) { //吸附的处理
                oXpos2 = 0;
            } else if (oXpos2 > document.documentElement.clientWidth - obj.offsetWidth) {
                oXpos2 = document.documentElement.clientWidth - obj.offsetWidth;
            }
            obj.style.top = oYpos2 + "px";
            obj.style.left = oXpos2 + "px";
    
        }
        document.onmouseup = function () {
            document.onmousemove = null;
            document.onmouseup = null;
            // oMoveWindow.releaseCapture();
        }
        // oMoveWindow.setCapture();//事件捕获 所有事件聚集在这一个事件上,ie专用
        return false; //阻止火狐拖拽空div时出现的bug
    }
}
