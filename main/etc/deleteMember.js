function deleteMember(userId){
    conf = confirm('정말로 탈퇴하시겠습니까?');
    if(conf){
        document.write("<form action=\"../dataProcessing/memberOutDataProcessing.php\" id='frm' method='post'>" +
            "<input type=\"hidden\" value="+userId+" name='id'>");
        document.getElementById('frm').submit();
        document.write("</form>")
    }
}

function forceDeleteMember(userId){
    conf = confirm('정말로 탈퇴시키겠습니까?');
    if(conf){
        document.write("<form action=\"../dataProcessing/memberOutDataProcessing.php\" id='frm' method='post'>" +
            "<input type=\"hidden\" value="+userId+" name='id'>");
        document.getElementById('frm').submit();
        document.write("</form>")
    }
}