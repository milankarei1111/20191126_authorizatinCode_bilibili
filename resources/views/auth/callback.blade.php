<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
    function GetRequest() {
        var url = location.search; // 獲取url中 "?"字符後的字串
        var theRequest = {};
        if(url.indexOf("?") !== -1){
            var str = url.substr(1);
            strs = str.split("&");
            for(var i = 0; i < strs.length; i++){
                theRequest[strs[i].split("=")[0]] = decodeURI(strs[i].split("=")[1]);
            }
        }
        return theRequest;
    }

    // 調用
    var Request = GetRequest();

    if(Request['error']){
        // 用戶未授權處理
        alert(Request['error']);
    } else {
        // 獲得授權後則請求令牌
        var code = Request['code'];
        var state = Request['state'];

        axios.post('', {
            params: {
                code,
                state
            }
        })

            .then(function(response){
                console.log(response.data);
            });
    }
</script>
