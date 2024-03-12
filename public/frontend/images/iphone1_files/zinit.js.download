var url = new URL(window.location.href);
window.zsp_width = Number(url.searchParams.get("width"));
window.zsp_height = Number(url.searchParams.get("height"));

window.zsp_max_width = 1096;
window.zsp_max_height = 813;

window.zsp_min_width = 60;
window.zsp_min_height = 60;

window.zsp_left_side = url.searchParams.get("leftside");

window.zsp_referrer = url.searchParams.get("domain");

(function (w, d, n, s, zs) {
    if (w.ztr) {
        return;
    }
    s = d.getElementsByTagName("script")[0];
    if (!w.ztr) {
        n = w.ztr = function (act, evt, arg) {
            if (n && n.callMethod) {
                n.callMethod.apply(act, evt, arg);
            } else {
                n.queue.push({ action: act, event: evt, arguments: arg });
            }
        };
        n.queue = n.queue || [];
        zs = d.createElement("script");
        zs.type = "text/javascript";
        zs.src = "https://px.dmp.zaloapp.com/static/zdmp_tr_px.js";
        s.parentNode.insertBefore(zs, s);
    }
})(window, document);

ztr("init", window.APP_ID);
ztr("track", "PageView");

function onChangeSizeIframe(width, height, isOpening) {
    var data = {
        width,
        height
    };
    if (isOpening) {
        data.isOpening = isOpening
    }
    ZSDKServer.postMessage('zchat_widget_toggle_sticker', data);
}

function initIframeSize() {
    var width = "auto";
    var height = "auto";
    ZSDKServer.postMessage('zchat_widget_open_chat_box', { width, height });
}

window.onload = function () {
    ZSDKServer.init();
    initIframeSize();
};

var FullScreen = {
    open: function (elem) {
        if (elem.requestFullscreen) {
            elem.requestFullscreen();
        } else if (elem.webkitRequestFullscreen) { /* Safari */
            elem.webkitRequestFullscreen();
        } else if (elem.msRequestFullscreen) { /* IE11 */
            elem.msRequestFullscreen();
        }
    },

    close: function () {
        if (document.exitFullscreen) {
            document.exitFullscreen();
        } else if (document.webkitExitFullscreen) { /* Safari */
            document.webkitExitFullscreen();
        } else if (document.msExitFullscreen) { /* IE11 */
            document.msExitFullscreen();
        }
    },

    isOn: function () {
        return document.fullscreenElement ||
            document.webkitFullscreenElement || /* Safari and Opera */
            document.msFullscreenElement /* IE11 */;
    }
}

var ZaloPC = {
    open: function (uri, callback) {
        openCustomProtocol(uri, callback);
    }
}